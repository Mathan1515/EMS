<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['adminid'])) {
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Employee Management System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <h1 class="text-center">Admin Dashboard</h1>

                <div class="card mt-4">
                    <div class="card-body text-center">
                        <a href="admin_view.php" class="btn btn-primary btn-block">View All Employees</a>
                        <a href="admin_add_user.php" class="btn btn-success btn-block">Add New Employee</a>
                        <!-- <a href="admin_update_user.php" class="btn btn-info btn-block">Update Employee Info</a>
                        <a href="admin_delete_user.php" class="btn btn-danger btn-block">Delete Employee Account</a> -->
                        <a href="admin_register.php" class="btn btn-success btn-block">Add New Admin</a>
                        <a href="admin_send_msg.php" class="btn btn-success btn-block">Send Messages</a>
                        <a href="admin_logout.php" class="btn btn-secondary btn-block">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
