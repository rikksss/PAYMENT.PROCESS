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
        /* Loading Screen Styles */
        #loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            display: none; /* Hidden by default */
            justify-content: center;
            align-items: center;
            z-index: 1000; /* Ensure it is on top */
        }
        #loading-icon {
            width: 50px; /* Size of the loading icon */
            height: 50px;
            border: 5px solid #0070ba; /* Border color */
            border-top: 5px solid transparent; /* Top border transparent for spinning effect */
            border-radius: 50%;
            animation: spin 1s linear infinite, elastic 0.5s ease-in-out infinite; /* Animation */
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        @keyframes elastic {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }
        #loading-message {
            font-size: 24px;
            color: #333;
            margin-top: 10px; /* Space between icon and message */
        }
    </style>
</head>
<body>

    <div class="payment-wrapper">
        <h1>Select Payment Method</h1>
        <button class="paypal" onclick="showLoading('payment.page.php')">PayPal</button>
        <button class="gcash" onclick="alert('GCash payment option is not yet implemented.')">GCash</button>
        <button class="paymaya" onclick="alert('PayMaya payment option is not yet implemented.')">PayMaya</button>
    </div>

    <!-- Loading Screen -->
    <div id="loading-screen">
        <div>
            <div id="loading-icon"></div>
            <div id="loading-message">Loading, please wait...</div>
        </div>
    </div>

    <script>
        function showLoading(url) {
            // Show the loading screen
            document.getElementById('loading-screen').style.display = 'flex';
            // Redirect after a short delay to allow the loading screen to appear
            setTimeout(function() {
                window.location.href = url;
            }, 500); // Adjust the delay as needed
        }
    </script>

</body>
</html>
