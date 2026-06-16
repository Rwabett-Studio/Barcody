@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <div class="content pt-3 contacts-page">
        <div class="contacts-page-head d-flex justify-content-between align-items-start border-bottom mainBordClr mb-lg-4 mb-0">
            <div>
                <h4 class="fw-bold mb-1">Create Invitation Category</h4>
                <p class="mb-0">Add a new category image and title for invitations.</p>
            </div>
            <a href="{{ route('invitation-categories.index') }}" class="table-action-btn">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>

        <form action="{{ route('invitation-categories.store') }}" method="POST" enctype="multipart/form-data" class="contact-form-shell contact-form-shell-full mt-4">
            @csrf
            <div class="settings-section-title">
                <span class="contact-avatar bg-primary-subtle text-primary"><i class="fas fa-layer-group"></i></span>
                <div>
                    <h5>Category Details</h5>
                    <p>Use a clear title and a clean landing image.</p>
                </div>
            </div>

            <div class="contact-form-grid settings-form-grid">
                <div class="contact-field">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="contact-input" value="{{ old('title') }}" required>
                </div>

                <div class="contact-field">
                    <label for="image">Image</label>
                    <div class="settings-upload-row">
                        <div class="settings-preview-box settings-preview-box-light">
                            <span id="categoryImagePlaceholder"><i class="fas fa-image"></i></span>
                            <img id="categoryImagePreview" src="" alt="Category preview" style="display:none;">
                        </div>
                        <div class="flex-grow-1">
                            <input type="file" name="image" id="image" class="contact-file-input" accept="image/*" data-preview-target="#categoryImagePreview" data-placeholder-target="#categoryImagePlaceholder" required>
                            <span class="contact-file-hint">PNG, JPG, GIF, or SVG up to 2MB.</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contact-form-actions">
                <a href="{{ route('invitation-categories.index') }}" class="table-action-btn">Cancel</a>
                <button type="submit" class="btn blueBtn d-flex align-items-center">
                    <i class="fas fa-plus"></i>
                    <span>Create</span>
                </button>
            </div>
        </form>
    </div>
</div>

@include('admin.layouts.footer')
