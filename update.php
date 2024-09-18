<?php
require_once('crud.php');  // Include the file where updateUser function is defined
require_once('dbh.php');   // Include the database connection file
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['userid'];  // Get the user ID from the session

// Fetch the user's current data (if necessary, to prefill the form)
$sql = "SELECT * FROM `llog` WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
} else {
    echo "<div class='alert alert-danger text-center'>User not found.</div>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update the user's information
    $name = $_POST['name'];
    $email = $_POST['mailuid'];  // Corrected field name
    $mobileno = $_POST['mobileno'];
    $qualification = $_POST['qualification'];

    if (updateUser($id, $name, $email, $mobileno, $qualification, $conn)) {
        echo "<div class='alert alert-success text-center'>Profile updated successfully!</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Error updating profile.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .update-container {
            max-width: 500px;
            margin: 50px auto;
        }
        .form-control {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container update-container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center">Update Profile</h2>
                        <form action="update.php" method="POST">
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <!-- Prefill the input field with the current user's data -->
                                <input type="text" id="name" name="name" class="form-control" placeholder="Full Name" value="<?= htmlspecialchars($userData['name']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="mailuid" class="form-control" placeholder="Email" value="<?= htmlspecialchars($userData['email']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="mobileno">Mobile Number</label>
                                <input type="text" id="mobileno" name="mobileno" class="form-control" placeholder="Mobile Number" value="<?= htmlspecialchars($userData['mobileno']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="qualification">Qualification</label>
                                <input type="text" id="qualification" name="qualification" class="form-control" placeholder="Qualification" value="<?= htmlspecialchars($userData['qualification']) ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                        </form>
                        <div class="text-center mt-3">
                            <a href="dashboard.php">Back to Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
