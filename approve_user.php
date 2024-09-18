<?php
require_once('crud.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['userId'];

    // Approve the user by setting approved to 1
    $stmt = $conn->prepare("UPDATE llog SET approved = 1 WHERE id = ?");
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>User approved successfully!</div>";
        header("Location: admin_approval.php"); // Redirect back to the admin page
    } else {
        echo "<div class='alert alert-danger'>Error: Could not approve user.</div>";
    }
}
?>
