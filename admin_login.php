<?php
session_start();
require_once('dbh.php'); // Include your database connection file

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $password = $_POST['password'];

    // Query the database to check for admin credentials
    $sql = "SELECT id, name, password FROM adminss WHERE name = ?";

    // Prepare the statement to avoid SQL injection
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if an admin with the provided username exists
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $db_password = $row['password']; // Hashed password from the database

            // Verify the password
            if (password_verify($password, $db_password)) {
                // Set session variables upon successful login
                $_SESSION['adminid'] = $row['id']; // Admin ID from the database
                $_SESSION['admin_username'] = $row['name']; // Correct this field to match database

                // Redirect to the admin dashboard
                header("Location: admin_dashboard.php");
                exit();
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "Invalid username.";
        }

        // Close statement
        $stmt->close();
    } else {
        $error = "Database query failed.";
    }

    // Close database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Employee Management System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-4">
                <h1 class="text-center">Admin Login</h1>
                <!-- Display error message if login fails -->
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                <!-- Login form -->
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
                <!-- <div class="text-center mt-3">
                    <a href="admin_register.php">Don't have an account? Register here.</a>
                </div> -->
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
