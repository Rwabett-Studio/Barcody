@include('admin.layouts.headerLogin')

<div class="d-flex align-items-center justify-content-center min-vh-100 py-5">
    <div class="col-12 col-md-8 col-lg-6 col-xl-5 px-3">
        <div class="card border-0 shadow-lg" style="border-radius: 20px; backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.95);">
            <div class="card-body p-3 p-lg-4">
                <div class="text-center mb-4">
                    <img src="{{ asset('admin/img/logo.png') }}" alt="Logo" style="height: 35px; margin-bottom: 12px;">
                    <h5 class="fw-bold text-dark mb-1" style="font-family: 'Outfit', sans-serif;">Create an Account</h5>
                    <p class="text-muted mb-0" style="font-size: 13px;">Sign up to get started with WunderUI</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger mb-3 py-2" style="border-radius: 12px; font-size: 13px;">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger mb-3 py-2" style="border-radius: 12px; font-size: 13px;">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="form-label text-secondary fw-medium mb-1" style="font-size: 13px;">Full Name</label>
                            <div class="input-group" style="border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.02);">
                                <span class="input-group-text bg-white border-end-0 text-muted" style="border-radius: 10px 0 0 10px;">
                                    <i class="fas fa-user"></i>
                                </span>
                                <input id="name" type="text" name="name" class="form-control border-start-0 ps-0 @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="John Doe" style="border-radius: 0 10px 10px 0; font-size: 14px;" required autofocus>
                            </div>
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label class="form-label text-secondary fw-medium mb-1" style="font-size: 13px;">WhatsApp Number</label>
                            <div class="input-group" style="border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.02);">
                                <span class="input-group-text bg-white border-end-0 text-muted" style="border-radius: 10px 0 0 10px;">
                                    <i class="fab fa-whatsapp" style="color: #25D366;"></i>
                                </span>
                                <input id="phone" type="tel" name="phone" class="form-control border-start-0 ps-0 @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="+971501234567" style="border-radius: 0 10px 10px 0; font-size: 14px;" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label text-secondary fw-medium mb-1" style="font-size: 13px;">Email Address</label>
                        <div class="input-group" style="border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.02);">
                            <span class="input-group-text bg-white border-end-0 text-muted" style="border-radius: 10px 0 0 10px;">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input id="email" type="email" name="email" class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="hello@example.com" style="border-radius: 0 10px 10px 0; font-size: 14px;" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="form-label text-secondary fw-medium mb-1" style="font-size: 13px;">Password</label>
                            <div class="input-group" style="border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.02);">
                                <span class="input-group-text bg-white border-end-0 text-muted" style="border-radius: 10px 0 0 10px;">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input id="password" type="password" name="password" class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror" placeholder="••••••••" style="border-radius: 0 10px 10px 0; font-size: 14px;" required>
                            </div>
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label class="form-label text-secondary fw-medium mb-1" style="font-size: 13px;">Confirm Password</label>
                            <div class="input-group" style="border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.02);">
                                <span class="input-group-text bg-white border-end-0 text-muted" style="border-radius: 10px 0 0 10px;">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <input id="password-confirm" type="password" name="password_confirmation" class="form-control border-start-0 ps-0" placeholder="••••••••" style="border-radius: 0 10px 10px 0; font-size: 14px;" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <small class="text-muted d-block" style="font-size: 11px;"><i class="fas fa-info-circle me-1"></i>Password must contain 8+ characters (uppercase, lowercase, number, special character)</small>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 mb-3 mt-1 shadow-sm" style="background: #1479ff; border: none; border-radius: 10px; font-weight: 600; font-size: 15px; transition: all 0.3s ease;">
                        Sign Up <i class="fas fa-arrow-right ms-2"></i>
                    </button>

                    <div class="text-center">
                        <p class="text-muted mb-0" style="font-size: 13px;">Already have an account? <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none">Sign In</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-primary:hover {
        background: #0d6efd !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(20, 121, 255, 0.3) !important;
    }
    .input-group-text, .form-control {
        border-color: #e2e8f0;
    }
    .form-control:focus {
        box-shadow: none;
        border-color: #1479ff;
    }
    .input-group:focus-within .input-group-text,
    .input-group:focus-within .form-control {
        border-color: #1479ff;
    }
    .input-group:focus-within .input-group-text i {
        color: #1479ff !important;
    }
</style>

@include('admin.layouts.footer')
