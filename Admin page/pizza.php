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
$sql = "SELECT * FROM `categories`";
$result = $conn->query($sql);
$categories = $result->fetch_all(MYSQLI_ASSOC);
// var_dump($pizzas);exit;

$sql1="SELECT * FROM `pizzas` INNER join categories on pizzas.category_id=categories.category_id";
$result1=$conn->query($sql1);
$pizzas=$result1->fetch_all(MYSQLI_ASSOC);
// var_dump($products);exit;
?>

  <?php include ('common/head.php'); ?>

  <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add Pizza</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form action="insert_pizza.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                     <label for="product_name" class="form-label"> Pizza Name </label> 
                     <input type="text" class="form-control" id="product_name" name="pizza_name" required> 
                    </div>
                    <div class="mb-3">
                     <label for="product_name" class="form-label"> Description </label> 
                     <input type="text" class="form-control" id="product_name" name="pizza_description" required> 
                    </div>
                <div class="mb-3">
                     <label for="category_id" class="form-label"> Category Name</label> 
                         <select class="form-control" id="categories_id" name="category_id" required>
                        <option value="">Select Category</option> 
                        <?php foreach($categories as $c){ ?>
                         <option value="<?php echo $c['category_id']; ?>">
                             <?php echo htmlspecialchars($c['category_name']); ?> </option> 
                             <?php } ?>
                    </select> 
                </div>
                <div class="mb-3"> 
                    <label for="price" class="form-label"> Price </label> 
                    <input type="number" step="0.01" min="0" class="form-control" id="price" name="pizza_price" required> </div>
                    <div class="mb-3"> 
                        <label for="product_image" class="form-label"> Pizza Image </label> 
                        <input type="file" class="form-control" id="product_image" name="pizza_image" accept="image/*" required> 
                </div>

                    
                    <button type="submit" class="btn btn-danger"> Add Pizza </button>
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
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addProductModal">
                                                Add Pizza
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
                                                <th>Pizza Name</th>
                                                <th>Category Name</th>
                                                <th>Description</th>
                                                <th>Price</th>
                                                <th>Image</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($pizzas as $pizza) { ?>

                                                <tr>
                                                    <td><?php echo htmlspecialchars($pizza['pizza_name']) ?></td>
                                                    <td><?php echo htmlspecialchars($pizza['category_name']) ?></td>
                                                    <td><?php echo htmlspecialchars($pizza['pizza_description']) ?></td>
                                                   
                                                    <td><?php echo htmlspecialchars($pizza['pizza_price']) ?></td>
                                                    
                                                        <td>
                                                       <img src="uploads/pizza bite/<?php echo htmlspecialchars($pizza['pizza_image']) ?>" alt="<?php echo htmlspecialchars($pizza['pizza_name']) ?>" width="100" height="100px">
                                                    </td>
                                                    <td>
                                                        
                                                        <a href="update_form_pizza.php?pizza_id=<?php echo $pizza['pizza_id'] ?>" class="btn btn-sm btn-outline-success">Edit</a>
                                                        <a href="delete_pizza.php?pizza_id=<?php echo $pizza['pizza_id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this pizza?');" > Delete </a>
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
