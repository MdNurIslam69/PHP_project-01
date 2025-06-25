<title><?php echo isset($title) ? $title : "All Products | Imran_Store"; ?></title>


<?php
require_once('header.php');
require_once('sidebar.php');

// Use JOIN to get products WITH category names
$sql = "SELECT p.*, c.name AS category_name_real 
        FROM `products` p 
        LEFT JOIN `products_category` c ON p.category_id = c.id";
$result = $conn->query($sql);
?>

<!-- Right Panel -->
<div id="right-panel" class="right-panel">

    <?php require_once('topBar.php'); ?>

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
            <div class="page-header">
                <div class="page-title mt-4 text-center">
                    <h1 class="text-primary mb-0 h1 <?= isset($_GET['eid']) ? 'd-none' : '' ?>"
                        style="text-decoration: underline; font-size: 40px;">All Products</h1>
                </div>

                <?php if (!isset($_GET['eid']) && !isset($_GET['did'])): ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered custom-table" id="productList">
                            <thead>
                                <tr class="bg-info tableHearder">
                                    <th class="align-middle">Serial ID</th>
                                    <th class="align-middle">Database ID</th>
                                    <th class="align-middle">Product Name</th>
                                    <th class="align-middle">Regular Price</th>
                                    <th class="align-middle">Sale Price</th>
                                    <th class="align-middle">Category ID</th>
                                    <th class="align-middle">Category Name</th>
                                    <th class="align-middle">Image</th>
                                    <th class="align-middle">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $serial = 1; ?>
                                <?php while ($product = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $serial++ ?></td>
                                        <td class="text-center align-middle"><?= $product['id'] ?></td>
                                        <td class="align-middle"><?= $product['name'] ?></td>
                                        <td class="text-center align-middle"><?= $product['regular_price'] ?></td>
                                        <td class="text-center align-middle"><?= $product['sales_price'] ?></td>
                                        <td class="text-center align-middle"><?= $product['category_id'] ?></td>
                                        <td class="text-center align-middle"><?= $product['category_name_real'] ?? 'N/A' ?></td>
                                        <td class="text-center">
                                            <img src="../assets/img/products/<?= $product['images'] ?>"
                                                alt="<?= $product['name'] ?>" width="80">
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
                <?php endif; ?>

                <!-- Edit Product -->
                <?php if (isset($_GET['eid'])):
                    $id = $_GET['eid'];
                    $getProduct = $conn->query("SELECT * FROM `products` WHERE id = $id");
                    $product = $getProduct->fetch_assoc();

                    if (isset($_POST['updateProduct'])) {
                        $name = sanitize($_POST['name']);
                        $regular_price = sanitize($_POST['regular_price']);
                        $sales_price = sanitize($_POST['sales_price']);
                        $category_id = sanitize($_POST['category_id']);
                        $category_name = sanitize($_POST['category_name']);
                        $description = sanitize($_POST['description']);

                        if (empty($name)) $errName = "Please update product name";
                        if (empty($regular_price)) $errRegular_price = "Please update regular price";
                        if (empty($sales_price)) $errSales_price = "Please update sale price";
                        if (empty($category_id)) $errCategory_id = "Category ID missing";
                        if (empty($category_name)) $errCategory_name = "Please select category name";
                        if (empty($description)) $errDescription = "Please update description";

                        if (!isset($errName, $errRegular_price, $errSales_price, $errCategory_id, $errCategory_name, $errDescription)) {
                            if (!empty($_FILES['images']['name'])) {
                                $imageName = basename($_FILES['images']['name']);
                                $target_dir = "../assets/img/products/";
                                $target_file = $target_dir . $imageName;

                                if (move_uploaded_file($_FILES["images"]["tmp_name"], $target_file)) {
                                    $image = $imageName;
                                } else {
                                    echo "<script>toastr.error('Image upload failed');</script>";
                                }
                            } else {
                                $image = $product['images'];
                            }

                            $update = "UPDATE `products` 
                                SET name='$name', regular_price='$regular_price', sales_price='$sales_price',
                                    images='$image', category_id='$category_id', category_name='$category_name', description='$description'
                                WHERE id='$id'";

                            if ($conn->query($update)) {
                                echo "<script>toastr.success('Product updated successfully'); setTimeout(() => { window.location.href='allProducts.php'; }, 2000);</script>";
                            } else {
                                echo "<script>toastr.error('Product update failed');</script>";
                            }
                        }
                    }
                ?>
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-9 col-sm-11 p-3">
                            <h1 class="text-center" style="font-size:40px; text-decoration:underline;">Edit Product</h1>
                            <form method="post" enctype="multipart/form-data" class="border p-4 border-primary rounded">
                                <!-- Name -->
                                <div class="mb-3">
                                    <input type="text" name="name" placeholder="Product Name"
                                        class="form-control <?= isset($errName) ? 'is-invalid' : '' ?>"
                                        value="<?= htmlspecialchars($name ?? $product['name']) ?>">
                                    <div class="invalid-feedback"><?= $errName ?? '' ?></div>
                                </div>

                                <!-- Regular Price -->
                                <div class="mb-3">
                                    <input type="text" name="regular_price" placeholder="Regular Price"
                                        class="form-control <?= isset($errRegular_price) ? 'is-invalid' : '' ?>"
                                        value="<?= htmlspecialchars($regular_price ?? $product['regular_price']) ?>">
                                    <div class="invalid-feedback"><?= $errRegular_price ?? '' ?></div>
                                </div>

                                <!-- Sale Price -->
                                <div class="mb-3">
                                    <input type="text" name="sales_price" placeholder="Sale Price"
                                        class="form-control <?= isset($errSales_price) ? 'is-invalid' : '' ?>"
                                        value="<?= htmlspecialchars($sales_price ?? $product['sales_price']) ?>">
                                    <div class="invalid-feedback"><?= $errSales_price ?? '' ?></div>
                                </div>

                                <!-- Current Image -->
                                <div class="mb-3 text-center">
                                    <label style="cursor:pointer;">
                                        <img src="../assets/img/products/<?= $product['images'] ?>" width="100">
                                        <p>Click to change</p>
                                        <input type="file" name="images" class="d-none">
                                    </label>
                                </div>

                                <!-- Category Name Dropdown section -->
                                <div class="mb-3">
                                    <select id="categorySelect" name="category_name"
                                        class="form-control <?= isset($errCategory_name) ? 'is-invalid' : '' ?>">
                                        <option value="">Select Category</option>
                                        <?php
                                        $cats = $conn->query("SELECT * FROM `products_category`");
                                        while ($cat = $cats->fetch_assoc()) {
                                        ?>
                                            <option value="<?= $cat['name'] ?>" data-id="<?= $cat['id'] ?>"
                                                <?= ((isset($category_name) && $category_name == $cat['name']) || (!isset($category_name) && $product['category_name'] == $cat['name'])) ? 'selected' : '' ?>>
                                                <?= $cat['name'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback"><?= $errCategory_name ?? '' ?></div>
                                </div>

                                <!-- Auto-filled Category ID -->
                                <div class="mb-3">
                                    <input id="categoryIdInput" type="text" name="category_id" placeholder="Category ID"
                                        class="bg-white form-control <?= isset($errCategory_id) ? 'is-invalid' : '' ?>"
                                        value="<?= htmlspecialchars($category_id ?? $product['category_id']) ?>" readonly>
                                    <div class="invalid-feedback"><?= $errCategory_id ?? '' ?></div>
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <textarea name="description" rows="3" placeholder="Description"
                                        class="form-control <?= isset($errDescription) ? 'is-invalid' : '' ?>"><?= htmlspecialchars($description ?? $product['description']) ?></textarea>
                                    <div class="invalid-feedback"><?= $errDescription ?? '' ?></div>
                                </div>

                                <button type="submit" name="updateProduct" class="btn btn-primary">Update Product</button>
                                <a href="allProducts.php" class="btn btn-danger">Cancel</a>
                            </form>
                        </div>
                    </div>


                    <!-- this javascript, for auto-filling category id section, when category name is selected -->
                    <script>
                        document.getElementById('categorySelect').addEventListener('change', function() {
                            var id = this.options[this.selectedIndex].getAttribute('data-id') || '';
                            document.getElementById('categoryIdInput').value = id;
                        });
                    </script>
                <?php endif; ?>

                <!-- Delete Product -->
                <?php if (isset($_GET['did'])):
                    $id = $_GET['did'];
                    if (isset($_POST['deleteProduct'])) {
                        $conn->query("DELETE FROM `products` WHERE id=$id");
                        echo "<script>toastr.success('Deleted'); setTimeout(()=>{window.location='allProducts.php';},1500);</script>";
                    }
                ?>
                    <div class="container">
                        <div
                            style="position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,.6); display:flex; align-items:center; justify-content:center; z-index:9999;">
                            <div
                                style="background:#fff; max-width:400px; padding:2rem; border-radius:10px; box-shadow:0 10px 25px rgba(0,0,0,0.2); text-align:center;">
                                <h3 style="margin-bottom: 3rem; font-size: 1.25rem; color: purple;">Are you sure? do you
                                    want
                                    to
                                    delete this item?</h3>

                                <form method="post" action=""
                                    style="display: flex; align-items: center; justify-content: center; gap: 2rem;">


                                    <button type="submit" name="deleteProduct"
                                        style="background: #e74c3c; color: #fff; border: none; padding: 0.5rem 1.2rem; border-radius: 6px; cursor: pointer;  font-weight: bold;">Yes</button>


                                    <a href="allProducts.php"
                                        style="background: #3498db; color: #fff; border: none; padding: 0.5rem 1.2rem; border-radius: 6px; cursor: pointer; font-weight: bold;">No</a>

                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#productList').DataTable({
            responsive: true,
            order: [
                [0, 'desc']
            ],
            lengthMenu: [5, 10, 25, 50, 100],
            pageLength: 5
        });
    });
</script>

<?php require_once('footer.php'); ?>