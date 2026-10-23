<?php
require('../conn.php');
$category_id=isset($_GET['category_id']) ? (int) $_GET['category_id'] : 0;
if($category_id <= 0){
    die("Invalid category ID.");
}

$sql = "DELETE FROM categories WHERE category_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $category_id);

if($stmt->execute() === TRUE){
    // echo "Category deleted successfully.";
    echo "<script>window.location.href='categories.php';</script>";
    exit();
} else {
    echo "Error deleting user: " . $conn->error;
}

?>



