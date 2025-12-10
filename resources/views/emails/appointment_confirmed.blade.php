<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Appointment Confirmed</title>
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
            background-color: #28a745;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 0 0 5px 5px;
        }
        .appointment-details {
            background-color: white;
            padding: 15px;
            margin: 15px 0;
            border-radius: 5px;
            border-left: 4px solid #28a745;
        }
        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 3px;
            font-weight: bold;
            font-size: 12px;
            text-transform: uppercase;
            background-color: #28a745;
            color: white;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            color: #6c757d;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Appointment Confirmed!</h1>
    </div>
    
    <div class="content">
        <p>Dear {{ $clientName ?? ($user->name ?? $appointment->name) }},</p>
        
        <p>Great news! Your appointment with <strong>{{ $trainer->name }}</strong> has been confirmed and payment has been received.</p>
        
        <div class="appointment-details">
            <h3>Appointment Details:</h3>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('l, F j, Y') }}</p>
            <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}</p>
            <p><strong>Time Zone:</strong> {{ $appointment->time_zone }}</p>
            <p><strong>Trainer:</strong> {{ $trainer->name }}</p>
            <p><strong>Price:</strong> ${{ number_format($appointment->price, 2) }}</p>
            <p><strong>Status:</strong> 
                <span class="status">Confirmed</span>
            </p>
            @if($appointment->description)
                <p><strong>Description:</strong> {{ $appointment->description }}</p>
            @endif
        </div>

        <p><strong>Payment Status:</strong> Completed</p>
        
        <p>Your trainer has been notified and will be ready for your session. Please arrive on time for your appointment.</p>
        
        <p>If you need to make any changes to your appointment or have any questions, please contact us as soon as possible.</p>
        
        <p>We look forward to seeing you!</p>
    </div>
    
    <div class="footer">
        <p>This is an automated message. Please do not reply to this email.</p>
        <p>&copy; {{ date('Y') }} FitNex. All rights reserved.</p>
    </div>
</body>
</html> 