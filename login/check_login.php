<?php
session_start();
// Check if user is authenticated
if(isset($_SESSION['esid'])) {
    echo "authenticated"; // Send authentication status
} else {
    echo "unauthenticated"; // Send authentication status
}
?>
