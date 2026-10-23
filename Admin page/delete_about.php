<?php
require('../conn.php');
$about_id=isset($_GET['about_id']) ? (int) $_GET['about_id'] : 0;
if($about_id <= 0){
    die("Invalid about section ID.");
}

$sql = "DELETE FROM about WHERE about_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $about_id);

if($stmt->execute() === TRUE){
    // echo "About Section deleted successfully.";
    echo "<script>window.location.href='about.php';</script>";
    exit();
} else {
    echo "Error deleting section: " . $conn->error;
}

?>



