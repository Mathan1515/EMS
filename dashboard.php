<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}
include('dbh.php');
// Assuming you have your database connection in $conn
$user_id = $_SESSION['userid']; // Or however you retrieve the user ID

// Fetch the unread message count from the database
$sql_unread = "SELECT COUNT(*) AS unread_count FROM messages WHERE user_id = ? AND is_read = 0";
$stmt_unread = $conn->prepare($sql_unread);
$stmt_unread->bind_param("i", $user_id);
$stmt_unread->execute();
$result_unread = $stmt_unread->get_result();
$row_unread = $result_unread->fetch_assoc();
$unread_count = $row_unread['unread_count'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        #notificationAlert {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h1 class="card-title">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
                        <div class="btn-group-vertical w-100 mt-4">
                            <a href="update.php" class="btn btn-info mb-2">Update Profile</a>
                            <a href="delete.php" class="btn btn-danger mb-2">Delete Account</a>
                            <a href="read.php" class="btn btn-info mb-2">View Profile</a>
                            <div class="text-right mb-3">
                                <!-- Alert message instead of button -->
                                <div id="notificationAlert" class="alert alert-primary alert-dismissible fade show" role="alert">
                                    You have <span id="notificationCount"><?php echo $unread_count; ?></span> unread messages.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                            <a id="myMessagesLink" href="user_messages.php" class="btn btn-info mb-2 ml-2">My Messages</a>
                            <a href="logout.php" class="btn btn-secondary mb-2">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    // Function to update alert visibility based on localStorage
    function updateNotificationAlert() {
        const notificationsViewed = localStorage.getItem('notificationsViewed');
        const unreadCount = document.getElementById('notificationCount').textContent;

        if (notificationsViewed === 'true' && unreadCount == 0) {
            document.getElementById('notificationAlert').style.display = 'none';
        } else {
            document.getElementById('notificationAlert').style.display = 'block';
        }
    }

    // Handle click event to mark notifications as viewed
    document.getElementById('myMessagesLink').addEventListener('click', function() {
        localStorage.setItem('notificationsViewed', 'true');
        document.getElementById('notificationAlert').style.display = 'none';
    });

    // Update alert visibility on page load
    document.addEventListener('DOMContentLoaded', updateNotificationAlert);
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
