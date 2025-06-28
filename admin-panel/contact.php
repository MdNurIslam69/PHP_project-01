<?php
require_once("./header.php");
require_once("./sidebar.php");

$sql = "SELECT * FROM `contact-us_form`";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    echo "<script>toastr.info('No contact messages found.');</script>";
}
?>

<div id="right-panel" class="right-panel">

    <?php require_once('./topBar.php') ?>



    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h1 class="mb-5 mt-3 text-primary text-center" style="text-decoration: underline; font-size: 40px;">
                    Contact Messages</h1>

                <table class="table border table-bordered table-striped mb-4" id="contactTable"
                    style="border: 2px solid black !important;">

                    <thead>
                        <tr class="bg-info text-white">
                            <th class="text-center align-middle" style="border: 2px solid black">S.N</th>
                            <th class="text-center align-middle" style="border: 2px solid black">Name</th>
                            <th class="text-center align-middle" style="border: 2px solid black">Email</th>
                            <th class="text-center align-middle" style="border: 2px solid black">Phone</th>
                            <th class="text-center align-middle" style="border: 2px solid black">Message</th>
                            <th class="text-center align-middle" style="border: 2px solid black">Date</th>
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
                                    <?= $row['name'] ?></td>

                                <td class="text-center align-middle" style="border: 1px solid black">
                                    <?= $row['email'] ?></td>

                                <td class="text-center align-middle" style="border: 1px solid black">
                                    <?= $row['phone'] ?></td>

                                <td class="align-middle" style="border: 1px solid black">
                                    <?= $row['message'] ?></td>

                                <td class="text-center align-middle p-3" style="border: 1px solid black">
                                    <?= date('F j, Y, g:i a', strtotime($row['create_at'])) ?>
                                </td>


                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('#contactTable').DataTable({
            responsive: true,
            order: [
                [0, "desc"]
            ],
            lengthMenu: [3, 5, 10, 25, 30, 50, 80, 100],
            pageLength: 10
        });
    });
</script>

<?php
require_once("./footer.php");
?>