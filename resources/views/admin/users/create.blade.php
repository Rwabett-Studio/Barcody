@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <div class="content pt-3 contacts-page users-form-page">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">Add New User</h4>
        </div>

        <div class="contact-form-shell contact-form-shell-full mt-4">
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" class="contact-form-grid settings-form-grid">
                @csrf

                <div class="settings-section-title">
                    <h6>Profile</h6>
                    <p>Add the user identity and contact details.</p>
                </div>

                <div class="contact-field">
                    <label for="name">Name</label>
                    <input type="text" class="form-control contact-input" id="name" name="name" value="{{ old('name') }}" placeholder="Enter full name" required>
                </div>

                <div class="contact-field">
                    <label for="email">Email</label>
                    <input type="email" class="form-control contact-input" id="email" name="email" value="{{ old('email') }}" placeholder="Enter email address" required>
                </div>

                <div class="contact-field">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control contact-input" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Enter phone number" required>
                </div>

                <div class="contact-field">
                    <label for="birthDay">Birth Date</label>
                    <input type="date" class="form-control contact-input" id="birthDay" name="birthDay" value="{{ old('birthDay') }}">
                </div>

                <div class="contact-field">
                    <label for="gender">Gender</label>
                    <select class="form-control contact-input" id="gender" name="gender">
                        <option value="">Select Gender</option>
                        <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender') === 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div class="contact-field contact-field-full">
                    <label for="image">Profile Image</label>
                    <div class="settings-upload-row user-upload-row">
                        <div class="settings-preview-box settings-preview-box-light user-preview-box">
                            <img id="user_image_preview" src="" alt="Profile Image" style="display:none;">
                            <i class="fa-regular fa-user" id="user_image_placeholder"></i>
                        </div>
                        <div class="settings-upload-control">
                            <input type="file" class="form-control contact-input contact-file-input" id="image" name="image" accept="image/*" data-preview-target="#user_image_preview" data-placeholder-target="#user_image_placeholder">
                            <small class="contact-file-hint">Recommended formats: JPG, PNG, GIF</small>
                        </div>
                    </div>
                </div>

                <div class="settings-section-title contact-field-full">
                    <h6>Access</h6>
                    <p>Set the login password, role, and dashboard permissions.</p>
                </div>

                <div class="contact-field">
                    <label for="password">Password</label>
                    <input type="password" class="form-control contact-input" id="password" name="password" placeholder="Enter password" required>
                </div>

                <div class="contact-field">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" class="form-control contact-input" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" required>
                </div>

                <div class="contact-field">
                    <label for="role">Role</label>
                    <select class="form-control contact-input" id="role" name="role" required>
                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="coordinator" {{ old('role') === 'coordinator' ? 'selected' : '' }}>Coordinator</option>
                        <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>

                <div class="contact-field contact-field-full">
                    <label>Permissions</label>
                    <div class="permission-card-grid">
                        <label class="permission-card">
                            <input type="checkbox" id="create_role" name="create_role" value="1" {{ old('create_role') ? 'checked' : '' }}>
                            <span><i class="fa-solid fa-plus"></i></span>
                            <strong>Create</strong>
                        </label>
                        <label class="permission-card">
                            <input type="checkbox" id="edit_role" name="edit_role" value="1" {{ old('edit_role') ? 'checked' : '' }}>
                            <span><i class="fa-solid fa-pen"></i></span>
                            <strong>Edit</strong>
                        </label>
                        <label class="permission-card">
                            <input type="checkbox" id="delete_role" name="delete_role" value="1" {{ old('delete_role') ? 'checked' : '' }}>
                            <span><i class="fa-solid fa-trash"></i></span>
                            <strong>Delete</strong>
                        </label>
                    </div>
                </div>

                <div class="contact-form-actions">
                    <a href="{{ route('users.index') }}" class="btn mainBtn2 light-primary">
                        <i class="fa-solid fa-arrow-left"></i>
                        <span>Back</span>
                    </a>
                    <button type="submit" class="btn blueBtn d-inline-flex align-items-center justify-content-center">
                        <i class="fas fa-plus"></i>
                        <span>Create User</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.layouts.footer')
