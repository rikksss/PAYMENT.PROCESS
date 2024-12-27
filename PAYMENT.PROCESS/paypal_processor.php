<?php
$connection = new mysqli('localhost', 'root', '', 'paypal_integration');

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$user = $_POST['user'];
$transaction_id = $_POST['transaction_id'];
$transaction_status = $_POST['transaction_status'];
$name = $_POST['name'];
$email = $_POST['email '];

$sql = "INSERT INTO transactions (user_id, transaction_id, transaction_status, name, email) VALUES (?, ?, ?, ?, ?)";
$stmt = $connection->prepare($sql);
$stmt->bind_param("issss", $user, $transaction_id, $transaction_status, $name, $email);

if ($stmt->execute()) {
    echo "Transaction recorded successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$connection->close();
?>