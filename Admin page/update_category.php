<?php
// var_dump($_POST);exit;
include('../conn.php');
if(isset($_POST['category_id']) && isset($_POST['category_name']) ) {
    $category_id = $_POST['category_id'];
    $category_name = trim($_POST['category_name']);

    if ($category_name === '') {
        die("Category Name is required.");
    }

    $sql = "UPDATE categories SET category_name = ? WHERE category_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $category_name, $category_id);

    if ($stmt->execute()) {
        // echo "User updated successfully.";
        header("Location: categories.php");
        exit;
    } else {
        echo "Error updating user: " . $conn->error;
    }

    $stmt->close();
}
?>
