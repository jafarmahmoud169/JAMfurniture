<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'Arial', sans-serif; background-color: #f4f4f4; padding: 20px; }
        .email-container { background: white; padding: 30px; border-radius: 10px; }
        h2 { color: #333; }
        .code { background: #eee; padding: 10px; font-size: 20px; border-radius: 5px; text-align: center; }
        .footer { font-size: 12px; color: #888; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="email-container">
        <h2>Hello {{ $name }},</h2>
        <p>Thank you for signing up with <strong>JAMfurniture</strong> 🪑</p>
        <p>Please use the following code to verify your email:</p>
        <div class="code">{{ $code }}</div>
        <p>If you didn't sign up, you can ignore this email.</p>
        <div class="footer">JAMfurniture • Syria</div>
    </div>
</body>
</html>
