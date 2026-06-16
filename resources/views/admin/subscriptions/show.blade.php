@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <div class="content pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">Subscription #{{ $subscription->id }}</h4>
            <a href="{{ route('subscriptions.index') }}" class="btn btn-outline-secondary btn-sm">Back</a>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card p-4">
                    <h5>User Info</h5>
                    <hr>
                    <p><strong>Name:</strong> {{ $subscription->user?->name }}</p>
                    <p><strong>Email:</strong> {{ $subscription->user?->email }}</p>
                    <p><strong>Phone:</strong> {{ $subscription->user?->phone }}</p>
                    <p><strong>Stripe Customer:</strong> {{ $subscription->stripe_customer_id ?? '—' }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-4">
                    <h5>Subscription Details</h5>
                    <hr>
                    <p><strong>Plan:</strong> {{ $subscription->plan?->title }}</p>
                    <p><strong>Original Price:</strong> ${{ number_format($subscription->original_amount, 2) }}</p>
                    @if($subscription->coupon)
                        <p><strong>Coupon:</strong> {{ $subscription->coupon->code }}
                            ({{ $subscription->coupon->discount_type === 'percentage' ? $subscription->coupon->discount_value . '%' : '$' . $subscription->coupon->discount_value }} off)
                        </p>
                        <p><strong>Discount:</strong> -${{ number_format($subscription->discount_amount, 2) }}</p>
                    @endif
                    <p><strong>Paid:</strong> <span class="fw-bold text-success">${{ number_format($subscription->paid_amount, 2) }}</span></p>
                    <p><strong>Status:</strong>
                        @if($subscription->status === 'active')
                            <span class="greenSpan">Active</span>
                        @elseif($subscription->status === 'cancelled')
                            <span class="redSpan">Cancelled</span>
                        @else
                            <span class="badge bg-secondary">{{ ucfirst($subscription->status) }}</span>
                        @endif
                    </p>
                    <p><strong>Stripe Payment:</strong> {{ $subscription->stripe_payment_intent_id ?? '—' }}</p>
                    <p><strong>Starts:</strong> {{ $subscription->starts_at?->format('Y-m-d H:i') ?? '—' }}</p>
                    <p><strong>Ends:</strong> {{ $subscription->ends_at?->format('Y-m-d H:i') ?? '—' }}</p>
                    <p><strong>Created:</strong> {{ $subscription->created_at->format('Y-m-d H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.layouts.footer')
