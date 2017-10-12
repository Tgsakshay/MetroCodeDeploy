<?php 

class Address extends CI_Model {

	 public function __construct()
{
parent :: __construct();
        
}	 


function state()
{

	$q = $this->db->get('state');
	return $q->result_array();
	 

}
function district($state_id)
{

      $this->db->from('districmp');
	 $this->db->where('state_id',$state_id);
	$q = $this->db->get();
	return $q->result_array();
	 
}
function tahsil($district_id)
{

      $this->db->from('tahsil');
	 $this->db->where('district_id',$district_id);
	$q = $this->db->get();
	return $q->result_array();
	 
}
function villmp($tahsil_id)
{

      $this->db->from('villmp');
	 $this->db->where('tehsil_id',$tahsil_id);
	$q = $this->db->get();
	return $q->result_array();
	 
}


function scheme()
{

	$q = $this->db->get('scheme');
	return $q->result_array();
	 

}

}


?>