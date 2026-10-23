<?php

include('../conn.php');

if (
    !isset($_POST['hero_id']) ||
    !isset($_POST['hero_title']) ||
    !isset($_POST['hero_description']) 
    
) {
    die("Missing required fields.");
}

$hero_id    = (int) $_POST['hero_id'];
$hero_title = trim($_POST['hero_title']);
$hero_description = trim($_POST['hero_description']);




// Validation
if ($hero_id <= 0) {
    die("Invalid product ID.");
}

if ($hero_title === '') {
    die("Title is required.");
}

if ($hero_description === '') {
    die("Description is required.");
}




// Get old image
$old_image = '';

$get_old_image = $conn->prepare("
    SELECT hero_image 
    FROM `hero-section`
    WHERE hero_id = ?
");

$get_old_image->bind_param("i", $hero_id);
$get_old_image->execute();

$result = $get_old_image->get_result();

if ($result->num_rows === 0) {
    die("Product not found.");
}

$hero = $result->fetch_assoc();

$old_image = $hero['hero_image'];

$get_old_image->close();


// Check if a new image was uploaded
$new_image_uploaded = (
    isset($_FILES['hero_image']) &&
    $_FILES['hero_image']['error'] === UPLOAD_ERR_OK &&
    !empty($_FILES['hero_image']['name'])
);


if ($new_image_uploaded) {

    $original_name = $_FILES['hero_image']['name'];
    $tmp_name      = $_FILES['hero_image']['tmp_name'];
    $file_size     = $_FILES['hero_image']['size'];

    $extension = strtolower(
        pathinfo($original_name, PATHINFO_EXTENSION)
    );

    $allowed_extensions = [
        'jpg',
        'jpeg',
        'png',
        'webp'
    ];

    if (!in_array($extension, $allowed_extensions)) {
        die("Invalid image format.");
    }

    $max_size = 4 * 1024 * 1024;

    if ($file_size > $max_size) {
        die("Image size must not exceed 4 MB.");
    }


    // Generate new image name
    $file_name = uniqid('hero_', true) . '.' . $extension;

    $upload_folder = 'uploads/pizza bite/';
    $destination   = $upload_folder . $file_name;


    // Upload new image
    if (!move_uploaded_file($tmp_name, $destination)) {
        die("Failed to upload image.");
    }


    // Update product WITH new image
    $sql = "
        UPDATE `hero-section` 
        SET 
            hero_title = ?,
            hero_description = ?,
            hero_image = ?
        WHERE hero_id = ?
    ";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "sssi",
        $hero_title,
        $hero_description,
        $file_name,
        $hero_id,
    );


    if ($stmt->execute()) {

        // Delete old image
        if (!empty($old_image)) {

            $old_image_path = $upload_folder . $old_image;

            if (file_exists($old_image_path)) {
                unlink($old_image_path);
            }
        }

        header("Location: hero-section.php");
        exit;

    } else {

        // Database update failed
        // Delete the newly uploaded image because it is no longer needed
        if (file_exists($destination)) {
            unlink($destination);
        }

        echo "Error updating: " . $stmt->error;
    }


} else {

    // Update WITHOUT changing image
    $sql = "
        UPDATE `hero-section`
        SET 
            hero_title = ?,
            hero_description = ?,
        WHERE hero_id = ?
    ";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "ss",
        $hero_title,
        $hero_description,
    );


    if ($stmt->execute()) {

        header("Location: hero-section.php");
        exit;

    } else {

        echo "Error updating " . $stmt->error;
    }
}

?>