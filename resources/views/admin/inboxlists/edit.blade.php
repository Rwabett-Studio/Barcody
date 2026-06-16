@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <div class="content pt-3 contacts-page inbox-form-page">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">Edit Inbox Message</h4>
        </div>

        <div class="contact-form-shell contact-form-shell-full mt-4">
            <form action="{{ route('inboxlists.update', $inboxlist->id) }}" method="POST" class="contact-form-grid settings-form-grid">
                @csrf
                @method('PUT')

                <div class="settings-section-title">
                    <h6>Contact Details</h6>
                    <p>Update sender details and message content.</p>
                </div>

                <div class="contact-field">
                    <label for="name">Name</label>
                    <input type="text" class="form-control contact-input" id="name" name="name" value="{{ old('name', $inboxlist->name) }}" placeholder="Enter sender name" required>
                </div>

                <div class="contact-field">
                    <label for="email">Email</label>
                    <input type="email" class="form-control contact-input" id="email" name="email" value="{{ old('email', $inboxlist->email) }}" placeholder="Enter email address" required>
                </div>

                <div class="contact-field">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control contact-input" id="phone" name="phone" value="{{ old('phone', $inboxlist->phone) }}" placeholder="Enter phone number" required>
                </div>

                <div class="contact-field contact-field-full">
                    <label for="message">Message</label>
                    <textarea class="form-control contact-input settings-textarea" id="message" name="message" rows="5" placeholder="Enter message" required>{{ old('message', $inboxlist->message) }}</textarea>
                </div>

                <div class="contact-form-actions">
                    <a href="{{ route('inboxlists.index') }}" class="btn mainBtn2 light-primary">
                        <i class="fa-solid fa-arrow-left"></i>
                        <span>Back</span>
                    </a>
                    <button type="submit" class="btn blueBtn d-inline-flex align-items-center justify-content-center">
                        <i class="fas fa-save"></i>
                        <span>Update Message</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.layouts.footer')
