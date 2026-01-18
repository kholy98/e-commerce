<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply to Your Contact Inquiry</title>
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
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .content {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .footer {
            font-size: 12px;
            color: #6c757d;
            text-align: center;
            margin-top: 20px;
        }
        .original-inquiry {
            background-color: #f8f9fa;
            padding: 15px;
            border-left: 4px solid #007bff;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Reply to Your Contact Inquiry</h2>
        <p>Dear {{ $inquiry->full_name }},</p>
    </div>

    <div class="content">
        <p>Thank you for contacting us. We have received your inquiry and would like to provide the following response:</p>

        <div style="background-color: #f8f9fa; padding: 15px; border-radius: 5px; margin: 20px 0;">
            <strong>Our Reply:</strong><br>
            {!! nl2br(e($replyMessage)) !!}
        </div>

        <div class="original-inquiry">
            <strong>Your Original Inquiry:</strong><br>
            <p><strong>Name:</strong> {{ $inquiry->full_name }}</p>
            <p><strong>Email:</strong> {{ $inquiry->email }}</p>
            @if($inquiry->phone)
                <p><strong>Phone:</strong> {{ $inquiry->phone }}</p>
            @endif
            @if($inquiry->company)
                <p><strong>Company:</strong> {{ $inquiry->company }}</p>
            @endif
            <p><strong>Message:</strong></p>
            <div style="background-color: white; padding: 10px; border-radius: 3px;">
                {!! nl2br(e($inquiry->message)) !!}
            </div>
            <p><strong>Submitted on:</strong> {{ $inquiry->created_at->format('F j, Y \a\t g:i A') }}</p>
        </div>

        <p>If you have any further questions or need additional assistance, please don't hesitate to contact us.</p>

        <p>Best regards,<br>
        The Support Team</p>
    </div>

    <div class="footer">
        <p>This is an automated response to your inquiry. Please do not reply to this email.</p>
        <p>&copy; {{ date('Y') }} Your Company Name. All rights reserved.</p>
    </div>
</body>
</html>