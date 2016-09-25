<?php
/**
 * Created by IntelliJ IDEA.
 * User: jonam
 * Date: 5/9/16
 * Time: 8:59 AM
 */

?>
<?php if ($sendOTP == 1) { ?>
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="form-group">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <div class="panel panel-color panel-primary">
                            <div class="panel-heading">
                                <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">
                                </button>
                                <h3 class="panel-title">Forgot Password</h3>
                            </div>
                            <div class="panel-body">
                                <form action="<?php echo base_url(); ?>Frontend/forgotPassword"
                                      method="POST"
                                      name="addOrEditUserDetailsForm" enctype="multipart/form-data"
                                      id="addOrEditUserDetailsForm"
                                      data-parsley-validate novalidate>
                                    <?php echo $sendResponseMessage; ?>
                                    <div class="form-group">
                                    <div class="row">
                                            <label class="col-sm-3 control-label">Enter OTP</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="otptext" name="otptext"
                                                       parsley-trigger="change" required placeholder="OTP">
                                                <input type="hidden" class="form-control" id="email" name="email"
                                                       parsley-trigger="change" value="<?php echo $emailId; ?>" required placeholder="OTP">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <div class="row">
                                            <label class="col-sm-3 control-label">Enter New Password</label>
                                            <div class="col-sm-6">
                                                <input type="email" class="form-control" id="newPassword"
                                                       name="newPassword"
                                                       parsley-trigger="change" required placeholder="New Password">
                                                <input type="hidden" class="form-control" id="sendOTP" name="sendOTP"
                                                       value="2"
                                                       parsley-trigger="change" required placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-b-0">
                                        <div class="col-sm-offset-3 col-sm-9 m-t-15">
                                            <button type="submit" value="Forgot Password" id="submit" name="submit"
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
                    </div>
                    </div>
                </div>
        </div>
    </div>
<?php } else if ($sendOTP == 0) { ?>

            <div class="panel panel-color panel-primary">
                <div class="panel-heading">
                    <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="panel-title">Forgot Password</h3>
                </div>
                <div class="panel-body">
                    <form onsubmit="alertTree()" action="<?php echo base_url(); ?>Frontend/forgotPassword" method="POST"
                          name="addOrEditUserDetailsForm" enctype="multipart/form-data" id="addOrEditUserDetailsForm"
                          data-parsley-validate novalidate>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Email Id</label>
                                <div class="col-sm-6">
                                    <input type="email" class="form-control" id="emailId" name="emailId"
                                           parsley-trigger="change" required placeholder="">
                                    <input type="hidden" class="form-control" id="sendOTP" name="sendOTP" value="1"
                                           parsley-trigger="change" required placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-b-0">
                            <div class="col-sm-offset-3 col-sm-9 m-t-15">
                                <button type="submit" value="Forgot Password" id="submit" name="submit"
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

<?php } else { ?>


<?php } ?>
<script>
    $("#addOrEditUserDetailsForm").parsley();
</script>