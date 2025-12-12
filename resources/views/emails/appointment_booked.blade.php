<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Appointment Booked</title>
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
            background-color: #007bff;
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
            border-left: 4px solid #007bff;
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
        <h1>Appointment Booked Successfully!</h1>
    </div>
    
    <div class="content">
        <p>Dear {{ $clientName ?? ($user->name ?? $appointment->name) }},</p>
        
        <p>Your appointment has been successfully booked with <strong>{{ $trainer->name }}</strong>.</p>
        
        <div class="appointment-details">
            <h3>Appointment Details:</h3>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('l, F j, Y') }}</p>
            @php
                $startTime = \Carbon\Carbon::parse($appointment->appointment_time);
                $dayOfWeek = \Carbon\Carbon::parse($appointment->appointment_date)->dayOfWeek;
                $availability = \App\Models\Availability::where('trainer_id', $appointment->trainer_id)
                    ->where('day_of_week', $dayOfWeek)
                    ->where('is_active', true)
                    ->first();
                $sessionDuration = (int) ($availability->session_duration ?? 60); // Cast to int
                $endTime = $startTime->copy()->addMinutes($sessionDuration);
            @endphp
            <p><strong>Time:</strong> {{ $startTime->format('g:i A') }} - {{ $endTime->format('g:i A') }}</p>
            <p><strong>Time Zone:</strong> {{ $appointment->time_zone }}</p>
            <p><strong>Trainer:</strong> {{ $trainer->name }}</p>
            <p><strong>Price:</strong> ${{ number_format($appointment->price, 2) }}</p>
            <p><strong>Status:</strong> 
                <span class="status {{ $appointment->status }}">
                    {{ ucfirst($appointment->status) }}
                </span>
            </p>
            @if($appointment->description)
                <p><strong>Description:</strong> {{ $appointment->description }}</p>
            @endif
        </div>

        @if($appointment->status === 'pending')
            <p><strong>Payment Required:</strong> Please complete your payment to confirm your appointment. You will receive a separate email with payment instructions.</p>
        @else
            <p><strong>Appointment Confirmed:</strong> Your appointment is confirmed and ready to go!</p>
        @endif

        <p>If you have any questions or need to make changes to your appointment, please contact us.</p>
        
        <p>Thank you for choosing our services!</p>
    </div>
    
    <div class="footer">
        <p>This is an automated message. Please do not reply to this email.</p>
        <p>&copy; {{ date('Y') }} FitNex. All rights reserved.</p>
    </div>
</body>
</html> 