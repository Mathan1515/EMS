<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

include('dbh.php');

$user_id = $_SESSION['userid'];

// Update the 'is_read' status for all unread messages as soon as the page loads
$sql_update = "UPDATE messages SET is_read = 1 WHERE user_id = ? AND is_read = 0";
$stmt_update = $conn->prepare($sql_update);
$stmt_update->bind_param("i", $user_id);
$stmt_update->execute();
$stmt_update->close();

// Fetch messages and admin names
$sql = "SELECT messages.id, messages.message, messages.created_at, adminss.name AS admin_name, messages.is_read
        FROM messages 
        JOIN adminss ON messages.admin_id = adminss.id 
        WHERE messages.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Count unread messages
$sql_unread = "SELECT COUNT(*) AS unread_count FROM messages WHERE user_id = ? AND is_read = 0";
$stmt_unread = $conn->prepare($sql_unread);
$stmt_unread->bind_param("i", $user_id);
$stmt_unread->execute();
$result_unread = $stmt_unread->get_result();
$row_unread = $result_unread->fetch_assoc();
$unread_count = $row_unread['unread_count'] ?? 0; // Set unread count to 0 if no unread messages found
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Messages - User Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <h1 class="text-center">My Messages</h1>

                <?php if ($result->num_rows > 0) : ?>
                    <table class="table table-bordered mt-4">
                        <thead>
                            <tr>
                                <th>From</th>
                                <th>Message</th>
                                <th>Received At</th>
                                <!-- <th>Status</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row["admin_name"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["message"]); ?></td>
                                    <td><?php echo htmlspecialchars($row["created_at"]); ?></td>
                                    <!-- <td>
                                        <?php if ($row['is_read'] == 0): ?>
                                            <span class="badge badge-danger">Unread</span>
                                        <?php else: ?>
                                            <span class="badge badge-success">Read</span>
                                        <?php endif; ?>
                                    </td> -->
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p class="text-center">No messages found</p>
                <?php endif; ?>

                <center><a href="dashboard.php" class="btn btn-primary mt-4">Back to Dashboard</a></center>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
$stmt_unread->close();
?>
