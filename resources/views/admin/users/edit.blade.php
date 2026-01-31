@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <!-- content -->
    <div class="content pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">Edit User</h4>
        </div>
        <div class="col-12 position-relative pt-1">
    
            <div class="logFormDV center mb-lg-5 mb-2">
                <div class="clear"></div>
                <div class="col-lg-9 center pt-lg-5 pt-2">
                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="birthDay" class="form-label">Birth Date</label>
                                    <input type="date" class="form-control" id="birthDay" name="birthDay" value="{{ $user->birthDay ? \Carbon\Carbon::parse($user->birthDay)->format('Y-m-d') : '' }}">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="">Select Gender</option>
                                        <option value="male" {{ $user->gender === 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ $user->gender === 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ $user->gender === 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="image" class="form-label">Profile Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                    @if($user->image)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $user->image) }}" alt="Current profile image" style="max-width: 100px;">
                                            <p class="small text-muted mt-1">Current image</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="password" class="form-label">Password (Leave blank to keep current password)</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="position-relative">
                                    <label for="role" class="form-label">Role</label>
                                    <select class="form-control" id="role" name="role" required>
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="coordinator" {{ $user->role === 'coordinator' ? 'selected' : '' }}>Coordinator</option>
                                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="position-relative">
                                    <label class="form-label">Permissions</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="create_role" name="create_role" value="1" {{ $user->create_role ? 'checked' : '' }}>
                                        <label class="form-check-label" for="create_role">Create Permission</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="edit_role" name="edit_role" value="1" {{ $user->edit_role ? 'checked' : '' }}>
                                        <label class="form-check-label" for="edit_role">Edit Permission</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="delete_role" name="delete_role" value="1" {{ $user->delete_role ? 'checked' : '' }}>
                                        <label class="form-check-label" for="delete_role">Delete Permission</label>
                                    </div>
                                </div>
                            </div>
              
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn blueBtn d-flex w-100 align-items-center text-center justify-content-center">
                                    <span><i class="fas fa-arrow-right border-0"></i></span>
                                    <span>Update User</span>
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