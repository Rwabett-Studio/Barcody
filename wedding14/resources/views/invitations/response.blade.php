<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invitation Response</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .btn-loading {
            position: relative;
        }
        .btn-loading:after {
            content: "";
            position: absolute;
            right: 10px;
            top: 50%;
            width: 20px;
            height: 20px;
            margin-top: -10px;
            border: 2px solid rgba(255,255,255,0.5);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        .response-feedback {
            display: none;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Invitation Response</h4>
                    </div>

                    <div class="card-body text-center py-4">
                        <p class="lead mb-4">Please select your response:</p>
                        
                        <div class="d-grid gap-3 col-md-6 mx-auto">
                            <button id="acceptBtn" class="btn btn-success btn-lg">
                                <i class="fas fa-check-circle me-2"></i> Accept
                            </button>
                            <button id="declineBtn" class="btn btn-danger btn-lg">
                                <i class="fas fa-times-circle me-2"></i> Decline
                            </button>
                        </div>
                        
                        <div id="successAlert" class="alert alert-success mt-4 response-feedback">
                            Thank you for your response!
                        </div>
                        <div id="errorAlert" class="alert alert-danger mt-4 d-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const acceptBtn = document.getElementById('acceptBtn');
        const declineBtn = document.getElementById('declineBtn');
        const errorAlert = document.getElementById('errorAlert');
        const successAlert = document.getElementById('successAlert');
        
        // Extract contact_id from URL
        const pathParts = window.location.pathname.split('/');
        const contact_id = pathParts[pathParts.length - 1];
        
        // Setup button handlers
        [acceptBtn, declineBtn].forEach(btn => {
            btn.addEventListener('click', async function() {
                const response = this.id === 'acceptBtn' ? 'accepted' : 'declined';
                
                try {
                    // Show loading state
                    this.classList.add('btn-loading');
                    this.disabled = true;
                    errorAlert.classList.add('d-none');
                    
                    // Submit the response
                    await submitResponse(response, contact_id);
                    
                    // Hide buttons and show success message
                    acceptBtn.style.display = 'none';
                    declineBtn.style.display = 'none';
                    successAlert.style.display = 'block';
                    
                } catch (error) {
                    errorAlert.textContent = 'Failed to submit response. Please try again.';
                    errorAlert.classList.remove('d-none');
                    
                    // Reset buttons
                    [acceptBtn, declineBtn].forEach(b => {
                        b.classList.remove('btn-loading');
                        b.disabled = false;
                    });
                    
                    // Scroll to error
                    errorAlert.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
        
        async function submitResponse(responseType, contactId) {
const url = "{{ route('invitation.response.submit', ['contact_id' => '__CONTACT_ID__']) }}"
               .replace('__CONTACT_ID__', contactId);            
            const options = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ response: responseType })
            };
            
            const response = await fetch(url, options);
            
            if (!response.ok) {
                throw new Error('Failed to update status');
            }
        }
    });
    </script>
</body>
</html>