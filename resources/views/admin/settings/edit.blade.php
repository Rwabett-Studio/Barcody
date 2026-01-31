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
               
                    <form action="{{ route('settings.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') 
                    
                    <div class="row">
                        <input type="hidden" name="id" value="{{ $setting->id }}">

                        <div class="col-12">
                            <div class="position-relative">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $setting->name }}" required>
                            </div>                 
                        </div>
                
                        <!-- Thumbnail Image -->
                        <div class="col-12">
                            <div class="position-relative">
                                <label for="fav_icon">Fav Icon</label>
                                <input type="file" name="fav_icon" id="fav_icon" class="form-control">
                                @if ($setting->fav_icon)
                                    <img src="{{ asset('storage/' . $setting->fav_icon) }}" alt="Fav Icon" style="max-width: 50px;">
                                @endif
                            </div>
                        </div>
                
                        <!-- Description -->
                        <div class="col-12">
                            <div class="position-relative">
                                <label for="header_logo">Header Logo</label>
                                <input type="file" name="header_logo" id="header_logo" class="form-control">
                                @if ($setting->header_logo)
                                    <img src="{{ asset('storage/' . $setting->header_logo) }}" alt="Header Logo" style="max-width: 50px;">
                                @endif
                            </div>                 
                        </div>
                
                        <!-- Date -->
                        <div class="col-12">
                            <div class="position-relative">
                                <label for="footer_logo">Footer Logo</label>
                                <input type="file" name="footer_logo" id="footer_logo" class="form-control">
                                @if ($setting->footer_logo)
                                    <img src="{{ asset('storage/' . $setting->footer_logo) }}" alt="Footer Logo" style="max-width: 50px;">
                                @endif
                            </div>                 
                        </div>
                
                        <!-- Time -->
                        <div class="col-12">
                            <div class="position-relative">
                                <label for="location">Location</label>
                                <input type="text" name="location" id="location" class="form-control" value="{{ $setting->location }}">
                            </div>                 
                        </div>
                
                        <!-- Location -->
                        <div class="col-12">
                            <div class="position-relative">
                                <label for="maps">Maps</label>
                                <textarea name="maps" id="maps" class="form-control">{{ $setting->maps }}</textarea>
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
