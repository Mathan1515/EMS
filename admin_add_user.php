<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['adminid'])) {
    header("Location: admin_login.php");
    exit();
}

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'dbh.php'; // Database connection

    $name = $_POST['name'];
    $email = $_POST['mailuid'];
    $mobileno = $_POST['mobileno'];
    $qualification = $_POST['qualification'];
    $password = password_hash($_POST['pwd'], PASSWORD_BCRYPT);  // Hash password

    // Using prepared statements to avoid SQL injection
    $query = "INSERT INTO llog (name, email, mobileno, qualification, password) 
              VALUES (?, ?, ?, ?, ?)";
    
    if ($stmt = $conn->prepare($query)) {
        // Bind parameters
        $stmt->bind_param('sssss', $name, $email, $mobileno, $qualification, $password);

        // Execute the query
        if ($stmt->execute()) {
            echo "New employee added successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Employee</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Add New Employee</h1>
        <form method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="mailuid">Email</label>
                <input type="email" class="form-control" id="mailuid" name="mailuid" required>
            </div>
            <div class="form-group">
                <label for="mobileno">Mobile No</label>
                <input type="text" class="form-control" id="mobileno" name="mobileno" required>
            </div>
            <div class="form-group">
                <label for="qualification">Qualification</label>
                <input type="text" class="form-control" id="qualification" name="qualification" required>
            </div>
            <div class="form-group">
                <label for="pwd">Password</label>
                <input type="password" class="form-control" id="pwd" name="pwd" required>
            </div>
            <button type="submit" class="btn btn-success btn-block">Add Employee</button>
        </form>
    </div>
</body>
</html>
