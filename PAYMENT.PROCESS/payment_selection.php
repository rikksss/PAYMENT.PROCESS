<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Payment Method</title>
    <style>
       body {
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background: url('images/Lazapee.png') no-repeat center center fixed; /* Example background */
        background-size: cover; /* Ensures the background covers the entire area */
    }
    .payment-wrapper {
        text-align: center;
        background: rgba(255, 255, 255, 0.8); /* Slightly transparent background */
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }
        h1 {
            margin-bottom: 20px;
            color: #333;
        }
        button {
            padding: 10px 20px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .paypal {
            background-color: #0070ba;
            color: white;
        }
        .gcash {
            background-color: #00a1e0;
            color: white;
        }
        .paymaya {
            background-color: #ff4b4b;
            color: white;
        }
    </style>
</head>
<body>

    <div class="payment-wrapper">
        <h1>Select Payment Method</h1>
        <button class="paypal" onclick="window.location.href='payment.page.php'">PayPal</button>
        <button class="gcash" onclick="alert('GCash payment option is not yet implemented.')">GCash</button>
        <button class="paymaya" onclick="alert('PayMaya payment option is not yet implemented.')">PayMaya</button>
    </div>

</body>
</html>
