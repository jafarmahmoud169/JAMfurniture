<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Special Offer</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f8fb;
      color: #333;
      padding: 20px;
      margin: 0;
    }
    .container {
      max-width: 600px;
      background-color: #fff;
      margin: auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0,0,0,0.08);
    }
    h2 {
      color: #38b6ff;
      font-size: 28px;
      margin-bottom: 20px;
    }
    .price {
      font-size: 18px;
      margin: 10px 0;
    }
    .highlight {
      color: #e60023;
      font-weight: bold;
    }
    .button {
      display: inline-block;
      background-color: #38b6ff;
      color: white;
      padding: 12px 24px;
      text-decoration: none;
      border-radius: 6px;
      font-weight: bold;
      margin-top: 20px;
    }
    .product-name {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 10px;
      color: #222;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>🔥 Limited-Time Offer!</h2>
    <div class="product-name">{{ $productName }}</div>
    <p>We've applied a <span class="highlight">{{ $discount }}$</span> discount!</p>
    <p class="price">Old Price: <del>${{ $price }}</del></p>
    <p class="price">New Price: <span class="highlight">${{ $price - $discount }}</span></p>
    <a href="#" class="button">Shop Now</a>
  </div>
</body>
</html>
