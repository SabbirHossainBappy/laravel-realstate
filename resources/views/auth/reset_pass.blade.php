<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .email-content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            background-color: #007BFF;
            color: white;
            padding: 10px;
            border-radius: 10px 10px 0 0;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            margin: 20px 0;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .button {
            text-align: center;
            margin-top: 20px;
        }

        .submit-btn {
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #888888;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="email-content">
            <div class="header">
                <h1>Password Reset Request</h1>
            </div>
            <div class="content">
                <p>Hello,</p>
                <p>We received a request to reset your password. Please enter your new password below:</p>

                <form action="{{ url('set_new_password/' . $token) }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="new_password">New Password:</label>
                        <input type="password" id="new_password" name="new_password" required>
                        <span style="color:red">{{ $errors->first('password') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="confirmed_password">Confirm Password:</label>
                        <input type="password" id="confirmed_password" name="confirmed_password" required>
                        <span style="color:red">{{ $errors->first('confirmed_password') }}</span>
                    </div>
                    <div class="button">
                        <input type="submit" value="RESET PASSWORD" style="margin-top: 23px;">
                    </div>
                </form>

                <p>If you did not request a password reset, please ignore this email or contact support if you have any
                    concerns.</p>
                <p>Thank you,<br>The @Bagina Team</p>
            </div>
            <div class="footer">
                <p>&copy; 2024 @Bagina. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>

</html>
