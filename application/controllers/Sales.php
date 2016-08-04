<?php


class Sales extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
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


	public function pos()
    	{
		$dataheader['title'] = "POS";

		$tablename="tbl_product";
		$fieldname=array('productid','productname');
		$condition="t.adminid=1 and t.active=active";
	
		$productList = $this->pos_model->selectQueryList($tablename,$fieldname,$condition);
		$dataheader['productList'] = $productList;

		$selectedProduct = $this->input->post('selectedProduct');
	
		if($selectedProduct!="")
		{
			$selectedProductExplode=explode("|",$selectedProduct);
			$insertValue['TotalProductCost']=0;

			$insertValue['count']=count($selectedProductExplode)-1;
			for($i=0;$i<$insertValue['count'];$i++)
			{
				$j=$i+1;
				$insertValue['product'][$i] = $this->input->post('product_'.$j);
				$insertValue['price'][$i] = $this->input->post('price_'.$j);
				$insertValue['qty'][$i] = $this->input->post('qty_'.$j);
				$insertValue['disc'][$i] = $this->input->post('disc_'.$j);

				$beforeTotal=$insertValue['qty'][$i]*$insertValue['price'][$i];

				$insertValue['EachProductCost'][$i]=$beforeTotal-($beforeTotal*$insertValue['disc'][$i]/100);
	
				$insertValue['TotalProductCost']+=$insertValue['EachProductCost'][$i];
			}
		
			$insertValue['totdiscount'] = $this->input->post('totdiscount');
			$insertValue['roundoff'] = $this->input->post('roundoff');

			$insertValue['FinalTotal']=($insertValue['TotalProductCost']*$insertValue['totdiscount']/100)-$insertValue['roundoff'];
			$insertValue['Customer'] = $this->input->post('Customer');
			$insertValue['mobile'] = $this->input->post('mobile');

			$insertSellDetails = $this->pos_model->insertSellDetails($insertValue);		
		}
		
		
		$this->load->view('layout/backend_header',$dataheader);
		$this->load->view('layout/backend_menu');
		$this->load->view('sales/pos');
		$this->load->view('layout/backend_footer');
    	}
	public function posajax()
	{
		$productId=$this->input->get_post("productId");
		$productDetails = $this->pos_model->productDetails($productId);
		echo json_encode($productDetails);
	}

	public function receipt($receiptId)
	{

		$dataheader['title'] = "Receipt";


		$receiptDetails = $this->pos_model->receiptDetails($receiptId);

		$dataheader['receiptDetails']=$receiptDetails;

		$this->load->view('layout/backend_header',$dataheader);
		$this->load->view('layout/backend_menu');
		$this->load->view('sales/receipt');
		$this->load->view('layout/backend_footer');
	}
}
