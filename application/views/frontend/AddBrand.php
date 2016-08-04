<div class="wrapper">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title"><?php  echo $title; ?></h4>
						
		
                    </div>
                </div>
                <!-- Page-Title -->


                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <form class="form-horizontal group-border-dashed" action="<?php echo $addProductMasterUrl; ?>" method="POST">

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Brand Name</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="brandname" name="brandname" required data-parsley-name="name" placeholder="Brand Name" />
                                            </div>
                                        </div>
                                             <div class="form-group m-b-0">
                                            <div class="col-sm-offset-3 col-sm-9 m-t-15">
                                                <button type="submit" value="brand" id="submit" name="submit" class="btn btn-primary waves-effect waves-light">
                                                    Submit
                                                </button>
                                                <button type="reset" class="btn btn-default waves-effect m-l-5">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                        </div>
                    </div>
                </div>
