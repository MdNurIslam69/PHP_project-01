<title><?php echo isset($title) ? $title : "Admin Dashboard | Imran_Store"; ?></title>

<?php
require_once('header.php');
require_once('sidebar.php');

?>



<!-- Right Panel -->

<div id="right-panel" class="right-panel">


    <?php
    require_once('topBar.php');
    ?>

    <div class="breadcrumbs">
        <div class="col-12">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>Dashboard</h1>
                </div>
            </div>
        </div>
    </div>


    <style>
        @media screen and (max-width: 1368px) {
            .adminDashboardIndex {
                margin-left: 5px !important;

            }

        }

        @media screen and (max-width: 576px) {
            .adminDashboardIndex {
                margin-left: 0px !important;

            }

        }
    </style>

    <div class="content mt-3">

        <div class="col-sm-6 col-lg-3">
            <div class="card text-white bg-flat-color-1 adminDashboardIndex">
                <div class="card-body pb-0">
                    <div class="dropdown float-right">
                        <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button"
                            id="dropdownMenuButton1" data-toggle="dropdown">
                            <i class="fa fa-cog"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <div class="dropdown-menu-content">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <h4 class="mb-0">
                        <span class="count">10469</span>
                    </h4>
                    <p class="text-light">Members online</p>

                    <div class="chart-wrapper px-0" style="height:70px;" height="70">
                        <canvas id="widgetChart1"></canvas>
                    </div>

                </div>

            </div>
        </div>
        <!--/.col-->

    </div>
</div>

<!-- Right Panel -->


<?php
require_once('footer.php');
?>