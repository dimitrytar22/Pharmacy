<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Form Submission Confirmation</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
            color: #333333;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background-color: #007bff;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }

        .email-content {
            padding: 20px;
            line-height: 1.5;
        }

        .email-content h2 {
            font-size: 20px;
            margin-top: 0;
        }

        .email-content p {
            margin: 10px 0;
        }

        .email-footer {
            background-color: #f9f9f9;
            text-align: center;
            padding: 15px;
            font-size: 12px;
            color: #666666;
        }

        .button {
            display: inline-block;
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 20px;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="email-header">
        <h1>New User Message Received!</h1>
    </div>

    <div class="email-content">
        <h2>New Message from a User</h2>
        <p>You have received a new message sent via the contact form on your website.</p>
        <p><strong>Sender's Details:</strong></p>
        <p><strong>Name:</strong> {{ $data['name'] }}</p>
        <p><strong>Email:</strong> {{ $data['email'] }}</p>
        <p><strong>Message:</strong></p>
        <p>{{ $data['message'] }}</p>
        <p>Please contact the user if additional information or clarification is required regarding their inquiry.</p>
    </div>


    <div class="email-footer">
        <p>© {{date('Y')}} Pharmacy. All rights reserved.</p>
    </div>
</div>
</body>
</html>

