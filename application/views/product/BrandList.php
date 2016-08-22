<?php  if($typeList=='brandList'){ ?>
   <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap example" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Sno</th>
                                        <th>Brand Name</th>
					 <th>Edit</th>
					 <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
				<?php for($i=0;$i<count($BrandList);$i++){ ?>
                                    <tr>
					
                                        <td><?php echo $i+1; ?></td>
					<td><?php echo $BrandList[$i]['brandname']; ?></td>
                                       <td><button class="btn btn-primary waves-effect waves-light" type="button" >
                    Edit
                </button></td>
					<td><button class="btn btn-danger waves-effect waves-light" type="button" >
                    Delete
                </button></td>
                                     </tr>
                                    	<?php } ?>
                                </tbody>
                            </table>

<?php } ?>

<?php if($typeList=='sizeList'){ ?>

   <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap example" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Sno</th>
                                        <th>Brand Name</th>
					 <th>Edit</th>
					 <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
				<?php for($i=0;$i<count($SizeList);$i++){ ?>
                                    <tr>
					
                                        <td><?php echo $i+1; ?></td>
					<td><?php echo $SizeList[$i]['size']; ?></td>
                                       <td><button class="btn btn-primary waves-effect waves-light" type="button" >
                    Edit
                </button></td>
					<td><button class="btn btn-danger waves-effect waves-light" type="button" >
                    Delete
                </button></td>
                                     </tr>
                                    	<?php } ?>
                                </tbody>
                            </table>

<?php } ?>
