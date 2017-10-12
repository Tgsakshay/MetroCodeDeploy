<?php class path_mdl extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	
	function getall()
    {
     return $this->db->get('patient')->result();
	}
    function alt_mdl($data)
	 {
		 $this->db->query("select * from patient where id=".$data."");
		 $this->db->from('patient');
		 $this->db->where('id',$data);
		 $q = $this->db->get();
		 return $q->result();
		
	 }
}
?>