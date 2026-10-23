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
$sql="SELECT * FROM `users`";
$result = $conn->query($sql);
// var_dump($result);
// exit;
$users=$result->fetch_all(MYSQLI_ASSOC);
// var_dump($categories);exit;
// $categories=$result->fetch_assoc();
// var_dump($categories);exit;
?>

  <?php include ('common/head.php'); ?>

  <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="insert_user.php" method="POST">
                    <div class="mb-3">
                        <label for="userName" class="form-label">User Name</label>
                        <input type="text" class="form-control" id="userName" name="user_name" placeholder="Enter User Name" required autocomplete="off">
                    </div>

                     </div>
                    <div class="mb-3">
                        <label for="pass" class="form-label">Password</label>
                        <input type="password" class="form-control" id="pass" name="password" placeholder="Enter Password" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                            <select class="form-control" name="user_role" required>
                                <option value="">Select Role</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>

                        </option>
                    </div>
                    
                   
                    <button type="submit" class="btn btn-danger float-end">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>



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
                            <div class="container">
                                <div class="row justify-content-end mt-3">
                                    <div class="col-auto">
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                                Add User
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-light rounded h-100 p-4">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="datatable">
                                        <thead>
                                            <tr class="table-danger">
                                                <th>User Name</th>
                                               <th>Role</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($users as $user){ ?>

                                            <tr>
                                                <td><?php echo $user['user_name'] ?></td>
                                                <td><?php echo $user['user_role'] ?></td>
                                                <td>
                                                    <a href="update_form_user.php?user_id=<?php echo $user['user_id'] ?>" class="btn btn-sm btn-outline-success">Edit</a>
                                                    <a href="delete_user.php?user_id=<?php echo $user['user_id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this product?');" >Delete</a>
                                                     <a href="update_password.php?user_id=<?php echo $user['user_id']; ?>"
                                                            class="btn btn-warning btn-sm"
                                                            title="Change Password">
                                                            <i class="bi bi-key"></i>
                                                        </a>


                                                   

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
