<?php
require('../conn.php');
$user_id=isset($_GET['user_id']) ? (int) $_GET['user_id'] : 0;
if($user_id <= 0){
    die("Invalid user ID.");
}

$sql = "DELETE FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);

if($stmt->execute() === TRUE){
    // echo "User deleted successfully.";
    echo "<script>window.location.href='users.php';</script>";
    exit();
} else {
    echo "Error deleting user: " . $conn->error;
}

?>



