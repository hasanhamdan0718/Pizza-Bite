<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<?php



include('../conn.php');
if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $sql = "SELECT * FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    // var_dump($result);exit;
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit;
    }
} else {
    echo "User ID not provided.";
    exit;
}



?>
<?php include("common/head.php") ?>
<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
        <!-- Spinner End -->


        <!-- Sidebar Start -->
         <?php require("common/sidebar.php") ?>
     
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
         <?php require("common/navbar.php") ?>
            <!-- Navbar End -->


              <div class="container-fluid pt-4 px-4">
                <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0">
                    <div class="col-md-6 text-center">
                      <form action="update_user.php" method="POST">

                       <div class="mb-3">
                            <label for="user_id" class="form-label" hidden>User ID</label>
                            <input type="text" class="form-control" id="user_id" name="user_id" required value="<?php echo htmlspecialchars($user['user_id']); ?>" readonly hidden>
                        </div>
                        <div class="mb-3">
                            <label for="user_id" class="form-label">User Name</label>
                            <input type="text" class="form-control" id="user_name" name="user_name" required value="<?php echo htmlspecialchars($user['user_name']); ?>">
                        </div>
                        <div class="mb-3">
                           <label for="role" class="form-label">Role</label>
                            <select class="form-control" name="user_role" required>
                                <option value=""><?php echo htmlspecialchars($user['user_role']); ?></option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>

                        </div>
                        
                        <button type="submit" class="btn btn-danger">Update User</button>

                      </form>
                    </div>
                </div>
            </div>



    
            <!-- Footer Start -->
         <?php require("common/footer.php") ?>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
  <?php require("common/script.php") ?>

</body>

</html>