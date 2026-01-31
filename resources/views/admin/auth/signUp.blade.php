@include('admin.layouts.headerLogin')


   
    <div class="logFormDV center mb-lg-5 mb-2">
        {{-- <div><a href="signIn.html" class="float-end"><button class="btn mainBtn px-2"> <i class="fa-solid fa-chevron-left text-secondary"></i></button></a></div> --}}
        <div class="clear"></div>
        <div class="col-lg-9 center pt-lg-5 pt-2">
          <div class="text-center ">
            <img src="img/logo.png" alt="">
            <h6 class="fs-16 mt-3 fw-700">Sign Up with WunderUI</h6>
            <p class="light-primary">
              Start building with your own data dashboard and insights with our new design system.
            </p>
            {{-- <div class="d-flex align-items-center justify-content-between mt-3 text-center">
               <a href=""  class="btn mainBtn d-flex align-items-center w-100 text-center justify-content-between h-100 mx-1">
                <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g clip-path="url(#clip0_43_1859)">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M24.02 12.2727C24.02 11.4218 23.9436 10.6036 23.8018 9.81818H12.5V14.46H18.9582C18.68 15.96 17.8345 17.2309 16.5636 18.0818V21.0927H20.4418C22.7109 19.0036 24.02 15.9273 24.02 12.2727Z" fill="#4285F4"/>
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5 24C15.74 24 18.4564 22.9255 20.4418 21.0927L16.5636 18.0818C15.4891 18.8018 14.1145 19.2273 12.5 19.2273C9.37455 19.2273 6.72909 17.1164 5.78545 14.28H1.77636V17.3891C3.75091 21.3109 7.80909 24 12.5 24Z" fill="#34A853"/>
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M5.78545 14.28C5.54545 13.56 5.40909 12.7909 5.40909 12C5.40909 11.2091 5.54545 10.44 5.78545 9.72V6.61091H1.77636C0.963636 8.23091 0.5 10.0636 0.5 12C0.5 13.9364 0.963636 15.7691 1.77636 17.3891L5.78545 14.28Z" fill="#FBBC05"/>
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M12.5 4.77273C14.2618 4.77273 15.8436 5.37818 17.0873 6.56727L20.5291 3.12545C18.4509 1.18909 15.7345 0 12.5 0C7.80909 0 3.75091 2.68909 1.77636 6.61091L5.78545 9.72C6.72909 6.88364 9.37455 4.77273 12.5 4.77273Z" fill="#EA4335"/>
                  </g>
                  <defs>
                  <clipPath id="clip0_43_1859">
                  <rect width="24" height="24" fill="white" transform="translate(0.5)"/>
                  </clipPath>
                  </defs>
                  </svg>
                <span class="ms-2">Sign Up with Google</span>
                </a>
               <a href=""  class="btn mainBtn d-flex align-items-center w-100 text-center justify-content-between h-100 mx-1">
                <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect width="24" height="24" transform="translate(0.5)" fill="white"/>
                  <path d="M23.2143 14.1429C23.2143 8.89285 20.5893 5.14285 17.2143 5.14285C14.5893 5.14285 12.7143 8.14285 12.7143 8.14285C11.2143 10.3929 11.2143 14.5179 13.4643 10.0179C13.4643 10.0179 15.3393 7.01785 17.2143 7.01785C19.8393 7.01785 21.2225 11.5179 21.2225 14.1429C21.2225 14.8929 20.9643 16.3929 19.4643 16.3929V18.6429C20.9643 18.6429 23.2143 17.5179 23.2143 14.1429Z" fill="url(#paint0_radial_1_10789)"/>
                  <path d="M8.21429 5.14285V7.39285C5.81429 7.69285 4.46429 11.5179 4.46429 14.1429C4.46429 14.8929 4.83929 16.3929 5.96429 16.3929C7.83929 16.3929 9.99534 12.2528 11.9643 9.22479C13.0095 7.61733 14.0499 8.99754 13.2566 10.3929C11.3769 13.699 9.49456 18.6429 5.96429 18.6429C4.46429 18.6429 2.21429 17.5179 2.21429 14.1429C2.21429 7.39285 6.33929 5.14285 8.21429 5.14285Z" fill="url(#paint1_radial_1_10789)"/>
                  <path d="M19.4643 16.3929C16.8393 16.3929 13.8393 5.14285 8.21429 5.14285V7.39285C12.7143 7.39285 14.5893 18.6429 19.4643 18.6429V16.3929Z" fill="#0768E1"/>
                  <defs>
                  <radialGradient id="paint0_radial_1_10789" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(19.4643 17.8929) rotate(-101.31) scale(13.3849 10.4105)">
                  <stop stop-color="#0768E1"/>
                  <stop offset="1" stop-color="#0082FB"/>
                  </radialGradient>
                  <radialGradient id="paint1_radial_1_10789" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(8.21429 6.64285) rotate(154.537) scale(8.72228 4.57476)">
                  <stop stop-color="#0768E1"/>
                  <stop offset="1" stop-color="#0082FB"/>
                  </radialGradient>
                  </defs>
                  </svg>
                <span class="ms-2">Sign Up with Facebook</span>
                </a>
            </div> --}}
          </div>
          {{-- <div class="or"><span>or</span></div> --}}


          <form action="{{ route('signup') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-12">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12">
                    <label for="email">Email</label>
                    <div class="position-relative">
                        <input type="text" name="email" value="{{ old('email') }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <label for="password">Password</label>
                    <div class="position-relative">
                        <input type="password" name="password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <label for="password_confirmation">Confirm Password</label>
                    <div class="position-relative">
                        <input type="password" name="password_confirmation">
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn blueBtn d-flex w-100 d-flex align-items-center text-center justify-content-center">
                        <span><i class="fas fa-arrow-right border-0"></i></span>
                        <span>Sign up</span>
                    </button>
                    <h6 class="mt-3">I already have an account. <a href="{{ route('login') }}">Sign In here.</a></h6>
                </div>
            </div>
        </form>
        
        </div>
    </div>

@include('admin.layouts.footer')
