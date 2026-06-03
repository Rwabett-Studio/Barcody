@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <div class="content pt-3 contacts-page">
        <div class="contacts-page-head d-flex justify-content-between align-items-start border-bottom mainBordClr mb-lg-4 mb-0">
            <div>
                <h4 class="fw-bold mb-1">Edit Information Section</h4>
                <p class="mb-0">Update section copy, icons, and landing page images.</p>
            </div>
            <a href="{{ route('information-sections.index') }}" class="table-action-btn">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>

        <form action="{{ route('information-sections.update', ['information_section' => $information->id]) }}" method="POST" enctype="multipart/form-data" class="contact-form-shell contact-form-shell-full mt-4">
            @csrf
            @method('PUT')

            <div class="settings-section-title">
                <span class="contact-avatar bg-danger-subtle text-danger"><i class="fas fa-circle-info"></i></span>
                <div>
                    <h5>Section Details</h5>
                    <p>Current images stay in place unless replacements are selected.</p>
                </div>
            </div>

            <div class="contact-form-grid settings-form-grid">
                <div class="contact-field">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="contact-input" value="{{ old('name', $information->name) }}" required>
                </div>

                <div class="contact-field">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="contact-input" value="{{ old('title', $information->title) }}" required>
                </div>

                <div class="contact-field contact-field-full">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="contact-input" rows="5" required>{{ old('description', $information->description) }}</textarea>
                </div>
            </div>

            <div class="settings-section-title mt-4">
                <span class="contact-avatar bg-primary-subtle text-primary"><i class="fas fa-icons"></i></span>
                <div>
                    <h5>Feature Icons</h5>
                    <p>Add up to four icon/title pairs.</p>
                </div>
            </div>

            <div class="contact-form-grid settings-form-grid">
                @for ($i = 1; $i <= 4; $i++)
                    @php
                        $iconField = 'icon' . $i;
                        $titleField = 'title' . $i;
                    @endphp
                    <div class="contact-field">
                        <label for="{{ $titleField }}">Title {{ $i }}</label>
                        <input type="text" name="{{ $titleField }}" id="{{ $titleField }}" class="contact-input" value="{{ old($titleField, $information->{$titleField}) }}">
                    </div>

                    <div class="contact-field">
                        <label for="{{ $iconField }}">Icon {{ $i }}</label>
                        <div class="settings-upload-row">
                            <div class="settings-preview-box settings-preview-box-light">
                                <span id="{{ $iconField }}Placeholder" @if($information->{$iconField}) style="display:none;" @endif><i class="fas fa-image"></i></span>
                                <img id="{{ $iconField }}Preview" src="{{ $information->{$iconField} ? url('storage/' . $information->{$iconField}) : '' }}" alt="Icon {{ $i }} preview" @if(!$information->{$iconField}) style="display:none;" @endif>
                            </div>
                            <div class="flex-grow-1">
                                <input type="file" name="{{ $iconField }}" id="{{ $iconField }}" class="contact-file-input" accept="image/*" data-preview-target="#{{ $iconField }}Preview" data-placeholder-target="#{{ $iconField }}Placeholder">
                                <span class="contact-file-hint">Leave empty to keep the current icon.</span>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>

            @php
                $imageFields = [
                    'logo' => 'Logo',
                    'image_app1' => 'App Image 1',
                    'image_app2' => 'App Image 2',
                    'main_image' => 'Main Image',
                ];
            @endphp

            <div class="settings-section-title mt-4">
                <span class="contact-avatar bg-success-subtle text-success"><i class="fas fa-images"></i></span>
                <div>
                    <h5>Section Images</h5>
                    <p>Upload the logo and app visuals for this information block.</p>
                </div>
            </div>

            <div class="contact-form-grid settings-form-grid">
                @foreach ($imageFields as $field => $label)
                    <div class="contact-field">
                        <label for="{{ $field }}">{{ $label }}</label>
                        <div class="settings-upload-row">
                            <div class="settings-preview-box settings-preview-box-light">
                                <span id="{{ $field }}Placeholder" @if($information->{$field}) style="display:none;" @endif><i class="fas fa-image"></i></span>
                                <img id="{{ $field }}Preview" src="{{ $information->{$field} ? url('storage/' . $information->{$field}) : '' }}" alt="{{ $label }} preview" @if(!$information->{$field}) style="display:none;" @endif>
                            </div>
                            <div class="flex-grow-1">
                                <input type="file" name="{{ $field }}" id="{{ $field }}" class="contact-file-input" accept="image/*" data-preview-target="#{{ $field }}Preview" data-placeholder-target="#{{ $field }}Placeholder">
                                <span class="contact-file-hint">Leave empty to keep the current image.</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="contact-form-actions">
                <a href="{{ route('information-sections.index') }}" class="table-action-btn">Cancel</a>
                <button type="submit" class="btn blueBtn d-flex align-items-center">
                    <i class="fas fa-save"></i>
                    <span>Update</span>
                </button>
            </div>
        </form>
    </div>
</div>

@include('admin.layouts.footer')
