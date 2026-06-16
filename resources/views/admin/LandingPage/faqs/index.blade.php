@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <div class="content pt-3 contacts-page">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">FAQs</h4>

            @if(Auth::user()->create_role === 1)
            <a href="{{ route('faqs.create') }}" class="d-flex align-items-center blueBtn">
                <i class="fas fa-plus"></i>
                <span>Add FAQ</span>
            </a>
            @endif
        </div>

        <div class="contacts-table-shell mt-4">
            <div class="table-responsive">
                <table id="contactTable" class="w-100">
                    <thead>
                        <tr>
                            <th>Question</th>
                            <th>Answer</th>
                            <th style="width:17%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($faqs as $faq)
                            <tr>
                                <td>
                                    <div class="user-name-cell">
                                        <span class="contact-avatar bg-warning-subtle text-warning">
                                            <i class="fas fa-question"></i>
                                        </span>
                                        <div>
                                            <strong>{{ Str::limit($faq->question, 55) }}</strong>
                                            <small>FAQ item</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="inbox-message-preview">{{ Str::limit($faq->answer, 100) }}</span></td>
                                <td>
                                    <div class="table-action-group">
                                        @if(Auth::user()->edit_role === 1)
                                            <a href="{{ route('faqs.edit', $faq->id) }}" class="table-action-btn">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                        @endif
                                        @if(Auth::user()->delete_role === 1)
                                            <button type="button"
                                                class="table-action-btn is-danger js-faq-delete"
                                                data-bs-toggle="modal"
                                                data-bs-target="#faqDeleteModal"
                                                data-faq-question="{{ Str::limit($faq->question, 120) }}"
                                                data-faq-answer="{{ Str::limit($faq->answer, 120) }}"
                                                data-faq-action="{{ route('faqs.destroy', $faq->id) }}">
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

<div class="modal fade contact-delete-modal" id="faqDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content contact-delete-card">
            <div class="modal-header border-0 pb-0">
                <div>
                    <h5 class="modal-title fw-bold">Delete FAQ</h5>
                    <p class="contact-delete-message mb-0">Confirm before removing this question.</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="contact-delete-row">
                    <span>Question</span>
                    <strong id="deleteFaqQuestion">-</strong>
                </div>
                <div class="contact-delete-row">
                    <span>Answer</span>
                    <strong id="deleteFaqAnswer">-</strong>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn modal-cancel-btn" data-bs-dismiss="modal">Cancel</button>
                <form id="faqDeleteForm" method="POST" action="#">
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
        var deleteBtns = document.querySelectorAll('.js-faq-delete');
        deleteBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var action = this.getAttribute('data-faq-action');
                var question = this.getAttribute('data-faq-question');
                var answer = this.getAttribute('data-faq-answer');
                
                document.getElementById('faqDeleteForm').action = action;
                document.getElementById('deleteFaqQuestion').textContent = question || '-';
                document.getElementById('deleteFaqAnswer').textContent = answer || '-';
            });
        });
    });
</script>

@include('admin.layouts.footer')
