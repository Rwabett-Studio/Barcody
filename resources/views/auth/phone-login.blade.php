
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">{{ __('WhatsApp Login') }}</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('verify.phone') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="phone" class="form-label">{{ __('WhatsApp Number') }}</label>
                            <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                   name="phone" value="{{ old('phone') }}" required placeholder="+971501234567">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-text">
                                We'll send an OTP to this number via WhatsApp
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fab fa-whatsapp me-2"></i> {{ __('Send OTP') }}
                            </button>
                        </div>

                        <div class="mt-3 text-center">
                            <p class="mb-0">Prefer email login? 
                                <a href="{{ route('login') }}" class="text-decoration-none">
                                    {{ __('Login with email') }}
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
