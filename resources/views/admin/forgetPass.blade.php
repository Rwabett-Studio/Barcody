@include('admin.layouts.headerLogin')


    <div class="logFormDV center mb-lg-5 mb-2">
        <div><a href="signUp.html" class="float-end"><button class="btn mainBtn px-2"> <i class="fa-solid fa-chevron-left text-secondary"></i></button></a></div>
        <div class="clear"></div>
        <div class="col-lg-9 center pt-lg-5 pt-2">
          <div class="text-center ">
            <span class="mx-auto d-block w-fit">
                <svg width="56" height="56" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.5" y="0.5" width="55" height="55" rx="27.5" fill="white"/>
                <rect x="0.5" y="0.5" width="55" height="55" rx="27.5" stroke="#D9E1E7"/>
                <path d="M33 38H23C19 38 18 37 18 33V31C18 27 19 26 23 26H33C37 26 38 27 38 31V33C38 37 37 38 33 38Z" stroke="#809FB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M22 25.9997V23.9997C22 20.6897 23 17.9997 28 17.9997C32.5 17.9997 34 19.9997 34 22.9997" stroke="#809FB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M28 34.5C29.3807 34.5 30.5 33.3807 30.5 32C30.5 30.6193 29.3807 29.5 28 29.5C26.6193 29.5 25.5 30.6193 25.5 32C25.5 33.3807 26.6193 34.5 28 34.5Z" stroke="#809FB8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
            <h6 class="fs-16 mt-3 fw-700">Reset Password</h6>
            <p class="light-primary">
                Enter your email address to reset your password. We will send you a verification code.
            </p>
          </div>
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
                <h6 class="light-primary mb-2">Enter your registration email address</h6>
                <div class="col-12">
                    <button class="btn blueBtn d-flex w-100 d-flex align-items-center text-center justify-content-center">
                    <span>Reset Password</span>
                    </button>
                    <h6 class="mt-3 text-center">Help Center / Contact Support</h6>
                </div>
                </div>
            </form>
        </div>
    </div>

@include('admin.layouts.footer')
