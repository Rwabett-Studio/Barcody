<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class SubscriptionController extends Controller
{
    // Admin: list all subscriptions
    public function index()
    {
        $subscriptions = Subscription::with(['user', 'plan', 'coupon'])->latest()->get();
        return view('admin.subscriptions.index', compact('subscriptions'));
    }

    public function show(Subscription $subscription)
    {
        $subscription->load(['user', 'plan', 'coupon']);
        return view('admin.subscriptions.show', compact('subscription'));
    }

    // API: subscribe to a plan (with optional coupon + Stripe payment)
    public function subscribe(Request $request)
    {
        $request->validate([
            'plan_id'          => 'required|exists:plans,id',
            'coupon_code'      => 'nullable|string',
            'stripe_token'     => 'required|string',
        ]);

        $user   = $request->user();
        $plan   = Plan::findOrFail($request->plan_id);
        $coupon = null;
        $discount = 0;

        if ($request->filled('coupon_code')) {
            $coupon = Coupon::where('code', strtoupper($request->coupon_code))->first();
            if (!$coupon || !$coupon->isValid($plan->id)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid or expired coupon.',
                ], 422);
            }
            $discount = $coupon->calculateDiscount((float) $plan->price);
        }

        $finalAmount = max(0, $plan->price - $discount);

        try {
            \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

            // Create or retrieve customer
            $customerId = $user->stripe_customer_id;
            if (!$customerId) {
                $customer = \Stripe\Customer::create([
                    'email'  => $user->email,
                    'name'   => $user->name,
                    'source' => $request->stripe_token,
                ]);
                $customerId = $customer->id;
                $user->update(['stripe_customer_id' => $customerId]);
            }

            // Charge the customer (one-time payment)
            $amountInCents = (int) round($finalAmount * 100);
            $charge = \Stripe\Charge::create([
                'amount'      => $amountInCents,
                'currency'    => config('services.stripe.currency', 'usd'),
                'customer'    => $customerId,
                'description' => "Subscription to {$plan->title}",
            ]);

            $subscription = Subscription::create([
                'user_id'                => $user->id,
                'plan_id'                => $plan->id,
                'coupon_id'              => $coupon?->id,
                'stripe_customer_id'     => $customerId,
                'stripe_payment_intent_id' => $charge->id,
                'status'                 => 'active',
                'original_amount'        => $plan->price,
                'discount_amount'        => $discount,
                'paid_amount'            => $finalAmount,
                'starts_at'              => Carbon::now(),
                'ends_at'                => Carbon::now()->addMonth(),
            ]);

            if ($coupon) {
                $coupon->increment('used_count');
            }

            return response()->json([
                'success'      => true,
                'message'      => 'Subscription created successfully.',
                'subscription' => $subscription->load(['plan', 'coupon']),
            ], 201);

        } catch (\Stripe\Exception\CardException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 402);
        } catch (\Exception $e) {
            Log::error('Subscription error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Payment failed. Please try again.',
            ], 500);
        }
    }

    // API: get current user's subscriptions
    public function mySubscriptions(Request $request)
    {
        $subscriptions = $request->user()
            ->subscriptions()
            ->with(['plan', 'coupon'])
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $subscriptions,
        ]);
    }
}
