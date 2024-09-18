<?php
session_start();

if (!isset($_SESSION['adminid'])) {
    header("Location: admin_login.php");
    exit();
}

include 'dbh.php';

// Check if 'id' is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the DELETE statement to prevent SQL injection
    $query = "DELETE FROM llog WHERE id = ?";

    if ($stmt = $conn->prepare($query)) {
        // Bind the 'id' parameter to the query
        $stmt->bind_param('i', $id);

        // Execute the query
        if ($stmt->execute()) {
            $message = "Employee deleted successfully.";
        } else {
            $message = "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        $message = "Error: " . $conn->error;
    }
} else {
    // Display an error if the 'id' parameter is missing
    $message = "Error: No employee ID provided.";
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Employee</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5 text-center">
        <h1><?php echo htmlspecialchars($message); ?></h1>
        <a href="admin_view.php" class="btn btn-primary">Go Back to Employee List</a>
    </div>
</body>
</html>
