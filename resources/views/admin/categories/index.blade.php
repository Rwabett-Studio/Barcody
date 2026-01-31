@include('admin.layouts.header')

    <div id="main" class="offset-lg-2">
    
    <!-- content -->
    <div class="content pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">List of Categories</h4>
            @if(Auth::user()->create_role === 1)

            <a href="{{ route('categories.create') }}" class="d-flex align-items-center blueBtn">
                <i class="fas fa-plus"></i> <span>Add Category</span>
            </a>
            @endif

        </div>
        <div class="col-12 position-relative pt-1">
            <div class="table-tools">
            </div>

            <table id="contactTable" class="w-100 mt-3 companyTable">
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
                        <th style="width:15%">Category Name</th>
                        {{-- <th>Icon</th> --}}
                        <th style="width:17%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>
                            <div class="checkboxes__row">
                                <div class="checkboxes__item">
                                    <label class="checkbox style-b">
                                        <input type="checkbox"/>
                                        <div class="checkbox__checkmark"></div>
                                    </label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="compImgDv d-flex align-items-center">
                                <div class="ms-3">
                                    <h6>{{ $category->name }}</h6>
                                </div>
                            </div>
                        </td>
                        {{-- <td>
                            <div class="d-flex align-items-center">
                                @if ($category->icon)
                                <img src="{{ asset('storage/' . $category->icon) }}" alt="Category Icon" width="50">
                            @else
                                No Icon
                            @endif
                        
                        </div>
                        </td> --}}
                        <td>
                            <div class="d-flex align-items-center actions">
                                <!-- Delete Button -->
                                {{-- @if(Auth::user()->delete_role === 1)

                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger p-0">Delete</button>
                                </form>
                                
                                @endif --}}

                                <!-- Edit Button -->
                                @if(Auth::user()->edit_role === 1)

                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-link text-primary ms-3 p-0">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <!-- SVG content here -->
                                    </svg>
                                    <span>Edit</span>
                                </a>

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
    

@include('admin.layouts.footer')
