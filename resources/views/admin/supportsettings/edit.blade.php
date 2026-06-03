@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <div class="content pt-3 px-3 px-md-4">
        
        <!-- Header -->
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-4 gap-3">
            <div>
                <h4 class="fw-bold mb-1" style="color: #172033; font-family: 'Outfit', sans-serif;">Edit Support Setting</h4>
                <p class="text-muted mb-0" style="font-size: 14px;">Update contact details for {{ $supportsetting->name }}.</p>
            </div>
            <a href="{{ route('supportsettings.index') }}" class="btn btn-light shadow-sm" style="border-radius: 8px; font-weight: 600;">
                <i class="fas fa-arrow-left me-2 text-secondary"></i> Back
            </a>
        </div>

        <div class="contact-form-shell shadow-sm" style="border-radius: 12px; border: 1px solid #edf2f7; background: #fff; padding: 30px;">
            <form action="{{ route('supportsettings.update', $supportsetting->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <h5 class="fw-bold mb-4" style="color: #172033;"><i class="fas fa-info-circle me-2 text-primary"></i> Contact Details</h5>
                
                <div class="contact-form-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                    <!-- Name -->
                    <div class="form-group">
                        <label for="name" class="form-label text-secondary fw-medium" style="font-size: 13px;">Channel Name <span class="text-danger">*</span></label>
                        <div class="input-group shadow-sm" style="border-radius: 8px;">
                            <span class="input-group-text bg-light border-end-0 text-secondary" style="border-radius: 8px 0 0 8px;"><i class="fas fa-headset"></i></span>
                            <input type="text" class="form-control border-start-0 ps-0" id="name" name="name" value="{{ $supportsetting->name }}" placeholder="e.g., Technical Support" style="border-radius: 0 8px 8px 0; box-shadow: none;" required>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email" class="form-label text-secondary fw-medium" style="font-size: 13px;">Email Address <span class="text-danger">*</span></label>
                        <div class="input-group shadow-sm" style="border-radius: 8px;">
                            <span class="input-group-text bg-light border-end-0" style="border-radius: 8px 0 0 8px; color: #ea4335;"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control border-start-0 ps-0" id="email" name="email" value="{{ $supportsetting->email }}" placeholder="support@example.com" style="border-radius: 0 8px 8px 0; box-shadow: none;" required>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="form-group">
                        <label for="phone" class="form-label text-secondary fw-medium" style="font-size: 13px;">Phone Number <span class="text-danger">*</span></label>
                        <div class="input-group shadow-sm" style="border-radius: 8px;">
                            <span class="input-group-text bg-light border-end-0" style="border-radius: 8px 0 0 8px; color: #1479ff;"><i class="fas fa-phone-alt"></i></span>
                            <input type="text" class="form-control border-start-0 ps-0" id="phone" name="phone" value="{{ $supportsetting->phone }}" placeholder="+1 234 567 8900" style="border-radius: 0 8px 8px 0; box-shadow: none;" required>
                        </div>
                    </div>

                    <!-- WhatsApp -->
                    <div class="form-group">
                        <label for="whatsapp" class="form-label text-secondary fw-medium" style="font-size: 13px;">WhatsApp</label>
                        <div class="input-group shadow-sm" style="border-radius: 8px;">
                            <span class="input-group-text bg-light border-end-0" style="border-radius: 8px 0 0 8px; color: #25d366;"><i class="fab fa-whatsapp"></i></span>
                            <input type="text" class="form-control border-start-0 ps-0" id="whatsapp" name="whatsapp" value="{{ $supportsetting->whatsapp }}" placeholder="+1 234 567 8900" style="border-radius: 0 8px 8px 0; box-shadow: none;">
                        </div>
                    </div>
                </div>

                <hr class="my-5 border-light">
                <h5 class="fw-bold mb-4" style="color: #172033;"><i class="fas fa-hashtag me-2 text-primary"></i> Social Media Links</h5>

                <div class="contact-form-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                    <!-- Facebook -->
                    <div class="form-group">
                        <label for="facebook" class="form-label text-secondary fw-medium" style="font-size: 13px;">Facebook URL</label>
                        <div class="input-group shadow-sm" style="border-radius: 8px;">
                            <span class="input-group-text bg-light border-end-0" style="border-radius: 8px 0 0 8px; color: #1877f2;"><i class="fab fa-facebook-f"></i></span>
                            <input type="text" class="form-control border-start-0 ps-0" id="facebook" name="facebook" value="{{ $supportsetting->facebook }}" placeholder="https://facebook.com/..." style="border-radius: 0 8px 8px 0; box-shadow: none;">
                        </div>
                    </div>

                    <!-- YouTube -->
                    <div class="form-group">
                        <label for="youtube" class="form-label text-secondary fw-medium" style="font-size: 13px;">YouTube URL</label>
                        <div class="input-group shadow-sm" style="border-radius: 8px;">
                            <span class="input-group-text bg-light border-end-0" style="border-radius: 8px 0 0 8px; color: #ff0000;"><i class="fab fa-youtube"></i></span>
                            <input type="text" class="form-control border-start-0 ps-0" id="youtube" name="youtube" value="{{ $supportsetting->youtube }}" placeholder="https://youtube.com/..." style="border-radius: 0 8px 8px 0; box-shadow: none;">
                        </div>
                    </div>

                    <!-- Twitter -->
                    <div class="form-group">
                        <label for="twitter" class="form-label text-secondary fw-medium" style="font-size: 13px;">Twitter URL</label>
                        <div class="input-group shadow-sm" style="border-radius: 8px;">
                            <span class="input-group-text bg-light border-end-0 text-secondary" style="border-radius: 8px 0 0 8px;"><i class="fab fa-twitter"></i></span>
                            <input type="text" class="form-control border-start-0 ps-0" id="twitter" name="twitter" value="{{ $supportsetting->twitter }}" placeholder="https://twitter.com/..." style="border-radius: 0 8px 8px 0; box-shadow: none;">
                        </div>
                    </div>

                    <!-- Instagram -->
                    <div class="form-group">
                        <label for="instagram" class="form-label text-secondary fw-medium" style="font-size: 13px;">Instagram URL</label>
                        <div class="input-group shadow-sm" style="border-radius: 8px;">
                            <span class="input-group-text bg-light border-end-0" style="border-radius: 8px 0 0 8px; color: #e1306c;"><i class="fab fa-instagram"></i></span>
                            <input type="text" class="form-control border-start-0 ps-0" id="instagram" name="instagram" value="{{ $supportsetting->instagram }}" placeholder="https://instagram.com/..." style="border-radius: 0 8px 8px 0; box-shadow: none;">
                        </div>
                    </div>

                    <!-- Dribbble -->
                    <div class="form-group">
                        <label for="dribbble" class="form-label text-secondary fw-medium" style="font-size: 13px;">Dribbble URL</label>
                        <div class="input-group shadow-sm" style="border-radius: 8px;">
                            <span class="input-group-text bg-light border-end-0" style="border-radius: 8px 0 0 8px; color: #ea4c89;"><i class="fab fa-dribbble"></i></span>
                            <input type="text" class="form-control border-start-0 ps-0" id="dribbble" name="dribbble" value="{{ $supportsetting->dribbble }}" placeholder="https://dribbble.com/..." style="border-radius: 0 8px 8px 0; box-shadow: none;">
                        </div>
                    </div>

                    <!-- Behance -->
                    <div class="form-group">
                        <label for="behance" class="form-label text-secondary fw-medium" style="font-size: 13px;">Behance URL</label>
                        <div class="input-group shadow-sm" style="border-radius: 8px;">
                            <span class="input-group-text bg-light border-end-0" style="border-radius: 8px 0 0 8px; color: #1769ff;"><i class="fab fa-behance"></i></span>
                            <input type="text" class="form-control border-start-0 ps-0" id="behance" name="behance" value="{{ $supportsetting->behance }}" placeholder="https://behance.net/..." style="border-radius: 0 8px 8px 0; box-shadow: none;">
                        </div>
                    </div>
                </div>

                <div class="mt-5 pt-3 border-top text-end">
                    <button type="submit" class="btn btn-primary px-5 py-2 shadow-sm" style="background: #1479ff; border: none; border-radius: 8px; font-weight: 600;">
                        <i class="fas fa-save me-2"></i> Update Support Setting
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.layouts.footer')
