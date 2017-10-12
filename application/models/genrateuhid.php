<?php 

class genrateUhid extends CI_Model {

	 public function __construct()
{
parent :: __construct();
        
}	 


function insertDataUhid($data)
{

	$this->db->insert('patient',$data);
	

}



}


?>