@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <div class="content pt-3 contacts-page">
        <div class="contacts-page-head d-flex justify-content-between align-items-start border-bottom mainBordClr mb-lg-4 mb-0">
            <div>
                <h4 class="fw-bold mb-1">Edit Plan</h4>
                <p class="mb-0">Update pricing and feature lines.</p>
            </div>
            <a href="{{ route('plans.index') }}" class="table-action-btn">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>

        <form action="{{ route('plans.update', $plan->id) }}" method="POST" class="contact-form-shell contact-form-shell-full mt-4">
            @csrf
            @method('PUT')

            <div class="settings-section-title">
                <span class="contact-avatar bg-success-subtle text-success"><i class="fas fa-gem"></i></span>
                <div>
                    <h5>Plan Details</h5>
                    <p>Keep names short and list the strongest plan benefits.</p>
                </div>
            </div>

            <div class="contact-form-grid settings-form-grid">
                <div class="contact-field">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="contact-input" value="{{ old('title', $plan->title) }}" required>
                </div>

                <div class="contact-field">
                    <label for="price">Price</label>
                    <input type="text" name="price" id="price" class="contact-input" value="{{ old('price', $plan->price) }}" required>
                </div>

                @for ($i = 1; $i <= 5; $i++)
                    <div class="contact-field">
                        <label for="item{{ $i }}">Item {{ $i }}</label>
                        <input type="text" name="item{{ $i }}" id="item{{ $i }}" class="contact-input" value="{{ old('item' . $i, $plan->{'item' . $i}) }}">
                    </div>
                @endfor
            </div>

            <div class="contact-form-actions">
                <a href="{{ route('plans.index') }}" class="table-action-btn">Cancel</a>
                <button type="submit" class="btn blueBtn d-flex align-items-center">
                    <i class="fas fa-save"></i>
                    <span>Update</span>
                </button>
            </div>
        </form>
    </div>
</div>

@include('admin.layouts.footer')
