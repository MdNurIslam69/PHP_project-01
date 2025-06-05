<?php
$title = "Reset Password | Imran_Store";
require_once 'components/header.php';

// match the token and give access to change the password
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $resetQuery = "SELECT * FROM `password_resets` WHERE `token` = '$token' AND `expires` > " . date("U");
    $resetResult = $conn->query($resetQuery);

    if ($resetResult->num_rows > 0) {
        // token is valid
        if (isset($_POST['submit'])) {
            $newPassword = $_POST['password'] ?? null;
            $confirmPassword = $_POST['confirmPassword'] ?? null;

            if ($newPassword && $confirmPassword) {
                if ($newPassword !== $confirmPassword) {
                    echo "<script>toastr.error('Passwords do not match!');</script>";
                } else {
                    // update user password
                    $userEmail = $resetResult->fetch_assoc()['email'];
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                    $conn->query("UPDATE `users` SET `password` = '$hashedPassword' WHERE `email` = '$userEmail'");

                    // delete reset token
                    $conn->query("DELETE FROM `password_resets` WHERE `token` = '$token'");
                    echo "<script>toastr.success('Password Reset Successfully!'); setTimeout(() => {window.location.href = 'sign-in.php';}, 3000);</script>";
                }
            }
        }
    } else {
        // token is invalid or expired
        echo "<script>toastr.error('Invalid or expired token');</script>";
    }
}
?>

<!-- Forget Password Form -->
<section style="background-color: #d9ebeaa9;">
    <div class="container">
        <div class="row py-3">
            <div class="col-md-5 mx-auto my-5 border border-2 border-primary-subtle rounded shadow p-4 bg-light">
                <h2 class="mb-5 text-center text-decoration-underline">Reset Your Password</h2>

                <form action="" method="POST">

                    <!-- Password Input -->
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>

                    <!-- Confirm Password Input -->
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="confirmPassword" id="confirmPassword"
                            required>
                    </div>

                    <!-- checkbox section -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="showPass">
                        <label class="form-check-label" for="showPass">Show Password</label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary" name="submit">Reset Password</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- this js for (reset password) show password in checkbox -->
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