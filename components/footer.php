<!-- Footer -->
<footer class=" text-center ">
    <!-- Grid container -->
    <div class="container p-4">

        <!-- Section: Social media -->
        <section class="mb-4">
            <!-- Facebook -->
            <a class="btn btn-primary btn-floating m-1" style="background-color: #3b5998"
                href="https://www.facebook.com" target="_blank" role="button"><i class="fab fa-facebook"></i></a>

            <!-- Twitter -->
            <a class="btn btn-primary btn-floating m-1" style="background-color: #55acee" href="https://www.twitter.com"
                target="_blank" role="button"><i class="fab fa-twitter"></i></a>

            <!-- Google -->
            <a class="btn btn-primary btn-floating m-1" style="background-color: #dd4b39" href="https://www.quora.com"
                target="_blank" role="button"><i class="fab fa-quora"></i></a>

            <!-- Instagram -->
            <a class="btn btn-primary btn-floating m-1" style="background-color: #ac2bac"
                href="https://www.instagram.com" target="_blank" role="button"><i class="fab fa-instagram"></i></a>

            <!-- Linkedin -->
            <a class="btn btn-primary btn-floating m-1" style="background-color: #0082ca"
                href="https://www.linkedin.com" target="_blank" role="button"><i class="fab fa-linkedin-in"></i></a>
            <!-- Github -->
            <a class="btn btn-primary btn-floating m-1" style="background-color: #333333" href="https://www.github.com"
                target="_blank" role="button"><i class="fab fa-github"></i></a>
        </section>
        <!-- Section: Social media -->


        <!-- Section: Form -->
        <section class="">
            <form action="">
                <!--Grid row-->
                <div class="row d-flex justify-content-center align-items-center mb-2">
                    <!--Grid column-->
                    <div class="col-auto">
                        <p class="pt-2">
                            <strong>Sign up for our newsletter</strong>
                        </p>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-5 col-12">
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <la class="form-label float-start" for="form5Example2">Type Email address:-</la>
                            <input type="email" placeholder="example@gmail.com" id="form5Example2"
                                class="form-control" />

                        </div>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-auto">

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary mb-4">
                            Subscribe
                        </button>
                    </div>
                    <!--Grid column-->
                </div>
                <!--Grid row-->
            </form>
        </section>
        <!-- Section: Form -->


        <!-- Section: Text -->
        <section class=" mb-5">
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt
                distinctio earum repellat quaerat voluptatibus placeat nam,
                commodi optio pariatur est quia magnam eum harum
            </p>
        </section>
        <!-- Section: Text -->


        <!-- Section: Links -->
        <section class="">
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase text-decoration-underline">Vegetables</h5>

                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="#!" class="text-warnings">Coliflower</a>
                        </li>
                        <li>
                            <a href="#!" class="text-warnings footers">Spinach</a>
                        </li>
                        <li>
                            <a href="#!" class="text-warnings footers">Tomato</a>
                        </li>
                        <li>
                            <a href="#!" class="text-warnings footers">Broccoli</a>
                        </li>
                    </ul>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase text-decoration-underline">Fruits</h5>

                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="#!" class=" text-warnings">Strawberry</a>
                        </li>
                        <li>
                            <a href="#!" class="text-warnings">Avocado</a>
                        </li>
                        <li>
                            <a href="#!" class="text-warnings">BlueBerry</a>
                        </li>
                        <li>
                            <a href="#!" class="text-warnings">PineApple</a>
                        </li>
                    </ul>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase text-decoration-underline">Fish</h5>

                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="#!" class=" text-warnings">Salmon</a>
                        </li>
                        <li>
                            <a href="#!" class="text-warnings">Hilsha</a>
                        </li>
                        <li>
                            <a href="#!" class="text-warnings">Shark</a>
                        </li>
                        <li>
                            <a href="#!" class="text-warnings">Carfu</a>
                        </li>
                    </ul>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase text-decoration-underline">Devices</h5>

                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="#!" class=" text-warnings">Macbook Pro</a>
                        </li>
                        <li>
                            <a href="#!" class="text-warnings">Mac Mini</a>
                        </li>
                        <li>
                            <a href="#!" class="text-warnings">iPhone 12 Pro max</a>
                        </li>
                        <li>
                            <a href="#!" class="text-warnings">Samsung Galaxy</a>
                        </li>
                    </ul>
                </div>
                <!--Grid column-->
            </div>
            <!--Grid row-->
        </section>
        <!-- Section: Links -->

    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
        ©2025 All Copyright Reserved by...<a class="text-warnings fst-italic"
            href="https://www.linkedin.com/in/mdnurislam1" target="_blank">Imran</a>
    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->



<!-- bootstrap cdn link  -->
<script src="assets/js/bootstrap.bundle.min.js"></script>


</body>

</html>



<div>
    <?php
    if (isset($_POST['email']) && isset($_POST['Password'])) {
        $email = sanitize($_POST['email']);
        $password = sanitize($_POST['Password']);
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($cnn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                echo "
                <script>
                toastr.success('Sign in Successfully');
                setTimeout(() => {
                    window.location.href = 'index.php';
                }, 2000);
                </script>";
            } else {
                echo "<script>toastr.error('Invalid Password');</script>";
            }
        } else {
            echo "<script>toastr.error('Invalid Email');</script>";
        }
    }
    ?>
</div>