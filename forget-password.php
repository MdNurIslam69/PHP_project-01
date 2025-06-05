<?php
$title = "Forget Password | Imran_Store";
require_once 'components/header.php';


if (isset($_POST['submit'])) {
    $email = $_POST['email'] ?? null;

    if ($email != null) {
        // Check if email exists in users table
        $userQuery = "SELECT * FROM `users` WHERE `email` = '$email'";
        $userResult = $conn->query($userQuery);

        if ($userResult->num_rows > 0) {
            // Generate reset token and expiration
            $token = bin2hex(random_bytes(50));
            $expires = date("U") + 1800; // 30 minutes

            $conn->query("INSERT INTO `password_resets`(`email`, `token`, `expires`) VALUES ('$email', '$token', '$expires')");

            // Send email with reset link

            // here for reset link, must need client domain/paid server 
            $resetLink = "http://localhost/PHP/PHP%20Project/PHP_project-01/reset-password.php?token=$token";
            mail($email, "Password Reset", "Click here to reset your password: $resetLink");

            echo "<script>
                toastr.success('Password reset link sent to your email');</script>";
        } else {
            echo "<script>toastr.error('Email not found');</script>";
        }
    }
}
?>

<!-- Forget Password Form -->
<section style="background-color: #d9ebeaa9;">


    <div class="container">
        <div class="row py-3">
            <div class="col-md-5 mx-auto my-5 border border-2 border-primary-subtle rounded shadow p-4 bg-light ">
                <h1 class="mb-4 text-center text-decoration-underline">Forget Your Password</h1>

                <form action="" method="post">
                    <!-- Email Input -->
                    <div class="mb-4">
                        <label for="email" class="form-label">Enter Your Email: </label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary" name="submit">Send Reset Link</button>


                </form>

            </div>
        </div>

    </div>

</section>


<?php
require_once 'components/footer.php';
?>