<?php if ($type == 'productQyt') { ?>

    <div class="form-group" id="ajaxDivInner<?php echo $count; ?>">
        <label class="col-sm-3 control-label">Map Product <?php echo $count; ?></label>

        <div class="col-sm-3">

            <select class="select2 form-control" id="ShowroomId<?php echo $count; ?>" name="ShowroomId[]">
                <option value="">Select ShowRoom</option>
                <?php for ($i = 0; $i < count($showRoomArray); $i++) { ?>
                    <option
                        value="<?php echo $showRoomArray[$i]['userid']; ?>"><?php echo $showRoomArray[$i]['name']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-sm-3">
            <input type="text" id="mappedprice[]" name="mappedprice[]" class="form-control" required
                   placeholder="Price"/></div>
        <div class="col-sm-3">
            <input type="text" id="mappedqyt[]" name="mappedqyt[]" class="form-control" required
                   placeholder="Quntity"/></div>

    </div>

    <div id="qytDiv<?php echo $count + 1; ?>"></div>
<?php }
if ($type == 'product') { ?>
    <div class="form-group">
        <label class="col-sm-3 control-label">Select Product</label>
        <div class="col-sm-6">
            <select class="select2 form-control" id="productid" name="productid"
                    onchange="productQtyandPrice(this.value)">
                <option value="">Select Product</option>
                <?php for ($i = 0; $i < count($productListArray); $i++) { ?>
                    <option
                        value="<?php echo $productListArray[$i]['productid'] ?>"><?php echo $productListArray[$i]['productname'] ?></option>
                <?php } ?>

            </select>
            <input type="hidden" id="showroomId" name="showroomId" value="<?php echo $showroomId; ?>"
        </div>
    </div>
<?php }
if ($type == 'productQtyandPrice') { ?>

    <div class="form-group">
        <label class="col-sm-3 control-label">Avalable Quantity</label>
        <div class="col-sm-6">

            <input type="text" id="quantity" name="quantity" class="form-control" required readonly
                   placeholder="Avalable Quantity" value="<?php echo $productQytArray[0]['avalableQty']; ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Increment Quantity</label>
        <div class="col-sm-6">
            <input type="text" id="Incquantity" name="Incquantity" class="form-control" required
                   placeholder="Increment Quantity"/>
        </div>
    </div></div>

    <div class="form-group">
        <label class="col-sm-3 control-label">Avalable Price</label>
        <div class="col-sm-6">
            <input type="text" id="price" name="price" class="form-control"
                   value="<?php echo $productQytArray[0]['price']; ?>" required  placeholder="Avalable Price"/>
        </div>
    </div>

<?php } ?>
