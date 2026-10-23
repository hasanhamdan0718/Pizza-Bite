<?php include('../conn.php');

if (isset($_GET['pizza_id'])) {
    $pizza_id = (int) $_GET['pizza_id'];
    // var_dump($pizza_id); exit;// Debugging line to check the value of $pizza_id
  
    $sql = "DELETE FROM pizzas WHERE pizza_id = ? ";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $pizza_id);

    if ($stmt->execute()) {
        header("Location: pizza.php");
        exit;
    } else {
        echo "Error deleting pizza: " . $stmt->error;
    }
} else {
    die("Pizza ID not provided.");
}
?>