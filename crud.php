<?php
require_once('dbh.php');

// Create (Register)
function registerUser($name, $email, $mobileno, $qualification, $password, $conn) {
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
    $approved = 0; // Default to not approved
    
    // Check if the connection is still alive
    if (!$conn->ping()) {
        die("MySQL connection lost. Please try again.");
    }

    // Prepare the statement
    if ($stmt = $conn->prepare("INSERT INTO llog (name, email, mobileno, qualification, password, approved) VALUES (?, ?, ?, ?, ?, ?)")) {
        $stmt->bind_param("sssssi", $name, $email, $mobileno, $qualification, $hashedPwd, $approved);
        
        // Execute the statement
        if ($stmt->execute()) {
            return true;
        } else {
            // Capture any MySQL execution errors
            die("Error executing MySQL statement: " . $stmt->error);
        }
    } else {
        // Capture any MySQL prepare errors
        die("Error preparing MySQL statement: " . $conn->error);
    }
}


// Read (Login)
function loginUser($email, $password, $conn) {
    $sql = "SELECT * FROM `llog` WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['userid'] = $row['id'];
            $_SESSION['username'] = $row['name'];
            return true;
        } else {
            return false;
        }
    }
    return false;
}

// Update (Update user info)
function updateUser($id, $name, $email, $mobileno, $qualification, $conn) {
    $sql = "UPDATE `llog` SET name = ?, email = ?, mobileno = ?, qualification = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $email, $mobileno, $qualification, $id);
    
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

// Delete (Delete account)
function deleteUser($id, $conn) {
    $sql = "DELETE FROM `llog` WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
?>
