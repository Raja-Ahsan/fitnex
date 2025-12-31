<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .content {
            padding: 20px;
            background-color: #f9f9f9;
        }

        .booking-details {
            background-color: white;
            padding: 15px;
            margin: 15px 0;
            border-left: 4px solid #4CAF50;
        }

        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin: 10px 0;
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>✓ Booking Confirmed!</h1>
        </div>

        <div class="content">
            <p>Hi {{ $customer->name }},</p>

            <p>Great news! Your training session has been confirmed.</p>

            <div class="booking-details">
                <h3>Booking Details</h3>
                <p><strong>Booking ID:</strong> #{{ $booking->id }}</p>
                <p><strong>Trainer:</strong> {{ $trainer->name }}</p>
                <p><strong>Date:</strong> {{ $booking->timeSlot->formatted_date }}</p>
                <p><strong>Time:</strong> {{ $booking->timeSlot->formatted_time }}</p>
                <p><strong>Duration:</strong> {{ $booking->timeSlot->availability->session_duration ?? 'N/A' }} minutes
                </p>
                <p><strong>Price:</strong> ${{ number_format($booking->price, 2) }}</p>
            </div>

            @if($booking->notes)
                <p><strong>Your Notes:</strong> {{ $booking->notes }}</p>
            @endif

            <p>Please arrive 5 minutes early to prepare for your session.</p>

            <p style="text-align: center;">
                <a href="{{ url('/customer/bookings/' . $booking->id) }}" class="button">View Booking Details</a>
            </p>

            <p>If you need to reschedule or cancel, please do so at least 6 hours before your scheduled time.</p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} Fitnex. All rights reserved.</p>
            <p>This is an automated email. Please do not reply.</p>
        </div>
    </div>
</body>

</html>