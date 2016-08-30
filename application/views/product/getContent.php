<?php if ($type == 'productQyt') { ?>

    <div class="form-group" id="ajaxDivInner<?php echo $count; ?>">
        <label class="col-sm-3 control-label">Select Showroom<?php echo $count; ?></label>

        <div class="col-sm-2">

            <select class="select2 form-control" id="ShowroomId<?php echo $count; ?>" name="ShowroomId[]">
                <option value="">Select ShowRoom</option>
                <?php for ($i = 0; $i < count($showRoomArray); $i++) { ?>
                    <option
                        value="<?php echo $showRoomArray[$i]['userid']; ?>"><?php echo $showRoomArray[$i]['name']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-sm-2">
            <input type="text" id="mappedprice[]" name="mappedprice[]" class="form-control" required
                   placeholder="Product Price"/></div>
        <div class="col-sm-2">
            <input type="text" id="mappedqyt[]" name="mappedqyt[]" class="form-control" required
                   placeholder="Product quntity"/></div>

    </div>

    <div id="qytDiv<?php echo $count + 1; ?>"></div>
<?php } ?>
