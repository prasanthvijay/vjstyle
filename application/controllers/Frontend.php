<?php

/**
 * Created by IntelliJ IDEA.
 * User: jonam
 * Date: 23/7/16
 * Time: 10:52 AM
 */
class Frontend extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('users_model');
        $this->load->library('session');
    }

    public function index()
    {
        $output = $this->session->flashdata('output');
        $succesMsg = $this->users_model->getSuccessMsg($output);

        $dataheader['succesMsg'] = $succesMsg;
        $dataheader['title'] = "Login";
        $dataheader['loginPostUrl'] = "index.php/checkLogin";

        $this->load->view('layout/frontend_header', $dataheader);
        $this->load->view('frontend/frontend_index');
        $this->load->view('layout/frontend_footer');
    }

    public function forgotPassword()
    {
        $dataheader['title'] = "Forgot Password";
        $sendOTP = $this->input->get_post('sendOTP');
        $otptext = $this->input->get_post('otptext');
        $emailId = $this->input->get_post('emailId');
        $newPassword = $this->input->get_post('newPassword');
        $dataheader['sendOTP'] = $sendOTP;
        if($sendOTP == 1 && $emailId!="") {
            $tomailIdArray = array($emailId);
            $otp = $this->users_model->insertAndReturnOTP($emailId);
            if($otp!=""){
                $message = "<b>Dear User</b>, <br><br>Your One Time Password (OTP) for resetting the password for your <a href='http://www.jonam.in'>jonam.in</a> profile is <b>".$otp."</b><br><br>";
                $message = $message . "Please enter this code in the OTP code box listed on the page.<br><br>";
                $message = $message . "<b>Note: </b> Please note that this will be valid for the next 2 hours only.<br><br>";
                $message = $message . "Contact: support@jonam.in if you are unable to reset.<br><br><br>Regards,<br>jonam.in Team";
                $subject = "Your OTP for resetting password";
                $sendResponse = $this->users_model->sendEmail(null, null, $tomailIdArray, $subject, $message);
//                $sendResponse  = 1;
                if($sendResponse==1){
                    $output = array("message"=>"Please check your mail for OTP", "status"=>"1");
                    $sendResponseMessage = $this->users_model->getSuccessMsg($output);
                } else {
                    $output = array("message"=>"Please check your Internet connection", "status"=>"2");
                    $sendResponseMessage = $this->users_model->getSuccessMsg($output);
                }
                $dataheader['sendResponseMessage'] = $sendResponseMessage;
                $dataheader['emailId'] = $emailId;
                $this->load->view('layout/frontend_header', $dataheader);
                $this->load->view('frontend/forgotPassword');
                $this->load->view('layout/frontend_footer');
            }else {
                $output = array("message"=>"Invalid login details", "status"=>"2");
                $this->session->set_flashdata('output', $output);
                redirect(base_url());
            }
        } else if($sendOTP == 2) {
            if($otptext!="" && $newPassword!=""){
                $email = $this->input->get_post('email');
                $resultArray = $this->users_model->getSuccessMsgOTPUpdated($email, $otptext);
                $successOTPUpdated = $resultArray['successMsg'];
                $userId = $resultArray['userid'];
                if($otptext!="" && $email!="" && $successOTPUpdated== "1"){
                    $this->users_model->updateUsersPassword($userId, $newPassword);
                    $output = array('status' => "1", 'message' => "Your Password Successfully updated! <br/>Please login again");
                    $this->session->set_flashdata('output', $output);
                } else {
                    $output = array('status' => "2", 'message' => "Incorrect OTP Details");
                    $this->session->set_flashdata('output', $output);
                }
                redirect(base_url());
            }
        } else {
            $this->load->view('frontend/forgotPassword', $dataheader);
        }
    }


    public function editProfile()
    {
        $output = $this->session->flashdata('output');
        $succesMsg = $this->users_model->getSuccessMsg($output);

        $dataheader['succesMsg'] = $succesMsg;
        $dataheader['title'] = "Edit Profile";
        $dataheader['loginPostUrl'] = "index.php/checkLogin";
        $sessionUserTypeIdIsset = $this->session->has_userdata('usertypeid');
        $sessionUserTypeId = 0;
        $userid = 0;
        if($sessionUserTypeIdIsset == 1) {
            $sessionUserTypeId = $this->session->userdata('usertypeid');
            $userid = $this->session->userdata('userid');
        }
        $dataheader['usertypeid'] = $sessionUserTypeId;
        $dataheader['userid'] = $userid;
        $this->load->view('layout/backend_header', $dataheader);
        $this->load->view('layout/backend_menu');
        $this->load->view('frontend/editProfile');
        $this->load->view('layout/backend_footer');
    }

    public function checkLogin()
    {
        $username = $this->input->post('userName');
        $userpassword = $this->input->post('password');

        $userCredentialArray = array('username' => $username, 'userpassword' => $userpassword);
        $userCredential = $this->users_model->checkUserCredential($userCredentialArray);
        if (count($userCredential) > 0) {

            $this->session->set_userdata($userCredential);
            $this->users_model->updateLastlogin($userCredential['userid']);
            redirect($userCredential['redirecturl']);
        } else {
            $output = array('status' => "2", 'message' => "Invalid Login!!");
            $this->session->set_flashdata('output', $output);
            redirect(base_url());
        }
    }

    public function logout()
    {
//        $this->session->sess_destroy();
        $userListArray  = array('userid', 'name', 'email', 'usertypeid', 'adminid', 'mobile', 'retailerShowRoomId', 'lastlogin', 'redirecturl', 'usertype');
        $this->session->unset_userdata($userListArray);
        $output = array('status' => "1", 'message' => "Successfully logout !!!");
        $this->session->set_flashdata('output', $output);
        redirect(base_url());
    }

    public function dashboard()
    {
        $dataheader['title'] = "Login";
        $this->load->view('layout/backend_header', $dataheader);
        $this->load->view('layout/backend_menu');
        $this->load->view('frontend/frontend_dashboard');
        $this->load->view('layout/backend_footer');
    }

    public function addUserMaster()
    {
        $dataheader['title'] = "Admin Master";
        $dataheader['addUserMasterUrl'] = "addUserMaster";

        $sessionUserTypeIdIsset = $this->session->has_userdata('usertypeid');
        $adminid = "0";

        if($sessionUserTypeIdIsset == 1){
            $sessionUserTypeId = $this->session->userdata('usertypeid');
            if($sessionUserTypeId == 2){
                $adminid = $this->session->userdata('userid');
            } else {
                $adminid = $this->input->get_post('adminid');
            }
        }

        $retailershowroomid = $this->input->get_post('retailershowroomid');
        $name = $this->input->get_post('name');
        $titlename = $this->input->get_post('titlename');
        $email = $this->input->get_post('email');
        $password = $this->input->get_post('password');
        $usertypeid = $this->input->get_post('usertypeid');
        $mobile = $this->input->get_post('mobile');
        $address = $this->input->get_post('address');
        $doj = $this->input->get_post('doj');
        $dob = $this->input->get_post('dob');
        $active = "active";
        $createdAt = date("Y-m-d H:i:s");
        $actionType = $this->input->get_post('actionType');
        $actionId = $this->input->get_post('actionId');
        if($actionType=="" || $actionType=="Add"){
            $actionType = "Add";
        } else {
            $actionType = "Edit";
        }

        if($usertypeid == 2){
            $adminid = 0;
        }
        $redirectUrl = "";
        $doj = $this->users_model->convertDDMMYYtoYYMMDD($doj);
        $dob = $this->users_model->convertDDMMYYtoYYMMDD($dob);

        $userDetailsArray = array('name' => $name, 'email' => $email, 'password' => $password, 'usertypeid' => $usertypeid,
            'adminid' => $adminid, 'retailershowroomid' => $retailershowroomid, 'mobile' => $mobile, 'address' => $address,
            'doj' => $doj, 'dob' => $dob, 'active' => $active, 'createdAt' => $createdAt,'userid' => $actionId);


        $validationArray = $this->users_model->validateUserMaster($userDetailsArray,$actionType);
        $validateSuccess = $validationArray['validateSuccess'];
        $errorMsg = $validationArray['errorMsg'];
        $redirectUrl = $this->users_model->getRedirectURLForMaster($usertypeid);

        if ($validateSuccess == 0) {
            if($actionType=="Add"){

                $this->users_model->createUserMaster($userDetailsArray); //For admin
            } else {
//                print_r($userDetailsArray);
                $this->users_model->updateUserMaster($userDetailsArray); //For admin
            }
        } else {
            $output = array('status' => "2", 'message' => $errorMsg);
            $this->session->set_flashdata('output', $output);
        }
        if($titlename == "Edit Profile"){
            $redirectUrl = "Frontend/editProfile";
        }
        redirect(base_url().$redirectUrl);
    }

    public function adminMaster()
    {
        $dataheader['title'] = "Admin Master";
        $userTypeArray = $this->users_model->getUserTypeList("2"); //For admin
        $dataheader['userTypeArray'] = $userTypeArray;
        $dataheader['addUserMasterUrl'] = "addUserMaster";
        $dataheader['fromUrl'] = "adminMaster";
        $this->load->view('layout/backend_header', $dataheader);
        $this->load->view('layout/backend_menu');
        $this->load->view('frontend/adminMaster');
        $this->load->view('layout/backend_footer');

    }

    public function sellerMaster()
    {
        $dataheader['title'] = "Seller Master";
        $this->load->view('layout/backend_header', $dataheader);
        $this->load->view('layout/backend_menu');
        $this->load->view('frontend/frontend_dashboard');
        $this->load->view('layout/backend_footer');
    }

    public function retailerShowRoomMaster()
    {
        $dataheader['title'] = "Retailer Show Room Master";
        $this->load->view('layout/backend_header', $dataheader);
        $this->load->view('layout/backend_menu');
        $this->load->view('frontend/retailerShowRoomMaster');
        $this->load->view('layout/backend_footer');
    }

    public function salesExecutiveMaster()
    {
        $dataheader['title'] = "Sales Executive Master";
        $this->load->view('layout/backend_header', $dataheader);
        $this->load->view('layout/backend_menu');
        $this->load->view('frontend/salesExecutiveMaster');
        $this->load->view('layout/backend_footer');
    }

    public function salesHeadMaster()
    {
        $dataheader['title'] = "Sales Head Master";
        $this->load->view('layout/backend_header', $dataheader);
        $this->load->view('layout/backend_menu');
        $this->load->view('frontend/salesHeadMaster');
        $this->load->view('layout/backend_footer');
    }

    public function getUserListDetails()
    {

        $usertypeid = $this->input->post('usertypeid');
        $sessionUserTypeIdIsset = $this->session->has_userdata('usertypeid');
        $adminid = "0";
        $sessionUserTypeId = "0";
        if($sessionUserTypeIdIsset == 1) {
            $sessionUserTypeId = $this->session->userdata('usertypeid');
            $dataArray['sessionUserTypeId'] = $sessionUserTypeId;

            if ($sessionUserTypeId == 2) {
                $adminid = $this->session->userdata('userid');
            } else {
                $adminid = $this->input->post('adminid');
            }
        }
        $retailerShowRoomId = $this->input->post('retailerShowRoomId');
        $userArray = $this->users_model->getUsersList($usertypeid, $adminid, $retailerShowRoomId, null);

        $dataheader['userArray'] = $userArray;
        $dataheader['usertypeid'] = $usertypeid;
        $dataheader['sessionUserTypeId'] = $sessionUserTypeId;
        $this->load->view('frontend/getUserListDetails', $dataheader);
    }

    public function getRetailerShowRoomDetails()
    {

        $usertypeid = $this->input->get('usertypeid');
        $jsondata = $this->input->get('jsondata');
        $sessionUserTypeIdIsset = $this->session->has_userdata('usertypeid');
        $adminid = "0";

        if($sessionUserTypeIdIsset == 1) {
            $sessionUserTypeId = $this->session->userdata('usertypeid');
            $dataArray['sessionUserTypeId'] = $sessionUserTypeId;

            if ($sessionUserTypeId == 2) {
                $adminid = $this->session->userdata('userid');
            } else {
                $adminid = $this->input->get('adminid');
            }
        }

        $retailerShowRoomId = $this->input->post('retailerShowRoomId');
        $userArray = $this->users_model->getUsersList($usertypeid, $adminid, $retailerShowRoomId, null);
        if($jsondata==1){
            echo json_encode($userArray);
        } else {
            $selectBoxReturn = "<select name='retailershowroomid' id='retailershowroomid' class='form-control' parsley-trigger='change' required> <option value=''>Select</option>";
            for ($k=0;$k<count($userArray);$k++){
                $userId = $userArray[$k]['userid'];
                $name = $userArray[$k]['name'];
                $selectBoxReturn = $selectBoxReturn . "<option value='".$userId."'>".$name."</option>";
            }
            $selectBoxReturn = $selectBoxReturn . "</select>";
            echo $selectBoxReturn;
        }

    }

    public function getAddOrEditUserMasterContent(){

        $actionType = $this->input->get_post('actionType');
        $titlename = $this->input->get_post('titlename');
        $actionId = $this->input->get_post('actionId');
        $usertypeid = $this->input->get_post('usertypeid');
        $userTypeArray = $this->users_model->getUserTypeList($usertypeid); //For admin
        $usertype = $userTypeArray[0]['usertype'];
        $dataArray['userTypeArray'] = $userTypeArray;
        $dataArray['addUserMasterUrl'] = "addUserMaster";
        $dataArray['usertypeid'] = $usertypeid;
        $dataArray['masterName'] = $usertype;
        $sessionUserTypeIdIsset = $this->session->has_userdata('usertypeid');
        $adminid = "0";
        $retailershowroomid = "0";
        $adminList = array();
        if($sessionUserTypeIdIsset == 1){

            $sessionUserTypeId = $this->session->userdata('usertypeid');
            $dataArray['sessionUserTypeId'] = $sessionUserTypeId;
            if($sessionUserTypeId == 2){
                $adminid = $this->session->userdata('userid');
            } else {
                $adminid = $this->input->get_post('adminid');
            }

            if($sessionUserTypeId == 1){
                $adminList = $this->users_model->getUsersList('2', null, null, null);
            }

            $dataArray['adminList'] = $adminList;
            $dataArray['titlename'] = $titlename;
            $retailerShowRoomList = $this->users_model->getUsersList('3', $adminid, $retailershowroomid, null);
            $dataArray['retailerShowRoomList'] = $retailerShowRoomList;

            if($actionType =="Edit"){
                $actionType = "Edit";
                $actionId = $actionId;
                if($titlename == "Edit Profile"){
                    $adminid = "";
                }
                $editUsersList = $this->users_model->getUsersList(null, $adminid, null, $actionId);
            } else {
                $actionType = "Add";
                $actionId = null;
                $editUsersList = array();
            }
            $dataArray['actionType'] = $actionType;
            $dataArray['actionId'] = $actionId;
            $dataArray['editUsersList'] = $editUsersList;
            $dataArray['sessionUserTypeId'] = $sessionUserTypeId;

            $this->load->view('frontend/getAddOrEditUserMasterContent', $dataArray);
        }
    }

    public function deleteUsersFromMaster(){

        $sessionUserTypeIdIsset = $this->session->has_userdata('usertypeid');
        if($sessionUserTypeIdIsset == 1){
            $userid = $this->input->post('userid');
            $sessionUserTypeId = $this->session->userdata('usertypeid');
            if($sessionUserTypeId == 2){
                $adminid = $this->session->userdata('userid');
            } else {
                $adminid = $this->input->post('adminid');
            }
            $success = $this->users_model->deleteUsersFromMaster($userid, $adminid); //For admin
        }

        if($success){
            echo "Deleted successfully!";
        }
    }
  
}

?>
