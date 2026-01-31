




<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Thank You!</h4>
                </div>

                <div class="card-body text-center py-5">
                    @if($response === 'accept')
                        <i class="fas fa-check-circle text-success mb-4" style="font-size: 5rem;"></i>
                        <h3 class="mb-3">Thank you for accepting our invitation!</h3>
                        <p class="lead">We look forward to seeing you at the event.</p>
                    @else
                        <i class="fas fa-times-circle text-danger mb-4" style="font-size: 5rem;"></i>
                        <h3 class="mb-3">We're sorry you can't make it</h3>
                        <p class="lead">Thank you for letting us know.</p>
                    @endif
                    
                    <a href="{{ url('/') }}" class="btn btn-primary mt-4">
                        <i class="fas fa-home me-2"></i> Return to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
