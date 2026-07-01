<!DOCTYPE html>
<html>
<head>
    <title>New Free Trial Signup</title>
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
        .email-header h1 {
            color: #fff;
            margin: 0;
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .email-body {
            padding: 32px;
            color: #333;
            text-align: left;
        }
        .email-body p {
            font-size: 1.05rem;
            margin: 0 0 16px 0;
        }
        .details-list {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        .details-list li {
            padding: 8px 0;
            border-bottom: 1px solid #e5e5e5;
        }
        .details-list li:last-child {
            border-bottom: none;
        }
        .email-footer {
            background: #00509a;
            color: #ffffff;
            text-align: center;
            font-size: 0.95rem;
            padding: 18px 0 10px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Free Trial Signup</h1>
        </div>
        <div class="email-body">
            <p>A new free 7-day trial signup was submitted from the homepage:</p>
            <ul class="details-list">
                <li><strong>Name:</strong> {{ $signup->name }}</li>
                <li><strong>Email:</strong> {{ $signup->email }}</li>
                <li><strong>Phone:</strong> {{ $signup->phone }}</li>
                <li><strong>Service:</strong> {{ $serviceLabel ?? $signup->service ?? 'Not specified' }}</li>
            </ul>
        </div>
        <div class="email-footer">
            &copy; {{ date('Y') }} FITNEX. All rights reserved.
        </div>
    </div>
</body>
</html>
