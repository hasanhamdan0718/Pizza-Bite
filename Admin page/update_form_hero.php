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
if (isset($_GET['hero_id'])) {
    $hero_id = $_GET['hero_id'];
    $sql = "SELECT * FROM `hero-section` where hero_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $hero_id);
    $stmt->execute();
    $result = $stmt->get_result();
    // var_dump($result);exit;
    if ($result->num_rows > 0) {
        $hero = $result->fetch_assoc();
        // var_dump($hero);exit;
    } else {
        echo "Not found.";
        exit;
    }
} else {
    echo "Hero ID not provided.";
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
                        <form action="update_hero.php" method="POST" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label for="hero_id" class="form-label" hidden>Hero ID</label>
                                <input type="text" class="form-control" id="hero_id" name="hero_id" required value="<?php echo htmlspecialchars($hero['hero_id']); ?>" readonly hidden>
                            </div>
                            <div class="mb-3">
                                <label for="hero_title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="hero_title" name="hero_title" required value="<?php echo htmlspecialchars($hero['hero_title']); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="hero_des" class="form-label">Description</label>
                                <input type="text" class="form-control" id="hero_des" name="hero_description" required value="<?php echo htmlspecialchars($hero['hero_description']); ?>">
                            </div>
  
                                <div class="mb-3">
                                    <label class="form-label"> Current Image </label>
                                    <br> <img src="uploads/pizza bite/<?php echo htmlspecialchars($hero['hero_image']) ?>" alt="hero-image" width="100" height="100px">
                                </div>
                           

                            <div class="mb-3">
                                <label class="form-label"> Replace Image </label>
                                <input type="file" class="form-control" name="hero_image" accept="image/*">
                            </div>
                            <button type="submit" class="btn btn-danger">Update</button>

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
        <a href="#" class="btn btn-lg btn-danger btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
   

</body>

</html>