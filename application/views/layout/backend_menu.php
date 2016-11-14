<!-- Navbar Start -->
<div class="navbar-custom">
    <div class="container">
        <div id="navigation">
            <!-- Navigation Menu-->

            <?php if ($_SESSION['usertypeid'] == "2" || $_SESSION['usertypeid'] == "1") { ?>
                <ul class="navigation-menu">
                    <li class="has-submenu active">
                        <a href="dashboard"><i class="md md-dashboard"></i>Dashboard</a>
                    </li>
                    <li class="has-submenu">
                        <a href="#"><i class="md md-account-box"></i>Users </a>
                        <ul class="submenu">
                            <?php if ($_SESSION['usertypeid'] == "1") { ?>
                                <li><a href="<?php echo base_url(); ?>Frontend/adminMaster">Admin </a></li>
                            <?php } ?>
                            <li><a href="<?php echo base_url(); ?>Frontend/retailerShowRoomMaster">Retailer Show
                                    Room </a></li>
                            <li><a href="<?php echo base_url(); ?>Frontend/salesHeadMaster">Sales Head </a></li>
                            <li><a href="<?php echo base_url(); ?>Frontend/salesExecutiveMaster">Sales Executive </a></li>
                            <li><a href="<?php echo base_url(); ?>Frontend/supplierMaster">Supplier Master </a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a href="#"><i class="md md-pages"></i>Masters </a>
                        <ul class="submenu">
                            <li><a href="<?php echo base_url(); ?>Product/CategoryTypeMaster">Category Type </a></li>
                            <li><a href="<?php echo base_url(); ?>Product/SubCategoryMaster">Sub Category </a></li>
                            <li><a href="<?php echo base_url(); ?>Product/BrandMaster">Brand </a></li>
                            <li><a href="<?php echo base_url(); ?>Product/SizeMaster">Size </a></li>
                            <li><a href="<?php echo base_url(); ?>Product/ProductMaster">Product </a></li>
                            <!--                            <li><a href="-->
                            <?php //echo base_url();?><!--Product/AddProduct">Product </a></li>-->
                            <li><a href="<?php echo base_url(); ?>Product/MapProduct">Map Product </a></li>
                        </ul>
                    </li>

                    <li class="has-submenu">
                        <a href="#"><i class="md md-folder-special"></i>Sales </a>
                        <ul class="submenu">
                            <li><a href="<?php echo base_url(); ?>sales/reports/today">Today Report </a></li>
                            <li><a href="<?php echo base_url(); ?>sales/reports/report">All Report </a></li>
                            <li><a href="<?php echo base_url(); ?>lowstockReport">Low Stock Report</a></li>

                        </ul>
                    </li>
                </ul>
            <?php }
            if ($_SESSION['usertypeid'] == "4") { ?>

                <ul class="navigation-menu">
                    <li class="has-submenu active">
                        <a href="<?php echo base_url(); ?>dashboard"><i class="md md-dashboard"></i>Dashboard</a>
                    </li>
                    <li class="has-submenu">
                        <a href="<?php echo base_url(); ?>sales/pos"><i class="md md-pages"></i>Point of Sales </a>

                    </li>
                    <li class="has-submenu">
                        <a href="#"><i class="md md-pages"></i>Masters </a>
                        <ul class="submenu">
                            <li><a href="<?php echo base_url(); ?>Product/CategoryTypeMaster">Category Type </a></li>
                            <li><a href="<?php echo base_url(); ?>Product/SubCategoryMaster">Sub Category </a></li>
                            <li><a href="<?php echo base_url(); ?>Product/BrandMaster">Brand </a></li>
                            <li><a href="<?php echo base_url(); ?>Product/SizeMaster">Size </a></li>
                            <li><a href="<?php echo base_url(); ?>Product/ProductMaster">Product </a></li>
<!--                            <li><a href="--><?php //echo base_url(); ?><!--Product/MapProduct">Map Product </a></li>-->
<!--                            <li><a href="--><?php //echo base_url(); ?><!--Frontend/supplierMaster">Supplier Master </a></li>-->
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a href="#"><i class="md md-pages"></i>Return </a>
                        <ul class="submenu">
                            <li><a href="<?php echo base_url(); ?>/sales/returnpos">Return Product </a></li>
                            <li><a href="<?php echo base_url(); ?>returnList">Return List </a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a href="#"><i class="md md-folder-special"></i>Sales </a>
                        <ul class="submenu">
                            <li><a href="<?php echo base_url(); ?>sales/reports/today">Today Report </a></li>
                            <li><a href="<?php echo base_url(); ?>sales/reports/report">All Report </a></li>
                            <li><a href="<?php echo base_url(); ?>lowstockReport">Low Stock Report</a></li>

                        </ul>
                    </li>                </ul>
            <?php } ?>
            <!-- End navigation menu -->
        </div>
    </div>
</div>
</header>

<!-- End Navigation Bar-->


