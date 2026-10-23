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
if (isset($_GET['pizza_id'])) {
    $pizza_id = $_GET['pizza_id'];
    $sql = "SELECT * FROM `pizzas` INNER join categories on pizzas.category_id=categories.category_id where pizza_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $pizza_id);
    $stmt->execute();
    $result = $stmt->get_result();
    // var_dump($result);exit;
    if ($result->num_rows > 0) {
        $pizza = $result->fetch_assoc();
        // var_dump($pizza);exit;
    } else {
        echo "Pizza not found.";
        exit;
    }
} else {
    echo "Pizza ID not provided.";
    exit;
}


$categories_sql = "SELECT category_id, category_name FROM categories ORDER BY category_name ASC ";
$categories_result = $conn->query($categories_sql);
$categories = $categories_result->fetch_all(MYSQLI_ASSOC);



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
                        <form action="update_pizza.php" method="POST" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label for="product_id" class="form-label" hidden>Pizza ID</label>
                                <input type="text" class="form-control" id="product_id" name="pizza_id" required value="<?php echo htmlspecialchars($pizza['pizza_id']); ?>" readonly hidden>
                            </div>
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Pizza Name</label>
                                <input type="text" class="form-control" id="product_name" name="pizza_name" required value="<?php echo htmlspecialchars($pizza['pizza_name']); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Description</label>
                                <input type="text" class="form-control" id="product_name" name="pizza_description" required value="<?php echo htmlspecialchars($pizza['pizza_description']); ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label"> Category Name </label>
                                <select class="form-control" name="category_id" required>
                                    <option value=""> Select Category </option>
                                    <?php foreach ($categories as $c) { ?>
                                        <option value="<?php echo $c['category_id']; ?>" <?php if ($c['category_id'] == $pizza['category_id']) echo 'selected'; ?>>
                                            <?php echo htmlspecialchars($c['category_name']); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            
                            <div class="mb-3"> 
                                <label class="form-label"> Price </label>
                                 <input type="number" step="0.01" min="0" class="form-control" name="pizza_price" value="<?php echo $pizza['pizza_price']; ?>" required> 
                                </div>

                                 <?php if (!empty($pizza['pizza_image'])) { ?>
                                <div class="mb-3">
                                    <label class="form-label"> Current Pizza Image </label>
                                    <br> <img src="uploads/pizza bite/<?php echo htmlspecialchars($pizza['pizza_image']); ?>" alt="Pizza Image" width="120" height="120" style="object-fit: cover;">
                                </div>
                            <?php } ?>

                            <div class="mb-3">
                                <label class="form-label"> Replace Pizza Image </label>
                                <input type="file" class="form-control" name="pizza_image" accept="image/*">
                            </div>
                            <button type="submit" class="btn btn-danger">Update Pizza</button>

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