@include('admin.layouts.header')

    <div id="main" class="offset-lg-2">
    
    <!-- content -->
    <div class="content pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">Add New Category</h4>
        </div>
        <div class="col-12 position-relative pt-1">
    
   
            <div class="logFormDV center mb-lg-5 mb-2">
                <div class="clear"></div>
                <div class="col-lg-9 center pt-lg-5 pt-2">
               
                  <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="col-12">
                        <div class="position-relative">
                          <label for="name" class="form-label">Category Name</label>
                          <input type="text" class="form-control" id="name" name="name" required>                          <span>
                     
                          </span>
                        </div>
                      </div>
                      {{-- <div class="col-12">
                        <div class="position-relative">
                          <label for="icon" class="form-label">Icon URL</label>
                          <input type="file" class="form-control" id="icon" name="icon" required>
                
                          </span>
                        </div>                 
                      </div> --}}
              
                      <div class="col-12">
                        <button class="btn blueBtn d-flex w-100 d-flex align-items-center text-center justify-content-center">
                          <span><i class="fas fa-arrow-right border-0"></i></span>
                          <span>Add</span>
                        </button>
                      </div>
                    </div>
        
                  </form>
                </div>
            </div>


        </div>
    </div>
    
    </div>
    

@include('admin.layouts.footer')
