<?php
include '../connections.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$title = $_POST['title'];
$description = $_POST['description'];
$tag_category = $_POST['tag_category'];
$reportFallacy = $_POST['reportFallacy'];

$sql = "INSERT INTO insight (title, description, tag_category, reportFallacy) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $title, $description, $tag_category, $reportFallacy);

if ($stmt->execute()) {
    echo "New Insight created Successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
