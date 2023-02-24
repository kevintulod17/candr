<?php
// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'try_db');

// Check if the connection was successful
if (!$conn) {
    die('Failed to connect to database: ' . mysqli_connect_error());
}

// Get the order ID from the AJAX request
$id = $_POST['id'];

// Update the payment status in the database
$query = "UPDATE orders SET order_status = 1 WHERE id = $id";

if (mysqli_query($conn, $query)) {
    // If the update was successful, return a success response
    echo 'success';
} else {
    // If the update failed, return an error response
    echo 'error';
}

// Close the database connection
mysqli_close($conn);
?>