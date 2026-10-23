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
  <?php include("../conn.php"); ?>
<?php
$sql_categories = "SELECT COUNT(*) AS total_categories FROM categories";

$result_categories = $conn->query($sql_categories);

$row_categories = $result_categories->fetch_assoc();

$total_categories = $row_categories['total_categories'];
?>

<?php
$sql_pizzas = "SELECT COUNT(*) AS total_pizzas FROM pizzas";

$result_pizzas = $conn->query($sql_pizzas);

$row_pizzas = $result_pizzas->fetch_assoc();

$total_pizzas = $row_pizzas['total_pizzas'];
?>

<?php
$sql_users = "SELECT COUNT(*) AS total_users FROM users";

$result_users = $conn->query($sql_users);

$row_users = $result_users->fetch_assoc();

$total_users = $row_users['total_users'];
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
         <div class="container">
         <div class="row g-3 mx-0 ms-3 mt-4">

         

                <div class="col-sm-6 col-xl-4">

                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">

                        <i class="fa fa-box fa-3x text-danger"></i>

                        <div class="ms-3">

                            <p class="mb-2">
                                Total Pizzas
                            </p>

                            <h6 class="mb-0">

                                <?php echo $total_pizzas; ?>

                            </h6>

                        </div>

                    </div>

                </div>

                <div class="col-sm-6 col-xl-4">

                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">

                        <i class="fa fa-users fa-3x text-danger"></i>

                        <div class="ms-3">

                            <p class="mb-2">
                                Total Users
                            </p>

                            <h6 class="mb-0">

                                <?php echo $total_users; ?>

                            </h6>

                        </div>

                    </div>

                </div>

                <div class="col-sm-6 col-xl-4">

                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">

                      <i class="fa fa-list fa-3x text-danger"></i>

                        <div class="ms-3">

                            <p class="mb-2">
                                Total categories
                            </p>

                            <h6 class="mb-0">

                                <?php echo $total_categories; ?>

                            </h6>

                        </div>

                    </div>

                </div>



               


                


          


        </div>
                
      
        <!-- Footer Start -->
         <div style="margin-top: 550px">
        <?php include ('common/footer.php'); ?>
        </div>
        <!-- Footer End -->
      
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
