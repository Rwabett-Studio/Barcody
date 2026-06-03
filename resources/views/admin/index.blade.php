@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <div class="dashboard-page p-4">
        
        <!-- Header -->
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center gap-3 mb-4">
            <div class="w-100">
                <h3 class="fw-bold mb-1" style="color: #172033; font-family: 'Outfit', sans-serif;">Dashboard Overview</h3>
                <p class="text-muted mb-0">Welcome back, here's what's happening with your events today.</p>
            </div>
            <div class="d-flex flex-wrap gap-2 w-100 justify-content-start justify-content-lg-end">
                <a href="{{ route('contacts.index') }}" class="btn btn-light shadow-sm" style="border-radius: 8px; font-weight: 600;">
                    <i class="fas fa-users me-2 text-secondary"></i> Contacts
                </a>
                <a href="{{ route('events.create') }}" class="btn btn-primary shadow-sm" style="background: #1479ff; border: none; border-radius: 8px; font-weight: 600;">
                    <i class="fas fa-plus me-2"></i> Create Event
                </a>
            </div>
        </div>

        <div class="row g-4">
            <!-- Left Column: Key Stats & Progress -->
            <div class="col-lg-4">
                
                <!-- Quick Stats Grid -->
                <div class="row g-3 mb-4">
                    <div class="col-6">
                        <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                            <div class="card-body p-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 36px; height: 36px; background: rgba(20, 121, 255, 0.1); color: #1479ff;">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h3 class="fw-bold mb-0 text-dark">{{ $totalUsers }}</h3>
                                <small class="text-muted fw-medium">Total Users</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                            <div class="card-body p-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 36px; height: 36px; background: rgba(37, 211, 102, 0.1); color: #25d366;">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <h3 class="fw-bold mb-0 text-dark">{{ $totalEvents }}</h3>
                                <small class="text-muted fw-medium">Total Events</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                            <div class="card-body p-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 36px; height: 36px; background: rgba(138, 43, 226, 0.1); color: #8a2be2;">
                                    <i class="fas fa-layer-group"></i>
                                </div>
                                <h3 class="fw-bold mb-0 text-dark">{{ $totalCategories }}</h3>
                                <small class="text-muted fw-medium">Categories</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card border-0 shadow-sm h-100" style="border-radius: 12px;">
                            <div class="card-body p-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 36px; height: 36px; background: rgba(0, 172, 239, 0.1); color: #00acef;">
                                    <i class="fas fa-qrcode"></i>
                                </div>
                                <h3 class="fw-bold mb-0 text-dark">{{ $scannedTotal }}</h3>
                                <small class="text-muted fw-medium">Total Scans</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Engagement Card -->
                <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-4 text-dark"><i class="fas fa-chart-pie me-2" style="color: #1479ff;"></i> RSVP Engagement</h6>
                        
                        <!-- Confirmed -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-secondary fw-medium" style="font-size: 14px;">Confirmed Guests</span>
                                <span class="fw-bold text-success">{{ $confirmedTotal }}</span>
                            </div>
                            <div class="progress" style="height: 8px; border-radius: 10px; background: #f1f5f9;">
                                @php
                                    $totalEngaged = max($confirmedTotal + $canceledTotal + $failedTotal, 1);
                                @endphp
                                <div class="progress-bar" role="progressbar" style="background: #25d366; width: {{ ($confirmedTotal / $totalEngaged) * 100 }}%;"></div>
                            </div>
                        </div>

                        <!-- Canceled -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-secondary fw-medium" style="font-size: 14px;">Canceled</span>
                                <span class="fw-bold text-danger">{{ $canceledTotal }}</span>
                            </div>
                            <div class="progress" style="height: 8px; border-radius: 10px; background: #f1f5f9;">
                                <div class="progress-bar" role="progressbar" style="background: #ea4335; width: {{ ($canceledTotal / $totalEngaged) * 100 }}%;"></div>
                            </div>
                        </div>

                        <!-- Failed -->
                        <div class="mb-2">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-secondary fw-medium" style="font-size: 14px;">Failed to send</span>
                                <span class="fw-bold" style="color: #f59e0b;">{{ $failedTotal }}</span>
                            </div>
                            <div class="progress" style="height: 8px; border-radius: 10px; background: #f1f5f9;">
                                <div class="progress-bar" role="progressbar" style="background: #f59e0b; width: {{ ($failedTotal / $totalEngaged) * 100 }}%;"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Right Column: Recent Events Timeline/List -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; background: #fff;">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4 d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-2">
                        <h6 class="fw-bold mb-0 text-dark"><i class="fas fa-clock me-2 text-primary"></i> Latest Events Activity</h6>
                        <a href="{{ route('events.index') }}" class="text-decoration-none fw-medium" style="color: #1479ff; font-size: 14px;">View All &rarr;</a>
                    </div>
                    <div class="card-body p-4">
                        @forelse($recentEvents as $event)
                        <div class="d-flex flex-column flex-sm-row align-items-start {{ !$loop->last ? 'mb-4 pb-4 border-bottom' : '' }}" style="border-color: #f1f5f9 !important;">
                            <!-- Date Block -->
                            <div class="text-center rounded me-sm-4 mb-3 mb-sm-0" style="width: 65px; background: #f8fafc; border: 1px solid #edf2f7; flex-shrink: 0; overflow: hidden;">
                                <div class="w-100 py-1" style="background: #1479ff; color: #fff; font-size: 11px; font-weight: 700; text-transform: uppercase;">
                                    {{ $event->date ? \Carbon\Carbon::parse($event->date)->format('M') : 'TBD' }}
                                </div>
                                <div class="py-2" style="font-size: 22px; font-weight: 800; color: #172033; line-height: 1;">
                                    {{ $event->date ? \Carbon\Carbon::parse($event->date)->format('d') : '-' }}
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="flex-grow-1 w-100">
                                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start mb-2 gap-2">
                                    <h6 class="fw-bold text-dark mb-0" style="font-size: 17px;">
                                        <a href="{{ route('events.edit', $event->id) }}" class="text-decoration-none text-dark hover-primary">{{ $event->name }}</a>
                                    </h6>
                                    @if($event->status == 'published')
                                        <span class="badge" style="background: rgba(37, 211, 102, 0.1); color: #25d366; font-size: 11px; font-weight: 600; padding: 5px 8px;">Published</span>
                                    @else
                                        <span class="badge" style="background: rgba(113, 131, 155, 0.1); color: #71839b; font-size: 11px; font-weight: 600; padding: 5px 8px;">Draft</span>
                                    @endif
                                </div>
                                
                                <p class="text-muted mb-3 pe-md-4" style="font-size: 14px; line-height: 1.5;">
                                    {{ $event->description ? Str::limit($event->description, 75) : 'No additional description provided for this event.' }}
                                </p>

                                <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-2 gap-sm-4">
                                    <div class="text-secondary" style="font-size: 13px; font-weight: 500;">
                                        <i class="far fa-clock me-1 text-primary"></i> 
                                        {{ $event->time ? \Carbon\Carbon::parse($event->time)->format('h:i A') : 'Time TBD' }}
                                    </div>
                                    <div class="text-secondary text-truncate" style="font-size: 13px; font-weight: 500; max-width: 100%;">
                                        <i class="fas fa-map-marker-alt me-1 text-danger"></i> 
                                        {{ $event->location ?: 'Location TBD' }}
                                    </div>
                                </div>
                            </div>

                        </div>
                        @empty
                        <div class="text-center py-5">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px; background: #f8fafc; color: #cbd5e1; font-size: 24px;">
                                <i class="fas fa-calendar-times"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-2">No Active Events</h5>
                            <p class="text-muted mb-4" style="font-size: 15px;">You haven't scheduled any events yet. Get started by creating your first event.</p>
                            <a href="{{ route('events.create') }}" class="btn btn-primary px-4 py-2" style="border-radius: 8px; font-weight: 600;"><i class="fas fa-plus me-2"></i> Create Your First Event</a>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@include('admin.layouts.footer')
