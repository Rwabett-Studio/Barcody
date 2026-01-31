<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Chat with LoopX</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">    
    </head>
<body>
    

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">Invitation Error</h4>
                </div>

                <div class="card-body text-center py-4">
                    <div class="mb-4">
                        <i class="fas fa-exclamation-triangle text-danger" style="font-size: 5rem;"></i>
                    </div>
                    
                    <h3 class="mb-3">Oops! Something went wrong</h3>
                    
                    <p class="lead">{{ $message }}</p>
                    
                    <div class="mt-4">
                        <a href="mailto:{{ config('app.contact_email') }}" class="btn btn-outline-primary me-2">
                            <i class="fas fa-envelope"></i> Contact Organizer
                        </a>
                        <a href="{{ url('/') }}" class="btn btn-primary">
                            <i class="fas fa-home"></i> Return Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>