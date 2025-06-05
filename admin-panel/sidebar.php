<!-- Left Panel -->

<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu"
                aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="../"><img src="images/myIcon.png" class="rounded w-50 h-50 m-3 myIcons-1"
                    alt="Logo"></a>
            <a class="navbar-brand hidden" href="./"><img src="./images/mylogo2.png" alt="Logo"></a>


            <!-- its for admin Dashboard logo responsive -->
            <style>
                .myIcons-1 {
                    @media screen and (max-width: 576px) {
                        width: 50px !important;
                        margin-top: 1px !important;

                    }
                }
            </style>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="./"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                </li>
                <h3 class="menu-title">UI elements</h3><!-- /.menu-title -->
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Slider</a>

                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-puzzle-piece"></i><a href="ui-buttons.html">All Slider</a></li>

                        <li><i class="fa fa-puzzle-piece"></i><a href="ui-buttons.html">All Slider</a></li>


                        <li><i class="fa fa-id-badge"></i><a href="ui-badges.html">Add New Slider</a></li>

                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Contact Info</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-table"></i><a href="tables-basic.html">Basic Info</a></li>
                        <li><i class="fa fa-table"></i><a href="footer.php#footerSection">Social Media</a>
                        </li>
                    </ul>
                </li>


                <h3 class="menu-title">E-commerce</h3><!-- /.menu-title -->

                <li
                    class="menu-item-has-children dropdown <?= $pageName == "addNewProduct.php" || $pageName == "allProducts.php" || $pageName == "product-categories.php" ? "show" : null ?>">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="<?= $pageName == "addNewProduct.php" || $pageName == "allProducts.php" || $pageName == "product-categories.php" ? true : false ?>">
                        <i class="menu-icon fa fa-tasks"></i>Products</a>
                    <ul
                        class="sub-menu children dropdown-menu <?= $pageName == "addNewProduct.php" || $pageName == "allProducts.php" || $pageName == "product-categories.php" ? "show" : null ?>">


                        <li><i class="menu-icon fa fa-fort-awesome"></i><a href="product-categories.php"
                                style="font-weight: <?= $pageName == "product-categories.php" ? "bold" : "regular" ?>">Categories</a>
                        </li>


                        <li><i class="menu-icon fa fa-fort-awesome"></i><a href="allProducts.php"
                                style="font-weight: <?= $pageName == "allProducts.php" ? "bold" : "regular" ?>">All
                                Products</a>
                        </li>


                        <li><i class="menu-icon ti-themify-logo"></i><a href="addNewProduct.php"
                                style="font-weight: <?= $pageName == "addNewProduct.php" ? "bold" : "regular" ?>">Add
                                New Products</a>
                        </li>
                    </ul>
                </li>


                <li
                    class="menu-item-has-children dropdown
                <?= $pageName == "pending-orders.php" || $pageName == "shifted-orders.php" || $pageName == "success-orders.php" || $pageName == "refunded-orders.php" || $pageName == "cancel-orders.php" ? "show" : null ?>">


                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="<?= $pageName == "pending-orders.php" || $pageName == "shifted-orders.php" || $pageName == "success-orders.php" || $pageName == "refunded-orders.php" || $pageName == "cancel-orders.php" ? true : false ?>"><i
                            class="menu-icon fa fa-bar-chart"></i>Orders</a>


                    <ul
                        class="sub-menu children dropdown-menu <?= $pageName == "pending-orders.php" || $pageName == "shifted-orders.php" || $pageName == "success-orders.php" || $pageName == "refunded-orders.php" || $pageName == "cancel-orders.php" ? "show" : null ?>">

                        <li><i class="menu-icon fa fa-area-chart"></i><a href="pending-orders.php"
                                style="font-weight: <?= $pageName == "pending-orders.php" ? "bold" : "regular" ?>">Pending
                                Orders</a>
                        </li>

                        <li><i class="menu-icon fa fa-pie-chart"></i><a href="shifted-orders.php"
                                style="font-weight: <?= $pageName == "shifted-orders.php" ? "bold" : "regular" ?>">Shifted
                                Orders</a>
                        </li>

                        <li><i class="menu-icon fa fa-pie-chart"></i><a href="success-orders.php"
                                style="font-weight: <?= $pageName == "success-orders.php" ? "bold" : "regular" ?>">Success
                                Orders</a>
                        </li>

                        <li><i class="menu-icon fa fa-pie-chart"></i><a href="refunded-orders.php"
                                style="font-weight: <?= $pageName == "refunded-orders.php" ? "bold" : "regular" ?>">Refunded
                                Orders</a>
                        </li>

                        <li><i class="menu-icon fa fa-pie-chart"></i><a href="cancel-orders.php"
                                style="font-weight: <?= $pageName == "cancel-orders.php" ? "bold" : "regular" ?>">Cancel
                                Orders</a>
                        </li>
                    </ul>
                </li>


            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->

<!-- Left Panel -->