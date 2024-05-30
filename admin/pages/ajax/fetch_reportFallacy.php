<?php
require_once('../../../connections.php'); // Path to your database connection script

$records_per_page = 10;

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get current page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($page - 1) * $records_per_page;

// Fetch records
$sql = "SELECT id, title, description, reportFallacy, DATE_FORMAT(dateadd, '%M %d, %Y %h:%i %p') AS datetime FROM insight WHERE reportFallacy > 0 ORDER BY id DESC LIMIT $start_from, $records_per_page";
$result = $conn->query($sql);

$records = [];
$count = $start_from + 1; // Initialize count based on pagination
while($row = $result->fetch_assoc()) {
    $row['count'] = $count; // Add the sequential count to the row
    $records[] = $row;
    $count++;
}

// Get total records
$result = $conn->query("SELECT COUNT(id) AS total FROM insight WHERE reportFallacy > 0");
$row = $result->fetch_assoc();
$total_pages = ceil($row['total'] / $records_per_page);

echo json_encode(['records' => $records, 'totalPages' => $total_pages]);

$conn->close();
?>
