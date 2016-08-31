<?php
/**
 * Created by IntelliJ IDEA.
 * User: jonam
 * Date: 31/8/16
 * Time: 9:45 PM
 */

?>
<div class="panel panel-color panel-primary">
    <div class="panel-heading">
        <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="panel-title"><?php echo $actionType." ".$masterName; ?></h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal group-border-dashed" action="<?php echo $addProductMasterUrl; ?>" method="POST" name="addOrEditUserDetailsForm" id="addOrEditUserDetailsForm" data-parsley-validate novalidate>
            <input type="hidden" name="actionType" id="actionType" value="<?php echo $actionType; ?>">
            <input type="hidden" name="actionId" id="actionId" value="<?php echo $actionId; ?>">
            <input type="hidden" name="masterName" id="masterName" value="<?php echo $masterName; ?>">
            <?php
                $fieldValue = "";
            ?>

            <?php if($masterName == "Category Type") {?>
            <?php } ?>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo $masterName; ?></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="categoryType" name="categoryType" required
                           data-parsley-name="categoryType" placeholder="Category Type" value="<?php echo $fieldValue; ?>"/>
                </div>
            </div>
            <div class="form-group m-b-0">
                <div class="col-sm-offset-3 col-sm-9 m-t-15">
                    <button type="submit" value="<?php echo $masterName; ?>" id="submit" name="submit"
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
