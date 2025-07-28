<?php
ob_start();
$title = "Change Profile Picture | Imran_Store";
require_once './components/header.php';

if (!isset($_SESSION['imran_store'])) {
    header('location: sign-in.php');
    exit();
}

// pg_fetch_object 
$userId = $_SESSION['imran_store']['id'];

if (isset($_POST['changeProfilePicture'])) {

    $profilePicture = isset($_FILES['profile_picture']) ? sanitize($_FILES['profile_picture']) : null;


    if (empty($profilePicture['name'])) {
        $errProfilePicture = "Upload your profile picture";
    } elseif ($profilePicture['size'] > 2000000) {
        $errProfilePicture = "File size should be less than 2MB";
    } elseif (!in_array($profilePicture['type'], ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'])) {
        $errProfilePicture = "Invalid image type. Only jpeg, png, jpg, gif allowed";
    } else {
        $imgExtension = pathinfo($profilePicture['name'], PATHINFO_EXTENSION);
        $newFileName = uniqid() . date("hmsmdy") . rand(1000, 9999) . "." . $imgExtension;

        $targetDir = "./assets/img/profile-pictures";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $targetFile = rtrim($targetDir, '/') . '/' . $newFileName;
        $tempImages = $_FILES['profile_picture']['tmp_name'];



        if (move_uploaded_file($tempImages, $targetFile)) {
            // delete old image
            $oldImage = $_SESSION['imran_store']['picture'];
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
            // update new image in database
            $targetFile = mysqli_real_escape_string($conn, $targetFile);
            $targetFile = str_replace('./', '', $targetFile);



            $query = "UPDATE `users` SET `picture` = '$targetFile' WHERE `id` = '$userId'";
            $mainResult = mysqli_query($conn, $query);

            if ($mainResult) {
                $_SESSION['imran_store']['picture'] = $targetFile;
                echo "<script>toastr.success('Image uploaded successfully');
                setTimeout(() => {
                    window.location.href = 'change-profile-picture.php';
                }, 2000);
                </script>
                ";
            } else {
                echo "<script>toastr.error('Image upload failed');</script>";
            }
        } else {
            $errProfilePicture = "Failed to upload profile picture";
        }
    }
}



?>



<div class="container">

    <div class="row mt-1">
        <div class="col-md-5 mx-auto my-5 border border-2 border-primary-subtle rounded shadow p-4 bg-light">
            <h1 class="mb-5 text-center">Change Profile Picture</h1>


            <form action="" method="post" enctype="multipart/form-data" class="text-center">
                <div class="mb-3">
                    <label for="profile_picture" class="form-label">

                        <img src="<?= isset($_SESSION['imran_store']['picture']) ? $_SESSION['imran_store']['picture'] : './assets/img/demo-profile-picture.jpg' ?>"
                            onerror="this.onerror=null; this.src='./assets/img/demo-profile-picture.jpg';" alt=""
                            class="img-fluid mb-3 rounded-circle"
                            style="width: 200px; height: 200px; object-fit: cover; cursor: pointer; position: relative;"
                            id="ppimg">


                        <br>

                        <?php
                        if (!isset($_SESSION['imran_store']['picture'])) {
                        ?>
                        <span class="text-muted translate-middle"
                            style="top: 52%; left: 50%; transform: translate(-48%, -50%); position: absolute; cursor: pointer;"
                            id="imgDropText">Image Drop Here</span>

                        <?php
                        }
                        ?>

                        <input type="file"
                            class="d-none form-control <?= isset($errProfilePicture) ? 'is-invalid' : null ?>"
                            name="profile_picture" id="profile_picture" accept="image/*">

                        <div class="invalid-feedback"><?= isset($errProfilePicture) ? $errProfilePicture : null ?>
                        </div>
                    </label>


                </div>



                <button type="submit" class="btn btn-primary" id="changeProfilePictureBTN"
                    name="changeProfilePicture">Change Profile
                    Picture</button>

            </form>

        </div>
    </div>
</div>




<script>
$('#profile_picture').change(function() {
    const file = this.files[0];
    const reader = new FileReader();
    reader.onload = function(event) {
        $('#ppimg').attr('src', event.target.result);
    }
    reader.readAsDataURL(file);
})


// it's for hide span_(drop image text)
document.getElementById('ppimg').addEventListener('click', function() {
    const span = document.getElementById('imgDropText');
    if (span) {
        span.style.display = 'none';

    }
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