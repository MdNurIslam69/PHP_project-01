<nav class="navbar navbar-expand-lg bg-primary-subtle navbar-dark ">
    <div class="container ">

        <a class="navbar-brand" href="#">
            <img src="assets/img/myIcon.png" alt="Logo" max-width="50" height="50"
                class="d-inline-block align-text-top rounded">
        </a>




        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link  me-4 <?= $pageName == 'index.php' ? 'active' : null ?>" aria-current="page"
                        href="index.php">Home</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link me-4" href="">Shop</a>
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link me-4" href="contact-us.php">Contact us</a>
                    </a>
                </li>


                <?php
                if (!isset($_SESSION['link3Tech'])) { ?>

                    <li class="nav-item">
                        <a class="nav-link me-4 <?= $pageName == 'sign-in.php' ? 'active' : null ?>" href="sign-in.php">Sign
                            In</a>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link me-4 <?= $pageName == 'sign-up.php' ? 'active' : null ?>" href="sign-up.php">Sign
                            Up</a>
                        </a>
                    </li>

                <?php } else { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle me-4" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">

                            <?php
                            $fullNameArray = explode(" ", $_SESSION['link3Tech']['name']);
                            echo $fullNameArray[1];
                            ?>
                        </a>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="my-profile.php">My Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>


                            <li><a class="dropdown-item" href="change-password.php">Change Password</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>


                            <li><a class="dropdown-item" href="change-profile-picture.php">Change Profile Picture</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>


                            <?php if ($_SESSION['link3Tech']['role'] == 'admin') { ?>
                                <li><a class="dropdown-item" href="admin-panel">Admin Panel</a></li>
                            <?php } ?>


                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="logout.php">Log out</a></li>
                        </ul>
                    </li>
                <?php } ?>

            </ul>


            <form class="m-1">
                <div class="input-group">

                    <input type="text" class="form-control rounded-end-0" placeholder="Search...">

                    <button class="input-group-text rounded-start-0 btn btn-info " id="basic-addon1">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</nav>