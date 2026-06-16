@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <div class="content pt-3 contacts-page">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">How to Use Barcodies</h4>

            @if(Auth::user()->create_role === 1)
            <a href="{{ route('how-use-barcodies.create') }}" class="d-flex align-items-center blueBtn">
                <i class="fas fa-plus"></i>
                <span>Add Step</span>
            </a>
            @endif
        </div>

        <div class="contacts-table-shell mt-4">
            <div class="table-responsive">
                <table id="contactTable" class="w-100">
                    <thead>
                        <tr>
                            <th>Step</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th style="width:17%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($howUseBarcodies as $howUse)
                            <tr>
                                <td>
                                    <div class="user-name-cell">
                                        <span class="contact-avatar bg-info-subtle text-info">
                                            <i class="fas fa-circle-question"></i>
                                        </span>
                                        <div>
                                            <strong>{{ $howUse->title }}</strong>
                                            <small>Landing guide</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="inbox-message-preview">{{ Str::limit($howUse->description, 90) }}</span></td>
                                <td>
                                    @if ($howUse->image)
                                        <img src="{{ url('storage/' . $howUse->image) }}" alt="{{ $howUse->title }}" class="hero-table-image">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="table-action-group">
                                        @if(Auth::user()->edit_role === 1)
                                            <a href="{{ route('how-use-barcodies.edit', $howUse->id) }}" class="table-action-btn">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                        @endif
                                        @if(Auth::user()->delete_role === 1)
                                            <button type="button"
                                                class="table-action-btn is-danger js-how-use-delete"
                                                data-bs-toggle="modal"
                                                data-bs-target="#howUseDeleteModal"
                                                data-how-use-name="{{ $howUse->title }}"
                                                data-how-use-description="{{ Str::limit($howUse->description, 120) }}"
                                                data-how-use-action="{{ route('how-use-barcodies.destroy', $howUse->id) }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade contact-delete-modal" id="howUseDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content contact-delete-card">
            <div class="modal-header border-0 pb-0">
                <div>
                    <h5 class="modal-title fw-bold">Delete Step</h5>
                    <p class="contact-delete-message mb-0">Confirm before removing this guide step.</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="contact-delete-row">
                    <span>Title</span>
                    <strong id="deleteHowUseName">-</strong>
                </div>
                <div class="contact-delete-row">
                    <span>Description</span>
                    <strong id="deleteHowUseDescription">-</strong>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn modal-cancel-btn" data-bs-dismiss="modal">Cancel</button>
                <form id="howUseDeleteForm" method="POST" action="#">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn modal-delete-btn">Confirm delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var deleteBtns = document.querySelectorAll('.js-how-use-delete');
        deleteBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var action = this.getAttribute('data-how-use-action');
                var name = this.getAttribute('data-how-use-name');
                var description = this.getAttribute('data-how-use-description');
                
                document.getElementById('howUseDeleteForm').action = action;
                document.getElementById('deleteHowUseName').textContent = name || '-';
                document.getElementById('deleteHowUseDescription').textContent = description || '-';
            });
        });
    });
</script>

@include('admin.layouts.footer')
