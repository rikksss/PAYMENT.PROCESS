<?php
// Include database connection file
$connection = new mysqli('localhost', 'root', '', 'paypal_integration');

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Get user input from the form
$user_id = 1; // You can set this dynamically based on your application logic
$transaction_id = uniqid(); // Generate a unique transaction ID
$transaction_status = 'Completed'; // Set the status based on your logic
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$order_notes = $_POST['order_notes'];

// Prepare and bind
$sql = "INSERT INTO transactions (user_id, transaction_id, transaction_status, name, email, phone, address, order_notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $connection->prepare($sql);
$stmt->bind_param("isssssss", $user_id, $transaction_id, $transaction_status, $name, $email, $phone, $address, $order_notes);

// Execute the statement
if ($stmt->execute()) {
    echo "Transaction recorded successfully.";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$connection->close();
?>
