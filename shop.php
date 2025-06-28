<?php
$title = "Shop | Imran_Store";
require_once './components/header.php';

// Fetch category with product count
$categoriesQuery = "
    SELECT c.id, c.name, COUNT(p.id) AS total_products
    FROM products_category c
    LEFT JOIN products p ON c.id = p.category_id
    GROUP BY c.id, c.name
";
$categoriesResult = $conn->query($categoriesQuery);

// select all from products
$productsQuery = "SELECT 
    products.id AS product_id,
    products.name AS product_name,
    products.images,
    products.sales_price,
    products_category.name AS category_name 
FROM 
    products 
INNER JOIN 
    products_category ON products.category_id = products_category.id 
ORDER BY RAND()";

$productsResult = $conn->query($productsQuery);
?>


<!-- shop (main-section) start -->

<div class="container mt-4">
    <div class="row">

        <!-- product category list section start -->
        <div class="col-md-2" id="category-list">
            <div class="list-group">
                <h4 class="text-primary mb-3 text-center text-decoration-underline">Categories</h4>

                <?php while ($category = $categoriesResult->fetch_assoc()): ?>
                    <a href="category.php?id=<?= $category['id'] ?>"
                        class="list-group-item list-group-item-action d-flex justify-content-between align-items-center <?= isset($_GET['id']) && $_GET['id'] == $category['id'] ? 'active' : '' ?>">
                        <?= htmlspecialchars($category['name']) ?>
                        <span class="badge text-muted p-0">(<?= $category['total_products'] ?>)</span>
                    </a>
                <?php endwhile; ?>

            </div>
        </div>
        <!-- product category list section end -->



        <div class="col-md-10">

            <h1 class="text-primary mb-3 text-center text-decoration-underline">All Products</h1>

            <div class="row">

                <?php while ($product = $productsResult->fetch_assoc()): ?>
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                        <div class="card h-100">
                            <img src="./assets/img/products/<?= $product['images'] ?>"
                                alt="<?= htmlspecialchars($product['product_name']) ?>"
                                class="card-img-top img-thumbnail p-2"
                                style="height: 200px; object-fit: contain; border-bottom-left-radius:0; border-bottom-right-radius:0;">

                            <div class="card-body">
                                <h5 class="card-title text-truncate"
                                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    <?= htmlspecialchars($product['product_name']) ?>
                                </h5>

                                <p class="card-text">Category: <?= htmlspecialchars($product['category_name']) ?></p>

                                <p class="card-text">Price: $<?= number_format($product['sales_price']) ?></p>
                                <a href="single-product.php?id=<?= $product['product_id'] ?>" class="btn btn-primary">View
                                    Details</a>

                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>


            </div>
        </div>




    </div>
</div>
<!-- shop (main-section) end -->


<section>
    <div class="container px-lg-0 px-md-0">
        <br>
        <hr>
    </div>
</section>



<!-- Discover Our Products start -->

<section class="py-20 bg-white overflow-hidden">
    <div class="container mt-3 px-lg-0 px-md-0 px-sm-1">
        <h2 class="forSame-color text-center mb-4 text-decoration-underline mt-4">Discover Our Products</h2>
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
        <div class="text-center mt-0 mb-3"><a class="viewDetailsBtns"
                style="color: white; background-color: #6d5ce8; text-decoration: none; padding: 9px 12px; border-radius: 5px;"
                href="./#featuresArrivalProduct">Click
                to Show More</a>
        </div>
    </div>
</section>
<!-- Discover Our Products end -->


<section>
    <div class="container px-lg-0 px-md-0">
        <br>
        <hr>
    </div>
</section>


<section class="mt-4">
    <div class="container px-lg-0 px-md-0">
        <!-- New Arrival Section start -->
        <div class="row mb-4">
            <div class="col-md-12 ">
                <h2 class="forSame-color text-center text-decoration-underline mb-4">Our Best Sellers Item's</h2>

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
            <!-- button -->
            <div class="text-center mt-0 mb-2"><a class="viewDetailsBtns"
                    style="color: white; background-color: #6d5ce8; text-decoration: none; padding: 9px 12px; border-radius: 5px;"
                    href="./#featuresArrivalProduct">Click
                    to Show More</a>
            </div>
        </div>
        <!-- New Arrival Section end -->
    </div>

</section>




<!-- popUp/Modal section start -->

<!-- this internal css for popUp/modal -->
<style>
    .popUp-img {
        width: 100%;
        max-height: 400px;
    }


    .offer-content {
        background-color: rgb(209, 248, 250);
    }

    .offer-content h1 {
        font-family: "Agu Display", serif;
        font-size: 3rem;
        margin: 20px;
        text-align: end;
        padding-top: 7px;

    }

    .offer-content h3 {
        font-size: 1.5rem;
        text-decoration: underline;
        text-align: start;
        transform: rotate(-20deg);
        margin: 0px;
        margin-top: -30px;
        margin-left: -3px;
    }


    /* responsive title */
    @media screen and (max-width: 500px) {
        .offer-content h3 {
            font-size: 1.4rem;
        }

        .offer-content h1 {
            font-size: 2.9rem;
        }
    }

    @media screen and (max-width: 480px) {
        .offer-content h3 {
            font-size: 1.3rem;
        }

        .offer-content h1 {
            font-size: 2.6rem;
        }

    }

    @media screen and (max-width: 440px) {
        .offer-content h3 {
            font-size: 1.2rem;
            margin-top: -26px;
            margin-left: -3px;
        }

        .offer-content h1 {
            font-size: 2.4rem;
        }

    }

    @media screen and (max-width: 410px) {
        .offer-content h3 {
            font-size: 1rem;
            margin-top: -25px;
            margin-left: -3px;
        }

        .offer-content h1 {
            font-size: 2rem;
            padding-top: 10px;
        }

    }

    @media screen and (max-width: 392px) {
        .offer-content h3 {
            font-size: 0.9rem;
            margin-top: -25px;
            margin-left: -3px;
        }

        .offer-content h1 {
            font-size: 2rem;
            padding-top: 10px;
        }

    }

    @media screen and (max-width: 365px) {
        .offer-content h3 {
            font-size: 0.9rem;
            margin-top: -20px;
            margin-left: -3px;
        }

        .offer-content h1 {
            font-size: 2rem;
            padding-top: 10px;
        }

    }
</style>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <!-- Centered -->
        <div class="modal-content border-2 border-danger">
            <div class="modal-header align-content-center p-2">
                <img src="assets/img/myIcon.png" alt="shop icon" class="img-fluid" style="max-width: 15%;">

                <button type="button" class="btn-close pt-0 h3 text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <div class="modal-body p-0 ">
                <img src="assets/img/popUp.jpg" alt="popUp img" class="popUp-img">
            </div>

            <div class="offer-content">
                <h3>USE COUPON</h3>
                <h1>SUMMER1500</h1>
            </div>

            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="./#bestSellersBooks" type="button" id="save-changes" class="btn btn-primary">Save
                    changes</a>
            </div>
        </div>
    </div>
</div>

<!-- Auto show modal after 3 seconds -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
            myModal.show();
        }, 3000);
    });
</script>

<!-- popUp/Modal section end -->






<?php
require_once './components/footer.php';
?>