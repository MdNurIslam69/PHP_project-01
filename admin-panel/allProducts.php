<?php
require_once('header.php');
require_once('sidebar.php');

$sql = "SELECT * FROM `products`";
$result = $conn->query($sql);

?>


<!-- Right Panel -->

<div id="right-panel" class="right-panel">

    <?php
    require_once('topBar.php');
    ?>

    <!-- internal css -->
    <style>
    .custom-table td {
        border: 1px solid grey !important;
    }

    .custom-table {
        border: 2px solid black !important;
    }

    .tableHearder th {
        color: white !important;
        text-align: center !important;

    }
    </style>



    <div class="breadcrumbs">
        <div class="col-12">
            <div class="page-header ">
                <div class="page-title align-middle">
                    <h1>All Products</h1>



                    <?php if (!isset($_GET['eid']) && !isset($_GET['did'])) { ?>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered custom-table" id="productList">
                            <thead>
                                <tr class="bg-info tableHearder">
                                    <th class="align-middle custom-table">Serial ID</th>
                                    <th class="align-middle custom-table">Database Id</th>
                                    <th class="align-middle custom-table">Product Name</th>
                                    <th class="align-middle custom-table">Regular Price</th>
                                    <th class="align-middle custom-table">Sale Price</th>
                                    <th class="align-middle custom-table">Category</th>
                                    <th class="align-middle custom-table">Image</th>
                                    <th class="align-middle custom-table">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $serial = 1;
                                    while ($product = $result->fetch_assoc()): ?>
                                <tr>
                                    <td class="align-middle text-center"><?= $serial++ ?></td>
                                    <td class="align-middle text-center"><?= $product['id'] ?></td>
                                    <td class="align-middle "><?= $product['name'] ?></td>
                                    <td class="align-middle text-center"><?= $product['regular_price'] ?></td>
                                    <td class="align-middle text-center"><?= $product['sales_price'] ?></td>
                                    <td class="align-middle text-center"><?= $product['category_id'] ?></td>
                                    <td class="align-middle text-center">
                                        <img src="../assets/img/products/<?= $product['images'] ?>"
                                            alt="<?= $product['name'] ?>" width="100">
                                    </td>
                                    <td class="align-middle">
                                        <a href="allProducts.php?eid=<?= $product['id'] ?>"
                                            class="btn btn-primary d-block mb-1">Edit</a>
                                        <a href="allProducts.php?did=<?= $product['id'] ?>"
                                            class="btn btn-danger d-block mt-1">Delete</a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php } ?>


                    <!-- edit section -->
                    <!-- .. -->
                    <!-- .. -->
                    <!-- .. -->
                    <?php
                    if (isset($_GET['eid'])) {
                        $id = $_GET['eid'];
                        $getProductQuery = "SELECT * FROM `products` WHERE `id` = $id";
                        $getProductResult = $conn->query($getProductQuery);
                        $product = $getProductResult->fetch_assoc();


                        if (isset($_POST['updateProduct'])) {
                            // Sanitize user input
                            $name = mysqli_real_escape_string($conn, $_POST['name']);
                            $regular_price = mysqli_real_escape_string($conn, $_POST['regular_price']);
                            $sales_price = mysqli_real_escape_string($conn, $_POST['sales_price']);
                            $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);

                            // Validation
                            if (empty($name)) {
                                $errName = "Please update product name";
                            }
                            if (empty($regular_price)) {
                                $errRegular_price = "Please update regular price";
                            }
                            if (empty($sales_price)) {
                                $errSales_price = "Please update sale price";
                            }
                            if (empty($category_id)) {
                                $errCategory_id = "Please update category";
                            }

                            // Only continue if no validation errors
                            if (!isset($errName) && !isset($errRegular_price) && !isset($errSales_price) && !isset($errCategory_id)) {
                                // If image is uploaded
                                if (!empty($_FILES['images']['name'])) {
                                    $image = basename($_FILES['images']['name']);
                                    $target_dir = "../assets/img/products/";
                                    $target_file = $target_dir . $image;

                                    if (move_uploaded_file($_FILES["images"]["tmp_name"], $target_file)) {
                                        // File moved successfully
                                    } else {
                                        echo "<script>toastr.error('Image upload failed');</script>";
                                    }
                                } else {
                                    // No image uploaded, keep the current one
                                    $image = $product['images'];
                                }

                                // Safe SQL update
                                $updateProductQuery = "UPDATE `products` 
                                    SET `name`='$name', 
                                        `regular_price`='$regular_price', 
                                        `sales_price`='$sales_price', 
                                        `category_id`='$category_id', 
                                        `images`='$image' 
                                    WHERE `id`='$id'";

                                if ($conn->query($updateProductQuery)) {
                                    echo "<script>toastr.success('Product updated successfully');
                                        setTimeout(() => {
                                            window.location.href = 'allProducts.php';
                                        }, 2000);
                                    </script>";
                                } else {
                                    echo "<script>toastr.error('Product update failed');</script>";
                                }
                            }
                        }

                    ?>

                    <!-- product form -->
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-9 col-sm-11 p-3">

                            <h1 class=" text-center"
                                style="font-size: 40px; text-decoration: underline; margin-top: -40px;">Edit
                                Product
                            </h1>

                            <form action="" method="post" enctype="multipart/form-data"
                                class="border p-4 border-primary rounded">
                                <div class="mb-3">
                                    <input type="text" placeholder="Write New Product Name" class="form-control 
                            <?= isset($errName) ? "is-invalid" : null ?>" name="name"
                                        value="<?= $name ?? $product['name'] ?? null ?>">

                                    <div class="invalid-feedback">
                                        <?= isset($errName) ? $errName : null ?>
                                    </div>
                                </div>

                                <!-- regular price -->
                                <div class="mb-3">
                                    <input type="text" placeholder="Write New Regular Price" class="form-control 
                            <?= isset($errRegular_price) ? "is-invalid" : null ?>" name="regular_price"
                                        value="<?= $regular_price ?? $product['regular_price'] ?? null ?>">

                                    <div class="invalid-feedback">
                                        <?= isset($errRegular_price) ? $errRegular_price : null ?>
                                    </div>
                                </div>

                                <!-- sales price -->
                                <div class="mb-3">
                                    <input type="text" placeholder="Write New Sales Price" class="form-control 
                            <?= isset($errSales_price) ? "is-invalid" : null ?>" name="sales_price"
                                        value="<?= $sales_price ?? $product['sales_price'] ?? null ?>">

                                    <div class="invalid-feedback">
                                        <?= isset($errSales_price) ? $errSales_price : null ?>
                                    </div>
                                </div>


                                <!-- images section -->
                                <div class="mb-3 text-center">
                                    <label for="image" class="text-center" style="cursor: pointer;">
                                        <img src="../assets/img/products/<?= $product['images'] ?>"
                                            alt="<?= $product['name'] ?>" width="100">
                                        <p>Current Image <br><small class="text-muted">Click to change image</small>
                                        </p>
                                        <input type="file" class="d-none <?= isset($errImage) ? "is-invalid" : null ?>"
                                            name="images" id="image">
                                        <div class="invalid-feedback">
                                            <?= isset($errImage) ? $errImage : null ?>
                                        </div>
                                    </label>
                                </div>


                                <!-- category id section-->
                                <div class="mb-3">
                                    <select name="category_id" class="form-control 
                            <?= isset($errCategory_id) ? "is-invalid" : null ?>">
                                        <option value="">Select Category</option>
                                        <?php
                                            $getCategoryResult = $conn->query("SELECT * FROM `products_category`");
                                            while ($category = $getCategoryResult->fetch_assoc()) {
                                            ?>

                                        <option value="<?= $category['id'] ?>"
                                            <?= (isset($category_id) && $category_id == $category['id']) || (!isset($category_id) && $product['category_id'] == $category['id']) ? 'selected' : null ?>>
                                            <?= $category['name'] ?>
                                        </option>


                                        <?php } ?>

                                    </select>

                                    <div class="invalid-feedback">
                                        <?= isset($errCategory_id) ? $errCategory_id : null ?>
                                    </div>
                                </div>


                                <!-- submit button -->
                                <button type="submit" name="updateProduct" class="btn btn-primary">Update
                                    Product</button>
                                <a href="allProducts.php" class="btn btn-danger"><i class="fa-solid fa-arrow-left"></i>
                                    Cancel</a>

                            </form>

                        </div>
                    </div>
                    <?php } ?>


                    <!-- delete product section -->
                    <!-- .. -->
                    <!-- .. -->

                    <?php if (isset($_GET['did'])) { ?>
                    <?php
                        $id = $_GET['did'];
                        $getProductQuery = "SELECT * FROM `products` WHERE `id` = $id";
                        $getProductResult = $conn->query($getProductQuery);
                        $product = $getProductResult->fetch_assoc();
                        ?>


                    <!-- it's for delete product popup -->
                    <div class="container">
                        <div
                            style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); display: flex; align-items: center; justify-content: center; z-index: 9999;">
                            <div
                                style="background: #fff; max-width: 400px; width: 90%; padding: 1.5rem; border-radius: 10px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); text-align: center;">

                                <h3 style="margin-bottom: 3rem; font-size: 1.25rem; color: purple;">Are you sure ? do
                                    you want to delete this product?</h3>

                                <form action="" method="post"
                                    style="display: flex; align-items: center; justify-content: center; gap: 3rem;">

                                    <input type="hidden" name="deleteId"
                                        value="<?= isset($product['id']) ? $product['id'] : null ?>">


                                    <button type="submit" name="deleteProduct"
                                        style="background: #e74c3c; color: #fff; border: none; padding: 0.5rem 1.2rem; border-radius: 6px; cursor: pointer;  font-weight: bold;">Yes</button>

                                    <a href="allProducts.php"
                                        style="background: #3498db; color: #fff; border: none; padding: 0.5rem 1.2rem; border-radius: 6px; cursor: pointer; font-weight: bold;">No</a>

                                </form>
                            </div>
                        </div>
                    </div>


                    <?php
                        if (isset($_POST['deleteProduct'])) {
                            $deleteId = $_POST['deleteId'];
                            $deleteProductQuery = "DELETE FROM `products` WHERE `id` = $deleteId";
                            if ($conn->query($deleteProductQuery)) {
                                echo "<script>toastr.success('Product deleted successfully');setTimeout(() => {window.location.href = 'allProducts.php';}, 2000);</script>";
                            } else {
                                echo "<script>toastr.error('Product deletion failed');</script>";
                            }
                        }
                        ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Right Panel -->

<script>
$(document).ready(function() {
    $('#productList').DataTable({
        responsive: true,
        order: [
            [0, "desc"]
        ],
        lengthMenu: [5, 10, 25, 30, 50, 80, 100],
        pageLength: 5
    });

});
</script>



<?php
require_once('footer.php');
?>