@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <div class="content pt-3 contacts-page users-form-page">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">Edit User</h4>
        </div>

        <div class="contact-form-shell contact-form-shell-full mt-4">
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="contact-form-grid settings-form-grid">
                @csrf
                @method('PUT')

                <div class="settings-section-title">
                    <h6>Profile</h6>
                    <p>Update the user identity and contact details.</p>
                </div>

                <div class="contact-field">
                    <label for="name">Name</label>
                    <input type="text" class="form-control contact-input" id="name" name="name" value="{{ old('name', $user->name) }}" placeholder="Enter full name" required>
                </div>

                <div class="contact-field">
                    <label for="email">Email</label>
                    <input type="email" class="form-control contact-input" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Enter email address" required>
                </div>

                <div class="contact-field">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control contact-input" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Enter phone number" required>
                </div>

                <div class="contact-field">
                    <label for="birthDay">Birth Date</label>
                    <input type="date" class="form-control contact-input" id="birthDay" name="birthDay" value="{{ old('birthDay', $user->birthDay ? \Carbon\Carbon::parse($user->birthDay)->format('Y-m-d') : '') }}">
                </div>

                <div class="contact-field">
                    <label for="gender">Gender</label>
                    <select class="form-control contact-input" id="gender" name="gender">
                        <option value="">Select Gender</option>
                        <option value="male" {{ old('gender', $user->gender) === 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender', $user->gender) === 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender', $user->gender) === 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div class="contact-field contact-field-full">
                    <label for="image">Profile Image</label>
                    <div class="settings-upload-row user-upload-row">
                        <div class="settings-preview-box settings-preview-box-light user-preview-box">
                            <img
                                id="user_image_preview"
                                src="{{ $user->image ? url('storage/' . $user->image) : '' }}"
                                alt="Profile Image"
                                @if(!$user->image) style="display:none;" @endif
                            >
                            <i class="fa-regular fa-user" id="user_image_placeholder" @if($user->image) style="display:none;" @endif></i>
                        </div>
                        <div class="settings-upload-control">
                            <input type="file" class="form-control contact-input contact-file-input" id="image" name="image" accept="image/*" data-preview-target="#user_image_preview" data-placeholder-target="#user_image_placeholder">
                            <small class="contact-file-hint">Choose a new image only when you want to replace the current one.</small>
                        </div>
                    </div>
                </div>

                <div class="settings-section-title contact-field-full">
                    <h6>Access</h6>
                    <p>Update the role, password, and dashboard permissions.</p>
                </div>

                <div class="contact-field">
                    <label for="password">Password</label>
                    <input type="password" class="form-control contact-input" id="password" name="password" placeholder="Leave blank to keep current password">
                </div>

                <div class="contact-field">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" class="form-control contact-input" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password">
                </div>

                <div class="contact-field">
                    <label for="role">Role</label>
                    <select class="form-control contact-input" id="role" name="role" required>
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="coordinator" {{ old('role', $user->role) === 'coordinator' ? 'selected' : '' }}>Coordinator</option>
                        <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>

                <div class="contact-field contact-field-full">
                    <label>Permissions</label>
                    <div class="permission-card-grid">
                        <label class="permission-card">
                            <input type="checkbox" id="create_role" name="create_role" value="1" {{ old('create_role', $user->create_role) ? 'checked' : '' }}>
                            <span><i class="fa-solid fa-plus"></i></span>
                            <strong>Create</strong>
                        </label>
                        <label class="permission-card">
                            <input type="checkbox" id="edit_role" name="edit_role" value="1" {{ old('edit_role', $user->edit_role) ? 'checked' : '' }}>
                            <span><i class="fa-solid fa-pen"></i></span>
                            <strong>Edit</strong>
                        </label>
                        <label class="permission-card">
                            <input type="checkbox" id="delete_role" name="delete_role" value="1" {{ old('delete_role', $user->delete_role) ? 'checked' : '' }}>
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
                        <i class="fas fa-save"></i>
                        <span>Update User</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@include('admin.layouts.footer')
