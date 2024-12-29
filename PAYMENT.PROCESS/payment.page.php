<?php
// Start the session
session_start();

// Include database connection file
$connection = new mysqli('localhost', 'root', '', 'paypal_integration');

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Set the total amount for the payment
$total_amount = 200.00; // Change this value as needed

// Check if the form is submitted
if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
    // Get user input
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $order_notes = $_POST['order_notes']; // Changed from comments to order_notes

    // Save the transaction details in the session
    $_SESSION['transaction_details'] = [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'address' => $address,
        'order_notes' => $order_notes,
        'amount' => $total_amount
    ];
}

// Redirect to user_dashboard.php if transaction_id is set
if (isset($_SESSION['transaction_id'])) {
    header("Location: user_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('images/Lazapee.png') no-repeat center center fixed; /* Add your GIF URL here */
            background-size: cover; /* Ensures the background covers the entire viewport */
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            transition: opacity 0.5s ease; /* Smooth transition for opacity */
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
    <script src="https://www.paypal.com/sdk/js?client-id=AYxFM5_jJc38rZWWuuuP4OgPJiTtM7mQ4U7ohuiWPhYu552lHjV0reoYZljyXsWFLn-A27jZMTpPagsI"></script> <!-- Replace with your PayPal client ID -->
</head>
<body>

    <div class="center-wrapper">
        <h1>Payment Form</h1>
        <form id="payment-form" method="POST">
            <div class="form-group ">
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
                <label for="order_notes">Order Notes:</label>
                <textarea id="order_notes" name="order_notes" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="text" id="amount" name="amount" value="<?php echo number_format($total_amount, 2); ?>" readonly>
            </div>
            <div id="paypal-button-container"></div>
            <button id="checkout-button" class="checkout-button" onclick="saveTransaction()">Checkout</button>
        </form>
        <div class="footer">Thank you for your payment!</div>
    </div>

    <script>
        let transactionCompleted = false;

        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?php echo $total_amount; ?>'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Handle successful payment here
                    alert('Transaction completed by ' + details.payer.name.given_name);
                    transactionCompleted = true; // Set flag to true
                    document.getElementById('checkout-button').style.display = 'block'; // Show checkout button
                });
            }
        }).render('#paypal-button-container');

        function saveTransaction() {
            if (transactionCompleted) {
                // Send the form data to the server to save it
                const formData = new FormData(document.getElementById('payment-form'));
                fetch('save_transaction.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    alert('Transaction saved successfully!');
                    // Optionally redirect or update the UI
                })
                .catch(error => {
                    console.error('Error saving transaction:', error);
                });
            } else {
                alert('Please complete the payment first.');
            }
        }
    </script>
</body>
</html>
