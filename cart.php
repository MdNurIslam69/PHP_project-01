<?php
require_once './components/header.php';


if (isset($_POST['remove_from_cart'])) {
    $id = $_POST['id'] ?? null;
    if ($id != null && isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
        echo "<script>toastr.success('Product remove successfully!');setTimeout(() => { window.location = window.location.href }, 2000);</script>";
    }
}
?>




<div class="container">

    <h1 class="text-primary mt-5 mb-5 text-decoration-underline text-center">Shopping Cart</h1>

    <div class="row">
        <div class="col-md-12">


            <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>

                <table class="table border table-bordered table-striped mb-4" style="border: 2px solid black !important;">
                    <thead>
                        <tr>
                            <th class="text-center">SL</th>
                            <th class="text-center">Product Image</th>
                            <th class="text-center">Product</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">S. Price</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $total = 0;
                        $sl = 1;
                        foreach ($_SESSION['cart'] as $id => $quantity):
                            $getProductQuery = "SELECT * FROM `products` WHERE `id` = $id";
                            $getProductResult = $conn->query($getProductQuery);

                            if ($getProductResult->num_rows > 0):
                                $product = $getProductResult->fetch_assoc();
                                $subtotal = $product['sales_price'] * $quantity;
                                $total += $subtotal;
                        ?>

                                <tr>
                                    <td class="text-center align-middle"><?= $sl++; ?></td>
                                    <td class="text-center align-middle">
                                        <img src="./assets/img/products/<?= $product['images']; ?>" alt="<?= $product['name']; ?>"
                                            width="100">
                                    </td>
                                    <td class="align-middle"><?= $product['name']; ?></td>
                                    <td class="text-center align-middle"><?= $quantity ?></td>

                                    <td class="text-center align-middle"><i
                                            class="fa-solid fa-bangladeshi-taka-sign pe-1 text-muted"></i>
                                        <?= number_format($product['sales_price']); ?></td>
                                    <td class="text-center align-middle"><i
                                            class="fa-solid fa-bangladeshi-taka-sign pe-1 text-muted"> </i>
                                        <?= number_format($subtotal) ?></td>

                                    <td class="text-center align-middle p-0" style="width: 100px !important;">

                                        <form action="" method="POST">
                                            <input type="hidden" name="id" value="<?= $product['id']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                name="remove_from_cart">Remove</button>
                                        </form>
                                    </td>
                                </tr>

                        <?php
                            endif;
                        endforeach;
                        ?>
                    </tbody>


                    <tfoot>
                        <tr>
                            <td colspan="6" class="text-end fw-bold">Total <i
                                    class="fa-solid fa-bangladeshi-taka-sign px-1 fw-bold"></i> = </td>
                            <td class="text-center fw-bold"><i
                                    class="fa-solid fa-bangladeshi-taka-sign pe-1 text-muted"></i>
                                <?= number_format($total) ?></td>
                        </tr>
                    </tfoot>

                </table>

            <?php else: ?>
                <p class="text-center">Your cart is empty!</p>
            <?php endif; ?>

        </div>

        <!-- checkout -->
        <div class="col-md-12 mb-5 text-end mt-4">

            <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                <a href="checkout.php" class="btn btn-primary mb-5">Proceed to Checkout</a>
            <?php endif; ?>
        </div>


    </div>

</div>








<?php
require_once './components/footer.php';
?>