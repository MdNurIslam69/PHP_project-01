<title><?php echo isset($title) ? $title : "Add Products | Imran_Store"; ?></title>


<?php
require_once('header.php');
require_once('sidebar.php');

if (isset($_POST['addProduct'])) {
    $hasError = false; // ✅ Initialize the error flag

    // Sanitize inputs
    $name = sanitize($_POST['name']);
    $regular_price = sanitize($_POST['regular_price']);
    $sale_price = sanitize($_POST['sales_price']);
    $category_id = sanitize($_POST['category_id']);
    $category_name = sanitize($_POST['category_name']);
    $description = sanitize($_POST['description']);

    // Image upload data
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

    // Validate Name
    if (empty($name)) {
        $errName = "Please enter a product name";
        $hasError = true;
    } else {
        $crrName = $conn->real_escape_string($name);
    }

    // Validate Regular Price
    if (empty($regular_price)) {
        $errRegular_price = "Please enter a regular price";
        $hasError = true;
    } else {
        $crrRegular_price = $conn->real_escape_string($regular_price);
    }

    // Validate Sale Price
    if (empty($sale_price)) {
        $errSales_price = "Please enter a sale price";
        $hasError = true;
    } else {
        $crrSales_price = $conn->real_escape_string($sale_price);
    }

    // Validate Category Name
    if (empty($category_name)) {
        $errCategory_name = "Please select a category name";
        $hasError = true;
    } else {
        $crrCategory_name = $conn->real_escape_string($category_name);
    }

    // Validate Category ID
    if (empty($category_id)) {
        $errCategory_id = "Category ID is missing";
        $hasError = true;
    } else {
        $crrCategory_id = $conn->real_escape_string($category_id);
    }

    // Validate Description
    if (empty($description)) {
        $errDescription = "Please enter a product description";
        $hasError = true;
    } else {
        $crrDescription = $conn->real_escape_string($description);
    }

    // Validate Image
    if (empty($imageName)) {
        $errImage = "Please upload an image";
        $hasError = true;
    }

    // ✅ If no validation errors, proceed
    if (!$hasError) {
        if (!in_array($imageType, $allowedTypes)) {
            $errImage = "Invalid image type. Only jpeg, png, jpg, gif, webp allowed";
        } elseif ($imageError !== 0) {
            $errImage = "Error uploading the image";
        } elseif ($imageSize > 2000000) {
            $errImage = "File size should be less than 2MB";
        } else {
            $crrImage = $conn->real_escape_string($uploadFileName);

            if (move_uploaded_file($imageTmpName, $uploadFilePath)) {
                $sql = "INSERT INTO `products`(`name`, `regular_price`, `sales_price`, `images`, `category_id`, `category_name`, `description`) 
                        VALUES('$crrName', '$crrRegular_price', '$crrSales_price', '$crrImage', '$crrCategory_id', '$crrCategory_name', '$crrDescription')";

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

                <form action="" method="post" enctype="multipart/form-data"
                    class="mt-3 border p-3 border-primary rounded">

                    <!-- Product Name -->
                    <div class="mb-3">
                        <input type="text" placeholder="Product Name"
                            class="form-control <?= isset($errName) ? 'is-invalid' : null ?>" name="name"
                            value="<?= isset($name) ? $name : '' ?>">
                        <div class="invalid-feedback">
                            <?= isset($errName) ? $errName : '' ?>
                        </div>
                    </div>

                    <!-- Regular Price -->
                    <div class="mb-3">
                        <input type="text" placeholder="Regular Price"
                            class="form-control <?= isset($errRegular_price) ? 'is-invalid' : null ?>"
                            name="regular_price" value="<?= isset($regular_price) ? $regular_price : '' ?>">
                        <div class="invalid-feedback">
                            <?= isset($errRegular_price) ? $errRegular_price : '' ?>
                        </div>
                    </div>

                    <!-- Sale Price -->
                    <div class="mb-3">
                        <input type="text" placeholder="Sale Price"
                            class="form-control <?= isset($errSales_price) ? 'is-invalid' : null ?>" name="sales_price"
                            value="<?= isset($sale_price) ? $sale_price : '' ?>">
                        <div class="invalid-feedback">
                            <?= isset($errSales_price) ? $errSales_price : '' ?>
                        </div>
                    </div>

                    <!-- Image Upload -->
                    <div class="mb-3">
                        <input type="file" placeholder="Product Image"
                            class="form-control <?= isset($errImage) ? 'is-invalid' : null ?>" name="images"
                            style="padding-top: 0.20rem;">
                        <div class="invalid-feedback">
                            <?= isset($errImage) ? $errImage : '' ?>
                        </div>
                    </div>

                    <!-- Category Name Dropdown -->
                    <div class="mb-3">
                        <select id="categorySelect" name="category_name"
                            class="form-control <?= isset($errCategory_name) ? 'is-invalid' : null ?>">
                            <option value="">Select Category</option>
                            <?php
                            $getCategoryResult = $conn->query("SELECT * FROM `products_category`");
                            while ($category = $getCategoryResult->fetch_assoc()) {
                            ?>
                            <option value="<?= $category['name'] ?>" data-id="<?= $category['id'] ?>"
                                <?= isset($category_name) && $category_name == $category['name'] ? 'selected' : '' ?>>
                                <?= $category['name'] ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= isset($errCategory_name) ? $errCategory_name : '' ?>
                        </div>
                    </div>


                    <!-- Auto-filled Category ID (readonly) -->
                    <div class="mb-3">
                        <input id="categoryIdInput" placeholder="Category ID"
                            class="bg-white form-control <?= isset($errCategory_id) ? 'is-invalid' : null ?>"
                            name="category_id" value="<?= isset($category_id) ? $category_id : '' ?>" readonly>
                        <div class="invalid-feedback">
                            <?= isset($errCategory_id) ? $errCategory_id : '' ?>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <textarea name="description" placeholder="Product Description" rows="3"
                            class="form-control <?= isset($errDescription) ? 'is-invalid' : null ?>"><?= isset($description) ? htmlspecialchars($description) : '' ?></textarea>
                        <div class="invalid-feedback">
                            <?= isset($errDescription) ? $errDescription : '' ?>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div>
                        <button type="submit" class="btn btn-primary" name="addProduct">Add Product</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>



<!-- JS to auto-fill Category ID,
 its for just automaticly filling category id, when category name is selected -->
<script>
document.getElementById('categorySelect').addEventListener('change', function() {
    var selected = this.options[this.selectedIndex];
    document.getElementById('categoryIdInput').value = selected.getAttribute('data-id') || '';
});
</script>

<?php require_once('footer.php'); ?>