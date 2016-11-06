<?php
/**
 * Created by IntelliJ IDEA.
 * User: jonam
 * Date: 19/10/16
 * Time: 6:11 AM
 */

echo "echo lowstockReport";

?>
<div class="wrapper">
    <div class="container">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="page-title"><?php echo $title; ?></h4>				
            </div>
        </div>
<?php if($usertypeid=="2") { ?>

			<div class="row form-group">
				<div class="col-sm-3"></div>
					<label class="control-label col-sm-1">Showroom</label>
				        <div class="col-sm-3">
						<select class="select2 form-control" id="showroomId" name="showroomId"
				                required
				                data-parsley-name="subCategory" <?php if($reportsType=="today") { ?>onchange="getSalesReport(this.value)"<?php } ?> >
							<option value="">Select Showroom</option>
							<?php for ($i = 0; $i < count($showRoomList); $i++) { ?>
							<option
							value="<?php echo $showRoomList[$i]['userid']; ?>"><?php echo $showRoomList[$i]['name']; ?></option>
							<?php } ?>
				        	</select>
			        </div>
		    	</div>
<?php } ?>
        <!-- Page-Title -->
        <!-- Custom Modals -->
        <div class="card-box">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <p class="text-muted m-b-20 font-13">
                                View All <?php echo $title; ?>
                            </p>
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
        <!-- End row -->
        
        <!-- End Footer -->
        <?php include_once "innerFooter.php"; ?>
    </div> <!-- end container -->
</div>

<script>

var postUrl = "<?php echo base_url(); ?>sales/getReportInLowStock";
	var postData = "usertypeid=2";
	var displayDiv = "usersListDiv";
	loadUsersListDetails(postUrl, postData, displayDiv);
	var postDataDelete = "userid="+userid+"&adminid="+adminid;
			$.ajax({
				url: deleteUrl,
				type: "POST",
				data: postDataDelete,
				success: function (responseFromSite) {
					$.Notification.notify('success','top right', 'Delete Admin', 'Admin was successfully Deleted ');
					loadUsersListDetails(postUrl, postData, displayDiv);
				}
			});
		
	
</script>

