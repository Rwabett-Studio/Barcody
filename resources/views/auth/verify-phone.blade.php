
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">{{ __('Verify Phone Number') }}</h4>
                </div>

                <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <p class="mb-4">We've sent a 6-digit OTP to your WhatsApp number: <strong>{{ session('phone') }}</strong></p>

                    <form method="POST" action="{{ route('verify.phone') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="otp" class="form-label">{{ __('Enter OTP') }}</label>
                            <input id="otp" type="text" class="form-control @error('otp') is-invalid @enderror" 
                                   name="otp" required autocomplete="off" maxlength="6" pattern="\d{6}">
                            @error('otp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">
                                {{ __('Verify') }}
                            </button>
                        </div>

                        <div class="text-center">
                            <p class="mb-0">Didn't receive the code? 
                                <a href="{{ route('resend.otp') }}" class="text-decoration-none">
                                    {{ __('Resend OTP') }}
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
