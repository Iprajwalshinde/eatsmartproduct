<?php
include '../connections.php';

$data = json_decode(file_get_contents('php://input'), true);
$postId = $data['postId'];
$reason = $data['reason'];


$mysqli->query("UPDATE insight SET reportFallacy = reportFallacy + 1 WHERE id = $postId");

$mysqli->query("INSERT INTO report_fallacy (post_id, reason) VALUES ($postId, '$reason')");

$result = $mysqli->query("SELECT reportFallacy FROM insight WHERE id = $postId");
$reportCount = $result->fetch_assoc()['reportFallacy'];

if ($reportCount > 10) {
    $mysqli->query("UPDATE insight SET hidden = 1 WHERE id = $postId");
}
echo json_encode(['success' => true]);
?>
