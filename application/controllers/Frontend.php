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
            redirect("http://localhost/pos/");
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect("/");
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

        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $usertypeid = $this->input->post('usertypeid');
        $adminid = "0";
        $retailerShowRoomId = "0";
        $mobile = $this->input->post('mobile');
        $address = $this->input->post('address');
        $doj = $this->input->post('doj');
        $dob = $this->input->post('dob');
        $active = "active";
        $createdAt = date("Y-m-d H:i:s");

        $fromUrl = $this->input->post('fromUrl');

        $userDetailsArray = array('name' => $name, 'email' => $email, 'password' => $password, 'usertypeid' => $usertypeid,
            'adminid' => $adminid, 'retailerShowRoomId' => $retailerShowRoomId, 'mobile' => $mobile, 'address' => $address,
            'doj' => $doj, 'dob' => $dob, 'active' => $active, 'createdAt' => $createdAt);

        $validationArray = $this->users_model->validateUserMaster($userDetailsArray);
        $validateSuccess = $validationArray['validateSuccess'];
        $errorMsg = $validationArray['errorMsg'];
        if ($validateSuccess == 1) {
            $userTypeArray = $this->users_model->createUserMaster($userDetailsArray); //For admin
            redirect("/adminMaster");
            //print_r($userDetailsArray);
        } else {
            $output = array('status' => "2", 'message' => "Invalid Login!!");
            print_r($output);
            $this->session->set_flashdata('output', $output);
//            redirect("http://localhost/pos/".$fromUrl);
        }
//        $this->load->view('layout/backend_header',$dataheader);
//        $this->load->view('layout/backend_menu');
//        $this->load->view('frontend/frontend_adminMaster');
//        $this->load->view('layout/backend_footer');
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
        $this->load->view('frontend/frontend_adminMaster');
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
        $userTypeArray = $this->users_model->getUserTypeList("2"); //For admin
        $dataheader['userTypeArray'] = $userTypeArray;
        $dataheader['addUserMasterUrl'] = "addUserMaster";
        $dataheader['fromUrl'] = "adminMaster";
        $this->load->view('layout/backend_header', $dataheader);
        $this->load->view('layout/backend_menu');
        $this->load->view('frontend/retailerShowRoomMaster');
        $this->load->view('layout/backend_footer');
    }

    public function salesExecutiveMaster()
    {
        $dataheader['title'] = "Sales Executive Master";
        $userTypeArray = $this->users_model->getUserTypeList("2"); //For admin
        $dataheader['userTypeArray'] = $userTypeArray;
        $dataheader['addUserMasterUrl'] = "addUserMaster";
        $dataheader['fromUrl'] = "adminMaster";
        $this->load->view('layout/backend_header', $dataheader);
        $this->load->view('layout/backend_menu');
        $this->load->view('frontend/salesExecutiveMaster');
        $this->load->view('layout/backend_footer');
    }

    public function getUserListDetails()
    {

        $usertypeid = $this->input->post('usertypeid');
        $adminid = $this->input->post('adminid');
        $retailerShowRoomId = $this->input->post('retailerShowRoomId');
        $userArray = $this->users_model->getUsersList($usertypeid, $adminid, $retailerShowRoomId);
        
        $dataheader['userArray'] = $userArray;
        $this->load->view('frontend/getUserListDetails', $dataheader);
    }


    public function AddProduct()
    {
        $dataheader['title'] = "Add Product";
        $dataheader['addProductMasterUrl'] = "addProductMaster";

        $adminid = $this->session->userdata('userid');
        $BrandArray = $this->users_model->getBrandList($adminid);
        $dataheader['BrandArray'] = $BrandArray;

        $this->load->view('layout/backend_header', $dataheader);
        $this->load->view('layout/backend_menu');
        $this->load->view('frontend/AddProduct');
        $this->load->view('layout/backend_footer');


    }

    public function addProductMaster()
    {
        //print_r($_POST);
        $submit = $this->input->post('submit');

        $dataheader['addProductMasterUrl'] = "addProductMaster";
        if ($submit == 'product') {
            $productname = $this->input->post('productname');
            $brandname = $this->input->post('brandname');
            $barcode = $this->input->post('barcode');
            $size = $this->input->post('size');
            $adminid = $this->session->userdata('userid');
            $quantity = $this->input->post('quantity');
            $price = $this->input->post('price');
            $categorytypeid = '1';
            $active = '1';
            $createdAtdate = date("Y-m-d H:i:s");

            $fromUrl = $this->input->post('fromUrl');

            $ProductDetailsArray = array('productname' => $productname, 'brandname' => $brandname, 'barcode' => $barcode, 'size' => $size,
                'adminid' => $adminid, 'quantity' => $quantity, 'price' => $price, 'createdAtdate' => $createdAtdate, 'categorytypeid' => $categorytypeid, 'active' => $active);

            $validationArray = $this->users_model->validateUserMaster($ProductDetailsArray);
            $validateSuccess = $validationArray['validateSuccess'];
            $errorMsg = $validationArray['errorMsg'];
            if ($validateSuccess == 1) {
                $userTypeArray = $this->users_model->createProductMaster($ProductDetailsArray); //For admin
                redirect("/AddProduct");
                //print_r($ProductDetailsArray);
            } else {
                $output = array('status' => "2", 'message' => "Invalid Login!!");
                //print_r($output);
                $this->session->set_flashdata('output', $output);
                //redirect("http://localhost/pos/".$fromUrl);
            }
            //        $this->load->view('layout/backend_header',$dataheader);
            //        $this->load->view('layout/backend_menu');
            //        $this->load->view('frontend/frontend_adminMaster');
            //        $this->load->view('layout/backend_footer');
        }
        if ($submit == "brand") {
            $adminid = $this->session->userdata('userid');
            $brandname = $this->input->post('brandname');
            $createdAt = date("Y-m-d H:i:s");

            $BrandDetailsArray = array('brandname' => $brandname, 'adminid' => $adminid, 'createdAt' => $createdAt);

            $validationArray = $this->users_model->validateUserMaster($BrandDetailsArray);
            $validateSuccess = $validationArray['validateSuccess'];
            $errorMsg = $validationArray['errorMsg'];
            if ($validateSuccess == 1) {
                $userTypeArray = $this->users_model->createBrandMaster($BrandDetailsArray); //For admin
                redirect("/dashboard");

            } else {
                $output = array('status' => "2", 'message' => "Invalid Login!!");
                //print_r($output);
                $this->session->set_flashdata('output', $output);
                //            redirect("http://localhost/pos/".$fromUrl);
            }
        }
    }

    public function AddBrand()
    {
        $dataheader['title'] = "Add Brand";
        $dataheader['addProductMasterUrl'] = "addProductMaster";
        $this->load->view('layout/backend_header', $dataheader);
        $this->load->view('layout/backend_menu');
        $this->load->view('frontend/AddBrand');
        $this->load->view('layout/backend_footer');

    }

    public function BrandList()
    {

        $adminid = $this->input->post('adminid');
        $dataheader['title'] = "BrandList";

        $BrandList = $this->users_model->getBrandList($adminid);

        $dataheader['BrandList'] = $BrandList;
        $this->load->view('layout/backend_header', $dataheader);
        $this->load->view('layout/backend_menu');
        $this->load->view('frontend/BrandList');
        $this->load->view('layout/backend_footer');
    }

    public function ProductList()
    {

        $adminid = $this->input->post('adminid');
        $dataheader['title'] = "ProductList";

        $ProductList = $this->users_model->getProductList($adminid);

        $dataheader['ProductList'] = $ProductList;
//echo "<br><br><br><br><br><br>";
        //print_r($ProductList);
        $this->load->view('layout/backend_header', $dataheader);
        $this->load->view('layout/backend_menu');
        $this->load->view('frontend/ProductList');
        $this->load->view('layout/backend_footer');
    }


    public function getAddOrEditUserMasterContent(){

        $actionType = $this->input->post('actionType');
        $actionId = $this->input->post('actionId');
        $usertypeid = $this->input->post('usertypeid');
        $userTypeArray = $this->users_model->getUserTypeList($usertypeid); //For admin
        $usertype = $userTypeArray[0]['usertype'];
        $dataArray['userTypeArray'] = $userTypeArray;
        $dataArray['actionType'] = $actionType;
        $dataArray['actionId'] = $actionId;
        $dataArray['addUserMasterUrl'] = $actionId;
        $dataArray['usertypeid'] = $usertypeid;
        $dataArray['masterName'] = $usertype;
        $adminid = 2;
        $retailerShowRoomId = "";
        $retailerShowRoomList = $this->users_model->getUsersList('4', $adminid, $retailerShowRoomId);
        $dataArray['retailerShowRoomList'] = $retailerShowRoomList;
        $this->load->view('frontend/getAddOrEditUserMasterContent', $dataArray);
    }

}

?>
