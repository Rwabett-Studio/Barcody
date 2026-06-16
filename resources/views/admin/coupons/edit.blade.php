@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <div class="content pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">Edit Coupon: {{ $coupon->code }}</h4>
            <a href="{{ route('coupons.index') }}" class="btn btn-outline-secondary btn-sm">Back</a>
        </div>
        <div class="col-12 position-relative pt-1">
            <div class="logFormDV center mb-lg-5 mb-2">
                <div class="col-lg-9 center pt-lg-5 pt-2">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                        </div>
                    @endif
                    <form action="{{ route('coupons.update', $coupon->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="code">Coupon Code</label>
                                <input type="text" name="code" id="code" class="form-control" value="{{ old('code', $coupon->code) }}" required style="text-transform:uppercase">
                            </div>

                            <div class="col-md-6">
                                <label for="discount_type">Discount Type</label>
                                <select name="discount_type" id="discount_type" class="form-control" required>
                                    <option value="percentage" {{ old('discount_type', $coupon->discount_type) === 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                                    <option value="fixed" {{ old('discount_type', $coupon->discount_type) === 'fixed' ? 'selected' : '' }}>Fixed Amount ($)</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="discount_value">Discount Value</label>
                                <input type="number" name="discount_value" id="discount_value" class="form-control" value="{{ old('discount_value', $coupon->discount_value) }}" step="0.01" min="0.01" required>
                            </div>

                            <div class="col-md-6">
                                <label for="plan_id">Applicable Plan</label>
                                <select name="plan_id" id="plan_id" class="form-control">
                                    <option value="">All Plans</option>
                                    @foreach($plans as $plan)
                                        <option value="{{ $plan->id }}" {{ old('plan_id', $coupon->plan_id) == $plan->id ? 'selected' : '' }}>
                                            {{ $plan->title }} — ${{ $plan->price }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="max_uses">Max Uses</label>
                                <input type="number" name="max_uses" id="max_uses" class="form-control" value="{{ old('max_uses', $coupon->max_uses) }}" min="1">
                            </div>

                            <div class="col-md-6">
                                <label for="expires_at">Expiry Date</label>
                                <input type="datetime-local" name="expires_at" id="expires_at" class="form-control"
                                    value="{{ old('expires_at', $coupon->expires_at?->format('Y-m-d\TH:i')) }}">
                            </div>

                            <div class="col-12">
                                <div class="form-check">
                                    <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" {{ old('is_active', $coupon->is_active) ? 'checked' : '' }}>
                                    <label for="is_active" class="form-check-label">Active</label>
                                </div>
                            </div>

                            <div class="col-12">
                                <p class="text-muted">Used {{ $coupon->used_count }} time(s) so far.</p>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn blueBtn d-flex w-100 align-items-center justify-content-center">
                                    <i class="fas fa-save me-2"></i> <span>Update Coupon</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.layouts.footer')
