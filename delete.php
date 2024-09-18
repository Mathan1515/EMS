<?php
require_once('crud.php');
session_start();
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['userid'];
if (deleteUser($id, $conn)) {
    session_unset();
    session_destroy();
    header("Location: register.php");
} else {
    echo "Error deleting account.";
}
?>
