@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <div class="content pt-3 contacts-page">
        <div class="contacts-page-head d-flex justify-content-between align-items-start border-bottom mainBordClr mb-lg-4 mb-0">
            <div>
                <h4 class="fw-bold mb-1">Create FAQ</h4>
                <p class="mb-0">Add a landing page question and answer.</p>
            </div>
            <a href="{{ route('faqs.index') }}" class="table-action-btn">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>

        <form action="{{ route('faqs.store') }}" method="POST" class="contact-form-shell contact-form-shell-full mt-4">
            @csrf
            <div class="settings-section-title">
                <span class="contact-avatar bg-warning-subtle text-warning"><i class="fas fa-question"></i></span>
                <div>
                    <h5>FAQ Details</h5>
                    <p>Write a direct question with a clear answer.</p>
                </div>
            </div>

            <div class="contact-form-grid settings-form-grid">
                <div class="contact-field contact-field-full">
                    <label for="question">Question</label>
                    <input type="text" name="question" id="question" class="contact-input" value="{{ old('question') }}" required>
                </div>

                <div class="contact-field contact-field-full">
                    <label for="answer">Answer</label>
                    <textarea name="answer" id="answer" class="contact-input" rows="6" required>{{ old('answer') }}</textarea>
                </div>
            </div>

            <div class="contact-form-actions">
                <a href="{{ route('faqs.index') }}" class="table-action-btn">Cancel</a>
                <button type="submit" class="btn blueBtn d-flex align-items-center">
                    <i class="fas fa-plus"></i>
                    <span>Create</span>
                </button>
            </div>
        </form>
    </div>
</div>

@include('admin.layouts.footer')
