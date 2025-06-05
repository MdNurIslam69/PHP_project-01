<?php
$title = "Delete_user Account | Imran_Store";
require_once('./components/header.php');



// delete account section
if (isset($_POST['deleteUser'])) {
    $userId = $_SESSION['link3Tech']['id'];
    $deleteQuery = "DELETE FROM `users` WHERE `id` = '$userId'";
    if ($conn->query($deleteQuery)) {
        session_unset();
        session_destroy();
        echo "<script>toastr.success('Account Deleted Successfully'); setTimeout(() => {
        window.location.href = 'sign-up.php';}, 3000);</script>";
    } else {
        echo "<script>toastr.error('Account Delete Failed!'); setTimeout(() => {
        window.location.href = './';}, 2000);</script>";
    }
}
?>




<!-- deleteUser-account__popup--section-->
<!-- .. -->
<div class="container">
    <div
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); display: flex; align-items: center; justify-content: center; z-index: 9999;">
        <div
            style="background: #fff; max-width: 400px; width: 90%; padding: 1.5rem; border-radius: 10px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); text-align: center;">

            <h3 style="margin-bottom: 3rem; font-size: 1.25rem; color: purple;">Are you sure do want to delete Your
                Account?</h3>

            <form method="post" action=""
                style="display: flex; align-items: center; justify-content: center; gap: 3rem;">

                <input type="hidden" name="id" value="<?= $userId ?>">

                <button type="submit" name="deleteUser"
                    style="background: #e74c3c; color: #fff; border: none; padding: 0.5rem 1.2rem; border-radius: 6px; cursor: pointer;  font-weight: bold;">Yes</button>


                <a href="./"
                    style="background: #3498db; color: #fff; border: none; padding: 0.5rem 1.2rem; border-radius: 6px; cursor: pointer; font-weight: bold; text-decoration: none;">No</a>

            </form>
        </div>
    </div>
</div>




<!-- this hero secton, just show design for (delete account pop-up section) -->
<!-- .. -->
<div class=" heroSection-color">
    <div class="container row py-5 mx-auto d-flex align-items-center justify-content-between px-lg-0 px-md-0">
        <div class="col-lg-5 d-flex flex-column justify-content-center col-md-5 mt-4 position-relative">
            <h1 class="forSame-color" style="font-size: 35px;">Welcome to Imran_Store Website</h1>
            <p class="my-3 hero-contents">Explore a World of Quality, Style, and Convenience—Your Ultimate Destination
                For
                Premium Products, Unbeatable Prices, and Effortless Shopping. We've Got You Covered Whether You're
                Hunting For The Latest Fashion, Essential Gadgets, or Everyday Items. Enjoy Easy Shopping, Secure
                Checkout, and Fast Delivery, Making Your Experience Seamless. Start Your Smart Shopping Journey Today!
            </p>


            <!-- social media link  -->
            <div class="social-media mt-3">
                <a href="https://www.facebook.com/md.nurislam6" target="_blank" class="btn btn-outline-primary "><i
                        class="fa-brands fa-facebook  "></i></a>

                <a href="https://x.com/MdNurIslam21050" target="_blank" class="btn btn-outline-primary "><i
                        class="fa-brands fa-x"></i></a>

                <a href="https://www.instagram.com/md_nur_islam5" target="_blank" class="btn btn-outline-primary "><i
                        class="fa-brands fa-instagram"></i></a>

                <a href="https://www.linkedin.com/in/mdnurislam1" target="_blank" class="btn btn-outline-primary "><i
                        class="fa-brands fa-linkedin"></i></a>

                <a href="https://github.com/MdNurIslam69" target="_blank" class="btn btn-outline-primary "><i
                        class="fa-brands fa-github"></i></a>

                <br>

                <a href="https://www.behance.net/mdnurislam73" target="_blank"
                    class="btn btn-primary mt-3 hero-btn col-md mb-5">Go
                    somewhere</a>
            </div>

        </div>

        <div class="col-lg-6 col-md-6 p-0 mt-lg-4 mt-md-4 mt-sm-1"
            style="border-left: 25px solid #6d5ce8; border-top-left-radius: 25px; border-bottom-left-radius: 150px;">
            <img src="./assets/img/pro-img-hero.jpeg" class="img-fluid heroImg-redious" alt="hero-image"
                style="border-bottom-left-radius: 130px;">
        </div>
    </div>

    <div class="z-index ">
        <svg xmlns="http://www.w3.org/2000/heroSection-svg" class="heroSection-svg" viewBox=" 0 0 1440 300">
            <path fill="#ffffff" fill-opacity="1"
                d="M0,192L60,186.7C120,181,240,171,360,186.7C480,203,600,245,720,261.3C840,277,960,267,1080,261.3C1200,256,1320,256,1380,256L1440,256L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z">
            </path>
        </svg>
    </div>
</div>




<?php
require_once('./components/footer.php');
?>