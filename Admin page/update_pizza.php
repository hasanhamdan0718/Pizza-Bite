<?php

include('../conn.php');

if (
    !isset($_POST['pizza_id']) ||
    !isset($_POST['pizza_name']) ||
    !isset($_POST['pizza_description']) ||
    !isset($_POST['category_id']) ||
    !isset($_POST['pizza_price'])
) {
    die("Missing required fields.");
}

$pizza_id    = (int) $_POST['pizza_id'];
$pizza_name = trim($_POST['pizza_name']);
$pizza_description = trim($_POST['pizza_description']);
$category_id = (int) $_POST['category_id'];
$pizza_price         = (float) $_POST['pizza_price'];


// Validation
if ($pizza_id <= 0) {
    die("Invalid pizza ID.");
}

if ($pizza_name === '') {
    die("Pizza name is required.");
}

if ($pizza_description === '') {
    die("Description is required.");
}

if ($category_id <= 0) {
    die("Please select a category.");
}

if ($pizza_price < 0) {
    die("Invalid pizza price.");
}


// Get old image
$old_image = '';

$get_old_image = $conn->prepare("
    SELECT pizza_image 
    FROM pizzas 
    WHERE pizza_id = ?
");

$get_old_image->bind_param("i", $pizza_id);
$get_old_image->execute();

$result = $get_old_image->get_result();

if ($result->num_rows === 0) {
    die("Pizza not found.");
}

$pizza = $result->fetch_assoc();

$old_image = $pizza['pizza_image'];

$get_old_image->close();


// Check if a new image was uploaded
$new_image_uploaded = (
    isset($_FILES['pizza_image']) &&
    $_FILES['pizza_image']['error'] === UPLOAD_ERR_OK &&
    !empty($_FILES['pizza_image']['name'])
);


if ($new_image_uploaded) {

    $original_name = $_FILES['pizza_image']['name'];
    $tmp_name      = $_FILES['pizza_image']['tmp_name'];
    $file_size     = $_FILES['pizza_image']['size'];

    $extension = strtolower(
        pathinfo($original_name, PATHINFO_EXTENSION)
    );

    $allowed_extensions = [
        'jpg',
        'jpeg',
        'png',
        'avif',
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
    $file_name = uniqid('pizza_', true) . '.' . $extension;

    $upload_folder = 'uploads/pizza bite/';
    $destination   = $upload_folder . $file_name;


    // Upload new image
    if (!move_uploaded_file($tmp_name, $destination)) {
        die("Failed to upload image.");
    }


    // Update pizza WITH new image
    $sql = "
        UPDATE pizzas 
        SET 
            pizza_name = ?,
            pizza_description = ?,
            category_id = ?,
            pizza_price = ?,
            pizza_image = ?
        WHERE pizza_id = ?
    ";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "ssidsi",
        $pizza_name,
        $pizza_description,
        $category_id,
        $pizza_price,
        $file_name,
        $pizza_id
    );


    if ($stmt->execute()) {

        // Delete old image
        if (!empty($old_image)) {

            $old_image_path = $upload_folder . $old_image;

            if (file_exists($old_image_path)) {
                unlink($old_image_path);
            }
        }

        header("Location: pizza.php");
        exit;

    } else {

        // Database update failed
        // Delete the newly uploaded image because it is no longer needed
        if (file_exists($destination)) {
            unlink($destination);
        }

        echo "Error updating pizza: " . $stmt->error;
    }


} else {

    // Update WITHOUT changing image
    $sql = "
        UPDATE pizzas 
        SET 
            pizza_name = ?,
            pizza_description = ?,
            category_id = ?,
            pizza_price = ?
        WHERE pizza_id = ?
    ";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "ssidi",
        $pizza_name,
        $pizza_description,
        $category_id,
        $pizza_price,
        $pizza_id
    );


    if ($stmt->execute()) {

        header("Location: pizza.php");
        exit;

    } else {

        echo "Error updating pizza: " . $stmt->error;
    }
}

?>