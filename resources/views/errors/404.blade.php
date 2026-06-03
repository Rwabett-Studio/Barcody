<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found | Barcody</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #f4f7fb;
            --text-main: #172033;
            --text-muted: #71839b;
            --primary: #1479ff;
            --primary-hover: #0c5bce;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            overflow: hidden;
        }

        .container {
            text-align: center;
            padding: 2rem;
            position: relative;
            z-index: 10;
        }

        .error-code {
            font-size: 12rem;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #1479ff, #00acef);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            position: relative;
            animation: float 6s ease-in-out infinite;
        }

        .error-code::after {
            content: '404';
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(20, 121, 255, 0.4), rgba(0, 172, 239, 0.4));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            filter: blur(24px);
            z-index: -1;
        }

        .title {
            font-size: 2.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .description {
            font-size: 1.1rem;
            color: var(--text-muted);
            margin-bottom: 2.5rem;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
        }

        .btn-home {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background-color: var(--primary);
            color: white;
            text-decoration: none;
            padding: 14px 32px;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 10px 20px rgba(20, 121, 255, 0.3);
        }

        .btn-home:hover {
            background-color: var(--primary-hover);
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(20, 121, 255, 0.4);
        }

        .btn-home svg {
            width: 20px;
            height: 20px;
            transition: transform 0.3s ease;
        }

        .btn-home:hover svg {
            transform: translateX(-4px);
        }

        /* Decorative Background Elements */
        .shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            z-index: 1;
        }

        .shape-1 {
            width: 400px;
            height: 400px;
            background: rgba(20, 121, 255, 0.15);
            top: -100px;
            left: -100px;
            animation: pulse 8s infinite alternate;
        }

        .shape-2 {
            width: 300px;
            height: 300px;
            background: rgba(0, 172, 239, 0.15);
            bottom: -50px;
            right: -50px;
            animation: pulse 10s infinite alternate-reverse;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 0.5; }
            100% { transform: scale(1.2); opacity: 0.8; }
        }

        @media (max-width: 768px) {
            .error-code { font-size: 8rem; }
            .title { font-size: 2rem; }
            .description { font-size: 1rem; }
        }
    </style>
</head>
<body>

    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>

    <div class="container">
        <div class="error-code">404</div>
        <h1 class="title">Oops! Page Not Found</h1>
        <p class="description">We can't seem to find the page you're looking for. It might have been removed, renamed, or doesn't exist.</p>
        <a href="{{ url('/') }}" class="btn-home">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Homepage
        </a>
    </div>

</body>
</html>
