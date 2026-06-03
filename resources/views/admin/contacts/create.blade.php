@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <div class="content pt-3 contacts-page">
        <div class="contacts-page-head">
            <div class="contacts-page-title">
                <span class="dashboard-eyebrow">Contacts</span>
                <h4 class="mb-0 fw-bold">Add New Contact</h4>
            </div>
        </div>

        <div class="contact-form-shell contact-form-shell-full">
            <form action="{{ route('contacts.store') }}" method="POST" class="contact-form-grid">
                @csrf

                <div class="contact-field">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control contact-input" placeholder="Enter full name" required>
                </div>

                <div class="contact-field">
                    <label for="gender">Gender</label>
                    <select name="gender" class="form-control contact-input" required>
                        <option value="mr">MR</option>
                        <option value="mrs">MRS</option>
                    </select>
                </div>

                <div class="contact-field">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" class="form-control contact-input" placeholder="Enter phone number" required>
                </div>

                <div class="contact-field">
                    <label for="event_id">Event</label>
                    <select name="event_id" class="form-control contact-input" required>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}">{{ $event->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="contact-form-actions">
                    <a href="{{ route('contacts.index') }}" class="btn mainBtn2 light-primary">
                        <i class="fa-solid fa-arrow-left"></i>
                        <span>Back</span>
                    </a>
                    <button type="submit" class="btn blueBtn d-inline-flex align-items-center justify-content-center">
                        <i class="fas fa-plus"></i>
                        <span>Create Contact</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.layouts.footer')
