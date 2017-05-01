<?php
/**
 * Created by IntelliJ IDEA.
 * User: jonam
 * Date: 25/9/16
 * Time: 5:21 PM
 */
?>
<form action="" name="productSearchForm" id="productSearchForm">
    <?php if ($showroomId == 0) { ?>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label class="control-label">Show Room</label>
                </div>
                <div class="col-md-6">
                    <select class="select2 form-control" id="showroomId" name="showroomId">
                        <option value="">Select ShowRoom</option>
                        <?php for ($i = 0; $i < count($showroomArray); $i++) { ?>
                            <option
                                value="<?php echo $showroomArray[$i]['userid']; ?>"><?php echo $showroomArray[$i]['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <input type="hidden" name="showroomId" id="showroomId" value="<?php echo $showroomId; ?>">
    <?php } ?>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label class="control-label">Category Type</label>
            </div>
            <div class="col-md-6">
                <select class="select2 form-control" id="categorytypeid" name="categorytypeid" onchange="getSubCategoryList()">
                    <option value="">Select Category Type</option>
                    <?php for ($i = 0; $i < count($CategoryTypeList); $i++) { ?>
                        <option
                            value="<?php echo $CategoryTypeList[$i]['categorytypeid']; ?>"><?php echo $CategoryTypeList[$i]['categorytype']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label class="control-label">Sub Category</label>
            </div>
            <div class="col-md-6" id="subcategorydiv">
                <select class="select2 form-control" id="subcategoryid" name="subcategoryid"
                        required
                        data-parsley-name="subCategory">
                    <option value="">Select Sub Category</option>
                    <?php for ($i = 0; $i < count($subCategoryArray); $i++) { ?>
                        <option
                            value="<?php echo $subCategoryArray[$i]['subcategoryid']; ?>"><?php echo $subCategoryArray[$i]['subcategory']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label class="control-label">Brand</label>
            </div>
            <div class="col-md-6">
                <select class="select2 form-control" id="brandid" name="brandid">
                    <option value="">Select Brand</option>
                    <?php for ($i = 0; $i < count($BrandArray); $i++) { ?>
                        <option
                            value="<?php echo $BrandArray[$i]['brandid']; ?>"><?php echo $BrandArray[$i]['brandname']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label class="control-label">Size</label>
            </div>
            <div class="col-md-6">
                <select class="select2 form-control" id="sizeid" name="sizeid">
                    <option value="">Select Size</option>
                    <?php for ($j = 0; $j < count($SizeList); $j++) { ?>
                        <option
                            value="<?php echo $SizeList[$j]['sizeid']; ?>"><?php echo $SizeList[$j]['size']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label class="control-label">Barcode</label>
            </div>
            <div class="col-md-6">
<!--                <input type="text" name="barcode" id="barcode" value="--><?php //echo $barcode; ?><!--" class="form-control">-->
                <select multiple="multiple" class="multi-select" id="barcode" name="barcode" data-plugin="multiselect" data-placeholder="Choose ...">
                    <?php for ($i = 0; $i < count($ProductArray); $i++) { ?>
                        <option value="<?php echo $ProductArray[$i]['barcode']; ?>"><?php echo $ProductArray[$i]['barcode']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6">
                <input type="button" name="productSearchButton" id="productSearchButton" value="Product Search" class="btn btn-info waves-effect waves-light m-t-10" onclick="searchProductList()">
                <input type="button" name="loadAllProduct" id="loadAllProduct" value="Load All Product" class="btn btn-pink waves-effect waves-light m-t-10" onclick="loadAllProducts()">
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6">
                <button class="btn btn-icon waves-effect waves-light btn-rounded m-b-5" type="button" onclick="generateProductList()">
                    <i class="fa fa-download"></i>&nbsp;Generate Excel
                </button>
		
            </div>
        </div>
    </div>
  <div class="form-group">
        <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6">
                <button class="btn btn-icon btn-warning waves-effect waves-light btn-rounded m-b-5" type="button" onclick="generatestockList()">
                    <i class="fa fa-download"></i>&nbsp;Generate Stock Report
                </button>
		
            </div>
        </div>
    </div>
</form>
