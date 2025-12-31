<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to FITNEX</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #0079D4;
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 0 0 5px 5px;
        }
        .credentials-box {
            background-color: white;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
            border-left: 4px solid #0079D4;
        }
        .credential-item {
            margin: 10px 0;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 3px;
        }
        .credential-label {
            font-weight: bold;
            color: #555;
            display: inline-block;
            width: 100px;
        }
        .credential-value {
            color: #0079D4;
            font-weight: bold;
            font-family: monospace;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #0079D4;
            color: white !important;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: bold;
        }
        .button:hover {
            background-color: #005a9f;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            color: #666;
            font-size: 12px;
        }
        .warning {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Welcome to FITNEX!</h1>
        <p>Your Trainer Account Has Been Created</p>
    </div>

    <div class="content">
        <p>Dear {{ $user->name }},</p>

        <p>We're excited to welcome you to FITNEX as a trainer! Your account has been successfully created and you can now access your trainer dashboard.</p>

        <div class="credentials-box">
            <h3 style="margin-top: 0; color: #0079D4;">Your Login Credentials</h3>

            <div class="credential-item">
                <span class="credential-label">Email:</span>
                <span class="credential-value">{{ $user->email }}</span>
            </div>

            <div class="credential-item">
                <span class="credential-label">Password:</span>
                <span class="credential-value">{{ $password }}</span>
            </div>
        </div>

        <div class="warning">
            <strong>⚠️ Important:</strong> Please change your password after your first login for security purposes.
        </div>

        <div style="text-align: center;">
            <a href="{{ $loginUrl }}" class="button">Login to Dashboard</a>
        </div>

        <p>Once you log in, you'll be able to:</p>
        <ul>
            <li>Manage your availability and time slots</li>
            <li>View and manage your bookings</li>
            <li>Update your profile and pricing</li>
            <li>Connect your Google Calendar</li>
            <li>Track your training sessions</li>
        </ul>

        <p>If you have any questions or need assistance, please don't hesitate to contact our support team.</p>

        <p>Best regards,<br>
        <strong>The FITNEX Team</strong></p>

        <div class="footer">
            <p>This is an automated email. Please do not reply to this message.</p>
            <p>&copy; {{ date('Y') }} FITNEX. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
