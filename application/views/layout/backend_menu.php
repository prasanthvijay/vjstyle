<!-- Navbar Start -->
<div class="navbar-custom">
    <div class="container">
        <div id="navigation">
            <!-- Navigation Menu-->

          <?php if($_SESSION['usertypeid']=="2"){ ?>
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
                            <li><a href="SizeMaster">Size Master</a></li>
                            <li><a href="AddProduct">Add Product </a></li>
                            <li><a href="ProductList">Product List </a></li>
                            <li><a href="MapProduct">Map Product </a></li>
                    </ul>
                    </li>

                 <li class="has-submenu">
                         <a href="#"><i class="md md-folder-special"></i>Sales </a>
                         <ul class="submenu">
                             <li><a href="adminMaster"> Toady Report</a></li>
                             <li><a href="sellerMaster">Month Report </a></li>
                                                        
                </ul>
                </li>
                </ul>
           <?php } if($_SESSION['usertypeid']=="5") { ?>
		
                <ul class="navigation-menu">
                    <li class="has-submenu active">
                        <a href="dashboard"><i class="md md-dashboard"></i>Dashboard</a>
                    </li>
 			<li class="has-submenu">
                        <a href="pos"><i class="md md-pages"></i>Point of Sales </a>
                       
                    </li>
                    <li class="has-submenu">
                        <a href="#"><i class="md md-pages"></i>Return </a>
                        <ul class="submenu">
                            <li><a href="returnpos">Return Product </a></li>
                            <li><a href="retailerShowRoomMaster">Return List </a></li>
                          </ul>
                    </li>
                 
                </ul>
          <?php } ?>
            <!-- End navigation menu -->
        </div>
    </div>
</div>
</header>
<!-- End Navigation Bar-->


