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
                <li>
                    <a href="index.php" class="font-weight-bold"
                        style=" color: <?= $pageName == "index.php" ? "white !important" : "" ?>">
                        <i class="menu-icon fa-solid fa-house"
                            style="color: <?= $pageName == "index.php" ? "white !important" : "" ?>"></i>Dashboard</a>
                </li>

                <li>
                    <a href="contact.php" class="font-weight-bold"
                        style=" color: <?= $pageName == "contact.php" ? "#ffbe76 !important" : "" ?>">
                        <i class="menu-icon fa-solid fa-envelope"
                            style="color: <?= $pageName == "contact.php" ? "#ffbe76 !important" : "" ?>"></i>Contact
                        Messages</a>
                </li>



                <h3 class="menu-title" style="color: rgba(128, 255, 0, 0.516)">Media Queries</h3>

                <!-- contact info section start -->
                <li
                    class="menu-item-has-children dropdown <?= $pageName == "../contact-us.php" || $pageName == "../social-media.php" ? "show" : null ?>">

                    <a href="#" id="contactInfo" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="<?= $pageName == "../contact-us.php" || $pageName == "../social-media.php" ? true : false ?>">
                        <i class="menu-icon fa-solid fa-address-card"></i>Contact
                        Info</a>
                    <ul
                        class="sub-menu children dropdown-menu <?= $pageName == "../contact-us.php" || $pageName == "../social-media.php" ? "show" : null ?>">

                        <!-- contact info section end -->



                        <!-- basic info -->
                        <li><i class="menu-icon fa-solid fa-address-card"
                                style="color: <?= $pageName == "../contact-us.php" ? "white !important" : "" ?>"></i><a
                                href="../contact-us.php"
                                style="font-weight: <?= $pageName == "../contact-us.php" ? "bold" : "regular" ?>; color: <?= $pageName == "../contact-us.php" ? "white !important" : "" ?>">Basic
                                Info</a>
                        </li>


                        <!-- social media -->
                        <li><i class="menu-icon fa-solid fa-thumbs-up"
                                style="color: <?= $pageName == "../social-media.php" ? "white !important" : "" ?>"></i><a
                                href="../social-media.php"
                                style="font-weight: <?= $pageName == "../social-media.php" ? "bold" : "regular" ?>; color: <?= $pageName == "../social-media.php" ? "white !important" : "" ?>">Social
                                Media</a>
                        </li>
                    </ul>
                </li>


                <h3 class="menu-title" style="color: rgba(128, 255, 0, 0.516)">E-commerce</h3><!-- /.menu-title -->

                <!-- product section -->
                <li
                    class="menu-item-has-children dropdown <?= $pageName == "addNewProduct.php" || $pageName == "allProducts.php" || $pageName == "product-categories.php" ? "show" : null ?>">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="<?= $pageName == "addNewProduct.php" || $pageName == "allProducts.php" || $pageName == "product-categories.php" ? true : false ?>"
                        style="color: <?= $pageName == "addNewProduct.php" || $pageName == "allProducts.php" || $pageName == "product-categories.php" ? "yellow !important" : "" ?>;
                        
                        font-weight: <?= $pageName == "addNewProduct.php" || $pageName == "allProducts.php" || $pageName == "product-categories.php" ? "bold" : "regular" ?>">
                        <i class="menu-icon fa-solid fa-shop"
                            style="color: <?= $pageName == "addNewProduct.php" || $pageName == "allProducts.php" || $pageName == "product-categories.php" ? "yellow !important" : "" ?>"></i>Products</a>
                    <ul
                        class="sub-menu children dropdown-menu <?= $pageName == "addNewProduct.php" || $pageName == "allProducts.php" || $pageName == "product-categories.php" ? "show" : null ?>">

                        <!-- product category -->
                        <li><i class="menu-icon fa-solid fa-table"
                                style="color: <?= $pageName == "product-categories.php" ? "white !important" : "" ?>"></i><a
                                href="product-categories.php"
                                style="font-weight: <?= $pageName == "product-categories.php" ? "bold" : "regular" ?>; color: <?= $pageName == "product-categories.php" ? "white !important" : "" ?>">Products
                                Category</a>
                        </li>

                        <!-- all products -->
                        <li><i class="menu-icon fa-solid fa-list"
                                style="color: <?= $pageName == "allProducts.php" ? "white !important" : "" ?>"></i><a
                                href="allProducts.php"
                                style="font-weight: <?= $pageName == "allProducts.php" ? "bold" : "regular" ?> ; color: <?= $pageName == "allProducts.php" ? "white !important" : "" ?>">All
                                Products</a>
                        </li>


                        <li><i class="menu-icon fa-solid fa-notes-medical"
                                style="color: <?= $pageName == "addNewProduct.php" ? "white !important" : "" ?>"></i><a
                                href="addNewProduct.php"
                                style="font-weight: <?= $pageName == "addNewProduct.php" ? "bold" : "regular" ?> ; color: <?= $pageName == "addNewProduct.php" ? "white !important" : "" ?>">Add
                                New Products</a>
                        </li>
                    </ul>
                </li>


                <!-- order section -->
                <li
                    class="menu-item-has-children dropdown <?= $pageName == "pending-orders.php" || $pageName == "shifted-orders.php" || $pageName == "success-orders.php" || $pageName == "refunded-orders.php" || $pageName == "cancel-orders.php" ? "show" : null ?>; font-weight: <?= $pageName == "pending-orders.php" || $pageName == "shifted-orders.php" || $pageName == "success-orders.php" || $pageName == "refunded-orders.php" || $pageName == "cancel-orders.php" ? "bold" : "regular" ?>">


                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="<?= $pageName == "pending-orders.php" || $pageName == "shifted-orders.php" || $pageName == "success-orders.php" || $pageName == "refunded-orders.php" || $pageName == "cancel-orders.php" ? true : false ?>"
                        style="color: <?= $pageName == "pending-orders.php" || $pageName == "shifted-orders.php" || $pageName == "success-orders.php" || $pageName == "refunded-orders.php" || $pageName == "cancel-orders.php" ? "yellow !important" : "" ?>;
                        
                        font-weight: <?= $pageName == "pending-orders.php" || $pageName == "shifted-orders.php" || $pageName == "success-orders.php" || $pageName == "refunded-orders.php" || $pageName == "cancel-orders.php" ? "bold" : "regular" ?>"><i
                            class="menu-icon fa-solid fa-cart-shopping"
                            style="color: <?= $pageName == "pending-orders.php" || $pageName == "shifted-orders.php" || $pageName == "success-orders.php" || $pageName == "refunded-orders.php" || $pageName == "cancel-orders.php" ? "yellow !important" : "" ?>"></i>Orders</a>

                    <ul
                        class="sub-menu children dropdown-menu <?= $pageName == "pending-orders.php" || $pageName == "shifted-orders.php" || $pageName == "success-orders.php" || $pageName == "refunded-orders.php" || $pageName == "cancel-orders.php" ? "show" : null ?>">

                        <!-- pending orders -->
                        <li><i class="menu-icon fa-solid fa-spinner"
                                style="color: <?= $pageName == "pending-orders.php" ? "white !important" : "" ?>"></i><a
                                href="pending-orders.php"
                                style="font-weight: <?= $pageName == "pending-orders.php" ? "bold" : "regular" ?>; color: <?= $pageName == "pending-orders.php" ? "white !important" : "" ?>">Pending
                                Orders</a>
                        </li>

                        <!-- shifted orders -->
                        <li><i class="menu-icon fa-solid fa-truck-fast"
                                style="color: <?= $pageName == "shifted-orders.php" ? "white !important" : "" ?>"></i><a
                                href="shifted-orders.php"
                                style="font-weight: <?= $pageName == "shifted-orders.php" ? "bold" : "regular" ?>; color: <?= $pageName == "shifted-orders.php" ? "white !important" : "" ?>">Shifted
                                Orders</a>
                        </li>

                        <!-- success orders -->
                        <li><i class="menu-icon fa-solid fa-circle-check"
                                style="color: <?= $pageName == "success-orders.php" ? "white !important" : "" ?>"></i><a
                                href="success-orders.php"
                                style="font-weight: <?= $pageName == "success-orders.php" ? "bold" : "regular" ?>; color: <?= $pageName == "success-orders.php" ? "white !important" : "" ?>">Success
                                Orders</a>
                        </li>

                        <!-- refunded orders -->
                        <li><i class="menu-icon fa-solid fa-arrows-rotate"
                                style="color: <?= $pageName == "refunded-orders.php" ? "white !important" : "" ?>"></i><a
                                href="refunded-orders.php"
                                style="font-weight: <?= $pageName == "refunded-orders.php" ? "bold" : "regular" ?>; color: <?= $pageName == "refunded-orders.php" ? "white !important" : "" ?>">Refunded
                                Orders</a>
                        </li>

                        <!-- refunded orders -->
                        <li><i class="menu-icon fa-solid fa-ban"
                                style="color: <?= $pageName == "cancel-orders.php" ? "white !important" : "" ?>"></i><a
                                href="cancel-orders.php"
                                style="font-weight: <?= $pageName == "cancel-orders.php" ? "bold" : "regular" ?>; color: <?= $pageName == "cancel-orders.php" ? "white !important" : "" ?>">Cancel
                                Orders</a>
                        </li>
                    </ul>
                </li>


            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->

<!-- Left Panel -->




<!-- this js for, contact info section -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const contactInfoLink = document.getElementById("contactInfo");
    const dashboardLink = document.querySelector('a[href="index.php"]');

    if (contactInfoLink && dashboardLink) {
        contactInfoLink.addEventListener("click", function() {
            // Style contactInfo link
            contactInfoLink.style.setProperty("color", "yellow", "important");
            contactInfoLink.style.setProperty("font-weight", "bold", "important");

            // Style the icon inside contactInfo
            const icon = contactInfoLink.querySelector("i");
            if (icon) {
                icon.style.setProperty("color", "yellow", "important");
            }

            // Now make dashboard link red
            dashboardLink.style.setProperty("color", "#c6cad2", "important");

            // Also the icon inside dashboard
            const dashIcon = dashboardLink.querySelector("i");
            if (dashIcon) {
                dashIcon.style.setProperty("color", "#c6cad2", "important");
            }
        });
    }
});
</script>