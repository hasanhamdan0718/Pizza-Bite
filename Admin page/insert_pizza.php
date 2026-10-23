<?php
include('../conn.php');
// var_dump($_FILES);exit;
// echo '<pre>'; print_r($_FILES); echo '</pre>'; exit;
// $file_name=$_FILES['product_image']['type'];
// var_dump($file_name);exit;
if ( isset($_FILES['pizza_image']) && $_FILES['pizza_image']['error'] === UPLOAD_ERR_OK ){
if (isset($_POST['pizza_name']) && isset($_POST['category_id']) && isset($_POST['pizza_description']) && isset($_POST['pizza_price'])) {
    $original_name = $_FILES['pizza_image']['name']; 
    $tmp_name = $_FILES['pizza_image']['tmp_name'];
    $extension = strtolower( pathinfo( $original_name, PATHINFO_EXTENSION ) );
    // var_dump($extension);exit;
    $allowed_extensions = [ 'jpg', 'jpeg', 'png', 'webp', 'avif' ];
    if ( !in_array( $extension, $allowed_extensions ) ) { die("Invalid image format."); }
    $max_size = 2 * 1024 * 1024;
    if ( $_FILES['pizza_image']['size'] > $max_size ) { die("Image size must not exceed 2 MB."); }
    $file_name = uniqid('pizza_', true) . '.' . $extension;
    // var_dump($file_name);exit;
     $upload_folder = 'uploads/pizza bite/';
     $destination = $upload_folder . $file_name;
     if ( move_uploaded_file( $tmp_name,$destination ) ) {
    // Image successfully moved 
    } 
      else { die("Failed to upload image."); }


    $pizza_name = trim($_POST['pizza_name']);
    $category_id = (int) $_POST['category_id'];
    $pizza_description = trim($_POST['pizza_description']);
    $pizza_price = (double) $_POST['pizza_price'];

    if ($pizza_name === '') {
        die("Pizza is required.");
    }
    if ($category_id <= 0) {
        die("Please select a category.");
    }
    if ($pizza_description === '') {
        die("Description is required.");
    }
    if ($pizza_price < 0) {
        die("Invalid pizza price.");
    }


    $sql = "INSERT INTO `pizzas`(`pizza_name`, `category_id`, `pizza_description`, `pizza_price`, `pizza_image`) VALUES (?, ?, ?, ?, ?) ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisds", $pizza_name, $category_id, $pizza_description, $pizza_price, $file_name);
    if ($stmt->execute()) {
        header("Location: pizza.php");
        exit;
    } else {
        echo "Error adding pizza: " . $stmt->error;
    }
    $stmt->close();
}
} else {
    echo "Error uploading file: " . $_FILES['pizza_image']['error'];
}

?>