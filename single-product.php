<?php
require_once './components/header.php';


if (isset($_POST['addToCart'])) {
    $id = $_POST['id'] ?? null;

    if ($id != null) {
        // add product to cart
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        if (!isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] = 1;
        } else {
            $_SESSION['cart'][$id]++;
        }
        echo "<script>toastr.success('Product added to cart success!');
        setTimeout(() => {
            window.location = `shop.php` }, 2000);
        </script>";
    } else {
        echo "<script>toastr.error('Product add failed!');</script>";
    }
}




$id = $_GET['id'] ?? null;
if ($id == null) {
    header('location: index.php');
    exit();
}
$getProductQuery = "SELECT * FROM `products` WHERE `id` = $id";
$getProductResult = $conn->query($getProductQuery);
if ($getProductResult->num_rows == 0) {
    header('location: index.php');
    exit();
}
$product = $getProductResult->fetch_assoc();
?>


<div style="background-color: #d9ebeaec;">
    <div class="container" style="padding: 55px 0px;">
        <h2 class=" forSame-color text-center text-decoration-underline mb-4">Product Details</h2>

        <div class="row border border-1 border-dark-subtle rounded shadow bg-white align-items-center py-5 mx-0">

            <!-- image section -->
            <div class="col-lg-5 col-md-5 col-sm-12 text-center px-lg-0 px-md-0">
                <img src="./assets/img/products/<?= $product['images'] ?>" alt="<?= $product['name'] ?>"
                    class="card-img-top img-fluid object-fit-contain" style="height: 60%; width: 60%;">
                <p class=" d-lg-none d-md-none d-sm-block"></p>
            </div>


            <!-- products description section -->
            <div class="col-lg-7 col-md-7 col-sm-12 px-lg-0 px-md-0 ">
                <h2 class="text-white bg-dark p-2"> <?= $product['name'] ?></h2>


                <div class="d-flex gap-3 py-2">
                    <p class="h5">Price: <span
                            class="text-decoration-line-through text-muted small fa-solid fa-bangladeshi-taka-sign">
                            <?= number_format($product['regular_price']) ?></span>
                    </p>

                    <p class="h5"><span class="fa-solid fa-bangladeshi-taka-sign"></span>
                        <?= number_format($product['sales_price']) ?></p>
                </div>

                <!-- this is ready function (for product description), when build new website, just copy & paste this function -->
                <!-- <p class="productDescriptionP" style=" text-align: justify; max-width: 700px;">
                    <?= $product['description'] ?></p> -->

                <p class="productDescriptionP" style=" text-align: justify; max-width: 700px;">
                    <?= $product['description'] ?>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero
                    provident dolores repellat volu
                    officiis velit commodi distinctii debitis voluptates quia, asperiores fugit quis culpa laborum
                    natus. Est, praesentium provident dolores repellat voluptas repellendus minus!</p>


                <form action="" class=" d-inline-block" method="POST">

                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                    <button type="submit" class="btn btn-primary viewDetailsBtnsSingle1" name="addToCart">Add to
                        Cart</button>

                </form>


                <a href="shop.php" class="btn btn-warning text-white viewDetailsBtnsSingle2 "><i
                        class="fa-solid fa-arrow-left"></i> Back</a>
                <p class=" d-lg-none d-md-none d-sm-block"></p>

            </div>
        </div>
    </div>
</div>



<script>
// change title to product name
document.title = "<?= htmlspecialchars($product['name']) ?> | Imran_Store";
</script>




<?php
require_once './components/footer.php';
?>