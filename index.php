<?php
require_once './components/header.php';
?>


<!-- hero section start -->

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

        <div class="col-lg-6 col-md-6 p-0 mt-4"
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

<!-- hero section end -->

<!-- hero section-1 bottom (hr) -->
<div>
    <hr class="container heroSection-hr">
</div>




<!-- hero section-2 start -->
<div class="container d-lg-flex d-md-flex gap-lg-5 gap-md-4">
    <!-- features product section start  -->
    <div class="row mt-5 col-lg-2 col-md-4 col-sm-12">
        <div class="">
            <h2 class="forSame-color text-center text-decoration-underline mb-4 h5" style="margin-top: 5px;">Features
                Products</h2>

            <div class="row">
                <?php
                // select random 5 products from the database
                $featuresProductsQuery = "SELECT * FROM products ORDER BY RAND() LIMIT 5";

                $featuresProductsResult = $conn->query($featuresProductsQuery);
                while ($product = $featuresProductsResult->fetch_assoc()):
                ?>
                <div class="col-12 mb-4">
                    <div class="card h-100">
                        <img src="./assets/img/products/<?= $product['images'] ?>" alt="<?= $product['name'] ?>"
                            class="card-img-top img-fluid d-flex align-content-center border-bottom px-2 object-fit-contain"
                            style="height: 100%; width: 100%;">
                        <div class="card-body ">
                            <h5 class="card-title text-truncate"
                                style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                <?= $product['name'] ?></h5>

                            <div
                                class="d-flex gap-lg-0 gap-md-2 gap-sm-3 py-2 justify-content-lg-between justify-content-md-between px-lg-0 px-md-2 ">
                                <p class="" style="font-size: 14px;">Price:
                                    <span
                                        class="text-decoration-line-through text-muted small fa-solid fa-bangladeshi-taka-sign">
                                        <?= number_format($product['regular_price']) ?></span>
                                </p>

                                <p class="priceFontSize" style="font-size: 14px; "><span
                                        class="fa-solid fa-bangladeshi-taka-sign"></span>
                                    <?= number_format($product['sales_price']) ?></p>
                            </div>

                            <a href="single-product.php?id=<?= $product['id'] ?>" class="viewDetailsBtns "
                                style="color: white; background-color: #6d5ce8; text-decoration: none; padding: 9px 12px; border-radius: 5px;">View
                                Details</a>
                        </div>

                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
    <!-- features product section end  -->

    <!-- <hr> -->

    <div class="col-lg-10 col-md-8 col-sm-12 ">

        <!-- New Arrival Section start -->
        <div class="row ">
            <div class="col-md-12 ">
                <h2 class="forSame-color text-center text-decoration-underline mb-4">New Arrival </h2>

                <div class="row">
                    <?php
                    // select random 5 products from the database
                    $featuresProductsQuery = "SELECT * FROM products ORDER BY RAND() LIMIT 8";

                    $featuresProductsResult = $conn->query($featuresProductsQuery);
                    while ($product = $featuresProductsResult->fetch_assoc()):
                    ?>
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4 ">
                        <div class="card h-100">
                            <img src="./assets/img/products/<?= $product['images'] ?>" alt="<?= $product['name'] ?>"
                                class="card-img-top img-fluid d-flex align-content-center border-bottom px-2 object-fit-contain"
                                style="height: 100%; width: 100%;">
                            <div class="card-body ">
                                <h5 class="card-title text-truncate"
                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    <?= $product['name'] ?></h5>

                                <div class="d-flex  gap-md-3 gap-sm-3 py-2">
                                    <p class="h6">Price: <span
                                            class="text-decoration-line-through text-muted small fa-solid fa-bangladeshi-taka-sign">
                                            <?= number_format($product['regular_price']) ?></span>
                                    </p>

                                    <p class="h6 priceFontSize"><span class="fa-solid fa-bangladeshi-taka-sign"></span>
                                        <?= number_format($product['sales_price']) ?></p>
                                </div>

                                <a href="single-product.php?id=<?= $product['id'] ?>" class="viewDetailsBtns"
                                    style="color: white; background-color: #6d5ce8; text-decoration: none; padding: 9px 12px; border-radius: 5px;">View
                                    Details</a>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
        <!-- New Arrival Section end -->


        <!-- 50% Discount Section start  -->
        <div class="row">
            <div class="col-md-12">
                <h2 class="forSame-color text-center my-4  text-decoration-underline">Best Sellers Books</h2>

                <div class="row border border-1 border-danger-subtle rounded">



                </div>
            </div>
        </div>
        <!-- 50% Discount Section end -->


        <!-- Best Sellers Section start -->
        <div class="row">
            <div class="col-md-12">
                <h2 class="forSame-color text-center my-4  text-decoration-underline">Best Sellers</h2>

                <div class="row border border-1 border-dark-subtle rounded">



                </div>
            </div>
        </div>
        <!-- Best Sellers Section end -->

    </div>
</div>
<!-- hero section-2 end -->



<br>
<br>
<br>



<!-- new carousel section start-->
<div class="container">

    <div class="row my-5">
        <h1 class="text-center">New Arrival Products</h1>
        <p class="fw-light w-75 mx-auto text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam,
            aliquam?
            Magnam delectus adipisicing!</p>
    </div>



</div>
<!-- new carousel section end-->










<?php
require_once './components/footer.php';
?>