<?php

/**
 * Created by IntelliJ IDEA.
 * User: jonam
 * Date: 24/7/16
 * Time: 7:52 AM
 */
class Pos_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function selectQueryList($tablename,$fieldname,$condition){

        $returnValue = array();
	$fieldnames="";

	for($i=0;$i<count($fieldname);$i++)
	{
		$fieldnames.="t.".$fieldname[$i].",";
	}
	$fieldnames=trim($fieldnames,",");
	

        $sql = "SELECT ".$fieldnames." FROM ".$tablename." t WHERE ".$condition;
        $executeQuery = $this->db->query($sql);
	$returnValue = $executeQuery->result_array(); 


        return $returnValue;
    }

    public function productDetails($productId){

        
	$this->db->select('productid,productname,productrate,availablequantity,barcode');
	$this->db->where('productid', $productId);
	$q = $this->db->get('tbl_product');
	$returnValue = $q->result_array();

        return $returnValue;
    }

	public function insertSellDetails($insertValue)
	{
	
		if($insertValue['Customer']!="" || $insertValue['mobile']!="")
		{
			$this->db->select('id');
			$this->db->where('mobileno', $insertValue['mobile']);
			$q = $this->db->get('tbl_customer');
			$returnValue = $q->result_array();
	
			if(count($returnValue)==0)
			{
				$data = array(
				'name'=>$insertValue['Customer'],
				'mobileno'=>$insertValue['mobile']
				);

				$this->db->insert('tbl_customer',$data);
				$customerId = $this->db->insert_id();
			
			}
			else
			{
				$customerId=$returnValue[0]['id'];
			}
		}
		else
		{
			$customerId=0;		
		}

		$data = array(
		'discount'=>$insertValue['totdiscount'],
		'roundoff'=>$insertValue['roundoff'],
		'Total'=>$insertValue['FinalTotal'],
		'customerId'=>$customerId
		);

		$this->db->insert('tbl_customerreceipt',$data);
		$receiptId = $this->db->insert_id();

		
		for($i=0;$i<count($insertValue['count']);$i++)
		{
			$customerreceiptproduct = array(
			'receiptId'=>$receiptId,
			'productId'=>$insertValue['product'][$i],
			'price'=>$insertValue['price'][$i],
			'qty'=>$insertValue['qty'][$i],
			'discount'=>$insertValue['disc'][$i]
			);
			
			$this->db->insert('tbl_customerreceiptproduct',$customerreceiptproduct);
		}

		
	}
	
}

?>
