<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>دعوة {{ $event->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); min-height: 100vh; font-family: 'Segoe UI', Tahoma, sans-serif; }
        .invite-card { max-width: 540px; margin: 40px auto; border: none; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,.3); }
        .invite-hero { background: #1a1a2e; color: #fff; padding: 32px 24px; text-align: center; }
        .invite-hero h1 { font-weight: 800; margin-bottom: 6px; }
        .event-meta { display:flex; flex-direction:column; gap:8px; margin-top:18px; font-size:15px; }
        .event-meta div { background: rgba(255,255,255,.08); padding:10px 14px; border-radius:10px; }
        .rsvp-body { background:#fff; padding: 28px 24px; }
        .rsvp-btn { border:2px solid #eee; border-radius:14px; padding:16px; font-size:18px; font-weight:600; width:100%; transition:.2s; background:#fff; }
        .rsvp-btn:hover { transform: translateY(-2px); }
        .rsvp-btn.active { color:#fff; }
        .rsvp-accept.active { background:#16a34a; border-color:#16a34a; }
        .rsvp-maybe.active  { background:#f59e0b; border-color:#f59e0b; }
        .rsvp-decline.active{ background:#dc2626; border-color:#dc2626; }
        .guests-wrap { display:none; margin-top:18px; }
    </style>
</head>
<body>
<div class="card invite-card">
    <div class="invite-hero">
        <div style="opacity:.7;font-size:13px;">أهلاً {{ $contact->name }} 👋</div>
        <h1>{{ $event->name }}</h1>
        @if($event->description)<p style="opacity:.85;margin:0">{{ $event->description }}</p>@endif
        <div class="event-meta">
            @if($event->date)<div>📅 {{ \Carbon\Carbon::parse($event->date)->format('l, d M Y') }}</div>@endif
            @if($event->time)<div>🕐 {{ $event->time }}</div>@endif
            @if($event->location)<div>📍 {{ $event->location }}</div>@endif
        </div>
        @if($event->maps)<a href="{{ $event->maps }}" target="_blank" class="btn btn-sm btn-outline-light mt-3">عرض على الخريطة</a>@endif
    </div>

    <div class="rsvp-body">
        @if(in_array($contact->status, ['accepted','maybe','declined']))
            <div class="alert alert-info text-center">
                لقد سجّلت ردّك مسبقاً:
                <strong>
                    @if($contact->status=='accepted') سأحضر ✅
                    @elseif($contact->status=='maybe') احتمال أحضر 🤔
                    @else لن أحضر ❌ @endif
                </strong>
            </div>
        @endif

        <p class="text-center text-muted mb-3">هل ستشرفنا بالحضور؟</p>
        <form method="POST" action="{{ route('invitation.response.submit', ['contact_id' => $contact->invitation_token]) }}">
            @csrf
            <input type="hidden" name="status" id="statusInput">
            <div class="d-grid gap-2">
                <button type="button" class="rsvp-btn rsvp-accept" data-status="accepted">✅ سأحضر</button>
                <button type="button" class="rsvp-btn rsvp-maybe" data-status="maybe">🤔 احتمال أحضر</button>
                <button type="button" class="rsvp-btn rsvp-decline" data-status="declined">❌ لن أحضر</button>
            </div>

            <div class="guests-wrap" id="guestsWrap">
                <label class="form-label mt-2">عدد الأشخاص الذين سيحضرون</label>
                <input type="number" name="guests_count" class="form-control" min="1" max="50" value="1">
            </div>

            <button type="submit" class="btn btn-dark w-100 mt-4 py-2" id="submitBtn" disabled>تأكيد الرد</button>
            <p class="text-center text-muted mt-3" style="font-size:13px;">
                عند تأكيد الحضور سيصلك رمز QR على الواتساب 🎟️
            </p>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const btns = document.querySelectorAll('.rsvp-btn');
    const statusInput = document.getElementById('statusInput');
    const guestsWrap = document.getElementById('guestsWrap');
    const submitBtn = document.getElementById('submitBtn');

    btns.forEach(btn => btn.addEventListener('click', () => {
        btns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const status = btn.dataset.status;
        statusInput.value = status;
        submitBtn.disabled = false;
        guestsWrap.style.display = (status === 'accepted' || status === 'maybe') ? 'block' : 'none';
    }));
</script>
</body>
</html>
