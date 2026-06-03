@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <div class="content pt-3 contacts-page">
        <div class="contacts-page-head">
            <div class="contacts-page-title">
                <span class="dashboard-eyebrow">Contacts</span>
                <h4 class="mb-0 fw-bold">Edit Contact</h4>
            </div>
        </div>

        <div class="contact-form-shell contact-form-shell-full">
            <form action="{{ route('contacts.update', $contact->id) }}" method="POST" class="contact-form-grid">
                @csrf
                @method('PUT')

                <div class="contact-field">
                    <label for="name">Name</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control contact-input @error('name') is-invalid @enderror"
                        value="{{ old('name', $contact->name) }}"
                        placeholder="Enter full name"
                        required
                    >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="contact-field">
                    <label for="gender">Gender</label>
                    <select name="gender" class="form-control contact-input @error('gender') is-invalid @enderror" required>
                        <option value="mr" {{ old('gender', $contact->gender) == 'mr' ? 'selected' : '' }}>MR</option>
                        <option value="mrs" {{ old('gender', $contact->gender) == 'mrs' ? 'selected' : '' }}>MRS</option>
                    </select>
                    @error('gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="contact-field">
                    <label for="phone">Phone</label>
                    <input
                        type="text"
                        name="phone"
                        class="form-control contact-input @error('phone') is-invalid @enderror"
                        value="{{ old('phone', $contact->phone) }}"
                        placeholder="Enter phone number"
                        required
                    >
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="contact-field">
                    <label for="event_id">Event</label>
                    <select name="event_id" class="form-control contact-input @error('event_id') is-invalid @enderror" required>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}" {{ old('event_id', $contact->event_id) == $event->id ? 'selected' : '' }}>
                                {{ $event->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('event_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="contact-form-actions">
                    <a href="{{ route('contacts.index') }}" class="btn mainBtn2 light-primary">
                        <i class="fa-solid fa-arrow-left"></i>
                        <span>Back</span>
                    </a>
                    <button type="submit" class="btn blueBtn d-inline-flex align-items-center justify-content-center">
                        <i class="fas fa-rotate-right"></i>
                        <span>Update Contact</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.layouts.footer')
