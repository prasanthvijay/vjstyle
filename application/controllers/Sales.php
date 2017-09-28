<?php


class Sales extends CI_Controller
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
        $this->load->model('pos_model');
        $this->load->library('session');
    }

    public function index()
    {
        $this->load->view('welcome_message');
    }

    public function posSubmitPage(){

        $usertypeid = $this->session->userdata('usertypeid');
        $showroomId = $this->session->userdata('retailerShowRoomId');
        $adminid = $this->session->userdata('adminid');

//        $tablename = "tbl_product";
//        $fieldname = array('productid,productname');
//        $condition = "t.productid IN(SELECT productid From tbl_productMapping where showroomId ='" . $showroomId . "' and adminid ='" . $adminid . "') ";
//
//        $productList = $this->pos_model->selectQueryList($tablename, $fieldname, $condition);
//
//        $dataheader['productList'] = $productList;

        $selectedProduct = $this->input->post('selectedProduct');

        if ($selectedProduct != "") {
            $selectedProductExplode = explode("|", $selectedProduct);
            $insertValue['TotalProductCost'] = 0;

            $insertValue['count'] = count($selectedProductExplode) - 1;
            for ($i = 0; $i < $insertValue['count']; $i++) {
                $j = $i + 1;
                $insertValue['product'][$i] = $this->input->post('product_' . $selectedProductExplode[$i]);
                $insertValue['price'][$i] = $this->input->post('price_' . $selectedProductExplode[$i]);
                $insertValue['qty'][$i] = $this->input->post('qty_' . $selectedProductExplode[$i]);
                $insertValue['disc'][$i] = $this->input->post('disc_' . $selectedProductExplode[$i]);

                $beforeTotal = $insertValue['qty'][$i] * $insertValue['price'][$i];

                $insertValue['EachProductCost'][$i] = $beforeTotal - ($beforeTotal * $insertValue['disc'][$i] / 100);

                $insertValue['TotalProductCost'] += $insertValue['EachProductCost'][$i];
            }

            $totdiscount = $insertValue['totdiscount'] = $this->input->post('totdiscount');
            $insertValue['roundoff'] = $this->input->post('roundoff');


            $afterDiscountAmount = $insertValue['TotalProductCost'];
            if($totdiscount>0 && $totdiscount!=""){
                $afterDiscountAmount = $insertValue['TotalProductCost'] * $insertValue['totdiscount'] / 100;
            }

            $insertValue['FinalTotal'] = $afterDiscountAmount - $insertValue['roundoff'];
            $insertValue['Customer'] = $this->input->post('Customer');
            $insertValue['mobile'] = $this->input->post('mobile');
            $insertValue['adminid'] = $adminid;
            $insertValue['showroomId'] = $showroomId;
//            echo "<pre>";
//            print_r($insertReceiptValue);
//            echo "</pre>";
            $insertSellDetails = $this->pos_model->insertSellDetails($insertValue);
            $output = array('status' => "1", 'message' => " <b>Please take print...<a href='".base_url()."sales/receipt/".$insertSellDetails."' target='_blank' >Receipt No : ".$insertSellDetails."</a></b>");
            $this->session->set_flashdata('output', $output);
        }

        redirect(base_url()."sales/pos");
    }

    public function pos()
    {
        $dataheader['title'] = "POS";
        $output = $this->session->flashdata('output');
        $succesMsg = $this->users_model->getSuccessMsg($output);
        $dataheader['succesMsg'] = $succesMsg;

        $this->load->view('layout/backend_header', $dataheader);
        $this->load->view('layout/backend_menu');
        $this->load->view('sales/pos');
        $this->load->view('layout/backend_footer');
    }

    public function posajax()
    {
        $barcode = $this->input->get_post("barcode");

        echo $retailerShowRoomId = $this->session->userdata('retailerShowRoomId');
        $productIdArray = array('barcode' => $barcode, 'retailerShowRoomId' => $retailerShowRoomId);
        $rec_limit = "100";
        $page = "0";
        if ($barcode=="" || $barcode==null){
            $barcode  = 0;
        }
        $paginationArray = $this->users_model->getProductList(0, 0, $retailerShowRoomId,0, 0, 0, 0, $barcode, $rec_limit, $page);
        $left_rec = $paginationArray['left_rec'];
        $productDetails = $paginationArray['resultArrayData'];
        $rec_limit = $paginationArray['rec_limit'];

        $productDetailsArray = array();
        for ($k = 0; $k < count($productDetails); $k++) {
            $productDetailsArray[$k]['productid'] = $productDetails[$k]['productid'];
            $productDetailsArray[$k]['productname'] = $productDetails[$k]['productname'];
            $productDetailsArray[$k]['barcode'] = $productDetails[$k]['barcode'];
            $productDetailsArray[$k]['price'] = $productDetails[$k]['retailerMRP'];
//			$productDetailsArray[$k]['quantity'] = $productDetails[$k]['quantity'];

            $quantity = 0;
            if ($productDetails[$k]['quantity'] > 0 && $productDetails[$k]['quantity'] != "" && $productDetails[$k]['quantity'] != null) {
                $quantity = $productDetails[$k]['quantity'];
            }
            $productDetailsArray[$k]['quantity'] = $quantity;

            $qty = 0;
            if ($productDetails[$k]['qty'] > 0 && $productDetails[$k]['qty'] != "" && $productDetails[$k]['qty'] != null) {
                $qty = $productDetails[$k]['qty'];
            }
            $productDetailsArray[$k]['qty'] = $qty;
        }
//		print_r($productDetails);
        echo json_encode($productDetailsArray);
    }

    public function receipt($receiptId)
    {

        $dataheader['title'] = "Receipt";


        $receiptDetails = $this->pos_model->receiptDetails($receiptId);

        $tablename = "tbl_returnProduct";
        $fieldname = array('newReceipt', 'oldReceipt', 'productId', 'reduceCount');
        $condition = "t.newReceipt='" . $receiptId . "' or t.oldReceipt='" . $receiptId . "'";

        $returnDeatils = $this->pos_model->selectQueryList($tablename, $fieldname, $condition);
        $receiptDetails['returnDetails'] = array();


        if (count($returnDeatils) > 0) {

            $returnProductDetails['newReceipt'] = $returnDeatils[0]['newReceipt'];
            $returnProductDetails['oldReceipt'] = $returnDeatils[0]['oldReceipt'];

            for ($i = 0; $i < count($returnDeatils); $i++) {
                $tablename = "tbl_product";
                $fieldname = array('productname', 'barcode');
                $condition = "t.productid='" . $returnDeatils[$i]['productId'] . "' ";

                $ProductDetails = $this->pos_model->selectQueryList($tablename, $fieldname, $condition);


                $tablename = "tbl_customerreceiptproduct";
                $fieldname = array('price', 'discount');
                $condition = "t.productId='" . $returnDeatils[$i]['productId'] . "' and t.receiptId='" . $returnDeatils[$i]['oldReceipt'] . "' ";

                $retunProduct = $this->pos_model->selectQueryList($tablename, $fieldname, $condition);

                $returnProductDetails['name'][$i] = $ProductDetails[0]['productname'];
                $returnProductDetails['barcode'][$i] = $ProductDetails[0]['barcode'];
                $returnProductDetails['price'][$i] = $retunProduct[0]['price'];
                $returnProductDetails['discount'][$i] = $retunProduct[0]['discount'];
                $returnProductDetails['reduceCount'][$i] = $returnDeatils[0]['reduceCount'];
            }

            $receiptDetails['returnDetails'] = $returnProductDetails;
        }

        $dataheader['receiptDetails'] = $receiptDetails;

        $this->load->view('layout/frontend_header', $dataheader);
        $this->load->view('sales/receipt');
       // $this->load->view('layout/backend_footer');
    }

    public function returnpos()
    {

	$usertypeid = $this->session->userdata('usertypeid');
        $showroomId = $this->session->userdata('retailerShowRoomId');
        $adminid = $this->session->userdata('adminid');
        $dataheader['title'] = "Return POS";

        $tablename = "tbl_customerreceipt";
        $fieldname = array('id','billNo');
        $condition = "t.showRoomId=$showroomId";

        $receiptList = $this->pos_model->selectQueryList($tablename, $fieldname, $condition);
        $dataheader['receiptList'] = $receiptList;

        $tablename = "tbl_product";
        $fieldname = array('productid', 'productname');
        $condition = "t.adminid=2 and t.active=active";

        $productList = $this->pos_model->selectQueryList($tablename, $fieldname, $condition);
        $dataheader['productList'] = $productList;


        $selectedProduct = $this->input->post('selectedProduct');

        if ($selectedProduct != "") {
            $selectedProductExplode = explode("|", $selectedProduct);
            $insertValue['TotalProductCost'] = 0;

            $insertValue['count'] = count($selectedProductExplode) - 1;
            for ($i = 0; $i < $insertValue['count']; $i++) {
                $j = $i + 1;
                $insertValue['product'][$i] = $this->input->post('product_' . $selectedProductExplode[$i]);
                $insertValue['price'][$i] = $this->input->post('price_' . $selectedProductExplode[$i]);
                $insertValue['qty'][$i] = $this->input->post('qty_' . $selectedProductExplode[$i]);
                $insertValue['disc'][$i] = $this->input->post('disc_' . $selectedProductExplode[$i]);

                $beforeTotal = $insertValue['qty'][$i] * $insertValue['price'][$i];

                $insertValue['EachProductCost'][$i] = $beforeTotal - ($beforeTotal * $insertValue['disc'][$i] / 100);

                $insertValue['TotalProductCost'] += $insertValue['EachProductCost'][$i];
            }

            $insertValue['totdiscount'] = $this->input->post('totdiscount');
            $insertValue['roundoff'] = $this->input->post('roundoff');

            $insertValue['FinalTotal'] = $insertValue['TotalProductCost'] - $insertValue['totdiscount'] - $insertValue['roundoff'];
            $insertValue['Customer'] = $this->input->post('Customer');
            $insertValue['mobile'] = $this->input->post('mobile');
		$insertValue['adminid'] = $adminid;
            $insertValue['showroomId'] = $showroomId;

            $insertSellDetails = $this->pos_model->insertSellDetails($insertValue);

            $insertReceiptValue['oldreceiptId'] = $this->input->post('receiptId');

            $tablename = "tbl_customerreceiptproduct";
            $fieldname = array('id');
            $condition = "t.receiptId='" . $insertReceiptValue['oldreceiptId'] . "'";


            $receiptProductcount = $this->pos_model->selectQueryList($tablename, $fieldname, $condition);


            $insertReceiptValue['newReceipt'] = $insertSellDetails;

            for ($i = 0; $i < count($receiptProductcount); $i++) {
                $insertReceiptValue['billProduct'][$i] = $this->input->post('existBillproduct_' . $i);
                $insertReceiptValue['reduceCount'][$i] = $this->input->post('existBillQuantity_' . $i) - $this->input->post('billqty_' . $i);
            }

            $insertSellDetails = $this->pos_model->insertReturnSellDetails($insertReceiptValue);
		$output = array('status' => "1", 'message' => " <b>Please take print...<a href='".base_url()."sales/receipt/".$insertReceiptValue['newReceipt']."' target='_blank' >Receipt No : ".$insertReceiptValue['newReceipt']."</a></b>");
            $this->session->set_flashdata('output', $output);
        }
 	$output = $this->session->flashdata('output');
 	$succesMsg = $this->users_model->getSuccessMsg($output);
        $dataheader['succesMsg'] = $succesMsg;
        $this->load->view('layout/backend_header', $dataheader);
        $this->load->view('layout/backend_menu');
        $this->load->view('sales/returnpos');
        $this->load->view('layout/backend_footer');
    }

    public function returnposajax()
    {

        $type = $this->input->get_post("type");
        if ($type == "getReceipt") {
            $receiptId = $this->input->get_post("receiptId");
            $receiptDetails = $this->pos_model->receiptDetails($receiptId);
            echo json_encode($receiptDetails);
        }
    }

    public function reports($reportsType)
    {

       $showroomId = $this->session->userdata('retailerShowRoomId');
	 $usertypeid = $this->session->userdata('usertypeid');
		$tablename = "tbl_user";
		$fieldname = array('userid,name,');
		$condition = 't.usertypeid="3" and t.adminid="'.$usertypeid.'"';
		$showRoomList = $this->pos_model->selectQueryList($tablename, $fieldname, $condition);


        $dataheader['title'] = "Reports";
        $dataheader['reportsType'] = $reportsType;
        $dataheader['showroomId'] = $showroomId;
        $dataheader['showRoomList'] = $showRoomList;
        $dataheader['usertypeid'] = $usertypeid;
	
        $this->load->view('layout/backend_header', $dataheader);
        $this->load->view('layout/backend_menu');
        $this->load->view('sales/reports');
        $this->load->view('layout/backend_footer');

    }

    public function lowstockReport()
    {

		$showroomId = $this->session->userdata('retailerShowRoomId');
	 	$usertypeid = $this->session->userdata('usertypeid');
		$tablename = "tbl_user";
		$fieldname = array('userid,name,');
		$condition = 't.usertypeid="3" and t.adminid="'.$usertypeid.'"';
		$showRoomList = $this->pos_model->selectQueryList($tablename, $fieldname, $condition);

 	$dataheader['showRoomList'] = $showRoomList;
        $dataheader['title'] = "Low Stock Report";
        $dataheader['usertypeid'] = $usertypeid;
        $dataheader['showroomId'] = $showroomId;
        $this->load->view('layout/backend_header', $dataheader);
        $this->load->view('layout/backend_menu');
        $this->load->view('sales/lowstockReport');
        $this->load->view('layout/backend_footer');

    }
 public function getReportInLowStock()
    {

	 	$usertypeid = $this->session->userdata('usertypeid');
            	$retailerShowRoomId = $this->input->get_post("showroomId");
		$lowStockproductArray = $this->pos_model->getlowStockProductList($retailerShowRoomId);
		//print_r($lowStockproductArray);
		$dataheader['lowStockproductArray']= $lowStockproductArray;
        	$this->load->view('sales/getReportInLowStock',$dataheader);
    }
    public function reportsajax()
    {


        $fromDate = $this->input->get_post("fromDate");
        $showroomid = $this->input->get_post("showroomid");
        $toDate = $this->input->get_post("toDate");
        $stop_date = date('Y-m-d H:i:s', strtotime($toDate . ' +1 day'));


        $tablename = "tbl_customerreceipt";
        $fieldname = array('*');
        $condition = 't.date BETWEEN "' . date('Y-m-d', strtotime($fromDate)) . '" and "' . date('Y-m-d', strtotime($stop_date)) . '" and t.showRoomId ="'.$showroomid.'" ';
        $receiptList = $this->pos_model->selectQueryList($tablename, $fieldname, $condition);
        $tableRow = "";

        for ($i = 0; $i < count($receiptList); $i++) {
            $tablename = "tbl_customerreceiptproduct";
            $fieldname = array('*');
            $condition = 't.receiptId="' . $receiptList[$i]['id'] . '" and t.showroomId ="'.$showroomid.'"';
            $receiptProductList = $this->pos_model->selectQueryList($tablename, $fieldname, $condition);
            $productAmountTotal = 0;

            for ($j = 0; $j < count($receiptProductList); $j++) {

                $this->db->select('SUM(reduceCount) as reduceCount');
                $this->db->where("oldReceipt='" . $receiptList[$i]['id'] . "' and productId='" . $receiptProductList[$j]['productId'] . "'");
                $q = $this->db->get('tbl_returnProduct');
                $returnDetailsProduct = $q->result_array();

                if ($returnDetailsProduct[0]['reduceCount'] != "") {
                    $qty = $receiptProductList[$j]['qty'] - $returnDetailsProduct[0]['reduceCount'];
                } else {
                    $qty = $receiptProductList[$j]['qty'];
                }

                $productAmount = $receiptProductList[$j]['price'] * $qty;
                $productAmountTotal += $productAmount - ($productAmount * $receiptProductList[$j]['discount'] / 100);
            }

            /*$returnValue['productTotal'][$i]=$productAmountTotal;
            $returnValue['id'][$i]=$receiptList[$i]['id'];
            $returnValue['totDiscount'][$i]=$receiptList[$i]['discount'];
            $returnValue['roundoff'][$i]=$receiptList[$i]['roundoff'];*/

            $tablename = "tbl_customer";
            $fieldname = array('name', 'mobileno');
            $condition = 't.id="' . $receiptList[$i]['customerId'] . '"';
            $customerDetail = $this->pos_model->selectQueryList($tablename, $fieldname, $condition);


            $tablename = "tbl_returnProduct";
            $fieldname = array('newReceipt');
            $condition = "t.newReceipt='" . $receiptList[$i]['id'] . "' ";
            $returnDeatils = $this->pos_model->selectQueryList($tablename, $fieldname, $condition);

            if (count($returnDeatils) == 0) {
                $discount = $productAmountTotal * $receiptList[$i]['discount'] / 100;
            } else {
                $discount = $receiptList[$i]['discount'];
            }
            $finalTotal = $productAmountTotal - $discount - $receiptList[$i]['roundoff'];

            $customerName = "-";
            $customerMobileNo = "-";
            if(count($customerDetail)>0){
                $customerName = $customerDetail[0]['name'];
                $customerMobileNo = $customerDetail[0]['mobileno'];
            }
            $tableRow .= "<tr><td>" . ($i + 1) . "</td><td><a href='../receipt/" . $receiptList[$i]['id'] . "' target='_blank'>" . ($receiptList[$i]['billNo']) . "</a></td><td>" . date('d-m-Y', strtotime($receiptList[$i]['date'])) . "</td><td>" . $customerName. "</td><td>" . $customerMobileNo . "</td><td>" . $productAmountTotal . "</td><td>" . $discount . "</td><td>" . $receiptList[$i]['roundoff'] . "</td><td>" . $finalTotal . "</td></tr>";
        }

        echo $tableRow;

    }
public function returnList()
    {
	$showroomId = $this->session->userdata('retailerShowRoomId');
	$usertypeid = $this->session->userdata('usertypeid');
        $dataheader['title'] = "Return Reports";
        $dataheader['usertypeid'] = $usertypeid;
  	$this->load->view('layout/backend_header', $dataheader);
        $this->load->view('layout/backend_menu');
        $this->load->view('sales/returnList');
        $this->load->view('layout/backend_footer');

    }
	  public function generateLowstockReport(){

        $categorytypeid = $this->input->get_post('categorytypeid');
        $subcategoryid = $this->input->get_post('subcategoryid');
        $brandid = $this->input->get_post('brandid');
        $sizeid = $this->input->get_post('sizeid');
        $barcode = $this->input->get_post('barcode');
        $showroomId = $this->input->get_post('showroomId');
//        $noOfPage = "All";
        $sessionUserTypeIdIsset = $this->session->has_userdata('usertypeid');
        $adminid = "0";
        if ($sessionUserTypeIdIsset == 1) {
            $sessionUserTypeId = $this->session->userdata('usertypeid');
            if ($sessionUserTypeId == 2) {
                $adminid = $this->session->userdata('userid');
            } else if ($sessionUserTypeId == 1) {
                $adminid = $this->input->get_post('adminid');
            } else if ($sessionUserTypeId == 4) {
                $adminid = $this->session->userdata('adminid');
            }
        }

        $rec_limit = "All";
        $page = 0;
//        $ProductList = $this->users_model->getProductList($adminid, "0", $showroomId, $categorytypeid, $subcategoryid, $brandid, $sizeid, $barcode,  $rec_limit, $page);

          $paginationArray = $this->users_model->getProductList($adminid, "0", $showroomId, $categorytypeid, $subcategoryid, $brandid, $sizeid, $barcode,  $rec_limit, $page);
          $left_rec = $paginationArray['left_rec'];
          $ProductList = $paginationArray['resultArrayData'];
          $rec_limit = $paginationArray['rec_limit'];

//        echo "<pre>";
//        print_r($ProductList);
//        echo "</pre>";
        $stringOfRecord = "productid \t productname \t productrate \t retailerMRP \t retailerShowroomId \t  barcode \t brandid \t productsize \t categorytypeid \t subcategoryid \t brandname \t size \t categorytype \t avalableQty";
        for($m=0; $m<count($ProductList);$m++){
            $productid = $ProductList[$m]['productid'];
            $productname = $ProductList[$m]['productname'];
            $productrate = $ProductList[$m]['productrate'];
            $retailerMRP = $ProductList[$m]['retailerMRP'];
            $retailerShowroomId = $ProductList[$m]['retailerShowroomId'];
            $barcode = $ProductList[$m]['barcode'];
            $brandid = $ProductList[$m]['brandid'];
            $productsize = $ProductList[$m]['productsize'];
            $categorytypeid = $ProductList[$m]['categorytypeid'];
            $subcategoryid = $ProductList[$m]['subcategoryid'];
            $brandname = $ProductList[$m]['brandname'];
            $size = $ProductList[$m]['size'];
            $categorytype = $ProductList[$m]['categorytype'];
            $avalableQty = $ProductList[$m]['avalableQty'];

            $stringOfRecord = $stringOfRecord. "\n $productid \t $productname \t $productrate \t $retailerMRP \t $retailerShowroomId \t $barcode \t $brandid \t $productsize \t $categorytypeid \t $subcategoryid \t $brandname \t $size \t $categorytype \t $avalableQty";
        }

        $dateTime = date("YmdHis");
        header("Content-Type: application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachement; filename=$dateTime.xls");
        header("Express: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);

        echo $stringOfRecord;
    }

}
