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

        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #f44336;
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
            <h1>Payment Failed</h1>
        </div>

        <div class="content">
            <p>Hi {{ $customer->name }},</p>

            <p>Unfortunately, your payment for the training session could not be processed.</p>

            <div class="booking-details">
                <h3>Booking Details</h3>
                <p><strong>Booking ID:</strong> #{{ $booking->id }}</p>
                <p><strong>Trainer:</strong> {{ $booking->trainer->name }}</p>
                <p><strong>Date:</strong> {{ $booking->timeSlot->formatted_date }}</p>
                <p><strong>Time:</strong> {{ $booking->timeSlot->formatted_time }}</p>
                <p><strong>Amount:</strong> ${{ number_format($booking->price, 2) }}</p>
            </div>

            <div style="background-color: #fff3cd; padding: 15px; margin: 15px 0; border-left: 4px solid #ffc107;">
                <p><strong>What to do next:</strong></p>
                <ul>
                    <li>Check your payment method details</li>
                    <li>Ensure sufficient funds are available</li>
                    <li>Try booking again with a different payment method</li>
                </ul>
            </div>

            <p>The time slot has been released and is available for rebooking. Please try again when you're ready.</p>

            <p style="text-align: center;">
                <a href="{{ url('/customer/trainers') }}" class="button">Browse Trainers</a>
            </p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} Fitnex. All rights reserved.</p>
            <p>If you continue to experience issues, please contact support.</p>
        </div>
    </div>
</body>

</html>