<nav class="navbar navbar-expand-lg bg-primary-subtle navbar-dark ">
    <div class="container  p-lg-0 p-md-0 p-sm-2">

        <a class="navbar-brand" href="./">
            <img src="assets/img/myIcon.png" alt="Logo" max-width="50" height="50"
                class="d-inline-block align-text-top rounded">
        </a>



        <button class="navbar-toggler border-3 text-white " type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span><i class="fa-solid fa-bars opacity-75" style="font-size: 25px;"></i></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link  me-4 <?= $pageName == 'index.php' ? 'active' : null ?>" aria-current="page"
                        href="./">Home</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link me-4 <?= $pageName == 'shop.php' || $pageName == 'category.php' ? 'active' : null ?>"
                        href="shop">Shop</a>

                </li>


                <li class="nav-item">
                    <a class="nav-link me-4 <?= $pageName == 'contact-us.php' ? 'active' : null ?>"
                        href="contact-us">Contact us</a>

                </li>


                <?php
                if (!isset($_SESSION['imran_store'])) { ?>

                <li class="nav-item">
                    <a class="nav-link me-4 <?= $pageName == 'sign-in.php' ? 'active' : null ?>" href="sign-in">Sign
                        In</a>

                </li>


                <li class="nav-item">
                    <a class="nav-link me-4 <?= $pageName == 'sign-up.php' ? 'active' : null ?>" href="sign-up">Sign
                        Up</a>

                </li>

                <?php } else { ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle me-4 <?= $pageName == 'my-profile.php' || $pageName == 'change-password.php' || $pageName == 'change-profile-picture.php' || $pageName == 'my-orders.php' || $pageName == '../admin-panel' ? 'active' : null ?>"
                        href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                        <?php
                            $fullNameArray = explode(" ", $_SESSION['imran_store']['name']);
                            echo $fullNameArray[1];
                            ?>
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item <?= $pageName == 'my-profile.php' ? 'active' : null ?>"
                                href="my-profile">My Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>


                        <li><a class="dropdown-item <?= $pageName == 'change-password.php' ? 'active' : null ?>"
                                href="change-password">Change Password</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>


                        <li><a class="dropdown-item <?= $pageName == 'change-profile-picture.php' ? 'active' : null ?>"
                                href="change-profile-picture">Change Profile Picture</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>


                        <li><a class="dropdown-item <?= $pageName == 'my-orders.php' ? 'active' : null ?>"
                                href="my-orders">My Orders</a></li>



                        <?php if ($_SESSION['imran_store']['role'] == 'admin') { ?>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li><a class="dropdown-item <?= $pageName == 'admin-panel.php' ? 'active' : null ?>"
                                href="admin-panel">Admin Panel</a></li>
                        <?php } ?>


                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item <?= $pageName == 'logout.php' ? 'active' : null ?>"
                                href="logout">Log out</a></li>
                    </ul>
                </li>
                <?php } ?>


                <!-- add to cart -->
                <li class="nav-item me-2">
                    <a class="nav-link me-2 position-relative <?= $pageName == 'cart.php' ? 'active' : null ?>"
                        href="cart">

                        <i class="fa-solid fa-cart-shopping"></i>

                        <span
                            class="badge bg-danger position-absolute top-0 start-100 translate-middle-x rounded-circle">
                            <?php
                            if (isset($_SESSION['cart'])) {
                                $total = 0;
                                foreach ($_SESSION['cart'] as $key => $value) {
                                    $total += $value;
                                }
                                echo $total;
                            } else {
                                echo 0;
                            }
                            ?>
                        </span>
                    </a>
                </li>


            </ul>


            <form class="m-1" method="get" action="search.php">
                <div class="input-group">

                    <input type="text" class="form-control rounded-end-0" placeholder="Search..." name="query">

                    <button class="input-group-text rounded-start-0 btn btn-info " id="basic-addon1">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</nav>