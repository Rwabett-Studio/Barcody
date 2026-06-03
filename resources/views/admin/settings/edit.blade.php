@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <div class="content pt-3 contacts-page settings-page">
        <div class="contacts-page-head">
            <div class="contacts-page-title">
                <span class="dashboard-eyebrow">General Settings</span>
                <h4 class="mb-0 fw-bold">Edit System Settings</h4>
            </div>
        </div>

        <div class="contact-form-shell contact-form-shell-full settings-edit-form">
            <form action="{{ route('settings.update', $setting->id) }}" method="POST" enctype="multipart/form-data" class="contact-form-grid settings-form-grid">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" value="{{ $setting->id }}">

                    <div class="settings-section-title">
                        <h6>Brand identity</h6>
                        <p>Update the app name and the images shown across the dashboard and public pages.</p>
                    </div>

                    <div class="contact-field contact-field-full">
                        <label for="name">App Name</label>
                        <input type="text" name="name" id="name" class="form-control contact-input" value="{{ old('name', $setting->name) }}" required>
                    </div>

                    <div class="contact-field settings-upload-field">
                        <label for="fav_icon">Fav Icon</label>
                        <div class="settings-upload-row">
                            <div class="settings-preview-box">
                                <img
                                    id="fav_icon_preview"
                                    src="{{ $setting->fav_icon ? url('storage/' . $setting->fav_icon) : '' }}"
                                    alt="Fav Icon"
                                    @if(!$setting->fav_icon) style="display:none;" @endif
                                >
                                <i class="fa-regular fa-image" id="fav_icon_placeholder" @if($setting->fav_icon) style="display:none;" @endif></i>
                            </div>
                            <div class="settings-upload-control">
                                <input type="file" name="fav_icon" id="fav_icon" class="form-control contact-input contact-file-input" accept="image/*" data-preview-target="#fav_icon_preview" data-placeholder-target="#fav_icon_placeholder">
                                <small class="contact-file-hint">PNG, ICO, or SVG</small>
                            </div>
                        </div>
                    </div>

                    <div class="contact-field settings-upload-field">
                        <label for="header_logo">Header Logo</label>
                        <div class="settings-upload-row">
                            <div class="settings-preview-box settings-preview-box-light">
                                <img
                                    id="header_logo_preview"
                                    src="{{ $setting->header_logo ? url('storage/' . $setting->header_logo) : '' }}"
                                    alt="Header Logo"
                                    @if(!$setting->header_logo) style="display:none;" @endif
                                >
                                <i class="fa-regular fa-image" id="header_logo_placeholder" @if($setting->header_logo) style="display:none;" @endif></i>
                            </div>
                            <div class="settings-upload-control">
                                <input type="file" name="header_logo" id="header_logo" class="form-control contact-input contact-file-input" accept="image/*" data-preview-target="#header_logo_preview" data-placeholder-target="#header_logo_placeholder">
                                <small class="contact-file-hint">PNG, JPG, or SVG</small>
                            </div>
                        </div>
                    </div>

                    <div class="contact-field settings-upload-field">
                        <label for="footer_logo">Footer Logo</label>
                        <div class="settings-upload-row">
                            <div class="settings-preview-box settings-preview-box-light">
                                <img
                                    id="footer_logo_preview"
                                    src="{{ $setting->footer_logo ? url('storage/' . $setting->footer_logo) : '' }}"
                                    alt="Footer Logo"
                                    @if(!$setting->footer_logo) style="display:none;" @endif
                                >
                                <i class="fa-regular fa-image" id="footer_logo_placeholder" @if($setting->footer_logo) style="display:none;" @endif></i>
                            </div>
                            <div class="settings-upload-control">
                                <input type="file" name="footer_logo" id="footer_logo" class="form-control contact-input contact-file-input" accept="image/*" data-preview-target="#footer_logo_preview" data-placeholder-target="#footer_logo_placeholder">
                                <small class="contact-file-hint">PNG, JPG, or SVG with transparency</small>
                            </div>
                        </div>
                    </div>

                    <div class="settings-section-title contact-field-full">
                        <h6>Location</h6>
                        <p>Used in the contact and venue details shown to guests.</p>
                    </div>

                    <div class="contact-field">
                        <label for="location">Location</label>
                        <input type="text" name="location" id="location" class="form-control contact-input" value="{{ old('location', $setting->location) }}" placeholder="Enter location">
                    </div>

                    <div class="contact-field contact-field-full">
                        <label for="maps">Maps (Embed Code)</label>
                        <textarea name="maps" id="maps" class="form-control contact-input settings-textarea" rows="5" placeholder="Paste map embed code here">{{ old('maps', $setting->maps) }}</textarea>
                    </div>

                    <div class="contact-form-actions">
                        <a href="{{ route('settings.index') }}" class="btn mainBtn2 light-primary">
                            <i class="fas fa-arrow-left"></i>
                            <span>Back</span>
                        </a>
                        <button type="submit" class="btn blueBtn d-inline-flex align-items-center justify-content-center">
                            <i class="fas fa-save"></i>
                            <span>Save Settings</span>
                        </button>
                    </div>
                </form>
        </div>
    </div>
</div>

@include('admin.layouts.footer')
