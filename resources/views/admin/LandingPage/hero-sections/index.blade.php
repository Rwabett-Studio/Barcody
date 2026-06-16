@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <div class="content pt-3 contacts-page hero-sections-page">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">Hero Sections</h4>

            @if(Auth::user()->create_role === 1)
            <a href="{{ route('hero-sections.create') }}" class="d-flex align-items-center blueBtn">
                <i class="fas fa-plus"></i>
                <span>Add Hero Section</span>
            </a>
            @endif
        </div>

        <div class="contacts-table-shell hero-table-shell mt-4">
            <div class="table-responsive">
                <table id="contactTable" class="w-100 companyTable contacts-table hero-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Main Image</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($heroSections as $heroSection)
                        @php
                            $initial = strtoupper(substr($heroSection->name ?? 'H', 0, 1));
                            $mainImage = $heroSection->main_image ? url('storage/' . $heroSection->main_image) : null;
                        @endphp
                        <tr>
                            <td>
                                <div class="user-name-cell">
                                    <span class="contact-avatar hero-avatar">{{ $initial }}</span>
                                    <div>
                                        <strong>{{ $heroSection->name }}</strong>
                                        <small>ID #{{ $heroSection->id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="hero-title-text">{{ $heroSection->title }}</span>
                            </td>
                            <td>
                                @if($mainImage)
                                <img src="{{ $mainImage }}" alt="{{ $heroSection->name }}" class="hero-table-image">
                                @else
                                <span class="contact-badge contact-badge-muted">No image</span>
                                @endif
                            </td>
                            <td>
                                <span class="inbox-message-preview" title="{{ $heroSection->description }}">{{ $heroSection->description }}</span>
                            </td>
                            <td>
                                <div class="table-action-group">
                                    @if(Auth::user()->edit_role === 1)
                                    <a href="{{ route('hero-sections.edit', $heroSection->id) }}" class="table-action-btn" title="Edit">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    @endif

                                    @if(Auth::user()->delete_role === 1)
                                    <button
                                        type="button"
                                        class="table-action-btn is-danger js-hero-delete"
                                        data-bs-toggle="modal"
                                        data-bs-target="#heroDeleteModal"
                                        data-hero-name="{{ $heroSection->name }}"
                                        data-hero-title="{{ $heroSection->title }}"
                                        data-hero-action="{{ route('hero-sections.destroy', $heroSection->id) }}"
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
                                    <i class="fa-regular fa-image"></i>
                                    <h6>No hero sections yet</h6>
                                    <p>Add a hero section to manage the landing page first screen.</p>
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

<div class="modal fade contact-delete-modal" id="heroDeleteModal" tabindex="-1" aria-labelledby="heroDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <div>
                    <span class="dashboard-eyebrow">Delete hero</span>
                    <h5 class="modal-title fw-bold mb-0" id="heroDeleteModalLabel">Confirm Delete</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="contact-delete-copy">This hero section and its images will be removed.</p>
                <div class="contact-delete-card">
                    <div class="contact-delete-row">
                        <span>Name</span>
                        <strong id="deleteHeroName">-</strong>
                    </div>
                    <div class="contact-delete-row">
                        <span>Title</span>
                        <strong id="deleteHeroTitle">-</strong>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn mainBtn2 light-primary" data-bs-dismiss="modal">Cancel</button>
                <form id="heroDeleteForm" method="POST" class="m-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger contact-delete-confirm">Confirm Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var deleteBtns = document.querySelectorAll('.js-hero-delete');
        deleteBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var action = this.getAttribute('data-hero-action');
                var name = this.getAttribute('data-hero-name');
                var title = this.getAttribute('data-hero-title');
                
                document.getElementById('heroDeleteForm').action = action;
                document.getElementById('deleteHeroName').textContent = name || '-';
                document.getElementById('deleteHeroTitle').textContent = title || '-';
            });
        });
    });
</script>

@include('admin.layouts.footer')
