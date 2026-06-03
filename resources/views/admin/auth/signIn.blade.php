@include('admin.layouts.headerLogin')

<div class="d-flex align-items-center justify-content-center min-vh-100">
    <div class="col-12 col-md-8 col-lg-5 col-xl-4 px-3">
        <div class="card border-0 shadow-lg" style="border-radius: 20px; backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.95);">
            <div class="card-body p-3 p-lg-5">
                <div class="text-center mb-5">
                    <img src="{{ asset('admin/img/logo.png') }}" alt="Logo" style="height: 45px; margin-bottom: 20px;">
                    <h4 class="fw-bold text-dark mb-2" style="font-family: 'Outfit', sans-serif;">Welcome Back</h4>
                    <p class="text-muted" style="font-size: 14px;">Sign in to continue to your dashboard</p>
                </div>

                <form action="{{ route('signin') }}" method="POST">
                    @csrf
                    
                    <div class="form-group mb-4">
                        <label class="form-label text-secondary fw-medium" style="font-size: 13px;">Email Address</label>
                        <div class="input-group input-group-lg" style="border-radius: 12px; box-shadow: 0 2px 6px rgba(0,0,0,0.02);">
                            <span class="input-group-text bg-white border-end-0 text-muted" style="border-radius: 12px 0 0 12px;">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" name="email" class="form-control border-start-0 ps-0" placeholder="hello@example.com" style="border-radius: 0 12px 12px 0; font-size: 15px;" required>
                        </div>
                        @error('email')
                            <small class="text-danger mt-1 d-block"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label class="form-label text-secondary fw-medium mb-0" style="font-size: 13px;">Password</label>
                        </div>
                        <div class="input-group input-group-lg" style="border-radius: 12px; box-shadow: 0 2px 6px rgba(0,0,0,0.02);">
                            <span class="input-group-text bg-white border-end-0 text-muted" style="border-radius: 12px 0 0 12px;">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" name="password" class="form-control border-start-0 ps-0" placeholder="••••••••" style="border-radius: 0 12px 12px 0; font-size: 15px;" required>
                        </div>
                        @error('password')
                            <small class="text-danger mt-1 d-block"><i class="fas fa-exclamation-circle me-1"></i> {{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 mb-4 mt-2 shadow-sm" style="background: #1479ff; border: none; border-radius: 12px; font-weight: 600; font-size: 16px; transition: all 0.3s ease;">
                        Sign In <i class="fas fa-arrow-right ms-2"></i>
                    </button>

                    <div class="text-center">
                        <p class="text-muted mb-0" style="font-size: 14px;">Don't have an account? <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">Create Account</a></p>
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
