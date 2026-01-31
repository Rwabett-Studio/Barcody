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
                <div class="d-flex align-items-center">
                   
                    <button class="btn mainBtn2 light-primary">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.0249 12.2921C18.0249 13.0337 17.8166 13.7338 17.4499 14.3338C16.7666 15.4838 15.5083 16.2504 14.0666 16.2504C12.6249 16.2504 11.3666 15.4754 10.6833 14.3338C10.3166 13.7421 10.1083 13.0337 10.1083 12.2921C10.1083 10.1087 11.8833 8.33374 14.0666 8.33374C16.2499 8.33374 18.0249 10.1087 18.0249 12.2921Z" stroke="#809FB8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M15.55 12.2754H12.5917" stroke="#809FB8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M14.0667 10.8335V13.7918" stroke="#809FB8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M17.2416 3.35034V5.20032C17.2416 5.87532 16.8166 6.717 16.4 7.142L14.9333 8.43365C14.6583 8.36699 14.3666 8.33366 14.0666 8.33366C11.8833 8.33366 10.1083 10.1087 10.1083 12.292C10.1083 13.0337 10.3166 13.7337 10.6833 14.3337C10.9916 14.8503 11.4166 15.292 11.9333 15.6086V15.892C11.9333 16.4003 11.6 17.0753 11.175 17.3253L9.99997 18.0837C8.9083 18.7587 7.39163 18.0003 7.39163 16.6503V12.192C7.39163 11.6003 7.04997 10.842 6.71663 10.4253L3.51663 7.05863C3.09997 6.63363 2.7583 5.87534 2.7583 5.37534V3.43365C2.7583 2.42532 3.51663 1.66699 4.44163 1.66699H15.5583C16.4833 1.66699 17.2416 2.42534 17.2416 3.35034Z" stroke="#809FB8" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>                                
                        <span>Filter</span>                                
                    </button>
                    <button class="btn mainBtn2 light-primary mx-3">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.16663 13.3332L6.66663 15.8332M6.66663 15.8332L4.16663 13.3332M6.66663 15.8332V4.1665M10.8333 6.6665L13.3333 4.1665M13.3333 4.1665L15.8333 6.6665M13.3333 4.1665V15.8332" stroke="#809FB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>                            
                        <span>Sort</span>                                
                    </button>
                    <button class="btn mainBtn2 light-primary">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.7 7.4165C16.7 7.67484 17.925 9.2165 17.925 12.5915V12.6998C17.925 16.4248 16.4333 17.9165 12.7083 17.9165H7.28332C3.55832 17.9165 2.06665 16.4248 2.06665 12.6998V12.5915C2.06665 9.2415 3.27498 7.69984 6.22498 7.42484" stroke="#809FB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M10 1.6665V12.3998" stroke="#809FB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M12.7917 10.5417L10 13.3334L7.20837 10.5417" stroke="#809FB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            
                            
                        <span>Export</span>                                
                    </button>
                </div>
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
                        <th>Icon</th>
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
                        <td>
                            <div class="d-flex align-items-center">
                                @if ($category->icon)
                                <img src="{{ asset('storage/' . $category->icon) }}" alt="Category Icon" width="50">
                            @else
                                No Icon
                            @endif
                        
                        </div>
                        </td>
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
