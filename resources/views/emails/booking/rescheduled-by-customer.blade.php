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
            background-color: #FF9800;
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
            border-left: 4px solid #FF9800;
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
            <h1>Booking Rescheduled</h1>
        </div>

        <div class="content">
            <p>Hi {{ $trainer->name }},</p>

            <p>A customer has rescheduled their booking with you.</p>

            <div class="booking-details">
                <h3>Previous Schedule</h3>
                <p><strong>Date & Time:</strong> {{ $old_datetime }}</p>
            </div>

            <div class="booking-details">
                <h3>New Schedule</h3>
                <p><strong>Booking ID:</strong> #{{ $booking->id }}</p>
                <p><strong>Customer:</strong> {{ $customer->name }}</p>
                <p><strong>Date:</strong> {{ $booking->timeSlot->formatted_date }}</p>
                <p><strong>Time:</strong> {{ $booking->timeSlot->formatted_time }}</p>
                <p><strong>Duration:</strong> {{ $booking->timeSlot->availability->session_duration ?? 'N/A' }} minutes
                </p>
            </div>

            <p>Please update your schedule accordingly.</p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} Fitnex. All rights reserved.</p>
        </div>
    </div>
</body>

</html>