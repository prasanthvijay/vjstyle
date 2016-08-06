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
							<button class="btn btn-primary waves-effect waves-light m-t-10" data-toggle="modal" data-target="#panel-modal">Add Retailer Show Room</button>
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
<div id="panel-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
						<div class="modal-dialog">
							<div class="modal-content p-0 b-0">
								<div class="panel panel-color panel-primary">
									<div class="panel-heading">
										<button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button>
										<h3 class="panel-title">Add/Edit Retailer Show Room</h3>
									</div>
									<div class="panel-body">
										<form action="<?php echo $addUserMasterUrl; ?>" method="POST" data-parsley-validate novalidate>
											<input type="text" class="form-control" id="fromUrl" name="fromUrl" placeholder="fromUrl" value="<?php echo $fromUrl; ?>">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label for="name" class="control-label">Name</label>
														<input type="text" class="form-control" id="name" name="name" placeholder="Name">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="usertypeid" class="control-label">User Type</label>
														<select name="usertypeid" id="usertypeid" class="form-control">
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
														<input type="text" class="form-control" id="email" name="email" placeholder="Email">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="password" class="control-label">Password</label>
														<input type="password" class="form-control" id="password" name="password" placeholder="Password">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label for="field-4" class="control-label">Mobile</label>
														<input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="doj" class="control-label">Date of Joining</label>
														<input type="text" class="form-control" id="doj" name="doj" placeholder="DD-MM-YYYY">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="dob" class="control-label">Date of Birth</label>
														<input type="text" class="form-control" id="dob" name="dob" placeholder="DD-MM-YYYY">
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label for="email" class="control-label">Upload Profile Photo</label>
														<input type="file" class="form-control" id="profilephoto" name="profilephoto" >
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group no-margin">
														<label for="address" class="control-label">Address</label>
														<textarea class="form-control autogrow" id="address" name="address" placeholder="Address" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;"></textarea>
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
//	loadUsersEditDetails(postUrl, postData, displayDiv);


</script>