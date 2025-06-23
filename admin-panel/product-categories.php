<?php
$title = "Product Categories | Imran_Store";
require_once('header.php');
require_once('sidebar.php');


if (isset($_POST['addCategory'])) {
    $categoryName = sanitize($_POST['name']);


    // validation
    if (empty($categoryName)) {
        $errName = "Please choose a category name";
    } else {
        $sql = "SELECT * FROM `products_category` WHERE `name` = '$categoryName'";
        if ($conn->query($sql)->num_rows > 0) {
            $errName = "Category already exist";
        } else {
            $sql = "INSERT INTO `products_category`(`name`) VALUES('$categoryName')";
            if ($conn->query($sql) === TRUE) {
                echo "<script>toastr.success('Category added successfully');</script>";
            } else {
                echo "<script>toastr.error('Category add failed');</script>";
            }
        }
    }
}



if (isset($_POST['updateCategoryBTN'])) {
    $updateCategoryId = $_POST['updateCategoryId'];
    $oldCategoryName = $_POST['oldCategoryName'];
    $name = sanitize($_POST['name']);


    // validation
    if (empty($name)) {
        $errUpName = "Please choose a category name";
    } else {
        if ($oldCategoryName == $name) {
            echo "<script>toastr.info('Not change products');</script>";
        } else {
            $sql = "SELECT * FROM `products_category` WHERE `name` = '$name'";
            if ($conn->query($sql)->num_rows > 0) {
                $errUpName = "Category already exist";
            } else {
                $sql = "UPDATE `products_category` SET `name` = '$name' WHERE `id` = '$updateCategoryId'";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>toastr.success('Category updated successfully');
                    setTimeout(() => {
                    window.location.href = 'product-categories.php';
                    }, 2000);
                    </script>";
                } else {
                    echo "<script>toastr.error('Category update failed');</script>";
                }
            }
        }
    }
}



if (isset($_POST['deleteCategory'])) {
    $categoryId = $_POST['categoryId'];

    $sql = "DELETE FROM `products_category` WHERE `id` = '$categoryId'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
        toastr.success('Category deleted successfully');
        setTimeout(() => {
            window.location.href = 'product-categories.php';
        }, 2000);
        </script>";
    } else {
        echo "<script>toastr.error('Category delete failed');</script>";
    }
}



$getCategoryQuery = "SELECT * FROM `products_category` ORDER BY `id` DESC";
$getCategoryResult = $conn->query($getCategoryQuery);
if ($getCategoryResult->num_rows > 0) {
    $categories = $getCategoryResult->fetch_assoc();
}
?>



<!-- Right Panel -->

<div id="right-panel" class="right-panel">


    <?php
    require_once('topBar.php');
    ?>

    <div class="breadcrumbs">
        <div class="col-12 justify-content-center d-flex">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1 class=" text-center mt-4 mb-4 text-primary h1"
                        style="text-decoration: underline; font-size: 40px;">
                        All Categorie Section</h1>
                </div>
            </div>
        </div>
    </div>


    <?php if (!isset($_GET['did'])) { ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <?php if (!isset($categories)) { ?>
                <h2 class="mb-3">No Categories Found</h2>
                <?php } else { ?>

                <h2 class="mb-3 mt-2">All Categories</h2>

                <table class="table table-striped" id="categoryList" style="border: 2px solid black !important;">
                    <thead>
                        <tr class="bg-info text-white">

                            <th class="text-center" style="border: 2px solid black !important;">S. No</th>
                            <th class="text-center" style="border: 2px solid black !important;">Product ID</th>
                            <th class="text-center" style="border: 2px solid black !important;">Name</th>
                            <th class="text-center" style="border: 2px solid black !important;">Action</th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php
                                $i = 1;
                                do {

                                ?>
                        <tr>
                            <td class="align-middle text-center" style="border: 1px solid black !important;"><?= $i++ ?>
                            </td>
                            <td class="align-middle text-center" style="border: 1px solid black !important;">
                                <?= $categories['id'] ?></td>
                            <td class="align-middle text-center" style="border: 1px solid black !important;">
                                <?= $categories['name'] ?></td>
                            <td class="align-middle text-center" style="border: 1px solid black !important;">
                                <a href="product-categories.php?eid=<?= $categories['id'] ?>"
                                    class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="product-categories.php?did=<?= $categories['id'] ?>"
                                    class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i></a>
                            </td>
                        </tr>

                        <?php
                                } while ($categories = $getCategoryResult->fetch_assoc());
                                ?>

                    </tbody>
                </table>
                <?php } ?>
            </div>



            <div class="col-md-6">

                <h2 class="mb-3 mt-2">Add New Category</h2>

                <form action="" method="post">
                    <div class="mb-3">
                        <input type="text" placeholder="Category Name"
                            class="form-control <?= isset($errName) ? 'is-invalid' : null ?>" name="name">

                        <div class="invalid-feedback">
                            <?= isset($errName) ? $errName : null ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" name="addCategory">Add Category</button>

                </form>



                <!-- edit_product_popup--section -->
                <!-- .. -->
                <?php if (isset($_GET['eid'])) { ?>

                <h2 class="my-3">Edit Category</h2>


                <?php

                        $categoryList = $_GET['eid'];
                        $getCategoryQuery = "SELECT * FROM `products_category` WHERE `id` = '$categoryList'";
                        $getCategoryResult = $conn->query($getCategoryQuery);

                        if ($getCategoryResult->num_rows > 0) {
                            $categories = $getCategoryResult->fetch_assoc();
                        }
                        ?>

                <?php
                        if (isset($categories)) {
                        ?>

                <form action="" method="post">

                    <input type="hidden" name="updateCategoryId" value="<?= $categories['id'] ?>">

                    <input type="hidden" name="oldCategoryName" value="<?= $categories['name'] ?>">

                    <div class="mb-3">
                        <input type="text" placeholder="Category Name"
                            class="form-control <?= isset($errUpName) ? 'is-invalid' : null ?>" name="name"
                            value="<?= $categories['name'] ?>">

                        <div class="invalid-feedback">
                            <?= isset($errUpName) ? $errUpName : null ?>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary" name="updateCategoryBTN">Update Category</button>

                    <a href="product-categories.php" class="btn btn-danger"><i class="fa-solid fa-arrow-left"></i>
                        Cancel</a>
                </form>

                <?php } else { ?>
                <h2 class="mb-3">No Category Found</h2>
                <?php } ?>
                <?php } ?>



            </div>
        </div>

    </div>

    <?php } else { ?>


    <!-- delete_product_popup--section-->
    <!-- .. -->
    <div class="container">
        <div
            style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); display: flex; align-items: center; justify-content: center; z-index: 9999;">
            <div
                style="background: #fff; max-width: 400px; width: 90%; padding: 1.5rem; border-radius: 10px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); text-align: center;">

                <h3 style="margin-bottom: 3rem; font-size: 1.25rem; color: purple;">Are you sure? do you want to delete
                    this product Category?</h3>

                <form method="post" action=""
                    style="display: flex; align-items: center; justify-content: center; gap: 3rem;">

                    <input type="hidden" name="categoryId" value="<?= $_GET['did'] ?>">

                    <button type="submit" name="deleteCategory"
                        style="background: #e74c3c; color: #fff; border: none; padding: 0.5rem 1.2rem; border-radius: 6px; cursor: pointer;  font-weight: bold;">Yes</button>


                    <a href="product-categories.php"
                        style="background: #3498db; color: #fff; border: none; padding: 0.5rem 1.2rem; border-radius: 6px; cursor: pointer; font-weight: bold;">No</a>

                </form>
            </div>
        </div>
    </div>

    <?php } ?>
</div>

<!-- Right Panel -->


<script>
$("#categoryList").DataTable({
    "lengthMenu": [4, 5, 10, 25, 50, 100],
    "pageLength": 5

});
</script>


<?php
require_once('footer.php');
?>