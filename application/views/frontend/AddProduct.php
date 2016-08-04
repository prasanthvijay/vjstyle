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
                        <div class="card-box">
                            <form class="form-horizontal group-border-dashed" action="<?php echo $addProductMasterUrl; ?>" method="POST">

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Product Name</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="productname" name="productname" required data-parsley-name="name" placeholder="Product Name" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Brand Name</label>
                                            <div class="col-sm-6">
                                                <select class="select2 form-control" >
							<option value="">Select Brand</option>
						<?php for($i=0;$i<count($BrandArray);$i++){ ?>
				                    <option value="<?php echo $BrandArray[$i]['brandid']; ?>"><?php echo $BrandArray[$i]['brandname']; ?></option>
				             			<?php } ?>
						 </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Bar Code</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control"  id="barcode" name="barcode" required data-parsley-length="[5,10]" placeholder="Bar code between 5 - 10 chars length" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Size</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="size" name="size" class="form-control" required data-parsley-name="name" placeholder="Product size" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Product Quantity</label>
                                            <div class="col-sm-6">
                                                <input type="text"  id="quantity" name="quantity" class="form-control" required  placeholder="Product Quantity" />
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="col-sm-3 control-label">Price</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="price" name="price" class="form-control" required  placeholder="Product Price" />
                                            </div>
                                        </div>
										 
                                        <!--<div class="form-group">
                                            <label class="col-sm-3 control-label">Min check</label>
                                            <div class="col-sm-6">
                                                <div class="checkbox checkbox-pink">
                                                    <input id="checkbox1" type="checkbox" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                                    <label for="checkbox1"> And this </label>
                                                </div>
                                                <div class="checkbox checkbox-pink">
                                                    <input id="checkbox2" type="checkbox" data-parsley-multiple="groups" data-parsley-mincheck="2">
                                                    <label for="checkbox2"> Can't check this </label>
                                                </div>
                                                <div class="checkbox checkbox-pink">
                                                    <input id="checkbox3" type="checkbox" data-parsley-multiple="groups" data-parsley-mincheck="2" required>
                                                    <label for="checkbox3"> This too </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Max check</label>
                                            <div class="col-sm-6">
                                                <div class="checkbox checkbox-pink">
                                                    <input id="checkbox4" type="checkbox" data-parsley-multiple="group1">
                                                    <label for="checkbox4"> And this </label>
                                                </div>
                                                <div class="checkbox checkbox-pink">
                                                    <input id="checkbox5" type="checkbox" data-parsley-multiple="group1">
                                                    <label for="checkbox5"> Can't check this </label>
                                                </div>
                                                <div class="checkbox checkbox-pink">
                                                    <input id="checkbox6" type="checkbox" data-parsley-multiple="group1" data-parsley-maxcheck="1">
                                                    <label for="checkbox6"> This too </label>
                                                </div>

                                            </div>
                                        </div>-->

                                        <div class="form-group m-b-0">
                                            <div class="col-sm-offset-3 col-sm-9 m-t-15">
                                                <button type="submit" value="product" id="submit" name="submit" class="btn btn-primary waves-effect waves-light">
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
