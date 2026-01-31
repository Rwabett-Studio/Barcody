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
               
                    <form action="">
                    <div class="row">
                      <div class="col-12">
                        <label for="">Email</label>
                        <div class="position-relative">
                          <input type="text" placeholder="hello@wunderui.com">
                          <span>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.33333 5.00014L8.42303 8.8437L8.42473 8.84511C8.98987 9.25955 9.27261 9.46689 9.5823 9.54699C9.85602 9.61779 10.1438 9.61779 10.4175 9.54699C10.7274 9.46682 11.011 9.25887 11.5771 8.8437C11.5771 8.8437 14.8417 6.33843 16.6667 5.00014M2.5 13.167V6.83364C2.5 5.90022 2.5 5.43316 2.68166 5.07664C2.84144 4.76304 3.09623 4.50825 3.40983 4.34846C3.76635 4.16681 4.23341 4.16681 5.16683 4.16681H14.8335C15.7669 4.16681 16.233 4.16681 16.5895 4.34846C16.9031 4.50825 17.1587 4.76304 17.3185 5.07664C17.5 5.43281 17.5 5.8993 17.5 6.8309V13.1698C17.5 14.1014 17.5 14.5672 17.3185 14.9234C17.1587 15.237 16.9031 15.4922 16.5895 15.652C16.2333 15.8335 15.7675 15.8335 14.8359 15.8335H5.16409C4.23249 15.8335 3.766 15.8335 3.40983 15.652C3.09623 15.4922 2.84144 15.237 2.68166 14.9234C2.5 14.5669 2.5 14.1004 2.5 13.167Z" stroke="#99B2C6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                          </span>
                        </div>
                      </div>
                      <div class="col-12">
                        <label for="">Password</label>
                        <div class="position-relative">
                          <input type="text" placeholder="">
                          <span>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M5.00006 8.33311V6.66644C5.00006 3.90811 5.83339 1.66644 10.0001 1.66644C14.1667 1.66644 15.0001 3.90811 15.0001 6.66644V8.33311" stroke="#99B2C6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M10.0001 15.4167C11.1507 15.4167 12.0834 14.4839 12.0834 13.3333C12.0834 12.1827 11.1507 11.25 10.0001 11.25C8.84949 11.25 7.91675 12.1827 7.91675 13.3333C7.91675 14.4839 8.84949 15.4167 10.0001 15.4167Z" stroke="#99B2C6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M14.1667 18.3333H5.83341C2.50008 18.3333 1.66675 17.5 1.66675 14.1666V12.5C1.66675 9.16665 2.50008 8.33331 5.83341 8.33331H14.1667C17.5001 8.33331 18.3334 9.16665 18.3334 12.5V14.1666C18.3334 17.5 17.5001 18.3333 14.1667 18.3333Z" stroke="#99B2C6" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg> 
                          </span>
                        </div>                 
                      </div>
              
                      <div class="col-12">
                        <button class="btn blueBtn d-flex w-100 d-flex align-items-center text-center justify-content-center">
                          <span><i class="fas fa-arrow-right border-0"></i></span>
                          <span>Sign in</span>
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
