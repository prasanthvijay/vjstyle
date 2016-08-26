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
                                            <label class="col-sm-3 control-label">Product Name</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="productname" name="productname" required data-parsley-name="name" placeholder="Product Name" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Brand Name</label>
                                            <div class="col-sm-6">
                                                <select class="select2 form-control" id="brandname" name="brandname">
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
						<select class="select2 form-control" id="size" name="size">
							<option value="">Select Size</option>
						<?php for($j=0;$j<count($SizeArray);$j++){ ?>
				                    <option value="<?php echo $SizeArray[$j]['sizeid']; ?>"><?php echo $SizeArray[$j]['size']; ?></option>
				             			<?php } ?>
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
                                            <label class="col-sm-3 control-label">Price</label>
                                            <div class="col-sm-6">
                                                <input type="text" id="price" name="price" class="form-control" required  placeholder="Product Price" />
                                            </div>
                                        </div>
					<div class="form-group">
                                            <label class="col-sm-3 control-label">Select Showroom</label>
                                            <div class="col-sm-8">
						<div class="checkbox checkbox-purple">
						<?php for($i=0;$i<count($showroomArray);$i++){ ?>
						<input value="<?php echo $showroomArray[$i]['userid']; ?>" id="showroom<?php echo $i; ?>"  class="showroom" type="checkbox" >
						<label ><?php echo $showroomArray[$i]['name']; ?></label>
                                       <div id="qytDiv"></div>
						<?php } ?>
						</div>
	                                  </div>
                                        </div>				 
                                       <div id="qytDiv"></div>
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

<script>

$(function() {
	var i=0;
        $('.showroom').click(function() {
	var value=$('#showroom'+i).val();
	$.get("getContent",{userid: value,type: "productQyt"},function(data){
	$('#qytDiv'+i).html(data);
    });
        });
    });
</script>
