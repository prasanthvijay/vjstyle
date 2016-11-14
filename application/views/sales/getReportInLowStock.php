<table id="datatable-responsive-new" class="table table-striped table-bordered dt-responsive nowrap example" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>S.NO</th>
					<th>Product Name</th>
					<th>Price</th>
					<th>Barcode</th>
					<th>Quantity</th>
					</tr>
			</thead>
			<tbody>
				 <?php for ($i = 0; $i < count($lowStockproductArray); $i++) { ?>
				<?php  if($lowStockproductArray[$i]['quantity']<5){ ?><tr>
					
					<td><?php echo $i+1; ?></td>
					<td><?php echo $lowStockproductArray[$i]['productname']; ?></td>
					<td><?php echo $lowStockproductArray[$i]['price']; ?></td>
					<td><?php echo $lowStockproductArray[$i]['barcode']; ?></td>
					<td><?php echo $lowStockproductArray[$i]['quantity']; ?></td>
					
				</tr><?php } ?>
				<?php } ?>
			</tbody>
		</table>
