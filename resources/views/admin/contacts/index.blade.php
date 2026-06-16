@include('admin.layouts.header')

    <div id="main" class="offset-lg-2">
    <div class="content pt-3 contacts-page">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0 pb-3">
            <h4 class="fw-bold mb-0">Contacts</h4>

            <div class="d-flex gap-2">
                <a href="{{ route('contacts.import.form') }}" class="d-flex align-items-center btn btn-light" style="font-weight: 600;">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-2">
                        <path d="M18.0249 12.2921C18.0249 13.0337 17.8166 13.7338 17.4499 14.3338C16.7666 15.4838 15.5083 16.2504 14.0666 16.2504C12.6249 16.2504 11.3666 15.4754 10.6833 14.3338C10.3166 13.7421 10.1083 13.0337 10.1083 12.2921C10.1083 10.1087 11.8833 8.33374 14.0666 8.33374C16.2499 8.33374 18.0249 10.1087 18.0249 12.2921Z" stroke="#809FB8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M15.55 12.2754H12.5917" stroke="#809FB8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M14.0667 10.8335V13.7918" stroke="#809FB8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M17.2416 3.35034V5.20032C17.2416 5.87532 16.8166 6.717 16.4 7.142L14.9333 8.43365C14.6583 8.36699 14.3666 8.33366 14.0666 8.33366C11.8833 8.33366 10.1083 10.1087 10.1083 12.292C10.1083 13.0337 10.3166 13.7337 10.6833 14.3337C10.9916 14.8503 11.4166 15.292 11.9333 15.6086V15.892C11.9333 16.4003 11.6 17.0753 11.175 17.3253L9.99997 18.0837C8.9083 18.7587 7.39163 18.0003 7.39163 16.6503V12.192C7.39163 11.6003 7.04997 10.842 6.71663 10.4253L3.51663 7.05863C3.09997 6.63363 2.7583 5.87534 2.7583 5.37534V3.43365C2.7583 2.42532 3.51663 1.66699 4.44163 1.66699H15.5583C16.4833 1.66699 17.2416 2.42534 17.2416 3.35034Z" stroke="#809FB8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>Import</span>
                </a>

                @if(Auth::user()->create_role === 1)
                <a href="{{ route('contacts.create') }}" class="d-flex align-items-center blueBtn">
                    <i class="fas fa-plus"></i> <span>Add New Contact</span>
                </a>
                @endif
            </div>
        </div>

        {{-- Bulk actions toolbar (appears when at least one guest is selected) --}}
        <div id="bulkActionsBar" class="d-none align-items-center gap-2 mb-3">
            <button type="button" id="bulkInviteBtn" class="btn btn-light d-flex align-items-center" style="font-weight:600;">
                <i class="fa-regular fa-envelope me-2"></i> Send an Invite To Selected
            </button>
            <button type="button" id="bulkDeleteBtn" class="btn btn-light d-flex align-items-center" style="font-weight:600;">
                <i class="fa-regular fa-trash-can me-2"></i> Delete Selected
            </button>
            <span class="text-muted ms-1"><span id="selectedCount">0</span> selected</span>
        </div>

        <div class="contacts-table-shell">
            <div class="table-responsive">
                <table id="contactTable" class="w-100 companyTable contacts-table">
                    <thead>
                        <tr>
                            <th>
                                <div class="checkboxes__row">
                                    <div class="checkboxes__item">
                                        <label class="checkbox style-b">
                                            <input type="checkbox" id="checkAll"/>
                                            <div class="checkbox__checkmark"></div>
                                        </label>
                                    </div>
                                </div>
                            </th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Event</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contacts as $contact)
                        @php
                            $initial = strtoupper(substr($contact->name ?? 'C', 0, 1));
                            $genderClass = $contact->gender === 'mr' ? 'contact-gender-mr' : 'contact-gender-mrs';
                        @endphp
                        <tr>
                            <td>
                                <div class="checkboxes__row">
                                    <div class="checkboxes__item">
                                        <label class="checkbox style-b">
                                            <input type="checkbox" class="contact-checkbox" data-contact-id="{{ $contact->id }}" data-invited="{{ $contact->invited ? 1 : 0 }}"/>
                                            <div class="checkbox__checkmark"></div>
                                        </label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="contact-name-cell">
                                    <div class="contact-avatar">{{ $initial }}</div>
                                    <div>
                                        <h6>{{ $contact->name ?? '-' }}</h6>
                                        <span>ID #{{ $contact->id }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="contact-badge {{ $genderClass }}">
                                    {{ ucfirst($contact->gender ?? '-') }}
                                </span>
                            </td>
                            <td>
                                <span class="contact-phone">{{ $contact->phone }}</span>
                            </td>
                            <td>
                                @if($contact->event)
                                    <span class="contact-badge contact-badge-event">{{ $contact->event->name }}</span>
                                @else
                                    <span class="contact-badge contact-badge-muted">No event</span>
                                @endif
                            </td>
                            <td>
                                <div class="table-action-group">
                                    @if(Auth::user()->edit_role === 1)
                                        <a href="{{ route('contacts.edit', $contact->id) }}" class="table-action-btn" title="Edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                    @endif
                                    @if(Auth::user()->delete_role === 1)
                                        <button
                                            type="button"
                                            class="table-action-btn is-danger js-contact-delete"
                                            data-bs-toggle="modal"
                                            data-bs-target="#contactDeleteModal"
                                            data-contact-name="{{ $contact->name ?? '-' }}"
                                            data-contact-phone="{{ $contact->phone }}"
                                            data-contact-event="{{ optional($contact->event)->name ?? 'No event' }}"
                                            data-contact-action="{{ route('contacts.destroy', $contact->id) }}"
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
                                    <i class="fa-regular fa-address-book"></i>
                                    <h6>No contacts yet</h6>
                                    <p>Add your first contact or import a list to get started.</p>
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

    <div class="modal fade contact-delete-modal" id="contactDeleteModal" tabindex="-1" aria-labelledby="contactDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <div>
                        <span class="dashboard-eyebrow">Delete contact</span>
                        <h5 class="modal-title fw-bold mb-0" id="contactDeleteModalLabel">Confirm Delete</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="contact-delete-copy">This contact will be removed from the list.</p>
                    <div class="contact-delete-card">
                        <div class="contact-delete-row">
                            <span>Name</span>
                            <strong id="deleteContactName">-</strong>
                        </div>
                        <div class="contact-delete-row">
                            <span>Phone</span>
                            <strong id="deleteContactPhone">-</strong>
                        </div>
                        <div class="contact-delete-row">
                            <span>Event</span>
                            <strong id="deleteContactEvent">-</strong>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn mainBtn2 light-primary" data-bs-dismiss="modal">Cancel</button>
                    <form id="contactDeleteForm" method="POST" class="m-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger contact-delete-confirm">Confirm Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const bar          = document.getElementById('bulkActionsBar');
    const countEl      = document.getElementById('selectedCount');
    const checkAll     = document.getElementById('checkAll');
    const inviteBtn    = document.getElementById('bulkInviteBtn');
    const deleteBtn    = document.getElementById('bulkDeleteBtn');
    const inviteUrl    = "{{ route('contacts.bulk.invite') }}";
    const deleteUrl    = "{{ route('contacts.bulk.delete') }}";
    const csrf         = "{{ csrf_token() }}";

    function boxes()    { return Array.from(document.querySelectorAll('.contact-checkbox')); }
    function selected() { return boxes().filter(b => b.checked); }

    function refresh() {
        const n = selected().length;
        countEl.textContent = n;
        bar.classList.toggle('d-none', n === 0);
        bar.classList.toggle('d-flex', n > 0);
    }

    document.addEventListener('change', function (e) {
        if (e.target.classList.contains('contact-checkbox')) refresh();
    });

    if (checkAll) {
        checkAll.addEventListener('change', function () {
            boxes().forEach(b => b.checked = checkAll.checked);
            refresh();
        });
    }

    function ids() { return selected().map(b => parseInt(b.dataset.contactId)); }

    function postJson(url, body) {
        return fetch(url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrf },
            body: JSON.stringify(body)
        }).then(r => r.json());
    }

    inviteBtn.addEventListener('click', function () {
        const contacts = ids();
        if (!contacts.length) return;
        const original = inviteBtn.innerHTML;
        inviteBtn.disabled = true;
        inviteBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Sending...';

        postJson(inviteUrl, { contacts })
            .then(res => {
                const s = res.summary || {};
                const msg = `تم الإرسال: ${s.sent || 0}\nمتخطّى (مدعو من قبل / بدون مناسبة): ${s.skipped || 0}\nفشل: ${s.failed || 0}`;
                if (window.Swal) {
                    Swal.fire('Invitations', msg.replace(/\n/g, '<br>'), (s.sent ? 'success' : 'info'));
                } else {
                    alert(msg);
                }
                // mark invited ones so they get skipped next time
                selected().forEach(b => b.dataset.invited = 1);
            })
            .catch(() => window.Swal ? Swal.fire('Error', 'فشل الإرسال', 'error') : alert('فشل الإرسال'))
            .finally(() => { inviteBtn.disabled = false; inviteBtn.innerHTML = original; });
    });

    deleteBtn.addEventListener('click', function () {
        const contacts = ids();
        if (!contacts.length) return;

        const doDelete = () => postJson(deleteUrl, { contacts }).then(() => window.location.reload());

        if (window.Swal) {
            Swal.fire({
                title: 'Delete selected?',
                text: `سيتم حذف ${contacts.length} مدعو.`,
                icon: 'warning', showCancelButton: true, confirmButtonColor: '#dc2626', confirmButtonText: 'Delete'
            }).then(r => { if (r.isConfirmed) doDelete(); });
        } else if (confirm(`Delete ${contacts.length} contacts?`)) {
            doDelete();
        }
    });

    refresh();
});
</script>

@include('admin.layouts.footer')
