<?php
require('../conn.php');
if($_POST){
    $about_title = $_POST['about_title'];
     $about_description = $_POST['about_description'];
   
    $check_sql="select * from about where about_title=?";
    $check_stmt=$conn->prepare($check_sql);
    $check_stmt->bind_param("s", $about);
    $check_stmt->execute();
    $check_result=$check_stmt->get_result();
    if($check_result->num_rows > 0){
        echo "About section already exists.";
        exit;
    } else{
    $sql = "INSERT INTO about (about_title, about_description) VALUES (?, ?)";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("ss", $about_title, $about_description);
    if($stmt->execute() === TRUE){
        // echo "Section added successfully.";
        //  header("Location: about.php");
        echo "<script>window.location.href='about.php';</script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


}
?>
