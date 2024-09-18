<?php
session_start();

if (!isset($_SESSION['userid'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit();
}

include('dbh.php');

$user_id = $_SESSION['userid'];

// Update the 'is_read' status for all unread messages
$sql = "UPDATE messages SET is_read = 1 WHERE user_id = ? AND is_read = 0";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to mark messages as read']);
}

$stmt->close();
$conn->close();
?>
