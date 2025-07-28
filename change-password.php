<?php
ob_start();
$title = "Change Password | Imran_Store";
require_once './components/header.php';



if (!isset($_SESSION['imran_store'])) {
    header('location: sign-in.php');
    exit();
}

// pg_fetch_object 
$userId = $_SESSION['imran_store']['id'];





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



<!-- screen chat-bot section start -->
<!--  -->
<div class="chat-bot-container">
    <!-- Social Icons -->
    <div class="social-icons" id="socialIcons">
        <a href="https://www.facebook.com/md.nurislam6" target="_blank" class="btn btn-outline-primary" style="--i:6">
            <i class="fab fa-facebook"></i>
        </a>

        <a href="https://x.com/MdNurIslam21050" target="_blank" class="btn btn-outline-primary" style="--i:6">
            <i class="fab fa-x"></i>
        </a>

        <a href="https://www.instagram.com/md_nur_islam5" target="_blank" class="btn btn-outline-primary" style="--i:6">
            <i class="fab fa-instagram"></i>
        </a>

        <a href="https://www.linkedin.com/in/mdnurislam1" target="_blank" class="btn btn-outline-primary" style="--i:6">
            <i class="fab fa-linkedin"></i>
        </a>

        <a href="https://www.google.com/maps/place/Nurislam+Imran/..." target="_blank" class="btn btn-outline-primary"
            style="--i:5">
            <i class="fas fa-map-marker-alt"></i>
        </a>
        <a href="https://www.facebook.com/messages/t/61561367169765" target="_blank" class="btn btn-outline-primary"
            style="--i:6">
            <i class="fab fa-facebook-messenger"></i>
        </a>


    </div>

    <!-- Chatbot Toggle Button -->
    <div class="chat-bot-toggle" id="chatbotBtn">
        <img src="assets/img/chat-bot.png" alt="chat-bot" width="60" height="60" id="chatbotImage" />
        <span class="close-symbol" id="closeSymbol">&times;</span>
    </div>
</div>

<!-- ✅ Styles -->
<style>
/* Common styles */
.chat-bot img,
.chat-bot-toggle img {
    width: 60px;
    height: 60px;
    display: block;
}

.chat-bot-contact {
    position: fixed;
    bottom: 10px;
    right: 80px;
    z-index: 998;
}

/* Toggle Chatbot styles */
.chat-bot-container {
    position: fixed;
    bottom: 10px;
    right: 10px;
    z-index: 999;
}

.chat-bot-toggle {
    cursor: pointer;
    position: relative;
    width: 60px;
    height: 60px;
}

.close-symbol {
    position: absolute;
    top: 0;
    left: 0;
    width: 65px;
    height: 65px;
    font-size: 36px;
    color: #007bff;
    background-color: transparent;
    border-radius: 50%;
    display: none;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    margin-top: -10px;
}

.chat-bot-toggle.open .close-symbol {
    display: flex;
}

.chat-bot-toggle.open img {
    display: none;
}

.social-icons {
    position: absolute;
    bottom: 70px;
    right: 5px;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 15px;
    pointer-events: none;
}


.social-icons a {
    opacity: 0;
    transform: translateX(30px);
    transition: all 0.3s ease-in-out;
    transition-delay: calc(var(--i) * 0.04s);
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background-color: transparent;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    font-size: 25px;
    color: #6d5af1;
}

.social-icons.show a {
    opacity: 1;
    transform: translateX(0);
    pointer-events: auto;
}

.social-icons a:hover {
    transform: translateX(-10px) scale(1.1);
    background-color: #0070f8;
}
</style>

<!-- ✅ Scrollbar Fix for Modal -->
<style>
html {
    overflow-y: scroll;
}

body.modal-open {
    padding-right: 0 !important;
}
</style>


<!-- chatbot JavaScript section -->
<script>
const chatbotBtn = document.getElementById("chatbotBtn");
const chatbotImage = document.getElementById("chatbotImage");
const closeSymbol = document.getElementById("closeSymbol");
const socialIcons = document.getElementById("socialIcons");

let isOpen = false;

chatbotBtn.addEventListener("click", () => {
    isOpen = !isOpen;

    if (isOpen) {
        socialIcons.classList.add("show");
        chatbotBtn.classList.add("open");
        closeSymbol.style.display = "flex";
        chatbotImage.style.display = "none";
    } else {
        socialIcons.classList.remove("show");
        chatbotBtn.classList.remove("open");
        closeSymbol.style.display = "none";
        chatbotImage.style.display = "block";
    }
});
</script>
<!-- screen chat-bot section end -->





<?php
require_once './components/footer.php';
?>