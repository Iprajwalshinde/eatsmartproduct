<?php
include 'connections.php';  // Include your database connection settings

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // First check if the email already exists
        $stmt = $conn->prepare("SELECT email FROM newsletter WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            echo "This email is already subscribed.";
        } else {
            // Email not found, proceed to insert
            $stmt = $conn->prepare("INSERT INTO newsletter (email, unsubscribe) VALUES (?, 'no')");
            $stmt->bind_param("s", $email);
            
            if ($stmt->execute()) {
                echo "Thank you for subscribing!";
            } else {
                echo "Error: " . $conn->error;
            }
        }
        $stmt->close();
    } else {
        echo "Invalid email address.";
    }
} else {
    echo "No email provided.";
}

$conn->close();
?>
