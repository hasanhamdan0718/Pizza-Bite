<?php  session_start();

if($_POST){
    // var_dump($_POST);exit;
    include("../conn.php");
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password=password_hash($password,PASSWORD_DEFAULT);
    $sql="SELECT * FROM users WHERE user_name='$username'";
    $result=$conn->query($sql); //execute query
    // var_dump($result);exit;

    if($result->num_rows>0){
        $user=$result->fetch_assoc();
        // var_dump($user);exit;
        if(password_verify($password,$user['password'])){
            $_SESSION['user_id']=$user['user_id'];
            $_SESSION['username']=$user['user_name'];
            $_SESSION['role']=$user['user_role'];


            header("location: index.php");
            

        }else{
            echo "<script>alert('Invalid username or Password');
            // window.location.href='login.php';</script>";
        }
     

            }
                    }

?>

<!DOCTYPE html>
<html lang="en">

<?php include ('common/head.php'); ?>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light  p-4 p-sm-5 my-4 mx-3" style="border-radius:100px; box-shadow: 10px 30px 60px rgba(255, 0, 0, 0.7)">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.php" class="">
                                <h3 class="text-danger"><i class="fa fa-hashtag me-2"></i>Pizza Bite</h3>
                            </a>
                            <h3>Sign In</h3>
                        </div>
                        <form action="" method="POST">
                        <div class="form-floating mb-3">
                            <input type="username" class="form-control" id="floatingInput" name="username" required autocomplete="off">
                            <label for="floatingInput">Username</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required autocomplete="off">
                            <label for="floatingPassword">Password</label>
                        </div>
                        
                        <button type="submit" class="btn btn-outline-danger py-3 w-100 mb-4">Login</button>
                        <!-- <p class="text-center mb-0">Don't have an Account? <a href="">Sign Up</a></p> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>z