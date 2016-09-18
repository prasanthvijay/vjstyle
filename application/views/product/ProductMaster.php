<div class="wrapper">
    <div class="container">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="page-title"><?php echo $title; ?> Master</h4>
            </div>
        </div>
        <!-- Page-Title -->

        <div class="card-box">

            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <p class="text-muted m-b-20 font-13">
                                Add, Edit and Delete Product
                            </p>
                            <?php $loadAddOrEditModalUrl = base_url() . "Product/AddOrEditMasterContent"; ?>
                            <button class="btn btn-primary waves-effect waves-light m-t-10"
                                    onclick="getAddOrEditModalContent('actionType=Add&actionId=0&masterName=<?php echo $title; ?>', '<?php echo $loadAddOrEditModalUrl; ?>')">
                                Add <?php echo $title; ?></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <div id="msgDiv"></div>
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
        <div id="panel-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content p-0 b-0" id="modalContentArea">

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <?php include_once "innerFooter.php"; ?>
    </div>
</div>

<input type="hidden" id="count" name="count" value="1">

<script>
    var postData = "type=ProductList";

    loadMastersList(postData);
</script>
