<?php
$title = "Home | Imran_Store";
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

<!-- hero section end -->

<!-- hero section-1 bottom (hr) -->
<div>
    <div class="container heroSection-hr horizontalLine"></div>
</div>




<!-- hero section-2 start -->

<div class="container d-lg-flex d-md-flex justify-content-between px-lg-0 px-md-0 px-sm-1" id="featuresArrivalProduct">


    <!-- features product section start  -->
    <div class="row mt-5 col-lg-2 col-md-4 col-sm-12">
        <div class="">
            <h2 class="forSame-color text-center text-decoration-underline mb-4 featuresProducts-text"
                style="margin-top: 5px;">
                Features
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

                            <a href="single-product.php?id=<?= $product['id'] ?>"
                                class="viewDetailsBtns futuresProductsBTN"
                                style="color: white; background-color: #6d5ce8; text-decoration: none; border-radius: 5px;">View
                                Details</a>
                        </div>

                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
    <!-- features product section end  -->


    <!-- hr -->

    <div class="d-lg-none d-md-none d-sm-block horizontalLine">
    </div>


    <!-- inter section -->
    <div class="col-lg-10 col-md-8 col-sm-12 ">

        <!-- New Arrival Section start -->
        <section class="py-20 bg-white overflow-hidden ">
            <div class="container mt-3 p-0">
                <h2 class="forSame-color text-center text-decoration-underline mb-4">New Arrival </h2>

                <div class="row varticalLine">
                    <?php
                    // select random 5 products from the database
                    $featuresProductsQuery = "SELECT * FROM products ORDER BY RAND() LIMIT 8";

                    $featuresProductsResult = $conn->query($featuresProductsQuery);
                    while ($product = $featuresProductsResult->fetch_assoc()):
                    ?>
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
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
            <!-- button -->
            <div class="text-center mt-2 mb-3"><a class="viewDetailsBtns"
                    style="color: white; background-color: #6d5ce8; text-decoration: none; padding: 9px 12px; border-radius: 5px;"
                    href="index.php#featuresArrivalProduct">Click
                    to Show More</a>
            </div>
        </section>
        <!-- New Arrival Section end -->


        <!-- hr -->
        <div class="mt-4 mb-2 px-0">
            <div class="container horizontalLine">

            </div>
        </div>


        <!-- Best Sellers Books start -->
        <section class="py-10 bg-white overflow-hidden">
            <div class="container mt-4 p-0">
                <h2 class="forSame-color text-center mb-4 text-decoration-underline mt-5">Best Sellers Books</h2>
                <div class="row mb-24 varticalLine">
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">

                        <div class="p-6 bg-light rounded mb-0 border rounded-1">
                            <span
                                class="mt-1 ms-1 badge bg-transparent border border-2 border-info rounded-pill fw-bold text-info">NEW</span>
                            <a class="d-block px-6 mt-6 mb-2 link-dark text-decoration-none" href="#">
                                <img class="mb-3 mx-auto w-100 img-fluid border-bottom"
                                    style="height: 224px; object-fit: contain;"
                                    src="https://static.scientificamerican.com/sciam/cache/file/1DDFE633-2B85-468D-B28D05ADAE7D1AD8_source.jpg?w=1200"
                                    alt="Unread Books at Home Still Spark" />
                                <h5 class="mb-2 ps-3"
                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Unread Books
                                    at Home Still Spark</h5>
                                <p class="h6 text-info ps-3">$20.89</p>
                            </a>
                            <a class="ms-auto me-1 d-flex align-items-center justify-content-center border rounded-3 mb-1 mb-1"
                                href="#" style="width: 48px; height: 48px;">
                                <svg width="12" height="12" viewbox="0 0 12 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="5" width="2" height="12" fill="#161616"></rect>
                                    <rect x="12" y="5" width="2" height="12" transform="rotate(90 12 5)" fill="#161616">
                                    </rect>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                        <div class="p-6 bg-light rounded mb-0 border rounded-1">
                            <span
                                class="mt-1 ms-1 badge bg-transparent border border-2 border-danger rounded-pill fw-bold text-danger">-15%</span>
                            <a class="d-block px-6 mt-6 mb-2 link-dark text-decoration-none" href="#">
                                <img class="mb-3 mx-auto w-100 img-fluid border-bottom"
                                    style="height: 224px; object-fit: contain;"
                                    src="https://www.vervebranding.com/images/vbnpage/design/bookmagazinetop.png"
                                    alt="Hand drawn book cartoon isolated" />
                                <h5 class="mb-2 ps-3"
                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Hand drawn
                                    book cartoon isolated</h5>
                                <p class="h6 text-info ps-3">
                                    <span>$14.30</span>
                                    <span class="small text-muted fw-normal text-decoration-line-through">$15.90</span>
                                </p>
                            </a>
                            <a class="ms-auto me-1 d-flex align-items-center justify-content-center border rounded-3 mb-1 mb-1"
                                href="#" style="width: 48px; height: 48px;">
                                <svg width="12" height="12" viewbox="0 0 12 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="5" width="2" height="12" fill="#161616"></rect>
                                    <rect x="12" y="5" width="2" height="12" transform="rotate(90 12 5)" fill="#161616">
                                    </rect>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                        <div class="p-6 bg-light rounded mb-0 border rounded-1">
                            <span
                                class="mt-1 ms-1 badge bg-transparent border border-2 border-danger rounded-pill fw-bold text-danger">-15%</span>
                            <a class="d-block px-6 mt-6 mb-2 link-dark text-decoration-none" href="#">
                                <img class="mb-3 mx-auto w-100 img-fluid border-bottom"
                                    style="height: 224px; object-fit: contain;"
                                    src="https://images.ctfassets.net/ytoahuzom1kf/2x7mEb5X6yeLGdhsFvLL9W/c649654c6f92206d82293c31759c8d94/8.png"
                                    alt="Browse Discounted Books Online" />
                                <h5 class="mb-2 ps-3"
                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Browse
                                    Discounted Books Online</h5>
                                <p class="h6 text-info ps-3">
                                    <span>$34.89</span>
                                    <span class="small text-muted fw-normal text-decoration-line-through">$33.69</span>
                                </p>
                            </a>
                            <a class="ms-auto me-1 d-flex align-items-center justify-content-center border rounded-3 mb-1 mb-1"
                                href="#" style="width: 48px; height: 48px;">
                                <svg width="12" height="12" viewbox="0 0 12 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="5" width="2" height="12" fill="#161616"></rect>
                                    <rect x="12" y="5" width="2" height="12" transform="rotate(90 12 5)" fill="#161616">
                                    </rect>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                        <div class="p-6 bg-light rounded mb-0 border rounded-1">
                            <span
                                class="mt-1 ms-1 badge bg-transparent border border-2 border-info rounded-pill fw-bold text-info">New</span>
                            <a class="d-block px-6 mt-6 mb-2 link-dark text-decoration-none" href="#">
                                <img class="mb-3 mx-auto w-100 img-fluid border-bottom"
                                    style="height: 224px; object-fit: contain;"
                                    src="https://images.ctfassets.net/ytoahuzom1kf/2CmYcqUy6QPdF6AaZXbhcX/937bc3ac8076110db18301c86733a194/7.png"
                                    alt="Business magazine grow book" />
                                <h5 class="mb-2 ps-3"
                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Business
                                    magazine grow book</h5>
                                <p class="h6 text-info ps-3">
                                    <span>$199.90</span>
                                    <span class="small text-muted fw-normal text-decoration-line-through">$33.69</span>
                                </p>
                            </a>
                            <a class="ms-auto me-1 d-flex align-items-center justify-content-center border rounded-3 mb-1 mb-1"
                                href="#" style="width: 48px; height: 48px;">
                                <svg width="12" height="12" viewbox="0 0 12 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="5" width="2" height="12" fill="#161616"></rect>
                                    <rect x="12" y="5" width="2" height="12" transform="rotate(90 12 5)" fill="#161616">
                                    </rect>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                        <div class="p-6 bg-light rounded mb-0 border rounded-1">
                            <span
                                class="mt-1 ms-1 badge bg-transparent border border-2 border-info rounded-pill fw-bold text-info">New</span>
                            <a class="d-block px-6 mt-6 mb-2 link-dark text-decoration-none" href="#">
                                <img class="mb-3 mx-auto w-100 img-fluid border-bottom"
                                    style="height: 224px; object-fit: contain;"
                                    src="https://images-eu.ssl-images-amazon.com/images/I/81m+BhThxJL._AC_UL600_SR600,600_.jpg"
                                    alt="A Plague of Heretics: Amazon" />
                                <h5 class="mb-2 ps-3"
                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">A Plague of
                                    Heretics: Amazon</h5>
                                <p class="h6 text-info ps-3">
                                    <span>$89.90</span>
                                    <span class="small text-muted fw-normal text-decoration-line-through">$56.69</span>
                                </p>
                            </a>
                            <a class="ms-auto me-1 d-flex align-items-center justify-content-center border rounded-3 mb-1 mb-1"
                                href="#" style="width: 48px; height: 48px;">
                                <svg width="12" height="12" viewbox="0 0 12 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="5" width="2" height="12" fill="#161616"></rect>
                                    <rect x="12" y="5" width="2" height="12" transform="rotate(90 12 5)" fill="#161616">
                                    </rect>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                        <div class="p-6 bg-light rounded mb-0 border rounded-1">
                            <span
                                class="mt-1 ms-1 badge bg-transparent border border-2 border-info rounded-pill fw-bold text-info">New</span>
                            <a class="d-block px-6 mt-6 mb-2 link-dark text-decoration-none" href="#">
                                <img class="mb-3 mx-auto w-100 img-fluid border-bottom"
                                    style="height: 224px; object-fit: contain;"
                                    src="https://www.apartamentomagazine.com/wp-content/uploads/2025/05/Apartamento_magazine_issue_35_cover_mock_up_low.png"
                                    alt="Magazine Design Verve Branding" />
                                <h5 class="mb-2 ps-3"
                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Magazine
                                    Design Verve Branding</h5>
                                <p class="h6 text-info ps-3">
                                    <span>$2169.90</span>
                                    <span class="small text-muted fw-normal text-decoration-line-through">$33.69</span>
                                </p>
                            </a>
                            <a class="ms-auto me-1 d-flex align-items-center justify-content-center border rounded-3 mb-1 mb-1"
                                href="#" style="width: 48px; height: 48px;">
                                <svg width="12" height="12" viewbox="0 0 12 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="5" width="2" height="12" fill="#161616"></rect>
                                    <rect x="12" y="5" width="2" height="12" transform="rotate(90 12 5)" fill="#161616">
                                    </rect>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                        <div class="p-6 bg-light rounded mb-0 border rounded-1">
                            <span
                                class="mt-1 ms-1 badge bg-transparent border border-2 border-info rounded-pill fw-bold text-info">New</span>
                            <a class="d-block px-6 mt-6 mb-2 link-dark text-decoration-none" href="#">
                                <img class="mb-3 mx-auto w-100 img-fluid border-bottom"
                                    style="height: 224px; object-fit: contain;"
                                    src="https://booxworm.lk/cdn/shop/files/zero-to-one-notes-on-startups-or-how-to-build-the-future-by-peter-thielblake-masters-imperfect-booxworm-28669.png?v=1746647870&width=533"
                                    alt="Zero to One Convert" />
                                <h5 class=" mb-2 ps-3"
                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Zero to One
                                    Convert</h5>
                                <p class="h6 text-info ps-3">
                                    <span>$180.90</span>
                                    <span class="small text-muted fw-normal text-decoration-line-through">$33.69</span>
                                </p>
                            </a>
                            <a class="ms-auto me-1 d-flex align-items-center justify-content-center border rounded-3 mb-1 mb-1"
                                href="#" style="width: 48px; height: 48px;">
                                <svg width="12" height="12" viewbox="0 0 12 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="5" width="2" height="12" fill="#161616"></rect>
                                    <rect x="12" y="5" width="2" height="12" transform="rotate(90 12 5)" fill="#161616">
                                    </rect>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                        <div class="p-6 bg-light rounded mb-0 border rounded-1">
                            <span
                                class="mt-1 ms-1 badge bg-transparent border border-2 border-info rounded-pill fw-bold text-info">New</span>
                            <a class="d-block px-6 mt-6 mb-2 link-dark text-decoration-none" href="#">
                                <img class="mb-3 mx-auto w-100 img-fluid border-bottom"
                                    style="height: 224px; object-fit: contain;"
                                    src="https://booxworm.lk/cdn/shop/files/the-lean-startup-by-eric-rise-booxworm-36324.png?v=1746646570&width=533"
                                    alt="The Learn StartUp Books" />
                                <h5 class="mb-2 ps-3"
                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">The Learn
                                    StartUp Books</h5>
                                <p class="h6 text-info ps-3">
                                    <span>$89.90</span>
                                    <span class="small text-muted fw-normal text-decoration-line-through">$56.69</span>
                                </p>
                            </a>
                            <a class="ms-auto me-1 d-flex align-items-center justify-content-center border rounded-3 mb-1 mb-1"
                                href="#" style="width: 48px; height: 48px;">
                                <svg width="12" height="12" viewbox="0 0 12 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect x="5" width="2" height="12" fill="#161616"></rect>
                                    <rect x="12" y="5" width="2" height="12" transform="rotate(90 12 5)" fill="#161616">
                                    </rect>
                                </svg>
                            </a>
                        </div>
                    </div>

                </div>
                <!-- button -->
                <div class="text-center mt-2 mb-2"><a class="viewDetailsBtns"
                        style="color: white; background-color: #6d5ce8; text-decoration: none; padding: 9px 12px; border-radius: 5px;"
                        href="index.php#featuresArrivalProduct">Click
                        to Show More</a>
                </div>
            </div>
        </section>
        <!-- Best Sellers Books end -->


    </div>
</div>
<!-- hero section-2 end -->


<!-- hr -->
<div class="mt-4 mb-2 container px-0 newArrival-hr">
    <div class="horizontalLine"></div>
</div>



<!-- Discover Our Products start -->

<section class="py-20 bg-white overflow-hidden">
    <div class="container mt-3 px-lg-0 px-md-0 px-sm-1">
        <h2 class="forSame-color text-center mb-4 text-decoration-underline mt-5">Discover Our Products</h2>
        <div class="row mb-24">

            <div class="col-12 col-md-6 col-lg-3">
                <div class="p-6 bg-light rounded mb-4 border rounded">
                    <span
                        class="mt-1 ms-1 badge bg-transparent border border-2 border-info rounded-pill fw-bold text-info ">New</span>
                    <a class="d-block px-6 mt-6 mb-2 link-dark text-decoration-none" href="#">
                        <img class="mb-3 pb-3 mx-auto w-100 img-fluid"
                            style="height: 224px; object-fit: contain; border-bottom: 1px solid #dcdfe2;"
                            src="https://samirahan.com.bd/cdn/shop/files/20240624BRITAAluna2.4LWaterFilterJug-WhiteFrontSide_2048x2048px.png?v=1719235483&width=1946"
                            alt="BRILE water filter" />

                        <h5 class="mb-2 ps-3">BRILE water filter</h5>
                        <p class="h6 text-info ps-3">
                            <span>$24.30</span>
                            <span class="small text-muted fw-normal text-decoration-line-through">$15.90</span>
                        </p>
                    </a>
                    <a class="ms-auto me-1 d-flex align-items-center justify-content-center border rounded-3 mb-1 mb-1"
                        href="#" style="width: 48px; height: 48px;">
                        <svg width="12" height="12" viewbox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="5" width="2" height="12" fill="#161616"></rect>
                            <rect x="12" y="5" width="2" height="12" transform="rotate(90 12 5)" fill="#161616">
                            </rect>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="p-6 bg-light rounded mb-4 border rounded">
                    <span
                        class="mt-1 ms-1 badge bg-transparent border border-2 border-info rounded-pill fw-bold text-info ">New</span>
                    <a class="d-block px-6 mt-6 mb-2 link-dark text-decoration-none" href="#">
                        <img class="mb-3 pb-3 mx-auto w-100 img-fluid"
                            style="height: 224px; object-fit: contain; border-bottom: 1px solid #dcdfe2;"
                            src="https://imyw.eu/all/b15/el-speed-road-s20_zibmafabxc.jpg" alt="Bicycle S2023" />

                        <h5 class="mb-2 ps-3">Bicycle S2023</h5>
                        <p class="h6 text-info ps-3">
                            <span>$14.30</span>
                            <span class="small text-muted fw-normal text-decoration-line-through">$15.90</span>
                        </p>
                    </a>
                    <a class="ms-auto me-1 d-flex align-items-center justify-content-center border rounded-3 mb-1 mb-1"
                        href="#" style="width: 48px; height: 48px;">
                        <svg width="12" height="12" viewbox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="5" width="2" height="12" fill="#161616"></rect>
                            <rect x="12" y="5" width="2" height="12" transform="rotate(90 12 5)" fill="#161616">
                            </rect>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="p-6 bg-light rounded mb-4 border rounded">
                    <span
                        class="mt-1 ms-1 badge bg-transparent border border-2 border-info rounded-pill fw-bold text-info ">New</span>
                    <a class="d-block px-6 mt-6 mb-2 link-dark text-decoration-none" href="#">
                        <img class="mb-3 pb-3 mx-auto w-100 img-fluid"
                            style="height: 224px; object-fit: contain; border-bottom: 1px solid #dcdfe2;"
                            src="https://static.nike.com/a/images/t_default/2675a7d0-c9f3-4b36-a01a-01fb1e4d4b00/NK+ELT+CHAMP+8P+2.0.png"
                            alt="Nike basketball" />

                        <h5 class="mb-2 ps-3">Nike basketball</h5>
                        <p class="h6 text-info ps-3">
                            <span>$34.89</span>
                            <span class="small text-muted fw-normal text-decoration-line-through">$33.69</span>
                        </p>
                    </a>
                    <a class="ms-auto me-1 d-flex align-items-center justify-content-center border rounded-3 mb-1 mb-1"
                        href="#" style="width: 48px; height: 48px;">
                        <svg width="12" height="12" viewbox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="5" width="2" height="12" fill="#161616"></rect>
                            <rect x="12" y="5" width="2" height="12" transform="rotate(90 12 5)" fill="#161616">
                            </rect>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="p-6 bg-light rounded mb-4 border rounded">
                    <span
                        class="mt-1 ms-1 badge bg-transparent border border-2 border-info rounded-pill fw-bold text-info ">New</span>
                    <a class="d-block px-6 mt-6 mb-2 link-dark text-decoration-none" href="#">
                        <img class="mb-3 pb-3 mx-auto w-100 img-fluid"
                            style="height: 224px; object-fit: contain; border-bottom: 1px solid #dcdfe2;"
                            src="https://kitesource.ca/cdn/shop/files/2023_Duotone_Whip_SLS_Kite_Surfboard.webp?v=1686604241"
                            alt="Kiteboard WH" />

                        <h5 class="mb-2 ps-3">Kiteboard WH</h5>
                        <p class="h6 text-info ps-3">
                            <span>$199.90</span>
                            <span class="small text-muted fw-normal text-decoration-line-through">$33.69</span>
                        </p>
                    </a>
                    <a class="ms-auto me-1 d-flex align-items-center justify-content-center border rounded-3 mb-1 mb-1"
                        href="#" style="width: 48px; height: 48px;">
                        <svg width="12" height="12" viewbox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="5" width="2" height="12" fill="#161616"></rect>
                            <rect x="12" y="5" width="2" height="12" transform="rotate(90 12 5)" fill="#161616">
                            </rect>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="p-6 bg-light rounded mb-4 border rounded">
                    <span
                        class="mt-1 ms-1 badge bg-transparent border border-2 border-info rounded-pill fw-bold text-info ">New</span>
                    <a class="d-block px-6 mt-6 mb-2 link-dark text-decoration-none" href="#">
                        <img class="mb-3 pb-3 mx-auto w-100 img-fluid"
                            style="height: 224px; object-fit: contain; border-bottom: 1px solid #dcdfe2;"
                            src="https://images-na.ssl-images-amazon.com/images/I/515hyz24EwL._SL500_._AC_SL500_.jpg"
                            alt="Linc Pentonic Ballpoint Pens" />

                        <h5 class="mb-2 ps-3" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            Linc
                            Pentonic Ballpoint Pens</h5>
                        <p class="h6 text-info ps-3">
                            <span>$89.90</span>
                            <span class="small text-muted fw-normal text-decoration-line-through">$56.69</span>
                        </p>
                    </a>
                    <a class="ms-auto me-1 d-flex align-items-center justify-content-center border rounded-3 mb-1 mb-1"
                        href="#" style="width: 48px; height: 48px;">
                        <svg width="12" height="12" viewbox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="5" width="2" height="12" fill="#161616"></rect>
                            <rect x="12" y="5" width="2" height="12" transform="rotate(90 12 5)" fill="#161616">
                            </rect>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="p-6 bg-light rounded mb-4 border rounded">
                    <span
                        class="mt-1 ms-1 badge bg-transparent border border-2 border-info rounded-pill fw-bold text-info ">New</span>
                    <a class="d-block px-6 mt-6 mb-2 link-dark text-decoration-none" href="#">
                        <img class="mb-3 pb-3 mx-auto w-100 img-fluid"
                            style="height: 224px; object-fit: contain; border-bottom: 1px solid #dcdfe2;"
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSwyJD2G0tFTiNr3rAdqKnwz9YExWTuBET4VQ&s"
                            alt="Buy Fan and Air cooler" />

                        <h5 class="mb-2 ps-3">Buy Fan and Air cooler</h5>
                        <p class="h6 text-info ps-3">
                            <span>$199.90</span>
                            <span class="small text-muted fw-normal text-decoration-line-through">$33.69</span>
                        </p>
                    </a>
                    <a class="ms-auto me-1 d-flex align-items-center justify-content-center border rounded-3 mb-1 mb-1"
                        href="#" style="width: 48px; height: 48px;">
                        <svg width="12" height="12" viewbox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="5" width="2" height="12" fill="#161616"></rect>
                            <rect x="12" y="5" width="2" height="12" transform="rotate(90 12 5)" fill="#161616">
                            </rect>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="p-6 bg-light rounded mb-4 border rounded">
                    <span
                        class="mt-1 ms-1 badge bg-transparent border border-2 border-info rounded-pill fw-bold text-info ">New</span>
                    <a class="d-block px-6 mt-6 mb-2 link-dark text-decoration-none" href="#">
                        <img class="mb-3 pb-3 mx-auto w-100 img-fluid"
                            style="height: 224px; object-fit: contain; border-bottom: 1px solid #dcdfe2;"
                            src="https://blog.bikroy.com/en/wp-content/uploads/2020/01/Honda-CB-Hornet-160R-ABS.jpg"
                            alt="Honda CB Hornet 160R ABS" />

                        <h5 class="mb-2 ps-3" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            Honda CB
                            Hornet 160R ABS</h5>
                        <p class="h6 text-info ps-3">
                            <span>$2169.90</span>
                            <span class="small text-muted fw-normal text-decoration-line-through">$33.69</span>
                        </p>
                    </a>
                    <a class="ms-auto me-1 d-flex align-items-center justify-content-center border rounded-3 mb-1 mb-1"
                        href="#" style="width: 48px; height: 48px;">
                        <svg width="12" height="12" viewbox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="5" width="2" height="12" fill="#161616"></rect>
                            <rect x="12" y="5" width="2" height="12" transform="rotate(90 12 5)" fill="#161616">
                            </rect>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="p-6 bg-light rounded mb-4 border rounded">
                    <span
                        class="mt-1 ms-1 badge bg-transparent border border-2 border-info rounded-pill fw-bold text-info ">New</span>
                    <a class="d-block px-6 mt-6 mb-2 link-dark text-decoration-none" href="#">
                        <img class="mb-3 pb-3 mx-auto w-100 img-fluid"
                            style="height: 224px; object-fit: contain; border-bottom: 1px solid #dcdfe2;"
                            src="https://cdn.waltonplaza.com.bd/96c49fd4-ed87-4669-a9fe-5785670088c4.jpeg"
                            alt="Walton Ceiling Fan 56" />

                        <h5 class=" mb-2 ps-3">Walton Ceiling Fan 56"</h5>
                        <p class="h6 text-info ps-3">
                            <span>$180.90</span>
                            <span class="small text-muted fw-normal text-decoration-line-through">$33.69</span>
                        </p>
                    </a>
                    <a class="ms-auto me-1 d-flex align-items-center justify-content-center border rounded-3 mb-1 mb-1"
                        href="#" style="width: 48px; height: 48px;">
                        <svg width="12" height="12" viewbox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="5" width="2" height="12" fill="#161616"></rect>
                            <rect x="12" y="5" width="2" height="12" transform="rotate(90 12 5)" fill="#161616">
                            </rect>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="p-6 bg-light rounded mb-4 border rounded">
                    <span
                        class="mt-1 ms-1 badge bg-transparent border border-2 border-info rounded-pill fw-bold text-info ">New</span>
                    <a class="d-block px-6 mt-6 mb-2 link-dark text-decoration-none" href="#">
                        <img class="mb-3 pb-3 mx-auto w-100 img-fluid"
                            style="height: 224px; object-fit: contain; border-bottom: 1px solid #dcdfe2;"
                            src="https://www.banglashoppers.com/media/catalog/product/cache/8bc8dbfc4b72ea17ed88290a8a7bf2b3/r/e/realman_scent_for_men_pure_aqua_100ml.jpg"
                            alt="Realman Scent For Men Pure Aqua" />

                        <h5 class="mb-2 ps-3" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            Realman Scent For Men Pure Aqua</h5>
                        <p class="h6 text-info ps-3">
                            <span>$89.90</span>
                            <span class="small text-muted fw-normal text-decoration-line-through">$56.69</span>
                        </p>
                    </a>
                    <a class="ms-auto me-1 d-flex align-items-center justify-content-center border rounded-3 mb-1 mb-1"
                        href="#" style="width: 48px; height: 48px;">
                        <svg width="12" height="12" viewbox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="5" width="2" height="12" fill="#161616"></rect>
                            <rect x="12" y="5" width="2" height="12" transform="rotate(90 12 5)" fill="#161616">
                            </rect>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="p-6 bg-light rounded mb-4 border rounded">
                    <span
                        class="mt-1 ms-1 badge bg-transparent border border-2 border-info rounded-pill fw-bold text-info ">New</span>
                    <a class="d-block px-6 mt-6 mb-2 link-dark text-decoration-none" href="#">
                        <img class="mb-3 pb-3 mx-auto w-100 img-fluid"
                            style="height: 224px; object-fit: contain; border-bottom: 1px solid #dcdfe2;"
                            src="https://images-cdn.ubuy.co.in/642aa45523af200eea0b32f7-men-039-s-watches-waterproof-luminous.jpg"
                            alt="Men's Watches Waterproof Luminous" />

                        <h5 class="mb-2 ps-3" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            Men's Watches Waterproof Luminous</h5>
                        <p class="h6 text-info ps-3">
                            <span>$89.90</span>
                            <span class="small text-muted fw-normal text-decoration-line-through">$56.69</span>
                        </p>
                    </a>
                    <a class="ms-auto me-1 d-flex align-items-center justify-content-center border rounded-3 mb-1 mb-1"
                        href="#" style="width: 48px; height: 48px;">
                        <svg width="12" height="12" viewbox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="5" width="2" height="12" fill="#161616"></rect>
                            <rect x="12" y="5" width="2" height="12" transform="rotate(90 12 5)" fill="#161616">
                            </rect>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="p-6 bg-light rounded mb-4 border rounded">
                    <span
                        class="mt-1 ms-1 badge bg-transparent border border-2 border-info rounded-pill fw-bold text-info ">New</span>
                    <a class="d-block px-6 mt-6 mb-2 link-dark text-decoration-none" href="#">
                        <img class="mb-3 pb-3 mx-auto w-100 img-fluid"
                            style="height: 224px; object-fit: contain; border-bottom: 1px solid #dcdfe2;"
                            src="https://thecreationlamis.com/cdn/shop/files/Men_Fragrance_Square_Block_1500x.jpg?v=1686946757"
                            alt="The Creation Lamis" />

                        <h5 class="mb-2 ps-3" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            The Creation Lamis</h5>
                        <p class="h6 text-info ps-3">
                            <span>$89.90</span>
                            <span class="small text-muted fw-normal text-decoration-line-through">$56.69</span>
                        </p>
                    </a>
                    <a class="ms-auto me-1 d-flex align-items-center justify-content-center border rounded-3 mb-1 mb-1"
                        href="#" style="width: 48px; height: 48px;">
                        <svg width="12" height="12" viewbox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="5" width="2" height="12" fill="#161616"></rect>
                            <rect x="12" y="5" width="2" height="12" transform="rotate(90 12 5)" fill="#161616">
                            </rect>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="p-6 bg-light rounded mb-4 border rounded">
                    <span
                        class="mt-1 ms-1 badge bg-transparent border border-2 border-info rounded-pill fw-bold text-info ">New</span>
                    <a class="d-block px-6 mt-6 mb-2 link-dark text-decoration-none" href="#">
                        <img class="mb-3 mx-auto w-100 img-fluid"
                            style="height: 224px; object-fit: contain; border-bottom: 1px solid #dcdfe2;"
                            src="https://asia-exstatic-vivofs.vivo.com/PSee2l50xoirPK7y/product/1726129797130/zip/img/webp/section13-pic1-mb.jpg.webp"
                            alt="vivo Watch 3 | vivo Global" />


                        <h5 class="mb-2 ps-3" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            vivo Watch 3 | vivo Globals</h5>
                        <p class="h6 text-info ps-3">
                            <span>$89.90</span>
                            <span class="small text-muted fw-normal text-decoration-line-through">$56.69</span>
                        </p>
                    </a>
                    <a class="ms-auto me-1 d-flex align-items-center justify-content-center border rounded-3 mb-1 mb-1"
                        href="#" style="width: 48px; height: 48px;">
                        <svg width="12" height="12" viewbox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="5" width="2" height="12" fill="#161616"></rect>
                            <rect x="12" y="5" width="2" height="12" transform="rotate(90 12 5)" fill="#161616">
                            </rect>
                        </svg>
                    </a>
                </div>
            </div>


        </div>
        <!-- button -->
        <div class="text-center mt-0 mb-4"><a class="viewDetailsBtns"
                style="color: white; background-color: #6d5ce8; text-decoration: none; padding: 9px 12px; border-radius: 5px;"
                href="index.php#featuresArrivalProduct">Click
                to Show More</a>
        </div>
    </div>
</section>
<!-- Discover Our Products end -->







<?php
require_once './components/footer.php';
?>