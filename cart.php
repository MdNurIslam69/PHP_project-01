<?php
require_once 'components/header.php';



if (isset($_POST['remove_from_cart'])) {
    $id = $_POST['id'] ?? null;
    if ($id != null && isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
        echo "<script>toastr.success('Product remove successfully!');setTimeout(() => { window.location = window.location.href }, 2000);</script>";
    }
}

?>




<div class="container">

    <h1 class="text-primary mt-5 mb-1 text-decoration-underline text-center">Shopping Cart</h1>

    <div class="row">
        <div class="col-md-12">


            <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>

            <table class="table border table-bordered table-striped mb-4" style="border: 2px solid black !important;"
                id="pendingOrdersTable">
                <thead>
                    <tr style="border: 2px solid black !important;">
                        <th class="text-center bg-secondary text-white" style="border: 2px solid black !important;">SL
                        </th>
                        <th class="text-center bg-secondary text-white" style="border: 2px solid black !important;">
                            Product ID</th>
                        <th class="text-center bg-secondary text-white" style="border: 2px solid black !important;">
                            Product Image</th>
                        <th class="text-center bg-secondary text-white" style="border: 2px solid black !important;">
                            Product</th>
                        <th class="text-center bg-secondary text-white" style="border: 2px solid black !important;">
                            Quantity</th>
                        <th class="text-center bg-secondary text-white" style="border: 2px solid black !important;">S.
                            Price</th>
                        <th class="text-center bg-secondary text-white" style="border: 2px solid black !important;">
                            Total</th>
                        <th class="text-center bg-secondary text-white" style="border: 2px solid black !important;">
                            Action</th>
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

                    <tr style="border: 1px solid black !important;">
                        <td class="text-center align-middle"><?= $sl++; ?></td>
                        <td class="text-center align-middle"><?= $product['id']; ?></td>
                        <td class="text-center align-middle p-1">
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
                        <td colspan="6" class="text-end fw-bold border" style="border: 1px solid black !important;">
                            Total <i class="fa-solid fa-bangladeshi-taka-sign px-1 fw-bold"></i> = </td>
                        <td class="text-center fw-bold p-0"
                            style="border: 1px solid black !important; border-right: none !important;">
                            <i class="fa-solid fa-bangladeshi-taka-sign pe-2 text-muted"></i>
                            <?= number_format($total) ?>
                        </td>
                    </tr>
                </tfoot>

            </table>

            <?php else: ?>
            <h4 class="text-center my-5 fw-bold">Your cart is empty!</h4>
            <?php endif; ?>

        </div>

        <!-- checkout -->
        <div class="col-md-12 my-4 text-end">

            <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
            <a href="checkout.php" class="btn btn-primary mb-0 viewDetailsBtnsSingle1">Proceed to
                Checkout</a>
            <?php endif; ?>


            <?php if (!empty($_SESSION['cart'])) { ?>
            <a href="./" class="btn btn-warning text-white viewDetailsBtnsSingle2">
                <i class="fa-solid fa-arrow-left"></i> Back
            </a>
            <?php } else { ?>
            <div class="text-center">
                <a href="./#featuresArrivalProduct" class="btn btn-warning text-white viewDetailsBtnsSingle2">
                    <i class="fa-solid fa-arrow-left"></i> Back to Home
                </a>
            </div>
            <?php } ?>

        </div>



    </div>

</div>






<!-- cart order table -->
<script>
$(function() {
    const t = $('#pendingOrdersTable').DataTable({
        responsive: true,
        order: [
            [0, "desc"]
        ],
        lengthMenu: [2, 3, 5, 10, 25, 30, 50, 80, 100],
        pageLength: 5
    });

    const updateTotal = () => {
        let total = 0;
        t.rows({
            filter: 'applied'
        }).every(function() {
            const val = $(this.node()).find('td:eq(6)').text().replace(/[^\d]/g, '');
            total += parseFloat(val) || 0;
        });
        $('#pendingOrdersTable tfoot td').eq(1).html(
            `<i class="fa-solid fa-bangladeshi-taka-sign pe-2 text-muted"></i>${total.toLocaleString()}`
        );
    };

    updateTotal();
    t.on('search.dt', updateTotal);
});
</script>




<?php
require_once 'components/footer.php';
?>