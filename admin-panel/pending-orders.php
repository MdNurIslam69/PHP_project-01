<?php
$title = "Pending Orders | Imran_Store";
require_once('header.php');
require_once('sidebar.php');

// ✅ Corrected status update logic
if (isset($_POST['updateStatus'])) {

    $order_item_id = $_POST['order_item_id'];
    $status = $_POST['status'];

    // 1️⃣ Get the order_id from the order_items table
    $orderIdQuery = "SELECT order_id FROM `order_items` WHERE `id` = '$order_item_id'";
    $orderIdResult = $conn->query($orderIdQuery);

    if ($orderIdResult && $orderIdResult->num_rows > 0) {
        $orderIdRow = $orderIdResult->fetch_assoc();
        $order_id = $orderIdRow['order_id'];

        // 2️⃣ Update the orders table with new status
        $updateQuery = "UPDATE `orders` SET `status` = '$status' WHERE `id` = '$order_id'";
        if ($conn->query($updateQuery) === TRUE) {
            echo "<script>toastr.success('Status updated successfully!');</script>";
        } else {
            echo "<script>toastr.error('Status update failed');</script>";
        }
    } else {
        echo "<script>toastr.error('Order ID not found');</script>";
    }
}

// ✅ Get all order items whose parent order is still pending
$query = "
SELECT order_items.id as order_item_id, order_items.*, orders.*, products.name AS product_name, products.images, users.name AS user_name 
FROM order_items 
INNER JOIN orders ON order_items.order_id = orders.id 
INNER JOIN products ON order_items.product_id = products.id 
INNER JOIN users ON orders.user_id = users.id 
WHERE orders.status = 'Pending'
";

$result = $conn->query($query);

?>

<div id="right-panel" class="right-panel">

    <?php require_once('topBar.php'); ?>

    <div class="">
        <div class="col-12 mt-4">
            <h1 class="mb-5 mt-3 text-primary text-center" style="text-decoration: underline; font-size: 40px;">
                Pending Orders
            </h1>

            <div class=" ">
                <div class="">

                    <?php
                    if ($result->num_rows > 0) {
                    ?>

                    <table class="table border table-bordered table-striped mb-4" id="pendingOrdersTable"
                        style="border: 2px solid black !important;">
                        <thead>
                            <tr class="bg-info text-white">
                                <th class="text-center align-middle" style="border: 2px solid black">S.N</th>
                                <th class="text-center align-middle" style="border: 2px solid black">Order ID</th>
                                <th class="text-center align-middle" style="border: 2px solid black">User Name</th>
                                <th class="text-center align-middle" style="border: 2px solid black">Product Name</th>
                                <th class="text-center align-middle p-0" style="border: 2px solid black">
                                    Product Image
                                </th>
                                <th class="text-center align-middle" style="border: 2px solid black">Quantity</th>
                                <th class="text-center align-middle" style="border: 2px solid black">Total</th>
                                <th class="text-center align-middle" style="border: 2px solid black">Order Date</th>
                                <th class="text-center align-middle" style="border: 2px solid black">Status</th>
                                <th class="text-center align-middle" style="border: 2px solid black">Shipping Address
                                </th>
                                <th class="text-center align-middle" style="border: 2px solid black">Payment Method</th>
                                <th class="text-center align-middle" style="border: 2px solid black">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $sl = 1;
                                while ($row = $result->fetch_assoc()) {
                                ?>
                            <tr>
                                <td class="text-center align-middle" style="border: 1px solid black"><?= $sl++ ?></td>

                                <td class="text-center align-middle" style="border: 1px solid black">
                                    <?= $row['order_id'] ?></td>

                                <td class="text-center align-middle" style="border: 1px solid black">
                                    <?= $row['name'] ?></td>

                                <td class="align-middle" style="border: 1px solid black">
                                    <?= $row['product_name'] ?></td>

                                <td class="text-center align-middle p-0" style="border: 1px solid black">
                                    <img src="../assets/img/products/<?= $row['images'] ?>" alt="<?= $row['name'] ?>"
                                        style="max-width: 60%;">
                                </td>

                                <td class="text-center align-middle" style="border: 1px solid black">
                                    <?= $row['quantity'] ?></td>

                                <td class="text-center align-middle"
                                    style="border: 1px solid black; font-weight: bold;">
                                    <i class="fa-solid fa-bangladeshi-taka-sign pe-1 fw-bold"></i>
                                    <?= number_format($row['total_amount'], 2) ?>
                                </td>

                                <td class="text-center align-middle p-3" style="border: 1px solid black">
                                    <?= date('F j, Y, g:i a', strtotime($row['created_at'])) ?>
                                </td>

                                <td class="text-center align-middle" style="border: 1px solid black">
                                    <?= $row['status'] ?>
                                </td>

                                <td class="align-middle" style="border: 1px solid black">
                                    <?= $row['address'] ?>
                                </td>

                                <td class="text-center align-middle" style="border: 1px solid black">
                                    <?= $row['payment_method'] ?>
                                </td>

                                <td class="text-center align-middle" style="border: 1px solid black">
                                    <form action="" method="POST">
                                        <select name="status" class="form-select mb-2" required>
                                            <option value="Pending"
                                                <?= $row['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                            <option value="Shifted"
                                                <?= $row['status'] == 'Shifted' ? 'selected' : '' ?>>Shifted</option>
                                            <option value="Success"
                                                <?= $row['status'] == 'Success' ? 'selected' : '' ?>>Success</option>
                                            <option value="Refunded"
                                                <?= $row['status'] == 'Refunded' ? 'selected' : '' ?>>Refunded</option>
                                            <option value="Cancel" <?= $row['status'] == 'Cancel' ? 'selected' : '' ?>>
                                                Cancel</option>
                                        </select>

                                        <input type="hidden" name="order_item_id" value="<?= $row['order_item_id'] ?>">

                                        <button type="submit" class="btn btn-primary btn-sm" name="updateStatus">
                                            Update Status
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                                }
                            } else { ?>

                            <br><br><br><br>
                            <p class="text-center text-danger" style="font-size: 30px;">No Pending orders
                                found</p>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DataTables init -->
<script>
$(document).ready(function() {
    $('#pendingOrdersTable').DataTable({
        responsive: true,
        order: [
            [0, "desc"]
        ],
        lengthMenu: [3, 5, 10, 25, 30, 50, 80, 100],
        pageLength: 5
    });
});
</script>

<?php require_once('footer.php'); ?>