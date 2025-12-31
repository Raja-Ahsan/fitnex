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
            background-color: #f44336;
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
            border-left: 4px solid #f44336;
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
            <h1>Booking Cancelled</h1>
        </div>

        <div class="content">
            <p>Hi {{ $customer->name }},</p>

            <p>Your booking has been cancelled.</p>

            <div class="booking-details">
                <h3>Cancelled Booking Details</h3>
                <p><strong>Booking ID:</strong> #{{ $booking->id }}</p>
                <p><strong>Trainer:</strong> {{ $booking->trainer->name }}</p>
                <p><strong>Date:</strong> {{ $booking->timeSlot->formatted_date }}</p>
                <p><strong>Time:</strong> {{ $booking->timeSlot->formatted_time }}</p>
                @if($booking->cancellation_reason)
                    <p><strong>Reason:</strong> {{ $booking->cancellation_reason }}</p>
                @endif
            </div>

            @if($booking->payment_status === 'paid')
                <div style="background-color: #fff3cd; padding: 15px; margin: 15px 0; border-left: 4px solid #ffc107;">
                    <p><strong>Refund Information:</strong></p>
                    <p>Your payment will be refunded within 5-7 business days.</p>
                </div>
            @endif

            <p>We're sorry this session didn't work out. Feel free to book another session at your convenience.</p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} Fitnex. All rights reserved.</p>
        </div>
    </div>
</body>

</html>