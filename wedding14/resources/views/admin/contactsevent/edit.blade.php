@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <!-- content -->
    <div class="content pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">Edit Contact</h4>
        </div>
        <div class="col-12 position-relative pt-1">
            <div class="logFormDV center mb-lg-5 mb-2">
                <div class="clear"></div>
                <div class="col-lg-9 center pt-lg-5 pt-2">
                    <form action="{{ route('event.contacts.update', ['event' => $event->id, 'contact' => $contact->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <!-- Name -->
                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                           value="{{ old('name', $contact->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>                 
                            </div>

                            <!-- Gender -->
                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="gender">Gender</label>
                                    <select name="gender" class="form-control @error('gender') is-invalid @enderror" required>
                                        <option value="mr" {{ old('gender', $contact->gender) == 'mr' ? 'selected' : '' }}>MR</option>
                                        <option value="mrs" {{ old('gender', $contact->gender) == 'mrs' ? 'selected' : '' }}>MRS</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                                           value="{{ old('phone', $contact->phone) }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>                 
                            </div>

                            <!-- Hidden Event ID (since we're already in the event context) -->
                            <input type="hidden" name="event_id" value="{{ $event->id }}">

                            <!-- Display Event Name (readonly) -->
                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="event_name">Event</label>
                                    <input type="text" class="form-control" 
                                           value="{{ $event->name }}" readonly>
                                    <small class="text-muted">Contacts cannot be moved between events. Delete and recreate if needed.</small>
                                </div>                 
                            </div>

                            <!-- Submit Button -->
                            <div class="col-12">
                                <button type="submit" class="btn blueBtn d-flex w-100 d-flex align-items-center text-center justify-content-center">
                                    <span><i class="fas fa-arrow-right border-0"></i></span>
                                    <span>Update</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.layouts.footer')