@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <div class="content pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-4">
            <h4 class="fw-bold mb-0">🔔 إشعارات الردود</h4>
        </div>

        {{-- Stats --}}
        <div class="row g-3 mb-4">
            <div class="col-6 col-md">
                <div class="card text-center p-3"><div class="fs-3 fw-bold">{{ $stats['total'] }}</div><small class="text-muted">إجمالي الردود</small></div>
            </div>
            <div class="col-6 col-md">
                <div class="card text-center p-3" style="border-top:3px solid #16a34a"><div class="fs-3 fw-bold text-success">{{ $stats['accepted'] }}</div><small class="text-muted">سيحضرون</small></div>
            </div>
            <div class="col-6 col-md">
                <div class="card text-center p-3" style="border-top:3px solid #f59e0b"><div class="fs-3 fw-bold text-warning">{{ $stats['maybe'] }}</div><small class="text-muted">احتمال</small></div>
            </div>
            <div class="col-6 col-md">
                <div class="card text-center p-3" style="border-top:3px solid #dc2626"><div class="fs-3 fw-bold text-danger">{{ $stats['declined'] }}</div><small class="text-muted">اعتذروا</small></div>
            </div>
            <div class="col-6 col-md">
                <div class="card text-center p-3" style="border-top:3px solid #2575fc"><div class="fs-3 fw-bold" style="color:#2575fc">{{ $stats['unread'] }}</div><small class="text-muted">غير مقروء</small></div>
            </div>
        </div>

        {{-- Filters --}}
        <form method="GET" class="row g-2 mb-3">
            <div class="col-auto">
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="">كل الحالات</option>
                    <option value="accepted" @selected(request('status')=='accepted')>سيحضر</option>
                    <option value="maybe" @selected(request('status')=='maybe')>احتمال</option>
                    <option value="declined" @selected(request('status')=='declined')>اعتذر</option>
                </select>
            </div>
            <div class="col-auto">
                <select name="event_id" class="form-select" onchange="this.form.submit()">
                    <option value="">كل المناسبات</option>
                    @foreach($events as $ev)
                        <option value="{{ $ev->id }}" @selected(request('event_id')==$ev->id)>{{ $ev->name }}</option>
                    @endforeach
                </select>
            </div>
        </form>

        {{-- List --}}
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>المدعو</th>
                            <th>المناسبة</th>
                            <th>الرد</th>
                            <th>عدد الضيوف</th>
                            <th>الوقت</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($notifications as $n)
                            <tr class="{{ is_null($n->read_at) ? 'fw-semibold' : '' }}">
                                <td>{{ $n->contact->name ?? '—' }}<br><small class="text-muted">{{ $n->contact->phone ?? '' }}</small></td>
                                <td>{{ $n->event->name ?? '—' }}</td>
                                <td>
                                    @php $badge = ['accepted'=>'success','maybe'=>'warning','declined'=>'danger'][$n->status] ?? 'secondary'; @endphp
                                    @php $label = ['accepted'=>'سيحضر ✅','maybe'=>'احتمال 🤔','declined'=>'اعتذر ❌'][$n->status] ?? $n->status; @endphp
                                    <span class="badge bg-{{ $badge }}">{{ $label }}</span>
                                </td>
                                <td>{{ $n->contact->guests_count ?? '—' }}</td>
                                <td><small class="text-muted">{{ $n->created_at->diffForHumans() }}</small></td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center py-4 text-muted">لا توجد ردود بعد</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">{{ $notifications->withQueryString()->links() }}</div>
    </div>
</div>

@include('admin.layouts.footer')
