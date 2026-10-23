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
if(isset($_GET['about_id'])) {
    $about_id = $_GET['about_id'];
    $sql = "SELECT * FROM about WHERE about_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $about_id);
    $stmt->execute();
    $result = $stmt->get_result();
    // var_dump($result);exit;
    if ($result->num_rows > 0) {
        $about = $result->fetch_assoc();
    } else {
        echo "About Section not found.";
        exit;
    }
} else {
    echo "Section ID not provided.";
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
                      <form action="update_about.php" method="POST">

                       <div class="mb-3">
                            <label for="user_id" class="form-label" hidden>Section ID</label>
                            <input type="text" class="form-control" id="user_id" name="about_id" required value="<?php echo htmlspecialchars($about['about_id']); ?>" readonly hidden>
                        </div>
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Title</label>
                            <input type="text" class="form-control" id="user_name" name="about_title" required value="<?php echo htmlspecialchars($about['about_title']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Description</label>
                            <input type="text" class="form-control" id="user_name" name="about_description" required value="<?php echo htmlspecialchars($about['about_description']); ?>">
                        </div>
 
                        <button type="submit" class="btn btn-danger">Update Section</button>

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