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
								Add, Edit and Delete Sales Head
							</p>
							<button class="btn btn-primary waves-effect waves-light m-t-10" onclick="loadAddOrEditContentWithModal('getAddOrEditUserMasterContent','usertypeid=4','modalContentArea')">Add Sales Head</button>
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
		<div id="panel-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog">
				<div class="modal-content p-0 b-0" id="modalContentArea">

				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->


		<?php include_once "innerFooter.php"; ?>
		<!-- End Footer -->

	</div> <!-- end container -->
</div>
<!-- End wrapper -->

<script>
	var postUrl = "Frontend/getUserListDetails";
	var postData = "usertypeid=4";
	var displayDiv = "usersListDiv";
	loadUsersListDetails(postUrl, postData, displayDiv);
	function deleteUsers(userid, adminid) {
		var approve = confirm("Are you sure to delete!");
		if(approve){
			var postDataDelete = "userid="+userid+"&adminid="+adminid;
			$.ajax({
				url: "Frontend/deleteUsersFromMaster",
				type: "POST",
				data: postDataDelete,
				success: function (responseFromSite) {
					$.Notification.notify('success','top right', 'Delete Sales Head', 'Sales Head was successfully Deleted ');
					loadUsersListDetails(postUrl, postData, displayDiv);
				}
			});
		}
	}

	function getRetailerShowRooms(){
		var adminid = $("#adminid").val();
		var usertypeid = "4";
		var formData = "adminid="+adminid+"&usertypeid="+usertypeid;
		$.ajax({
			url : "getRetailerShowRoomDetails",
			type : "post",
			data : formData,
			success : function(response){
				alert(response);
			}
		});
		}
</script>