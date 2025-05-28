<?php
require_once './components/header.php';


if (isset($_POST['place_order'])) {
    // get user id
    $userId = $_POST['user_id'] ?? null;
    if ($userId == null) {
        echo "<script>toastr.error('User not found!');setTimeout(() => { window.location = sign-up.php }, 2000);</script>";
        exit();
    }


    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];

    // product in cart
    $cart = $_SESSION['cart'] ?? [];
    $total = 0;
    foreach ($cart as $id => $quantity) {
        $getProductQuery = "SELECT * FROM `products` WHERE `id` = $id";
        $getProductResult = $conn->query($getProductQuery);

        if ($getProductResult->num_rows > 0) {
            $product = $getProductResult->fetch_assoc();
            $total += $product['sales_price'] * $quantity;
        }
    }

    // insert order into database
    $orderQuery = "INSERT INTO `orders`(`user_id`, `name`, `phone_number`, `address`, `total`) 
               VALUES ('$userId', '$name', '$phone_number', '$address', '$total')";



    if ($conn->query($orderQuery)) {
        $orderId = $conn->insert_id;

        // insert order items into database
        foreach ($cart as $id => $quantity) {
            $getProductQuery =  "SELECT * FROM `products` WHERE `id` = $id";
            $getProductResult = $conn->query($getProductQuery);

            if ($getProductResult->num_rows > 0) {
                $product = $getProductResult->fetch_assoc();
                $subtotal = $product['sales_price'] * $quantity;
                $orderItemQuery = "INSERT INTO `order_items`(`order_id`, `product_id`, `quantity`, `sub_total`) VALUES ($orderId, $id, $quantity, $subtotal)";
                $conn->query($orderItemQuery);
            }
        }
        // clear cart
        unset($_SESSION['cart']);
        echo "<script>toastr.success('Order placed successfully!');setTimeout(() => { window.location = 'index.php' }, 2000);</script>";
    } else {
        echo "<script>toastr.error('Failed to place order!');</script>";
    }
}





?>


<!-- checkout section  -->
<div class="container py-4 gap-lg-5">

    <h1 class="text-primary mb-5 text-center text-decoration-underline mt-4">Checkout</h1>
    <div class="row">

        <div class="col-lg-4 col-md-5 col-sm-12 mt-2">

            <h3 class="mb-4 text-center text-decoration-underline">Billing Address</h3>

            <form action="" method="post" class=" mb-sm-2 ">
                <!-- login ser id in hidden field -->
                <input type="hidden" name="user_id" value="<?= $_SESSION['link3Tech']['id'] ?? null ?>">
                <input type="hidden" name="user_email" value="<?= $_SESSION['link3Tech']['email'] ?? null ?>">


                <!-- name section -->
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required
                        value="<?= $_SESSION['link3Tech']['name'] ?? null ?>">
                </div>

                <!-- email section -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email address:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email"
                        required value="<?= $_SESSION['link3Tech']['email'] ?? null ?>">
                </div>

                <!-- number section -->
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number:</label>
                    <input type="number" class="form-control" id="phone_number" name="phone_number"
                        placeholder="Enter Phone Number" required>
                </div>

                <!-- address section -->
                <div class="mb-3">
                    <label for="address" class="form-label">Shipping Address:</label>
                    <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter your address"
                        required></textarea>
                </div>

                <button type="submit" class="btn btn-primary " name="place_order">Place Order</button>
            </form>
        </div>


        <div class="col-lg-8 col-md-7 col-sm-12 mt-lg-0  mt-md-4">

            <p class="d-lg-block d-md-none d-sm-block">
                <br>
            </p>

            <h3 class="mb-4 text-center text-decoration-underline mt-md-3">Order Summary</h3>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Product Name</th>
                        <th class="text-center">Price</th>
                    </tr>
                </thead>
                <tbody>

                <tbody>
                    <?php
                    $total = 0; // ✅ Initialize total
                    if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0):
                        foreach ($_SESSION['cart'] as $id => $quantity):
                            $getProductQuery = "SELECT * FROM `products` WHERE `id` = $id";
                            $getProductResult = $conn->query($getProductQuery);

                            if ($getProductResult->num_rows > 0) {
                                $product = $getProductResult->fetch_assoc();
                                $subTotal = $product['sales_price'] * $quantity;
                                $total += $subTotal; // ✅ Add to total
                    ?>
                                <tr>
                                    <td class="text-center align-middle"><?= $quantity ?></td>
                                    <td><?= $product['name'] ?></td>
                                    <td class="text-center align-middle">
                                        <i class="fa-solid fa-bangladeshi-taka-sign pe-1 text-muted"></i>
                                        <?= number_format($subTotal) ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="text-end fw-bold">Total <i
                                class="fa-solid fa-bangladeshi-taka-sign px-1 fw-bold"></i> = </td>
                        <td class="text-center fw-bold">
                            <i class="fa-solid fa-bangladeshi-taka-sign pe-1 text-muted"></i>
                            <?= number_format($total) ?>
                        </td>
                    </tr>
                </tfoot>


            </table>


            <!-- cash on delivery -->

            <div
                class="mt-4 d-lg-flex d-md-flex justify-content-lg-between justify-content-md-between align-items-center ">

                <div class="col-lg-4 col-md-5 ps-lg-4 ps-md-2 mt-sm-4">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="cash_on_delivery"
                            value="cash_on_delivery" checked>
                        <label class="form-check-label" for="cash_on_delivery">
                            Cash on Delivery
                        </label>

                        <div class="invalid-feedback">
                            please select a payment method
                        </div>
                    </div>

                    <!-- pay now -->


                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment_method" id="pay_now" value="pay_now">
                        <label class="form-check-label" for="pay_now">Pay Now</label>

                        <div class="invalid-feedback">
                            please select a payment method
                        </div>
                    </div>

                </div>

                <div class="col-lg-8 col-md-7">
                    <img src="assets/img/payment_method.jpg" alt="payment_method"
                        class=" mt-3 border border-primary rounded-4" id="payment_method" style="max-width: 100%;">
                </div>

            </div>

        </div>
    </div>
</div>











<?php
require_once './components/footer.php';
?>