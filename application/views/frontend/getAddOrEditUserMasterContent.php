<?php
//    print_r($editUsersList);
$name = "";
$mobile = "";
$email = "";
$address = "";
$password = "";
$retailershowroomid = "";
$doj = "";
$dob = "";
$adminid = "";
$CINNumber = "";
$TINNumber = "";
$BankName = "";
$IFSCode = "";
$AccountNumber = "";
if(count($editUsersList)>0){
    $name = $editUsersList[0]['name'];
    $adminid = $editUsersList[0]['adminid'];
    $mobile = $editUsersList[0]['mobile'];
    $email = $editUsersList[0]['email'];
    $address = $editUsersList[0]['address'];
    $password = $editUsersList[0]['password'];
    $retailershowroomid = $editUsersList[0]['retailerShowRoomId'];
    $dob = $this->users_model->convertDDMMYYtoYYMMDD($editUsersList[0]['dob']);
    $doj = $this->users_model->convertDDMMYYtoYYMMDD($editUsersList[0]['doj']);

    $CINNumber = $editUsersList[0]['cinnumber'];
    $TINNumber = $editUsersList[0]['tinnumber'];
    $BankName = $editUsersList[0]['BankName'];
    $IFSCode = $editUsersList[0]['IFSCode'];
    $AccountNumber = $editUsersList[0]['AccountNumber'];

}

?>

<div class="panel panel-color panel-primary">
    <div class="panel-heading">
        <button type="button" class="close m-t-5" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="panel-title"><?php if($titlename == "Edit Profile") { echo $titlename; } else { ?>Add/Edit <?php echo $masterName; } ?></h3>
    </div>
    <div class="panel-body">
        <form action="<?php echo base_url(); ?>Frontend/addUserMaster" method="POST" name="addOrEditUserDetailsForm" enctype="multipart/form-data" id="addOrEditUserDetailsForm"  data-parsley-validate novalidate>
            <input type="hidden" name="actionId" id="actionId" value="<?php echo $actionId; ?>">
            <input type="hidden" name="actionType" id="actionType" value="<?php echo $actionType; ?>">
            <input type="hidden" name="titlename" id="titlename" value="<?php echo $titlename; ?>">
            <?php if($sessionUserTypeId == 1 && $usertypeid !=1 && $usertypeid !=2){ ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dob" class="control-label">Admin</label>
                            <select name="adminid" id="adminid" parsley-trigger="change" required class="form-control " onchange="getRetailerShowRooms();">
                                <option value="">Select</option>
                                <?php for($k=0; $k<count($adminList); $k++) { ?>
                                    <option value="<?php echo $adminList[$k]['userid']; ?>" <?php if($adminid == $adminList[$k]['userid']){ echo "selected"; }?>><?php echo $adminList[$k]['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="control-label"><?php if($usertypeid == 3){ ?>Show Room Name<?php } else echo "Name"; ?></label>
                        <input type="text" class="form-control" id="name" name="name" parsley-trigger="change" required placeholder="<?php if($usertypeid == 3){ ?>Show Room Name<?php } else echo "Name"; ?>" value="<?php echo $name; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="hidden" value="<?php echo $usertypeid; ?>" name="usertypeid" id="usertypeid">
                        <?php if($usertypeid == 4 || $usertypeid == 5){ ?>
                            <label for="usertypeid" class="control-label">Retailer Show Room</label>
                            <div id="retailershowroomidDiv"><select name="retailershowroomid" id="retailershowroomid" class="form-control" parsley-trigger="change" required>
                                <option value="">Select</option>
                                <?php for($k=0; $k<count($retailerShowRoomList); $k++) { ?>
                                    <option value="<?php echo $retailerShowRoomList[$k]['userid']; ?>" <?php if($retailershowroomid==$retailerShowRoomList[$k]['userid']){ echo "selected"; } ?>><?php echo $retailerShowRoomList[$k]['name']; ?></option>
                                <?php } ?>
                            </select>
                                </div>
                        <?php } else if($usertypeid == 3 || $usertypeid == 6){  ?>
                            <label for="field-4" class="control-label">Contact Number</label>
<!--                            <label for="field-4" class="control-label">--><?php //if($usertypeid == 3){ ?><!--Show Room Number--><?php //} else echo "Mobile"; ?><!--</label>-->
                            <input type="text" class="form-control" id="mobile" name="mobile" parsley-trigger="change" required placeholder="Contact Number" value="<?php echo $mobile; ?>">
<!--                            <input type="text" class="form-control" id="mobile" name="mobile" parsley-trigger="change" required placeholder="--><?php //if($usertypeid == 3){ ?><!--Show Room Number--><?php //} else echo "Mobile"; ?><!--" value="--><?php //echo $mobile; ?><!--">-->
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php if($usertypeid != 3 && $usertypeid != 6){ ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
<!--                        <label for="email" class="control-label">--><?php //if($usertypeid == 3){ ?><!--Show Room ID--><?php //} else echo "Email"; ?><!--</label>-->
                        <label for="email" class="control-label">Email ID</label>
<!--                        <input type="text" class="form-control" id="email" name="email" parsley-trigger="change" required placeholder="--><?php //if($usertypeid == 3){ ?><!--Show Room ID--><?php //} else echo "Email"; ?><!--" value="--><?php //echo $email; ?><!--">-->
                        <input type="text" class="form-control" id="email" name="email" parsley-trigger="change" required placeholder="Email ID" value="<?php echo $email; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password" class="control-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" parsley-trigger="change" required placeholder="Password" value="<?php echo $password; ?>">
                    </div>
                </div>
            </div>
           
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-4" class="control-label">Mobile</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" parsley-trigger="change" required placeholder="Mobile" value="<?php echo $mobile; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="doj" class="control-label">Date of Joining</label>
                            <div class="input-group">
                                <input type="text" class="form-control datepicker-autoclose" value="<?php if($doj!='' && $doj!='00-00-0000' && $doj!='0000-00-00') { echo $doj; } ?>" placeholder="DD-MM-YYYY" name="doj" id="doj">
                                <span class="input-group-addon bg-primary b-0 text-white">
                                    <i class="ion-calendar"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="dob" class="control-label">Date of Birth</label>
                            <div class="input-group"><input type="text" class="form-control datepicker-autoclose" value="<?php if($dob!='' && $dob!='00-00-0000' && $dob!='0000-00-00') { echo $dob; } ?>" placeholder="DD-MM-YYYY" name="dob" id="dob"><span class="input-group-addon bg-primary b-0 text-white"><i class="ion-calendar"></i></span></div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if($usertypeid == 3 || $usertypeid == 6){ ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" class="control-label">Email ID</label>
                            <input type="text" class="form-control" id="email" name="email" parsley-trigger="change" required placeholder="Email ID" value="<?php echo $email; ?>">
                        </div>
                    </div>
                    <?php if($usertypeid == 6) { ?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="BankName" class="control-label">Supplier Bank Name</label>
                            <input type="text" class="form-control" id="bankname" name="bankname"  placeholder="Bank Name" value="<?php echo $BankName; ?>">
                        </div>
                    </div>
<div class="col-md-6">
                        <div class="form-group">
                            <label for="IFSCode" class="control-label">IFS Code</label>
                            <input type="text" class="form-control" id="ifscode" name="ifscode"  placeholder="IFS Code" value="<?php echo $IFSCode; ?>">
                        </div>
                    </div>
<div class="col-md-6">
                        <div class="form-group">
                            <label for="AccountNumber" class="control-label">Account No</label>
                            <input type="text" class="form-control" id="accountno" name="accountno"  placeholder="Account No" value="<?php echo $AccountNumber; ?>">
                        </div>
                    </div>
                    <?php } else { ?>	
                        <div class="col-md-6">
                            <div class="form-group fileupload">
                                <label for=""></label>
                                <!--                        <input type="file" class="form-control" id="profilephoto" name="profilephoto" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;">-->
                                <div class=" btn btn-rounded btn-default waves-effect waves-light" style="width: 100%">
                                    <span><i class="ion-upload m-r-5"></i> Upload Profile Photo</span>
                                    <input type="file" class="upload" id="profilephoto" name="profilephoto" >
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="TINNumber" class="control-label">TIN Number</label>
                            <input type="text" class="form-control" id="TINNumber" name="TINNumber" parsley-trigger="change" required placeholder="TIN Number" value="<?php echo $TINNumber; ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="CINNumber" class="control-label">CIN Number</label>
                            <input type="text" class="form-control" id="CINNumber" name="CINNumber" placeholder="CIN Number" value="<?php echo $CINNumber; ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12'">
                        <div class="form-group">
                            <label for="address" class="control-label">Address</label>
                            <textarea class="form-control" id="address" name="address" parsley-trigger="change" required placeholder="Address" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;"><?php echo $address; ?></textarea>
                        </div>
                    </div>
                </div>
            <?php }  else { ?>
            <div class="row">
                <div class="col-md-6'">
                    <div class="form-group no-margin">
                        <label for="address" class="control-label">Address</label>
                        <textarea class="form-control autogrow" id="address" name="address" parsley-trigger="change" required placeholder="Address" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 104px;"><?php echo $address; ?></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group fileupload">
                        <div class=" btn btn-rounded btn-default waves-effect waves-light" style="width: 100%">
                            <span><i class="ion-upload m-r-5"></i> Upload Profile Photo</span>
                            <input type="file" class="upload" id="profilephoto" name="profilephoto" >
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>


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
<script>
    $("#adminid").select2();
    $("#retailershowroomid").select2();
</script>
