<?php
require('../conn.php');
if($_POST){
    $user = $_POST['user_name'];
    $pass = $_POST['password'];
    $hashed_pass=password_hash($pass, PASSWORD_DEFAULT);
    // var_dump($hashed_pass);exit;
    $role = $_POST['user_role'];

    $check_sql="select * from users where user_name=?";
    $check_stmt=$conn->prepare($check_sql);
    $check_stmt->bind_param("s", $user);
    $check_stmt->execute();
    $check_result=$check_stmt->get_result();
    if($check_result->num_rows > 0){
        echo "User already exists.";
        exit;
    } else{
    $sql = "INSERT INTO users (user_name, password, user_role) VALUES (?, ?, ?)";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("sss", $user, $hashed_pass, $role);
    if($stmt->execute() === TRUE){
        // echo "User added successfully.";
        //  header("Location: categories.php");
        echo "<script>window.location.href='users.php';</script>";
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


}
?>
