<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'Arial', sans-serif; background-color: #f4f4f4; padding: 20px; }
        .email-container { background: white; padding: 30px; border-radius: 10px; }
        h2 { color: #333; }
        .code { background: #eee; padding: 10px; font-size: 20px; border-radius: 5px; text-align: center; }
        .note { color: #888; font-size: 13px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="email-container">
        <h2>Hello {{ $name }},</h2>
        <p>We received a request to reset your password for <strong>JAMfurniture</strong>.</p>
        <p>Please use the following code to reset your password:</p>
        <div class="code">{{ $code }}</div>
        <p class="note">This code will expire in 10 minutes. If you didn’t request this, you can safely ignore it.</p>
    </div>
</body>
</html>
