<?php
ob_start();
require_once 'components/header.php';

if (isset($_SESSION['link3Tech'])) {
    header("Location: index.php");
    exit();
}



// set cookie tryCount = 0
if (!isset($_COOKIE['tryCount'])) {
    setcookie("tryCount", 0, time() + (60 * 30), "/");
}


if (isset($_POST['signIn123'])) {

    if ($_COOKIE['tryCount'] >= 3) {
        echo "<script>toastr.error('User block! try after 30 minute');</script>";
    } else {

        $email = sanitize($_POST['email']);
        $password = sanitize($_POST['password']);


        // email section 
        if (empty($email)) {
            $errEmail = "please write your email";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errEmail = "Invalid Email";
        } else {
            $crrEmail = $email;
        }

        // password section 
        if (empty($password)) {
            $errPassword = "please write your password";
        } else {
            $crrPassword = $password;
        }


        if (isset($crrEmail) && isset($crrPassword)) {
            $sql = "SELECT * FROM `users` WHERE `email` = '$crrEmail'";
            $conn->query($sql);
            $checkUser = $conn->query($sql);

            if ($checkUser->num_rows != 1) {
                echo "<script>toastr.error('Email not found');</script>";
                setcookie("tryCount", $_COOKIE['tryCount'] + 1, time() + (60 * 30), "/");
            } else {
                $user = $checkUser->fetch_assoc();
                if (!password_verify($crrPassword, $user['password'])) {
                    echo "<script>toastr.error('Incorrect Password');</script>";
                    setcookie("tryCount", $_COOKIE['tryCount'] + 1, time() + (60 * 30), "/");
                } else {
                    $_SESSION['link3Tech'] = $user;
                    echo "
                    <script>
                    toastr.success('Sign in Successfully');
                    setTimeout(() => {
                        window.location.href = 'index.php';
                    }, 2000);
                    </script>
                    ";
                }
            }
        }
    }
}

?>


<!-- Sign In Form -->
<div class=" bg-colorss ">


    <div class="container">
        <div class="row pt-1">
            <div class="col-md-5 mx-auto my-5 border border-2 border-primary-subtle rounded shadow p-4 bg-light ">
                <h1 class="mb-3 text-center">Sign In</h1>

                <form action="" method="post">

                    <!-- email section -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Your Email</label>
                        <input type="email" class="form-control <?= isset($errEmail) ? 'is-invalid' : null ?>"
                            name="email" id="email" value="<?= $email ?? null ?>">

                        <div class="invalid-feedback">
                            <?= $errEmail ?? null ?>
                        </div>
                    </div>

                    <!-- password section -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Your Password</label>
                        <input type="password" class="form-control <?= isset($errPassword) ? 'is-invalid' : null ?>"
                            name="password" id="password">

                        <div class="invalid-feedback">
                            <?= $errPassword ?? null ?>
                        </div>
                    </div>


                    <!-- checkbox section -->
                    <div class="mb-4 form-check">
                        <input type="checkbox" class="form-check-input" id="showPass">
                        <label class="form-check-label" for="showPass">Show Password</label>
                    </div>



                    <!-- submit button -->
                    <button type="submit" class="btn btn-primary" name="signIn123">Sign In</button>

                    <!-- internal sign-up section -->
                    <p class="mt-3">Don't have an account? <a href="sign-up.php">Sign Up</a></p>
                </form>

            </div>
        </div>

    </div>

</div>


<!-- this js for (sign-in) show password in checkbox -->
<script>
const showPass = document.getElementById("showPass");
const password = document.getElementById("password");

showPass.addEventListener("click", () => {
    if (password.type === "password") {
        password.type = "text";
    } else {
        password.type = "password";
    }
});
</script>




<?php
require_once 'components/footer.php';
?>