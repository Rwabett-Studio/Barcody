@include('admin.layouts.header')

    <div id="main" class="offset-lg-2">
    
    <!-- content -->
    <div class="content pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-4 pb-3">
            <h4 class="fw-bold mb-0">SocialMedia</h4>
            
            @if(count($socialMedias) > 0 && Auth::user()->edit_role === 1)
            <a href="{{ route('SocialMedia.edit', $socialMedias->first()->id) }}" class="btn btn-primary d-flex align-items-center gap-2" style="border-radius: 8px; font-weight: 600; padding: 8px 16px; box-shadow: 0 4px 6px rgba(20, 121, 255, 0.2);">
                <i class="fas fa-pen" style="font-size: 13px;"></i> Edit Settings
            </a>
            @endif
        </div>
        
        <div class="col-12 position-relative pt-1 mt-2">
            @foreach($socialMedias as $socialMedia)
            <div class="row">
                @php
                    $items = [
                        ['title' => 'Email', 'value' => $socialMedia->email, 'icon' => 'fas fa-envelope', 'color' => '#ea4335', 'bg' => 'rgba(234, 67, 53, 0.1)'],
                        ['title' => 'Phone', 'value' => $socialMedia->phone, 'icon' => 'fas fa-phone-alt', 'color' => '#1479ff', 'bg' => 'rgba(20, 121, 255, 0.1)'],
                        ['title' => 'WhatsApp', 'value' => $socialMedia->whatsapp, 'icon' => 'fab fa-whatsapp', 'color' => '#25d366', 'bg' => 'rgba(37, 211, 102, 0.1)'],
                        ['title' => 'Facebook', 'value' => $socialMedia->facebook, 'icon' => 'fab fa-facebook-f', 'color' => '#1877f2', 'bg' => 'rgba(24, 119, 242, 0.1)'],
                        ['title' => 'YouTube', 'value' => $socialMedia->youtube, 'icon' => 'fab fa-youtube', 'color' => '#ff0000', 'bg' => 'rgba(255, 0, 0, 0.1)'],
                        ['title' => 'Twitter', 'value' => $socialMedia->twitter, 'icon' => 'fab fa-twitter', 'color' => '#1da1f2', 'bg' => 'rgba(29, 161, 242, 0.1)'],
                    ];
                @endphp

                @foreach($items as $item)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 border-0" style="border-radius: 12px; box-shadow: 0 10px 20px rgba(34, 64, 105, 0.05); transition: transform 0.2s;">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; background: {{ $item['bg'] }}; color: {{ $item['color'] }}; font-size: 18px;">
                                        <i class="{{ $item['icon'] }}"></i>
                                    </div>
                                    <h6 class="fw-bold mb-0" style="color: #172033; font-size: 16px;">{{ $item['title'] }}</h6>
                                </div>
                            </div>
                            <div class="mt-4 pt-2 border-top">
                                <span class="fw-medium text-truncate d-block" style="color: #71839b; font-size: 15px;">{{ $item['value'] ?: '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
    
    </div>
    
@include('admin.layouts.footer')
