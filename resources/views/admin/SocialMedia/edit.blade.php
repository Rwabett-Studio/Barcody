@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <div class="content pt-3 contacts-page">
        <div class="contacts-page-head">
            <div class="contacts-page-title">
                <span class="dashboard-eyebrow">Social Media & Contacts</span>
                <h4 class="mb-0 fw-bold">Edit Settings</h4>
            </div>
        </div>

        <div class="contact-form-shell contact-form-shell-full">
            <form action="{{ route('SocialMedia.update', $socialMedia->id) }}" method="POST" class="contact-form-grid">
                @csrf
                @method('PUT')

                <div class="contact-field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control contact-input" value="{{ $socialMedia->email }}" required>
                </div>

                <div class="contact-field">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone" class="form-control contact-input" value="{{ $socialMedia->phone }}" required>
                </div>

                <div class="contact-field">
                    <label for="whatsapp">WhatsApp</label>
                    <input type="text" id="whatsapp" name="whatsapp" class="form-control contact-input" value="{{ $socialMedia->whatsapp }}">
                </div>

                <div class="contact-field">
                    <label for="facebook">Facebook</label>
                    <input type="text" id="facebook" name="facebook" class="form-control contact-input" value="{{ $socialMedia->facebook }}">
                </div>

                <div class="contact-field">
                    <label for="youtube">YouTube</label>
                    <input type="text" id="youtube" name="youtube" class="form-control contact-input" value="{{ $socialMedia->youtube }}">
                </div>

                <div class="contact-field">
                    <label for="twitter">Twitter</label>
                    <input type="text" id="twitter" name="twitter" class="form-control contact-input" value="{{ $socialMedia->twitter }}">
                </div>

                <div class="contact-form-actions">
                    <a href="{{ route('SocialMedia.index') }}" class="btn mainBtn2 light-primary">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back</span>
                    </a>
                    <button type="submit" class="btn blueBtn d-inline-flex align-items-center justify-content-center">
                        <i class="fas fa-save"></i>
                        <span>Save Changes</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.layouts.footer')
