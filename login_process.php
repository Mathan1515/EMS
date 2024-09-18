<?php
session_start();
require_once('crud.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['mailuid'];
    $password = $_POST['pwd'];

    // Check if user exists
    $sql = "SELECT * FROM `llog` WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        // Store user info in session
        $_SESSION['userid'] = $user['id'];
        $_SESSION['username'] = $user['name'];
        $_SESSION['role'] = $user['role'];  // Store the user's role in the session

        // Test the role output
        var_dump($_SESSION['role']); // Temporary debugging to ensure 'admin' is output

        // Redirect based on role
        if ($user['role'] == 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: dashboard.php");
        }
        exit(); // Ensure the script stops after redirection
    } else {
        echo "Invalid email or password.";
    }
}
?>
