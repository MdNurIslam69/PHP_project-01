<?php
require_once './components/header.php';

// Get order ID from URL
$orderId = $_GET['id'] ?? null;
?>

<div class="container">

    <!-- Order Details Heading -->
    <h1 class="forSame-color text-center my-5 text-decoration-underline">Order Details</h1>

    <div class="row">
        <div class="col-md-12">

            <?php
            // Check if user is logged in
            if (!isset($_SESSION['imran_store'])) {
                echo "<script>toastr.error('Please login to view your orders!'); setTimeout(() => { window.location = 'sign-in.php'; }, 2000);</script>";
                exit();
            }

            // Get logged-in user ID
            $userId = $_SESSION['imran_store']['id'];

            // Fixed query: explicit fields, no non-existing column
            $orderQuery = "
                SELECT 
                    order_items.*, 
                    orders.created_at AS order_created_at, 
                    orders.address, 
                    orders.phone_number, 
                    orders.payment_method, 
                    orders.status,
                    products.*
                FROM order_items
                JOIN orders ON order_items.order_id = orders.id 
                JOIN products ON order_items.product_id = products.id
                WHERE order_items.order_id = $orderId
                ORDER BY order_items.id DESC
            ";

            $ordersResult = $conn->query($orderQuery);

            if ($ordersResult->num_rows > 0) {
                echo "<div class='row'>";
                $serialNumber = 1;
                while ($order = $ordersResult->fetch_assoc()) {

                    // Safe fallback for order date
                    $orderDate = !empty($order['order_created_at']) ? $order['order_created_at'] : date('Y-m-d H:i:s');

                    // Calculate total for this item
                    $itemTotal = $order['quantity'] * $order['sales_price']; // or use sales_price if you want
            ?>

            <div class="card mb-4 col-md-12 py-lg-3 py-sm-3">
                <div class="row align-items-center">
                    <div class="col-md-4 d-flex align-items-center mb-lg-0 mb-md-0 mb-sm-3 orderDetailsImage">
                        <img src="./assets/img/products/<?= htmlspecialchars($order['images']) ?>"
                            alt="<?= htmlspecialchars($order['name']) ?>" class="img-thumbnail p-2"
                            style="max-width: 100%; max-height: 100%; object-fit: contain;">
                    </div>

                    <div class="col-md-8">
                        <div class="card-body">

                            <h5 class="card-title fw-bold mb-4">
                                <span class="fw-bold">(<?= $serialNumber++ ?>): </span>
                                <?= htmlspecialchars($order['name']) ?>
                            </h5>

                            <p class="card-title fw-bold">
                                <span class="text-decoration-underline">User Order ID:</span>
                                <?= $order['order_id'] ?>
                            </p>

                            <p class="card-text">
                                <span class="fw-bold text-decoration-underline">Quantity:</span>
                                <?= $order['quantity'] ?>
                            </p>

                            <p class="card-text">
                                <span class="fw-bold text-decoration-underline">Order Date:</span>
                                <?= date("F j, Y, g:i a", strtotime($orderDate)) ?>
                            </p>

                            <p class="card-text">
                                <span class="fw-bold text-decoration-underline">Shipping Address:</span>
                                <?= htmlspecialchars($order['address']) ?>
                            </p>

                            <p class="card-text">
                                <span class="fw-bold text-decoration-underline">Phone Number:</span>
                                <?= htmlspecialchars($order['phone_number']) ?>
                            </p>

                            <p class="card-text">
                                <span class="fw-bold text-decoration-underline">Payment Method:</span>
                                <?= htmlspecialchars($order['payment_method']) ?>
                            </p>

                            <p class="card-text">
                                <span class="fw-bold text-decoration-underline">Total Amount:</span>
                                <i class="fa-solid fa-bangladeshi-taka-sign ps-1 text-muted"></i>
                                <?= number_format($itemTotal, 2) ?>
                            </p>

                            <p class="card-text">
                                <span class="fw-bold text-decoration-underline">Status:</span>
                                <?= htmlspecialchars($order['status']) ?>
                            </p>

                        </div>
                    </div>
                </div>
            </div>

            <?php
                }
                echo "</div>";
            } else {
                echo "<p>No orders found.</p>";
            }
            ?>

        </div>
    </div>

</div>

<!-- Back Buttons -->
<div class="text-center mb-4">
    <a href="./" class="btn text-white orderDetailsBtn" style="background-color: #0f6efd;">
        <i class="fa-solid fa-arrow-left"></i> Back to Home
    </a>

    <a href="my-orders.php" class="btn text-white orderDetailsBtn" style="background-color: green;">
        <i class="fa-solid fa-arrows-left-right"></i> Back
    </a>
</div>

<?php require_once './components/footer.php'; ?>