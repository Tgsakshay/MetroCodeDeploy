<?php 

class doctor extends CI_Model {

	 public function __construct()
{
	
parent :: __construct();
        
}	 


function getOPDDoctor()
{
      $type='OPD';
	  $this->db->from('doctor');
	 $this->db->where('type',$type);
	$q = $this->db->get();
	return $q->result_array();
	 

}

function getDoctorDetails($doc_id)
{
      
	  $this->db->from('doctor');
	 $this->db->where('id',$doc_id);
	$q = $this->db->get();
	return $q->result_array();
	 

}
}


?>