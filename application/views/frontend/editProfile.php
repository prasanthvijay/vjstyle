<?php
/**
 * Created by IntelliJ IDEA.
 * User: jonam
 * Date: 28/8/16
 * Time: 7:29 AM
 */

?>
<div class="wrapper">
    <div class="container">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="page-title"><?php echo $title; ?></h4>
            </div>
        </div>
        <!-- Page-Title -->
        <!-- Custom Modals -->
        <div class="card-box">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <div id="msgDiv">
                            <?php echo $succesMsg; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <div id="">
                            <div class="modal-content p-0 b-0" id="modalContentArea">

                            </div><!-- /.modal-content -->
                        </div><!-- /.modal -->

                    </div>
                </div>
            </div>
        </div>
        <!-- End row -->


        <?php include_once "innerFooter.php"; ?>
        <!-- End Footer -->

    </div> <!-- end container -->
</div>
<script>
    loadAddOrEditContentWithModal('getAddOrEditUserMasterContent','usertypeid=<?php echo $usertypeid; ?>&actionType=Edit&titlename=Edit Profile&actionId=<?php echo $userid; ?>','modalContentArea');
</script>
