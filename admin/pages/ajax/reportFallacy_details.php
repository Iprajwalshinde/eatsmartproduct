<?php
require_once('../../../connections.php'); // Path to your database connection script

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT id, title, description, reportFallacy, tag_Category, DATE_FORMAT(dateadd, '%M %d, %Y %h:%i %p') AS datetime FROM insight WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$record = $result->fetch_assoc();

echo json_encode($record);

$stmt->close();
$conn->close();
?>
