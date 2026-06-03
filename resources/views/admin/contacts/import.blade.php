@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <div class="content pt-3 contacts-page">
        <div class="contacts-page-head">
            <div class="contacts-page-title">
                <span class="dashboard-eyebrow">Contacts</span>
                <h4 class="mb-0 fw-bold">Import Contacts</h4>
            </div>
        </div>

        <div class="contact-form-shell contact-form-shell-full">
            <form action="{{ route('contacts.import') }}" method="POST" enctype="multipart/form-data" class="contact-form-grid">
                @csrf

                <div class="contact-field contact-field-full">
                    <label for="file">Upload File</label>
                    <input
                        type="file"
                        name="file"
                        class="form-control contact-input contact-file-input @error('file') is-invalid @enderror"
                        accept=".xlsx,.xls,.csv"
                        required
                    >
                    <small class="contact-file-hint">Accepted formats: XLSX, XLS, CSV</small>
                    @error('file')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="contact-field">
                    <label for="event_id">Event</label>
                    <select name="event_id" class="form-control contact-input @error('event_id') is-invalid @enderror" required>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}">{{ $event->name }}</option>
                        @endforeach
                    </select>
                    @error('event_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="contact-form-actions">
                    <a href="{{ route('contacts.index') }}" class="btn mainBtn2 light-primary">
                        <i class="fa-solid fa-arrow-left"></i>
                        <span>Back</span>
                    </a>
                    <button type="submit" class="btn blueBtn d-inline-flex align-items-center justify-content-center">
                        <i class="fas fa-file-import"></i>
                        <span>Import</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.layouts.footer')
