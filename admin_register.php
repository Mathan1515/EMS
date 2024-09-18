<?php
require_once('dbh.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobileno = $_POST['mobileno'];
    $qualification = $_POST['qualification'];
    $password = $_POST['password'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the query
    $query = "INSERT INTO adminss (name, email, mobileno, qualification, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sssss', $username, $email, $mobileno, $qualification, $hashedPassword);

    if (mysqli_stmt_execute($stmt)) {
        echo "<div class='alert alert-success text-center'>Admin registered successfully!</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Error: Could not register admin.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="text-center">Register Admin</h2>
        <form action="admin_register.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="mobileno">Mobile Number</label>
                <input type="text" id="mobileno" name="mobileno" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="qualification">Qualification</label>
                <input type="text" id="qualification" name="qualification" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Register Admin</button>
        </form>
        <div class="text-center mt-3">
                            <a href="admin_login.php">Already have an account? Login here.</a>
                        </div>
    </div>
</body>
</html>
