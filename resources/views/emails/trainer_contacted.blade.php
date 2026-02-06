<!DOCTYPE html>
<html>
<head>
    <title>New Inquiry</title>
</head>
<body>
    <h1>New Inquiry</h1>
    <p>You have received a new inquiry from the website. Here are the details:</p>
    <ul>
        <li><strong>Name:</strong> {{ $contact->name }}</li>
        <li><strong>Email:</strong> {{ $contact->email }}</li>
        <li><strong>Phone:</strong> {{ $contact->phone }}</li>
    </ul>
    <p><strong>Message:</strong></p>
    <p>{{ $contact->message }}</p>
    <p>Thank you!</p>
</body>
</html> 