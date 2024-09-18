<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['adminid'])) {
    header("Location: admin_login.php");
    exit();
}

include 'dbh.php'; // Database connection

// Handle the form submission for updating employee details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['mailuid'];
    $mobileno = $_POST['mobileno'];
    $qualification = $_POST['qualification'];
    $password = $_POST['pwd'];

    // Build the base SQL query
    $query = "UPDATE llog 
              SET name = ?, mailuid = ?, mobileno = ?, qualification = ?";

    // Only update password if a new password is provided
    $params = [$name, $email, $mobileno, $qualification];
    if (!empty($password)) {
        $password_hashed = password_hash($password, PASSWORD_BCRYPT);
        $query .= ", pwd = ?";
        $params[] = $password_hashed;
    }

    $query .= " WHERE id = ?";
    $params[] = $id;

    // Prepare the SQL statement
    if ($stmt = $conn->prepare($query)) {
        // Bind the parameters dynamically based on if the password was provided
        if (!empty($password)) {
            $stmt->bind_param('sssssi', ...$params);
        } else {
            $stmt->bind_param('ssssi', ...$params);
        }

        // Execute the query
        if ($stmt->execute()) {
            echo "Employee updated successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
}

// Get the employee details if 'id' is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM llog WHERE id = ?";
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $employee = $result->fetch_assoc();
        } else {
            echo "Employee not found.";
            exit();
        }

        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
        exit();
    }
} else {
    echo "No employee ID provided.";
    exit();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Update Employee Info</h1>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($employee['id']); ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($employee['name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="mailuid">Email</label>
                <input type="email" class="form-control" id="mailuid" name="email" value="<?php echo htmlspecialchars($employee['email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="mobileno">Mobile No</label>
                <input type="text" class="form-control" id="mobileno" name="mobileno" value="<?php echo htmlspecialchars($employee['mobileno']); ?>" required>
            </div>
            <div class="form-group">
                <label for="qualification">Qualification</label>
                <input type="text" class="form-control" id="qualification" name="qualification" value="<?php echo htmlspecialchars($employee['qualification']); ?>" required>
            </div>
            <!-- <div class="form-group">
                <label for="pwd">Password (leave blank to keep current password)</label>
                <input type="password" class="form-control" id="pwd" name="pwd">
            </div> -->
            <button type="submit" class="btn btn-info btn-block">Update Employee</button>
        </form>
    </div>
</body>
</html>
