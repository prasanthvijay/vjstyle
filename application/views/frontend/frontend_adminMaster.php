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
					<p class="text-muted m-b-20 font-13">
						Add, Edit and Delete Admin
					</p>

					<div id="panel-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
						<div class="modal-dialog">
							<div class="modal-content p-0 b-0">
								<div class="panel panel-color panel-primary">
									<div class="panel-heading">
										<button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button>
										<h3 class="panel-title">Add/Edit Admin</h3>
									</div>
									<div class="panel-body">
										<form action="<?php echo $addUserMasterUrl; ?>" method="POST" data-parsley-validate novalidate >
											<input type="text" class="form-control" id="fromUrl" name="fromUrl" placeholder="fromUrl" value="<?php echo $fromUrl; ?>">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label for="name" class="control-label">Name</label>
														<input type="text" class="form-control" required id="name" name="name" placeholder="Name">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="usertypeid" class="control-label">User Type</label>
														<select name="usertypeid" required id="usertypeid" class="form-control ">
															<?php for($k=0; $k<count($userTypeArray); $k++) { ?>
																<option value="<?php echo $userTypeArray[$k]['usertypeid']; ?>"><?php echo $userTypeArray[$k]['usertype']; ?></option>
															<?php } ?>
														</select>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label for="email" class="control-label">Email</label>
														<input type="text" class="form-control" required parsley-type="email" id="email" name="email" placeholder="Email">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="password" class="control-label">Password</label>
														<input type="password" class="form-control" id="password" name="password" required placeholder="Password">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label for="field-4" class="control-label">Mobile</label>
														<input  data-parsley-type="number" type="text" class="form-control" required id="mobile" name="mobile" placeholder="Mobile">
													</div>
												</div>
												<div class="col-md-4"> 
													<div class="form-group">
														<label for="doj" class="control-label">Date of Joining</label>
 <div class="input-group"><input type="text" class="form-control datepicker-autoclose" placeholder="DD/MM/YYYY"  name="doj" id="doj"><span class="input-group-addon bg-primary b-0 text-white"><i class="ion-calendar"></i></span></div>													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="dob" class="control-label">Date of Birth</label>
														 <div class="input-group"><input type="text" class="form-control datepicker-autoclose" placeholder="DD/MM/YYYY"  name="dob" id="dob"><span class="input-group-addon bg-primary b-0 text-white"><i class="ion-calendar"></i></span></div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label for="email" class="control-label">Upload Profile Photo</label>
														<input  type="file" class="form-control" id="profilephoto" name="profilephoto" >
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group no-margin">
														<label for="address" class="control-label">Address</label>
														<textarea required class="form-control autogrow" id="address" name="address" placeholder="Address" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;"></textarea>
													</div>
												</div>
											</div>

											<div class="row">
											<div class="col-md-6">
												<div class="form-group">
												</div>
											</div>
											<div class="col-md-6">
													<div class="form-group text-right m-b-0">
														<button class="btn btn-primary waves-effect waves-light" type="submit">
															Submit
														</button>
														<button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
															Cancel
														</button>
													</div>
											</div>
										</div>
										</form>
									</div>
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->


					<button class="btn btn-primary waves-effect waves-light m-t-10" data-toggle="modal" data-target="#panel-modal">Add Admin</button>
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
		<?php include_once "innerFooter.php"; ?>
		<!-- End Footer -->

	</div> <!-- end container -->
</div>
<!-- End wrapper -->



<!-- Custom Modal -->
<div id="custom-modal" class="modal-demo">
	<button type="button" class="close" onclick="Custombox.close();">
		<span>&times;</span><span class="sr-only">Close</span>
	</button>
	<h4 class="custom-modal-title">Modal title</h4>
	<div class="custom-modal-text">
		Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
	</div>
</div>
<script>
	var postUrl = "Frontend/getUserListDetails";
	var postData = "usertypeid=2";
	var displayDiv = "usersListDiv";
	loadUsersListDetails(postUrl, postData, displayDiv);
//	loadUsersEditDetails(postUrl, postData, displayDiv);


</script>
