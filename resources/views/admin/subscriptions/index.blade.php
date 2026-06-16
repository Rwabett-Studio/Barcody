@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <div class="content pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">Subscriptions</h4>
        </div>

        <div class="row mt-3 mb-4">
            <div class="col-md-3">
                <div class="card text-center p-3">
                    <h6 class="text-muted">Total</h6>
                    <h3>{{ $subscriptions->count() }}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center p-3">
                    <h6 class="text-muted">Active</h6>
                    <h3 class="text-success">{{ $subscriptions->where('status','active')->count() }}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center p-3">
                    <h6 class="text-muted">Revenue</h6>
                    <h3>${{ number_format($subscriptions->where('status','active')->sum('paid_amount'), 2) }}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center p-3">
                    <h6 class="text-muted">Cancelled</h6>
                    <h3 class="text-danger">{{ $subscriptions->where('status','cancelled')->count() }}</h3>
                </div>
            </div>
        </div>

        <div class="col-12 position-relative pt-1">
            <table id="subscriptionsTable" class="w-100 mt-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Plan</th>
                        <th>Coupon</th>
                        <th>Original</th>
                        <th>Discount</th>
                        <th>Paid</th>
                        <th>Status</th>
                        <th>Starts</th>
                        <th>Ends</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subscriptions as $sub)
                    <tr>
                        <td>{{ $sub->id }}</td>
                        <td>
                            <div>
                                <strong>{{ $sub->user?->name }}</strong><br>
                                <small class="text-muted">{{ $sub->user?->email }}</small>
                            </div>
                        </td>
                        <td>{{ $sub->plan?->title }}</td>
                        <td>{{ $sub->coupon?->code ?? '—' }}</td>
                        <td>${{ number_format($sub->original_amount, 2) }}</td>
                        <td class="text-danger">
                            @if($sub->discount_amount > 0) -${{ number_format($sub->discount_amount, 2) }} @else — @endif
                        </td>
                        <td class="fw-bold">${{ number_format($sub->paid_amount, 2) }}</td>
                        <td>
                            @if($sub->status === 'active')
                                <span class="greenSpan">Active</span>
                            @elseif($sub->status === 'cancelled')
                                <span class="redSpan">Cancelled</span>
                            @elseif($sub->status === 'expired')
                                <span class="badge bg-secondary">Expired</span>
                            @else
                                <span class="badge bg-warning">Pending</span>
                            @endif
                        </td>
                        <td>{{ $sub->starts_at?->format('Y-m-d') ?? '—' }}</td>
                        <td>{{ $sub->ends_at?->format('Y-m-d') ?? '—' }}</td>
                        <td>
                            <a href="{{ route('subscriptions.show', $sub->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('admin.layouts.footer')
