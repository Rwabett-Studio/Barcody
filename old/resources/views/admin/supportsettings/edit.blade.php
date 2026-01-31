@include('admin.layouts.header')

    <div id="main" class="offset-lg-2">
    
    <!-- content -->
    <div class="content pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">List of Companies</h4>
            <button class="d-flex align-items-center blueBtn">
                <i class="fas fa-plus"></i> <span>Add company</span>
            </button>
        </div>
        <div class="col-12 position-relative pt-1">
    
   
            <div class="logFormDV center mb-lg-5 mb-2">
                <div class="clear"></div>
                <div class="col-lg-9 center pt-lg-5 pt-2">
               
                  <form action="{{ route('supportsettings.update', $supportsetting->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">

                      <div class="col-12">
                        <div class="position-relative">
                          <label for="name" class="form-label">Name</label>
                          <input type="text" class="form-control" id="name" name="name" value="{{ $supportsetting->name }}" required>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="position-relative">
                          <label for="email" class="form-label">Email</label>
                          <input type="email" class="form-control" id="email" name="email" value="{{ $supportsetting->email }}" required>
                        </div>                 
                      </div>

                      <div class="col-12">
                        <div class="position-relative">
                          <label for="phone" class="form-label">Phone</label>
                          <input type="text" class="form-control" id="phone" name="phone" value="{{ $supportsetting->phone }}" required>
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="position-relative">
                          <label for="whatsapp" class="form-label">WhatsApp</label>
                          <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="{{ $supportsetting->whatsapp }}">
                        </div>                 
                      </div>

                      <div class="col-12">
                        <div class="position-relative">
                          <label for="facebook" class="form-label">Facebook</label>
                          <input type="text" class="form-control" id="facebook" name="facebook" value="{{ $supportsetting->facebook }}">
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="position-relative">
                          <label for="youtube" class="form-label">YouTube</label>
                          <input type="text" class="form-control" id="youtube" name="youtube" value="{{ $supportsetting->youtube }}">
                        </div>                 
                      </div>

                      <div class="col-12">
                        <div class="position-relative">
                          <label for="twitter" class="form-label">Twitter</label>
                          <input type="text" class="form-control" id="twitter" name="twitter" value="{{ $supportsetting->twitter }}">
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="position-relative">
                          <label for="instagram" class="form-label">Instagram</label>
                          <input type="text" class="form-control" id="instagram" name="instagram" value="{{ $supportsetting->instagram }}">
                        </div>                 
                      </div>

                      <div class="col-12">
                        <div class="position-relative">
                          <label for="dribbble" class="form-label">Dribbble</label>
                          <input type="text" class="form-control" id="dribbble" name="dribbble" value="{{ $supportsetting->dribbble }}">
                        </div>
                      </div>

                      <div class="col-12">
                        <div class="position-relative">
                          <label for="behance" class="form-label">Behance</label>
                          <input type="text" class="form-control" id="behance" name="behance" value="{{ $supportsetting->behance }}">
                        </div>                 
                      </div>
              
                      <div class="col-12">
                        <button class="btn blueBtn d-flex w-100 d-flex align-items-center text-center justify-content-center">
                          <span><i class="fas fa-arrow-right border-0"></i></span>
                          <span>Update</span>
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
