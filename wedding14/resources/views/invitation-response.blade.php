<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Chat with LoopX</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">    
    </head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Invitation Response</div>

                <div class="card-body text-center">
                    <h4>📣 Invitation Notification 📣</h4>
                    <p>Dear {{ $contact->name }},</p>
                    
                    <div class="invitation-details mb-4">
                        <p>You're invited to:</p>
                        <p><strong>✨ Event:</strong> {{ $event->name }}</p>
                        <p><strong>📅 Date:</strong> {{ $event->date }}</p>
                        <p><strong>📍 Location:</strong> {{ $event->location }}</p>
                    </div>
                    
                    <form method="POST" action="{{ route('invitation.response.submit', [
                        'event' => $event->id,
                        'contact' => $contact->id,
                        'token' => $token
                    ]) }}">
                        @csrf
                        
                        <div class="btn-group" role="group">
                            <button type="submit" name="response" value="accepted" class="btn btn-success btn-lg mr-3">
                                ✅ Accept
                            </button>
                            <button type="submit" name="response" value="declined" class="btn btn-danger btn-lg">
                                ❌ Decline
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .event-details p {
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
    }
    .event-details i {
        width: 20px;
        text-align: center;
        margin-right: 8px;
    }
    .response-form {
        max-width: 500px;
        margin: 0 auto;
    }
    .btn-lg {
        font-size: 1.1rem;
    }
</style>


</body>
</html>