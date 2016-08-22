<div class="wrapper">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title"><?php echo $title; ?></h4>
                    </div>
                </div>
                <!-- Page-Title -->



                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">

                                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Sno</th>
                                        <th>Product Name</th>
					<th>Product Rate</th>
					<th>Quantity</th>
					<th>Barcode</th>
					<th>Product Size</th>
					
                                    </tr>
                                </thead>
                                <tbody>
				<?php for($i=0;$i<count($ProductList);$i++){ ?>
                                    <tr>
					
                                        <td><?php echo $i+1; ?></td>
					<td><?php echo $ProductList[$i]['productname']; ?></td>
					<td><?php echo $ProductList[$i]['productrate']; ?></td>
					<td><?php echo $ProductList[$i]['availablequantity']; ?></td>
					<td><?php echo $ProductList[$i]['barcode']; ?></td>
					<td><?php echo $ProductList[$i]['productsize']; ?></td>
                                       
                                     </tr>
                                    	<?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                </div>
</div>
