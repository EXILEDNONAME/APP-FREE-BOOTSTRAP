<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
    <style>
        body {
            font-family: "Segoe UI", Roboto, Arial, sans-serif;
            background-color: #f4f4f7;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .email-wrapper {
            width: 100%;
            background-color: #f4f4f7;
            padding: 40px 0;
        }

        .email-content {
            max-width: 520px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .header {
            background: linear-gradient(135deg,rgb(0, 0, 0),rgb(0, 0, 0));
            color: #fff;
            text-align: center;
            padding: 25px 20px;
        }

        .header h1 {
            font-size: 22px;
            margin: 0;
            font-weight: 600;
        }

        .body {
            padding: 30px 40px;
            text-align: left;
        }

        .body p {
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 16px;
        }

        .button {
            display: inline-block;
            background: rgb(0, 0, 0);
            color: #fff;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: 600;
            margin-top: 20px;
        }

        .button:hover {
            background: rgb(100, 0, 0);
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #888;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <div class="email-content">
            <div class="header">
                <h1>{{ config('app.name') }}</h1>
            </div>
            <div class="body">
                <p>Hi {{ $user->name ?? 'there' }},</p>
                <p>We received a request to reset your password for your <strong>{{ config('app.name') }}</strong> account.</p>
                <p>Click the button below to reset your password:</p>
                <p style="text-align:center;">
                    <a href="{{ $url }}" class="button" style="color: #ffffff">Reset Password</a>
                </p>
                <p>If you didn’t request this, you can safely ignore this email.</p>
                <p>Thanks,<br>The {{ config('app.name') }} Team</p>
            </div>
            <div class="footer">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </div>
        </div>
    </div>
</body>

</html>