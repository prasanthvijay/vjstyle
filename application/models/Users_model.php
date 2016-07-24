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
}

?>