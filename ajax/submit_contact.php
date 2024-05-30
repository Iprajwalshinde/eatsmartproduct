<?php
header('Content-Type: application/json');

// Database connection
include '../connections.php';

// Check connection
if ($conn->connect_error) {
    echo json_encode("Connection failed: " . $conn->connect_error);
    exit();
}

// Collect form data
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO contact (name, email, subject, message) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $subject, $message);

// Execute the statement
if ($stmt->execute() === TRUE) {
    echo json_encode("Your message has been successfully sent.");
} else {
    echo json_encode("Error: " . $stmt->error);
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
