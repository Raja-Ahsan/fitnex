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
            <h1>✓ Payment Successful!</h1>
        </div>

        <div class="content">
            <p>Hi {{ $customer->name }},</p>

            <p>Your payment has been processed successfully and your training session is now confirmed!</p>

            <div class="booking-details">
                <h3>Payment Details</h3>
                <p><strong>Amount Paid:</strong> ${{ number_format($booking->price, 2) }}</p>
                <p><strong>Payment Status:</strong> Paid</p>
                <p><strong>Transaction Date:</strong> {{ now()->format('M d, Y h:i A') }}</p>
            </div>

            <div class="booking-details">
                <h3>Booking Details</h3>
                <p><strong>Booking ID:</strong> #{{ $booking->id }}</p>
                <p><strong>Trainer:</strong> {{ $trainer->name }}</p>
                <p><strong>Date:</strong> {{ $booking->timeSlot->formatted_date }}</p>
                <p><strong>Time:</strong> {{ $booking->timeSlot->formatted_time }}</p>
            </div>

            <p style="text-align: center;">
                <a href="{{ url('/customer/bookings/' . $booking->id) }}" class="button">View Booking</a>
            </p>

            <p>A calendar invitation has been sent to your email. We look forward to seeing you!</p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} Fitnex. All rights reserved.</p>
        </div>
    </div>
</body>

</html>