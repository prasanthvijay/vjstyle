<?php
$subcategory = "";
$categorytypeid = "";
if($actionType == "Edit"){
    if(count($singleSubCategoryList)>0){
        $subcategory = $singleSubCategoryList[0]['subcategory'];
        $categorytypeid = $singleSubCategoryList[0]['categorytypeid'];
    }
}
?>

<div class="panel panel-color panel-primary">
    <div class="panel-heading">
        <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="panel-title">Add/Edit <?php echo $title; ?></h3>
    </div>
    <div class="panel-body">
        <form action="<?php echo $addProductMasterUrl; ?>" method="POST" name="addOrEditUserDetailsForm"
              enctype="multipart/form-data" id="addOrEditUserDetailsForm" data-parsley-validate novalidate>

            <div class="form-group">
                <div class="row">
                <label class="col-sm-3 control-label">Category Type</label>
                <div class="col-sm-6">
                    <select class="select2 form-control" id="categorytypeid" name="categorytypeid" required data-parsley-name="CategoryType" onchange="getSubCategoryList()">
                        <option value="">Select Category Type</option>
                        <?php for ($i = 0; $i < count($CategoryTypeArray); $i++) { ?>
                            <option value="<?php echo $CategoryTypeArray[$i]['categorytypeid']; ?>" <?php if($categorytypeid == $CategoryTypeArray[$i]['categorytypeid']) { echo "selected"; } ?>><?php echo $CategoryTypeArray[$i]['categorytype']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                <label class="col-sm-3 control-label">Sub Category</label>
                <div class="col-sm-6">
                    <input type="hidden" name="actionType" id="actionType" value="<?php echo $actionType; ?>">
                    <input type="hidden" name="actionId" id="actionId" value="<?php echo $actionId; ?>">
                    <input type="text" class="form-control" id="subCategory" name="subCategory" parsley-trigger="change" required placeholder="Enter Sub Category" value="<?php echo $subcategory; ?>"/>
                </div>
                </div>
            </div>

            <br>

            <div class="form-group m-b-0">
                <div class="col-sm-offset-3 col-sm-9 m-t-15">
                    <button type="submit" value="Sub Category" id="submit" name="submit"
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
