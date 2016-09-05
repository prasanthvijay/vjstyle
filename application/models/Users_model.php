<?php

/**
 * Created by IntelliJ IDEA.
 * User: jonam
 * Date: 24/7/16
 * Time: 7:52 AM
 */
class Users_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function insertAndReturnOTP($emailid){
        $otp = "";
        $userArray = array();
        if ($emailid != "" && $emailid != null) {
            $sql = "SELECT userid FROM `tbl_user` t WHERE t.active = 'active' ";
            $sql .= " and email = '" . $emailid . "' ";
            $userQuery = $this->db->query($sql);
            $k = 0;
            $userId  = "";
            foreach ($userQuery->result() as $row) {
                $userId = $row->userid;
            }

            if($userId !=""){
                $otp  = rand(100000,999999);
                $createdAt = Date("now");
                $expiryDate = Date("now");
                $active = "active";
                $forgotSql = "INSERT INTO `tbl_forgotPasswordRequest`( `userid`, `otp`, `createdAt`, `expiryDate`, `active`) VALUES (".$this->db->escape($userId) .",".$this->db->escape($otp) .",".$this->db->escape($createdAt) .",".$this->db->escape($expiryDate) .",".$this->db->escape($active) .")";
                $this->db->query($forgotSql);
            }
        }

        return $otp;
    }

    public function getSuccessMsgOTPUpdated($email, $otptext){
        $resultArray = array('successMsg'=>0, 'userid'=>null);
        $userSql = "SELECT userid FROM `tbl_user` t WHERE t.active = 'active' and email = '" . $email . "' ";
        $sql = "SELECT userid FROM `tbl_forgotPasswordRequest` t WHERE t.active = 'active' ";
        $sql .= " and otp = '" . $otptext . "' ";
        $sql .= " and userid in ($userSql) ";
        $userQuery = $this->db->query($sql);
        $returnValue = $userQuery->result_array();
        if(count($returnValue)>0)
            $resultArray = array('successMsg'=>1, 'userid'=>$returnValue[0]['userid']);

        return $resultArray;
    }

    public function updateUsersPassword($userId, $newPassword){
        if($userId!=null && $newPassword!=""){
            $sql = "UPDATE tbl_user set password = ".$this->db->escape($newPassword) ." where userid = ".$this->db->escape($userId);
            $this->db->query($sql);
        }
    }

    public function sendEmail($fromMailId, $fromMailName, $tomailIdArray, $subject, $message){
        if($fromMailId!="" && $fromMailId!=null){
            $fromMailId = $fromMailId;
            $fromMailName = $fromMailName;
        } else {
            $fromMailId = "mathan@mynap.in";
            $fromMailName = "Mathan";
        }

//        print_r($tomailIdArray);
        $ci=get_instance();
        $ci->load->library('email');
        $ci->email->from($fromMailId, $fromMailName);
        $ci->email->to($tomailIdArray);
        $ci->email->reply_to($fromMailId, $fromMailName);
        $ci->email->subject($subject);
        $ci->email->message($message);
        return $ci->email->send();
    }

    public function checkUserCredential($userCredentialArray)
    {
        $username = $userCredentialArray['username'];
        $password = $userCredentialArray['userpassword'];
        $userList = array();

        //Select active list from both user and usertype table
        $sql = "SELECT t.userid, t.name, t.email, t.usertypeid, t.adminid, t.retailerShowRoomId, t.mobile, t.address, t.lastlogin, u.redirecturl, u.usertype  FROM `tbl_usertype` u INNER JOIN tbl_user t ON u.usertypeid = t.usertypeid and u.active='active' WHERE t.email = '" . $username . "' and t.password = '" . $password . "' and t.active = 'active' ";
        $query = $this->db->query($sql);
        foreach ($query->result() as $row) {
            $userList['userid'] = $row->userid;
            $userList['name'] = $row->name;
            $userList['email'] = $row->email;
            $userList['usertypeid'] = $row->usertypeid;
            $userList['adminid'] = $row->adminid;
            $userList['mobile'] = $row->mobile;
            $userList['retailerShowRoomId'] = $row->retailerShowRoomId;
            $userList['lastlogin'] = $row->lastlogin;
            $userList['redirecturl'] = $row->redirecturl;
            $userList['usertype'] = $row->usertype;
        }
        return $userList;
    }

    public function updateLastlogin($userid)
    {
        $data = array('lastlogin' => date('Y-m-d H:m:s'));
        $this->db->where('userid', $userid);
        return $this->db->update('tbl_user', $data);
    }

    public function getSuccessMsg($output)
    {
        $successMsg = "";
        $responseMsg  = "";
        $responseStatus  = "";
        if (isset($output)) {
            $responseStatus = $output['status'];
            $responseMsg = $output['message'];
        }

        if($responseStatus == 1) {
            $successMsg = "<div class=\"alert alert-success alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>" . $responseMsg . "</div>";
        } else if($responseStatus == 2) {
            $successMsg = "<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>" . $responseMsg . "</div>";
        }

        return $successMsg;
    }

    public function getUserTypeList($usertypeid)
    {

        $userTypeArray = array();

        $sql = "SELECT t.usertypeid, t.usertype, t.redirecturl FROM `tbl_usertype` t WHERE t.active = 'active' ";
        if ($usertypeid != null) {
            $sql = $sql . " and usertypeid = " . $usertypeid;
        }
        $sql = $sql . " order by usertypeid asc";
        $userTypeQuery = $this->db->query($sql);
        $k = 0;
        foreach ($userTypeQuery->result() as $row) {
            $userTypeArray[$k]['usertypeid'] = $row->usertypeid;
            $userTypeArray[$k]['usertype'] = $row->usertype;
            $userTypeArray[$k]['redirecturl'] = $row->redirecturl;
            $k++;
        }

        return $userTypeArray;
    }

    public function getUsersList($usertypeid, $adminid, $retailerShowRoomId, $userid)
    {

        $userArray = array();
        $sql = "SELECT * FROM `tbl_user` t WHERE t.active = 'active' ";
        if ($adminid != "" && $adminid != null) {
            $sql .= " and adminid = '" . $adminid . "' ";
        }

        if($userid !="" && $userid!=null){
            $sql .= " and userid = '" . $userid . "' ";
        }

        if ($usertypeid != null && $usertypeid != "") {
            $sql = $sql . " and usertypeid = " . $usertypeid;
        }

        $sql = $sql . " order by userid desc";
        $userQuery = $this->db->query($sql);
        $k = 0;
        foreach ($userQuery->result() as $row) {
            $userArray[$k]['userid'] = $row->userid;
            $userArray[$k]['name'] = $row->name;
            $userArray[$k]['email'] = $row->email;
            $userArray[$k]['password'] = $row->password;
            $userArray[$k]['usertypeid'] = $row->usertypeid;
            $userArray[$k]['adminid'] = $row->adminid;
            $userArray[$k]['retailerShowRoomId'] = $row->retailerShowRoomId;
            $userArray[$k]['mobile'] = $row->mobile;
            $userArray[$k]['address'] = $row->address;
            $userArray[$k]['doj'] = $row->doj;
            $userArray[$k]['dob'] = $row->dob;
            $userArray[$k]['lastlogin'] = $row->lastlogin;
            $userArray[$k]['createdat'] = $row->createdat;
            $k++;
        }

        return $userArray;
    }

    public function getBrandList($adminid, $actionId)
    {

        $BrandArray = array();
        $sql = "SELECT * FROM `tbl_brand` t WHERE t.active = 'active' ";
        if ($adminid != "" && $adminid != null) {
            $sql .= " and adminid = '" . $adminid . "' ";
        }

        if ($actionId != "" && $actionId != null && $actionId!="0" && $actionId!=0) {
            $sql .= " and brandid = '" . $actionId . "' ";
        }
        $sql = $sql . " order by brandid desc";
        $userQuery = $this->db->query($sql);

        $k = 0;
        foreach ($userQuery->result() as $row) {
            $BrandArray[$k]['brandid'] = $row->brandid;
            $BrandArray[$k]['brandname'] = $row->brandname;
            $BrandArray[$k]['adminid'] = $row->adminid;
            $BrandArray[$k]['active'] = $row->active;
            $BrandArray[$k]['createdat'] = $row->createdat;
            $k++;
        }

        return $BrandArray;
    }

    public function getProductList($adminid, $productId)
    {

        $ProductList = array();
        $sql = "SELECT * FROM `tbl_product` t WHERE t.active = 'active' ";
        if ($adminid != "" && $adminid != null) {
            $sql .= " and adminid = '" . $adminid . "' ";
        }

        if($productId !="0" && $productId!="" && $productId!=null){
            $sql .= " and productid = '" . $productId . "' ";
        }

        $sql = $sql . " order by productid desc";
        $userQuery = $this->db->query($sql);
        $k = 0;
        foreach ($userQuery->result() as $row) {
            $ProductList[$k]['productid'] = $row->productid;
            $ProductList[$k]['productname'] = $row->productname;
            $ProductList[$k]['productrate'] = $row->productrate;
//            $ProductList[$k]['availablequantity'] = $row->availablequantity;
            $ProductList[$k]['barcode'] = $row->barcode;
            $ProductList[$k]['productsize'] = $row->productsize;
            $ProductList[$k]['categorytypeid'] = $row->categorytypeid;
            $ProductList[$k]['active'] = $row->active;
            $ProductList[$k]['adminid'] = $row->adminid;
            $ProductList[$k]['brandid'] = $row->brandid;
            $k++;
        }

        return $ProductList;
    }

    public function createUserMaster($userDetailsArray)
    {
        $doj = $userDetailsArray['doj'];
        if($doj == NULL){
            $doj = "0000-00-00";
        }

        $dob = $userDetailsArray['dob'];
        if($dob == NULL){
            $dob = "0000-00-00";
        }

        $retailershowroomid = $userDetailsArray['retailershowroomid'];
        if($retailershowroomid == NULL){
            $retailershowroomid = 0;
        }

        $sql = "INSERT INTO tbl_user (name,email,password,usertypeid,adminid,retailerShowRoomId,mobile,address,doj,dob,active,createdat) " . "VALUES (" . $this->db->escape($userDetailsArray['name']) . "," . $this->db->escape($userDetailsArray['email']) . "," . $this->db->escape($userDetailsArray['password']) . "," . $this->db->escape($userDetailsArray['usertypeid']) . "," . $this->db->escape($userDetailsArray['adminid']) . "," . $this->db->escape($retailershowroomid) . "," . $this->db->escape($userDetailsArray['mobile']) . "," . $this->db->escape($userDetailsArray['address']) . "," . $this->db->escape($doj) . "," . $this->db->escape($dob) . "," . $this->db->escape($userDetailsArray['active']) . "," . $this->db->escape($userDetailsArray['createdAt']) . ")";
        $this->db->query($sql);
    }

    public function updateUserMaster($userDetailsArray){
        $doj = $userDetailsArray['doj'];
        if($doj == NULL){
            $doj = "0000-00-00";
        }

        $dob = $userDetailsArray['dob'];
        if($dob == NULL){
            $dob = "0000-00-00";
        }

        $retailershowroomid = $userDetailsArray['retailershowroomid'];
        if($retailershowroomid == NULL){
            $retailershowroomid = 0;
        }

        $sql = "Update tbl_user SET name = ".$this->db->escape($userDetailsArray['name']).", email = ".$this->db->escape($userDetailsArray['email']).", password = ".$this->db->escape($userDetailsArray['password']).", mobile = ".$this->db->escape($userDetailsArray['mobile']).", address = ".$this->db->escape($userDetailsArray['address']) .", doj = ".$this->db->escape($doj).", dob =".$this->db->escape($dob)." WHERE userid=".$userDetailsArray['userid'];
        $this->db->query($sql);
    }

    public function createBrandMaster($BrandDetailsArray)
    {
        $sql = "INSERT INTO tbl_brand (brandname,adminid,createdat) " . "VALUES (" . $this->db->escape($BrandDetailsArray['brandname']) . "," . $this->db->escape($BrandDetailsArray['adminid']) . "," . $this->db->escape($BrandDetailsArray['createdAt']) . ")";
        $this->db->query($sql);
    }

    public function updateBrandMaster($BrandDetailsArray)
    {
        $sql = "UPDATE tbl_brand set brandname = " . $this->db->escape($BrandDetailsArray['brandname']) . " where brandid = ".$this->db->escape($BrandDetailsArray['brandid'])." and adminid = ". $this->db->escape($BrandDetailsArray['adminid']);
        return $this->db->query($sql);
    }

    public function deleteBrandMaster($BrandDetailsArray)
    {
        $active = "deleted";
        $sql = "UPDATE tbl_brand set active = " . $this->db->escape($active) . " where brandid = ".$this->db->escape($BrandDetailsArray['brandid'])." and adminid = ". $this->db->escape($BrandDetailsArray['adminid']);
        return $this->db->query($sql);
    }

    public function updateSizeMaster($SizeDetailsArray)
    {
        $sql = "UPDATE tbl_sizemaster set size = " . $this->db->escape($SizeDetailsArray['size']) . " where sizeid = ".$this->db->escape($SizeDetailsArray['sizeid'])." and adminid = ". $this->db->escape($SizeDetailsArray['adminid']);
        return $this->db->query($sql);
    }

    public function deleteSizeMaster($SizeDetailsArray)
    {
        $active = "deleted";
        $sql = "UPDATE tbl_sizemaster set active = " . $this->db->escape($active) . " where sizeid = ".$this->db->escape($SizeDetailsArray['sizeid'])." and adminid = ". $this->db->escape($SizeDetailsArray['adminid']);
        return $this->db->query($sql);
    }

    public function updateCategoryTypeMaster($SizeDetailsArray)
    {
        $sql = "UPDATE tbl_categorytype set categorytype = " . $this->db->escape($SizeDetailsArray['categoryType']) . " where categorytypeid = ".$this->db->escape($SizeDetailsArray['categorytypeid'])." and adminid = ". $this->db->escape($SizeDetailsArray['adminid']);
        return $this->db->query($sql);
    }

    public function deleteCategoryTypeMaster($CategoryTypeDetailsArray)
    {
        $active = "deleted";
        $sql = "UPDATE tbl_categorytype set active = " . $this->db->escape($active) . " where categorytypeid = ".$this->db->escape($CategoryTypeDetailsArray['categorytypeid'])." and adminid = ". $this->db->escape($CategoryTypeDetailsArray['adminid']);
        return $this->db->query($sql);
    }

    public function createCategoryTypeMaster($BrandDetailsArray)
    {
        $sql = "INSERT INTO tbl_categorytype (categorytype,adminid,createdat) " . "VALUES (" . $this->db->escape($BrandDetailsArray['categoryType']) . "," . $this->db->escape($BrandDetailsArray['adminid']) . "," . $this->db->escape($BrandDetailsArray['createdAt']) . ")";
        $this->db->query($sql);
    }

    public function deleteProductMaster($ProductDetailsDeleteArray)
    {
        $active = "deleted";
        $sql = "UPDATE tbl_product set active = " . $this->db->escape($active) . " where productid = ".$this->db->escape($ProductDetailsDeleteArray['productid'])." and adminid = ". $this->db->escape($ProductDetailsDeleteArray['adminid']);
        return $this->db->query($sql);
    }

    public function createProductMaster($ProductDetailsArray)
    {
        $sql = "INSERT INTO tbl_product (productname, productrate, productsize, barcode, categorytypeid, brandid, adminid, active, createdat) " . "VALUES (" . $this->db->escape($ProductDetailsArray['productname']) . "," . $this->db->escape($ProductDetailsArray['price']) . "," . $this->db->escape($ProductDetailsArray['size']) . "," . $this->db->escape($ProductDetailsArray['barcode']) . "," . $this->db->escape($ProductDetailsArray['categorytypeid']) . "," . $this->db->escape($ProductDetailsArray['brandname']) . "," . $this->db->escape($ProductDetailsArray['adminid']) . "," . $this->db->escape($ProductDetailsArray['active']) . "," . $this->db->escape($ProductDetailsArray['createdAtdate']) . ")";
        $this->db->query($sql);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function updateProductMaster($ProductDetailsArray)
    {
        $sql = "UPDATE tbl_product set productname = ".$this->db->escape($ProductDetailsArray['productname']).", productrate = ".$this->db->escape($ProductDetailsArray['price']).", productsize = ".$this->db->escape($ProductDetailsArray['size']).", barcode = ".$this->db->escape($ProductDetailsArray['barcode']).", categorytypeid = ".$this->db->escape($ProductDetailsArray['categorytypeid']).", brandid = ".$this->db->escape($ProductDetailsArray['brandname']). " where productid = ".$this->db->escape($ProductDetailsArray['productid'])." and adminid = ".$this->db->escape($ProductDetailsArray['adminid']);
        $this->db->query($sql);
    }

    public function validateUserMaster($userDetailsArray, $action)
    {
        $validationArray = array();
        $validationArray['validateSuccess'] = 0;
        $validationArray['errorMsg'] = "";

        if (count($userDetailsArray) > 0) {
            $email = $userDetailsArray['email'];
            $alreadyExistList = self::getUsersExistList($email);

            if((count($alreadyExistList) > 0 && $action =='Add') || count($alreadyExistList) > 1 && $action =='Edit' ){
                $validationArray['validateSuccess'] = 1;
                $validationArray['errorMsg'] = "Emails Already Exist";
            } else {
                $validationArray['validateSuccess'] = 0;
                $validationArray['errorMsg'] = "";
            }
        } else {
            $validationArray['validateSuccess'] = 1;
            $validationArray['errorMsg'] = "Please check all details!";
        }
        return $validationArray;
    }

    public function getUsersExistList($email)
    {

        $userArray = array();
        $sql = "SELECT userid FROM `tbl_user` t ";

        if ($email != "" && $email != null) {
            $sql .= " WHERE t.email = '" . $email . "' ";
        }

//        $sql = $sql . " limit 1";
        $userQuery = $this->db->query($sql);
        $k = 0;
        foreach ($userQuery->result() as $row) {
            $userArray[$k]['userid'] = $row->userid;
            $k++;
        }

        return $userArray;
    }

    public function getRedirectURLForMaster($usertypeid){

        $redirectUrl = "";
        switch ($usertypeid){
            case 1 :
                $redirectUrl = "Frontend/adminMaster";
                break;
            case 2 :
                $redirectUrl = "Frontend/adminMaster";
                break;
            case 3 :
                $redirectUrl = "Frontend/retailerShowRoomMaster";
                break;
            case 4 :
                $redirectUrl = "Frontend/salesHeadMaster";
                break;
            case 5 :
                $redirectUrl = "Frontend/salesExecutiveMaster";
                break;
            case 6 :
                $redirectUrl = "Frontend/sellerMaster";
                break;
        }
        return $redirectUrl;
    }

    public function deleteUsersFromMaster($userid, $adminid){
        $success = 0;
        if($userid !="" && $adminid!=""){
            $sql = "Update tbl_user set active = 'deleted' where active='active' and userid=".$userid." and adminid=".$adminid;
            $success = $this->db->query($sql);
        }
        return $success;
    }

    public function convertDDMMYYtoYYMMDD($bookingDate)
    {
        $returnBookingDate = "0000-00-00";
        if ($bookingDate != null) {
            if ($bookingDate != "" && $bookingDate != "00-00-0000") {
                $returnBookingDateArray = explode("-", $bookingDate);
                if (count($returnBookingDateArray) > 0) {
                    $returnBookingDate = $returnBookingDateArray[2] . "-" . $returnBookingDateArray[1] . "-" . $returnBookingDateArray[0];
                }
            }
        }
        return $returnBookingDate;
    }
    public function createSizeMaster($SizeDetailsArray)
    {
        $sql = "INSERT INTO tbl_sizemaster (size,adminid,createdat) " . "VALUES (" . $this->db->escape($SizeDetailsArray['size']) . "," . $this->db->escape($SizeDetailsArray['adminid']) . "," . $this->db->escape($SizeDetailsArray['createdAt']) . ")";
        $this->db->query($sql);
    }

    public function getSizeList($adminid, $actionId)
    {

        $SizeArray = array();
        $sql = "SELECT * FROM `tbl_sizemaster` t WHERE t.active = 'active' ";
        if ($adminid != "" && $adminid != null) {
            $sql .= " and adminId = '" . $adminid . "' ";
        }

        if ($actionId != "" && $actionId != null && $actionId!="0" && $actionId!=0) {
            $sql .= " and sizeid = '" . $actionId . "' ";
        }

        $sql = $sql . " order by sizeid desc";
        $userQuery = $this->db->query($sql);
        $k = 0;
        foreach ($userQuery->result() as $row) {
            $SizeArray[$k]['sizeid'] = $row->sizeid;
            $SizeArray[$k]['size'] = $row->size;
            $SizeArray[$k]['adminId'] = $row->adminId;
            $SizeArray[$k]['active'] = $row->active;
            $SizeArray[$k]['createdAt'] = $row->createdAt;
            $k++;
        }

        return $SizeArray;
    }

    public function getCategoryTypeList($adminid, $actionId)
    {

        $SizeArray = array();
        $sql = "SELECT * FROM `tbl_categorytype` t WHERE t.active = 'active' ";
        if ($adminid != "" && $adminid != null) {
            $sql .= " and adminId = '" . $adminid . "' ";
        }

        if ($actionId != "" && $actionId != null && $actionId!="0" && $actionId!=0) {
            $sql .= " and categorytypeid = '" . $actionId . "' ";
        }

        $sql = $sql . " order by categorytypeid desc";
        $userQuery = $this->db->query($sql);
        $k = 0;
        foreach ($userQuery->result() as $row) {
            $SizeArray[$k]['categorytypeid'] = $row->categorytypeid;
            $SizeArray[$k]['categorytype'] = $row->categorytype;
            $SizeArray[$k]['adminId'] = $row->adminId;
            $SizeArray[$k]['active'] = $row->active;
            $SizeArray[$k]['createdAt'] = $row->createdAt;
            $k++;
        }

        return $SizeArray;
    }


    public function getQuantity($adminid, $productId)
    {

        $Quantity = array();
        $sql = "SELECT  availablequantity,productrate FROM `tbl_product` t WHERE t.active = 'active' ";
        if ($adminid != "" && $adminid != null) {
            $sql .= " and adminid = '" . $adminid . "' ";
        }

        $sql = $sql . "and productid='" . $productId . "'";
        $userQuery = $this->db->query($sql);
        $k = 0;
        foreach ($userQuery->result() as $row) {
            $Quantity[$k]['availablequantity'] = $row->availablequantity;
            $Quantity[$k]['productrate'] = $row->productrate;
            $k++;
        }

        return $Quantity;
    }

    public function getshowroomList($adminid)
    {

        $showroomArray = array();
        $sql = "SELECT  ShowRoomName,ShowRoomId FROM `tbl_showroom` t WHERE t.active = 'active' ";
        if ($adminid != "" && $adminid != null) {
            $sql .= " and adminId = '" . $adminid . "' ";
        }

        $userQuery = $this->db->query($sql);
        $k = 0;
        foreach ($userQuery->result() as $row) {
            $showroomArray[$k]['ShowRoomName'] = $row->ShowRoomName;
            $showroomArray[$k]['ShowRoomId'] = $row->ShowRoomId;
            $k++;
        }

        return $showroomArray;
    }

    public function createProductmappingMaster($ProductMappingArray)
    {
        $sql = "INSERT INTO tbl_productMapping (productId,showroomId,price,quantity,adminId,createAt) " . "VALUES (" . $this->db->escape($ProductMappingArray['productId']) . "," . $this->db->escape($ProductMappingArray['ShowroomId']) . "," . $this->db->escape($ProductMappingArray['mappedprice']) . "," . $this->db->escape($ProductMappingArray['mappedqyt']) . "," . $this->db->escape($ProductMappingArray['adminid']) . "," . $this->db->escape($ProductMappingArray['createdAtdate']) . ")";
        $this->db->query($sql);
    }

}

?>
