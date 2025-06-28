<style>
@media screen and (max-width: 1750px) {
    .TopbarHeader {
        padding-left: 20px !important;
    }
}

@media screen and (max-width: 575px) {
    .TopbarHeader {
        padding-left: 10px !important;
    }
}
</style>


<!-- Header-->
<header id="header" class="header TopbarHeader">

    <div class="header-menu">

        <div class="col-sm-7">
            <a id="menuToggle" class="menutoggle pull-left d-flex justify-content-center align-items-center"><i
                    class="fa fa fa-tasks"></i></a>

            <div class="header-left bg-secondary rounded" style="margin-top: 7px !important;">

                <button class="search-trigger text-white"><i class="fa fa-search"></i></button>
                <div class="form-inline">
                    <form class="search-form">
                        <input class="form-control bg-info text-white border border-5 border-warning rounded"
                            type="text" placeholder="Search ..." aria-label="Search">
                        <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                    </form>
                </div>


            </div>
        </div>

        <div class="col-sm-5">
            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="user-avatar rounded-circle" style="width: 50px; height: 50px; object-fit: cover;"
                        src=" <?= isset($_SESSION['imran_store']['picture']) ? "../" . $_SESSION['imran_store']['picture'] : "../assets/img/demo-profile-picture.jpg" ?>"
                        alt="User Avatar">
                </a>

                <div class="user-menu dropdown-menu">
                    <a class="nav-link" href="#"><i class="fa fa-user"></i> My Profile</a>

                    <a class="nav-link" href="#"><i class="fa fa-user"></i> Notifications <span
                            class="count">13</span></a>

                    <a class="nav-link" href="#"><i class="fa fa-cog"></i> Settings</a>

                    <a class="nav-link" href="#"><i class="fa fa-power-off"></i> Logout</a>
                </div>
            </div>


        </div>
    </div>

</header><!-- /header -->
<!-- Header-->