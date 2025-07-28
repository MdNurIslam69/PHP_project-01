<?php
$title = "My Orders | Imran_Store";
require_once './components/header.php';
?>

<div class="container mb-5" data-aos="fade-up" data-aos-duration="1000">

    <!-- my orders -->
    <h2 class="forSame-color text-center my-5 text-decoration-underline">My Orders</h2>

    <div class="row">
        <?php
        // Fetch user's orders from the database
        $userId = $_SESSION['imran_store']['id'];
        $orderQuery = "SELECT * FROM orders WHERE user_id = $userId ORDER BY created_at DESC";
        $ordersResult = $conn->query($orderQuery);

        if ($ordersResult->num_rows > 0):
            while ($order = $ordersResult->fetch_assoc()):
        ?>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">
                        <span class="fw-bold text-decoration-underline">Order ID:</span>
                        <?= $order['id'] ?>
                    </h5>
                    <p class="card-text pb-3">
                        <span class="fw-bold text-decoration-underline">Total Amount:</span>
                        <i class="fa-solid fa-bangladeshi-taka-sign ps-1 text-muted"></i>
                        <?= number_format($order['total']) ?>
                    </p>
                    <a href="order-details.php?id=<?= $order['id'] ?>" class="btn btn-primary viewDetailsBtnsSingle1">
                        View Details
                    </a>
                </div>
            </div>
        </div>
        <?php
            endwhile;
        else:
            ?>
        <div class="col-12 text-center">
            <p class="text-muted fs-4">No order found.</p>
        </div>
        <?php
        endif;
        ?>
    </div>

    <div class="text-center">
        <a href="./" class="btn text-white viewDetailsBtnsSingle1" style="background-color: #7b6eec;">
            <i class="fa-solid fa-arrow-left"></i> Back to Home
        </a>
    </div>

</div>



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
require_once './components/footer.php';
?>