<?php
$title = "Add New Product | Imran_Store";
require_once('header.php');
require_once('sidebar.php');

if (isset($_POST['addProduct'])) {
    $hasError = false; // ✅ Initialize the error flag

    $name = sanitize($_POST['name']);
    $regular_price = sanitize($_POST['regular_price']);
    $sale_price = sanitize($_POST['sales_price']);
    $category_id = sanitize($_POST['category_id']);
    $description = sanitize($_POST['description']);


    $image = $_FILES['images'];
    $imageName = $image['name'];
    $imageTmpName = $image['tmp_name'];
    $imageSize = $image['size'];
    $imageError = $image['error'];
    $imageType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $uploadDir = '../assets/img/products/';
    $uploadFileName = uniqid('', true) . '.' . $imageType;
    $uploadFilePath = $uploadDir . $uploadFileName;

    // name section
    if (empty($name)) {
        $errName = "Please enter a product name";
        $hasError = true;
    } else {
        $crrName = $conn->real_escape_string($name);
    }

    // regular price section
    if (empty($regular_price)) {
        $errRegular_price = "Please enter a regular price";
        $hasError = true;
    } else {
        $crrRegular_price = $conn->real_escape_string($regular_price);
    }

    // sale price section
    if (empty($sale_price)) {
        $errSales_price = "Please enter a sale price";
        $hasError = true;
    } else {
        $crrSales_price = $conn->real_escape_string($sale_price);
    }

    // category ID section
    if (empty($category_id)) {
        $errCategory_id = "Please select a category";
        $hasError = true;
    } else {
        $crrCategory_id = $conn->real_escape_string($category_id);
    }

    // description section
    if (empty($description)) {
        $errDescription = "Please enter a description";
        $hasError = true;
    } else {
        $crrDescription = $conn->real_escape_string($description);
    }


    // image section
    if (empty($imageName)) {
        $errImage = "Please upload an image";
        $hasError = true;
    }

    // ✅ Proceed only if no validation errors
    if (!$hasError) {
        // image validation
        if (empty($imageName)) {
            $errImage = "Please upload an image";
        } elseif (!in_array($imageType, $allowedTypes)) {
            $errImage = "Invalid image type. Only jpeg, png, jpg, gif, webp allowed";
        } elseif ($imageError !== 0) {
            $errImage = "Error uploading the image";
        } elseif ($imageSize > 2000000) {
            $errImage = "File size should be less than 2MB";
        } else {
            $crrImage = $conn->real_escape_string($uploadFileName);

            if (move_uploaded_file($imageTmpName, $uploadFilePath)) {
                // Insert the product into the database
                $sql = "INSERT INTO `products`(`name`, `regular_price`, `sales_price`, `images`, `category_id`, `description`) 
                        VALUES('$crrName', '$crrRegular_price', '$crrSales_price', '$crrImage', '$crrCategory_id', '$crrDescription')";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>toastr.success('Product added successfully');
                    setTimeout(() => {
                        window.location.href = 'addNewProduct.php';
                    }, 2000);
                    </script>";
                } else {
                    echo "<script>toastr.error('Product add failed');</script>";
                }
            } else {
                $errImage = "Error uploading the image";
            }
        }
    }
}
?>

<!-- Right Panel -->
<div id="right-panel" class="right-panel">
    <?php require_once('topBar.php'); ?>

    <div class="breadcrumbs">
        <div class="col-12 justify-content-center d-flex">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1 class=" mb-4 mt-4 text-primary text-center"
                        style="text-decoration: underline; font-size: 40px;">Add New Product</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center d-flex">
            <div class="col-md-6">

                <form action="" method="post" enctype="multipart/form-data" class="mt-3">
                    <!-- Name section -->
                    <div class="mb-3">
                        <input type="text" placeholder="Product Name"
                            class="form-control <?= isset($errName) ? 'is-invalid' : null ?>" name="name"
                            value="<?= isset($name) ? $name : null ?>">
                        <div class="invalid-feedback">
                            <?= isset($errName) ? $errName : null ?>
                        </div>
                    </div>

                    <!-- Regular price section -->
                    <div class="mb-3">
                        <input type="text" placeholder="Regular Price"
                            class="form-control <?= isset($errRegular_price) ? 'is-invalid' : null ?>"
                            name="regular_price" value="<?= isset($regular_price) ? $regular_price : null ?>">
                        <div class="invalid-feedback">
                            <?= isset($errRegular_price) ? $errRegular_price : null ?>
                        </div>
                    </div>

                    <!-- Sale price section -->
                    <div class="mb-3">
                        <input type="text" placeholder="Sale Price"
                            class="form-control <?= isset($errSales_price) ? 'is-invalid' : null ?>" name="sales_price"
                            value="<?= isset($sale_price) ? $sale_price : null ?>">
                        <div class="invalid-feedback">
                            <?= isset($errSales_price) ? $errSales_price : null ?>
                        </div>
                    </div>

                    <!-- Image upload -->
                    <div class="mb-3">
                        <input type="file" placeholder="Product Image"
                            class="form-control <?= isset($errImage) ? 'is-invalid' : null ?>" name="images"
                            style="padding-top: 0.20rem;">
                        <div class="invalid-feedback">
                            <?= isset($errImage) ? $errImage : null ?>
                        </div>
                    </div>

                    <!-- Category selection -->
                    <div class="mb-3">
                        <select name="category_id"
                            class="form-control <?= isset($errCategory_id) ? 'is-invalid' : null ?>">
                            <option value="">Select Category</option>
                            <?php
                            $getCategoryResult = $conn->query("SELECT * FROM `products_category`");
                            while ($category = $getCategoryResult->fetch_assoc()) {
                            ?>
                            <option value="<?= $category['id'] ?>"
                                <?= isset($category_id) && $category_id == $category['id'] ? 'selected' : null ?>>
                                <?= $category['name'] ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= isset($errCategory_id) ? $errCategory_id : null ?>
                        </div>
                    </div>


                    <!-- description section -->
                    <div class="mb-3">
                        <textarea name="description" placeholder="Product Description" rows="3"
                            class="form-control <?= isset($errDescription) ? 'is-invalid' : null ?>"><?= isset($description) ? htmlspecialchars($description) : null ?></textarea>
                        <div class="invalid-feedback">
                            <?= isset($errDescription) ? $errDescription : null ?>
                        </div>
                    </div>


                    <!-- Submit -->
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" name="addProduct">Add Product</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- Right Panel -->

<?php require_once('footer.php'); ?>