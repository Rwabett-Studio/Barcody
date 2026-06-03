@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <div class="content pt-3 contacts-page hero-form-page">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">Edit Hero Section</h4>
        </div>

        <div class="contact-form-shell contact-form-shell-full mt-4">
            <form action="{{ route('hero-sections.update', $heroSection->id) }}" method="POST" enctype="multipart/form-data" class="contact-form-grid settings-form-grid">
                @csrf
                @method('PUT')

                <input type="hidden" name="id" value="{{ $heroSection->id }}">

                <div class="settings-section-title">
                    <h6>Content</h6>
                    <p>Update the hero copy shown at the top of the landing page.</p>
                </div>

                <div class="contact-field">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control contact-input" value="{{ old('name', $heroSection->name) }}" placeholder="Enter internal name" required>
                </div>

                <div class="contact-field">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control contact-input" value="{{ old('title', $heroSection->title) }}" placeholder="Enter hero title" required>
                </div>

                <div class="contact-field contact-field-full">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control contact-input settings-textarea" rows="5" placeholder="Enter hero description" required>{{ old('description', $heroSection->description) }}</textarea>
                </div>

                <div class="settings-section-title contact-field-full">
                    <h6>Images</h6>
                    <p>Choose a new image only when you want to replace the existing one.</p>
                </div>

                <div class="contact-field contact-field-full">
                    <label for="main_image">Main Image</label>
                    <div class="settings-upload-row hero-upload-row">
                        <div class="settings-preview-box settings-preview-box-light hero-preview-box">
                            <img
                                id="hero_main_image_preview"
                                src="{{ $heroSection->main_image ? url('storage/' . $heroSection->main_image) : '' }}"
                                alt="Main Image"
                                @if(!$heroSection->main_image) style="display:none;" @endif
                            >
                            <i class="fa-regular fa-image" id="hero_main_image_placeholder" @if($heroSection->main_image) style="display:none;" @endif></i>
                        </div>
                        <div class="settings-upload-control">
                            <input type="file" name="main_image" id="main_image" class="form-control contact-input contact-file-input" accept="image/*" data-preview-target="#hero_main_image_preview" data-placeholder-target="#hero_main_image_placeholder">
                            <small class="contact-file-hint">Recommended formats: JPG, PNG, SVG</small>
                        </div>
                    </div>
                </div>

                <div class="contact-field">
                    <label for="image1">Image 1</label>
                    <div class="settings-upload-row hero-small-upload-row">
                        <div class="settings-preview-box settings-preview-box-light hero-small-preview-box">
                            <img
                                id="hero_image1_preview"
                                src="{{ $heroSection->image1 ? url('storage/' . $heroSection->image1) : '' }}"
                                alt="Image 1"
                                @if(!$heroSection->image1) style="display:none;" @endif
                            >
                            <i class="fa-regular fa-image" id="hero_image1_placeholder" @if($heroSection->image1) style="display:none;" @endif></i>
                        </div>
                        <div class="settings-upload-control">
                            <input type="file" name="image1" id="image1" class="form-control contact-input contact-file-input" accept="image/*" data-preview-target="#hero_image1_preview" data-placeholder-target="#hero_image1_placeholder">
                        </div>
                    </div>
                </div>

                <div class="contact-field">
                    <label for="image2">Image 2</label>
                    <div class="settings-upload-row hero-small-upload-row">
                        <div class="settings-preview-box settings-preview-box-light hero-small-preview-box">
                            <img
                                id="hero_image2_preview"
                                src="{{ $heroSection->image2 ? url('storage/' . $heroSection->image2) : '' }}"
                                alt="Image 2"
                                @if(!$heroSection->image2) style="display:none;" @endif
                            >
                            <i class="fa-regular fa-image" id="hero_image2_placeholder" @if($heroSection->image2) style="display:none;" @endif></i>
                        </div>
                        <div class="settings-upload-control">
                            <input type="file" name="image2" id="image2" class="form-control contact-input contact-file-input" accept="image/*" data-preview-target="#hero_image2_preview" data-placeholder-target="#hero_image2_placeholder">
                        </div>
                    </div>
                </div>

                <div class="contact-form-actions">
                    <a href="{{ route('hero-sections.index') }}" class="btn mainBtn2 light-primary">
                        <i class="fa-solid fa-arrow-left"></i>
                        <span>Back</span>
                    </a>
                    <button type="submit" class="btn blueBtn d-inline-flex align-items-center justify-content-center">
                        <i class="fas fa-save"></i>
                        <span>Update Hero</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.layouts.footer')
