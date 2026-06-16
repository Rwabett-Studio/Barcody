@include('admin.layouts.header')

    <div id="main" class="offset-lg-2">
    
    <!-- content -->
    <div class="content pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">List of Categories</h4>
            @if(Auth::user()->create_role === 1)

            <button type="button" class="d-flex align-items-center blueBtn border-0" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                <i class="fas fa-plus"></i> <span>Add Category</span>
            </button>
            @endif

        </div>
        <div class="col-12 position-relative pt-1">
            <div class="table-tools">
            </div>

            <div class="row mt-4">
                @foreach($categories as $category)
                <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                    <div class="card h-100 border-0" style="border-radius: 12px; box-shadow: 0 10px 20px rgba(34, 64, 105, 0.05); transition: transform 0.2s;">
                        <div class="card-body d-flex flex-column p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: rgba(0, 172, 239, 0.1); color: #00ACEF; font-size: 20px;">
                                        <i class="fas fa-layer-group"></i>
                                    </div>
                                    <h5 class="fw-bold mb-0" style="color: #172033; font-size: 18px;">{{ $category->name }}</h5>
                                </div>

                            </div>
                            
                            <div class="mt-auto pt-4 d-flex justify-content-end align-items-center">
                                @if(Auth::user()->edit_role === 1)
                                <button type="button" class="btn btn-sm d-flex align-items-center gap-2 edit-category-btn" data-bs-toggle="modal" data-bs-target="#editCategoryModal" data-id="{{ $category->id }}" data-name="{{ $category->name }}" style="border: 1px solid #D9E1E7; color: #1479ff; border-radius: 8px; font-weight: 600; padding: 6px 12px; background: transparent; transition: all 0.2s;" onmouseover="this.style.background='#f4f7fb'" onmouseout="this.style.background='transparent'">
                                    <i class="fas fa-pen" style="font-size: 12px;"></i> Edit
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>


        </div>
    </div>
    
    </div>
    
    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 12px;">
                <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
                    <h5 class="modal-title fw-bold" id="addCategoryModalLabel">Add New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold text-secondary mb-2">Category Name</label>
                            <input type="text" class="form-control form-control-lg bg-light" id="name" name="name" required placeholder="e.g. Technology" style="border-radius: 8px; font-size: 15px; border: 1px solid #D9E1E7;">
                        </div>
                        <button type="submit" class="btn blueBtn w-100 d-flex align-items-center justify-content-center" style="border-radius: 8px; height: 48px;">
                            <span>Add Category</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 12px;">
                <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
                    <h5 class="modal-title fw-bold" id="editCategoryModalLabel">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="editCategoryForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="edit_name" class="form-label fw-semibold text-secondary mb-2">Category Name</label>
                            <input type="text" class="form-control form-control-lg bg-light" id="edit_name" name="name" required style="border-radius: 8px; font-size: 15px; border: 1px solid #D9E1E7;">
                        </div>
                        <button type="submit" class="btn blueBtn w-100 d-flex align-items-center justify-content-center" style="border-radius: 8px; height: 48px;">
                            <span>Update Category</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editButtons = document.querySelectorAll('.edit-category-btn');
            editButtons.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var id = this.getAttribute('data-id');
                    var name = this.getAttribute('data-name');
                    var form = document.getElementById('editCategoryForm');
                    
                    form.action = '/categories/' + id;
                    document.getElementById('edit_name').value = name;
                });
            });
        });
    </script>

@include('admin.layouts.footer')
