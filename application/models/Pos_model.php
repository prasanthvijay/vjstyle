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

    public function selectQueryList($tablename, $fieldname, $condition)
    {

        $returnValue = array();
        $fieldnames = "";

        for ($i = 0; $i < count($fieldname); $i++) {
            $fieldnames .= "t." . $fieldname[$i] . ",";
        }
        $fieldnames = trim($fieldnames, ",");


        $sql = "SELECT " . $fieldnames . " FROM " . $tablename . " t WHERE " . $condition;
        $executeQuery = $this->db->query($sql);
        $returnValue = $executeQuery->result_array();


        return $returnValue;
    }

    public function productDetails($barcode, $retailerShowRoomId)
    {


        //$this->db->select('productid,productname,barcode');
        //$this->db->where('productid', $productId);
        //$q = $this->db->get('tbl_product');
        $sql = "SELECT t.productid,t.productname,t.barcode,a.price, sum(pb.quantity) as quantity, sum(b.qty) as qty FROM tbl_product t LEFT JOIN tbl_productMapping a on  a.productid = t.productid and a.showroomId ='" . $retailerShowRoomId . "' LEFT JOIN tbl_productBatch pb on  pb.productid = a.productid and pb.showRoomId=a.showroomId LEFT JOIN  tbl_customerreceiptproduct b on t.productId = b.productid and b.showroomId=a.showroomId WHERE t.barcode ='" . $barcode . "' and a.productId =t.productid";
//		echo "<br><br><br>";
        $executeQuery = $this->db->query($sql);
        $returnValue = $executeQuery->result_array();
        return $returnValue;
    }

    public function insertSellDetails($insertValue)
    {

        if ($insertValue['Customer'] != "" || $insertValue['mobile'] != "") {
            $this->db->select('id');
            $this->db->where('mobileno', $insertValue['mobile']);
            $q = $this->db->get('tbl_customer');
            $returnValue = $q->result_array();

            if (count($returnValue) == 0) {
                $data = array(
                    'name' => $insertValue['Customer'],
                    'mobileno' => $insertValue['mobile']
                );

                $this->db->insert('tbl_customer', $data);
                $customerId = $this->db->insert_id();

            } else {
                $customerId = $returnValue[0]['id'];
            }
        } else {
            $customerId = 0;
        }

        $data = array(
            'discount' => $insertValue['totdiscount'],
            'roundoff' => $insertValue['roundoff'],
            'Total' => $insertValue['FinalTotal'],
            'customerId' => $customerId,
            'adminid' => $insertValue['adminid'],
            'active' => 'active',
            'showroomId' => $insertValue['showroomId'],
            'date' => date("Y-m-d H:i:s")
        );

        $this->db->insert('tbl_customerreceipt', $data);
        $receiptId = $this->db->insert_id();


        for ($i = 0; $i < $insertValue['count']; $i++) {
            $customerreceiptproduct = array(
                'receiptId' => $receiptId, 'showroomId' => $insertValue['showroomId'][$i],
                'productId' => $insertValue['product'][$i],
                'price' => $insertValue['price'][$i],
                'qty' => $insertValue['qty'][$i],
                'adminid' => $insertValue['adminid'],
                'discount' => $insertValue['disc'][$i]
            );

            $this->db->insert('tbl_customerreceiptproduct', $customerreceiptproduct);
        }

        return $receiptId;

    }

    public function receiptDetails($receiptId)
    {


        $this->db->select('*');
        $this->db->where('id', $receiptId);
        $q = $this->db->get('tbl_customerreceipt');
        $returnValue['customerreceipt'] = $q->result_array();


        $this->db->select('*');
        $this->db->where('receiptId', $receiptId);
        $q = $this->db->get('tbl_customerreceiptproduct');
        $returnValue['productDetails'] = $q->result_array();

        if (count($returnValue['customerreceipt']) > 0) {

            $showRoomId = $returnValue['customerreceipt'][0]['showRoomId'];
            $adminid = $returnValue['customerreceipt'][0]['adminid'];

            $this->db->select('name, email, mobile, address, tinnumber, cinnumber');
            $this->db->where('userid', $showRoomId);
            $q = $this->db->get('tbl_user');
            $returnValue['showroomdetails'] = $q->result_array();

            $this->db->select('name,mobileno');
            $this->db->where('id', $returnValue['customerreceipt'][0]['customerId']);
            $q = $this->db->get('tbl_customer');
            $returnValue['customer'] = $q->result_array();
        }

        if (count($returnValue['productDetails']) > 0) {
            $this->db->select('productname,barcode');
            $this->db->where('`productid` in ', '(select `productId` from `tbl_customerreceiptproduct` where `receiptId` = ' . $receiptId . ')', false);
            $q = $this->db->get('tbl_product');
            $returnValue['product'] = $q->result_array();
        }

        return $returnValue;
    }

    function insertReturnSellDetails($insertReceiptValue)
    {

        for ($i = 0; $i < count($insertReceiptValue['billProduct']); $i++) {
            if ($insertReceiptValue['reduceCount'][$i] != 0) {
                $customerreturnreceiptproduct = array(
                    'oldReceipt' => $insertReceiptValue['oldreceiptId'],
                    'newReceipt' => $insertReceiptValue['newReceipt'],
                    'productId' => $insertReceiptValue['billProduct'][$i],
                    'reduceCount' => $insertReceiptValue['reduceCount'][$i]
                );

                $this->db->insert('tbl_returnProduct', $customerreturnreceiptproduct);
            }
        }
    }


}

?>
