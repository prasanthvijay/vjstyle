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
                            <form class="form-horizontal group-border-dashed" action="" method="POST">

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Product Name</label>
                                            <div class="col-sm-6">
                                              <select class="select2 form-control" id="brandname" name="brandname">
							<option value="">Select Product</option>
						
				                    <option value=""></option>
				             			
						 </select>
                                            </div>
                                        </div>
                                        
                                       
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Product Quantity</label>
                                            <div class="col-sm-6">
                                                <input type="text"  id="quantity" name="quantity" class="form-control" required  placeholder="Product Quantity" />
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="col-sm-3 control-label">Actual Price</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="price" name="price" class="form-control" required  placeholder="Product Price" />
                                            </div>
                                        </div>
						 <div class="form-group">
                                            <label class="col-sm-3 control-label">Select Showroom</label>
                                            <div class="col-sm-6">
                                              <select class="select2 form-control" id="brandname" name="brandname">
							<option value="">Select Showroom</option>
						
				                    <option value=""></option>
				             			
						 </select>
                                            </div>
                                        </div>				 
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Mapped Price</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="price" name="price" class="form-control" required  placeholder="Product Price" />
                                            </div>
                                        </div>

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
