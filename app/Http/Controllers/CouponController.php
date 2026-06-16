<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Plan;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::with('plan')->latest()->get();
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        $plans = Plan::all();
        return view('admin.coupons.create', compact('plans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code'           => 'required|string|max:50|unique:coupons,code',
            'discount_type'  => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0.01',
            'plan_id'        => 'nullable|exists:plans,id',
            'max_uses'       => 'nullable|integer|min:1',
            'expires_at'     => 'nullable|date|after:now',
            'is_active'      => 'boolean',
        ]);

        Coupon::create([
            'code'           => strtoupper($request->code),
            'discount_type'  => $request->discount_type,
            'discount_value' => $request->discount_value,
            'plan_id'        => $request->plan_id,
            'max_uses'       => $request->max_uses,
            'expires_at'     => $request->expires_at,
            'is_active'      => $request->boolean('is_active', true),
        ]);

        return redirect()->route('coupons.index')->with('success', 'Coupon created successfully.');
    }

    public function edit(Coupon $coupon)
    {
        $plans = Plan::all();
        return view('admin.coupons.edit', compact('coupon', 'plans'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'code'           => 'required|string|max:50|unique:coupons,code,' . $coupon->id,
            'discount_type'  => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0.01',
            'plan_id'        => 'nullable|exists:plans,id',
            'max_uses'       => 'nullable|integer|min:1',
            'expires_at'     => 'nullable|date',
            'is_active'      => 'boolean',
        ]);

        $coupon->update([
            'code'           => strtoupper($request->code),
            'discount_type'  => $request->discount_type,
            'discount_value' => $request->discount_value,
            'plan_id'        => $request->plan_id,
            'max_uses'       => $request->max_uses,
            'expires_at'     => $request->expires_at,
            'is_active'      => $request->boolean('is_active'),
        ]);

        return redirect()->route('coupons.index')->with('success', 'Coupon updated successfully.');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('coupons.index')->with('success', 'Coupon deleted successfully.');
    }

    // API: apply coupon code
    public function apply(Request $request)
    {
        $request->validate([
            'code'    => 'required|string',
            'plan_id' => 'required|exists:plans,id',
        ]);

        $coupon = Coupon::where('code', strtoupper($request->code))->first();

        if (!$coupon || !$coupon->isValid((int) $request->plan_id)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired coupon.',
            ], 422);
        }

        $plan     = Plan::findOrFail($request->plan_id);
        $discount = $coupon->calculateDiscount((float) $plan->price);
        $final    = max(0, $plan->price - $discount);

        return response()->json([
            'success'        => true,
            'coupon_id'      => $coupon->id,
            'discount_type'  => $coupon->discount_type,
            'discount_value' => $coupon->discount_value,
            'discount_amount'=> $discount,
            'original_price' => $plan->price,
            'final_price'    => $final,
        ]);
    }
}
