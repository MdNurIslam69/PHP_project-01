<?php
$title = "All Orders | Imran_Store";
require_once('header.php');
require_once('sidebar.php');


if (isset($_POST['updateStatus'])) {

    $order_item_id = $_POST['order_item_id'];
    $status = $_POST['status'];
    $updateQuery = "UPDATE `order_items` SET `status` = '$status' WHERE `id` = '$order_item_id'";
    if ($conn->query($updateQuery) === TRUE) {
        echo "<script>toastr.success('Status updated successfully!');</script>";
    } else {
        echo "<script>toastr.error('Status update failed');</script>";
    }
}



// select all from orders item where status is pending
$query = "
SELECT order_items.id as order_item_id, order_items.*, orders.*, products.name AS product_name, products.images, users.name AS user_name 
FROM order_items 
INNER JOIN orders ON order_items.order_id = orders.id 
INNER JOIN products ON order_items.product_id = products.id 
INNER JOIN users ON orders.user_id = users.id 
WHERE order_items.status != 'pending' AND order_items.status = 'refunded'
";


$result = $conn->query($query);

?>


<div id="right-panel" class="right-panel">

    <?php require_once('topBar.php'); ?>

    <div class="">
        <div class="col-12 mt-4">
            <h1 class=" mb-5 mt-3 text-primary text-center" style="text-decoration: underline; font-size: 40px;">
                Refunded
                Orders
            </h1>

            <div class="page-header float-left">
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

                                        <td class="text-center align-middle" style="border: 1px solid black"><?= $row['name'] ?>
                                        </td>

                                        <td class=" align-middle" style="border: 1px solid black">
                                            <?= $row['product_name'] ?></td>

                                        <td class="text-center align-middle p-0" style="border: 1px solid black"><img
                                                src="../assets/img/products/<?= $row['images'] ?>" alt="<?= $row['name'] ?>"
                                                style="max-width: 60%;"></td>

                                        <td class="text-center align-middle" style="border: 1px solid black">
                                            <?= $row['quantity'] ?></td>

                                        <td class="text-center align-middle"
                                            style="border: 1px solid black;  font-weight: bold;">
                                            <i class="fa-solid fa-bangladeshi-taka-sign pe-1 fw-bold"> </i>
                                            <?= number_format($row['sub_total'], 2) ?>
                                        </td>

                                        <td class="text-center align-middle p-3" style="border: 1px solid black">
                                            <?= date('F j, Y, g:i a', strtotime($row['created_at'])) ?></td>

                                        <td class="text-center align-middle" style="border: 1px solid black">
                                            <?= $row['status'] ?></td>

                                        <td class=" align-middle" style="border: 1px solid black">
                                            <?= $row['address'] ?></td>

                                        <td class="text-center align-middle" style="border: 1px solid black">
                                            <?= $row['payment_method'] ?></td>

                                        <td class="text-center align-middle" style="border: 1px solid black">


                                            <form action="" method="POST">
                                                <!-- select option 'Pending','Cancel','Shifted','Success','Refunded' -->
                                                <select name="status" id="status" class="form-select mb-2" required>
                                                    <option value="Pending"
                                                        <?= $row['status'] == 'Pending' ? 'selected' : '' ?>>
                                                        Pending</option>
                                                    <option value="Shifted"
                                                        <?= $row['status'] == 'Shifted' ? 'selected' : '' ?>>
                                                        Shifted</option>
                                                    <option value="Success"
                                                        <?= $row['status'] == 'Success' ? 'selected' : '' ?>>
                                                        Success</option>
                                                    <option value="Refunded"
                                                        <?= $row['status'] == 'Refunded' ? 'selected' : '' ?>>
                                                        Refunded</option>
                                                    <option value="Cancel" <?= $row['status'] == 'Cancel' ? 'selected' : '' ?>>
                                                        Cancel</option>
                                                </select>

                                                <input type="hidden" name="order_item_id" value="<?= $row['order_item_id'] ?>">


                                                <button type="submit" class="btn btn-primary btn-sm" name="updateStatus">Update
                                                    Status</button>
                                            </form>

                                        </td>
                                    </tr>


                            <?php
                                }
                            } else {
                                echo "<p>No pending orders found</p>";
                            }
                            ?>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- pendingOrdersTable -->
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