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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $name = $_POST['name'];
    $email = $_POST['email'];
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
            background-color: #f4f4f4;
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
            background: white;
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

        input[type="text"], input[type="email"] {
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

        .success-message {
            color: green;
            margin-top: 20 
px;
        }

        .transaction-summary {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
    </style>
    <script src="https://www.paypal.com/sdk/js?client-id=AYxFM5_jJc38rZWWuuuP4OgPJiTtM7mQ4U7ohuiWPhYu552lHjV0reoYZljyXsWFLn-A27jZMTpPagsI"></script> <!-- Replace with your PayPal client ID -->
</head>
<body>

    <div class="center-wrapper">
        <h1>Checkout</h1>
        <form id="payment-form" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="text" id="amount" name="amount" value="<?php echo number_format($total_amount, 2); ?>" readonly>
            </div>
            <div id="paypal-button-container"></div>
        </form>
        <div class="footer">Secure payment processing</div>
        <div id="success-message" class="success-message" style="display:none;"></div>
        <div id="transaction-summary" class="transaction-summary" style="display:none;"></div>
    </div>

    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?php echo $total_amount; ?>' // Total amount
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Handle successful payment
                    console.log('Transaction completed by ' + details.payer.name.given_name);
                    
                    // Get user input from the form
                    var name = document.getElementById('name').value;
                    var email = document.getElementById('email').value;

                    // Create a form data object
                    var formData = new FormData();
                    formData.append('transaction_id', details.id);
                    formData.append('name', name);
                    formData.append('email', email);

                    // Send the data to the server for processing
                    fetch('process_payment.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Display success message and transaction summary
                            document.getElementById('success-message').innerText = data.message;
                            document.getElementById('success-message').style.display = 'block';
                            document.getElementById('transaction-summary').innerHTML = `
                                <strong>Transaction ID:</strong> ${data.transaction_id}<br>
                                <strong>Amount:</strong> $${data.amount}
                            `;
                            document.getElementById('transaction-summary').style.display = 'block';

                            // Redirect to user_dashboard.php after a delay
                            setTimeout(function() {
                                window.location.href = 'user_dashboard.php';
                            }, 5000); // Redirect after 5 seconds
                        } else {
                            console.error('Error processing payment:', data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });
            },
            onError: function(err) {
                console.error('An error occurred during the transaction', err);
            }
        }).render('#paypal-button-container'); // Display PayPal button
    </script>

</body>
</html>