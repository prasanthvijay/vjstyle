<?php
    if(count($productArray)>0){
        $productName = $productArray[0]['productname'];
        $productrate = $productArray[0]['productrate'];
        $barcode = $productArray[0]['barcode'];
        $productsize = $productArray[0]['productsize'];
        $brandid = $productArray[0]['brandid'];
        $categorytypeid = $productArray[0]['categorytypeid'];
    }
?>
<div class="panel panel-color panel-primary">
    <div class="panel-heading">
        <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="panel-title">Edit Product</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal group-border-dashed" action="<?php echo $addProductMasterUrl; ?>" method="POST" name="addOrEditUserDetailsForm" id="addOrEditUserDetailsForm" data-parsley-validate novalidate>
            <input type="hidden" name="actionType" id="actionType" value="<?php echo $actionType; ?>">
            <input type="hidden" name="actionId" id="actionId" value="<?php echo $actionId; ?>">
            <div class="form-group">
                <label class="col-sm-3 control-label">Category Type</label>
                <div class="col-sm-6">
                    <select class="select2 form-control" id="categorytypeid" name="categorytypeid" required data-parsley-name="CategoryType">
                        <option value="">Select Category Type</option>
                        <?php for ($i = 0; $i < count($CategoryTypeArray); $i++) { ?>
                            <option
                                value="<?php echo $CategoryTypeArray[$i]['categorytypeid']; ?>" <?php if($categorytypeid == $CategoryTypeArray[$i]['categorytypeid']) { echo "selected"; } ?>><?php echo $CategoryTypeArray[$i]['categorytype']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Product Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="productname" name="productname" required
                           data-parsley-name="name" placeholder="Product Name" value="<?php echo $productName; ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Brand Name</label>
                <div class="col-sm-6">
                    <select class="select2 form-control" id="brandname" name="brandname">
                        <option value="">Select Brand</option>
                        <?php for ($i = 0; $i < count($BrandArray); $i++) { ?>
                            <option value="<?php echo $BrandArray[$i]['brandid']; ?>" <?php if($brandid==$BrandArray[$i]['brandid']){ echo 'selected'; } ?>><?php echo $BrandArray[$i]['brandname']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Bar Code</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="barcode" name="barcode" required
                           data-parsley-length="[5,10]" placeholder="Bar code between 5 - 10 chars length" value="<?php echo $barcode; ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Size</label>
                <div class="col-sm-6">
                    <select class="select2 form-control" id="size" name="size">
                        <option value="">Select Size</option>
                        <?php for ($j = 0; $j < count($SizeArray); $j++) { ?>
                            <option value="<?php echo $SizeArray[$j]['sizeid']; ?>" <?php if($productsize==$SizeArray[$j]['sizeid']){ echo 'selected'; } ?>><?php echo $SizeArray[$j]['size']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <!--                        <div class="form-group">-->
            <!--                            <label class="col-sm-3 control-label">Product Quantity</label>-->
            <!--                            <div class="col-sm-6">-->
            <!--                                <input type="text" id="quantity" name="quantity" class="form-control" required-->
            <!--                                       placeholder="Product Quantity"/>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <div class="form-group">
                <label class="col-sm-3 control-label">Price</label>
                <div class="col-sm-6">
                    <input type="text" id="price" name="price" class="form-control" required
                           placeholder="Product Price" value="<?php echo $productrate; ?>"/>
                </div>
            </div>
            <div class="form-group m-b-0">
                <div class="col-sm-offset-3 col-sm-9 m-t-15">
                    <button type="submit" value="Product" id="submit" name="submit"
                            class="btn btn-primary waves-effect waves-light">
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