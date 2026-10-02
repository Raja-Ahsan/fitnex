<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connect your Google Calendar</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #0079D4; color: white; padding: 30px; text-align: center; border-radius: 5px 5px 0 0; }
        .content { background-color: #f8f9fa; padding: 30px; border-radius: 0 0 5px 5px; }
        .steps { background-color: white; padding: 20px; margin: 20px 0; border-radius: 5px; border-left: 4px solid #0079D4; }
        .button { display: inline-block; padding: 12px 30px; background-color: #0079D4; color: white !important; text-decoration: none; border-radius: 5px; margin: 20px 0; font-weight: bold; }
        .footer { margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd; text-align: center; color: #666; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Sync your FITNEX bookings</h1>
        <p>Connect your Google Calendar in one click</p>
    </div>

    <div class="content">
        <p>Hi {{ $user->name }},</p>

        <p>Connect your Google Calendar to FITNEX so every confirmed session shows up on your phone automatically. Reschedules and cancellations stay in sync too.</p>

        <div class="steps">
            <h3 style="margin-top: 0; color: #0079D4;">How to connect</h3>
            <ol style="margin: 0; padding-left: 20px;">
                <li>Log in to your FITNEX trainer dashboard.</li>
                <li>Open <strong>Google Sync</strong> from the menu.</li>
                <li>Click <strong>Connect Google Calendar</strong> and choose your Gmail account.</li>
                <li>If Google shows “Google hasn’t verified this app”, click <strong>Advanced</strong> then <strong>Go to FITNEX</strong>, and allow calendar access.</li>
            </ol>
        </div>

        <div style="text-align: center;">
            <a href="{{ $connectUrl }}" class="button">Connect Google Calendar</a>
        </div>

        <p>FITNEX only creates and updates your booking events. We never read your personal events, and you can disconnect at any time.</p>

        <p>Best regards,<br>
        <strong>The FITNEX Team</strong></p>

        <div class="footer">
            <p>This is an automated email. Please do not reply to this message.</p>
            <p>&copy; {{ date('Y') }} FITNEX. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
