@include('admin.layouts.header')

    <div id="main" class="offset-lg-2">
    
    <!-- content -->
    <div class="content pt-3">
        <div class="d-flex justify-content-between align-items-center border-bottom mainBordClr mb-lg-4 mb-0">
            <h4 class="fw-bold mb-0">Edit Event</h4>
        </div>
        <div class="col-12 position-relative pt-1">
    
   
            <div class="logFormDV center mb-lg-5 mb-2">
                <div class="clear"></div>
                <div class="col-lg-9 center pt-lg-5 pt-2">
               
                    <form action="{{ route('SocialMedia.update', $socialMedia->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                    
                    <div class="row">
                        <!-- Name -->
                        <div class="col-12">
                            <div class="position-relative">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $socialMedia->email }}" required>
                            </div>                 
                        </div>
                
                        <!-- Thumbnail Image -->
                        <div class="col-12">
                            <div class="position-relative">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $socialMedia->phone }}" required>
                            </div>
                        </div>
                
                        <!-- Description -->
                        <div class="col-12">
                            <div class="position-relative">
                                <label for="whatsapp" class="form-label">WhatsApp</label>
                                <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="{{ $socialMedia->whatsapp }}">
                            </div>                 
                        </div>
                
                        <!-- Date -->
                        <div class="col-12">
                            <div class="position-relative">
                                <label for="facebook" class="form-label">Facebook</label>
                                <input type="text" class="form-control" id="facebook" name="facebook" value="{{ $socialMedia->facebook }}">
                            </div>                 
                        </div>
                
                        <!-- Time -->
                        <div class="col-12">
                            <div class="position-relative">
                                <label for="youtube" class="form-label">YouTube</label>
                                <input type="text" class="form-control" id="youtube" name="youtube" value="{{ $socialMedia->youtube }}">
                            </div>                 
                        </div>
                
                        <!-- Location -->
                        <div class="col-12">
                            <div class="position-relative">
                                <label for="twitter" class="form-label">Twitter</label>
                                <input type="text" class="form-control" id="twitter" name="twitter" value="{{ $socialMedia->twitter }}">
                            </div>                 
                        </div>
            
                
                        <!-- Submit Button -->
                        <div class="col-12">
                            <button type="submit" class="btn blueBtn d-flex w-100 d-flex align-items-center text-center justify-content-center">
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
