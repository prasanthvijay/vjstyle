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
	$returnValue = $executeQuery->result();        


        return $returnValue;
    }
}

?>
