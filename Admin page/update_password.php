<?php

include("../conn.php");

if (!isset($_GET['user_id'])) {
    header("Location: users.php");
    exit;
}

$id = $_GET['user_id'];

// Get user
$sql = "SELECT * FROM users WHERE user_id = '$id'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("User not found");
}

$user = $result->fetch_assoc();


// Update Password
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check passwords
    if ($password !== $confirm_password) {

        $error = "Passwords do not match!";

    } else {

        // Hash new password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Update password
        $sql = "UPDATE users 
                SET password = '$hashed_password'
                WHERE user_id = '$id'";

        if ($conn->query($sql)) {

            echo "<script>
                    alert('Password updated successfully!');
                    window.location.href='users.php';
                  </script>";

            exit;

        } else {

            $error = "Error updating password!";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include ('common/head.php');?>

<body>

<div class="container mt-5" >

    <div class="row justify-content-center">

        <div class="col-md-6" >

            <div class="card shadow" style="border-radius:100px">

                <div class="card-header bg-danger" style="border-radius:100px">

                    <h4 class="mb-0">
                        <i class="bi bi-key"></i>
                        Change Password
                    </h4>

                </div>

                <div class="card-body">

                    <div class="mb-3">

                        <label class="form-label">
                            Username
                        </label>

                        <input type="text"
                               class="form-control"
                               value="<?php echo htmlspecialchars($user['user_name']); ?>"
                               disabled>

                    </div>


                    <?php if (isset($error)): ?>

                        <div class="alert alert-danger">
                            <?php echo $error; ?>
                        </div>

                    <?php endif; ?>


                    <form method="POST">

                        <!-- New Password -->

                        <div class="mb-3">

                            <label class="form-label">
                                New Password
                            </label>

                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   required
                                   minlength="6">

                        </div>


                        <!-- Confirm Password -->

                        <div class="mb-3">

                            <label class="form-label">
                                Confirm New Password
                            </label>

                            <input type="password"
                                   name="confirm_password"
                                   class="form-control"
                                   required
                                   minlength="6">

                        </div>


                        <button type="submit"
                                class="btn btn-danger" style="border-radius:100px; box-shadow: 0px 10px 10px rgba(161, 16, 16, 0.8) ">

                            <i class="bi bi-key"></i>
                            Update Password

                        </button>


                        <a href="users.php"
                           class="btn btn-outline-secondary" style="border-radius:100px; box-shadow: 0px 10px 10px rgba(161, 16, 16, 0.8)">

                            Cancel

                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>