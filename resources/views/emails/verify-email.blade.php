<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Verify Your Email</title>
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
            padding: 40px 0;
            background-color: #f4f4f7;
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
            background:rgb(0, 0, 0);
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
                Hi there, <br>
                Thank you for registering on <strong>{{ config('app.name') }}</strong>! <br>
                Please click the button below to verify your email address:
                
                <br>
                <span style="text-align:center;">
                    <a href="{{ $url }}" class="button" style="color: #ffffff"> Verify Email </a>
                </span>
                <br>
                <br>

                This link will expire in 60 minutes. <br>
                If you did not create an account, please ignore this email. <br><br>

                Cheers,<br>The {{ config('app.name') }} Team
            </div>
            <div class="footer">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </div>
        </div>
    </div>
</body>

</html>