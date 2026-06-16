@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <div class="content pt-3 contacts-page events-form-page">
        <div class="contacts-page-head">
            <div class="contacts-page-title">
                <span class="dashboard-eyebrow">Events</span>
                <h4 class="mb-0 fw-bold">Add New Event</h4>
            </div>
        </div>

        <div class="contact-form-shell contact-form-shell-full event-form-shell">
            <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data" class="contact-form-grid event-form-grid">
                @csrf

                <div class="settings-section-title">
                    <h6>Event Details</h6>
                    <p>Set the main name, visual, and description guests will recognize.</p>
                </div>

                <div class="contact-field">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control contact-input @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Enter event name" required>
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="contact-field">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id" class="form-control contact-input @error('category_id') is-invalid @enderror" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="contact-field contact-field-full">
                    <label for="thumbnail_image">Thumbnail Image</label>
                    <div class="settings-upload-row event-upload-row">
                        <div class="settings-preview-box settings-preview-box-light event-preview-box">
                            <img id="event_thumbnail_preview" src="" alt="Thumbnail Image" style="display:none;">
                            <i class="fa-regular fa-image" id="event_thumbnail_placeholder"></i>
                        </div>
                        <div class="settings-upload-control">
                            <input
                                type="file"
                                name="thumbnail_image"
                                id="thumbnail_image"
                                class="form-control contact-input contact-file-input @error('thumbnail_image') is-invalid @enderror"
                                accept="image/*"
                                data-preview-target="#event_thumbnail_preview"
                                data-placeholder-target="#event_thumbnail_placeholder"
                            >
                            <small class="contact-file-hint">Recommended formats: JPG, PNG, GIF</small>
                            @error('thumbnail_image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="contact-field contact-field-full">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control contact-input settings-textarea @error('description') is-invalid @enderror" rows="4" placeholder="Add a short event description">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="settings-section-title contact-field-full">
                    <h6>Schedule & Location</h6>
                    <p>Add the date, time, venue, and map details used for guest coordination.</p>
                </div>

                <div class="contact-field">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" class="form-control contact-input @error('date') is-invalid @enderror" value="{{ old('date') }}" required>
                    @error('date')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="contact-field">
                    <label for="time">Time</label>
                    <input type="time" name="time" id="time" class="form-control contact-input @error('time') is-invalid @enderror" value="{{ old('time') }}" required>
                    @error('time')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="contact-field contact-field-full">
                    <label for="location">Location</label>
                    <input type="text" name="location" id="location" class="form-control contact-input @error('location') is-invalid @enderror" value="{{ old('location') }}" placeholder="Enter event location" required>
                    @error('location')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="contact-field contact-field-full">
                    <label for="maps">Maps</label>
                    <textarea name="maps" id="maps" class="form-control contact-input settings-textarea @error('maps') is-invalid @enderror" rows="4" placeholder="Paste map link or embed code">{{ old('maps') }}</textarea>
                    @error('maps')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="settings-section-title contact-field-full">
                    <h6>Publishing</h6>
                    <p>Choose whether this event is ready to publish or should remain a draft.</p>
                </div>

                <div class="contact-field">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control contact-input @error('status') is-invalid @enderror" required>
                        <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                @include('admin.events._wa_template_fields', ['event' => null])

                <div class="contact-form-actions">
                    <a href="{{ route('events.index') }}" class="btn mainBtn2 light-primary">
                        <i class="fa-solid fa-arrow-left"></i>
                        <span>Back</span>
                    </a>
                    <button type="submit" class="btn blueBtn d-inline-flex align-items-center justify-content-center">
                        <i class="fas fa-plus"></i>
                        <span>Create Event</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.layouts.footer')
