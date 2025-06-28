<?php
require_once './components/header.php';


if (isset($_POST['place_order'])) {
    // Get user ID
    $userId = $_SESSION['imran_store']['id'] ?? $_POST['user_id'] ?? null;
    if (!$userId) {
        echo "<script>toastr.error('User not found!'); setTimeout(() => { window.location = 'sign-up.php'; }, 2000);</script>";
        exit();
    }

    $name = $conn->real_escape_string($_POST['name'] ?? '');
    $email = $conn->real_escape_string($_POST['email'] ?? '');
    $phone_number = $conn->real_escape_string($_POST['phone_number'] ?? '');
    $address = $conn->real_escape_string($_POST['address'] ?? '');
    $payment_method = $conn->real_escape_string($_POST['payment_method'] ?? 'Cash_on_delivery');

    // ✅ Add status
    $status = 'Pending';

    // Calculate total
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

    // ✅ Correct INSERT
    $orderQuery = "INSERT INTO `orders`
    (`user_id`, `name`, `phone_number`, `address`, `total`, `payment_method`, `status`)
    VALUES
    ('$userId', '$name', '$phone_number', '$address', '$total', '$payment_method', '$status')";

    if ($conn->query($orderQuery)) {
        $orderId = $conn->insert_id;


        // Insert order_items table in database
        foreach ($cart as $id => $quantity) {
            $getProductQuery =  "SELECT * FROM `products` WHERE `id` = $id";
            $getProductResult = $conn->query($getProductQuery);
            if ($getProductResult->num_rows > 0) {
                $product = $getProductResult->fetch_assoc();
                $subtotal = $product['sales_price'] * $quantity;
                $orderItemQuery = "INSERT INTO `order_items`
                (`order_id`, `product_id`, `quantity`, `total_amount`)
                VALUES
                ($orderId, $id, $quantity, $subtotal)";
                $conn->query($orderItemQuery);
            }
        }

        unset($_SESSION['cart']);
        echo "<script>toastr.success('Order placed successfully!'); setTimeout(() => { window.location = 'my-orders.php'; }, 2000);</script>";
    } else {
        echo "<script>toastr.error('Failed to place order: " . addslashes($conn->error) . "');</script>";
    }
}






?>


<!-- checkout section  -->
<div class="container py-4 gap-lg-5">

    <h1 class="text-primary mb-5 text-center text-decoration-underline mt-4">Products Checkout</h1>
    <div class="row">

        <!-- billing address section -->
        <div class="col-lg-4 col-md-5 col-sm-12 mt-2">

            <h3 class="mb-4 text-center text-decoration-underline">Billing Address</h3>

            <form action="" method="post" class=" mb-sm-2 ">
                <!-- login ser id in hidden field -->
                <input type="hidden" name="user_id" value="<?= $_SESSION['imran_store']['id'] ?? null ?>">
                <input type="hidden" name="user_email" value="<?= $_SESSION['imran_store']['email'] ?? null ?>">


                <!-- name section -->
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required
                        value="<?= $_SESSION['imran_store']['name'] ?? null ?>">
                </div>

                <!-- email section -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email address:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email"
                        required value="<?= $_SESSION['imran_store']['email'] ?? null ?>">
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

                <button type="submit" class="btn btn-primary viewDetailsBtnsSingle1" name="place_order">Place
                    Order</button>


                <a href="cart.php" class="btn btn-warning text-white viewDetailsBtnsSingle2 "><i
                        class="fa-solid fa-arrow-left"></i>
                    Back</a>
            </form>
        </div>




        <!-- order summary section -->
        <div class="col-lg-8 col-md-7 col-sm-12 mt-lg-0  mt-md-4">

            <p class="d-lg-block d-md-none d-sm-block">
                <br>
            </p>

            <h3 class="mb-4 text-center text-decoration-underline mt-md-3">Order Summary</h3>

            <table class="table table-bordered table-striped" style="border: 2px solid black !important;">
                <thead class="table-dark">
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
                        <td colspan="2" class="fw-bold text-end">Total <i
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
                    <img src="assets/img/payment_method.jpg" alt="payment_method" class=" mt-3 rounded-4"
                        id="payment_method" style="max-width: 100%; border: 1px solid #6d5ce8 !important;">
                </div>

            </div>

        </div>
    </div>
</div>











<?php
require_once './components/footer.php';
?>