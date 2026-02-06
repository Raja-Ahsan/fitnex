<!DOCTYPE html>
<html>

<head>
    <title>Verify Your Email</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <style>
        body {
            background: #f4f4f7;
            margin: 0;
            padding: 0;
            font-family: 'Roboto', Arial, sans-serif;
        }
        .email-container {
            max-width: 650px;
            margin: 40px auto;
            background: #fff0d3;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        .email-header {
            background: linear-gradient(90deg, #006cd1 0%, #004e97 100%);
            padding: 32px 0 16px 0;
            text-align: center;
        }
        .email-header img {
            width: 80px;
            margin-bottom: 8px;
        }
        .email-header h1 {
            color: #fff;
            margin: 0;
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .email-body {
            padding: 32px 32px 16px 32px;
            color: #333;
            text-align: center;
        }
        .email-body p {
            font-size: 1.1rem;
            margin: 0 0 18px 0;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(90deg, #df9816 0%, #df9816 100%);
            color: #fff !important;
            text-decoration: none;
            padding: 14px 36px;
            border-radius: 6px;
            font-size: 1.1rem;
            font-weight: 700;
            margin: 24px 0;
            box-shadow: 0 2px 8px rgba(22,223,126,0.15);
            transition: background 0.2s;
        }
        .cta-button:hover {
            background: linear-gradient(90deg, #0552b6 0%, #0084ff 100%);
        }
        .email-footer {
            background: #00509a;
            color: #ffffff;
            text-align: center;
            font-size: 0.95rem;
            padding: 18px 0 10px 0;
            border-top: 1px solid #eaeaea;
        }
        @media (max-width: 600px) {
            .email-container { width: 98% !important; }
            .email-body { padding: 18px 8px 8px 8px; }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <img src="https://img.icons8.com/clouds/100/000000/handshake.png" alt="FITNEX Logo">
            <h1>Welcome to FITNEX!</h1>
        </div>
        <div class="email-body">
            <p style="font-size:1.2rem; font-weight:500;">{{ $details['title'] }}</p>
            <p>{{ $details['body'] }}</p>
            <a href="{{ route('email-verification', $details['verify_token']) }}" class="cta-button" target="_blank">Confirm Account</a>
            <p style="margin-top:32px; color:#888;">If you did not create an account, no further action is required.</p>
        </div>
        <div class="email-footer">
            &copy; {{ date('Y') }} FITNEX. All rights reserved.<br>
            <span style="font-size:0.9em;">FITNEX</span>
        </div>
    </div>
</body>

</html>
