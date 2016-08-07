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
                    <input type="hidden" value="<?php echo $usertypeid; ?>" name="usertypeid" id="usertypeid">
                        <?php if($usertypeid == 5){ ?>
                            <label for="usertypeid" class="control-label">Retailer Show Room</label>
                            <select name="retailershowroomid" id="retailershowroomid" class="form-control ">
                                <?php for($k=0; $k<count($retailerShowRoomList); $k++) { ?>
                                    <option value="<?php echo $retailerShowRoomList[$k]['userid']; ?>"><?php echo $retailerShowRoomList[$k]['name']; ?></option>
                                <?php } ?>
                            </select>
                        <?php } else if($usertypeid == 4){  ?>
                            <label for="field-4" class="control-label">Mobile</label>
                            <input type="text" class="form-control" id="mobile" name="mobile"
                                   placeholder="Mobile">
                        <?php } ?>
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
            <?php if($usertypeid != 4){ ?>
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
                        <div class="input-group"><input type="text"
                                                        class="form-control datepicker-autoclose"
                                                        placeholder="DD-MM-YYYY"
                                                        name="doj" id="doj"><span
                                class="input-group-addon bg-primary b-0 text-white"><i
                                    class="ion-calendar"></i></span></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="dob" class="control-label">Date of Birth</label>
                        <div class="input-group"><input type="text" class="form-control datepicker-autoclose" placeholder="DD-MM-YYYY" name="dob" id="dob"><span class="input-group-addon bg-primary b-0 text-white"><i class="ion-calendar"></i></span></div>
                    </div>
                </div>
            </div>
            <?php } ?>

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