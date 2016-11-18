<table id="datatable-responsive" class="table table-striped table-bordered dt-responsive" cellspacing="0"
       width="100%">
    <thead>
    <tr>
        <th>S.No</th>
        <th><?php if($usertypeid == 3) { echo "Show Room"; } else { echo "Name";} ?></th>
        <th><?php if($usertypeid == 3) { echo "Contact Number"; } else { echo "Mobile";} ?></th>
        <th>Email</th>
        <?php if($usertypeid != 3 && $usertypeid != 6) { ?><th>Password</th><?php } ?>
        <th>Address</th>
	<?php if($usertypeid == 6){  ?>
        <th>Bank Name</th>
        <th>IFS Code</th>
        <th>Account No</th>

        <?php } /*if($usertypeid != 3 && $usertypeid != 6) { ?><th>DOJ</th>
        <th>LastLogin</th>
        <th>Created At</th><?php }*/?>
<!--        <th>DOB</th>-->
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php for ($k = 0; $k < count($userArray); $k++) { ?>
        <tr>
            <?php $userid = $userArray[$k]['userid']; $adminid = $userArray[$k]['adminid']; ?>
            <td><?php $sno = $k + 1; echo $sno; ?></td>
            <td><?php echo $userArray[$k]['name']; ?></td>
            <td><?php echo $userArray[$k]['mobile']; ?></td>
            <td><?php echo $userArray[$k]['email']; ?></td>
            <?php if($usertypeid != 3 && $usertypeid != 6) { ?><td><?php echo $userArray[$k]['password']; ?></td><?php } ?>
            <td><?php echo $userArray[$k]['address']; ?></td>
	<?php if($usertypeid == 6){  ?>
            <td><?php echo $userArray[$k]['BankName']; ?></td>
            <td><?php echo $userArray[$k]['IFSCode']; ?></td>
            <td><?php echo $userArray[$k]['AccountNumber']; ?></td>
             <?php } /*if($usertypeid != 3 && $usertypeid != 6) { ?><td><?php echo $userArray[$k]['doj']; ?></td>
            <td><?php echo $userArray[$k]['lastlogin']; ?></td>
            <td><?php echo $userArray[$k]['createdat']; ?></td><?php } */?>
<!--            <td>--><?php //echo $userArray[$k]['dob']; ?><!--</td>-->
            <?php $postData = "usertypeid=".$usertypeid."&actionType=Edit&actionId=".$userid;
                if($sessionUserTypeId == "1"){
                    $postData = $postData . "&adminid=".$adminid;
                }
            ?>
            <td><button class="btn btn-icon waves-effect waves-light btn-primary m-b-5" type="button" onclick="loadAddOrEditContentWithModal('getAddOrEditUserMasterContent','<?php echo $postData; ?>','modalContentArea')">
                    <i class="fa fa-edit"></i>
                </button></td>
            <td><button class="btn btn-icon waves-effect waves-light btn-danger m-b-5" type="button" onclick="deleteUsers('<?php echo $userid; ?>','<?php echo $adminid; ?>');">
                    <i class="fa fa-remove"></i>
                </button></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
