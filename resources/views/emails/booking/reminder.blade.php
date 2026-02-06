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
            background-color: #2196F3;
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
            border-left: 4px solid #2196F3;
        }

        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #2196F3;
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
            <h1>⏰ Reminder: Training Session Tomorrow</h1>
        </div>

        <div class="content">
            <p>Hi {{ $customer->name }},</p>

            <p>This is a friendly reminder that you have a training session scheduled for tomorrow!</p>

            <div class="booking-details">
                <h3>Session Details</h3>
                <p><strong>Trainer:</strong> {{ $trainer->name }}</p>
                <p><strong>Date:</strong> {{ $booking->timeSlot->formatted_date }}</p>
                <p><strong>Time:</strong> {{ $booking->timeSlot->formatted_time }}</p>
                <p><strong>Duration:</strong> {{ $booking->timeSlot->availability->session_duration ?? 'N/A' }} minutes
                </p>
            </div>

            <p><strong>Preparation Tips:</strong></p>
            <ul>
                <li>Arrive 5 minutes early</li>
                <li>Wear comfortable workout clothes</li>
                <li>Bring water and a towel</li>
                <li>Eat a light meal 1-2 hours before</li>
            </ul>

            <p style="text-align: center;">
                <a href="{{ url('/customer/bookings/' . $booking->id) }}" class="button">View Booking Details</a>
            </p>

            <p>If you need to cancel or reschedule, please do so as soon as possible.</p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} Fitnex. All rights reserved.</p>
        </div>
    </div>
</body>

</html>