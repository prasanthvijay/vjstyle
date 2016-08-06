<div class="panel panel-color panel-primary">
    <div class="panel-heading">
        <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="panel-title">Add/Edit <?php echo $masterName; ?></h3>
    </div>
    <div class="panel-body">
        <form action="<?php echo $addUserMasterUrl; ?>" method="POST" name="addOrEditUserDetailsForm" id="addOrEditUserDetailsForm" data-parsley-validate novalidate>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="control-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                               placeholder="Name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="usertypeid" class="control-label">User Type</label>
                        <select name="usertypeid" id="usertypeid" class="form-control">
                            <option value="">Select</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email" class="control-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email"
                               placeholder="Email">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password" class="control-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                               placeholder="Password">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="field-4" class="control-label">Mobile</label>
                        <input type="text" class="form-control" id="mobile" name="mobile"
                               placeholder="Mobile">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="doj" class="control-label">Date of Joining</label>
                        <input type="text" class="form-control" id="doj" name="doj"
                               placeholder="DD-MM-YYYY">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="dob" class="control-label">Date of Birth</label>
                        <input type="text" class="form-control" id="dob" name="dob"
                               placeholder="DD-MM-YYYY">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email" class="control-label">Upload Profile Photo</label>
                        <input type="file" class="form-control" id="profilephoto"
                               name="profilephoto">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group no-margin">
                        <label for="address" class="control-label">Address</label>
                                            <textarea class="form-control autogrow" id="address" name="address"
                                                      placeholder="Address"
                                                      style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;"></textarea>
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