@include('admin.layouts.header')

    <div id="main" class="offset-lg-2">
    
    <!-- content -->
    <div class="content pt-3 px-3 px-md-4">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center border-bottom mainBordClr mb-4 pb-3 gap-3">
            <h4 class="fw-bold mb-0" style="color: #172033; font-family: 'Outfit', sans-serif;">Support Settings</h4>

            @if(Auth::user()->create_role === 1)
            <a href="{{ route('supportsettings.create') }}" class="btn btn-primary shadow-sm" style="background: #1479ff; border: none; border-radius: 8px; font-weight: 600;">
                <i class="fas fa-plus me-2"></i> Add Support Setting
            </a>
            @endif
        </div>
        
        <div class="row g-4 pt-1">
            @forelse($supportsettings as $setting)
            <div class="col-md-6 col-xl-4">
                <div class="card h-100 border-0 shadow-sm" style="border-radius: 12px; transition: transform 0.2s, box-shadow 0.2s;">
                    <!-- Card Header: Name & Icon -->
                    <div class="card-header bg-white border-bottom-0 p-4 pb-2 d-flex align-items-center gap-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: rgba(20, 121, 255, 0.1); color: #1479ff; font-size: 20px; flex-shrink: 0;">
                            <i class="fas fa-headset"></i>
                        </div>
                        <div style="min-width: 0;">
                            <h5 class="fw-bold mb-0 text-dark text-truncate" style="font-size: 18px;">{{ $setting->name ?: 'Unnamed Support' }}</h5>
                            <span class="badge bg-light text-secondary mt-1 border" style="font-size: 11px;">Support Channel</span>
                        </div>
                    </div>

                    <!-- Card Body: Contact Details -->
                    <div class="card-body px-4 pt-3 pb-4">
                        <div class="d-flex flex-column gap-3">
                            <!-- Email -->
                            <div class="d-flex align-items-center gap-3">
                                <div class="text-center" style="width: 24px; color: #ea4335;"><i class="fas fa-envelope"></i></div>
                                <span class="text-secondary text-truncate" style="font-size: 14px;">{{ $setting->email ?: '-' }}</span>
                            </div>
                            
                            <!-- Phone -->
                            <div class="d-flex align-items-center gap-3">
                                <div class="text-center" style="width: 24px; color: #1479ff;"><i class="fas fa-phone-alt"></i></div>
                                <span class="text-secondary text-truncate" style="font-size: 14px;">{{ $setting->phone ?: '-' }}</span>
                            </div>
                            
                            <!-- WhatsApp -->
                            <div class="d-flex align-items-center gap-3">
                                <div class="text-center" style="width: 24px; color: #25d366;"><i class="fab fa-whatsapp"></i></div>
                                <span class="text-secondary text-truncate" style="font-size: 14px;">{{ $setting->whatsapp ?: '-' }}</span>
                            </div>

                            <!-- Social -->
                            <div class="d-flex align-items-center gap-3 mt-2 pt-3 border-top">
                                @if($setting->facebook)
                                    <a href="{{ $setting->facebook }}" target="_blank" class="text-decoration-none" style="color: #1877f2; font-size: 20px;" title="Facebook"><i class="fab fa-facebook"></i></a>
                                @else
                                    <span style="color: #cbd5e1; font-size: 20px;" title="No Facebook"><i class="fab fa-facebook"></i></span>
                                @endif

                                @if($setting->youtube)
                                    <a href="{{ $setting->youtube }}" target="_blank" class="text-decoration-none" style="color: #ff0000; font-size: 20px;" title="YouTube"><i class="fab fa-youtube"></i></a>
                                @else
                                    <span style="color: #cbd5e1; font-size: 20px;" title="No YouTube"><i class="fab fa-youtube"></i></span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Card Footer: Actions -->
                    <div class="card-footer bg-white p-3 border-top d-flex justify-content-end gap-2" style="border-radius: 0 0 12px 12px;">
                        @if(Auth::user()->edit_role === 1)
                        <a href="{{ route('supportsettings.edit', $setting->id) }}" class="btn btn-sm d-inline-flex align-items-center justify-content-center" style="width: 36px; height: 36px; border-radius: 8px; background: #f8fafc; color: #1479ff; border: 1px solid #e2e8f0; transition: all 0.2s;" title="Edit">
                            <i class="fas fa-pen"></i>
                        </a>
                        @endif

                        @if(Auth::user()->delete_role === 1)
                        <button type="button" 
                            class="btn btn-sm d-inline-flex align-items-center justify-content-center js-support-delete" 
                            style="width: 36px; height: 36px; border-radius: 8px; background: #fff1f2; color: #e11d48; border: 1px solid #ffe4e6; transition: all 0.2s;" 
                            title="Delete"
                            data-bs-toggle="modal"
                            data-bs-target="#supportDeleteModal"
                            data-action="{{ route('supportsettings.destroy', $setting->id) }}"
                            data-name="{{ $setting->name ?: 'Unnamed Support' }}"
                            data-channel="{{ $setting->email ?: $setting->phone ?: 'No direct contact' }}">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5 mt-4">
                <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; background: #f8fafc; color: #cbd5e1; font-size: 32px;">
                    <i class="fas fa-headset"></i>
                </div>
                <h5 class="fw-bold text-dark mb-2">No Support Channels</h5>
                <p class="text-muted mb-4" style="font-size: 15px;">You haven't configured any support settings yet.</p>
                @if(Auth::user()->create_role === 1)
                    <a href="{{ route('supportsettings.create') }}" class="btn btn-primary px-4 py-2" style="border-radius: 8px; font-weight: 600;"><i class="fas fa-plus me-2"></i> Add Support Setting</a>
                @endif
            </div>
            @endforelse
        </div>
    </div>
    
    </div>
    
<div class="modal fade contact-delete-modal" id="supportDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content contact-delete-card" style="border: none; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <div>
                    <h5 class="modal-title fw-bold text-dark">Delete Support Setting</h5>
                    <p class="contact-delete-message mb-0 text-muted" style="font-size: 14px;">Confirm before removing this channel.</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 py-4">
                <div class="contact-delete-row d-flex justify-content-between border-bottom pb-2 mb-2">
                    <span class="text-secondary">Name</span>
                    <strong id="deleteSupportName" class="text-dark">-</strong>
                </div>
                <div class="contact-delete-row d-flex justify-content-between">
                    <span class="text-secondary">Primary Channel</span>
                    <strong id="deleteSupportChannel" class="text-dark">-</strong>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0 px-4 pb-4 d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="border-radius: 8px; font-weight: 600;">Cancel</button>
                <form id="supportDeleteForm" method="POST" action="#">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="border-radius: 8px; font-weight: 600;">Confirm Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var deleteBtns = document.querySelectorAll('.js-support-delete');
        deleteBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var action = this.getAttribute('data-action');
                var name = this.getAttribute('data-name');
                var channel = this.getAttribute('data-channel');
                
                document.getElementById('supportDeleteForm').action = action;
                document.getElementById('deleteSupportName').textContent = name;
                document.getElementById('deleteSupportChannel').textContent = channel;
            });
        });
    });
</script>

@include('admin.layouts.footer')
