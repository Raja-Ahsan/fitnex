<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Appointment Booking</title>
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
            background-color: #17a2b8;
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
            border-left: 4px solid #17a2b8;
        }
        .client-info {
            background-color: #e3f2fd;
            padding: 15px;
            margin: 15px 0;
            border-radius: 5px;
            border-left: 4px solid #2196f3;
        }
        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 3px;
            font-weight: bold;
            font-size: 12px;
            text-transform: uppercase;
        }
        .status.pending {
            background-color: #ffc107;
            color: #856404;
        }
        .status.confirmed {
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
        <h1>New Appointment Booking</h1>
    </div>
    
    <div class="content">
        <p>Dear {{ $trainer->name }},</p>
        
        <p>You have received a new appointment booking from <strong>{{ $clientName ?? ($user->name ?? $appointment->name) }}</strong>.</p>
        
        <div class="client-info">
            <h3>Client Information:</h3>
            <p><strong>Name:</strong> {{ $clientName ?? ($user->name ?? $appointment->name) }}</p>
            <p><strong>Email:</strong> {{ $clientEmail ?? ($user->email ?? $appointment->email) }}</p>
        </div>
        
        <div class="appointment-details">
            <h3>Appointment Details:</h3>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('l, F j, Y') }}</p>
            <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}</p>
            <p><strong>Time Zone:</strong> {{ $appointment->time_zone }}</p>
            <p><strong>Price:</strong> ${{ number_format($appointment->price, 2) }}</p>
            <p><strong>Status:</strong> 
                <span class="status {{ $appointment->status }}">
                    {{ ucfirst($appointment->status) }}
                </span>
            </p>
            @if($appointment->description)
                <p><strong>Client Notes:</strong> {{ $appointment->description }}</p>
            @endif
        </div>

        @if($appointment->status === 'pending')
            <p><strong>Payment Status:</strong> Pending - The client will complete payment to confirm this appointment.</p>
        @else
            <p><strong>Payment Status:</strong> Completed - The appointment is confirmed and ready to proceed.</p>
        @endif

        <p>Please review the appointment details and prepare for the session. If you need to make any changes or have conflicts, please contact the client or the administration team.</p>
        
        <p>Thank you for your dedication to our clients!</p>
    </div>
    
    <div class="footer">
        <p>This is an automated message. Please do not reply to this email.</p>
        <p>&copy; {{ date('Y') }} FitNex. All rights reserved.</p>
    </div>
</body>
</html> 