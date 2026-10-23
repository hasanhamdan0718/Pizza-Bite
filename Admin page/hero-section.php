<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<!doctype html>
<html lang="en">

<?php
include("../conn.php");
$sql="SELECT * FROM `hero-section`";
$result = $conn->query($sql);
// var_dump($result);
// exit;
$heros=$result->fetch_all(MYSQLI_ASSOC);
// var_dump($categories);exit;
// $categories=$result->fetch_assoc();
// var_dump($categories);exit;
?>

  <?php include ('common/head.php'); ?>

  <body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
      <!-- Spinner Start -->
      <div
        id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center"
      >
        <div
          class="spinner-border text-primary"
          style="width: 3rem; height: 3rem"
          role="status"
        >
          <span class="sr-only">Loading...</span>
        </div>
      </div>
      <!-- Spinner End -->

      <!-- Sidebar Start -->
      <?php include ('common/sidebar.php'); ?>
      <!-- Sidebar End -->

      <!-- Content Start -->
      <div class="content">
        <!-- Navbar Start -->
        <?php include ('common/navbar.php'); ?>
        <!-- Navbar End -->

        <div class="container-fluid pt-4">
                <div class="row g-4 min-vh-100 rounded justify-content-center mx-0">
                    <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                           

                            <div class="bg-light rounded h-100 p-4">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="datatable">
                                        <thead>
                                            <tr class="table-danger">
                                                <th>Title</th>
                                               <th>Description</th>
                                               <th>Image</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($heros as $hero){ ?>

                                            <tr>
                                                <td><?php echo $hero['hero_title'] ?></td>
                                                <td><?php echo $hero['hero_description'] ?></td>
                                                <td>
                                                  
                                                       <img src="uploads/pizza bite/<?php echo htmlspecialchars($hero['hero_image']) ?>" alt="hero-image" width="100" height="100px">
                                                    </td>
                                                    <td>
                                                    <a href="update_form_hero.php?hero_id=<?php echo $hero['hero_id'] ?>" class="btn btn-sm btn-outline-success">Edit</a>
                                                    
                                                     


                                                   

                                                </td>
                                            </tr>

                                            <?php } ?>                                        

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        <!-- Footer Start -->
        <?php include ('common/footer.php'); ?>
        <!-- Footer End -->
      </div>
      <!-- Content End -->

      <!-- Back to Top -->
      <a href="#" class="btn btn-lg btn-danger btn-lg-square back-to-top"
        ><i class="bi bi-arrow-up"></i
      ></a>
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
</html>
