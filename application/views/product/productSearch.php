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
        <input type="text" name="showroomId" id="showroomId" value="<?php echo $showroomId; ?>">
    <?php } ?>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label class="control-label">Category Type</label>
            </div>
            <div class="col-md-6">
                <select class="select2 form-control" id="categorytypeid" name="categorytypeid">
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
                <input type="text" name="barcode" id="barcode" value="<?php echo $barcode; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6">
                <input type="button" name="productSearchButton" id="productSearchButton" value="Product Search" class="btn btn-info waves-effect waves-light m-t-10">
            </div>
        </div>
    </div>
</form>
