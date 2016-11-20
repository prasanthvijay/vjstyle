<?php
$size = "";
if($actionType == "Edit"){
    if(count($singleMaintenancList)>0){
        $size = $singleSizeList[0]['size'];
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

            <div class="form-group ">
                <label class="col-sm-offset-1 col-sm-3 control-label">Reason</label>
                <div class="col-sm-6">
                    <input type="hidden" name="actionType" id="actionType" value="<?php echo $actionType; ?>">
                    <input type="hidden" name="actionId" id="actionId" value="<?php echo $actionId; ?>">
                    <input type="text" class="form-control" id="Reason" name="Reason" parsley-trigger="change" required placeholder="Enter Reason" value="<?php echo $size; ?>"/>
                </div>
            </div>

            <br>

<br> <div class="form-group ">
                <label class="col-sm-offset-1 col-sm-3 control-label">Amount</label>
                <div class="col-sm-6">
                    
                    <input type="text" class="form-control" id="Amount" name="Amount" parsley-trigger="change" required placeholder="Enter Reason" value="<?php echo $size; ?>"/>
                </div>
            </div>
 <br>  <br>
<div class="form-group ">
                <label class="col-sm-offset-1 col-sm-3 control-label">Paid Date</label>
                <div class="col-sm-6">
                   <div class="input-group">
                                <input type="text" class="form-control datepicker-autoclose" value="" placeholder="DD-MM-YYYY" name="Date" id="Date">
                                <span class="input-group-addon bg-primary b-0 text-white">
                                    <i class="ion-calendar"></i>
                                </span>
                            </div>
                </div>
            </div> <br>
            <div class="form-group m-b-0">
                <div class="col-sm-offset-3 col-sm-9 m-t-15">
                    <button type="submit" value="Maintenance" id="submit" name="submit"
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

