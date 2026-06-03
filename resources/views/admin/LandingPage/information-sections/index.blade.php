@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <div class="content pt-3 contacts-page">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">Information Sections</h4>

            @if(Auth::user()->create_role === 1)
            <a href="{{ route('information-sections.create') }}" class="d-flex align-items-center blueBtn">
                <i class="fas fa-plus"></i>
                <span>Add Information</span>
            </a>
            @endif
        </div>

        <div class="contacts-table-shell mt-4">
            <div class="table-responsive">
                <table id="contactTable" class="w-100">
                    <thead>
                        <tr>
                            <th>Section</th>
                            <th>Title</th>
                            <th>Main Image</th>
                            <th style="width:17%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($informationSections as $info)
                            <tr>
                                <td>
                                    <div class="user-name-cell">
                                        <span class="contact-avatar bg-danger-subtle text-danger">
                                            <i class="fas fa-circle-info"></i>
                                        </span>
                                        <div>
                                            <strong>{{ $info->name }}</strong>
                                            <small>{{ Str::limit($info->description, 42) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ Str::limit($info->title, 55) }}</td>
                                <td>
                                    @if ($info->main_image)
                                        <img src="{{ url('storage/' . $info->main_image) }}" alt="{{ $info->name }}" class="hero-table-image">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="table-action-group">
                                        @if(Auth::user()->edit_role === 1)
                                            <a href="{{ route('information-sections.edit', $info->id) }}" class="table-action-btn">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                        @endif
                                        @if(Auth::user()->delete_role === 1)
                                            <button type="button"
                                                class="table-action-btn is-danger js-information-delete"
                                                data-bs-toggle="modal"
                                                data-bs-target="#informationDeleteModal"
                                                data-information-name="{{ $info->name }}"
                                                data-information-title="{{ $info->title }}"
                                                data-information-action="{{ route('information-sections.destroy', $info->id) }}">
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

<div class="modal fade contact-delete-modal" id="informationDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content contact-delete-card">
            <div class="modal-header border-0 pb-0">
                <div>
                    <h5 class="modal-title fw-bold">Delete Information</h5>
                    <p class="contact-delete-message mb-0">Confirm before removing this information section.</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="contact-delete-row">
                    <span>Name</span>
                    <strong id="deleteInformationName">-</strong>
                </div>
                <div class="contact-delete-row">
                    <span>Title</span>
                    <strong id="deleteInformationTitle">-</strong>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn modal-cancel-btn" data-bs-dismiss="modal">Cancel</button>
                <form id="informationDeleteForm" method="POST" action="#">
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
        var deleteBtns = document.querySelectorAll('.js-information-delete');
        deleteBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var action = this.getAttribute('data-information-action');
                var name = this.getAttribute('data-information-name');
                var title = this.getAttribute('data-information-title');
                
                document.getElementById('informationDeleteForm').action = action;
                document.getElementById('deleteInformationName').textContent = name || '-';
                document.getElementById('deleteInformationTitle').textContent = title || '-';
            });
        });
    });
</script>

@include('admin.layouts.footer')
