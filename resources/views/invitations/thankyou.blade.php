<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>شكراً لك</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); min-height: 100vh; display:flex; align-items:center; font-family:'Segoe UI',Tahoma,sans-serif; }
        .ty-card { max-width:480px; margin:auto; background:#fff; border-radius:20px; padding:40px 28px; text-align:center; box-shadow:0 20px 60px rgba(0,0,0,.3); }
        .emoji { font-size:64px; }
    </style>
</head>
<body>
@php
    $status = $status ?? 'accepted';
    $map = [
        'accepted' => ['🎉', 'شكراً لتأكيد حضورك!', 'سيصلك رمز الـ QR على الواتساب. نراك هناك!'],
        'maybe'    => ['🤔', 'شكراً لردّك!', 'سجّلنا أنك قد تحضر، وسيصلك رمز QR احتياطاً.'],
        'declined' => ['🙏', 'شكراً لإعلامنا', 'نتمنى رؤيتك في مناسبة قادمة.'],
    ];
    $m = $map[$status] ?? $map['accepted'];
@endphp
<div class="ty-card">
    <div class="emoji">{{ $m[0] }}</div>
    <h2 class="mt-3 fw-bold">{{ $m[1] }}</h2>
    <p class="text-muted">{{ $m[2] }}</p>
</div>
</body>
</html>
