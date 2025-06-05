<?php
ob_start();
$title = "Sign Up | Imran_Store";
require_once 'components/header.php';

if (isset($_SESSION['link3Tech'])) {
    header("Location: index.php");
    exit();
}


if (isset($_POST['signUp123'])) {

    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $password = sanitize($_POST['password']);
    $confirmPassword = sanitize($_POST['confirmPassword']);


    // name section 
    if (empty($name)) {
        $errName = "please write your name";
    } elseif (!preg_match("/^[a-zA-Z-_.' ]*$/", $name)) {
        $errName = "Only letters and white space allowed";
    } else {
        $crrName = $name;
    }

    // email section 
    if (empty($email)) {
        $errEmail = "please write your email";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errEmail = "Invalid Email";
    } else {
        $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
        $checkUser = $conn->query($sql);
        if ($checkUser->num_rows == 1) {
            $errEmail = "Email already exists";
        } else {
            $crrEmail = $email;
        }
    }


    // password section 
    if (empty($password)) {
        $errPassword = "Write your new password";
    } elseif (strlen($password) < 8) {
        $errPassword = "Password must be at least 8 characters";
    } elseif (strlen($password) > 15) {
        $errPassword = "Password must not exceed 15 characters";
    } elseif (!preg_match("/[@#$%*^!+=&]/", $password)) {
        $errPassword = "Password must include at least one special character";
    } else {
        $crrPassword = $password;
    }


    // confirm password section 
    if (empty($confirmPassword)) {
        $errConfirmPassword = "please confirm your password";
    } elseif ($confirmPassword != $password) {
        $errConfirmPassword = "password does't match";
    } else {
        $crrConfirmPassword = $confirmPassword;
    }


    // this is form input data to send database
    if (isset($crrName) && isset($crrEmail) && isset($crrPassword) && isset($crrConfirmPassword)) {

        $crrPassword = password_hash($crrPassword, PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (`name`, `email`, `password`) VALUES ('$crrName','$crrEmail', '$crrPassword')";
        if (mysqli_query($conn, $sql)) {
            echo "
            <script>
            toastr.success('Sign Up Successfully');
            setTimeout(() => {
                window.location.href = 'sign-in.php';
            }, 2000);
            </script>
            ";
        } else {
            echo "
            <script>
            toastr.error('Sign Up Failed');
            </script>
            ";
        }
    }
}


?>


<!-- Sign In Form -->
<section style="background-color: #d9ebeaa9;">

    <div class="container">
        <div class="row py-3">
            <div class="col-md-5 mx-auto my-5 border border-2 border-primary-subtle rounded shadow p-4 bg-light">
                <h1 class="mb-3 text-center text-decoration-underline">Sign Up</h1>

                <form action="" method="post">

                    <!-- name section -->
                    <div class="mb-2">
                        <label for="text" class="form-label">Your Name</label>
                        <input type="text" class="form-control <?= isset($errName) ? "is-invalid" : null ?>" name="name"
                            id="name" value="<?= $name ?? null ?>">
                        <div class="invalid-feedback">
                            <?= $errName ?? null ?>
                        </div>
                    </div>

                    <!-- email section -->
                    <div class="mb-2">
                        <label for="email" class="form-label">Your Email</label>
                        <input type="text" class="form-control  <?= isset($errEmail) ? "is-invalid" : null ?> "
                            name="email" id="email" value="<?= $email ?? null ?>">
                        <div class="invalid-feedback">
                            <?= $errEmail ?? null ?>
                        </div>
                    </div>


                    <!-- password section -->
                    <div class="mb-2">
                        <label for="password" class="form-label">Your Password</label>
                        <input type="password" class="form-control  <?= isset($errPassword) ? "is-invalid" : null ?>"
                            name="password" id="password" value="<?= $password ?? null ?>">
                        <div class="invalid-feedback">
                            <?= $errPassword ?? null ?>
                        </div>
                    </div>


                    <!-- confirm password section -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Confirm Password</label>
                        <input type="password"
                            class="form-control <?= isset($errConfirmPassword) ? "is-invalid" : null ?>"
                            name="confirmPassword" id="confirmPassword" value="<?= $confirmPassword ?? null ?>">
                        <div class="invalid-feedback">
                            <?= $errConfirmPassword ?? null ?>
                        </div>
                    </div>

                    <!-- checkbox section -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="showPass">
                        <label class="form-check-label" for="showPass">Show Password</label>
                    </div>


                    <!-- submit button -->
                    <button type="submit" class="btn btn-primary px-3" name="signUp123">Sign Up</button>

                    <!-- internal sign-up section -->
                    <p class="mt-3 text-center">Already have an account? <a href="sign-in.php">Sign In</a></p>
                </form>

            </div>
        </div>

    </div>

</section>



<!-- this js for (sign-up) show password in checkbox -->
<script>
    const showPass = document.getElementById("showPass");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirmPassword");

    showPass.addEventListener("click", () => {
        if (password.type === "password") {
            password.type = "text";
            confirmPassword.type = "text";
        } else {
            password.type = "password";
            confirmPassword.type = "password";
        }
    });
</script>


<?php
require_once 'components/footer.php';
?>