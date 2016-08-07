<!-- =======================
     ===== START PAGE ======
     ======================= -->

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
                        <div class="table-responsive">
                            <p class="text-muted m-b-20 font-13">
                                Add, Edit and Delete Retailer Show Room
                            </p>
                            <button class="btn btn-primary waves-effect waves-light m-t-10" onclick="loadAddOrEditContentWithModal('getAddOrEditUserMasterContent','usertypeid=4','modalContentArea')">Add Retailer Show Room</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <div id="usersListDiv"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End row -->
        <div id="panel-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content p-0 b-0" id="modalContentArea">

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


        <footer class="footer text-right">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        2016 © Minton.
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer -->

    </div> <!-- end container -->
</div>
<!-- End wrapper -->

<script>
    var postUrl = "Frontend/getUserListDetails";
    var postData = "usertypeid=3";
    var displayDiv = "usersListDiv";
    loadUsersListDetails(postUrl, postData, displayDiv);
</script>