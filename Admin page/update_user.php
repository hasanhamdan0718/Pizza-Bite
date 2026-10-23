<?php
// var_dump($_POST);exit;
include('../conn.php');
if(isset($_POST['user_id']) && isset($_POST['user_name']) && isset($_POST['user_role'])) {
    $user_id = $_POST['user_id'];
    $username = trim($_POST['user_name']);
    $role = trim($_POST['user_role']);

    if ($username === '' || $role === '') {
        die("Username is required.");
    }

    $sql = "UPDATE users SET user_name = ?, user_role = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $username, $role, $user_id);

    if ($stmt->execute()) {
        // echo "User updated successfully.";
        header("Location: users.php");
        exit;
    } else {
        echo "Error updating user: " . $conn->error;
    }

    $stmt->close();
}
?>
