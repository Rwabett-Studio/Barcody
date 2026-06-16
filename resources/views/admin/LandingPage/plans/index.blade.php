@include('admin.layouts.header')

<div id="main" class="offset-lg-2">
    <div class="content pt-3 contacts-page">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">Plans</h4>

            @if(Auth::user()->create_role === 1)
            <a href="{{ route('plans.create') }}" class="d-flex align-items-center blueBtn">
                <i class="fas fa-plus"></i>
                <span>Add Plan</span>
            </a>
            @endif
        </div>

        <div class="contacts-table-shell mt-4">
            <div class="table-responsive">
                <table id="contactTable" class="w-100">
                    <thead>
                        <tr>
                            <th>Plan</th>
                            <th>Price</th>
                            <th>Items</th>
                            <th style="width:17%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($plans as $plan)
                            @php
                                $items = collect([$plan->item1, $plan->item2, $plan->item3, $plan->item4, $plan->item5])->filter();
                            @endphp
                            <tr>
                                <td>
                                    <div class="user-name-cell">
                                        <span class="contact-avatar bg-success-subtle text-success">
                                            <i class="fas fa-gem"></i>
                                        </span>
                                        <div>
                                            <strong>{{ $plan->title }}</strong>
                                            <small>Pricing package</small>
                                        </div>
                                    </div>
                                </td>
                                <td><strong>{{ $plan->price }}</strong></td>
                                <td><span class="inbox-message-preview">{{ $items->take(3)->implode(' / ') ?: 'No items yet' }}</span></td>
                                <td>
                                    <div class="table-action-group">
                                        @if(Auth::user()->edit_role === 1)
                                            <a href="{{ route('plans.edit', $plan->id) }}" class="table-action-btn">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                        @endif
                                        @if(Auth::user()->delete_role === 1)
                                            <button type="button"
                                                class="table-action-btn is-danger js-plan-delete"
                                                data-bs-toggle="modal"
                                                data-bs-target="#planDeleteModal"
                                                data-plan-name="{{ $plan->title }}"
                                                data-plan-price="{{ $plan->price }}"
                                                data-plan-action="{{ route('plans.destroy', $plan->id) }}">
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

<div class="modal fade contact-delete-modal" id="planDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content contact-delete-card">
            <div class="modal-header border-0 pb-0">
                <div>
                    <h5 class="modal-title fw-bold">Delete Plan</h5>
                    <p class="contact-delete-message mb-0">Confirm before removing this pricing plan.</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="contact-delete-row">
                    <span>Title</span>
                    <strong id="deletePlanName">-</strong>
                </div>
                <div class="contact-delete-row">
                    <span>Price</span>
                    <strong id="deletePlanPrice">-</strong>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn modal-cancel-btn" data-bs-dismiss="modal">Cancel</button>
                <form id="planDeleteForm" method="POST" action="#">
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
        var deleteBtns = document.querySelectorAll('.js-plan-delete');
        deleteBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var action = this.getAttribute('data-plan-action');
                var name = this.getAttribute('data-plan-name');
                var price = this.getAttribute('data-plan-price');
                
                document.getElementById('planDeleteForm').action = action;
                document.getElementById('deletePlanName').textContent = name || '-';
                document.getElementById('deletePlanPrice').textContent = price || '-';
            });
        });
    });
</script>

@include('admin.layouts.footer')
