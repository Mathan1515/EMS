<?php
require_once('crud.php');

// Fetch all unapproved users
$stmt = $conn->prepare("SELECT * FROM llog WHERE approved = 0");
$stmt->execute();
$result = $stmt->get_result();

echo "<table class='table'>";
echo "<thead><tr><th>Name</th><th>Email</th><th>Action</th></tr></thead>";
echo "<tbody>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>{$row['name']}</td>";
    echo "<td>{$row['email']}</td>";
    echo "<td>
            <form action='approve_user.php' method='POST'>
                <input type='hidden' name='userId' value='{$row['id']}'>
                <button type='submit' class='btn btn-success'>Approve</button>
            </form>
          </td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";
?>
