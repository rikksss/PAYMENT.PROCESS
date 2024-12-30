<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Link to your CSS file -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('images/Lazapee.png') no-repeat center center fixed; /* Add your background image here */
            background-size: cover; /* Ensures the background covers the entire viewport */
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .center-wrapper {
            max-width: 400px;
            width: 100%;
            background: rgba(255, 255, 255, 0.8); /* Slightly transparent background for better readability */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"], input[type="email"], textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        #paypal-button-container {
            margin-top: 20px;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }

        .checkout-button {
            display: none; /* Initially hidden */
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
    <script src="https://www.paypal.com/sdk/js?client-id=AYxFM5_jJc38rZWWuuuP4OgPJiTtM7mQ4U7ohuiWPhYu552lHjV0reoYZljyXsWFLn-A27jZMTpPagsI"></script>
</head>
<body>

    <div class="center-wrapper">
        <h1>Payment Form</h1>
        <form id="payment-form" method="POST" action="{{ route('payment.process') }}">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="amount">Total Amount:</label>
                <input type="text" id="amount" name="amount" value="{{ $total_amount }}" readonly>
            </div>
            <div id="paypal-button-container"></div>
            <button type="submit" class="checkout-button">Checkout</button>
        </form>
        <div class="footer">Your payment is secure.</div>
    </div>

    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: document.getElementById('amount').value
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    document.getElementById(' payment-form').submit();
                });
            }
        }).render('#paypal-button-container'); // Render the PayPal button
    </script>
</body>
</html>