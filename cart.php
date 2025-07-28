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
                    <tr>
                        <th class="text-center bg-secondary text-white align-middle" style="border: 2px solid black;">SL
                        </th>
                        <th class="text-center bg-secondary text-white align-middle"
                            style="border: 2px solid black !important;">
                            Product ID</th>
                        <th class="text-center bg-secondary text-white align-middle"
                            style="border: 2px solid black !important;">
                            Product Image</th>
                        <th class="text-center bg-secondary text-white align-middle"
                            style="border: 2px solid black !important;">
                            Product</th>
                        <th class="text-center bg-secondary text-white align-middle"
                            style="border: 2px solid black !important;">
                            Quantity</th>
                        <th class="text-center bg-secondary text-white align-middle"
                            style="border: 2px solid black !important;">S.
                            Price</th>
                        <th class="text-center bg-secondary text-white align-middle"
                            style="border: 2px solid black !important;">
                            Total</th>
                        <th class="text-center bg-secondary text-white align-middle"
                            style="border: 2px solid black !important;">
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
                                width="80" height="80" class=" object-fit-contain">
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
            <a href="checkout" class="btn btn-primary mb-0 viewDetailsBtnsSingle1">Proceed to
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




<!-- screen chat-bot section start -->
<!--  -->
<div class="chat-bot-container">
    <!-- Social Icons -->
    <div class="social-icons" id="socialIcons">
        <a href="https://www.facebook.com/md.nurislam6" target="_blank" class="btn btn-outline-primary" style="--i:6">
            <i class="fab fa-facebook"></i>
        </a>

        <a href="https://x.com/MdNurIslam21050" target="_blank" class="btn btn-outline-primary" style="--i:6">
            <i class="fab fa-x"></i>
        </a>

        <a href="https://www.instagram.com/md_nur_islam5" target="_blank" class="btn btn-outline-primary" style="--i:6">
            <i class="fab fa-instagram"></i>
        </a>

        <a href="https://www.linkedin.com/in/mdnurislam1" target="_blank" class="btn btn-outline-primary" style="--i:6">
            <i class="fab fa-linkedin"></i>
        </a>

        <a href="https://www.google.com/maps/place/Nurislam+Imran/..." target="_blank" class="btn btn-outline-primary"
            style="--i:5">
            <i class="fas fa-map-marker-alt"></i>
        </a>
        <a href="https://www.facebook.com/messages/t/61561367169765" target="_blank" class="btn btn-outline-primary"
            style="--i:6">
            <i class="fab fa-facebook-messenger"></i>
        </a>


    </div>

    <!-- Chatbot Toggle Button -->
    <div class="chat-bot-toggle" id="chatbotBtn">
        <img src="assets/img/chat-bot.png" alt="chat-bot" width="60" height="60" id="chatbotImage" />
        <span class="close-symbol" id="closeSymbol">&times;</span>
    </div>
</div>

<!-- ✅ Styles -->
<style>
/* Common styles */
.chat-bot img,
.chat-bot-toggle img {
    width: 60px;
    height: 60px;
    display: block;
}

.chat-bot-contact {
    position: fixed;
    bottom: 10px;
    right: 80px;
    z-index: 998;
}

/* Toggle Chatbot styles */
.chat-bot-container {
    position: fixed;
    bottom: 10px;
    right: 10px;
    z-index: 999;
}

.chat-bot-toggle {
    cursor: pointer;
    position: relative;
    width: 60px;
    height: 60px;
}

.close-symbol {
    position: absolute;
    top: 0;
    left: 0;
    width: 65px;
    height: 65px;
    font-size: 36px;
    color: #007bff;
    background-color: transparent;
    border-radius: 50%;
    display: none;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    margin-top: -10px;
}

.chat-bot-toggle.open .close-symbol {
    display: flex;
}

.chat-bot-toggle.open img {
    display: none;
}

.social-icons {
    position: absolute;
    bottom: 70px;
    right: 5px;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 15px;
    pointer-events: none;
}


.social-icons a {
    opacity: 0;
    transform: translateX(30px);
    transition: all 0.3s ease-in-out;
    transition-delay: calc(var(--i) * 0.04s);
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background-color: transparent;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    font-size: 25px;
    color: #6d5af1;
}

.social-icons.show a {
    opacity: 1;
    transform: translateX(0);
    pointer-events: auto;
}

.social-icons a:hover {
    transform: translateX(-10px) scale(1.1);
    background-color: #0070f8;
}
</style>

<!-- ✅ Scrollbar Fix for Modal -->
<style>
html {
    overflow-y: scroll;
}

body.modal-open {
    padding-right: 0 !important;
}
</style>


<!-- chatbot JavaScript section -->
<script>
const chatbotBtn = document.getElementById("chatbotBtn");
const chatbotImage = document.getElementById("chatbotImage");
const closeSymbol = document.getElementById("closeSymbol");
const socialIcons = document.getElementById("socialIcons");

let isOpen = false;

chatbotBtn.addEventListener("click", () => {
    isOpen = !isOpen;

    if (isOpen) {
        socialIcons.classList.add("show");
        chatbotBtn.classList.add("open");
        closeSymbol.style.display = "flex";
        chatbotImage.style.display = "none";
    } else {
        socialIcons.classList.remove("show");
        chatbotBtn.classList.remove("open");
        closeSymbol.style.display = "none";
        chatbotImage.style.display = "block";
    }
});
</script>
<!-- screen chat-bot section end -->




<?php
require_once 'components/footer.php';
?>