<?php
ob_start();
$title = "Change Password | Imran_Store";
require_once './components/header.php';



if (!isset($_SESSION['link3Tech'])) {
    header('location: sign-in.php');
    exit();
}

// pg_fetch_object 
$userId = $_SESSION['link3Tech']['id'];


// if (isset($_POST['changePassword'])) {
//     $oldPassword = $_POST['oldPassword'];
//     $newPassword = $_POST['newPassword'];
//     $confirmPassword = $_POST['confirmPassword'];

//     // old password section 
//     if (empty($oldPassword)) {
//         $errOldPassword = "Write your old password";
//     } else {
//         $crrOldPassword = $oldPassword;
//     }

//     // new password section 
//     if (empty($newPassword)) {
//         $errNewPassword = "Write your new password";
//     } else {
//         $crrNewPassword = $newPassword;
//     }

//     // confirm password section 
//     if (empty($confirmPassword)) {
//         $errConfirmPassword = "Write your confirm password";
//     } else {
//         $crrConfirmPassword = $confirmPassword;
//     }

//     if (isset($crrOldPassword) && isset($crrNewPassword) && isset($crrConfirmPassword)) {
//         $sql = "SELECT * FROM `users` WHERE `id` = '$userId'";
//         $conn->query($sql);
//         $checkUser = $conn->query($sql);

//         if ($checkUser->num_rows != 1) {
//             echo "<script>toastr.error('User not found');</script>";
//             setcookie("tryCount", $_COOKIE['tryCount'] + 1, time() + (60 * 30), "/");
//         } else {
//             $user = $checkUser->fetch_assoc();
//             if (!password_verify($crrOldPassword, $user['password'])) {
//                 echo "<script>toastr.error('Incorrect Old Password');</script>";
//                 setcookie("tryCount", $_COOKIE['tryCount'] + 1, time() + (60 * 30), "/");
//             } else {
//                 if ($crrNewPassword != $crrConfirmPassword) {
//                     echo "<script>toastr.error('New Password not match');</script>";
//                     setcookie("tryCount", $_COOKIE['tryCount'] + 1, time() + (60 * 30), "/");
//                 } else {
//                     $sql = "UPDATE `users` SET `password` = '$crrNewPassword' WHERE id = '$userId'";
//                     if ($conn->query($sql)) {
//                         echo "<script>toastr.success('Password Change Successfully');
//                         setTimeout(() => {
//                             window.location.href = 'sign-in.php';
//                         }, 2000);
//                         </script>
//                         ";
//                     } else {
//                         echo "<script>toastr.error('Password Change Failed');
//                         setTimeout(() => {
//                             window.location.href = 'change-password.php';
//                         }, 2000);
//                         </script>
//                         ";
//                     }
//                 }
//             }
//         }
//     }
// }



if (isset($_POST['changePassword'])) {
    $oldPassword = sanitize($_POST['oldPassword']);
    $newPassword = sanitize($_POST['newPassword']);
    $confirmPassword = sanitize($_POST['confirmPassword']);

    // old password section 
    if (empty($oldPassword)) {
        $errOldPassword = "Write your old password";
    } else {
        $crrOldPassword = $conn->real_escape_string($oldPassword);
    }

    // new password section 
    if (empty($newPassword)) {
        $errNewPassword = "Write your new password";
    } elseif (!preg_match("/^[a-zA-Z0-9@#$%*^!+=&]{8,}$/", $newPassword)) {
        $errNewPassword = "Invalid new Password";
    } else {
        $crrNewPassword = $conn->real_escape_string($newPassword);
    }


    // confirm password section 
    if (empty($confirmPassword)) {
        $errConfirmPassword = "Write your confirm password";
    } elseif ($confirmPassword != $newPassword) {
        $errConfirmPassword = "Password not match";
    } else {
        $crrConfirmPassword = $conn->real_escape_string($confirmPassword);
    }


    if (isset($crrOldPassword) && isset($crrNewPassword) && isset($crrConfirmPassword)) {
        // check old password
        $userInfo = $conn->query("SELECT * FROM `users` WHERE `id` = '$userId'")->fetch_assoc();

        if (password_verify($oldPassword, $userInfo['password'])) {


            // update password

            $haseNewPassword = password_hash($crrNewPassword, PASSWORD_BCRYPT);

            if ($conn->query("UPDATE `users` SET `password` = '$haseNewPassword' WHERE `id` = '$userId'")) {
                session_unset();
                session_destroy();
                echo "<script>
                    toastr.success('Password changed successfully');
                    setTimeout(() => {
                        window.location.href = 'sign-in.php';
                    }, 3000);
                </script>";
            } else {
                echo "<script>toastr.error('Password Change Failed');</script>";
            }
        } else {
            echo "<script>toastr.error('Incorrect Old Password');</script>";
        }
    }
}
?>



<div class="container">

    <div class="row mt-1">
        <div class="col-md-5 mx-auto my-5 border border-2 border-primary-subtle rounded shadow p-4 bg-light">
            <h1 class="mb-4 text-center">Change Your Password</h1>

            <form action="" method="post">

                <!-- old password -->
                <div class="mb-3">

                    <label for="" class="form-label">Old Password:</label>
                    <input type="password" class="form-control <?= isset($errOldPassword) ? 'is-invalid' : null ?>"
                        name="oldPassword" value="<?= $oldPassword ?? null ?>">

                    <div class="invalid-feedback">
                        <?= isset($errOldPassword) ? $errOldPassword : null ?>
                    </div>
                </div>

                <!-- new password -->
                <div class="mb-3">

                    <label for="" class="form-label">New Password:</label>
                    <input type="password" class="form-control <?= isset($errNewPassword) ? 'is-invalid' : null ?>"
                        name="newPassword" value="<?= $newPassword ?? null ?>">

                    <div class="invalid-feedback">
                        <?= isset($errNewPassword) ? $errNewPassword : null ?>
                    </div>
                </div>

                <!-- confirm password -->
                <div class="mb-3">

                    <label for="" class="form-label">Confirm Password:</label>
                    <input type="password" class="form-control <?= isset($errConfirmPassword) ? 'is-invalid' : null ?>"
                        name="confirmPassword" value="<?= $confirmPassword ?? null ?>">

                    <div class="invalid-feedback">
                        <?= isset($errConfirmPassword) ? $errConfirmPassword : null ?>
                    </div>
                </div>

                <!-- checkbox section -->
                <div class="mb-5 form-check">
                    <input type="checkbox" class="form-check-input" id="showPass">
                    <label class="form-check-label" for="showPass">Show Password</label>
                </div>

                <!-- submit button -->
                <button type="submit" class="btn btn-primary" name="changePassword">Change Password</button>

            </form>

        </div>
    </div>
</div>


<!-- this js for (change password) show password in checkbox -->
<script>
$(document).ready(function() {
    $('#showPass').click(function() {
        if ($(this).is(':checked')) {
            $('input[type="password"]').attr('type', 'text');
        } else {
            $('input[type="text"]').attr('type', 'password');
        }
    });
});
</script>





<?php
require_once './components/footer.php';
?>