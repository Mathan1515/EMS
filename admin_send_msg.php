<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['adminid'])) {
    header("Location: admin_login.php");
    exit();
}

include('dbh.php');

// Fetch users for the dropdown
$sql = "SELECT id, name FROM llog";
$users = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_ids = $_POST['user_id']; // This will be an array of selected user IDs
    $message = $_POST['message'];
    $admin_id = $_SESSION['adminid'];

    if (!empty($user_ids) && is_array($user_ids)) {
        $errors = [];
        foreach ($user_ids as $user_id) {
            $stmt = $conn->prepare("INSERT INTO messages (admin_id, user_id, message) VALUES (?, ?, ?)");
            $stmt->bind_param("iis", $admin_id, $user_id, $message);

            if ($stmt->execute()) {
                $success_msg = "Message sent successfully to User ID: $user_id!";
            } else {
                $errors[] = "Error sending message to User ID: $user_id.";
            }

            $stmt->close();
        }

        if (empty($errors)) {
            echo "<p class='alert alert-success'>$success_msg</p>";
        } else {
            foreach ($errors as $error) {
                echo "<p class='alert alert-danger'>$error</p>";
            }
        }
    } else {
        echo "<p class='alert alert-warning'>No users selected.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Message - Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <h1 class="text-center">Send Message to User</h1>

                <form method="post" action="admin_send_msg.php">
                    <div class="form-group">
                        <label for="user_id"></label>
                        <select class="form-control" id="user_id" name="user_id[]" multiple required>
                            <?php while ($user = $users->fetch_assoc()) : ?>
                                <option value="<?php echo htmlspecialchars($user['id']); ?>"><?php echo htmlspecialchars($user['name']); ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>

                <a href="admin_dashboard.php" class="btn btn-secondary mt-4">Back to Dashboard</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#user_id').multiselect({
                includeSelectAllOption: true,
                nonSelectedText: 'Select Users',
                allSelectedText: 'All Users Selected',
                nSelectedText: 'User(s) Selected'
            });
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>
