@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <div class="content pt-3 contacts-page">
        <div class="contacts-page-head d-flex justify-content-between align-items-start border-bottom mainBordClr mb-lg-4 mb-0">
            <div>
                <h4 class="fw-bold mb-1">Edit How To Use</h4>
                <p class="mb-0">Update the step copy or replace its image.</p>
            </div>
            <a href="{{ route('how-use-barcodies.index') }}" class="table-action-btn">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>

        <form action="{{ route('how-use-barcodies.update', $howUseBarcody->id) }}" method="POST" enctype="multipart/form-data" class="contact-form-shell contact-form-shell-full mt-4">
            @csrf
            @method('PUT')

            <div class="settings-section-title">
                <span class="contact-avatar bg-info-subtle text-info"><i class="fas fa-circle-question"></i></span>
                <div>
                    <h5>Guide Details</h5>
                    <p>Current media stays in place unless a new image is selected.</p>
                </div>
            </div>

            <div class="contact-form-grid settings-form-grid">
                <div class="contact-field">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="contact-input" value="{{ old('title', $howUseBarcody->title) }}" required>
                </div>

                <div class="contact-field contact-field-full">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="contact-input" rows="5" required>{{ old('description', $howUseBarcody->description) }}</textarea>
                </div>

                <div class="contact-field">
                    <label for="image">Image</label>
                    <div class="settings-upload-row">
                        <div class="settings-preview-box settings-preview-box-light">
                            <span id="howUseImagePlaceholder" @if($howUseBarcody->image) style="display:none;" @endif><i class="fas fa-image"></i></span>
                            <img id="howUseImagePreview" src="{{ $howUseBarcody->image ? url('storage/' . $howUseBarcody->image) : '' }}" alt="Guide preview" @if(!$howUseBarcody->image) style="display:none;" @endif>
                        </div>
                        <div class="flex-grow-1">
                            <input type="file" name="image" id="image" class="contact-file-input" accept="image/*" data-preview-target="#howUseImagePreview" data-placeholder-target="#howUseImagePlaceholder">
                            <span class="contact-file-hint">Leave empty to keep the current image.</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contact-form-actions">
                <a href="{{ route('how-use-barcodies.index') }}" class="table-action-btn">Cancel</a>
                <button type="submit" class="btn blueBtn d-flex align-items-center">
                    <i class="fas fa-save"></i>
                    <span>Update</span>
                </button>
            </div>
        </form>
    </div>
</div>

@include('admin.layouts.footer')
