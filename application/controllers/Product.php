<?php

/**
 * Created by IntelliJ IDEA.
 * User: jonam
 * Date: 23/7/16
 * Time: 10:52 AM
 */
class Product extends CI_Controller
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

    public function AddProduct()
    {
        $dataheader['title'] = "Add Product";
        $dataheader['addProductMasterUrl'] = "addProductMaster";
//        $adminid = $this->session->userdata('usertypeid');
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

        $usertypeid = '3';
        $retailerShowRoomId = "";
        $userid = "";
        $showroomArray = $this->users_model->getUsersList($usertypeid, $adminid, $retailerShowRoomId, $userid);
        $adminid = $this->session->userdata('usertypeid');
        $actionId = "0";
        $BrandArray = $this->users_model->getBrandList($adminid,$actionId);
        $SizeArray = $this->users_model->getSizeList($adminid);

//echo "<br></br><br></br><br></br><br></br>";
        //print_r($showroomArray);
        $dataheader['showroomArray'] = $showroomArray;
        $dataheader['BrandArray'] = $BrandArray;
        $dataheader['SizeArray'] = $SizeArray;
        $dataheader['showroomArray'] = $showroomArray;
        $this->load->view('layout/backend_header', $dataheader);
        $this->load->view('layout/backend_menu');
        $this->load->view('product/AddProduct');
        $this->load->view('layout/backend_footer');


    }

    public function addProductMaster()
    {

        $submit = $this->input->get_post('submit');
        $actionType = $this->input->get_post('actionType');
        $actionId = $this->input->get_post('actionId');

        $dataheader['addProductMasterUrl'] = "addProductMaster";

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

        $updateSuccess = 0;
        $insertSuccess = 0;
        $deletetSuccess = 0;

        if ($submit == 'product') {
            $Showroomid = $this->input->post('Showroomid');
            $productname = $this->input->post('productname');
            $brandname = $this->input->post('brandname');
            $barcode = $this->input->post('barcode');
            $size = $this->input->post('size');
            $quantity = $this->input->post('quantity');
            $price = $this->input->post('price');
            $categorytypeid = '1';
            $active = 'active';
            $createdAtdate = date("Y-m-d H:i:s");

            $fromUrl = $this->input->post('fromUrl');
		$ShowroomId = $this->input->post('ShowroomId');
		$mappedprice = $this->input->post('mappedprice');
		$mappedqyt = $this->input->post('mappedqyt');

				for($i=0;$i<count($ShowroomId);$i++)
				{
					
			 $ProductMappingArray = array('ShowroomId' => $ShowroomId[$i], 'mappedprice' => $mappedprice[$i], 'mappedqyt' => $mappedqyt[$i],'adminid' => $adminid, 'productname' => $productname, 'createdAtdate' => $createdAtdate);

 				$productmapArray = $this->users_model->createProductmappingMaster($ProductMappingArray); 
									
			  
				}
            $ProductDetailsArray = array('productname' => $productname, 'brandname' => $brandname, 'barcode' => $barcode, 'size' => $size,
                'adminid' => $adminid, 'quantity' => $quantity, 'price' => $price, 'createdAtdate' => $createdAtdate, 'categorytypeid' => $categorytypeid, 'active' => $active, 'Showroomid' => $Showroomid);

            $validationArray = $this->users_model->validateUserMaster($ProductDetailsArray, 'Add');
            $validateSuccess = $validationArray['validateSuccess'];
            $errorMsg = $validationArray['errorMsg'];
            if ($validateSuccess == 1) {
                $userTypeArray = $this->users_model->createProductMaster($ProductDetailsArray); //For admin
                redirect("AddProduct");
                //print_r($ProductDetailsArray);
            } else {
                $output = array('status' => "2", 'message' => "Invalid Login!!");
                //print_r($output);
                $this->session->set_flashdata('output', $output);
                //redirect("http://localhost/pos/".$fromUrl);
            }
        }
        if ($submit == "brand") {

            $brandname = $this->input->post('brandname');
            $createdAt = date("Y-m-d H:i:s");
            $BrandDetailsArray = array('brandname' => $brandname, 'brandid' => $actionId, 'adminid' => $adminid, 'createdAt' => $createdAt);

            $output = array('status' => "3", 'message' => "Invalid Request");
            if($actionType  == "Edit" && $actionId!="0" && $actionId!="" && $actionId!=null){
                $insertSuccess = $userTypeArray = $this->users_model->updateBrandMaster($BrandDetailsArray); //For Create Brand
                if($insertSuccess == 1){
                    $output = array('status' => "1", 'message' => "Successfully updated");
                } else {
                    $output = array('status' => "2", 'message' => "Invalid update");
                }
            } else if($actionType  == "Delete" && $actionId!="0" && $actionId!="" && $actionId!=null){
                $deletetSuccess = $userTypeArray = $this->users_model->deleteBrandMaster($BrandDetailsArray); //For Update Brand
                if($deletetSuccess == 1){
                    $output = array('status' => "1", 'message' => "Successfully deleted");
                } else{
                    $output = array('status' => "2", 'message' => "Please try again later");
                }
            } else if($actionType  == "Add" || $actionType  == ""){
                $updateSuccess = $userTypeArray = $this->users_model->createBrandMaster($BrandDetailsArray); //For Update Brand
                if($updateSuccess == 1){
                    $output = array('status' => "1", 'message' => "Successfully created");
                } else{
                    $output = array('status' => "2", 'message' => "Please try again later");
                }
            }
            $this->session->set_flashdata('output', $output);

            redirect(base_url()."Product/BrandMaster");
        }
        if ($submit == "size") {
            $size = $this->input->post('size');
            $createdAt = date("Y-m-d H:i:s");
            $SizeDetailsArray = array('size' => $size, 'adminid' => $adminid, 'createdAt' => $createdAt);
            $validationArray = $this->users_model->validateUserMaster($SizeDetailsArray, 'Add');
            $validateSuccess = $validationArray['validateSuccess'];
            $errorMsg = $validationArray['errorMsg'];
            if ($validateSuccess == 1) {
                $userTypeArray = $this->users_model->createSizeMaster($SizeDetailsArray); //For admin
                redirect("index.php/SizeMaster");

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
        $dataheader = array();
        $actionType = $this->input->get_post('actionType');
        $actionId = $this->input->get_post('actionId');

        $sessionUserTypeIdIsset = $this->session->has_userdata('usertypeid');
        $adminid = "0";
        $sessionUserTypeId = "0";
        if($sessionUserTypeIdIsset == 1){
            $sessionUserTypeId = $this->session->userdata('usertypeid');
            if($sessionUserTypeId == 2){
                $adminid = $this->session->userdata('userid');
            } else {
                $adminid = $this->input->get_post('adminid');
            }
        }

        $singleBrandList = array();
        if($actionType == "Edit"){
            $singleBrandList = $this->users_model->getBrandList($adminid, $actionId);
        }

        $dataheader['adminid'] = $adminid;
        $dataheader['title'] = "Brand";
        $dataheader['actionType'] = $actionType;
        $dataheader['actionId'] = $actionId;
        $dataheader['singleBrandList'] = $singleBrandList;
        $dataheader['addProductMasterUrl'] = "addProductMaster";
        $this->load->view('product/AddBrand', $dataheader);
    }

    public function BrandList()
    {
        //print_r($_REQUEST);
//        $adminid = $this->input->post('adminid');

        $sessionUserTypeIdIsset = $this->session->has_userdata('usertypeid');
        $adminid = "0";
        $sessionUserTypeId = "0";
        if($sessionUserTypeIdIsset == 1){
            $sessionUserTypeId = $this->session->userdata('usertypeid');
            if($sessionUserTypeId == 2){
                $adminid = $this->session->userdata('userid');
            } else {
                echo $adminid;
                $adminid = $this->input->get_post('adminid');
            }
        }

        $type = $this->input->get('type');
        $actionId = "0";
        $BrandList = $this->users_model->getBrandList($adminid, $actionId);
        $SizeList = $this->users_model->getSizeList($adminid);
        $dataheader['typeList'] = $type;
        $dataheader['SizeList'] = $SizeList;
        $dataheader['BrandList'] = $BrandList;
        // $this->load->view('layout/backend_header');
        // $this->load->view('layout/backend_menu');
        $this->load->view('product/BrandList', $dataheader);
//        $this->load->view('layout/backend_footer');
    }

    public function ProductList()
    {

        $adminid = $this->session->userdata('usertypeid');
        $dataheader['title'] = "ProductList";

        $ProductList = $this->users_model->getProductList($adminid);

        $dataheader['ProductList'] = $ProductList;
        $this->load->view('layout/backend_header', $dataheader);
        $this->load->view('layout/backend_menu');
        $this->load->view('product/ProductList');
        $this->load->view('layout/backend_footer');
    }

    public function BrandMaster()
    {
        $dataheader['Brand'] = "Brand";
        $dataheader['title'] = "Brand";
        //$adminid = $this->session->userdata('usertypeid');
        $this->load->view('layout/backend_header', $dataheader);
        $this->load->view('layout/backend_menu');
        $this->load->view('product/BrandMaster', $dataheader);
        $this->load->view('layout/backend_footer');
    }

    public function SizeMaster()
    {
        $dataheader['Size'] = "Size";
        $dataheader['title'] = "Size";
        //$adminid = $this->session->userdata('usertypeid');
        $this->load->view('layout/backend_header', $dataheader);
        $this->load->view('layout/backend_menu');
        $this->load->view('product/SizeMaster', $dataheader);
        $this->load->view('layout/backend_footer');
    }

    public function AddSize()
    {
        $sessionUserTypeId = $this->session->userdata('usertypeid');
        $dataheader['adminid'] = $sessionUserTypeId;
        $dataheader['title'] = "Size";
        $dataheader['addProductMasterUrl'] = "addProductMaster";
        $this->load->view('product/AddSize', $dataheader);

    }

    public function MapProduct()
    {
        $adminid = $this->session->userdata('usertypeid');
        $dataheader['adminid'] = $adminid;
        $dataheader['title'] = "MapProduct";

        $ProductList = $this->users_model->getProductList($adminid);
        $dataheader['ProductList'] = $ProductList;

        $this->load->view('layout/backend_header', $dataheader);
        $this->load->view('layout/backend_menu');
        $this->load->view('product/MapProduct', $dataheader);
        $this->load->view('layout/backend_footer');
    }

    public function getContent()
    {
        $adminid = $this->session->userdata('usertypeid');
        $dataheader['adminid'] = $adminid;
        $count = $this->input->get('count');
        $type = $this->input->get('type');
        $usertypeid = '3';
        $retailerShowRoomId = "";
        $userid = "";
        $showRoomArray = $this->users_model->getUsersList($usertypeid, $adminid, $retailerShowRoomId, $userid);
        $dataheader['showRoomArray'] = $showRoomArray;
        $dataheader['type'] = $type;
        $dataheader['count'] = $count;
        $this->load->view('product/getContent', $dataheader);

    }

}

?>
