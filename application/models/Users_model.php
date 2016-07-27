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


    public function createUserMaster($userDetailsArray){

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
