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

        $adminid = $this->session->userdata('usertypeid');
        $BrandArray = $this->users_model->getBrandList($adminid);
	$SizeArray = $this->users_model->getSizeList($adminid);
        $dataheader['BrandArray'] = $BrandArray;
        $dataheader['SizeArray'] = $SizeArray;

        $this->load->view('layout/backend_header', $dataheader);
        $this->load->view('layout/backend_menu');
        $this->load->view('product/AddProduct');
        $this->load->view('layout/backend_footer');


    }

    public function addProductMaster()
    {
      
        $submit = $this->input->post('submit');
        $dataheader['addProductMasterUrl'] = "addProductMaster";
print_r($_POST);
        if ($submit == 'product')
		 {
		    $productname = $this->input->post('productname');
		    $brandname = $this->input->post('brandname');
		    $barcode = $this->input->post('barcode');
		    $size = $this->input->post('size');
		    $adminid = $this->session->userdata('usertypeid');
		    $quantity = $this->input->post('quantity');
		    $price = $this->input->post('price');
		    $categorytypeid = '1';
		    $active = 'active';
		    $createdAtdate = date("Y-m-d H:i:s");

		    $fromUrl = $this->input->post('fromUrl');

		    $ProductDetailsArray = array('productname' => $productname, 'brandname' => $brandname, 'barcode' => $barcode, 'size' => $size,
		        'adminid' => $adminid, 'quantity' => $quantity, 'price' => $price, 'createdAtdate' => $createdAtdate, 'categorytypeid' => $categorytypeid, 'active' => $active);

		    $validationArray = $this->users_model->validateUserMaster($ProductDetailsArray,'Add');
		    $validateSuccess = $validationArray['validateSuccess'];
		    $errorMsg = $validationArray['errorMsg'];
			    if ($validateSuccess == 1) {
					$userTypeArray = $this->users_model->createProductMaster($ProductDetailsArray); //For admin
					redirect("index.php/AddProduct");
					//print_r($ProductDetailsArray);
			    } else {
					$output = array('status' => "2", 'message' => "Invalid Login!!");
					//print_r($output);
					$this->session->set_flashdata('output', $output);
					//redirect("http://localhost/pos/".$fromUrl);
			    }
          	}
        if ($submit == "brand") 
		{
		    $adminid = $this->session->userdata('usertypeid');
		    $brandname = $this->input->post('brandname');
		    $createdAt = date("Y-m-d H:i:s");
		    $BrandDetailsArray = array('brandname' => $brandname, 'adminid' => $adminid, 'createdAt' => $createdAt);
		    $validationArray = $this->users_model->validateUserMaster($BrandDetailsArray,'Add');
		    $validateSuccess = $validationArray['validateSuccess'];
		    $errorMsg = $validationArray['errorMsg'];
			    if ($validateSuccess == 1) {
					$userTypeArray = $this->users_model->createBrandMaster($BrandDetailsArray); //For admin
					redirect("index.php/BrandMaster");

			    } else {
					$output = array('status' => "2", 'message' => "Invalid Login!!");
					//print_r($output);
					$this->session->set_flashdata('output', $output);
					//            redirect("http://localhost/pos/".$fromUrl);
			    }
        	}
	if ($submit == "size") 
		{
		$adminid = $this->session->userdata('usertypeid');
		$size = $this->input->post('size');
		$createdAt = date("Y-m-d H:i:s");
		$SizeDetailsArray = array('size' => $size, 'adminid' => $adminid, 'createdAt' => $createdAt);
		$validationArray = $this->users_model->validateUserMaster($SizeDetailsArray,'Add');
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
        $sessionUserTypeId = $this->session->userdata('usertypeid');
        $dataheader['adminid'] = $sessionUserTypeId;
        $dataheader['title'] = "Brand";
        $dataheader['addProductMasterUrl'] = "addProductMaster";
        $this->load->view('product/AddBrand',$dataheader);
       
    }

    public function BrandList()
    {
	//print_r($_REQUEST);
        $adminid = $this->input->post('adminid');
	$type = $this->input->get('type');
       	$BrandList = $this->users_model->getBrandList($adminid);
       	$SizeList = $this->users_model->getSizeList($adminid);
	$dataheader['typeList'] = $type;
	$dataheader['SizeList'] = $SizeList;
        $dataheader['BrandList'] = $BrandList;
       // $this->load->view('layout/backend_header');
       // $this->load->view('layout/backend_menu');
        $this->load->view('product/BrandList', $dataheader);
        $this->load->view('layout/backend_footer');
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
        $this->load->view('layout/backend_header',$dataheader);
        $this->load->view('layout/backend_menu');
        $this->load->view('product/BrandMaster',$dataheader);
        $this->load->view('layout/backend_footer');
    }

	public function SizeMaster()
    {
        $dataheader['Size'] = "Size";
        $dataheader['title'] = "Size";
	//$adminid = $this->session->userdata('usertypeid');
        $this->load->view('layout/backend_header',$dataheader);
        $this->load->view('layout/backend_menu');
        $this->load->view('product/SizeMaster',$dataheader);
        $this->load->view('layout/backend_footer');
    }

	  public function AddSize()
    {
        $sessionUserTypeId = $this->session->userdata('usertypeid');
        $dataheader['adminid'] = $sessionUserTypeId;
        $dataheader['title'] = "Size";
        $dataheader['addProductMasterUrl'] = "addProductMaster";
        $this->load->view('product/AddSize',$dataheader);
       
    }
  public function MapProduct()
    {
        $sessionUserTypeId = $this->session->userdata('usertypeid');
        $dataheader['adminid'] = $sessionUserTypeId;
        $dataheader['title'] = "MapProduct";
	 $this->load->view('layout/backend_header',$dataheader);
        $this->load->view('layout/backend_menu');
        $this->load->view('product/MapProduct',$dataheader);
         $this->load->view('layout/backend_footer');
    }
}

?>
