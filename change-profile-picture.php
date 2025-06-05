<?php
ob_start();
$title = "Change Profile Picture | Imran_Store";
require_once './components/header.php';

if (!isset($_SESSION['link3Tech'])) {
    header('location: sign-in.php');
    exit();
}

// pg_fetch_object 
$userId = $_SESSION['link3Tech']['id'];

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
            $oldImage = $_SESSION['link3Tech']['picture'];
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
            // update new image in database
            $targetFile = mysqli_real_escape_string($conn, $targetFile);
            $targetFile = str_replace('./', '', $targetFile);



            $query = "UPDATE `users` SET `picture` = '$targetFile' WHERE `id` = '$userId'";
            $mainResult = mysqli_query($conn, $query);

            if ($mainResult) {
                $_SESSION['link3Tech']['picture'] = $targetFile;
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

                        <img src="<?= isset($_SESSION['link3Tech']['picture']) ? $_SESSION['link3Tech']['picture'] : './assets/img/demo-profile-picture.jpg' ?>"
                            onerror="this.onerror=null; this.src='./assets/img/demo-profile-picture.jpg';" alt=""
                            class="img-fluid mb-3 rounded-circle"
                            style="width: 200px; height: 200px; object-fit: cover; cursor: pointer; position: relative;"
                            id="ppimg">


                        <br>

                        <?php
                        if (!isset($_SESSION['link3Tech']['picture'])) {
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


<?php
require_once './components/footer.php';
?>