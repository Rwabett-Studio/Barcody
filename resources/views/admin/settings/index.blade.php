@include('admin.layouts.header')

    <div id="main" class="offset-lg-2">
    
    <!-- content -->
    <div class="content pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-4 pb-3">
            <h4 class="fw-bold mb-0">General Settings</h4>
            
            @if(count($settings) > 0 && Auth::user()->edit_role === 1)
            <a href="{{ route('settings.edit', $settings->first()->id) }}" class="btn btn-primary d-flex align-items-center gap-2" style="border-radius: 8px; font-weight: 600; padding: 8px 16px; box-shadow: 0 4px 6px rgba(20, 121, 255, 0.2);">
                <i class="fas fa-pen" style="font-size: 13px;"></i> Edit Settings
            </a>
            @endif
        </div>
        
        <div class="col-12 position-relative pt-1 mt-2">
            @foreach($settings as $setting)
            <div class="row">
                
                <!-- App Name -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 border-0" style="border-radius: 12px; box-shadow: 0 10px 20px rgba(34, 64, 105, 0.05); transition: transform 0.2s;">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; background: rgba(20, 121, 255, 0.1); color: #1479ff; font-size: 18px;">
                                    <i class="fas fa-font"></i>
                                </div>
                                <h6 class="fw-bold mb-0" style="color: #172033; font-size: 16px;">App Name</h6>
                            </div>
                            <div class="mt-4 pt-2 border-top">
                                <span class="fw-medium text-truncate d-block" style="color: #71839b; font-size: 15px;">{{ $setting->name ?: '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Location -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 border-0" style="border-radius: 12px; box-shadow: 0 10px 20px rgba(34, 64, 105, 0.05); transition: transform 0.2s;">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; background: rgba(234, 67, 53, 0.1); color: #ea4335; font-size: 18px;">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <h6 class="fw-bold mb-0" style="color: #172033; font-size: 16px;">Location</h6>
                            </div>
                            <div class="mt-4 pt-2 border-top">
                                <span class="fw-medium text-truncate d-block" style="color: #71839b; font-size: 15px;">{{ $setting->location ?: '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fav Icon -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 border-0" style="border-radius: 12px; box-shadow: 0 10px 20px rgba(34, 64, 105, 0.05); transition: transform 0.2s;">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; background: rgba(37, 211, 102, 0.1); color: #25d366; font-size: 18px;">
                                    <i class="fas fa-star"></i>
                                </div>
                                <h6 class="fw-bold mb-0" style="color: #172033; font-size: 16px;">Fav Icon</h6>
                            </div>
                            <div class="mt-4 pt-2 border-top">
                                @if($setting->fav_icon)
                                    <img src="{{ url('storage/' . $setting->fav_icon) }}" alt="Fav Icon" style="max-height: 40px; object-fit: contain;">
                                @else
                                    <span class="badge bg-light text-muted">No Icon</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Header Logo -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 border-0" style="border-radius: 12px; box-shadow: 0 10px 20px rgba(34, 64, 105, 0.05); transition: transform 0.2s;">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; background: rgba(24, 119, 242, 0.1); color: #1877f2; font-size: 18px;">
                                    <i class="fas fa-image"></i>
                                </div>
                                <h6 class="fw-bold mb-0" style="color: #172033; font-size: 16px;">Header Logo</h6>
                            </div>
                            <div class="mt-4 pt-3 border-top rounded p-2 text-center" style="background: #f8fafc;">
                                @if($setting->header_logo)
                                    <img src="{{ url('storage/' . $setting->header_logo) }}" alt="Header Logo" style="max-height: 50px; max-width: 100%; object-fit: contain;">
                                @else
                                    <span class="badge bg-light text-muted">No Logo</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Logo -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 border-0" style="border-radius: 12px; box-shadow: 0 10px 20px rgba(34, 64, 105, 0.05); transition: transform 0.2s;">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; background: rgba(29, 161, 242, 0.1); color: #1da1f2; font-size: 18px;">
                                    <i class="far fa-image"></i>
                                </div>
                                <h6 class="fw-bold mb-0" style="color: #172033; font-size: 16px;">Footer Logo</h6>
                            </div>
                            <div class="mt-4 pt-3 border-top rounded p-2 text-center" style="background: #f8fafc;">
                                @if($setting->footer_logo)
                                    <img src="{{ url('storage/' . $setting->footer_logo) }}" alt="Footer Logo" style="max-height: 50px; max-width: 100%; object-fit: contain;">
                                @else
                                    <span class="badge text-muted">No Logo</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @endforeach
        </div>
    </div>
    
    </div>
    
@include('admin.layouts.footer')
