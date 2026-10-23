<?php
// var_dump($_POST);exit;
include('../conn.php');
if(isset($_POST['about_id']) && isset($_POST['about_title']) && isset($_POST['about_description']) ) {
    $about_id = $_POST['about_id'];
    $about_title = trim($_POST['about_title']);
    $about_description = trim($_POST['about_description']);

    if ($about_title === '') {
        die("Title is required.");
    }
    if ($about_description === '') {
        die("Description is required.");
    }

    $sql = "UPDATE about SET about_title = ?, about_description=? WHERE about_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $about_title, $about_description, $about_id);

    if ($stmt->execute()) {
        // echo "User updated successfully.";
        header("Location: about.php");
        exit;
    } else {
        echo "Error updating user: " . $conn->error;
    }

    $stmt->close();
}
?>
