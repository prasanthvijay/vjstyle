<!-- Navbar Start -->
<div class="navbar-custom">
    <div class="container">
        <div id="navigation">
            <!-- Navigation Menu-->

          <?php  if($_SESSION['usertype']=="Admin"){ ?>
                <ul class="navigation-menu">
                    <li class="has-submenu active">
                        <a href="dashboard"><i class="md md-dashboard"></i>Dashboard</a>
                    </li>
                    <li class="has-submenu">
                        <a href="#"><i class="md md-pages"></i>Users </a>
                        <ul class="submenu">
                            <li><a href="retailerShowRoomMaster">Retailer Show Room </a></li>
                            <li><a href="salesHeadMaster">Sales Head </a></li>
                            <li><a href="salesExecutiveMaster">Sales Executive </a></li>
                        </ul>
                    </li>
                    <li class="has-submenu">
                        <a href="#"><i class="md md-pages"></i>Product </a>
                        <ul class="submenu">
                            <li><a href="BrandMaster">Brand Master </a></li>
                            <li><a href="AddProduct">Add Product </a></li>
                            <li><a href="ProductList">Product List </a></li>
                            <li><a href="SizeMaster">Size Master</a></li>

                            <!--   <li><a href="retailerShowRoomMaster">Retailer Show Room </a></li>
                                <li><a href="salesExecutiveMaster">Sales Executive </a></li>
                                <li><a href="deliveryPersonMaster">Delivery Person </a></li>-->
                        </ul>
                    </li>

                    <!-- <li class="has-submenu">
                         <a href="#"><i class="md md-folder-special"></i>Extras </a>
                         <ul class="submenu">
                             <li><a href="adminMaster">Admin </a></li>
                             <li><a href="sellerMaster">Seller </a></li>
                             <li><a href="retailerShowRoomMaster">Retailer Show Room </a></li>
                             <li><a href="salesExecutiveMaster">Sales Executive </a></li>
                             <!--                        <li><a href="deliveryPersonMaster">Delivery Person </a></li>-->
                </ul>
                </li>
                </ul>
           <?php } else { ?>
		
                <ul class="navigation-menu">
                    <li class="has-submenu active">
                        <a href="dashboard"><i class="md md-dashboard"></i>Dashboard</a>
                    </li>
                    <li class="has-submenu">
                        <a href="#"><i class="md md-pages"></i>Users </a>
                        <ul class="submenu">
                            <li><a href="adminMaster">Admin </a></li>
                            <li><a href="retailerShowRoomMaster">Retailer Show Room </a></li>
                            <li><a href="salesHeadMaster">Sales Head </a></li>
                            <li><a href="salesExecutiveMaster">Sales Executive </a></li>
                        </ul>
                    </li>
                   <!-- <li class="has-submenu">
                        <a href="#"><i class="md md-pages"></i>Master </a>
                        <ul class="submenu">
                            <li><a href="adminMaster">Admin </a></li>
                            <li><a href="retailerShowRoomMaster">Retailer Show Room </a></li>
                            <li><a href="salesExecutiveMaster">Sales Executive </a></li>
<!--                            <li><a href="deliveryPersonMaster">Delivery Person </a></li>-->
<!--                            <li><a href="sellerMaster">Seller </a></li>
                        </ul>
                    </li>

                    <li class="has-submenu">
                        <a href="#"><i class="md md-folder-special"></i>Extras </a>
                        <ul class="submenu">
                            <li><a href="getUserListDetails">User Details </a></li>
                            <li><a href="sellerMaster">Seller </a></li>
                            <li><a href="retailerShowRoomMaster">Retailer Show Room </a></li>
                            <li><a href="salesExecutiveMaster">Sales Executive </a></li>
                            <!--                        <li><a href="deliveryPersonMaster">Delivery Person </a></li>
                        </ul>
                    </li>-->
                </ul>
          <?php } ?>
            <!-- End navigation menu -->
        </div>
    </div>
</div>
</header>
<!-- End Navigation Bar-->


