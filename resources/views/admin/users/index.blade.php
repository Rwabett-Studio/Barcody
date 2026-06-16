@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <div class="content pt-3 contacts-page users-page">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">Users</h4>

            @if(Auth::user()->create_role === 1)
            <a href="{{ route('users.create') }}" class="d-flex align-items-center blueBtn">
                <i class="fas fa-plus"></i>
                <span>Add User</span>
            </a>
            @endif
        </div>

        <div class="contacts-table-shell users-table-shell mt-4">
            <div class="table-responsive">
                <table id="contactTable" class="w-100 companyTable contacts-table users-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Permissions</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        @php
                            $initial = strtoupper(substr($user->name ?? 'U', 0, 1));
                            $imageUrl = $user->image ? url('storage/' . $user->image) : null;
                        @endphp
                        <tr>
                            <td>
                                <div class="user-name-cell">
                                    @if($imageUrl)
                                        <img src="{{ $imageUrl }}" alt="{{ $user->name }}" class="user-table-avatar">
                                    @else
                                        <span class="contact-avatar user-table-avatar-fallback">{{ $initial }}</span>
                                    @endif
                                    <div>
                                        <strong>{{ $user->name }}</strong>
                                        <small>ID #{{ $user->id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="event-muted-text">{{ $user->email }}</span>
                            </td>
                            <td>
                                <span class="event-muted-text">{{ $user->phone ?: '-' }}</span>
                            </td>
                            <td>
                                <span class="contact-badge user-role-badge">{{ ucfirst($user->role) }}</span>
                            </td>
                            <td>
                                <div class="user-permission-list">
                                    <span class="{{ $user->create_role ? 'is-on' : '' }}">Create</span>
                                    <span class="{{ $user->edit_role ? 'is-on' : '' }}">Edit</span>
                                    <span class="{{ $user->delete_role ? 'is-on' : '' }}">Delete</span>
                                </div>
                            </td>
                            <td>
                                <div class="table-action-group">
                                    @if(Auth::user()->edit_role === 1)
                                    <a href="{{ route('users.edit', $user->id) }}" class="table-action-btn" title="Edit">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    @endif

                                    @if(Auth::user()->delete_role === 1)
                                    <button
                                        type="button"
                                        class="table-action-btn is-danger js-user-delete"
                                        data-bs-toggle="modal"
                                        data-bs-target="#userDeleteModal"
                                        data-user-name="{{ $user->name }}"
                                        data-user-email="{{ $user->email }}"
                                        data-user-role="{{ ucfirst($user->role) }}"
                                        data-user-action="{{ route('users.destroy', $user->id) }}"
                                        title="Delete"
                                    >
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">
                                <div class="table-empty">
                                    <i class="fa-regular fa-user"></i>
                                    <h6>No users yet</h6>
                                    <p>Add the first user to start assigning access.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade contact-delete-modal" id="userDeleteModal" tabindex="-1" aria-labelledby="userDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div>
                    <span class="dashboard-eyebrow">Delete user</span>
                    <h5 class="modal-title fw-bold mb-0" id="userDeleteModalLabel">Confirm Delete</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="contact-delete-copy">This user will be removed from the dashboard.</p>
                <div class="contact-delete-card">
                    <div class="contact-delete-row">
                        <span>Name</span>
                        <strong id="deleteUserName">-</strong>
                    </div>
                    <div class="contact-delete-row">
                        <span>Email</span>
                        <strong id="deleteUserEmail">-</strong>
                    </div>
                    <div class="contact-delete-row">
                        <span>Role</span>
                        <strong id="deleteUserRole">-</strong>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn mainBtn2 light-primary" data-bs-dismiss="modal">Cancel</button>
                <form id="userDeleteForm" method="POST" class="m-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger contact-delete-confirm">Confirm Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('admin.layouts.footer')
