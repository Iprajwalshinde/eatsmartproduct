<?php
session_start(); // Start session for using $_SESSION

// Create connection
include '../connections.php';
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch username and password from AJAX request
$username = $_POST['username'];
$password = $_POST['password'];

// Perform query to check if username exists in the database
$sql = "SELECT * FROM login WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);

if ($num == 1) {
    // Fetch user data
    $row = mysqli_fetch_assoc($result);

    // Verify password
    if (password_verify($password, $row['password'])) {
        // Password is correct
        $_SESSION['esid'] = $row['lid']; // Assuming 'id' is the column name for user ID
        echo 'success|Login Successful! Redirecting...';
    } else {
        // Password is incorrect
        echo 'error|Invalid Username or Password';
    }
} else {
    // User not found
    echo 'error|Invalid Username or Password';
}

$conn->close();
?>
