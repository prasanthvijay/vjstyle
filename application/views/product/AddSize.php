<div class="panel panel-color panel-primary">
    <div class="panel-heading">
        <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="panel-title">Add/Edit <?php echo $title; ?></h3>
    </div>
    <div class="panel-body">
        <form action="<?php echo $addProductMasterUrl; ?>" method="POST" name="addOrEditUserDetailsForm" enctype="multipart/form-data" id="addOrEditUserDetailsForm" data-parsley-validate novalidate>

                      <div class="form-group">
                                            <label class="col-sm-3 control-label">Size</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="size" name="size" required data-parsley-name="name" placeholder="Enter Size" />
                                            </div>
                                        </div>

    <br>

            <div class="form-group m-b-0">
                                            <div class="col-sm-offset-3 col-sm-9 m-t-15">
                                                <button type="submit" value="size" id="submit" name="submit" class="btn btn-primary waves-effect waves-light">
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
