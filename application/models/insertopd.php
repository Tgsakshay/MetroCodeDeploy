<?php 

class insertOPD extends CI_Model {

	 public function __construct()
{
parent :: __construct();
        
}	 


function insertDataOPD($data)
{

	$this->db->insert('patient',$data);
	

}



}


?>