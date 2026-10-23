<?php
require('../conn.php');
if($_POST){
    $category = $_POST['category_name'];
    // var_dump($hashed_pass);exit;

    $check_sql="select * from categories where category_name=?";
    $check_stmt=$conn->prepare($check_sql);
    $check_stmt->bind_param("s", $category);
    $check_stmt->execute();
    $check_result=$check_stmt->get_result();
    if($check_result->num_rows > 0){
        echo "Category already exists.";
        exit;
    } else{
    $sql = "INSERT INTO categories (category_name) VALUES (?)";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("s", $category);
    if($stmt->execute() === TRUE){
        // echo "User added successfully.";
        //  header("Location: categories.php");
        echo "<script>window.location.href='categories.php';</script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


}
?>
