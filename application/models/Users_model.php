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

    public function insertAndReturnOTP($emailid)
    {
        $otp = "";
        $userArray = array();
        if ($emailid != "" && $emailid != null) {
            $sql = "SELECT userid FROM `tbl_user` t WHERE t.active = 'active' ";
            $sql .= " and email = '" . $emailid . "' ";
            $userQuery = $this->db->query($sql);
            $k = 0;
            $userId = "";
            foreach ($userQuery->result() as $row) {
                $userId = $row->userid;
            }
            if ($userId != "") {

                $newdate = new DateTime("now");
                $now = $createdAt = date_format($newdate,"Y-m-d H:i:s");
                $interval = new DateInterval('PT12H0S');
                $newdate->add($interval);

                $expiryDate = date_format($newdate,"Y-m-d H:i:s");
                $existSql = "Select * from `tbl_forgotPasswordRequest` where userid=" . $this->db->escape($userId)." and active='active' and createdAt <= " . $this->db->escape($now) ." and expiryDate >= " . $this->db->escape($now);
                $executeQuery = $this->db->query($existSql);
                $returnValueArray = $executeQuery->result_array();

                if (count($returnValueArray) > 0) {
                   $otp = $returnValueArray[0]['otp'];
                } else {
                    $otp = rand(100000, 999999);
                    $active = "active";
                    $forgotSql = "INSERT INTO `tbl_forgotPasswordRequest`( `userid`, `otp`, `createdAt`, `expiryDate`, `active`) VALUES (" . $this->db->escape($userId) . "," . $this->db->escape($otp) . "," . $this->db->escape($createdAt) . "," . $this->db->escape($expiryDate) . "," . $this->db->escape($active) . ")";
                    $this->db->query($forgotSql);
                }
            }
        }

        return $otp;
    }

    public function getSuccessMsgOTPUpdated($email, $otptext)
    {
        $resultArray = array('successMsg' => 0, 'userid' => null);
        $userSql = "SELECT userid FROM `tbl_user` t WHERE t.active = 'active' and email = '" . $email . "' ";
        $sql = "SELECT userid FROM `tbl_forgotPasswordRequest` t WHERE t.active = 'active' ";
        $sql .= " and otp = '" . $otptext . "' ";
        $sql .= " and userid in ($userSql) ";
        $userQuery = $this->db->query($sql);
        $returnValue = $userQuery->result_array();
        if (count($returnValue) > 0){
            $userid = $returnValue[0]['userid'];
            $resultArray = array('successMsg' => 1, 'userid' => $userid);
            $usedAt = date("Y-m-d H:i:s");
            $forgotSql = "Update `tbl_forgotPasswordRequest` set active = 'used', usedAt = ".$this->db->escape($usedAt)."  where userid = ".$this->db->escape($userid)." and active='active' and otp = ".$this->db->escape($otptext);
            $this->db->query($forgotSql);
        }


        return $resultArray;
    }

    public function updateUsersPassword($userId, $newPassword)
    {
        if ($userId != null && $newPassword != "") {
            $sql = "UPDATE tbl_user set password = " . $this->db->escape($newPassword) . " where userid = " . $this->db->escape($userId);
            $this->db->query($sql);
        }
    }

    public function sendEmail($fromMailId, $fromMailName, $tomailIdArray, $subject, $message)
    {
        if ($fromMailId != "" && $fromMailId != null) {
            $fromMailId = $fromMailId;
            $fromMailName = $fromMailName;
        } else {
            $fromMailId = "mathan@mynap.in";
            $fromMailName = "Mathan";
        }

//        print_r($tomailIdArray);
        $ci = get_instance();
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
        $responseMsg = "";
        $responseStatus = "";
        if (isset($output)) {
            $responseStatus = $output['status'];
            $responseMsg = $output['message'];
        }

        if ($responseStatus == 1) {
            $successMsg = "<div class=\"alert alert-success alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">Ã—</button>" . $responseMsg . "</div>";
        } else if ($responseStatus == 2) {
            $successMsg = "<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">Ã—</button>" . $responseMsg . "</div>";
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

        if ($userid != "" && $userid != null) {
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
            $userArray[$k]['aliasName'] = $row->aliasName;
            $userArray[$k]['email'] = $row->email;
            $userArray[$k]['password'] = $row->password;
            $userArray[$k]['usertypeid'] = $row->usertypeid;
            $userArray[$k]['adminid'] = $row->adminid;
            $userArray[$k]['retailerShowRoomId'] = $row->retailerShowRoomId;
            $userArray[$k]['mobile'] = $row->mobile;
            $userArray[$k]['address'] = $row->address;
            $userArray[$k]['doj'] = $row->doj;
            $userArray[$k]['dob'] = $row->dob;
            $userArray[$k]['cinnumber'] = $row->cinnumber;
            $userArray[$k]['tinnumber'] = $row->tinnumber;
            $userArray[$k]['BankName'] = $row->BankName;
            $userArray[$k]['IFSCode'] = $row->IFSCode;
            $userArray[$k]['AccountNumber'] = $row->AccountNumber;
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

        if ($actionId != "" && $actionId != null && $actionId != "0" && $actionId != 0) {
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
	public function getExpensesList($adminid, $actionId)
    {

        $ExpensesArray = array();
        $sql = "SELECT * FROM `tbl_Expenses` t WHERE 1 ";
        if ($adminid != "" && $adminid != null) {
            $sql .= " and adminId = '" . $adminid . "' ";
        }

        if ($actionId != "" && $actionId != null && $actionId != "0" && $actionId != 0) {
            $sql .= " and ExId = '" . $actionId . "' ";
        }
        $sql = $sql . " order by ExId desc";
        $userQuery = $this->db->query($sql);

        $k = 0;
        foreach ($userQuery->result() as $row) {
            $ExpensesArray[$k]['ExId'] = $row->ExId;
            $ExpensesArray[$k]['Reasons'] = $row->Reasons;
            $ExpensesArray[$k]['Amount'] = $row->Amount;
            $ExpensesArray[$k]['adminId'] = $row->adminId;

            $k++;
        }

        return $ExpensesArray;
    }

	public function getMaintenanceList($adminid, $actionId)
    {

        $MaintenanceArray = array();
        $sql = "SELECT * FROM `tbl_Maintenance` t WHERE 1 ";
        if ($adminid != "" && $adminid != null) {
            $sql .= " and adminId = '" . $adminid . "' ";
        }

        if ($actionId != "" && $actionId != null && $actionId != "0" && $actionId != 0) {
            $sql .= " and MtId = '" . $actionId . "' ";
        }
        $sql = $sql . " order by MtId desc";
        $userQuery = $this->db->query($sql);

        $k = 0;
        foreach ($userQuery->result() as $row) {
            $MaintenanceArray[$k]['MtId'] = $row->MtId;
            $MaintenanceArray[$k]['Reasons'] = $row->Reasons;
            $MaintenanceArray[$k]['Amount'] = $row->Amount;
            $MaintenanceArray[$k]['Date'] = $row->paidDate;
            $MaintenanceArray[$k]['adminId'] = $row->adminId;

            $k++;
        }

        return $MaintenanceArray;
    }


    public function getMyAdminProductList($adminid)
    {
        $sql = "SELECT t.productid, t.productname, t.barcode from tbl_product t WHERE t.active = 'active' and t.adminid=$adminid";
        $productQuery = $this->db->query($sql);
        $productDetailsArray = $productQuery->result_array();
        return $productDetailsArray;
    }
    public function getProductList($adminid, $productId, $showroomId, $categorytypeid,$subcategoryid, $brandid, $sizeid, $barcode , $rec_limit, $page)
    {

        $ProductList = array();
        
//        $sql = "SELECT t.productid, t.productname, t.productrate, t.barcode, t.productsize, t.categorytypeid,t.subcategoryid, t.active, t.adminid, t.brandid, a.showroomId, tb.brandname, ts.size, tc.categorytype, a.price as price, sum(pb.quantity) as quantity FROM tbl_product t Left JOIN tbl_productMapping a on t.productid = a.productid Left JOIN tbl_productBatch pb on a.productId = pb.productid AND a.showroomId=pb.showRoomId LEFT JOIN tbl_brand tb on tb.brandid=t.brandid LEFT JOIN tbl_sizemaster ts on ts.sizeid=t.productsize LEFT JOIN tbl_categorytype tc on tc.categorytypeid = t.categorytypeid WHERE  t.active = 'active' ";
        $beforeSql = "SELECT t.productid, t.productname, t.productrate, t.barcode, t.productsize, t.categorytypeid,t.subcategoryid, t.active, t.adminid, t.brandid, a.showroomId, tb.brandname, ts.size, tc.categorytype, a.price as price, sum(pb.quantity) as quantity FROM tbl_product t Left JOIN tbl_productMapping a on t.productid = a.productid Left JOIN tbl_productBatch pb on a.productId = pb.productid AND a.showroomId=pb.showRoomId LEFT JOIN tbl_brand tb on tb.brandid=t.brandid LEFT JOIN tbl_sizemaster ts on ts.sizeid=t.productsize LEFT JOIN tbl_categorytype tc on tc.categorytypeid = t.categorytypeid";

        $sql = " WHERE  t.active = 'active' ";

        if ($adminid != "0" && $adminid != "" && $adminid != null) {
            $sql .= " and t.adminid = '" . $adminid . "' ";
        }
        if ($productId != "0" && $productId != "" && $productId != null) {
            $sql .= " and t.productid = '" . $productId . "' ";
        }

        //Search Product
        if ($categorytypeid != "0" && $categorytypeid != "" && $categorytypeid != null) {
            $sql .= " and t.categorytypeid = '" . $categorytypeid . "' ";
        }
        if ($subcategoryid != "0" && $subcategoryid != "" && $subcategoryid != null) {
            $sql .= " and t.subcategoryid = '" . $subcategoryid . "' ";
        }
        if ($brandid != "0" && $brandid != "" && $brandid != null) {
            $sql .= " and t.brandid = '" . $brandid . "' ";
        }
        if ($sizeid != "0" && $sizeid != "" && $sizeid != null) {
            $sql .= " and t.productsize = '" . $sizeid . "' ";
        }
        if (($barcode != "" && $barcode != null) || $barcode =="0" ) {
            $sql .= " and t.barcode = '" . $barcode . "' ";
        }


//        if($noOfPage!="All"){
//            $limitString = $noOfPage * 100;
//            $sql = $sql . " order by productid desc limit ".$limitString.", 100";
//        }
        $left_rec = 0;
        if ($rec_limit != "All" && is_numeric($rec_limit)) {
            $countquery = "select COUNT(t.productid) as count from tbl_product t " . $sql;
            $paginationDataArray = self::paginationFunction($rec_limit, $page, $countquery);

            $left_rec = $paginationDataArray['left_rec'];
            $paginationLimit = $paginationDataArray['paginationLimit'];
            $page = $paginationDataArray['page'];
            $rec_limit = $paginationDataArray['rec_limit'];

            $paginationSql = " order by productid desc ".$paginationLimit;
        }
	else{
	 $paginationSql = " order by productid desc ";		
	}
        if ($showroomId != "0" && $showroomId != "" && $showroomId != null) {
            $sql .= " and a.showroomId = '" . $showroomId . "' ";
        }

        $sql = $sql ." group by t.productId". $paginationSql;

        $userQuery = $this->db->query($beforeSql.$sql);
        $k = 0;
        foreach ($userQuery->result() as $row) {
            $productIdFromQuery = $row->productid;
            $showroomIdFromQuery = $row->showroomId;
            $adminidFromQuery = $row->adminid;

            $ProductList[$k]['productid'] = $productIdFromQuery;
            $ProductList[$k]['productname'] = $row->productname;
            $ProductList[$k]['productrate'] = $row->productrate;
            $ProductList[$k]['retailerMRP'] = $row->price;
            $ProductList[$k]['retailerShowroomId'] = $showroomIdFromQuery;

            $ProductList[$k]['barcode'] = $row->barcode;
            $ProductList[$k]['active'] = $row->active;
            $ProductList[$k]['adminid'] = $adminidFromQuery;

            $ProductList[$k]['brandid'] = $row->brandid;
            $ProductList[$k]['productsize'] = $row->productsize;
            $ProductList[$k]['categorytypeid'] = $row->categorytypeid;
            $ProductList[$k]['subcategoryid'] = $row->subcategoryid;

            $ProductList[$k]['brandname'] = $row->brandname;
            $ProductList[$k]['size'] = $row->size;
            $ProductList[$k]['categorytype'] = $row->categorytype;

		$brandQuery= "SELECT t.brandname FROM `tbl_brand` t WHERE  t.brandid='".$ProductList[$k]['brandid']."' and t.active = 'active'  and adminId = '" . $adminid . "' ";
		$brandDetails = $this->db->query($brandQuery);
		$brandArray = $brandDetails->result_array();
		$brandname=0;
            if(count($brandArray)>0){
               $brandname = $brandArray[0]['brandname'];
		}
		$subcategorQuery= "SELECT t.subcategory FROM `tbl_subCategory` t WHERE  t.subcategoryid='".$ProductList[$k]['subcategoryid']."' and t.active = 'active'  and adminId = '" . $adminid . "' ";
		$subcategoryDetails = $this->db->query($subcategorQuery);
		$subcategoryArray = $subcategoryDetails->result_array();
		$subcategory=0;
            if(count($subcategoryArray)>0){
               $subcategory = $subcategoryArray[0]['subcategory'];
		}
            $salesCountQuery = " SELECT sum(`qty`) as qty,productId, adminid  FROM `tbl_customerreceiptproduct` WHERE adminid='".$adminidFromQuery."' " ;
            if($productIdFromQuery>0 && $productIdFromQuery!="" && $productIdFromQuery!=null){
                $salesCountQuery .=  " and productId = '".$productIdFromQuery."' ";
            }

            if($showroomIdFromQuery>0 && $showroomIdFromQuery!="" && $showroomIdFromQuery!=null){
                $salesCountQuery .=  " and showroomId = '".$showroomIdFromQuery . "' ";
            }
//            echo $salesCountQuery."<br>";
            $salesCountDetails = $this->db->query($salesCountQuery);
            $salesCountDetailsArray = $salesCountDetails->result_array();
            $salesQty = 0;
            if(count($salesCountDetailsArray)>0){
                $salesQty = $salesCountDetailsArray[0]['qty'];
            }

            $totalPQty = $row->quantity;
            $avalableQty = $totalPQty - $salesQty;

            $ProductList[$k]['qty'] = $salesQty;
            $ProductList[$k]['quantity'] = $totalPQty;
            $ProductList[$k]['avalableQty'] = $avalableQty;
	    $ProductList[$k]['subcategory'] = $subcategory;
	    $ProductList[$k]['brandname'] = $brandname;

            $k++;
        }
//echo count($ProductList);
//        echo "<pre>";
//        print_r($ProductList);
//        echo "</pre>";

        $paginationArray['rec_limit'] = $rec_limit;
        $paginationArray['left_rec'] = $left_rec;
        $paginationArray['page'] = $page;
        $paginationArray['resultArrayData'] = $ProductList;

        return $paginationArray;
    }
	  public function getstockList($adminid, $productId, $showroomId, $categorytypeid,$subcategoryid, $brandid, $sizeid, $barcode , $noOfPage)
    {

        $ProductList = array();
        
        $sql = "SELECT t.productid, t.productname, t.productrate, t.barcode, t.productsize, t.categorytypeid,t.subcategoryid, t.active, t.adminid, t.brandid, a.showroomId, tb.brandname, ts.size, tc.categorytype, a.price as price, sum(pb.quantity) as quantity FROM tbl_product t Left JOIN tbl_productMapping a on t.productid = a.productid Left JOIN tbl_productBatch pb on a.productId = pb.productid AND a.showroomId=pb.showRoomId LEFT JOIN tbl_brand tb on tb.brandid=t.brandid LEFT JOIN tbl_sizemaster ts on ts.sizeid=t.productsize LEFT JOIN tbl_categorytype tc on tc.categorytypeid = t.categorytypeid WHERE  t.active = 'active' ";

        if ($showroomId != "0" && $showroomId != "" && $showroomId != null) {
            $sql .= " and a.showroomId = '" . $showroomId . "' ";
        }

        if ($adminid != "0" && $adminid != "" && $adminid != null) {
            $sql .= " and t.adminid = '" . $adminid . "' ";
        }
        if ($productId != "0" && $productId != "" && $productId != null) {
            $sql .= " and t.productid = '" . $productId . "' ";
        }

        //Search Product
        if ($categorytypeid != "0" && $categorytypeid != "" && $categorytypeid != null) {
            $sql .= " and t.categorytypeid = '" . $categorytypeid . "' ";
        }
        if ($subcategoryid != "0" && $subcategoryid != "" && $subcategoryid != null) {
            $sql .= " and t.subcategoryid = '" . $subcategoryid . "' ";
        }
        if ($brandid != "0" && $brandid != "" && $brandid != null) {
            $sql .= " and t.brandid = '" . $brandid . "' ";
        }
        if ($sizeid != "0" && $sizeid != "" && $sizeid != null) {
            $sql .= " and t.productsize = '" . $sizeid . "' ";
        }
        if (($barcode != "" && $barcode != null) || $barcode =="0" ) {
            $sql .= " and t.barcode = '" . $barcode . "' ";
        }

        $sql = $sql . " group by t.productId";

        if($noOfPage!="All"){
            $limitString = $noOfPage * 100;
            $sql = $sql . " order by productid desc limit ".$limitString.", 100";
        }

        $userQuery = $this->db->query($sql);
        $k = 0;
	$results = array();
        foreach ($userQuery->result() as $row) {
            $productIdFromQuery = $row->productid;
            $showroomIdFromQuery = $row->showroomId;
            $adminidFromQuery = $row->adminid;

            $ProductList[$k]['productid'] = $productIdFromQuery;

            $ProductList[$k]['retailerMRP'] = $row->price;
            $ProductList[$k]['active'] = $row->active;
            $ProductList[$k]['adminid'] = $adminidFromQuery;
            $ProductList[$k]['categorytypeid'] = $row->categorytypeid;
            $ProductList[$k]['subcategoryid'] = $row->subcategoryid;
	
		

		$subcategorQuery= "SELECT t.subcategory ,t.subcategoryid FROM `tbl_subCategory` t WHERE  t.subcategoryid='".$ProductList[$k]['subcategoryid']."' and t.active = 'active'  and adminId = '" . $adminid . "' group by t.subcategory";
		$subcategoryDetails = $this->db->query($subcategorQuery);
		$subcategoryArray = $subcategoryDetails->result_array();
		$subcategory=0;

		if(count($subcategoryArray)>0){
               $subcategory = $subcategoryArray[0]['subcategory'];
			
		}
            $salesCountQuery = " SELECT sum(`qty`) as qty,productId, adminid  FROM `tbl_customerreceiptproduct` WHERE adminid='".$adminidFromQuery."' " ;
            if($productIdFromQuery>0 && $productIdFromQuery!="" && $productIdFromQuery!=null){
                $salesCountQuery .=  " and productId = '".$productIdFromQuery."' ";
            }
			
            if($showroomIdFromQuery>0 && $showroomIdFromQuery!="" && $showroomIdFromQuery!=null){
                $salesCountQuery .=  " and showroomId = '".$showroomIdFromQuery . "' ";
            }
//            echo $salesCountQuery."<br>";
            $salesCountDetails = $this->db->query($salesCountQuery);
            $salesCountDetailsArray = $salesCountDetails->result_array();
//            print_r($salesCountDetailsArray);
            $salesQty = 0;
            if(count($salesCountDetailsArray)>0){
                $salesQty = $salesCountDetailsArray[0]['qty'];
            }

		$totalPQty = $row->quantity;
		$avalableQty = $totalPQty - $salesQty;

		$totalProductPrice=$avalableQty * $row->price;
		$results[]=$totalProductPrice;
		$ProductList[$k]['totalProductPrice'] = $totalProductPrice;
		$ProductList[$k]['qty'] = $salesQty;
		$ProductList[$k]['quantity'] = $totalPQty;
		$ProductList[$k]['avalableQty'] = $avalableQty;
		$ProductList[$k]['subcategory'] = $subcategory;
	
            $k++;

       }
		 $ManiResult=implode(",",$results);
		$final= array_sum($results);
        return $ProductList;
    }
public function getSubcategory($adminid)
{
$subcategoryArray=array();
	$subcategorQuery= "SELECT t.subcategory ,t.subcategoryid FROM `tbl_subCategory` t WHERE  t.active = 'active'  and adminId = '" . $adminid . "' group by t.subcategory";
		$subcategoryDetails = $this->db->query($subcategorQuery);
		$subcategoryArray = $subcategoryDetails->result_array();
		$subcategory=0;
 return $subcategoryArray;
}

    public function paginationFunction($rec_limit, $page, $countquery)
    {

        $paginationArray = array();

        $executeQuery = $this->db->query($countquery);
        $countArray = $executeQuery->result_array();
        $rec_count = $countArray[0]['count'];

        if ((isset($page) && $page != "") || $page == "0") {
            $offset = $rec_limit * $page;
            $page = $page + 1;
        } else {
            $page = 0;
            $offset = 0;
        }

        $left_rec = $rec_count - ($page * $rec_limit);
        if ($page == "" || $page == 0) {
            $left_rec = $rec_count - (1 * $rec_limit);
        }

        $paginationLimit = " LIMIT $offset, $rec_limit ";

        $paginationArray['left_rec'] = $left_rec;
        $paginationArray['page'] = $page;
        $paginationArray['rec_limit'] = $rec_limit;
        $paginationArray['paginationLimit'] = $paginationLimit;

        return $paginationArray;

    }

    public function getRetailerProductList($adminid, $productId, $showroomId, $categorytypeid, $brandid, $sizeid, $barcode)
    {

        $RetailerProductList = array();

        $userType = "3";
        $sql = "SELECT  u.name, u.userid, t.productid, t.productname,t.productrate, t.barcode,t.active, t.adminid, a.price as price , sum(pb.quantity) as quantity, b.qty, tb.brandname, ts.size, tc.categorytype FROM `tbl_user` u LEFT JOIN tbl_product t on t.adminid=u.adminid and t.productid =".$this->db->escape($productId)." LEFT Join  tbl_productMapping a on a.showroomId=u.userid and a.productId=t.productid  LEFT Join  tbl_productBatch pb on a.showroomId=pb.showRoomId and pb.productid=t.productid LEFT JOIN tbl_customerreceiptproduct b on t.productId = b.productid and u.userid=b.showroomId LEFT JOIN tbl_brand tb on tb.brandid=t.brandid LEFT JOIN tbl_sizemaster ts on ts.sizeid=t.productsize LEFT JOIN tbl_categorytype tc on tc.categorytypeid = t.categorytypeid WHERE u.active = 'active' and u.adminid=".$this->db->escape($adminid)." and u.usertypeid=" .$this->db->escape($userType)." group by u.userid";
        $userQuery = $this->db->query($sql);

        $k = 0;
        foreach ($userQuery->result() as $row) {
            $ProductList[$k]['name'] = $row->name;
            $ProductList[$k]['retailerShowroomId'] = $row->userid;

            $ProductList[$k]['productid'] = $row->productid;
            $ProductList[$k]['barcode'] = $row->barcode;
            $ProductList[$k]['productname'] = $row->productname;
            $ProductList[$k]['productrate'] = $row->productrate;
            $ProductList[$k]['retailerMRP'] = $row->price;
            $ProductList[$k]['active'] = $row->active;
            $ProductList[$k]['adminid'] = $row->adminid;

            $ProductList[$k]['brandname'] = $row->brandname;
            $ProductList[$k]['size'] = $row->size;
            $ProductList[$k]['categorytype'] = $row->categorytype;

            $salesQty = $row->qty;
            $totalPQty = $row->quantity;
            $avalableQty = $totalPQty - $salesQty;

            $ProductList[$k]['qty'] = $salesQty;
            $ProductList[$k]['quantity'] = $totalPQty;
            $ProductList[$k]['avalableQty'] = $avalableQty;


            $k++;
        }

//        echo "<pre>";
//            print_r($ProductList);
//        echo "</pre>";
        return $ProductList;
    }

    public function getBrandIdAndNameArray($adminid, $actionId)
    {
        $BrandArray = array();
        $sql = "SELECT * FROM `tbl_brand` t WHERE t.active = 'active' ";
        if ($adminid != "" && $adminid != null) {
            $sql .= " and adminid = '" . $adminid . "' ";
        }

        if ($actionId != "" && $actionId != null && $actionId != "0" && $actionId != 0) {
            $sql .= " and brandid = '" . $actionId . "' ";
        }
        $sql = $sql . " order by brandid desc";
        $userQuery = $this->db->query($sql);

        $k = 0;
        foreach ($userQuery->result() as $row) {
            $BrandArray[$row->brandid] = $row->brandname;
        }

        return $BrandArray;
    }

    public function getSizeIdAndNameArray($adminid, $actionId)
    {
        $SizeArray = array();
        $sql = "SELECT * FROM `tbl_sizemaster` t WHERE t.active = 'active'  and adminId = '" . $adminid . "' ";

        if ($actionId != "" && $actionId != null && $actionId != "0" && $actionId != 0) {
            $sql .= " and sizeid = '" . $actionId . "' ";
        }

        $sql = $sql . " order by sizeid desc";
        $userQuery = $this->db->query($sql);

        foreach ($userQuery->result() as $row) {
            $SizeArray[$row->sizeid] = $row->size;
        }

        return $SizeArray;
    }

    public function getCategoryTypeIdAndNameArray($adminid, $actionId)
    {
        $CategoryTypeArray = array();
        $sql = "SELECT * FROM `tbl_categorytype` t WHERE t.active = 'active'  and adminId = '" . $adminid . "' ";

        if ($actionId != "" && $actionId != null && $actionId != "0" && $actionId != 0) {
            $sql .= " and categorytypeid = '" . $actionId . "' ";
        }

        $sql = $sql . " order by categorytypeid desc";
        $userQuery = $this->db->query($sql);
        $k = 0;
        foreach ($userQuery->result() as $row) {
            $CategoryTypeArray[$row->categorytypeid] = $row->categorytype;
        }

        return $CategoryTypeArray;
    }

    public function createUserMaster($userDetailsArray)
    {
        $doj = $userDetailsArray['doj'];
        if ($doj == NULL) {
            $doj = "0000-00-00";
        }

        $dob = $userDetailsArray['dob'];
        if ($dob == NULL) {
            $dob = "0000-00-00";
        }

        $retailershowroomid = $userDetailsArray['retailershowroomid'];
        if ($retailershowroomid == NULL) {
            $retailershowroomid = 0;
        }

        $sql = "INSERT INTO tbl_user (name,email,aliasName,password,usertypeid,adminid,retailerShowRoomId,mobile,address,doj,dob, tinnumber, cinnumber, BankName,IFSCode,AccountNumber,active,createdat) " . "VALUES (" . $this->db->escape($userDetailsArray['name']) . "," . $this->db->escape($userDetailsArray['email']) . "," . $this->db->escape($userDetailsArray['Barcode']) . "," . $this->db->escape($userDetailsArray['password']) . "," . $this->db->escape($userDetailsArray['usertypeid']) . "," . $this->db->escape($userDetailsArray['adminid']) . "," . $this->db->escape($retailershowroomid) . "," . $this->db->escape($userDetailsArray['mobile']) . "," . $this->db->escape($userDetailsArray['address']) . "," . $this->db->escape($doj) . "," . $this->db->escape($dob). "," . $this->db->escape($userDetailsArray['tinnumber']) . "," . $this->db->escape($userDetailsArray['cinnumber']) . "," . $this->db->escape($userDetailsArray['bankname'])  . "," . $this->db->escape($userDetailsArray['ifscode'])  . "," . $this->db->escape($userDetailsArray['accountno'])  . "," . $this->db->escape($userDetailsArray['active']) . "," . $this->db->escape($userDetailsArray['createdAt']) . ")";
        $this->db->query($sql);
    }

    public function updateUserMaster($userDetailsArray)
    {
        $doj = $userDetailsArray['doj'];
        if ($doj == NULL) {
            $doj = "0000-00-00";
        }

        $dob = $userDetailsArray['dob'];
        if ($dob == NULL) {
            $dob = "0000-00-00";
        }

        $retailershowroomid = $userDetailsArray['retailershowroomid'];
        if ($retailershowroomid == NULL) {
            $retailershowroomid = 0;
        }
        $sql = "Update tbl_user SET name = " . $this->db->escape($userDetailsArray['name']) . ", email = " . $this->db->escape($userDetailsArray['email']) . ", password = " . $this->db->escape($userDetailsArray['password']) . ", mobile = " . $this->db->escape($userDetailsArray['mobile']) . ", address = " . $this->db->escape($userDetailsArray['address']) . ", doj = " . $this->db->escape($doj) . ", dob =" . $this->db->escape($dob). ", tinnumber =" . $this->db->escape($userDetailsArray['tinnumber']). ", cinnumber =" . $this->db->escape($userDetailsArray['cinnumber']). ", BankName =" . $this->db->escape($userDetailsArray['bankname'])  . ", IFSCode =" . $this->db->escape($userDetailsArray['ifscode'])  . ", AccountNumber =" . $this->db->escape($userDetailsArray['accountno'])  . " WHERE userid=" . $userDetailsArray['userid'];
        $this->db->query($sql);
    }

    public function createBrandMaster($BrandDetailsArray)
    {
        $sql = "INSERT INTO tbl_brand (brandname,adminid,createdat) " . "VALUES (" . $this->db->escape($BrandDetailsArray['brandname']) . "," . $this->db->escape($BrandDetailsArray['adminid']) . "," . $this->db->escape($BrandDetailsArray['createdAt']) . ")";
        $this->db->query($sql);
    }
public function createExpenses($ExpensesDetailsArray)
    {
        $sql = "INSERT INTO tbl_Expenses (Reasons,Amount,showroomId,adminId,createdAt) " . "VALUES (" . $this->db->escape($ExpensesDetailsArray['Reasons']) . ",". $this->db->escape($ExpensesDetailsArray['Amount']) ."," . $this->db->escape($ExpensesDetailsArray['showroomId']) . "," . $this->db->escape($ExpensesDetailsArray['adminid']) . "," . $this->db->escape($ExpensesDetailsArray['createdAt']) . ")";
        $this->db->query($sql);
    }
public function createMaintenance($MaintenanceArray)
    {
        $sql = "INSERT INTO tbl_Maintenance (Reasons,Amount,paidDate,showroomId,adminId,createdAt) " . "VALUES (" . $this->db->escape($MaintenanceArray['Reasons']) . ",". $this->db->escape($MaintenanceArray['Amount']) .",".$this->db->escape($MaintenanceArray['Date']) ."," . $this->db->escape($MaintenanceArray['showroomId']) . "," . $this->db->escape($MaintenanceArray['adminid']) . "," . $this->db->escape($MaintenanceArray['createdAt']) . ")";
        $this->db->query($sql);
    }

    public function updateBrandMaster($BrandDetailsArray)
    {
        $sql = "UPDATE tbl_brand set brandname = " . $this->db->escape($BrandDetailsArray['brandname']) . " where brandid = " . $this->db->escape($BrandDetailsArray['brandid']) . " and adminid = " . $this->db->escape($BrandDetailsArray['adminid']);
        return $this->db->query($sql);
    }

    public function deleteBrandMaster($BrandDetailsArray)
    {
        $active = "deleted";
        $sql = "UPDATE tbl_brand set active = " . $this->db->escape($active) . " where brandid = " . $this->db->escape($BrandDetailsArray['brandid']) . " and adminid = " . $this->db->escape($BrandDetailsArray['adminid']);
        return $this->db->query($sql);
    }

    public function updateSizeMaster($SizeDetailsArray)
    {
        $sql = "UPDATE tbl_sizemaster set size = " . $this->db->escape($SizeDetailsArray['size']) . " where sizeid = " . $this->db->escape($SizeDetailsArray['sizeid']) . " and adminid = " . $this->db->escape($SizeDetailsArray['adminid']);
        return $this->db->query($sql);
    }

    public function deleteSizeMaster($SizeDetailsArray)
    {
        $active = "deleted";
        $sql = "UPDATE tbl_sizemaster set active = " . $this->db->escape($active) . " where sizeid = " . $this->db->escape($SizeDetailsArray['sizeid']) . " and adminid = " . $this->db->escape($SizeDetailsArray['adminid']);
        return $this->db->query($sql);
    }

    public function updateCategoryTypeMaster($SizeDetailsArray)
    {
        $sql = "UPDATE tbl_categorytype set categorytype = " . $this->db->escape($SizeDetailsArray['categoryType']) . " where categorytypeid = " . $this->db->escape($SizeDetailsArray['categorytypeid']) . " and adminid = " . $this->db->escape($SizeDetailsArray['adminid']);
        return $this->db->query($sql);
    }

    public function deleteCategoryTypeMaster($CategoryTypeDetailsArray)
    {
        $active = "deleted";
        $sql = "UPDATE tbl_categorytype set active = " . $this->db->escape($active) . " where categorytypeid = " . $this->db->escape($CategoryTypeDetailsArray['categorytypeid']) . " and adminid = " . $this->db->escape($CategoryTypeDetailsArray['adminid']);
        return $this->db->query($sql);
    }

    public function createCategoryTypeMaster($BrandDetailsArray)
    {
        $sql = "INSERT INTO tbl_categorytype (categorytype,adminid,createdat) " . "VALUES (" . $this->db->escape($BrandDetailsArray['categoryType']) . "," . $this->db->escape($BrandDetailsArray['adminid']) . "," . $this->db->escape($BrandDetailsArray['createdAt']) . ")";
        $this->db->query($sql);
    }

    public function updateSubCategoryMaster($subCategoryDetailsArray)
    {
        $sql = "UPDATE tbl_subCategory set subcategory = " . $this->db->escape($subCategoryDetailsArray['subcategory']) . ", categorytypeid =".$this->db->escape($subCategoryDetailsArray['categorytypeid'])."  where subcategoryid = " . $this->db->escape($subCategoryDetailsArray['subcategoryid']) . " and adminid = " . $this->db->escape($subCategoryDetailsArray['adminid']);
        return $this->db->query($sql);
    }

    public function deleteSubCategoryMaster($subCategoryDetailsArray)
    {
        $active = "deleted";
        $sql = "UPDATE tbl_subCategory set active = " . $this->db->escape($active) . " where subcategoryid = " . $this->db->escape($subCategoryDetailsArray['subcategoryid']) . " and adminid = " . $this->db->escape($subCategoryDetailsArray['adminid']);
        return $this->db->query($sql);
    }

    public function createSubCategoryMaster($subCategoryDetailsArray)
    {
        $sql = "INSERT INTO tbl_subCategory (subcategory, categorytypeid,adminid,createdat) " . "VALUES (" . $this->db->escape($subCategoryDetailsArray['subcategory']) . "," . $this->db->escape($subCategoryDetailsArray['categorytypeid']) . "," .$this->db->escape($subCategoryDetailsArray['adminid']) . "," . $this->db->escape($subCategoryDetailsArray['createdAt']) . ")";
        $this->db->query($sql);
    }

    public function deleteProductMaster($ProductDetailsDeleteArray)
    {
        $active = "deleted";
        $sql = "UPDATE tbl_product set active = " . $this->db->escape($active) . " where productid = " . $this->db->escape($ProductDetailsDeleteArray['productid']) . " and adminid = " . $this->db->escape($ProductDetailsDeleteArray['adminid']);
        return $this->db->query($sql);
    }

    public function createProductMaster($ProductDetailsArray)
    {
        $sql = "INSERT INTO tbl_product (productname, productrate, productsize, barcode, categorytypeid,subcategoryid, brandid, adminid, active, createdat) " . "VALUES (" . $this->db->escape($ProductDetailsArray['productname']) . "," . $this->db->escape($ProductDetailsArray['price']) . "," . $this->db->escape($ProductDetailsArray['size']) . "," . $this->db->escape($ProductDetailsArray['barcode']) . "," . $this->db->escape($ProductDetailsArray['categorytypeid']) .",".$this->db->escape($ProductDetailsArray['subcategoryid']) .",". $this->db->escape($ProductDetailsArray['brandname']) . "," . $this->db->escape($ProductDetailsArray['adminid']) . "," . $this->db->escape($ProductDetailsArray['active']) . "," . $this->db->escape($ProductDetailsArray['createdAtdate']) . ")";
        $this->db->query($sql);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function updateProductMaster($ProductDetailsArray)
    {
        $sql = "UPDATE tbl_product set productname = " . $this->db->escape($ProductDetailsArray['productname']) . ", productrate = " . $this->db->escape($ProductDetailsArray['price']) . ", productsize = " . $this->db->escape($ProductDetailsArray['size']) . ", categorytypeid = " . $this->db->escape($ProductDetailsArray['categorytypeid'])  . ", subcategoryid = " . $this->db->escape($ProductDetailsArray['subcategoryid']) . ", brandid = " . $this->db->escape($ProductDetailsArray['brandname']) . " where productid = " . $this->db->escape($ProductDetailsArray['productid']) . " and adminid = " . $this->db->escape($ProductDetailsArray['adminid']);
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

            if ((count($alreadyExistList) > 0 && $action == 'Add') || count($alreadyExistList) > 1 && $action == 'Edit') {
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

    public function getRedirectURLForMaster($usertypeid)
    {

        $redirectUrl = "";
        switch ($usertypeid) {
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
                $redirectUrl = "Frontend/supplierMaster";
                break;
        }
        return $redirectUrl;
    }

    public function deleteUsersFromMaster($userid, $adminid)
    {
        $success = 0;
        if ($userid != "" && $adminid != "") {
            $sql = "Update tbl_user set active = 'deleted' where active='active' and userid=" . $userid . " and adminid=" . $adminid;
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
 public function convertDDMMYYtoYYMMDDnew($bookingDate)
    {
    $returnBookingDate = "0000-00-00";
        if ($bookingDate != null) {
            if ($bookingDate != "" && $bookingDate != "00-00-0000") {
                $returnBookingDateArray = explode("-", $bookingDate);
                if (count($returnBookingDateArray) > 0) {
                    $returnBookingDate = $returnBookingDateArray[2] . "-" . $returnBookingDateArray[0] . "-" . $returnBookingDateArray[1];
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

        if ($actionId != "" && $actionId != null && $actionId != "0" && $actionId != 0) {
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

        if ($actionId != "" && $actionId != null && $actionId != "0" && $actionId != 0) {
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

    public function getSubCategoryList($adminid, $actionId, $categoryTypeId)
    {

        $SizeArray = array();
        $sql = "SELECT s.subcategoryid, s.categorytypeid, s.subcategory, s.adminid, s.active, s.createdAt, c.categorytype FROM `tbl_subCategory` s LEFT JOIN tbl_categorytype c on c.categorytypeid=s.categorytypeid WHERE s.active = 'active' ";
        if ($adminid != "" && $adminid != null) {
            $sql .= " and s.adminid = '" . $adminid . "' ";
        }

        if ($actionId != "" && $actionId != null && $actionId != "0" && $actionId != 0) {
            $sql .= " and s.subcategoryid = '" . $actionId . "' ";
        }

        if ($categoryTypeId != "" && $categoryTypeId != null && $categoryTypeId != "0" && $categoryTypeId != 0) {
            $sql .= " and s.categorytypeid = '" . $categoryTypeId . "' ";
        }

        $sql = $sql . " order by categorytypeid desc";
        $userQuery = $this->db->query($sql);
        $k = 0;
        foreach ($userQuery->result() as $row) {
            $SizeArray[$k]['subcategoryid'] = $row->subcategoryid;
            $SizeArray[$k]['categorytypeid'] = $row->categorytypeid;
            $SizeArray[$k]['categorytype'] = $row->categorytype;
            $SizeArray[$k]['subcategory'] = $row->subcategory;
            $SizeArray[$k]['adminId'] = $row->adminid;
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

    public function assignMapProduct($ProductMappingArray){
        $productid = $ProductMappingArray['productid'];
        $quantity = $ProductMappingArray['quantity'];
        $Incquantity = $ProductMappingArray['Incquantity'];
        $price = $ProductMappingArray['price'];
        $newPrice = $ProductMappingArray['newPrice'];
        $showroomId = $ProductMappingArray['showroomId'];
        $adminid = $ProductMappingArray['adminid'];
        $createdAtdate = date("Y-m-d H:i:s");

        $sql = "SELECT * FROM `tbl_productMapping` WHERE `productId`=".$this->db->escape($productid)." and `showroomId` = ".$this->db->escape($showroomId)." and `adminId`=".$this->db->escape($adminid);
        $userQuery = $this->db->query($sql);
        $existArrayResult = $userQuery->result_array();

        if(count($existArrayResult)>0){

            /*$deleted = "deleted";
            $deleteId = $existArrayResult[0]['id'];
            $deletesql = "UPDATE `tbl_productMapping` SET `active`=".$this->db->escape($deleted).",`deletedat`= ".$this->db->escape($createdAtdate)." WHERE id = ".$this->db->escape($deleteId);
            $this->db->query($deletesql);

            if($price!="on"){
                $newPrice = $existArrayResult[0]['price'];
            }

            if($Incquantity>0 || $newPrice>0){
                $active = "active";
                $sql = "INSERT INTO tbl_productMapping (productId,showroomId,price,quantity,adminId,createAt,active) " . "VALUES (" . $this->db->escape($productid) . "," . $this->db->escape($showroomId) . "," . $this->db->escape($newPrice) . "," . $this->db->escape($Incquantity) . "," . $this->db->escape($adminid) . "," . $this->db->escape($createdAtdate) . "," . $this->db->escape($active) . ")";
                $this->db->query($sql);
            }*/

            $updatedId = $existArrayResult[0]['id'];
            if($price=="on" || $Incquantity>0){


                if($price=="on"){
                    $updateSql = "UPDATE `tbl_productMapping` SET ";
                    $updateSql = $updateSql . " price =".$this->db->escape($newPrice);
                    $updateSql = $updateSql ."  WHERE id = ".$this->db->escape($updatedId);
                    $this->db->query($updateSql);
                }

                if($Incquantity>0){
                    $supplierId = "0";
                    $sql = "INSERT INTO tbl_productBatch (productid,showRoomId,supplierId,quantity,adminId,createdAt) " . "VALUES (" . $this->db->escape($productid) . "," . $this->db->escape($showroomId) . "," . $this->db->escape($supplierId) . "," . $this->db->escape($Incquantity) . "," . $this->db->escape($adminid) . "," . $this->db->escape($createdAtdate) . ")";
                    $this->db->query($sql);
//                    $Incquantity = $Incquantity + $existArrayResult[0]['quantity'];
//                    if($price=="on"){
//                        $updateSql = $updateSql . ", ";
//                    }
//
//                    $updateSql = $updateSql . " quantity =".$this->db->escape($Incquantity);
                }
            }

        } else {
            $sql = "INSERT INTO tbl_productMapping (productId,showroomId,price,adminId,createAt) " . "VALUES (" . $this->db->escape($productid) . "," . $this->db->escape($showroomId) . "," . $this->db->escape($newPrice) . "," . $this->db->escape($adminid) . "," . $this->db->escape($createdAtdate) . ")";
            $this->db->query($sql);

            $supplierId = "0";
            $sql = "INSERT INTO tbl_productBatch (productid,showRoomId,supplierId,quantity,adminId,createdAt) " . "VALUES (" . $this->db->escape($productid) . "," . $this->db->escape($showroomId) . "," . $this->db->escape($supplierId) . "," . $this->db->escape($Incquantity) . "," . $this->db->escape($adminid) . "," . $this->db->escape($createdAtdate) . ")";
            $this->db->query($sql);
        }

    }

    public function getshowroomList($userType, $retailerShowRoomId)
    {

        $showroomArray = array();
        $sql = "SELECT  name,userid FROM `tbl_user` t WHERE t.active = 'active' and adminid='" . $userType . "'and usertypeid='" . $retailerShowRoomId . "'";
        /*if ($adminid != "" && $adminid != null) {
            $sql .= "and usertypeid='".$userType."' ";
        }
*/
        $userQuery = $this->db->query($sql);
        $k = 0;
        foreach ($userQuery->result() as $row) {
            $showroomArray[$k]['name'] = $row->name;
            $showroomArray[$k]['userid'] = $row->userid;
            $k++;
        }

        return $showroomArray;
    }

    public function createProductmappingMaster($ProductMappingArray)
    {
        $sql = "INSERT INTO tbl_productMapping (productId,showroomId,price,adminId,createAt) " . "VALUES (" . $this->db->escape($ProductMappingArray['productId']) . "," . $this->db->escape($ProductMappingArray['ShowroomId']) . "," . $this->db->escape($ProductMappingArray['mappedprice']) . "," . $this->db->escape($ProductMappingArray['adminid']) . "," . $this->db->escape($ProductMappingArray['createdAtdate']) . ")";
        $this->db->query($sql);

        $supplierId = "0";
        $sql = "INSERT INTO tbl_productBatch (productid,showRoomId,supplierId,quantity,adminId,createdAt) " . "VALUES (" . $this->db->escape($ProductMappingArray['productId']) . "," . $this->db->escape($ProductMappingArray['ShowroomId']) . "," . $this->db->escape($supplierId) . "," . $this->db->escape($ProductMappingArray['mappedqyt']) . "," . $this->db->escape($ProductMappingArray['adminid']) . "," . $this->db->escape($ProductMappingArray['createdAtdate']) . ")";
        $this->db->query($sql);

    }

    public function getCategoryLetters($categorytypeid){
        $categoryLetter = "";
        $sql = "SELECT categorytype FROM `tbl_categorytype` WHERE active='active' and categorytypeid='".$categorytypeid."' ";
        $cateQuery = $this->db->query($sql);
        $returnValue = $cateQuery->result_array();
        if(count($returnValue)>0){
            $categoryLetter = substr($returnValue[0]['categorytype'], 0, 1);
        }
        return $categoryLetter;
    }

    public function getCountOfProductByAdmin($adminid){
        $countOfProduct = 0;
        $sql = "SELECT count(*) as productCount FROM `tbl_product` WHERE adminid='".$adminid."' ";
        $cateQuery = $this->db->query($sql);
        $returnValue = $cateQuery->result_array();
        if(count($returnValue)>0){
            $countOfProduct = $returnValue[0]['productCount'];
        }
        $countOfProduct = $countOfProduct + 1;

        return $countOfProduct;
    }

    public function getNewProductBarcde($adminid, $categorytypeid){

        $aliasName = "";

        $userArray = self::getUsersList("2", null, null, $adminid);

        if(count($userArray)>0){
            $aliasName = $userArray[0]['aliasName'];
        }
        $maxOfProductId = self::getCountOfProductByAdmin($adminid);
        $categoryLetter = self::getCategoryLetters($categorytypeid);


        $initialBarcode = 1000;
        $barcodeNo = $maxOfProductId + $initialBarcode;
        $barcode = $aliasName.$categoryLetter.$barcodeNo;
        return $barcode;
    }

    public function mappedProduct($productId, $showroomId, $adminid, $type)
    {

        $productListArray = array();

        /*if($productId==""){
             $sql = "SELECT t.productid,t.productname FROM tbl_product t INNER JOIN tbl_productMapping a WHERE  a.showroomId ='" .$showroomId."' and t.adminid='".$adminid."'";
          $userQuery = $this->db->query($sql);
            $k = 0;
            foreach ($userQuery->result() as $row) {
            $productListArray[$k]['productid']= $row->productid;
            $productListArray[$k]['productname']= $row->productname;

            $k++;
            }
        }
        else
        {
            $sql = "SELECT a.price,a.quantity, sum(b.qty) as qyt FROM tbl_productMapping a INNER JOIN tbl_customerreceiptproduct b  WHERE  a.showroomId ='" .$showroomId."' and a.adminid='".$adminid."' and b.productId='".$productId."' and a.productId='".$productId."' ";

          $userQuery = $this->db->query($sql);
            $k = 0;
            foreach ($userQuery->result() as $row) {
            $totalPQty=$productListArray[$k]['quantity']= $row->quantity;
            $productListArray[$k]['price']= $row->price;
            $salesQty=$productListArray[$k]['qyt']= $row->qyt;
            $avalableQty=$totalPQty-$salesQty;
            $productListArray[0]['avalableQty']=$avalableQty;
            $k++;
            }
        }*/

        $sql = "SELECT t.productid, t.productname, a.price, sum(pb.quantity) as quantity, sum(b.qty) as qty  FROM tbl_product t LEFT JOIN tbl_productMapping a on t.productid = a.productid LEFT JOIN tbl_productBatch pb on pb.productid = a.productId LEFT JOIN tbl_customerreceiptproduct b on t.productId = b.productid  WHERE  t.adminid='" . $adminid . "' ";
        if ($productId != "") {
            $sql = $sql . "and t.productid = '" . $productId . "'";
        }

        if($type=="productQtyandPrice"){
            if ($showroomId != "") {
                $sql = $sql . " and a.showroomId ='" . $showroomId . "' and a.showroomId is not NULL ";
            }
        }
        $sql = $sql . " group by t.productId";

        $userQuery = $this->db->query($sql);
        $k = 0;
        foreach ($userQuery->result() as $row) {
            $productListArray[$k]['productid'] = $row->productid;
            $productListArray[$k]['productname'] = $row->productname;
            $productListArray[$k]['price'] = $row->price;
   	        $salesQty=$productListArray[$k]['qty']= $row->qty;
            $totalPQty=$productListArray[$k]['quantity']= $row->quantity;
            $avalableQty=$totalPQty-$salesQty;
            $productListArray[$k]['avalableQty'] = $avalableQty;
            $k++;
        }

//            print_r($productListArray);
        return $productListArray;
    }
	public function createAttendance($salesManAttendancearray)
    {
        $sql = "INSERT INTO tbl_Attendance (salesManId, AttendanceDate,showroomId,adminId,createdAt) " . "VALUES (" . $this->db->escape($salesManAttendancearray['salesManarray']) . "," . $this->db->escape($salesManAttendancearray['Attedate']) . "," . $this->db->escape($salesManAttendancearray['showroomId']) . "," . $this->db->escape($salesManAttendancearray['adminid']) . "," . $this->db->escape($salesManAttendancearray['createdAt']) . ")";
        $this->db->query($sql);
    }
	public function getAttendanceList($showroomId,$date){
	$salesmanList = "";

        $sql = "SELECT j.salesManId FROM tbl_Attendance j WHERE j.showroomId='".$showroomId."' and j.AttendanceDate='".$date."'";
        $AttendanceQuery = $this->db->query($sql);
        $returnValue = $AttendanceQuery->result_array();
	return $returnValue;	
	}
public function getMigiraton(){
	//$sql = "SELECT j.barcode FROM Mens k INNER JOIN tbl_product j ON j.barcode = k.barcodeNew WHERE k.barcodeNew IS NOT NULL AND j.existingProcode IS NOT NULL ";
	$sql = "SELECT j.barcode FROM tbl_product j WHERE j.active='newproduct'  ";
        $result = $this->db->query($sql);
        $returnValue = $result->result_array();
 	echo count($returnValue);
	$uids = Array();
	foreach($returnValue as $u){ $uids[] = $u['barcode'];
 $list = implode("','",$uids);
	$sqlnewupdate = "UPDATE `tbl_product` SET `active`='active' where `barcode`in('".$list."') ";
$result = $this->db->query($sqlnewupdate);	
	}

       	} 
	public function getsalesmanList($showroomId){

        $sql = "SELECT name,userid FROM tbl_user WHERE usertypeid in(4,5) and retailerShowRoomId='".$showroomId."'";
        $cateQuery = $this->db->query($sql);
        $returnValue = $cateQuery->result_array();
	
        return $returnValue;
    	}
	 public function deleteQuery($showroomId, $deleteBillNo)
    {
	 $sql = "SELECT id FROM tbl_customerreceipt WHERE billNo='".$deleteBillNo."' and showRoomId= '".$showroomId."' ";
       	 $reciptarray = $this->db->query($sql);
        $returnValue = $reciptarray->result_array();
	if(count($returnValue)>0){
		$customerreceiptproduct = "DELETE FROM tbl_customerreceiptproduct WHERE showroomId= '".$showroomId."' and receiptId='".$returnValue[0]['id']."'";
		$this->db->query($customerreceiptproduct);

		$customerreceipt = "DELETE FROM tbl_customerreceipt WHERE showRoomId= '".$showroomId."' and billNo='".$deleteBillNo."'";
		$this->db->query($customerreceipt);
		echo "Success";
	}
	else {
		echo "Invalid Billno ";	
	}
    }
	 public function createdailyPayment($dailyPaymentarray)
    {
        $sql = "INSERT INTO tbl_dailySalesPament (Paidby,totalAmount,paidDate,description,showroomId,adminId,createdAt) " . "VALUES (" . $this->db->escape($dailyPaymentarray['Paidby']) . "," . $this->db->escape($dailyPaymentarray['Amount']) . "," . $this->db->escape($dailyPaymentarray['DatenewOne']) . "," . $this->db->escape($dailyPaymentarray['Description']) . "," . $this->db->escape($dailyPaymentarray['showroomId']) . "," . $this->db->escape($dailyPaymentarray['adminid']) . "," . $this->db->escape($dailyPaymentarray['createdAt']) . ")";
        $this->db->query($sql);
	$msg="success";
return $msg;
    }
public function changeStatus($adminid, $productid)
    { 
		$changeStatus = "UPDATE `tbl_product` SET `active`='deactive' WHERE adminid='".$adminid."' and productid='".$productid."'";
		$this->db->query($changeStatus);
		echo "Success";
	
	}
public function quCheck($barcode)
    	{ 
$returnValue = array();
	 $sql = "SELECT j.productid,j.active,sum(k.qty) as salescount FROM tbl_product j inner join tbl_customerreceiptproduct k on k.productId =j.productid WHERE j.barcode ='".$barcode."' and k.showroomId=3 ";

       	$reciptarray = $this->db->query($sql);
        $return = $reciptarray->result_array();

	if($return[0]['salescount']!=""){
	$sqldate = "SELECT k.date,j.receiptId FROM tbl_customerreceiptproduct j INNER JOIN tbl_customerreceipt k on k.id=j.receiptId WHERE j.productId ='".$return[0]['productid']."' ORDER BY k.billNo DESC; ";
       	$reciptarraydate = $this->db->query($sqldate);
        $returndate = $reciptarraydate->result_array();

	$returnValue[0]['date']=$returndate[0]['date'];
	}
	else{
			$returnValue[0]['date']="Not Sales";
	}

	$returnValue[0]['productid']=$return[0]['productid'];

	$returnValue[0]['active']=$return[0]['active'];
		
		if($return[0]['salescount']==null){
		$returnValue[0]['salescount']=0;
		}else{	
		$returnValue[0]['salescount']=$return[0]['salescount'];
		}
		$sql1 = "SELECT j.id,j.quantity,sum(j.quantity) as totalcount FROM tbl_productBatch j WHERE j.productid ='".$return[0]['productid']."'";
       	$reciptarraynew = $this->db->query($sql1);
        $returnnew = $reciptarraynew->result_array();
	$returnValue[0]['totalcount']=$returnnew[0]['totalcount'];
	$returnValue[0]['quantity']=$returnnew[0]['quantity']-$return[0]['salescount'];
	$returnValue[0]['id']=$returnnew[0]['id'];
return $returnValue;
	
	}
public function qtyUpdate($operationtype,$barcode,$qty)
    	{ 
		if($operationtype=='status'){
			$changeStatus = "UPDATE `tbl_product` SET `active`='active' WHERE barcode='".$barcode."'";
			$this->db->query($changeStatus);
			echo "Success";
		}
		if($operationtype=='qty'){
			echo $changeStatus = "UPDATE `tbl_productBatch` SET `quantity`='".$qty."' WHERE id='".$barcode."'";
			$this->db->query($changeStatus);
			echo "Success";
		}
		if($operationtype=='delete'){
			$changeStatus = "DELETE FROM `tbl_productBatch`WHERE id='".$barcode."'";
			$this->db->query($changeStatus);
			echo "Success";
		}
	}
}

?>

