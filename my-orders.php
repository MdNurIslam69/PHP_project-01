<?php
$title = "My Orders | Imran_Store";
require_once './components/header.php';
?>


<div class="container mb-5">

    <!-- my orders -->

    <h2 class="forSame-color text-center my-5  text-decoration-underline">My Orders</h2>

    <div class="row">

        <?php
        // Fetch user's orders from the database
        $userId = $_SESSION['link3Tech']['id'];
        $orderQuery = "SELECT * FROM orders WHERE user_id = $userId ORDER BY created_at DESC";
        $ordersResult = $conn->query($orderQuery);
        while ($order = $ordersResult->fetch_assoc()):
        ?>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title"><span class="fw-bold text-decoration-underline">Order ID:</span>
                        <?= $order['id'] ?></h5>
                    <p class="card-text pb-3"><span class="fw-bold text-decoration-underline">Total:</span>
                        <i class="fa-solid fa-bangladeshi-taka-sign ps-1 text-muted"></i>
                        <?= number_format($order['total']) ?>
                    </p>
                    <a href="order-details.php?id=<?= $order['id'] ?>"
                        class="btn btn-primary viewDetailsBtnsSingle1">View Details</a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>

    </div>

    <div class="text-center">
        <a href="./" class="btn text-white viewDetailsBtnsSingle1" style="background-color: #7b6eec;"><i
                class="fa-solid fa-arrow-left"></i>
            Back to Home</a>
    </div>

</div>

<?php
require_once './components/footer.php';
?>