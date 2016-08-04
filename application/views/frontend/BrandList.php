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
                                        <th>Brand Name</th>
                                    </tr>
                                </thead>
                                <tbody>
				<?php for($i=0;$i<count($BrandList);$i++){ ?>
                                    <tr>
					
                                        <td><?php echo $i+1; ?></td>
					<td><?php echo $BrandList[$i]['brandname']; ?></td>
                                       
                                     </tr>
                                    	<?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                </div>
</div>
