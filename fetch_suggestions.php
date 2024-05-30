<?php
// Database connection
include 'connections.php';
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Get user input from AJAX request
$input = isset($_GET['input']) ? $_GET['input'] : '';

// Escape the input to prevent SQL Injection
$input_escaped = mysqli_real_escape_string($conn, $input);

// SQL query to fetch data
$query = "SELECT productName FROM products WHERE productName LIKE '%$input_escaped%'";

$result = mysqli_query($conn, $query);

$suggestions = [];

while ($row = mysqli_fetch_assoc($result)) {
    $suggestions[] = $row['productName'];
}

// Close connection
mysqli_close($conn);

// Output the suggestions as JSON
echo json_encode($suggestions);
?>
