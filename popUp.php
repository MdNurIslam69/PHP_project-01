<?php
$title = "My Orders | Imran_Store";
require_once './components/header.php';
?>



<!-- this internal css for popUp/modal -->
<style>
.popUp-img {
    width: 100%;
    max-height: 400px;
}


.offer-content {
    background-color: rgb(209, 248, 250);
}

.offer-content h1 {
    font-family: "Agu Display", serif;
    font-size: 3rem;
    margin: 20px;
    text-align: end;
    padding-top: 7px;

}

.offer-content h3 {
    font-size: 1.5rem;
    text-decoration: underline;
    text-align: start;
    transform: rotate(-20deg);
    margin: 0px;
    margin-top: -30px;
    margin-left: -3px;
}


/* responsive title */
@media screen and (max-width: 500px) {
    .offer-content h3 {
        font-size: 1.4rem;
    }

    .offer-content h1 {
        font-size: 2.9rem;
    }
}

@media screen and (max-width: 480px) {
    .offer-content h3 {
        font-size: 1.3rem;
    }

    .offer-content h1 {
        font-size: 2.6rem;
    }

}

@media screen and (max-width: 440px) {
    .offer-content h3 {
        font-size: 1.2rem;
        margin-top: -26px;
        margin-left: -3px;
    }

    .offer-content h1 {
        font-size: 2.4rem;
    }

}

@media screen and (max-width: 410px) {
    .offer-content h3 {
        font-size: 1rem;
        margin-top: -25px;
        margin-left: -3px;
    }

    .offer-content h1 {
        font-size: 2rem;
        padding-top: 10px;
    }

}

@media screen and (max-width: 392px) {
    .offer-content h3 {
        font-size: 0.9rem;
        margin-top: -25px;
        margin-left: -3px;
    }

    .offer-content h1 {
        font-size: 2rem;
        padding-top: 10px;
    }

}

@media screen and (max-width: 365px) {
    .offer-content h3 {
        font-size: 0.9rem;
        margin-top: -20px;
        margin-left: -3px;
    }

    .offer-content h1 {
        font-size: 2rem;
        padding-top: 10px;
    }

}
</style>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <!-- Centered -->
        <div class="modal-content border-2 border-danger">
            <div class="modal-header align-content-center p-2">
                <img src="assets/img/myIcon.png" alt="shop icon" class="img-fluid" style="max-width: 15%;">

                <button type="button" class="btn-close pt-0 h3 text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <div class="modal-body p-0 ">
                <img src="assets/img/popUp.jpg" alt="popUp img" class="popUp-img">
            </div>

            <div class="offer-content">
                <h3>USE COUPON</h3>
                <h1>SUMMER1500</h1>
            </div>

            <div class="modal-footer p-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="./" type="button" class="btn btn-primary">Save changes</a>
            </div>
        </div>
    </div>
</div>



<!-- Auto show modal after 3 seconds -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
        myModal.show();
    }, 1000);
});
</script>




<?php require_once './components/footer.php'; ?>