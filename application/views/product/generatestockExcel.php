<!-- =======================
     ===== START PAGE ======
     ======================= -->

<div class="wrapper">
    <div class="container">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="page-title"><?php echo $title; ?></h4>
            </div>
        </div>
        <!-- Page-Title -->
        <!-- Custom Modals -->
        <div class="card-box">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <p class="text-muted m-b-20 font-13">
                                Add, Edit and Delete 
                            </p>
                                                   </div>
			<table>
				<th>Categroy</th>
				<th>avalableQty</th>
				<th>Amount</th>
				
			<?php
				$arra=array_merge_recursive($subcategoryArray,$ProductList);
			 for($i=0;$i<count($subcategoryArray);$i++){
					$subcategory[$i]="";
					$avalableQty[$i]="";
					$retailerMRP[$i]="";
					for($j=0;$j<count($ProductList);$j++){
						if($subcategoryArray[$i]['subcategoryid']==$ProductList[$j]['subcategoryid']){
							$avalableQty[$i].=$ProductList[$j]['avalableQty'].',';
							$subcategory[$i].=$ProductList[$j]['subcategory'].',';
							$retailerMRP[$i].=$ProductList[$j]['avalableQty'] * $ProductList[$j]['retailerMRP'].',';
							
						}
						
					} 
					//echo $retailerMRP[$i]."<br>";			
					?>
					<tr>
					<td><?php echo $subcategoryArray[$i]['subcategory']; ?></td>
					<?php $avalableQty[$i]=explode(",",rtrim($avalableQty[$i],','));
					 $finalavalableQty= array_sum($avalableQty[$i]); 
					$retailerMRP[$i]=explode(",",rtrim($retailerMRP[$i],','));
					 $amount= array_sum($retailerMRP[$i]); ?>
					<td><?php echo $finalavalableQty; ?></td>
					<td><?php echo $amount; ?></td>
					</tr>

			<?php 	} ?>
				
			</table>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <div id="msgDiv"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <div id="usersListDiv"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End row -->

        <!-- End Footer -->
        <?php include_once "innerFooter.php"; ?>
    </div> <!-- end container -->
</div>
<!-- End wrapper -->

