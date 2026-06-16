@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <div class="content pt-3 contacts-page inbox-page">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">Inbox List</h4>

            @if(Auth::user()->create_role === 1)
            <a href="{{ route('inboxlists.create') }}" class="d-flex align-items-center blueBtn">
                <i class="fas fa-plus"></i>
                <span>Add Inbox</span>
            </a>
            @endif
        </div>

        <div class="contacts-table-shell inbox-table-shell mt-4">
            <div class="table-responsive">
                <table id="contactTable" class="w-100 companyTable contacts-table inbox-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inboxlists as $inboxlist)
                        @php
                            $initial = strtoupper(substr($inboxlist->name ?? 'I', 0, 1));
                            $message = $inboxlist->message ?? '';
                        @endphp
                        <tr>
                            <td>
                                <div class="user-name-cell">
                                    <span class="contact-avatar inbox-avatar">{{ $initial }}</span>
                                    <div>
                                        <strong>{{ $inboxlist->name }}</strong>
                                        <small>ID #{{ $inboxlist->id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="event-muted-text">{{ $inboxlist->email }}</span>
                            </td>
                            <td>
                                <span class="event-muted-text">{{ $inboxlist->phone }}</span>
                            </td>
                            <td>
                                <span class="inbox-message-preview" title="{{ $message }}">{{ $message }}</span>
                            </td>
                            <td>
                                <div class="table-action-group">
                                    @if(Auth::user()->edit_role === 1)
                                    <a href="{{ route('inboxlists.edit', $inboxlist->id) }}" class="table-action-btn" title="Edit">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    @endif

                                    @if(Auth::user()->delete_role === 1)
                                    <button
                                        type="button"
                                        class="table-action-btn is-danger js-inbox-delete"
                                        data-bs-toggle="modal"
                                        data-bs-target="#inboxDeleteModal"
                                        data-inbox-name="{{ $inboxlist->name }}"
                                        data-inbox-email="{{ $inboxlist->email }}"
                                        data-inbox-phone="{{ $inboxlist->phone }}"
                                        data-inbox-message="{{ $message }}"
                                        data-inbox-action="{{ route('inboxlists.destroy', $inboxlist->id) }}"
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
                            <td colspan="5">
                                <div class="table-empty">
                                    <i class="fa-regular fa-envelope"></i>
                                    <h6>No inbox messages yet</h6>
                                    <p>Add a message or wait for new contact submissions.</p>
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

<div class="modal fade contact-delete-modal" id="inboxDeleteModal" tabindex="-1" aria-labelledby="inboxDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div>
                    <span class="dashboard-eyebrow">Delete inbox</span>
                    <h5 class="modal-title fw-bold mb-0" id="inboxDeleteModalLabel">Confirm Delete</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="contact-delete-copy">This inbox message will be removed from the dashboard.</p>
                <div class="contact-delete-card">
                    <div class="contact-delete-row">
                        <span>Name</span>
                        <strong id="deleteInboxName">-</strong>
                    </div>
                    <div class="contact-delete-row">
                        <span>Email</span>
                        <strong id="deleteInboxEmail">-</strong>
                    </div>
                    <div class="contact-delete-row">
                        <span>Phone</span>
                        <strong id="deleteInboxPhone">-</strong>
                    </div>
                    <div class="contact-delete-message">
                        <span>Message</span>
                        <p id="deleteInboxMessage">-</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn mainBtn2 light-primary" data-bs-dismiss="modal">Cancel</button>
                <form id="inboxDeleteForm" method="POST" class="m-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger contact-delete-confirm">Confirm Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('admin.layouts.footer')
