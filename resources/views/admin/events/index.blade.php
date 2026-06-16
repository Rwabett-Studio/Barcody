@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <div class="content pt-3 contacts-page events-page">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">List of Events</h4>

            @if(Auth::user()->create_role === 1)
            <a href="{{ route('events.create') }}" class="d-flex align-items-center blueBtn">
                <i class="fas fa-plus"></i>
                <span>Add Event</span>
            </a>
            @endif
        </div>

        <div class="contacts-table-shell events-table-shell mt-4">
            <div class="table-responsive">
                <table id="contactTable" class="w-100 companyTable contacts-table events-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>User</th>
                            <th>QR Code</th>
                            <th>Date / Time</th>
                            <th>Status</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($events as $event)
                        @php
                            $initial = strtoupper(substr($event->name ?? 'E', 0, 1));
                            $isPublished = $event->status === 'published';
                        @endphp
                        <tr>
                            <td>
                                <a href="{{ route('event.detail', ['id' => $event->id]) }}" class="event-name-cell">
                                    <span class="contact-avatar event-avatar">{{ $initial }}</span>
                                    <span>
                                        <strong>{{ $event->name }}</strong>
                                        <small>ID #{{ $event->id }}</small>
                                    </span>
                                </a>
                            </td>
                            <td>
                                <span class="event-muted-text">{{ optional($event->user)->name ?? 'Unknown User' }}</span>
                            </td>
                            <td>
                                <button type="button" class="event-qr-btn" data-bs-toggle="modal" data-bs-target="#eventQrModal{{ $event->id }}">
                                    <i class="fa-solid fa-qrcode"></i>
                                    <span>View QR</span>
                                </button>
                            </td>
                            <td>
                                <div class="event-date-cell">
                                    <strong>{{ $event->date }}</strong>
                                    <span>{{ $event->time }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="contact-badge {{ $isPublished ? 'event-status-published' : 'event-status-draft' }}">
                                    <i class="fa-solid {{ $isPublished ? 'fa-check' : 'fa-clock' }}"></i>
                                    {{ ucfirst($event->status) }}
                                </span>
                            </td>
                            <td>
                                <span class="contact-badge contact-badge-event">{{ optional($event->category)->name ?? '-' }}</span>
                            </td>
                            <td>
                                <div class="table-action-group">
                                    @if(Auth::user()->edit_role === 1)
                                    <a href="{{ route('events.edit', $event->id) }}" class="table-action-btn" title="Edit">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    @endif

                                    @if(Auth::user()->delete_role === 1)
                                    <button
                                        type="button"
                                        class="table-action-btn is-danger js-event-delete"
                                        data-bs-toggle="modal"
                                        data-bs-target="#eventDeleteModal"
                                        data-event-name="{{ $event->name }}"
                                        data-event-date="{{ $event->date }} / {{ $event->time }}"
                                        data-event-category="{{ optional($event->category)->name ?? '-' }}"
                                        data-event-action="{{ route('events.destroy', $event->id) }}"
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
                            <td colspan="7">
                                <div class="table-empty">
                                    <i class="fa-regular fa-calendar"></i>
                                    <h6>No events yet</h6>
                                    <p>Create your first event to start managing invitations.</p>
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

@foreach($events as $event)
<div class="modal fade event-qr-modal" id="eventQrModal{{ $event->id }}" tabindex="-1" aria-labelledby="eventQrModalLabel{{ $event->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div>
                    <span class="dashboard-eyebrow">QR Code</span>
                    <h5 class="modal-title fw-bold mb-0" id="eventQrModalLabel{{ $event->id }}">{{ $event->name }}</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="event-qr-preview">
                    {!! $qrCodes[$event->id] ?? '' !!}
                </div>
                <div class="event-qr-meta">
                    <span>{{ $event->date }} / {{ $event->time }}</span>
                    <strong>{{ $event->location }}</strong>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<div class="modal fade contact-delete-modal" id="eventDeleteModal" tabindex="-1" aria-labelledby="eventDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div>
                    <span class="dashboard-eyebrow">Delete event</span>
                    <h5 class="modal-title fw-bold mb-0" id="eventDeleteModalLabel">Confirm Delete</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="contact-delete-copy">This event will be removed from the list.</p>
                <div class="contact-delete-card">
                    <div class="contact-delete-row">
                        <span>Name</span>
                        <strong id="deleteEventName">-</strong>
                    </div>
                    <div class="contact-delete-row">
                        <span>Date</span>
                        <strong id="deleteEventDate">-</strong>
                    </div>
                    <div class="contact-delete-row">
                        <span>Category</span>
                        <strong id="deleteEventCategory">-</strong>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn mainBtn2 light-primary" data-bs-dismiss="modal">Cancel</button>
                <form id="eventDeleteForm" method="POST" class="m-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger contact-delete-confirm">Confirm Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('admin.layouts.footer')
