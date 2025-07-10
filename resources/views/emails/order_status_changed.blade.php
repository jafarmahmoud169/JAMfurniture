<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f2f5fa;
      margin: 0;
      padding: 40px;
    }
    .email-wrapper {
      max-width: 600px;
      margin: auto;
      background: #ffffff;
      border-radius: 10px;
      padding: 30px;
      box-shadow: 0 0 10px rgba(0,0,0,0.06);
    }
    h3 {
      color: #333;
      font-size: 22px;
      margin-bottom: 20px;
    }
    p {
      color: #555;
      font-size: 16px;
      line-height: 1.6;
    }
    .status {
      color: #38b6ff;
      font-weight: bold;
    }
    .footer {
      margin-top: 30px;
      font-size: 14px;
      color: #aaa;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="email-wrapper">
    <h3>Hello {{ $order->user->name }},</h3>
<p>We’re reaching out to inform you that the status of your order placed on <strong>{{ $order->created_at }}</strong> has been updated.</p>
    <p>📦 New status: <span class="status">{{ $newStatus }}</span></p>
    
    <p>Thank you for choosing our service. We’re always here to serve you better!</p>
    <div class="footer">© 2025 JAMfurniture. All rights reserved.</div>
  </div>
</body>
</html>
