<?php 

class GenrateID extends CI_Model {

	 public function __construct()
{
parent :: __construct();
        
}	 

private $arr = array();
private $arr2 = array();
function getid($tablename)
{
$row = $this->db->query('SELECT MAX(id) AS maxid FROM '.$tablename.' ')->row();
if ($row) {
    $id = $row->maxid; 
	$id=$id+1;
}
       return $id;
}

function getidMax($tablename,$id_w)
{
$row = $this->db->query('SELECT MAX('.$id_w.') AS maxid FROM '.$tablename.' ')->row();
if ($row) {
    $id = $row->maxid; 
	//$id=$id+1;
}
       return $id;
}



function getidMax_by_uhid($tablename,$id_w,$uhid_prefix,$uhid)
{
$row = $this->db->query('SELECT MAX('.$id_w.') AS maxid FROM '.$tablename.' where '.$uhid_prefix.'_uhid ='.$uhid )->row();
if ($row) {
    $id = $row->maxid; 
	//$id=$id+1;
}
       return $id;
}


  public function getFloreId($r_id)
	   {
	    
	   $data['levelone'] = $this->Common_model->get_data_by_query("select * from resource where r_id='$r_id'");
	  
	  
	  foreach ($data['levelone'] as $key=>$ft)
                             {
							
					   if($ft['r_type']=='FLOOR')
							   {
					           array_push($this->arr,$ft['r_id']);
						 
							  }
							   else 
							   {
							    $id1=$ft['r_under_id'];
							  
							   $this->getFloreId($id1); 
							   //echo "hello";
							   
							   }		 
							  
								 
	                        }
				
				 if($ft['r_id']==$r_id)
				 {
				 $dd =$this->arr['0'];
				 // print_r();
				 // echo $dd;
				 // die;
				 return $dd;
				 }
	 
   // print_r($data['levelone']);
	
	   }
	   
	   	   	   public function hirericunder($r_id)
	   {
	   $data['levelone'] = $this->Common_model->get_data_by_query("select * from resource where r_under_id=$r_id "); 
	
	   foreach ($data['levelone'] as $key=>$ft)
                               {
							    array_push($this->arr2,$ft['r_id']);
							 
							    
							   
							    }
	   					
	   $data5['result']=$this->arr2;
	   
	    foreach ($data5['result'] as &$value) {
			
			
                                                       $data['levelone'] = $this->Common_model->get_data_by_query("select * from resource where r_under_id=$value"); 
													  
														// $aa=$aa."->". $value ;
													 
														foreach ($data['levelone'] as $key=>$ft)
                                                  {
												  array_push($this->arr2,$ft['r_id']);
												  }
                                                 }	
	   
							  //print_r($this->arr2);
							    // $id1=$ft['r_under_id'];
							
							
							return $this->arr2;
							   
							   // $this->hireric($id1);  
					         
	   }

}


?>