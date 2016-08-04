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

    public function checkUserCredential($userCredentialArray){
        $username=$userCredentialArray['username'];
        $password=$userCredentialArray['userpassword'];
        $userList=array();

        //Select active list from both user and usertype table
        $sql="SELECT t.userid, t.name, t.email, t.usertypeid, t.adminid, t.mobile, t.address, t.lastlogin, u.redirecturl, u.usertype  FROM `tbl_usertype` u INNER JOIN tbl_user t ON u.usertypeid = t.usertypeid and u.active='active' WHERE t.email = '".$username."' and t.password = '".$password."' and t.active = 'active' ";
        $query = $this->db->query($sql);
        foreach ($query->result() as $row)
        {
            $userList['userid'] = $row->userid;
            $userList['name'] = $row->name;
            $userList['email'] = $row->email;
            $userList['usertypeid'] = $row->usertypeid;
            $userList['adminid'] = $row->adminid;
            $userList['mobile'] = $row->mobile;
            $userList['address'] = $row->address;
            $userList['lastlogin'] = $row->lastlogin;
            $userList['redirecturl'] = $row->redirecturl;
            $userList['usertype'] = $row->usertype;
        }
        return $userList;
    }

    public function updateLastlogin($userid){
        $data=array('lastlogin'=>date('Y-m-d H:m:s'));
        $this->db->where('userid', $userid);
        return $this->db->update('tbl_user', $data);
    }

    public function getSuccessMsg($output){
        $successMsg="";
        if (isset($output))
        {
            if ($output['status'] == '1')
            {
                $successMsg.='<div class="alert alert-success">';
            }
            elseif ($output['status'] == '2')
            {
                $successMsg.='<div class="alert alert-error">';
            }
            else
            {
                $successMsg.='<div class="alert alert-error">';
            }

            $successMsg.='<button type="button" class="close" data-dismiss="alert">&times;</button>';
            $successMsg.='<strong>' . $output['message'] . '</strong>' ;
            $successMsg.='</div>';
        }
        return $successMsg;
    }

    public function getUserTypeList($usertypeid){

        $userTypeArray = array();

        $sql = "SELECT t.usertypeid, t.usertype, t.redirecturl FROM `tbl_usertype` t WHERE t.active = 'active' ";
        if($usertypeid != null){
            $sql = $sql . " and usertypeid = ".$usertypeid;
        }
        $sql = $sql . " order by usertypeid asc";
        $userTypeQuery = $this->db->query($sql);
        $k = 0;
        foreach ($userTypeQuery->result() as $row)
        {
            $userTypeArray[$k]['usertypeid'] = $row->usertypeid;
            $userTypeArray[$k]['usertype'] = $row->usertype;
            $userTypeArray[$k]['redirecturl'] = $row->redirecturl;
            $k++;
        }

        return $userTypeArray;
    }

    public function getUsersList($usertypeid, $adminid, $retailerShowRoomId){

        $userArray = array();
        $sql = "SELECT * FROM `tbl_user` t WHERE t.active = 'active' ";
	if($adminid != "" && $adminid != null){
		$sql .= " and adminid = '".$adminid."' "; 
	}

        if($usertypeid != null && $usertypeid != ""){
            $sql = $sql . " and usertypeid = ".$usertypeid;
        }

        $sql = $sql . " order by userid desc";
        $userQuery = $this->db->query($sql);
        $k = 0;
        foreach ($userQuery->result() as $row)
        {
            $userArray[$k]['userid'] = $row->userid;
            $userArray[$k]['name'] = $row->name;
	    $userArray[$k]['email'] = $row->email;
	    $userArray[$k]['password'] = $row->password;
            $userArray[$k]['usertypeid'] = $row->usertypeid;
	    $userArray[$k]['adminid'] = $row->adminid;
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

public function getBrandList($adminid){

        $BrandArray = array();
       $sql = "SELECT * FROM `tbl_brand` t WHERE t.active = 'active' ";
	if($adminid != "" && $adminid != null){
		$sql .= " and adminid = '".$adminid."' "; 
	}

        $sql = $sql . " order by brandid desc";
        $userQuery = $this->db->query($sql);
        $k = 0;
        foreach ($userQuery->result() as $row)
        {
            $BrandArray[$k]['brandid'] = $row->brandid;
            $BrandArray[$k]['brandname'] = $row->brandname;
	    $BrandArray[$k]['adminid'] = $row->adminid;
	    $BrandArray[$k]['active'] = $row->active;
            $BrandArray[$k]['createdat'] = $row->createdat;
	    $k++;
        }

        return $BrandArray;
    }
public function getProductList($adminid){

        $ProductList = array();
       $sql = "SELECT * FROM `tbl_product` t WHERE t.active = 'active' ";
	if($adminid != "" && $adminid != null){
		$sql .= " and adminid = '".$adminid."' "; 
	}

        $sql = $sql . " order by productid desc";
        $userQuery = $this->db->query($sql);
        $k = 0;
        foreach ($userQuery->result() as $row)
        {
		$ProductList[$k]['productid'] = $row->productid;
		$ProductList[$k]['productname'] = $row->productname;
		$ProductList[$k]['productrate'] = $row->productrate;
		$ProductList[$k]['availablequantity'] = $row->availablequantity;
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

    public function createUserMaster($userDetailsArray){
	 $sql = "INSERT INTO tbl_user (name,email,password,usertypeid,adminid,retailerShowRoomId,mobile,address,doj,dob,active,createdat) " ."VALUES (" .$this->db->escape($userDetailsArray['name']) ."," .$this->db->escape($userDetailsArray['email']) ."," .$this->db->escape($userDetailsArray['password']) ."," .$this->db->escape($userDetailsArray['usertypeid']) ."," .$this->db->escape($userDetailsArray['adminid']) ."," .$this->db->escape($userDetailsArray['retailerShowRoomId']) ."," .$this->db->escape($userDetailsArray['mobile']) ."," .$this->db->escape($userDetailsArray['address']) ."," .$this->db->escape($userDetailsArray['doj']) ."," .$this->db->escape($userDetailsArray['dob']) ."," .$this->db->escape($userDetailsArray['active']) ."," .$this->db->escape($userDetailsArray['createdAt']) .")";
			$this->db->query($sql);
    }
 public function createBrandMaster($BrandDetailsArray){
	 $sql = "INSERT INTO tbl_brand (brandname,adminid,createdat) " ."VALUES (" .$this->db->escape($BrandDetailsArray['brandname']) ."," .$this->db->escape($BrandDetailsArray['adminid']) ."," .$this->db->escape($BrandDetailsArray['createdAt']) .")";
			$this->db->query($sql);
    }
	public function createProductMaster($ProductDetailsArray){
	 $sql = "INSERT INTO tbl_product (productname,productrate,availablequantity,barcode,productsize,categorytypeid,brandid,adminid,active,createdat) " ."VALUES (" .$this->db->escape($ProductDetailsArray['productname']) ."," .$this->db->escape($ProductDetailsArray['price']) ."," .$this->db->escape($ProductDetailsArray['quantity']) ."," .$this->db->escape($ProductDetailsArray['barcode']) ."," .$this->db->escape($ProductDetailsArray['size']) ."," .$this->db->escape($ProductDetailsArray['categorytypeid']) ."," .$this->db->escape($ProductDetailsArray['brandname']) ."," .$this->db->escape($ProductDetailsArray['adminid']) ."," .$this->db->escape($ProductDetailsArray['active']) ."," .$this->db->escape($ProductDetailsArray['createdAtdate']) .")";
			$this->db->query($sql);
    }
    public function validateUserMaster($userDetailsArray){
        $validationArray = array();
        $validationArray['validateSuccess'] = 0;
        $validationArray['errorMsg'] = "";

        if(count($userDetailsArray)>0){
            $validationArray['validateSuccess'] = 1;
        } else {

        }
        return $validationArray;
    }
}

?>
