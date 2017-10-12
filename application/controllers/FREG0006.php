<?php //if ( ! defined('BASEPATH')) exit('No direct script access allowed'); co12

class FREG0006 extends CI_Controller {
	public function __construct()
	{
	parent :: __construct();

	$this->load->model('Address');
	$this->load->model('doctor');
	$this->load->model('genrateUhid');
	$this->load->model('GenrateID');
	//$this->load->model('insertOPD');
	$this->load->model('Common_model');
	$this->load->model('Crud_model');
	$this->load->helper('url');
	$this->load->library('zend');
			//load in folder Zend
	$this->zend->load('Zend/Barcode');     
	}	
	public function index()
	{
		if($this->ion_auth->logged_in()){
		
		    $data['message'] = $this->session->flashdata('message');
		    $data['state'] =$this->Address->state();
		    $data['district'] =$this->Address->district('24');
			$data['bpldisease'] = $this->Common_model->get_data_by_query('select DISTINCT  Disease_catigory from bpldisease ');
		    $data['doc_name'] =$this->Common_model->get_data_by_query("select * from doctor where id not in ('5','81') order by doc_name");
		    $data['mediclam_company'] =$this->Common_model->get_data_by_query('select * from mediclam_company where medi_c_status=1');
			$this->template->set_template('user');
			$this->template->write_view('header', 'default/header',$this->session->userdata);
			$this->template->write_view('sidebar', 'default/sidebar');
			$this->template->write_view('content', 'admin/FREG0006/index',$data);
			$this->template->write_view('footer', 'default/footer');
			$this->template->render();
		
		}
		else{
			redirect('auth/login');	
		}		
	}
	public function dashbord()
	{
		if($this->ion_auth->logged_in()){
		
		    // $data['message'] = $this->session->flashdata('message');
		    // $data['state'] =$this->Address->state();
		    // $data['district'] =$this->Address->district('24');
			// $data['bpldisease'] = $this->Common_model->get_data_by_query('select DISTINCT  Disease_catigory from bpldisease ');
		    // $data['doc_name'] =$this->Common_model->get_data_by_query('select * from doctor order by doc_name ');
		    // $data['mediclam_company'] =$this->Common_model->get_data_by_query('select * from mediclam_company where medi_c_status=1');
			
			$this->template->set_template('user');
			$this->template->write_view('header', 'default/header',$this->session->userdata);
			$this->template->write_view('sidebar', 'default/sidebar');
			$this->template->write_view('content', 'admin/FREG0006/dashbord');
			$this->template->write_view('footer', 'default/footer');
			$this->template->render();
		}else{
			redirect('auth/login');	
		}		
	}
	 public function intercom()
    {
                 	  $User_Name=$_GET['intercom_name'];
                 	  //$Phone_Number=$_GET['intercom_num'];
                 	
                               
						if($User_Name !='')
                               {
                               $User_Name =$User_Name.'@User_Name';
                               }
                                
                               	// ELSE if($Phone_Number !='')
                               // {
                               // $Phone_Number =$Phone_Number.'@Phone_Number';
                               // }
                               
                               
                               $serchitem = array($User_Name);
                               
                               $querry='';
                                foreach ($serchitem as &$value) {
                               if($value=='select')
							  	{
							    }
							  else if($value=='')
							  {
                               }
                               else
                               {
                               
                                  $value_aryy = explode ( "@", $value );
                                   $data = $value_aryy [0];
                                   $filed = $value_aryy [1];
                               	
                               	if($filed=='User_Name')
                               	{
                               	  $querry .= " and " .$filed." like "."'".$data."%'";
                               	}
							 
                                  // else if($filed=='Phone_Number')
                               	// {
                               	  // $querry .= "and Phone_Number like "."'%".$data."%'";
                               	// }
								
                               	
                               }
                               
                                 
                               }
                               
                                       $number = $this->Common_model->get_data_by_query("select * from metro_phone_numbers where User_id>0 $querry");
                 	   // echo $this->db->last_query();
					   // die;
                       // print_r( $number );
					   // die;
                 	  ?>
                 	   
					  <table class="CSSTableGenerator8">
                          <tr role="row">
                            <td>Sl.No</td>
                            <td>Name</td>
                            <td>Numbers</td>
							
                          </tr>
                          <?php
								$sl=0;
								foreach($number as $number)
								{
									$sl++;
								?>
                          <tr class="odd">
                          <td><?php echo $sl;?>
                          </td>
						  
                            <td class="sorting_1">
								<span>
								<?php echo ucwords(strtoupper($number['User_Name']));?></span>
								
							</td> 
							<td class=" sorting_1">
								<span>
								<?php echo ucwords(strtoupper($number['Phone_Number']));?></span>
								
							</td>
							
						
                           	<!-- <td>
						
							  <button class='btn blue mini ' id='update_<?php// echo $ft["xray_retid"];?>' type='button' onclick='showedit(<?php// echo $ft["xray_retid"];?>);' ><i class='icon-edit'></i>Update</button>
							  <button class='btn blue mini hide' id='save_<?php echo $ft["xray_retid"];?>' type='button' onclick='saveedited(<?php echo $ft['xray_retid']?>);'  ><i class="icon-ok"></i>save</button>
							 
							  
 							  </td>-->
							  </tr>
                            <?php 
								}
								?>
                         
                          <?php //form_close();?>
                      </table>
                                              <?php   
                 	
                 	
	}
	public function metro_phone_numbers()
	{
		
		
		$data['User_Name']=$_POST['name'];
		$data['Phone_Number']=$_POST['number'];
		$this->Crud_model->insert_record('metro_phone_numbers',$data);
		redirect('admin/FREG0006/get_metro_phone_numbers');
	}
	public Function get_metro_phone_numbers()
	{
		if($this->ion_auth->logged_in())
	{
		$user=$this->session->userdata('user_id');
		$this->template->set_template('user');
		$this->template->write_view('header', 'default/header',$this->session->userdata);
		$this->template->write_view('sidebar', 'default/sidebar');
		$data['number']= $this->Common_model->get_data_by_query("select * from metro_phone_numbers order by User_Name  ");
		$this->template->write_view('content', 'admin/FREG0006/intercom_number',$data);
		// $this->template->write_view('footer', 'default/footer');
		$this->template->render();
	}
		else
		{
			 redirect('auth/login');	
		}		
	}
	
	public Function get_metro_gallery()
	{
		$user=$this->session->userdata('user_id');
		$this->template->set_template('user');
		$this->template->write_view('header', 'default/header',$this->session->userdata);
		$this->template->write_view('sidebar', 'default/sidebar');
		//$data['number']= $this->Common_model->get_data_by_query("select * from metro_phone_numbers order by User_Name  ");
		$this->template->write_view('content', 'admin/FREG0006/get_metro_gallery');
		// $this->template->write_view('footer', 'default/footer');
		$this->template->render();
			
	}
	
	public function getdisesaseName()
	{
	echo $Disease_catigory=$_GET['Disease_catigory'];
	 
	$bpldis['aa']= $this->Common_model->get_data_by_query("select * from bpldisease where Disease_catigory = '$Disease_catigory' ");
	foreach ($bpldis['aa'] as $key=>$ft)
		{
			echo "<option value=".$ft['id'].">".$ft['Disease']."</option>";
		}
	}

	public function getMPBOCdisesaseName()
	{
	echo $Disease_catigory=$_GET['Disease_catigory'];
	 
	$bpldis['aa']= $this->Common_model->get_data_by_query("select * from mpbocdisease where Disease_catigory = '$Disease_catigory' ");
	foreach ($bpldis['aa'] as $key=>$ft)
	{
		echo "<option value=".$ft['id'].">".$ft['Disease']."</option>";
	}

	}
	
	public function frontview()
	{
		if($this->ion_auth->logged_in()){
		
		    $data['message'] = $this->session->flashdata('message');
		   
			
			$currentdate=date('Y-m-d');
			
			
		   $data['opd_p']=$this->Common_model->get_data_by_query("select count(opd_patient.id) as opdpatient from opd_patient join patient on opd_patient.uhid=patient.id where date_format(date,'%Y-%m-%d')='$currentdate'");
			
           $data['casu_p']=$this->Common_model->get_data_by_query("select count(casualty.casu_uhid) as casupatient from casualty join patient on casualty.casu_uhid=patient.id where  casualty.casu_push not in('IPD','CATHLAB','DISCHARGED','REFUSED')");	

           $data['ipd_p']=$this->Common_model->get_data_by_query("select count(i.admit_uhid) as ipdpatient from ipd_admit i join patient p on i.admit_uhid=p.id where i.admit_status in ('CP','NA')");
		   
		   $data['ipd_p_scheme4']=$this->Common_model->get_data_by_query("select p.first_name,c.casu_id,p.middle_name,p.last_name,a.admit_uhid,a.admit_bed,a.admit_ward,a.admit_floor from ipd_admit a join patient p on a.admit_uhid = p.id join casualty c on a.admit_id=c.casu_id where a.admit_status in ('CP','NA','OT')  and admit_hide = 1 and c.casu_scheme='4'");

           $data['ipd_p_scheme1']=$this->Common_model->get_data_by_query("select * from ipd_admit a join patient p on a.admit_uhid = p.id join casualty c on a.admit_id=c.casu_id where a.admit_status in ('CP','NA','OT')  and admit_hide = 1  and c.casu_scheme='1' GROUP BY a.admit_id");
		   
		   
           // $data['ipd_all']=$this->Common_model->get_data_by_query("select * from ipd_admit a join patient p on a.admit_uhid = p.id join casualty c on a.admit_id=c.casu_id where a.admit_status in ('CP','NA','OT')");
           $data['ipd_all']=$this->Common_model->get_data_by_query("select a.*,p.*,c.*,max(i.shift_entrydt),max(shift_id) from ipd_admit a join patient p on a.admit_uhid = p.id join casualty c on a.admit_id=c.casu_id join ipd_shift i on a.admit_id=i.shift_ipd_id where a.admit_status in ('CP','NA','OT')  and admit_hide = 1 GROUP BY admit_id ORDER BY max(i.shift_entrydt) DESC");
		   //echo $this->db->last_query();
		   //die;	

           // $data['ipd_p_scheme2']=$this->Common_model->get_data_by_query("select * from ipd_admit a join patient p on a.admit_uhid = p.id join casualty c on a.admit_uhid=c.casu_uhid where a.admit_status in ('CP','NA') and c.casu_scheme='2' and c.pat_status='NR'");


	       $data['ipd_p_scheme2']=$this->Common_model->get_data_by_query("select * from ipd_admit a join patient p on a.admit_uhid = p.id join casualty c on a.admit_id=c.casu_id where a.admit_status in ('CP','NA','OT')  and admit_hide = 1 and c.casu_scheme='2' and c.pat_status='NR'");
		   

           $data['ipd_p_scheme5']=$this->Common_model->get_data_by_query("select * from ipd_admit a join patient p on a.admit_uhid = p.id join casualty c on a.admit_id=c.casu_id where a.admit_status in ('CP','NA','OT')  and admit_hide = 1 and c.casu_scheme='5'");

           $data['ipd_p_scheme8']=$this->Common_model->get_data_by_query("select * from ipd_admit a join patient p on a.admit_uhid = p.id join casualty c on a.admit_id=c.casu_id where a.admit_status in ('CP','NA','OT')  and admit_hide = 1 and c.casu_scheme='8'");

           $data['ipd_p_scheme6']=$this->Common_model->get_data_by_query("select * from ipd_admit a join patient p on a.admit_uhid = p.id join casualty c on a.admit_id=c.casu_id where a.admit_status in ('CP','NA','OT')  and admit_hide = 1 and c.casu_scheme='6'");

           $data['ipd_p_scheme7']=$this->Common_model->get_data_by_query("select * from ipd_admit a join patient p on a.admit_uhid = p.id join casualty c on a.admit_id=c.casu_id where a.admit_status in ('CP','NA','OT')  and admit_hide = 1 and c.casu_scheme='7'");

           $data['ipd_p_scheme9']=$this->Common_model->get_data_by_query("select * from ipd_admit a join patient p on a.admit_uhid = p.id join casualty c on a.admit_id=c.casu_id where a.admit_status in ('CP','NA','OT')  and admit_hide = 1 and c.casu_scheme='9'");

           $data['ipd_p_scheme3']=$this->Common_model->get_data_by_query("select * from ipd_admit a join patient p on a.admit_uhid = p.id join casualty c on a.admit_id=c.casu_id where a.admit_status in ('CP','NA','OT')  and admit_hide = 1 and c.casu_scheme='3'");    

           $data['ipd_p_scheme10']=$this->Common_model->get_data_by_query("select * from ipd_admit a join patient p on a.admit_uhid = p.id join casualty c on a.admit_id=c.casu_id where a.admit_status in ('CP','NA','OT')  and admit_hide = 1 and c.casu_scheme='10'");	

           $data['ipd_p_scheme11']=$this->Common_model->get_data_by_query("select * from ipd_admit a join patient p on a.admit_uhid = p.id join casualty c on a.admit_id=c.casu_id where a.admit_status in ('CP','NA','OT')  and admit_hide = 1 and c.casu_scheme='11'");			   
		   
		   // $data['resource']=$this->Common_model->get_data_by_query("select * from ipd_admit a left join patient p on a.admit_uhid=p.id where admit_status ='DISCHARGED' and  date_format(a.admit_exitdt,'%Y-%m-%d')='$currentdate' ");		   
		   $data['resource']=$this->Common_model->get_data_by_query("select * from ipd_admit a left join patient p on a.admit_uhid=p.id where admit_status ='DISCHARGED' and  date_format(a.admit_exitdt,'%Y-%m-%d')='$currentdate' ");		   
			
			$this->template->set_template('user');
			$this->template->write_view('header', 'default/header',$this->session->userdata);
			$this->template->write_view('sidebar', 'default/sidebar');
			$this->template->write_view('content', 'admin/FREG0006/frontview',$data);
			 //$this->template->write_view('content', 'auth/index',);
			// $this->template->write_view('footer', 'default/footer');
			$this->template->render();
		}else{
			redirect('auth/login');	
		}		
	}
	
	public function newRegister()
	{   
	    //alert("hii");
	   
	    $this->template->set_template('user');
		$this->template->write_view('header', 'default/header',$this->session->userdata);
		//$this->template->write_view('sidebar', 'default/sidebar');
		$d=date('Y-m-d');
		$data['today_pat']=$this->Common_model->get_data_by_query("SELECT * FROM `casualty` WHERE date_format(casu_entrydt,'%Y-%m-%d')='$d'");
		$data['casu_pat']=$this->Common_model->get_data_by_query("SELECT * FROM `casualty` WHERE date_format(casu_pushdt,'%Y-%m-%d')='0000-00-00'");
		$data['total_pat']=$this->Common_model->get_data_by_query("SELECT * FROM `ipd_admit` WHERE admit_status='cp'");
		$this->template->write_view('content', 'admin/FREG0006/dashbord1',$data);
		$this->template->write_view('footer', 'default/footer');
		$this->template->render();
	}
	
	
	public function getpatientdata()
	{
	          echo $uhid=$_POST['uhid'];	
             // die();			  
	          //$ipdid=$_POST['ipdid'];
              
		
		
		
	$data['q']=$this->Common_model->get_data_by_query("select * from patient p left join districmp  on districmp.id=p.district left join villmp on villmp.id=p.village left join tahsil on tahsil.id=p.tehsil left join ipd_admit on ipd_admit.admit_uhid=p.id where p.id='$uhid' order by admit_id desc limit 1");
		foreach($data['q'] as $k)
		{
			echo "
			<tr>
			<td>Name:</td>
			<td>".$k['first_name']." ".$k['middle_name']." ".$k['last_name']."</td></tr>
<td>Father's Name:</td>
<td>".$k['fa_hus_name']."</td></tr>
<tr>
<td>Contact No.:</td>
<td>".$k['contact_no']."</td></tr>
<tr>
<td>Age:</td>
<td>".$k['patient_age']."</td></tr>
<tr>
<td>Admission Date:</td>
<td>".date('d-m-Y, h:i A',strtotime($k['admit_entrydt']))."</td></tr>
<tr>
<td>Patient Address:</td>
<td>"."District:".$k['district']." "."Village:".$k['vill_name']." "."Tehsil:".$k['tahsil']."</td></tr>";
		}
	}
	
	
	
	public function searchcasu_p()
	{
		$name1=$_POST['name1'];
	
		if($name1!='')
{
	$name1=$name1.'@p.first_name';
}
$s=array($name1);
$q='';
foreach($s as $k1)
{
	if($k1=='')
	{
		$currentdate=date('Y-m-d');
		$data['casu_p']=$this->Common_model->get_data_by_query("select casualty.*,patient.* from casualty join patient on casualty.casu_uhid=patient.id where casualty.casu_push not in('IPD','CATHLAB','DISCHARGED','REFUSED')");		
	
									foreach($data['casu_p'] as $casu)  { ?>
									  
								       <tr>
											<td><?php echo $casu['id'];?></td>
											<td><?php echo $casu['first_name']." ".$casu['middle_name']." ".$casu['last_name'];?></td>
											<td><a href="#portlet-config" data-toggle="modal" class="config"><button id="readmit" class="btn blue" onclick="getpatientdata('<?php echo $casu['id'];?>')">View Details</button></a></td>
										</tr>
									<?php }
										
									
	}
	else{
		$ii=explode('@',$k1);
		$ij=$ii[0];
		$ik=$ii[1];
		if($ik=='p.first_name')
		{
			$q.=$ik." like "."'%".$ij."%'";
			
		}
		$currentdate2=date('Y-m-d');
		
		$data['ij2']=$this->Common_model->get_data_by_query("select p.first_name,p.middle_name,p.last_name,p.id from casualty c join patient p on c.casu_uhid=p.id where $q and c.casu_push not in('IPD','CATHLAB','DISCHARGED','REFUSED')");
		
	foreach($data['ij2'] as $k2)
	{
		?>
								       <tr>
											<td><?php echo $k2['id'];?></td>
											<td><?php echo $k2['first_name']." ".$k2['middle_name']." ".$k2['last_name'];?></td>
											
											<td><a href="#portlet-config" data-toggle="modal" class="config"><button id="readmit" class="btn blue" onclick="getpatientdata('<?php echo $k2['id'];?>')">View Details</button></a> </td>
									  </tr>
	<?php } 
										
		}

}
}

public function searchbplddy_p2()
{
	  $first_name=$_GET['first_name'];
	  $casu_id=$_GET['casu_id'];
	  
	
	if($first_name !='')
{
$first_name =$first_name.'@first_name';
}

	 	if($casu_id !='')
{
$casu_id =$casu_id.'@casu_id';
}


$serchitem = array($first_name,$casu_id);

$querry='';
 foreach ($serchitem as &$value) {

if($value=='select')
{
}
else if($value=='')
{
}
else
{

   $value_aryy = explode ( "@", $value );
    $data = $value_aryy [0];
    $filed = $value_aryy [1];
	
	if($filed=='first_name')
	{
	  $querry .= " and p.".$filed." like "."'%".$data."%'";
	}
    else if($filed=='casu_id')
	{
	  $querry .= " and c.casu_id='$data'";
	}

	
	
}

  
}

$currentdate2=date('Y-m-d');
		
		$data['ipd_p_scheme2']=$this->Common_model->get_data_by_query("select * from ipd_admit a join patient p on a.admit_uhid = p.id join casualty c on a.admit_uhid=c.casu_uhid where $q and a.admit_status in ('CP','NA') and c.casu_scheme='2' and c.pat_status='NR'");
		
		foreach($data['ipd_p_scheme2'] as $k2)
	{
?>
                                         <tr>
											<td><?php echo $k2['id'];?></td>
											<td><?php echo $k2['casu_id'];?></td>
											<td><?php echo $k2['first_name']." ".$k2['middle_name']." ".$k2['last_name'];?></td>
											
											<td><a href="#portlet-config" data-toggle="modal" class="config"><button id="readmit" class="btn blue" onclick="getpatientdata('<?php echo $k2['id'];?>')">View Details</button></a></td>
										</tr>



<?php
	}
		

}


    public function searchbplddy_p()
	{
		$name4=$_POST['name4'];
		//$ipd=$_POST['ipd'];

		if($name4!='')
{
	$name4=$name4.'@p.first_name';
}

$s=array($name4);
$q='';
foreach($s as $k1)
{
	if($k1=='')
	{
		$currentdate=date('Y-m-d');
		
		$data['ipd_p_scheme2']=$this->Common_model->get_data_by_query("select * from ipd_admit a join patient p on a.admit_uhid = p.id join casualty c on a.admit_id=c.casu_id where a.admit_status in ('CP','NA') and c.casu_scheme='2' and c.pat_status='NR'");		
	
	
	    // $data['ipd_p_scheme2']=$this->Common_model->get_data_by_query("select * from ipd_admit a join patient p on a.admit_uhid = p.id join casualty c on a.admit_id=c.casu_id where c.casu_status='1' and c.casu_scheme='2' and c.pat_status='NR'");		
	
									foreach($data['ipd_p_scheme2'] as $ipd_2)  { 
									$ward = $this->Common_model->getPtWard($ipd_2['casu_id'],$ipd_2['casu_uhid']);
									$bed = $this->Common_model->getPtBed($ipd_2['casu_id'],$ipd_2['casu_uhid']);
			
									?>
									  
								        <tr>
											<td><?php echo $ipd_2['id'];?></td>
											<td><?php echo $ipd_2['casu_id'];?></td>
											<td><?php echo $ipd_2['first_name']." ".$ipd_2['middle_name']." ".$ipd_2['last_name'];?></td>
											<td>
											<a href="#portlet-config" data-toggle="modal" class="config "><button id="readmit" class="btn blue mini" onclick="getpatientdata('<?php echo $ipd_2['id'];?>')">View </button></a>
											</td>
											<td><a href="#discharge_modal" data-toggle="modal" class="config"><button id="readmit1" name="readmit1" class="btn red mini" onclick="getpatientdata1('<?php echo $ipd_2['casu_uhid'];?>','<?php echo $ipd_2['casu_id'];?>')">Discharge</button></a>
											</td>
											<td><?php echo $ward.'/'.$bed; ?></td>
											<td>
													<a style='width:100px;' id="readmit1" name="readmit1" class="btn mini red" href="<?php echo base_url().'admin/FREG0006/shiftPatient/'.$ipd_2['admit_uhid'].'/'.$ipd_2['casu_id'].'/'.$ipd_2['admit_ward'].'/'.$ipd_2['admit_floor'].'/1/'.$ipd_2['admit_bed'];?>">Shift &nbsp;<i class='icon-share-alt'></i></a>
											</td>
										</tr>
									<?php }
										
									
	}
	else{
		$ii=explode('@',$k1);
		$ij=$ii[0];
		$ik=$ii[1];
		if($ik=='p.first_name')
		{
			$q.=$ik." like "."'%".$ij."%'";
			
		}
		$currentdate2=date('Y-m-d');
		
		// $data['ipd_p_scheme2']=$this->Common_model->get_data_by_query("select * from ipd_admit a join patient p on a.admit_uhid = p.id join casualty c on a.admit_uhid=c.casu_uhid where $q and a.admit_status not like 'DISCHARGE%' and c.casu_scheme='2' and c.pat_status='NR'");
		
		$data['ipd_p_scheme2']=$this->Common_model->get_data_by_query("select * from ipd_admit a join patient p on a.admit_uhid = p.id join casualty c on a.admit_id=c.casu_id where $q and a.admit_status in ('CP','NA') and c.casu_scheme='2' and c.pat_status='NR'");
		
	foreach($data['ipd_p_scheme2'] as $k2)
	{
		?>
								        <tr>
											<td><?php echo $k2['id'];?></td>
											<td><?php echo $k2['casu_id'];?></td>
											<td><?php echo $k2['first_name']." ".$k2['middle_name']." ".$k2['last_name'];?></td>
											
											<td><a href="#portlet-config" data-toggle="modal" class="config"><button id="readmit" class="btn blue mini" onclick="getpatientdata('<?php echo $k2['id'];?>')">View Details</button></a>
											    <a href="#discharge_modal" data-toggle="modal" class="config"><button id="readmit1" name="readmit1" class="btn red mini" onclick="getpatientdata1('<?php echo $k2['id'];?>','<?php echo $k2['casu_id'];?>')">Discharge</button></a>
											
											</td>
										       <td><?php echo $ward.'/'.$bed; ?></td>
											<td>
													<a style='width:100px;' id="readmit1" name="readmit1" class="btn mini red" href="<?php echo base_url().'admin/FREG0006/shiftPatient/'.$k2['admit_uhid'].'/'.$k2['casu_id'].'/'.$k2['admit_ward'].'/'.$k2['admit_floor'].'/1/'.$k2['admit_bed'];?>">Shift &nbsp;<i class='icon-share-alt'></i></a>
											</td>
										</tr>
									<?php } 
										
		}

}
}
				public function discharge_patient()
				{
					
					$uhid =  $this->input->post('uhid');
					$ipdid =  $this->input->post('ipdid');
					$date_dis =  $this->input->post('date_dis');
					
					$this->Common_model->doDischarge($uhid,$ipdid,$date_dis);
					redirect('admin/FREG0006/frontview#table6');
				}
				
				
	public function searchgeneral_p()
		{
					$first_name=$_POST['name3'];
					$casu_id=$_POST['general_regno'];
					$casu_uhid=$_POST['general_uhid'];
				
						if($first_name !='')
                     {
                     $first_name =$first_name.'@first_name';
                     }
                     
                     	 	if($casu_uhid !='')
                     {
                     $casu_uhid =$casu_uhid.'@casu_uhid';
                     }
		 	         if($casu_id !='')
                     {
                     $casu_id =$casu_id.'@casu_id';
                     }
	         $serchitem = array($first_name,$casu_uhid,$casu_id);
			 $querry='';
			  foreach ($serchitem as &$value) {
				  
				  if($value=='select')
                          {
                          }
                          else if($value=='')
                          {
                          }
                          else{
                          	   $value_aryy = explode ( "@", $value );
                               $data = $value_aryy [0];
                               $filed = $value_aryy [1];
							   if($filed=='first_name')
	                                {
	                                  $querry .= " and p.".$filed." like "."'%".$data."%'";
	                                }
									 else if($filed=='casu_uhid')
	                                {
	                                  $querry .= " and c.casu_uhid='$data'";
	                                }else if($filed=='casu_id')
	                                {
	                                  $querry .= " and c.casu_id='$data'";
	                                }
                          	
                          }
			  }
		
		$aaaa=$this->Common_model->get_data_by_query("select c.casu_uhid,c.casu_id,p.first_name,p.middle_name,p.last_name,a.admit_ward,a.admit_bed,a.admit_floor from ipd_admit a join patient p on a.admit_uhid = p.id join casualty c on a.admit_id=c.casu_id where  a.admit_status in ('CP','NA') and c.casu_scheme='1'  $querry ");	
			// echo $this->db->last_query();
			// DIE();
			$count=1;
	foreach($aaaa as $ipd_1)
	{
		$ward = $this->Common_model->getPtWard($ipd_1['casu_id'],$ipd_1['casu_uhid']);
		$bed = $this->Common_model->getPtBed($ipd_1['casu_id'],$ipd_1['casu_uhid']);
		 // print_r($wardbed);
		?>
		<tr>
			<td><?php echo $count;?></td>
			<td><?php echo $ipd_1['casu_uhid'];?></td>
			<td><?php echo $ipd_1['casu_id'];?></td>
			<td><?php echo $ipd_1['first_name']." ".$ipd_1['middle_name']." ".$ipd_1['last_name'];?></td>
			<td>
			<a href="<?php echo base_url()."admin/BILL00018/view_summery/".$ipd_1['casu_uhid'].'/'.$ipd_1['casu_id'];?>" title=" History ">
				<button type="button"  class="btn green mini delete "> <span>Payment History</span> </button>
			</a>
			<a class="" href="<?php echo base_url()."admin/BILL00018/generate_bill/".@$ipd_1['casu_uhid']."/".@$ipd_1['casu_id'];?>" title="Report">
				<input type="submit" name="reportprint" id="reportprint"  class="btn mini purple"  value="See Bill" onclick="valthisform();"/>
			</a>
			<a class="" href="<?php echo base_url()."admin/BILL00018/generate_bill_old/".@$ipd_1['casu_uhid']."/".@$ipd_1['casu_id'];?>" title="Report">
				<input type="submit" name="reportprint" id="reportprint"  class="btn mini green"  value="Old Bill" onclick="valthisform();"/>
			</a>
			<!--<a href="#portlet-config" data-toggle="modal" class="config"><button id="readmit" class="btn blue" onclick="getpatientdata('<?php echo $ipd_1['casu_uhid'];?>')">View Details</button></a>-->
			<a href="#discharge_modal" data-toggle="modal" class="config"><button id="readmit1" name="readmit1" class="btn mini red" onclick="getpatientdata1('<?php echo $ipd_1['casu_uhid'];?>','<?php echo $ipd_1['casu_id'];?>')">Discharge</button></a>
			</td>
			<td><?php echo $ward.'/'.$bed; ?></td>
				<td>
						<a style='width:100px;' id="readmit1" name="readmit1" class="btn mini red" href="<?php echo base_url().'admin/FREG0006/shiftPatient/'.$ipd_1['casu_uhid'].'/'.$ipd_1['casu_id'].'/'.$ipd_1['admit_ward'].'/'.$ipd_1['admit_floor'].'/1/'.$ipd_1['admit_bed'];?>">Shift &nbsp;<i class='icon-share-alt'></i></a>
				</td>
			</tr>
			<?php $count++ ;} 
						
	}

				
	public function searchall_p()
		{
			$first_name=$_POST['name3'];
			$casu_id=$_POST['all_regno'];
			$casu_uhid=$_POST['all_uhid'];
			if($first_name !='')
                {
                    $first_name =$first_name.'@first_name';
                }
            if($casu_uhid !='')
                {
                    $casu_uhid =$casu_uhid.'@casu_uhid';
                }
		 	if($casu_id !='')
                {
                    $casu_id =$casu_id.'@casu_id';
                }
	        $serchitem = array($first_name,$casu_uhid,$casu_id);
			$querry='';
			foreach($serchitem as &$value) {
				  
			if($value=='select')
                          {
                          }
                          else if($value=='')
                          {
                          }
                          else{
                          	   $value_aryy = explode ( "@", $value );
                               $data = $value_aryy [0];
                               $filed = $value_aryy [1];
							   if($filed=='first_name')
	                                {
	                                  $querry .= " and p.".$filed." like "."'%".$data."%'";
	                                }
									 else if($filed=='casu_uhid')
	                                {
	                                  $querry .= " and c.casu_uhid='$data'";
	                                }else if($filed=='casu_id')
	                                {
	                                  $querry .= " and c.casu_id='$data'";
	                                }
                          	
                          }
			  }
		
		$aaaa=$this->Common_model->get_data_by_query("select c.casu_uhid,c.casu_id,p.first_name,p.middle_name,p.last_name,a.admit_ward,a.admit_bed,a.admit_floor from ipd_admit a join patient p on a.admit_uhid = p.id join casualty c on a.admit_id=c.casu_id where  a.admit_status in ('CP','NA','OT')  $querry ");	
			// echo $this->db->last_query();
			// DIE();
			$count=1;
		foreach($aaaa as $ipd_1)
		{
		$ward = $this->Common_model->getPtWard($ipd_1['casu_id'],$ipd_1['casu_uhid']);
		$bed = $this->Common_model->getPtBed($ipd_1['casu_id'],$ipd_1['casu_uhid']);
		 // print_r($wardbed);
		?>
		<tr>
			<td><?php echo $count;?></td>
			<td><?php echo $ipd_1['casu_uhid'];?></td>
			<td><?php echo $ipd_1['casu_id'];?></td>
			<td><?php echo $ipd_1['first_name']." ".$ipd_1['middle_name']." ".$ipd_1['last_name'];?></td>
			<td>
			<a href="<?php echo base_url()."admin/BILL00018/view_summery/".$ipd_1['casu_uhid'].'/'.$ipd_1['casu_id'];?>" title=" History ">
				<button type="button"  class="btn green mini delete "> <span>Payment History</span> </button>
			</a>
			<a class="" href="<?php echo base_url()."admin/BILL00018/generate_bill/".@$ipd_1['casu_uhid']."/".@$ipd_1['casu_id'];?>" title="Report">
				<input type="submit" name="reportprint" id="reportprint"  class="btn mini purple"  value="See Bill" onclick="valthisform();"/>
			</a>
			<a class="" href="<?php echo base_url()."admin/BILL00018/generate_bill_old/".@$ipd_1['casu_uhid']."/".@$ipd_1['casu_id'];?>" title="Report">
				<input type="submit" name="reportprint" id="reportprint"  class="btn mini green"  value="Old Bill" onclick="valthisform();"/>
			</a>
			<!--<a href="#portlet-config" data-toggle="modal" class="config"><button id="readmit" class="btn blue" onclick="getpatientdata('<?php echo $ipd_1['casu_uhid'];?>')">View Details</button></a>-->
			<a href="#discharge_modal" data-toggle="modal" class="config"><button id="readmit1" name="readmit1" class="btn mini red" onclick="getpatientdata1('<?php echo $ipd_1['casu_uhid'];?>','<?php echo $ipd_1['casu_id'];?>')">Discharge</button></a>
			</td>
			<td><?php echo $ward.'/'.$bed; ?></td>
				<td>
						<a style='width:100px;' id="readmit1" name="readmit1" class="btn mini red" href="<?php echo base_url().'admin/FREG0006/shiftPatient/'.$ipd_1['casu_uhid'].'/'.$ipd_1['casu_id'].'/'.$ipd_1['admit_ward'].'/'.$ipd_1['admit_floor'].'/1/'.$ipd_1['admit_bed'];?>">Shift &nbsp;<i class='icon-share-alt'></i></a>
				</td>
			</tr>
			<?php $count++ ;} 
						
	}


public function searchipd_p()
	{
		$name2=$_POST['name2'];
	
		if($name2!='')
{
	$name2=$name2.'@p.first_name';
}
$s=array($name2);
$q='';
foreach($s as $k1)
{
	if($k1=='')
	{
		$currentdate=date('Y-m-d');
		$data['ipd_p']=$this->Common_model->get_data_by_query("select * from ipd_admit i join patient p on i.admit_uhid=p.id where date_format(admit_entrydt,'%Y-%m-%d')='$currentdate'");		
	
									foreach($data['ipd_p'] as $ipd)  { ?>
									  
								       <tr>
											<td><?php echo $ipd['id'];?></td>
											<td><?php echo $ipd['first_name']." ".$ipd['middle_name']." ".$ipd['last_name'];?></td>
											<td></td>
										</tr>
									<?php }
										
									
	}
	else{
		$ii=explode('@',$k1);
		$ij=$ii[0];
		$ik=$ii[1];
		if($ik=='p.first_name')
		{
			$q.=$ik." like "."'%".$ij."%'";
			
		}
		$currentdate2=date('Y-m-d');
		
		$data['ij2']=$this->Common_model->get_data_by_query("select * from ipd_admit i join patient p on i.admit_uhid=p.id where $q and date_format(admit_entrydt,'%Y-%m-%d')='$currentdate2'");
		
	foreach($data['ij2'] as $k3)
	{
		?>
								       <tr>
											<td><?php echo $k3['id'];?></td>
											<td><?php echo $k3['first_name']." ".$k3['middle_name']." ".$k3['last_name'];?></td>
											
											<td></td>
										</tr>
									<?php } 
										
		}

}
}
	
	public function searchopd_p()
	{
		$name=$_POST['name'];
	
		if($name!='')
{
	$name=$name.'@p.first_name';
}
$s=array($name);
$q='';
foreach($s as $k1)
{
	if($k1=='')
	{
		$currentdate=date('Y-m-d');
		$data['opd_p']=$this->Common_model->get_data_by_query("select opd_patient.*,patient.* from opd_patient join patient on opd_patient.uhid=patient.id where date_format(date,'%Y-%m-%d')='$currentdate'");	
	
									foreach($data['opd_p'] as $opd)  { ?>
									  
								       <tr>
											<td><?php echo $opd['id'];?></td>
											<td><?php echo $opd['first_name']." ".$opd['middle_name']." ".$opd['last_name'];?></td>
											
											<td><a href="<?php echo base_url().'admin/FREG0006/readmitForm/'.$opd['id'];?>"><button id="readmit" class="btn blue"<?php  
						                                     $group = $this->session->userdata('group');
						                            if($group=='cghs') {?> disabled='disabled'<?php }?> >Readmit</button></a></td>
										</tr>
									<?php }
										
									
	}
	else{
		$ii=explode('@',$k1);
		$ij=$ii[0];
		$ik=$ii[1];
		if($ik=='p.first_name')
		{
			$q.=$ik." like "."'%".$ij."%'";
			
		}
		$currentdate1=date('Y-m-d');
		// $ia=$this->Common_model->get_data_by_query("select * from opd_patient");
		// $id=$ia[0]['uhid'];
		$data['ij1']=$this->Common_model->get_data_by_query("select * from opd_patient o join patient p on o.uhid=p.id where $q and date_format(date,'%Y-%m-%d')='$currentdate1'");
		// echo $this->db->last_query();
		// die;
		// echo $nsm = $data['ij1'][0]['first_name'];
	foreach($data['ij1'] as $k)
	{
		?>
								       <tr>
											<td><?php echo $k['id'];?></td>
											<td><?php echo $k['first_name']." ".$k['middle_name']." ".$k['last_name'];?></td>
											
											<td><a href="<?php echo base_url().'admin/FREG0006/readmitForm/'.$k['id'];?>"><button id="readmit" class="btn blue">Readmit</button></a></td>
										</tr>
									<?php } 
										
		}

}
}
		/*if($name=='')
		{
		}
		else{
			$data['iz']=$this->Common_model->get_data_by_query("select opd_patient.*,patient.* from opd_patient join patient on opd_patient.uhid=patient.id where patient.first_name likes '%$a%'");
			foreach($data['iz'] as $kk)
			{
				?>
				<table>
				<tr>
				<td><?php echo $kk['id'];?></td>
											<td><?php echo $kk['first_name']." ".$kk['middle_name']." ".$kk['last_name'];?></td>
											
											<td><button id="readmit" class="btn blue" onclick="getpatient('<?php echo $kk['id'];?>')">Readmit</button></td></tr></table>
											<?php
			}
		}*/
		

	public function patientReg()
	{
			if($this->input->post('preg'))
			{
				 $consultantNamneId2 = explode('@@@', $this->input->post('consultant'));
							
              $consname=$consultantNamneId2[0] ;
			  
              $consID=$consultantNamneId2[1] ;
			
			
			$age=$this->input->post('patient_age');
			
			$datausse['dd']=$this->session->userdata;
			
		
			
			
			
			
			foreach ($datausse as $key=>$value){} 
					
   		     $userid=$value['user_id'];
			
			
		     $data['id'] = $this->GenrateID->getid('patient');
			 $data['first_name'] = $this->input->post('first_name');
			 $data['middle_name'] = $this->input->post('middle_name');
			 $data['last_name'] = $this->input->post('last_name');
			 $data['fa_hus_name'] = $this->input->post('fa_hus_name');
			 $data['patient_gender'] = $this->input->post('patient_gender');
			 $data['patient_age'] = $age;
			 $data['age_unit'] = $this->input->post('age_unit');
			 $data['state'] = $this->input->post('state');
			 $data['district'] = $this->input->post('district');
			 $data['tehsil'] = $this->input->post('tahsil');
			 $data['village'] = $this->input->post('village');
			 $data['address'] = $this->input->post('address');
			 $data['email_id'] = $this->input->post('email_id');
			 $data['contact_no'] = $this->input->post('contact_no');
			 $data['scheme'] = $this->input->post('scheme');
			 $schemetable = $this->input->post('scheme');
			 $data['son_or_wife'] = $this->input->post('son_or_wife');
			 $data['adhaar_card'] = $this->input->post('adhaar_card');
			 $data['patient_reg_from'] = 'REGISTRATION';
			 $data['mlc_case'] = $this->input->post('mlc_case');
			 $data['consultant'] =$consname;
			 $data['createdate'] = date('Y-m-d H:i:sa') ;
			 $data['reg_done_by'] = $userid ;
			 
			 //$data['casul_bed'] = $this->input->post('casul_bed') ;
		
			// $this->genrateUhid->insertDataUhid($data);
			
			if($data['scheme']==null)
			{
				$data['scheme']=1;
			}
			
			 $this->Crud_model->insert_record('patient',$data);
			 
			 if($this->input->post('mlc_case')=='No')
			 {
				 
				 $mlc_gen='General';
			 }
			 elseif($this->input->post('mlc_case')=='Yes')
			 { 
			     $mlc_gen='MLC';
				 
			 }
			 
			    $uhid = $this->GenrateID->getidMax('patient','id');
			 
			    $casu="Casualty";
				$data1['casu_uhid']  		 = $uhid;
				$data1['casu_fname']  		 = $this->input->post('first_name');
				$data1['casu_mname']  		 = $this->input->post('middle_name');
				$data1['casu_lname']  		 = $this->input->post('last_name');
				$data1['casu_age']  		 = $age;
				$data1['casu_gender'] 	 	 = $this->input->post('patient_gender');
				$data1['casu_bed'] 	 	 	 = $this->input->post('casul_bed');
				$data1['casu_addr']		 	 = $this->input->post('address');
				$data1['casu_pcase']		 = $mlc_gen;
				$data1['casu_mob']		 	 = $this->input->post('contact_no');;
 				$data1['casu_patient_type']  = $casu;
				$data1['casu_pushdt'] 		 = date('Y-m-d H:i:sa') ;
 				$data1['casu_entrydt']	     = date('Y-m-d H:i:sa') ;
				$data1['casu_consultent']  = $consID;
				$data1['casu_consultent_reg']  = $consID;
				$data1['casu_remark']  = $this->input->post('casu_remark');
				
				$data1['admited_by']  = $this->input->post('admited_by');
				$data1['relation_with_patient']  = $this->input->post('relation_with_patient');
				$data1['attender_contact']  = $this->input->post('attender_contact');
				$data1['casu_scheme']  = $schemetable;
			 
		    $this->Crud_model->insert_record('casualty',$data1);
				
				$casu_id = $this->GenrateID->getidMax('casualty','casu_id');
				
			    $cancer=$this->input->post('cancer');
				
			    if($cancer=='Yes'){
				      $cncr['cncr_status'] = 1;
				      $cncr['cncr_uhid']  	= $uhid;
				      $cncr['cncr_ipd_id'] 	= $casu_id;
				      $cncr['cncr_entrydt']	= date('Y-m-d H:i:sa') ;
				      $this->Crud_model->insert_record('cancer_patient',$cncr);
				}
				$data4['assessm_uhid']  	= $uhid;
				$data4['assessm_casuid'] 	= $casu_id;
				$data6['initial_uhid']  	= $uhid;
				$data6['initial_casu_id'] 	= $casu_id;
				$data5['pris_casu_id'] 		= $casu_id;
				$data5['pris_uhid']  		= $uhid;
				$data7['shift_ipdid'] 		= $casu_id;
				$data7['shift_uhid']  		= $uhid;
				$this->Crud_model->insert_record('casualty_assessment',$data4);
				$this->Crud_model->insert_record('casualty_shift',$data7);
				$this->Crud_model->insert_record('initial_assessment',$data6);
				$this->Crud_model->insert_record('casualty_pris',$data5);
			
			if($data['scheme']=='1')
			{
				
				//$abhijit=9479757800;
			 $datagen['id'] = $this->GenrateID->getid('gen_patient');
			 $datagen['uhid'] =$data['id'];
			 $datagen['admited_by'] = $this->input->post('admited_by');
			 $datagen['relation_with_patient'] = $this->input->post('relation_with_patient');
			 $datagen['attender_contact'] = $this->input->post('attender_contact');
			 $datagen['gen_pa_ipdid'] = $casu_id;
			 
			 $this->Crud_model->insert_record('gen_patient',$datagen);
			
			}
			else if($data['scheme']=='2')
			{
			 $databpl['id'] = $this->GenrateID->getid('bpl_patient');
			 $databpl['uhid'] =$data['id'];
			 $databpl['admited_by'] = $this->input->post('admited_by');
			 $databpl['relation_with_patient'] = $this->input->post('relation_with_patient');
			 $databpl['attender_contact'] = $this->input->post('attender_contact');
			 $databpl['patient_cat'] = $this->input->post('bplpatient_cat');
			 $databpl['employment'] = $this->input->post('bplemployment');
			 $databpl['income'] = $this->input->post('bplincome');
			 $databpl['card_no'] = $this->input->post('bplcard_no');
			 $databpl['cardholdername'] = $this->input->post('bplcardholdername');
			 $databpl['pincode'] = $this->input->post('bplpincode');
			 $databpl['disease_cat'] = $this->input->post('bpldisease_cat');
			 $databpl['dis_name'] = $this->input->post('bpldis_name');
			 $databpl['scheme_type'] = '2';
			 $databpl['bpl_admit_date'] = date('Y-m-d');
			 $databpl['bpl_reg_date'] =date('Y-m-d h-i-s') ;
			 $databpl['bpl_ipd_id'] =$casu_id;
			 $this->Crud_model->insert_record('bpl_patient',$databpl);
			
			}
			else if($data['scheme']=='3')
			{
			     $datampboc['id'] = $this->GenrateID->getid('bpl_patient');
			     $datampboc['uhid'] =$data['id'];
			     $datampboc['admited_by'] = $this->input->post('admited_by');
			     $datampboc['relation_with_patient'] = $this->input->post('relation_with_patient');
			     $datampboc['attender_contact'] = $this->input->post('attender_contact');
			     $datampboc['card_no'] = $this->input->post('mpboccard_no');
			     $datampboc['cardholdername'] = $this->input->post('mpboccardholdername');
			     $datampboc['disease_cat'] = $this->input->post('mpbocdisease_cat');
			     $datampboc['dis_name'] = $this->input->post('mpbocdis_name');
			     $datampboc['bpl_admit_date'] = date('Y-m-d');
			     $datampboc['scheme_type'] = '3';
				 $datampboc['bpl_reg_date'] =date('Y-m-d h-i-s') ;
				 $datampboc['bpl_ipd_id'] =$casu_id;
			       
				   $this->Crud_model->insert_record('bpl_patient',$datampboc);
			
			}
			else if($data['scheme']=='4' )
			{
			 $datacghs['id'] = $this->GenrateID->getid('cghs_patient');
			 $datacghs['uhid'] =$data['id'];
			 $datacghs['admited_by'] = $this->input->post('admited_by');
			 $datacghs['relation_with_patient'] = $this->input->post('relation_with_patient');
			 $datacghs['attender_contact'] = $this->input->post('attender_contact');
			 $datacghs['card_holder_name'] = $this->input->post('cghscard_holder_name');
			 $datacghs['card_no'] = $this->input->post('cghscard_no');
			 $datacghs['card_holder_relation'] = $this->input->post('cghscard_holder_relation');
			 $datacghs['case'] = $this->input->post('case');
			 $datacghs['entitilment'] = $this->input->post('entitilment');
			 $datacghs['validity'] = $this->input->post('validity');
			 $datacghs['cghs_opdipd'] = 'IPD';
			 $datacghs['scheme_type'] = $data['scheme'];
			 $datacghs['cghs_opdipd_id'] = $casu_id;
		     $this->Crud_model->insert_record('cghs_patient',$datacghs);
			}
			else if($data['scheme']=='5')
			{
			 $datacsma['id'] = $this->GenrateID->getid('cghs_patient');
			 $datacsma['uhid'] =$data['id'];
			 $datacsma['admited_by'] = $this->input->post('admited_by');
			 $datacsma['relation_with_patient'] = $this->input->post('relation_with_patient');
			 $datacsma['attender_contact'] = $this->input->post('attender_contact');
			 $datacsma['card_holder_name'] = $this->input->post('csmacard_holder_name');
			 $datacsma['card_no'] = $this->input->post('csmacard_no');
			 $datacsma['card_holder_relation'] = $this->input->post('csmacard_holder_relation');
			 $datacsma['case'] = $this->input->post('csmacase');
			 $datacsma['entitilment'] = $this->input->post('csmaentitilment');
			 $datacsma['cghs_opdipd'] = 'IPD';
			 $datacsma['scheme_type'] = $data['scheme'];
			 $datacsma['cghs_opdipd_id'] = $casu_id;
		
			
			 $this->Crud_model->insert_record('cghs_patient',$datacsma);
			}
			else if($data['scheme']=='6')
			{
			 $dataechs['id'] = $this->GenrateID->getid('cghs_patient');
			 $dataechs['uhid'] =$data['id'];
			 $dataechs['admited_by'] = $this->input->post('admited_by');
			 $dataechs['relation_with_patient'] = $this->input->post('relation_with_patient');
			 $dataechs['attender_contact'] = $this->input->post('attender_contact');
			 $dataechs['card_holder_name'] = $this->input->post('echscard_holder_name');
			 $dataechs['card_no'] = $this->input->post('echscard_no');
			 $dataechs['card_holder_relation'] = $this->input->post('echscard_holder_relation');
			 $dataechs['case'] = $this->input->post('echscase');
			 $dataechs['entitilment'] = $this->input->post('echsentitilment');
			 $dataechs['validity'] = $this->input->post('echsvalidity');
			 $dataechs['cghs_opdipd'] = 'IPD';
			 $dataechs['scheme_type'] = $data['scheme'];
			 $dataechs['cghs_opdipd_id'] = $casu_id;
			 $this->Crud_model->insert_record('cghs_patient',$dataechs);
			  
			}
			else if($data['scheme']=='7')
			{
			 $dataesi['id'] = $this->GenrateID->getid('cghs_patient');
			 $dataesi['uhid'] =$data['id'];
			 $dataesi['admited_by'] = $this->input->post('admited_by');
			 $dataesi['relation_with_patient'] = $this->input->post('relation_with_patient');
			 $dataesi['attender_contact'] = $this->input->post('attender_contact');
			 $dataesi['card_holder_name'] = $this->input->post('esicard_holder_name');
			 $dataesi['card_no'] = $this->input->post('esicard_no');
			 $dataesi['case'] = $this->input->post('esicase');
			 $dataesi['cghs_opdipd'] = 'IPD';
			 $dataesi['card_holder_relation'] = $this->input->post('esicard_holder_relation');
			 
			 $dataesi['scheme_type'] = $data['scheme'];
			 $dataesi['cghs_opdipd_id'] = $casu_id;
			
			$this->Crud_model->insert_record('cghs_patient',$dataesi);
			}
			else if($data['scheme']=='8')
			{
			 $databsnl['id'] = $this->GenrateID->getid('cghs_patient');
			 $databsnl['uhid'] =$data['id'];
			 $databsnl['admited_by'] = $this->input->post('admited_by');
			 $databsnl['relation_with_patient'] = $this->input->post('relation_with_patient');
			 $databsnl['attender_contact'] = $this->input->post('attender_contact');
			 $databsnl['card_holder_name'] = $this->input->post('bsnlcard_holder_name');
			 $databsnl['card_no'] = $this->input->post('bsnlcard_no');
			 $databsnl['card_holder_relation'] = $this->input->post('bsnlcard_holder_relation');
			 $databsnl['scheme_type'] = $data['scheme'];
			 $databsnl['cghs_opdipd'] = 'IPD';
			 $databsnl['cghs_opdipd_id'] = $casu_id;
			
			$this->Crud_model->insert_record('cghs_patient',$databsnl);
			}
			else if($data['scheme']=='9')
			{
			 $datamedi['id'] = $this->GenrateID->getid('cghs_patient');
			 $datamedi['uhid'] =$data['id'];
			 $datamedi['admited_by'] = $this->input->post('admited_by');
			 $datamedi['relation_with_patient'] = $this->input->post('relation_with_patient');
			 $datamedi['attender_contact'] = $this->input->post('attender_contact');
			 
			 $datamedi['scheme_type'] = $data['scheme'];
			 $datamedi['cghs_opdipd'] = 'IPD';
			 $datamedi['cghs_opdipd_id'] = $casu_id;
			 $datamedi['mediclaim_comp'] = $this->input->post('mediclaim_comp');
			
			 $this->Crud_model->insert_record('cghs_patient',$datamedi);
			 
			             // $depesh='9755544935';
					     // $mmessage="Name: ".$data['first_name']." ".$data['middle_name']." ".$data['last_name']." UHID: ".$data['id']."  REG.NO:".$casu_id." Admit Date : ".date('d-m-Y')." Company Name : ".$datamedi['mediclaim_comp'] ;
						 // $Curl_Session = curl_init('http://116.72.247.236/API/WebSMS/Http/v1.0a/index.php?');
                         // curl_setopt ($Curl_Session, CURLOPT_POST, 1);
                         // curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, "username=globaldnd&password=password&sender=METROH&to=$depesh&message=$mmessage&reqid=1&format={json|text}&route_id=113");
                         // curl_setopt ($Curl_Session, CURLOPT_FOLLOWLOCATION, 1);
                         // curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER,1);
                         // $result=curl_exec ($Curl_Session);
						 
						 
						 $depak='9575300104';
					     $Curl_Session = curl_init('http://login.heightsconsultancy.com/API/WebSMS/Http/v1.0a/index.php?');
                         curl_setopt ($Curl_Session, CURLOPT_POST, 1);
                         curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, "username=globaldnd&password=password&sender=METROH&to=$depak&message=$mmessage&reqid=1&format={json|text}&route_id=113");
                         curl_setopt ($Curl_Session, CURLOPT_FOLLOWLOCATION, 1);
                         curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER,1);
                         $result=curl_exec ($Curl_Session);
			 
			}
				else if($data['scheme']=='10')
			{
			 $databpl['id'] = $this->GenrateID->getid('bpl_patient');
			 $databpl['uhid'] =$data['id'];
			 $databpl['admited_by'] = $this->input->post('admited_by');
			 $databpl['relation_with_patient'] = $this->input->post('relation_with_patient');
			 $databpl['attender_contact'] = $this->input->post('attender_contact');
			 $databpl['patient_cat'] = $this->input->post('bplpatient_cat');
			 $databpl['employment'] = $this->input->post('bplemployment');
			 $databpl['income'] = $this->input->post('bplincome');
			 $databpl['card_no'] = $this->input->post('bplcard_no');
			 $databpl['cardholdername'] = $this->input->post('bplcardholdername');
			 $databpl['pincode'] = $this->input->post('bplpincode');
			 $databpl['disease_cat'] = $this->input->post('bpldisease_cat');
			 $databpl['dis_name'] = $this->input->post('bpldis_name');
			 $databpl['scheme_type'] = '10';
			 $databpl['bpl_admit_date'] = date('Y-m-d');
			 $databpl['bpl_reg_date'] =date('Y-m-d h-i-s') ;
			 $databpl['bpl_ipd_id'] =$casu_id;
			 $this->Crud_model->insert_record('bpl_patient',$databpl);
			
			}
			else if($data['scheme']=='11')
			{
			 $datagenbpl['id'] = $this->GenrateID->getid('bpl_patient');
			 $datagenbpl['uhid'] =$data['id'];
			 $datagenbpl['admited_by'] = $this->input->post('admited_by');
			 $datagenbpl['relation_with_patient'] = $this->input->post('relation_with_patient');
			 $datagenbpl['attender_contact'] = $this->input->post('attender_contact');
			 $datagenbpl['patient_cat'] = $this->input->post('bplpatient_cat');
			 $datagenbpl['employment'] = $this->input->post('bplemployment');
			 $datagenbpl['income'] = $this->input->post('bplincome');
			 $datagenbpl['card_no'] = $this->input->post('bplcard_no');
			 $datagenbpl['cardholdername'] = $this->input->post('bplcardholdername');
			 $datagenbpl['pincode'] = $this->input->post('bplpincode');
			 $datagenbpl['disease_cat'] = $this->input->post('bpldisease_cat');
			 $datagenbpl['dis_name'] = $this->input->post('bpldis_name');
			 $datagenbpl['scheme_type'] = '11';
			 $datagenbpl['bpl_admit_date'] = date('Y-m-d');
			 $datagenbpl['bpl_reg_date'] =date('Y-m-d h-i-s') ;
			 $datagenbpl['bpl_ipd_id'] =$casu_id;
			 $this->Crud_model->insert_record('bpl_patient',$datagenbpl);
			
			}
			$idd=$data['id'];
			
			if($consID==22 || $consID==21 || $consID==124 || $consID==125 )
			{
				
			         $datadoctor['result']= $this->Common_model->get_data_by_query("select * from doctor where  id=$consID");
				   
				     $docnumber1=$datadoctor['result'][0]['dr_contact'];
				     $docnumber2=$datadoctor['result'][0]['dr_contact2'];
				     $message="Name: ".$data['first_name']." ".$data['middle_name']." ".$data['last_name']."  REG.NO:".$casu_id."  is admitted under you";
					  
					    $Curl_Session = curl_init('http://login.heightsconsultancy.com/API/WebSMS/Http/v1.0a/index.php?');
                        curl_setopt ($Curl_Session, CURLOPT_POST, 1);
                        curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, "username=globaldnd&password=password&sender=METROH&to=$docnumber1&message=$message&reqid=1&format={json|text}&route_id=113");
                        curl_setopt ($Curl_Session, CURLOPT_FOLLOWLOCATION, 1);
                        curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER,1);
                        $result=curl_exec ($Curl_Session); 
						
						$Curl_Session = curl_init('http://login.heightsconsultancy.com/API/WebSMS/Http/v1.0a/index.php?');
                        curl_setopt ($Curl_Session, CURLOPT_POST, 1);
                        curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, "username=globaldnd&password=password&sender=METROH&to=$docnumber2&message=$message&reqid=1&format={json|text}&route_id=113");
                        curl_setopt ($Curl_Session, CURLOPT_FOLLOWLOCATION, 1);
                        curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER,1);
                         $result=curl_exec ($Curl_Session);
						 
						 $yatin='9669883333';
					
						 $yatinmessage="Name: ".$data['first_name']." ".$data['middle_name']." ".$data['last_name']."  REG.NO:".$casu_id."  is admitted under ".$consname;
						 
						 $Curl_Session = curl_init('http://login.heightsconsultancy.com/API/WebSMS/Http/v1.0a/index.php?');
                        curl_setopt ($Curl_Session, CURLOPT_POST, 1);
                        curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, "username=globaldnd&password=password&sender=METROH&to=$yatin&message=$yatinmessage&reqid=1&format={json|text}&route_id=113");
                        curl_setopt ($Curl_Session, CURLOPT_FOLLOWLOCATION, 1);
                        curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER,1);
                         $result=curl_exec ($Curl_Session);
						 
						 $devendr='9424744101';
					
						 $devendrmessage="Name: ".$data['first_name']." ".$data['middle_name']." ".$data['last_name']."  REG.NO:".$casu_id."  is admitted under ".$consname;
						 
						 $Curl_Session = curl_init('http://login.heightsconsultancy.com/API/WebSMS/Http/v1.0a/index.php?');
                        curl_setopt ($Curl_Session, CURLOPT_POST, 1);
                        curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, "username=globaldnd&password=password&sender=METROH&to=$devendr&message=$devendrmessage&reqid=1&format={json|text}&route_id=113");
                        curl_setopt ($Curl_Session, CURLOPT_FOLLOWLOCATION, 1);
                        curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER,1);
                         $result=curl_exec ($Curl_Session);
			}
			else
			{
				
				
				
				     $datadoctor['result']= $this->Common_model->get_data_by_query("select * from doctor where  id=$consID");
				   
				     $docnumber1=$datadoctor['result'][0]['dr_contact'];
				     $docnumber2=$datadoctor['result'][0]['dr_contact2'];
				     $message="Name: ".$data['first_name']." ".$data['middle_name']." ".$data['last_name']."  REG.NO:".$casu_id."  is admitted under you";
					  
					    $Curl_Session = curl_init('http://login.heightsconsultancy.com/API/WebSMS/Http/v1.0a/index.php?');
                        curl_setopt ($Curl_Session, CURLOPT_POST, 1);
                        curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, "username=globaldnd&password=password&sender=METROH&to=$docnumber1&message=$message&reqid=1&format={json|text}&route_id=113");
                        curl_setopt ($Curl_Session, CURLOPT_FOLLOWLOCATION, 1);
                        curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER,1);
                        $result=curl_exec ($Curl_Session); 
						
						$Curl_Session = curl_init('http://login.heightsconsultancy.com/API/WebSMS/Http/v1.0a/index.php?');
                        curl_setopt ($Curl_Session, CURLOPT_POST, 1);
                        curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, "username=globaldnd&password=password&sender=METROH&to=$docnumber2&message=$message&reqid=1&format={json|text}&route_id=113");
                        curl_setopt ($Curl_Session, CURLOPT_FOLLOWLOCATION, 1);
                        curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER,1);
                         $result=curl_exec ($Curl_Session);
				
				
				
				
			}
			
			$dataschemname['resultschme']= $this->Common_model->get_data_by_query("select scheme_name from scheme where  id=".$data['scheme']);
			if($data['scheme']=='4' or $data['scheme']=='5' or $data['scheme']=='6' or $data['scheme']=='7' or $data['scheme']=='8' or $data['scheme']=='9')
			{
				
						 				$abhijit='9479757800';
				
					
						 $abhijitmessage="Name: ".$data['first_name']." ".$data['middle_name']." ".$data['last_name']."  REG.NO:".$casu_id."  is admitted under ".$consname." Admit Date: ".date('Y-m-d h-i-s')." Scheme:".$dataschemname['resultschme'][0]['scheme_name'];
						 
						 $Curl_Session = curl_init('http://login.heightsconsultancy.com/API/WebSMS/Http/v1.0a/index.php?');
                        curl_setopt ($Curl_Session, CURLOPT_POST, 1);
                        curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, "username=globaldnd&password=password&sender=METROH&to=$abhijit&message=$abhijitmessage&reqid=1&format={json|text}&route_id=113");
                        curl_setopt ($Curl_Session, CURLOPT_FOLLOWLOCATION, 1);
                        curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER,1);
                         $result=curl_exec ($Curl_Session);
				
				
				
			}
			            
						
						$patcon=  $data['contact_no']  ;
						$patmessage="Dear attendant, ".$data['first_name']." ".$data['middle_name']." ".$data['last_name']." UHID:".$uhid." has been admitted in our hospital under ".$consname." Thanks for choosing MHCRC for the Services";
			            $Curl_Session = curl_init('http://login.heightsconsultancy.com/API/WebSMS/Http/v1.0a/index.php?');
                        curl_setopt ($Curl_Session, CURLOPT_POST, 1);
                        curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, "username=globaldnd&password=password&sender=METROH&to=$patcon&message=$patmessage&reqid=1&format={json|text}&route_id=113");
                        curl_setopt ($Curl_Session, CURLOPT_FOLLOWLOCATION, 1);
                        curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER,1);
                         $result=curl_exec ($Curl_Session);
						 
			
			
			$this->session->set_flashdata('message', 'Patient Registration is done Successfully UHID of Patienet is :'.$uhid.':reg No :'.$casu_id);
		     redirect('admin/FREG0006');
		
		}
	
	}
	

	public function barCode()
	{
	 
		
	        $this->template->set_template('user');
			$this->template->write_view('header', 'default/header',$this->session->userdata);
			$this->template->write_view('sidebar', 'default/sidebar');
            $this->template->write_view('content', 'admin/FREG0006/barCode');
			$this->template->write_view('footer', 'default/footer');
			$this->template->render();
	}
	
	public function smartcart()
	{
	        // $data['result'] = $this->Common_model->get_all_data('patient');
			// $data['result']= $this->Common_model->get_data_by_query("select * from patient order by createdate desc limit 100");
		
	        $this->template->set_template('user');
			$this->template->write_view('header', 'default/header',$this->session->userdata);
			$this->template->write_view('sidebar', 'default/sidebar');
            $this->template->write_view('content', 'admin/FREG0006/smartcart');
			$this->template->write_view('footer', 'default/footer');
			$this->template->render();
	}
	
	public function searchSmartPatient()
	{
	  // $first_name=$_GET['first_name'];
	  // $uhid=$_GET['uhid'];
	  // $contact_no=$_GET['contact_no'];
	  // $rfid=$_GET['rfid'];
	  
	
 	// if($rfid !='')
// {
// $rfid =$rfid.'@rfid';
// }

	// if($first_name !='')
// {
// $first_name =$first_name.'@first_name';
// }

	 	// if($uhid !='')
// {
// $uhid =$uhid.'@uhid';
// }
		// if($contact_no !='')
// {
// $contact_no =$contact_no.'@contact_no';
// }

// $serchitem = array($first_name,$uhid,$contact_no,$rfid);

// $querry='';
 // foreach ($serchitem as &$value) {

// if($value=='select')
// {
// }
// else if($value=='')
// {
// }
// else
// {
	
    // $value_aryy = explode ( "@", $value );
    // $data = $value_aryy [0];
    // $filed = $value_aryy [1];
	
	// if($filed=='first_name')
	// {
	  // $querry .= " and ".$filed." like "."'%".$data."%'";
	// }
 // else if($filed=='uhid')
	// {
	  // $querry .= " and id='$data'";
	// }
// else if($filed=='contact_no')
	// {
	  // $querry .= " and contact_no='$data'";
	// }
   // else	if($filed=='rfid')
	// {
	  // $querry .= " and rfid='$data'";
	  
	// }
	
// }

  
// }

 $first_name=$_GET['first_name'];
	  $uhid=$_GET['uhid'];
	  $contact_no=$_GET['contact_no'];
	 $rfid=$_GET['rfid'];
	  
	  
	if($first_name !='')
{
$first_name =$first_name.'@first_name';
}

	 	if($uhid !='')
{
$uhid =$uhid.'@uhid';
}
		 	if($contact_no !='')
{
$contact_no =$contact_no.'@contact_no';
}

if($rfid !='')
{
$rfid =$rfid.'@rfid';
}



$serchitem = array($first_name,$uhid,$contact_no,$rfid);

$querry='';
 foreach ($serchitem as &$value) {

if($value=='select')
{
}
else if($value=='')
{
}
else
{

   $value_aryy = explode ( "@", $value );
    $data = $value_aryy [0];
    $filed = $value_aryy [1];
	
	if($filed=='first_name')
	{
	  $querry .= " and ".$filed." like "."'%".$data."%'";
	}
 else if($filed=='uhid')
	{
	  $querry .= " and id='$data'";
	}
else if($filed=='contact_no')
	{
	  $querry .= " and contact_no='$data'";
	}
	
	else if($filed=='rfid')
	{
	  $querry .= " and rfid='$data'";
	}
	
	
}

  
}


?>

     <tr role="row">
                                <td>UHID</th>
                                <td>Patient Name</td>
								<td>Father/husband Name</td>
                                <!--<td >Age</td>-->
                          
                                <!--<th class="sorting" role="columnheader" tabindex="0" aria-controls="sample_editable_1" rowspan="1" colspan="1" aria-label="Delete: activate to sort column ascending" style="width: 127px;">Gender</th>-->
                                <td>Contact</td>
                                <td>Card Status</td>
                                <td>Action</td>
                                <td></td>
                              </tr>
<?php
	   $aa =$this->Common_model->get_data_by_query("select * from patient where id>0  $querry order by id desc limit 100 ");
	   
      //print_r($data['result']);
	  	   foreach ($aa as $key=>$ft)
                               {
           ?>
       				
							   <tr class="odd">
                                <td class=" sorting_1"><?php echo $ft['id'];?></td>
                                <td class=" "><?php echo $ft['first_name']." ".$ft['middle_name']." ".$ft['last_name']; ?></td>
                                <td class=" "><?php echo $ft['fa_hus_name'];?></td>
                                <!--<td class=" "><?php echo $ft['patient_age'];?>  <?php echo $ft['age_unit'];?></td>-->
                                <td class=" "><?php echo $ft['contact_no'];?></td>
                                <td class=" "><?php if($ft['rfid']=='') { ?><span class='text-success' ><label>Not Generated</label></span>
								<?php } else{ ?><span><label>Generated</label></span><?php }?>
								<!---style='color:purple;font-style: italic'---->
								</td>
                        
                                <td class="">
								<a  href="javascript:void(0); #portlet-config" data-toggle="modal" class="config" onclick="genrateBarcode('<?php echo $ft['id'] ;?>')" >
								  <button type="button" class="btn mini" style='background-color:#44DED8' value='1' >
									Scan  Card
								 </button> 
								</a>
								</td>
                                <td class="">
								<a class="" href="javascript:printDiv('<?php echo $ft['id'];?>')" title="Delete Record"> 
								
								   <button type="button" class="btn mini" style='background-color:#44DED8;' value='1' >
									Print  Card
									</button> 
								</a>
								</td>
                              </tr>
                             <?php   }  
	
	
	}
	
	public function searchPatient()
	{
	  $first_name=$_GET['first_name'];
	  $uhid=$_GET['uhid'];
	  $contact_no=$_GET['contact_no'];
	
	  
	  
	if($first_name !='')
{
$first_name =$first_name.'@first_name';
}

	 	if($uhid !='')
{
$uhid =$uhid.'@uhid';
}
		 	if($contact_no !='')
{
$contact_no =$contact_no.'@contact_no';
}


$serchitem = array($first_name,$uhid,$contact_no);

$querry='';
 foreach ($serchitem as &$value) {

if($value=='select')
{
}
else if($value=='')
{
}
else
{

   $value_aryy = explode ( "@", $value );
    $data = $value_aryy [0];
    $filed = $value_aryy [1];
	
	if($filed=='first_name')
	{
	  $querry .= " and ".$filed." like "."'%".$data."%'";
	}
 else if($filed=='uhid')
	{
	  $querry .= " and id='$data'";
	}
else if($filed=='contact_no')
	{
	  $querry .= " and contact_no='$data'";
	}
	
}

  
}

	   $aa =$this->Common_model->get_data_by_query("select * from patient where id>0  $querry order by id desc limit 100");
	   
      //print_r($data['result']);
	  ?>
	    <tr role="row">
                                <td >UHID</td>
                                <td>Patient Name</td>
								<td>Father/husband Name</td>
                                <td>Age</td>
                                <td >Contact</td>
                                <td>Action</td>
                              </tr>
               
	  <?php
	  	   foreach ($aa as $key=>$ft)
                               {
           ?>
       						  <tr class="odd">
                                <td class=" sorting_1"><?php echo $ft['id'];?></td>
                                <td class=" "><?php echo $ft['first_name']." ".$ft['middle_name']." ".$ft['last_name']; ?></td>
                                <td class=" "><?php echo $ft['fa_hus_name'];?></td>
                                <td class=" "><?php echo $ft['patient_age'];?> <?php echo $ft['age_unit'];?></td>
                      
                                <td class=" "><?php echo $ft['contact_no'];?></td>
                              
                               <td class=""><a  href="javascript:void(0); #portlet-config" data-toggle="modal" class="config" onclick="genrateBarcode('<?php echo $ft['id'] ;?>')" ><i class="icon-barcode"></i></a></td>
                                
                              </tr>
                             <?php   }  
	
	
	}
	
	function patientInfo()
	{
			$data['counterPat']=$this->Common_model->get_data_by_query("select * from  casualty c 
              left join patient	 pa on pa.id=c.casu_uhid
              left join scheme	 s on s.id=pa.scheme
              
			  order by casu_id desc limit 100");				
				
		    $this->template->set_template('user');
			$this->template->write_view('header', 'default/header',$this->session->userdata);
			$this->template->write_view('sidebar', 'default/sidebar');
            $this->template->write_view('content', 'admin/FREG0006/patientInfo',$data);
			$this->template->write_view('footer', 'default/footer');
			$this->template->render();
		
	}
	
	
	
	function getBarcode()
	{
	    
		$uhid = $_GET['uhid'];
        //$IMG =$this->set_barcode($uhid);
	echo "<img src='http://192.168.1.241/metro_log/index.php/admin/FREG0006/getBarcode2/$uhid'>" ;
	echo "<img src='http://192.168.1.241/metro_log/index.php/admin/FREG0006/getBarcode2/$uhid'>" ;
	echo "<img src='http://192.168.1.241/metro_log/index.php/admin/FREG0006/getBarcode2/$uhid'>" ;
	echo "<img src='http://192.168.1.241/metro_log/index.php/admin/FREG0006/getBarcode2/$uhid'>" ;
	echo "<img src='http://192.168.1.241/metro_log/index.php/admin/FREG0006/getBarcode2/$uhid'>" ;
	echo "<img src='http://192.168.1.241/metro_log/index.php/admin/FREG0006/getBarcode2/$uhid'>" ;
	echo "<img src='http://192.168.1.241/metro_log/index.php/admin/FREG0006/getBarcode2/$uhid'>" ;
	echo "<img src='http://192.168.1.241/metro_log/index.php/admin/FREG0006/getBarcode2/$uhid'>" ;
	echo "<img src='http://192.168.1.241/metro_log/index.php/admin/FREG0006/getBarcode2/$uhid'>" ;
	echo "<img src='http://192.168.1.241/metro_log/index.php/admin/FREG0006/getBarcode2/$uhid'>" ;
	echo "<img src='http://192.168.1.241/metro_log/index.php/admin/FREG0006/getBarcode2/$uhid'>" ;
	echo "<img src='http://192.168.1.241/metro_log/index.php/admin/FREG0006/getBarcode2/$uhid'>" ;
	echo "<img src='http://192.168.1.241/metro_log/index.php/admin/FREG0006/getBarcode2/$uhid'>" ;
	echo "<img src='http://192.168.1.241/metro_log/index.php/admin/FREG0006/getBarcode2/$uhid'>" ;
	
	

		
	}
	
	function getBarcode2()
	{
	    
		$uhid = $this->uri->segment(4);
        $IMG =$this->set_barcode($uhid);


		
	}
	
	private function set_barcode($code)
    {
        //load library
       
        //generate barcode
		
        //Zend_Barcode::render('code128', 'image', array('text'=>$code), array('20'));
		
		$barcodeOptions = array(
    'text' => $code, 
    'barHeight'=> 20, 
    'factor'=>3.98,
);


$rendererOptions = array();
$renderer = Zend_Barcode::factory('code128', 'image', $barcodeOptions, $rendererOptions)->render();
		
    }
	
	function getSmartcard()
	{
	       $uhid = $_GET['uhid'];
		   
		   ?>

		   <input type='hidden' id='uhid' value='<?php echo $uhid ; ?>'>
		   <h6>UHID:&nbsp;<?php echo $uhid; ?> </h6>
		   <div id='gif'>
		   <img src='<?php echo base_url().'../assets/img/rfidAnimated.gif'; ?>'>
		   </div>
		   <div class="form-actions">
													<button type="submit" onclick='saveRFID()' name='assessment_details' value='assessment_details' class="btn blue"><i class="icon-ok"></i> Save</button>
													<button type="button" class="btn">Cancel</button>
			</div>
		   <?php
	
	}
	
	function setSmartcardValue()
	{
	 ?>
		RFID Card Scanned Successfully for saving this card press save button.. <span id='rfid'><?php echo $uhid = $_GET['rfid'];  ?></span>
  <?php
	
	}
	
	public function saveRfid()	
	{
	
	  
	$uhid = $_GET['uhid'];
	$data['rfid'] = $_GET['rfid'];
	$rfid=$data['rfid'];
	$data['smart_pin'] = rand(1000, 9999);
	$query= $this->db->query("SELECT * FROM patient WHERE rfid='$rfid'" );
     
     if ($query->num_rows() == 0)
     
	 {
	
	 $this->Crud_model->edit_record('patient',$uhid,$data);
	 echo "Card Saved Successfully Please Note  Smart Card PIN  : <font color='red'>".$data['smart_pin']."</font>";
	 
	 }
	  else
	  {
		 echo "card already exist";
		
		   ?>
         
		 <input type="button" value="Try Again" class="btn blue mini" onclick="genrateBarcodeRetry('<?php echo $uhid;?>')"/>
		 
		
		 <?php 
		 
	  }
	  ?>
	
	 
	 <?php
	 
	
	 
	}
	  
	public function uhidsearch()
	{
	  
	 $this->template->set_template('user');
			$this->template->write_view('header', 'default/header',$this->session->userdata);
			$this->template->write_view('sidebar', 'default/sidebar');
            $this->template->write_view('content', 'admin/FREG0006/uhidsearch');
			$this->template->write_view('footer', 'default/footer');
			$this->template->render();
	 }
	
	public function searchuhid()
	{
	  $first_name=$_GET['first_name'];
	   $uhid=$_GET['uhid'];
	   $contact_no=$_GET['contact_no'];
	   $fa_hus_name=$_GET['fa_hus_name'];
	   $rfid=$_GET['rfid'];
	  

		  
	if($first_name !='')
{
$first_name =$first_name.'@first_name';
}

	 	if($uhid !='')
{
$uhid =$uhid.'@id';
}
		 	if($contact_no !='')
{
$contact_no =$contact_no.'@contact_no';
}
if($fa_hus_name !='')
{
$fa_hus_name =$fa_hus_name.'@fa_hus_name';
}
if($rfid !='')
{
$rfid =$rfid.'@rfid';
}
$serchitem = array($first_name,$uhid,$contact_no,$fa_hus_name,$rfid);

$querry='';
 foreach ($serchitem as &$value) {

if($value=='select')
{
}
else if($value=='')
{
}
else
{

    $value_aryy = explode ( "@", $value );
    $data = $value_aryy [0];
    $filed = $value_aryy [1];
	
	if($filed=='first_name')
	{
	  $querry .= " and a.".$filed." like "."'%".$data."%'";
	}
    else if($filed=='id')
	{
	  $querry .= " and a.id='$data'";
	}
    else if($filed=='contact_no')
	{
	  $querry .= " and a.contact_no='$data'";
	}
	else if($filed=='fa_hus_name')
	{
	 $querry .= " and a.".$filed." like "."'%".$data."%'";
	}
	else if($filed=='rfid')
	{
	  $querry .= " and a.rfid='$data'";
	}
}

  
}  
// echo $querry;
// die();


$aaa=$this->Common_model->get_data_by_query("select a.id ,a.first_name ,c.casu_id, a.middle_name,a.last_name,a.fa_hus_name,s.scheme_name ,a.contact_no from  casualty c 
              left join patient	 a on a.id=c.casu_uhid
              left join scheme	 s on s.id=a.scheme  where 0=0 $querry  order by c.casu_id desc limit 50");	
			  
			
	  
	          ?>
			              
                              <tr>
                                <td>UHID</td>
                                <td>Reg no</td>
                                <td>Patient Name</td>
								<td>Father/husband Name</td>
                                <td>Scheme</td>
                                <td>Contact</td>
                                <td>Action</td>
                              </tr>
			  <?php
	  	   foreach ($aaa as $key=>$ft)
                               {
                                
							?>
       						  <tr class="odd">
                                <td class=" sorting_1"><?php echo $ft['id'];?></td>
                                <td class=" sorting_1"><?php echo $ft['casu_id'];?></td>
                                <td class=" "><?php echo $ft['first_name']." ".$ft['middle_name']." ".$ft['last_name']; ?></td>
                                <td class=" "><?php echo $ft['fa_hus_name']; ?></td>
 
                                <td class=" "><?php $this->Common_model->getSchemeName($ft['casu_id'],$ft['id'],"IPD"); ?></td>
								
                                <td class=" "><?php echo $ft['contact_no'];?></td>
                              
                                <td class=""><a href="<?php echo base_url('admin/FREG0006/updateReg/'.$ft['id'].'/'.$ft['casu_id']); ?>" >  <button type="button" class="btn blue" onclick='' >Update</button></a></td>
                               
                              </tr>
                             <?php   }  
	
	}
	
	
	public function searchuhid_regP()
	{
		$first_name=$_GET['first_name'];
		$uhid=$_GET['uhid'];
		$contact_no=$_GET['contact_no'];
		$fa_hus_name=$_GET['fa_hus_name'];
		$rfid=$_GET['rfid'];
		$regno=$_GET['regno'];
		$date='';
		$startdate=date('Y-m-d',strtotime($_GET['startdate']));
		$enddate=date('Y-m-d',strtotime($_GET['enddate']));
        $page=$_GET['page'];
        $scheme=$_GET['scheme'];
		  
	if($first_name !='')
{
$first_name =$first_name.'@first_name';
}

	 	if($uhid !='')
{
$uhid =$uhid.'@id';
}
		if($contact_no !='')
{
$contact_no =$contact_no.'@contact_no';
}
if($fa_hus_name !='')
{
$fa_hus_name =$fa_hus_name.'@fa_hus_name';
}
if($rfid !='')
{
$rfid =$rfid.'@rfid';
}
if($regno !='')
{
$regno =$regno.'@casu_id';
}if($scheme !='')
{
$scheme =$scheme.'@casu_scheme';
}
if($startdate !='1970-01-01' and $enddate !='1970-01-01')
{
$date =$startdate.'^'.$enddate.'@'.'casu_entrydt';
}
$serchitem = array($first_name,$uhid,$contact_no,$fa_hus_name,$rfid,$regno,$date,$scheme);

$querry='';
 foreach ($serchitem as &$value) {

if($value=='select')
{
}
else if($value=='')
{
}
else
{

    $value_aryy = explode ( "@", $value );
    $data = $value_aryy [0];
    $filed = $value_aryy [1];
	
	if($filed=='first_name')
	{
	  // $querry .= " and pa.".$filed." like "."'%".$data."%'";
	  
	  $querry .= " and ( pa.".$filed." like "."'%".$data."%' or pa.middle_name like '%$data%'  or pa.last_name like '%$data%' )";
	}
    else if($filed=='id')
	{
	  $querry .= " and pa.id=$data";
	}
    else if($filed=='contact_no')
	{
	  $querry .= " and pa.contact_no='$data'";
	}
	else if($filed=='fa_hus_name')
	{
	 $querry .= " and pa.".$filed." like "."'%".$data."%'";
	}
	else if($filed=='rfid')
	{
	  $querry .= " and pa.rfid='$data'";
	}
	else if($filed=='casu_id')
	{
	  $querry .= " and c.casu_id='$data'";
	}
	else if($filed=='casu_scheme')
	{
	  $querry .= " and c.casu_scheme='$data'";
	}
	else if($filed=='casu_entrydt')
	{
		$datas = explode ( "^", $data );
		$sdata = $datas[0];
		$esdata = $datas [1];
		
		$querry .= " and DATE_FORMAT(c.casu_entrydt,'%Y-%m-%d') between '$sdata' and '$esdata'";

	}
}

  
}  
// echo $querry ;
// die() ;

	   // $aaa =$this->Common_model->get_data_by_query("select a.*,b.scheme_name from patient a ,scheme b where a.id>0 and a.scheme=b.id $querry order by createdate desc limit 500 ");
	   
	   if($querry=='')
	   {
		     $aaa=$this->Common_model->get_data_by_query("select * from  casualty c 
              left join patient	 pa on pa.id=c.casu_uhid
              left join scheme	 s on s.id=pa.scheme where 0=0 $querry order by c.casu_id desc limit 100");
		   
	   }
	   else
	   {
		   $aaa=$this->Common_model->get_data_by_query("select * from  casualty c 
              left join patient	 pa on pa.id=c.casu_uhid
              left join scheme	 s on s.id=pa.scheme where 0=0 $querry order by c.casu_id desc");
		   
	   }
         
			  
			  // $data['counterPat']=$this->Common_model->get_data_by_query("select * from  casualty c 
              // left join patient	 pa on pa.id=c.casu_uhid
              // left join scheme	 s on s.id=pa.scheme
              
			  // order by casu_id desc limit 100");
			  
			  	// $data['counterPat']=$this->Common_model->get_data_by_query("select * from  casualty c 
              // left join patient	 pa on pa.id=c.casu_uhid
              // left join scheme	 s on s.id=pa.scheme
              
			  // order by casu_id desc limit 100");	
			  
			  $count2=0;
			    foreach ($aaa as $key=>$ft2)
                               {
								   $count2++;
							   }
			  
	
	  
	          ?>
			   <div id='print'>
		<a href='javascript:void(0);' onclick='prints();' class="btn purple big" style='background-color: #204988;'>Total IPD :<?php echo $count2 ;?> <i class="m-icon-big-swapright m-icon-white"></i></a>
		<br>
		<br>
			  
			  		<table cellpadding="4" cellspacing="0" width="100%" border="0" class="table table-bordered table-hover lightfont">
			              
                              <tr>
                                <td>S.no</td>
                                <td>UHID</td>
								<td>Reg-no</td>
                                <td>Patient Name</td>
								<td>Father/husband Name</td>
                                <td>Scheme</td>
                                <td>Contact</td>
                                <td>Reg Date</td>
                                <td>Action</td>
                              </tr>
			  <?php
			  $count=1;
	  	   foreach ($aaa as $key=>$ft)
                               {
                                
							?>
       						  <tr class="odd">
                                <td class=" sorting_1"><?php echo $count;?></td>
                                <td class=" sorting_1"><?php echo $ft['casu_uhid'];?></td>
								<td><?php echo $ft['casu_id'] ;?></td>
                                <td class=" " width='10px'><?php echo $ft['first_name']." ".$ft['middle_name']." ".$ft['last_name']; ?></td>
                                <td class=" "><?php echo $ft['fa_hus_name'];?></td>
 
                                <td class=" "><?php $this->Common_model->getSchemeName($ft['casu_id'],$ft['id'],"IPD"); ?></td>
								
                                <td class=" "><?php echo $ft['contact_no'];?></td>
                                <td class=" "><?php echo date('d-m-Y',strtotime($ft['casu_entrydt'])) ; ;?></td>
                              
                                <td class="">
								
								<?php if( $page=='reg') { ?>
								<a class="" href="<?php echo base_url('admin/FREG0006/regslip').'/'.$ft['casu_uhid'].'/'.$ft['casu_id'] ?>"> 
							<input type="button" id="vi" name="vi" title="Advice Test" class="btn mini blue" value="Print Slip">
								</a><?php } else{ ?>
								<a href="#portlet-config" data-toggle="modal" class="config">
								    <button type="button" class="btn mini" style="background-color:#44DED8" onclick="getpatientdata(<?php echo $ft['casu_uhid'];?>,<?php echo $ft['casu_id'];?>)" value="1" id="bt">
									View
									</button> 
								</a>
								
								<?php }?>
								</td>
                               
                              </tr>
                             <?php 
$count++;
							 }  
							 
							 ?>
							 
							 
					</table>
					</div>
							 <?php
		
	}
	
	
	public function updateReg()
	{      
	       $data['message'] = $this->session->flashdata('message');
	
	       $uhid = $this->uri->segment(4);
	       $ipdid = $this->uri->segment(5);
		   
	       $data['state'] =$this->Address->state();
		   $data['district'] =$this->Address->district('24');
		   $data['scheme'] =$this->Address->scheme();
		   
		   
		  
		   
		   //$data['doc_name'] =$this->doctor->getOPDDoctor();   
			$data['bpldisease'] = $this->Common_model->get_data_by_query('select DISTINCT  Disease_catigory from bpldisease ');
			  
			$data['result'] = $this->Common_model->get_data_by_query(" SELECT sc.scheme_name ,s.state_name,v.vill_name,t.tahsil,d.district,b.* FROM `patient` b  
			left join state s on s.state_id= b.state
			left join districmp d on d.id= b.district
			left join tahsil t on t.id= b.tehsil
			left join villmp v on v.id= b.village
			left join scheme sc on sc.id= b.scheme
			where b.id=$uhid ");
			
            $data['mediclam_company'] =$this->Common_model->get_data_by_query('select * from mediclam_company where medi_c_status=1');
			
            $data['doc_name'] =$this->Common_model->get_data_by_query("select * from doctor where id not in ('5','81') order by doc_name ");

            $data1['re'] = $this->Common_model->get_data_by_query("select district,tehsil from patient where id = '$uhid'");

            $sch= $data['result'][0]['scheme'];
		   
		   if($sch==1)
		   {
	   $data['schmedata'] = $this->Common_model->get_data_by_query("select * from gen_patient where uhid=$uhid  order by id desc limit 1  "); 
		   }
		   elseif($sch==2 || $sch==3 || $sch==10 || $sch==11 || $sch==12 || $sch==13 )
		   {
	   $data['schmedata'] = $this->Common_model->get_data_by_query("select * from bpl_patient where uhid=$uhid order by id desc limit 1 ");  
		   }
		
		   elseif($sch==4 || $sch==5 || $sch==6 || $sch==7 || $sch==8 || $sch==9)
		   {
	   $data['schmedata'] = $this->Common_model->get_data_by_query("select * from cghs_patient where uhid=$uhid order by id desc limit 1");  
		   }
		   
		   foreach ($data1['re'] as $key=>$ft)
                               {
								   
							     $did= $ft['district'];
							     $tid= $ft['tehsil'];
								 $data['tehsilee']=$this->Common_model->get_data_by_query("select * from tahsil where district_id = '$did'");
								 $data['villll']=$this->Common_model->get_data_by_query("select * from villmp where tehsil_id = '$tid'");
							   
							   }        
			$data['casudata'] = $this->Common_model->get_data_by_query("select * from casualty where casu_id=$ipdid order by casu_id desc limit 1");				   
				 // $data['casualtydata'] = $this->Common_model->get_data_by_query("select * from  casualty where casu_id=$ipdid");			   
	        $this->template->set_template('user');
			$this->template->write_view('header', 'default/header',$this->session->userdata);
			$this->template->write_view('sidebar', 'default/sidebar');
            $this->template->write_view('content', 'admin/FREG0006/updateReg',$data);
			$this->template->write_view('footer', 'default/footer');
			$this->template->render();
	 }
	 	 
	public function UpdateRegistration()
	{
	      
		if($this->input->post('preg')){
			
		     $uhid = $this->input->post('uid');
		     $ipdid= $this->input->post('ipdid');
			 

	         $data['first_name'] = $this->input->post('first_name');
			 $data['middle_name'] = $this->input->post('middle_name');
			 $data['last_name'] = $this->input->post('last_name');
			 $data['fa_hus_name'] = $this->input->post('fa_hus_name');
			 $data['patient_gender'] = $this->input->post('patient_gender');
			 $data['patient_age'] = $this->input->post('patient_age');
			 $data['age_unit'] = $this->input->post('age_unit');
			 $data['state'] = $this->input->post('state');
			 $data['district'] = $this->input->post('district');
			 $data['tehsil'] = $this->input->post('tahsil');
			 $data['village'] = $this->input->post('village');
			 $data['address'] = $this->input->post('address');
			 $data['email_id'] = $this->input->post('email_id');
			 $data['contact_no'] = $this->input->post('contact_no');
			 $data['reg_admited_by'] = $this->input->post('reg_admited_by');
			 
			 $data['reg_relation_with_patient'] = $this->input->post('reg_relation_with_patient');
			 $data['reg_attender_contact'] = $this->input->post('reg_attender_contact');
			 $data['mlc_case'] = $this->input->post('mlc_case');
			 $data['consultant'] = $this->input->post('consultant');
			 
			 $data['son_or_wife'] = $this->input->post('son_or_wife');
			 
			
			 
			 $datapat['all']=$this->Common_model->get_data_by_query("select casu_scheme from casualty where casu_id = '$ipdid'");
			 
			 $oldsch=$datapat['all'][0]['casu_scheme'] ;
			 
			 $data['scheme'] = $this->input->post('scheme');
			 $newschme = $this->input->post('scheme');
			 $this->Crud_model->edit_record('patient',$uhid,$data);
			 
			 
			 $datacasultay['relation_with_patient'] = $this->input->post('reg_relation_with_patient');
			 $datacasultay['attender_contact'] = $this->input->post('reg_attender_contact');
			 $datacasultay['casu_pcase'] = $this->input->post('mlc_case');
			 $datacasultay['casu_consultent'] = $this->input->post('consultant');
			 $datacasultay['casu_consultent_reg'] = $this->input->post('consultant');
			 $datacasultay['casu_scheme'] = $newschme;
			 $datacasultay['casu_remark'] = $this->input->post('casu_remark');
			 $datacasultay['admited_by'] = $this->input->post('reg_admited_by');
			
             $sc_old_sch_tab_id =$oldsch	;
			
		  

            
			 
			 $this->Crud_model->edit_record_by_any_id('casualty','casu_id',$ipdid,$datacasultay);		  
		   
		  $oldsch;
		  $newschme;
		  $uhid;
		  $ipdid;
		  
		  
		  if($newschme=='2' or $newschme=='3' or $newschme=='10' or $newschme=='11' or $newschme=='12'or $newschme=='13'  )
			{
				$statusrow=$this->Common_model->rowinBPL($uhid,$ipdid);
				
				 if($statusrow=='no')
				 {
					 
					         $datab['id'] = $this->GenrateID->getid('bpl_patient');
					   $datab['uhid'] =$uhid ;
					   $datab['bpl_ipd_id'] =$ipdid ;
					   $datab['scheme_type'] =$newschme ;
					   $this->Crud_model->insert_record('bpl_patient',$datab); 

			          $sc_new_sch_tab_id = $this->GenrateID->getidMax('bpl_patient','id');
					  $dataschme['sc_uhid']= $uhid ;
					  $dataschme['sc_ipd_opd_id']= $ipdid;
					  $dataschme['sc_ipd_opd']= 'IPD';
					  $dataschme['sc_old_scheme']= $oldsch;
					  $dataschme['sc_new_scheme']= $newschme;
					  $dataschme['sc_date']= date('Y-m-d');
					  $dataschme['sc_old_sch_tab_id']= $sc_old_sch_tab_id;
					  $dataschme['sc_new_sch_tab_id']= $sc_new_sch_tab_id;
					   // $this->Crud_model->insert_record('scheme_changed',$dataschme); 
					 
					 
					 
				 }
				 
				
			}
			
			 if($newschme=='4' or $newschme=='5' or $newschme=='6' or $newschme=='7' or $newschme=='8' or $newschme=='9')
			{
				$statusrow=$this->Common_model->rowinCGHS($uhid,$ipdid);
				
				 if($statusrow=='no')
				 {
					 
					   $datab['id'] = $this->GenrateID->getid('cghs_patient');
					   $datab['uhid'] =$uhid ;
					   $datab['cghs_opdipd_id'] =$ipdid ;
					   $datab['cghs_opdipd'] ='IPD' ;
					   $datab['scheme_type'] =$newschme ;
					   $this->Crud_model->insert_record('cghs_patient',$datab);

                      $sc_new_sch_tab_id = $this->GenrateID->getidMax('cghs_patient','id');
					  $dataschme['sc_uhid']= $uhid ;
					  $dataschme['sc_ipd_opd_id']= $ipdid;
					  $dataschme['sc_ipd_opd']= 'IPD';
					  $dataschme['sc_old_scheme']= $oldsch;
					  $dataschme['sc_new_scheme']= $newschme;
					  $dataschme['sc_date']= date('Y-m-d');
					  $dataschme['sc_old_sch_tab_id']= $sc_old_sch_tab_id;
					  $dataschme['sc_new_sch_tab_id']= $sc_new_sch_tab_id;
					   // $this->Crud_model->insert_record('scheme_changed',$dataschme); 	
					 
					
					 
					 
				 }
				 
				
			}
			
			if($newschme=='4' or $newschme=='5' or $newschme=='6' or $newschme=='7' or $newschme=='8' or $newschme=='9')
			{
				
				            if($newschme=='4')
					       {
						        $schmename='CGHS' ;
					       }if($newschme=='5')
					       {
						        $schmename='CSMA' ;
					       }if($newschme=='6')
					       {
						        $schmename='ECHS' ;
					       }if($newschme=='7')
					       {
						        $schmename='ESI' ;
					       }if($newschme=='8')
					       {
						        $schmename='BSNL' ;
					       }if($newschme=='9')
					       {
						        $schmename='MEDICLAIM' ;
					       }
				     
				
				         $datpat['patdata'] = $this->Common_model->get_data_by_query("select * from patient where id=$uhid");  
				         $name=$datpat['patdata'][0]['first_name'].' '.$datpat['patdata'][0]['middle_name'].' '.$datpat['patdata'][0]['last_name'] ;
				         $createdate=$datpat['patdata'][0]['createdate'] ;
						 
					     // $depesh='9755544935';
	                     // $mmessage="Name: ".$name." UHID: ".$uhid."  REG.NO:".$ipdid." Admit Date : ".date('d-m-Y',strtotime($createdate))." Company Name : ".$datab['mediclaim_comp']." Scheme Name :".$schmename ;
						 // $Curl_Session = curl_init('http://116.72.247.236/API/WebSMS/Http/v1.0a/index.php?');
                         // curl_setopt ($Curl_Session, CURLOPT_POST, 1);
                         // curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, "username=globaldnd&password=password&sender=METROH&to=$depesh&message=$mmessage&reqid=1&format={json|text}&route_id=113");
                         // curl_setopt ($Curl_Session, CURLOPT_FOLLOWLOCATION, 1);
                         // curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER,1);
                         // $result=curl_exec ($Curl_Session);
						 
						 $depak='9575300104';
						 $Curl_Session = curl_init('http://login.heightsconsultancy.com/API/WebSMS/Http/v1.0a/index.php?');
                         curl_setopt ($Curl_Session, CURLOPT_POST, 1);
                         curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, "username=globaldnd&password=password&sender=METROH&to=$depak&message=$mmessage&reqid=1&format={json|text}&route_id=113");
                         curl_setopt ($Curl_Session, CURLOPT_FOLLOWLOCATION, 1);
                         curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER,1);
                         $result=curl_exec ($Curl_Session);
						 
						 $roy='9479757800';
						 $Curl_Session = curl_init('http://login.heightsconsultancy.com/API/WebSMS/Http/v1.0a/index.php?');
                         curl_setopt ($Curl_Session, CURLOPT_POST, 1);
                         curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, "username=globaldnd&password=password&sender=METROH&to=$roy&message=$mmessage&reqid=1&format={json|text}&route_id=113");
                         curl_setopt ($Curl_Session, CURLOPT_FOLLOWLOCATION, 1);
                         curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER,1);
                         $result=curl_exec ($Curl_Session);
			}
		  
		  

		   $this->session->set_flashdata('message', 'Patient Registration Updated Successfully UHID of Patient is :'.$uhid);
		   //die();
		
			 redirect('admin/FREG0006/updateReg/'.$uhid.'/'.$ipdid);
		}
	
	}
	
	function printSmartCard()
        {
			 $uhid = $this->uri->segment(4);
			?>         <center>
			            <div style='border:1px solid #000; width:600px;'>
			
			            <h1>UHID <?php echo $uhid ;?> </h1>
						<?php
						echo "<img src='http://localhost/metro/index.php/admin/FREG0006/getBarcode2/$uhid' width='100px' height='80'>" ;
						?>
						</div>
						</center>
			<?php
			
		}
	
	function regPatientCounter()
        {
				 //$data['counterPat']=$this->Common_model->get_data_by_query("select * from patient where patient_reg_from = 'REGISTRATION' order by id desc limit 100 ");
				// $data['counterPat']=$this->Common_model->get_data_by_query("select c.*,p.*,s.scheme_name from casualty c ,patient p ,scheme s where c.casu_uhid=p.id and p.patient_reg_from = 'REGISTRATION' and p.scheme=s.id order by id desc limit 100 ");	

	$data['counterPat']=$this->Common_model->get_data_by_query("select * from  casualty c 
              left join patient	 pa on pa.id=c.casu_uhid
              left join scheme	 s on s.id=pa.scheme
              
			  order by casu_id desc limit 100");				
			$data['scheme'] =$this->Address->scheme();	
		    $this->template->set_template('user');
			$this->template->write_view('header', 'default/header',$this->session->userdata);
			$this->template->write_view('sidebar', 'default/sidebar');
            $this->template->write_view('content', 'admin/FREG0006/regPatientCounter',$data);
			$this->template->write_view('footer', 'default/footer');
			$this->template->render();
		}
			
	function regslip()
        {
				$uhid = $this->uri->segment(4);
				$ipdid = $this->uri->segment(5);
				
				$data['pdata']=$this->Common_model->get_data_by_query("select p.*, d.district,t.tahsil,v.vill_name from patient p left join state s on s.state_id=p.state
																		left join districmp d on d.id=p.district
																		left join tahsil t on t.id=p.tehsil
																		left join villmp v on v.id=p.village
																		where p.id=$uhid");
																		$scheme=$data['pdata'][0]['scheme'];
 
 
 
				$data['pdataaaaa']=$this->Common_model->get_data_by_query("select a.* ,b.doc_name from casualty a , doctor b where a.casu_id=$ipdid and a.casu_consultent=b.id");
// echo $this->db->last_query();
// die;
                    if($scheme=='1')
                    {
                    	$table='gen_patient';
                    }
                    elseif($scheme=='4' || $scheme=='5' ||$scheme=='6' || $scheme=='7'  || $scheme=='8' || $scheme=='9'  )
                    {
                    	$table='cghs_patient';
                    }
					elseif($scheme=='2' || $scheme=='3' || $scheme=='10' || $scheme=='11' )
                    {
                    	$table='bpl_patient';
                    }
					
       
			$data['pdata1']=$this->Common_model->get_data_by_query("select admited_by,relation_with_patient from $table where uhid='$uhid'");
			

			
		    $this->template->set_template('user');
			 $this->template->write_view('content', 'admin/CASU00010/consents/print_admission_form',$data);
		    // $this->template->write_view('content', 'admin/FREG0006/regslip',$data);
	
			$this->template->render();			
		}
		
		
		
		
		
		function print_admission_form()
        {
				$uhid = $this->uri->segment(4);
				$ipdid = $this->uri->segment(5);
				
				$data['pdata']=$this->Common_model->get_data_by_query("select p.*, d.district,t.tahsil,v.vill_name from patient p left join state s on s.state_id=p.state
																		left join districmp d on d.id=p.district
																		left join tahsil t on t.id=p.tehsil
																		left join villmp v on v.id=p.village
																		where p.id=$uhid");
																		$scheme=$data['pdata'][0]['scheme'];
 
 
 
				$data['pdataaaaa']=$this->Common_model->get_data_by_query("select a.* ,b.doc_name from casualty a , doctor b where a.casu_id=$ipdid and a.casu_consultent=b.id");

                    if($scheme=='1')
                    {
                    	$table='gen_patient';
                    }
                    elseif($scheme=='4' || $scheme=='5' ||$scheme=='6' || $scheme=='7'  || $scheme=='8' || $scheme=='9'  )
                    {
                    	$table='cghs_patient';
                    }
					elseif($scheme=='2' || $scheme=='3' || $scheme=='10' || $scheme=='11' )
                    {
                    	$table='bpl_patient';
                    }
					
       
			$data['pdata1']=$this->Common_model->get_data_by_query("select admited_by,relation_with_patient from $table where uhid='$uhid'");
			

			
		    $this->template->set_template('user');
		    $this->template->write_view('content', 'admin/CASU00010/consents/print_admission_form',$data);
	
			$this->template->render();			
		}
		





function gatepass_relatv()
		{
				
		if($this->ion_auth->logged_in()){
			
			$data['wards'] = $this->Common_model->get_data_by_query('SELECT r_under_id,r_name,r_id from resource where r_level=3 ');
			$data['scheme'] =$this->Address->scheme();
            $data['doc_name'] =$this->Common_model->get_data_by_query('select * from doctor');
			
			$this->template->set_template('user');
			$this->template->write_view('header', 'default/header', $this->session->userdata);
			$this->template->write_view('sidebar', 'default/sidebar');

	
			$currentpat=0;
			$dischage=0;
			$curentgenPat=0;
	  
			
			$data['current_pat']=$currentpat;
			$data['discharge_pat']=$dischage;
			$data['cur_gen_pat']=$curentgenPat;
		
			
			$this->template->write_view('content', 'admin/FREG0006/gatepass_relatv',$data);
			$this->template->write_view('footer', 'default/footer');
			$this->template->render();
		}
		else{
			redirect('auth/login');	
			}
				
				
		}

	
		
		

function visiprint_gatepass()
		{
		
			$uhid = $this->uri->segment(4);
			$ipdid = $this->uri->segment(5);
			$visit_id = $this->uri->segment(6);
			//$this->template->set_template('user');
			  // $data['visit_print'] =$this->Common_model->get_data_by_query("select * from visit_gatepass v left join patient p on  p.id=v.visit_uhid where v.visit_regid = $ipdid");
			$data['visit_print'] =$this->Common_model->get_data_by_query("select v.*,p.id,p.first_name,p.address,p.middle_name,p.last_name,p.patient_balance,p.patient_age,p.patient_gender,p.scheme,p.consultant,a.admit_id,a.admit_uhid,a.admit_exitdt,a.admit_floor,a.admit_status,a.admit_ward,a.admit_hide,a.admit_bed,c.casu_id,c.casu_pushdt,c.casu_push,c.casu_entrydt,c.casu_status from visit_gatepass v left join patient p on  p.id=v.visit_uhid left join ipd_admit a on v.visit_regid = a.admit_id left join casualty c on p.id = c.casu_uhid where v.visit_regid = '$ipdid' and v.visit_id='$visit_id'" );
					//echo $this->db->last_query(); die;
			$this->template->write_view('content', 'admin/FREG0006/visiprint_gatepass',$data);
			//$this->template->write_view('footer', 'default/footer');
			$this->template->render();


	
				
				
		}



function generate_gatepass()
		{
				
		
			$uhid = $this->uri->segment(4);
			$ipdid = $this->uri->segment(5);
			$this->template->set_template('user');
			$this->template->write_view('header', 'default/header', $this->session->userdata);
			$this->template->write_view('sidebar', 'default/sidebar');
				 // $data['visit'] =$this->Common_model->get_data_by_query("select * from visit_gatepass v left join patient p on  p.id=v.visit_uhid where v.visit_regid = $ipdid");
		   // $data['visit'] =$this->Common_model->get_data_by_query('select * from visit_gatepass where visit_uhid="$uhid"');
			
			
			$data['visit'] =$this->Common_model->get_data_by_query("select v.*,p.id,p.first_name,p.address,p.middle_name,p.last_name,p.patient_balance,p.patient_age,p.patient_gender,p.scheme,p.consultant,a.admit_id,a.admit_uhid,a.admit_exitdt,a.admit_floor,a.admit_status,a.admit_ward,a.admit_hide,a.admit_bed from visit_gatepass v left join patient p on  p.id=v.visit_uhid left join ipd_admit a on v.visit_regid = a.admit_id where v.visit_regid = '$ipdid'" );
			
			$data['visit_head'] =$this->Common_model->get_data_by_query("select p.id,p.first_name,p.middle_name,p.last_name,p.patient_age,p.patient_gender,a.admit_id,a.admit_uhid,a.admit_ward,a.admit_bed,c.casu_id,c.casu_pushdt,c.casu_push,c.casu_entrydt,c.casu_status from patient p left join ipd_admit a on p.id = a.admit_uhid left join casualty c on p.id = c.casu_uhid where c.casu_uhid = '$uhid'" );
			
			$this->template->write_view('content', 'admin/FREG0006/generate_gatepass',$data);
			$this->template->write_view('footer', 'default/footer');
			$this->template->render();
		
				
				
		}




		
		
			
	function insert_visi_gatepass()
{
	 $uhid = $this->input->post('visit_uhid');
	  $ipdid = $this->input->post('visit_regid'); 
 	$data['visit_uhid']= $this->input->post('visit_uhid');
	$data['visit_regid']= $this->input->post('visit_regid'); 
	$data['visit_name1']= $this->input->post('visit_name1');
	$data['visit_phone1']= $this->input->post('visit_phone1');
	$data['visit_name2']= $this->input->post('visit_name2');
	$data['visit_phone2']= $this->input->post('visit_phone2');
	$data['visit_name3']= $this->input->post('visit_name3');
	$data['visit_phone3']= $this->input->post('visit_phone3');
	$data['visit_name4']= $this->input->post('visit_name4');
	$data['visit_phone4']= $this->input->post('visit_phone4');
	$data['visit_name5']= $this->input->post('visit_name5');
	$data['visit_phone5']= $this->input->post('visit_phone5');
	$data['visit_status']= 1;
	$data['visit_entrydt']= date( 'Y-m-d h:i:s a' );
	//$data['dd']=$this->session->userdata;
	
	$this->Crud_model->insert_record('visit_gatepass',$data);
	//echo $this->db->last_query();
	//die;
	
	redirect('admin/FREG0006/generate_gatepass/'.$uhid."/".$ipdid);

}















		
	function enquiry()
		{
				
		if($this->ion_auth->logged_in()){
			$data['wards'] = $this->Common_model->get_data_by_query('SELECT r_under_id,r_name,r_id from resource where r_level=3 ');
			$data['scheme'] =$this->Address->scheme();
            $data['doc_name'] =$this->Common_model->get_data_by_query('select * from doctor');
			
			$this->template->set_template('user');
			$this->template->write_view('header', 'default/header', $this->session->userdata);
			$this->template->write_view('sidebar', 'default/sidebar');

	
			$currentpat=0;
			$dischage=0;
			$curentgenPat=0;
	  
			
			$data['current_pat']=$currentpat;
			$data['discharge_pat']=$dischage;
			$data['cur_gen_pat']=$curentgenPat;
		
			
			$this->template->write_view('content', 'admin/FREG0006/enquiry',$data);
			$this->template->write_view('footer', 'default/footer');
			$this->template->render();
		}
		else{
			redirect('auth/login');	
			}
				
				
		}
		




		function searchgatepass()
		{
			
			$first_name=$_POST['srch_name'];
			$last_name=$_POST['srch_last_name'];
			$village=$_POST['srch_vilage'];
			$address=$_POST['srch_address'];
			$uhid=$_POST['srch_uhid'];
			$scheme=$_POST['scheme'];
			$district=$_POST['district'];
			$consultant=$_POST['consultant'];
			$limit=100;
		
			@$startdate=date('Y-m-d',strtotime($_POST['srch_date_from']));
		@$enddate=date('Y-m-d',strtotime($_POST['srch_date_to']));
		$datebetw='0000-00-00';

			$srch_regno=$_POST['srch_regno'];
			$fa_hus_name=$_POST['fa_hus_name'];
			
			                             
            if($first_name !='')
            {
            $first_name =$first_name.'@first_name';
            }
            
            if($last_name !='')
            {
            $last_name =$last_name.'@last_name';
            }
            if($uhid !='')
            {
            $uhid =$uhid.'@uhid';
            }
            
            if($village !='')
               {
               $village =$village.'@village';
               }		 	
               if($address !='')
               {
               $address =$address.'@address';
               }
			   if($scheme !='')
               {
               $scheme =$scheme.'@scheme';
			   }
			   if($district !='')
               {
               $district =$district.'@district';
               } if($consultant !='')
               {
               $consultant =$consultant.'@casu_consultent';
			   $limit=1000;
               }if($srch_regno !='')
               {
               $srch_regno =$srch_regno.'@admit_id';
               }if($fa_hus_name !='')
               {
               $fa_hus_name =$fa_hus_name.'@fa_hus_name';
               }
			  if($startdate !="" and $startdate !="1970-01-01" and $enddate !="" and $enddate !="1970-01-01")
				{
				$datebetw =$startdate.'^'.$enddate.'@'.'casu_entrydt';
				}
		
		$serchitem = array($first_name,$last_name,$uhid,$village,$address,$scheme,$district,$consultant,$srch_regno,$datebetw);

		$querry='';
		 foreach ($serchitem as &$value) {

		if($value=='select')
		{
		}
		else if($value=='')
		{
		}
		else
		{

		$value_aryy = explode ( "@", $value );
		$data  =  $value_aryy [0];
		@$filed = $value_aryy [1];
		@$data2 = $value_aryy [2];
		
		if($filed=='first_name')
		{
			$querry .= " and p.".$filed." like "."'%".$data."%'";
		} if($filed=='last_name')
		{
			$querry .= " and p.".$filed." like "."'%".$data."%'";
		}
			else if($filed=='uhid')
		{
			$querry .= " and p.id='$data'";
		}
			else if($filed=='village')
		{
			$querry .= " and p.".$filed." like "."'%".$data."%'";
		}	else if($filed=='village')
		{
			$querry .= " and p.".$filed." like "."'%".$data."%'";
		}
			else if($filed=='address')
		{
		  $querry .= " and p.".$filed." like "."'%".$data."%'";
		}
			else if($filed=='scheme')
		{
		  $querry .= " and p.".$filed."=".$data;
		}
		else if($filed=='district')
		{
		  $querry .= " and p.".$filed."=".$data;
		}
			else if($filed=='casu_consultent')
		{
			$querry .= " and c.".$filed."='".$data."'";
		}   
			else if($filed=='admit_id')
		{
			//$querry .= " and a.".$filed."='".$data."'";
			$querry .= " and c.casu_id = '$data'";
		}  
			else if($filed=='fa_hus_name')
		{
			//$querry .= " and a.".$filed."='".$data."'";
			$querry .= " and p.".$filed." like "."'%".$data."'";
		}
		else if($filed=='casu_entrydt')
				{
					$datas = explode ( "^", $datebetw );
					$sdata = $datas[0];
					$esdata = $datas [1];
					$querry .= " and DATE_FORMAT(casu_entrydt,'%Y-%m-%d') between '$sdata' and '$esdata'";
					
				}
	}
	
	}
						
// print_r($querry);
// die;
			// $ipdpatient = $this->Common_model->get_data_by_query("select p.id,p.first_name,p.middle_name,p.last_name,p.patient_balance,p.scheme,p.consultant,a.admit_id,a.admit_uhid,a.admit_exitdt,a.admit_floor,a.admit_status,a.admit_ward,a.admit_hide,a.admit_bed,c.casu_id,c.casu_pushdt,c.casu_push,c.casu_entrydt,c.casu_status from casualty c  
			// left join patient p on c.casu_uhid = p.id 
			// left join ipd_admit  a on c.casu_id = a.admit_id 
		    // where  p.id>0 $querry  order by c.casu_entrydt desc limit 100");
			
			
			$ipdpatient = $this->Common_model->get_data_by_query("select p.id,p.first_name,p.address,p.middle_name,p.last_name,p.patient_balance,p.scheme,p.consultant,a.admit_id,a.admit_uhid,a.admit_exitdt,a.admit_floor,a.admit_status,a.admit_ward,a.admit_hide,a.admit_bed,c.casu_id,c.casu_pushdt,c.casu_push,c.casu_entrydt,c.casu_status,d.doc_name from casualty c  
			left join patient p on c.casu_uhid = p.id 
			left join doctor d on d.id = c.casu_consultent 
			left join ipd_admit  a on c.casu_id = a.admit_id 
			
		    where  p.id>0 $querry order by c.casu_entrydt desc limit $limit");
			
			// echo $this->db->last_query();
			// die();
									$count=1;
									foreach($ipdpatient as $ft)
									{ 

									?>
									<tr class="odd">
									 
									<td class=" sorting_1"><?php echo $count ;  ?></td>
									
									<td class=" sorting_1"><?php echo $ft['id'];?></td>
									<td><?php echo $ft['casu_id'];?></td>
									<td class=" "><?php echo $ft['first_name']."&nbsp";echo $ft['middle_name']."&nbsp"; echo $ft['last_name']; ?></td>
									  <!--<td class=" "><?php //echo $ft['patient_age'];?></td>
									  <td class=" "><?php //echo $ft['patient_gender'];?></td>-->
									<?php $id=$ft['id'];
								        $opdipd_id= $ft['casu_id'];
									?>
									  <td class=" "><?php echo date('d-m-Y h:i:s a',strtotime($ft['casu_entrydt'])); ?></td>
									  <td class=" "><?php echo $this->Crud_model->Patient_current_bal($id,$opdipd_id);?></td>
									  <td class=" ">
										
										
									  <?php 
									  @$this->Common_model->getSchemeName($ft['casu_id'],$ft['id'],"IPD");
						
									  
									  ?></td>
									  
										<td class=" "><?php echo $ft['doc_name'];?></td>
									  <td class=" ">
									   <?php 
									   if($ft['casu_status']==0 ){
										   
										if($ft['admit_status']=='CP' || $ft['admit_status']=='NA'){
										   
										if(@$ft['admit_floor']!=''){
											
											$data1['floor'] = $this->Common_model->get_data_by_query("
											select r_name from resource where r_id =".$ft['admit_floor']);
											
											//echo $this->db->last_query();
											
											if(@$data1['floor']!=null)
											{
												foreach($data1['floor'] as $key => $floor){ echo "<span class='label label-success' style='background-color:green'>".$floor['r_name']."</span> - "; }
											}
										
										}
										
									
									    if(@$ft['admit_ward']!=''){
										
											@$data1['ward'] = $this->Common_model->get_data_by_query("select r_name from resource where r_id =".$ft['admit_ward']  );
											
											if($data1['ward']!=null)
											{
												foreach($data1['ward'] as $key => $ward){ echo "<span class='label label-success' style='background-color:green'>".$ward['r_name']."</span> "; }
											}
										}
										
									
									    if(@$ft['admit_bed']!=''){
										
											@$data1['bed'] = $this->Common_model->get_data_by_query("select r_name from resource where r_id =".$ft['admit_bed'] );
											
											if(@$data1['bed']!=null)
											{
												foreach($data1['bed'] as $key => $bed){ echo " - <span class='label label-success' style='background-color:green' >".$bed['r_name']."</span> "; }
											}
										}
										
										}
										elseif($ft['admit_status']=='OT'){
											echo '<span class="label label-success" >SHIFTED to OT</span>' ;
										}
										elseif($ft['admit_status']=='Cardic OT'){
											echo '<span class="label label-success" >SHIFTED to Cardic OT</span>' ;
										}
										
										elseif($ft['admit_status']=='DISCHARGED'){
										$opdipd_id ;
										$id;
										$datass['shifthistory'] = $this->Common_model->get_data_by_query("select i.shift_uhid,i.shift_ipd_id,r.r_name from ipd_shift i left join resource r on r.r_id = i.shift_ward where shift_uhid=$id and shift_ipd_id=$opdipd_id limit 1");
										foreach($datass['shifthistory'] as $his){ echo "Discharged from ",$his['r_name']."</br>"; }
										
											echo '<span class="label label-important" style="background-color:red">DISCHARGED ON '.date('d-m-Y H:i:s',strtotime($ft['admit_exitdt'])).'</span> ' ;
										}
										
										
										if($ft['casu_push']=='DISCHARGED'){
											echo 'Discharged From Casualty</br><span class="label label-important" style="background-color:red">DISCHARGED ON '.date('d-m-Y H:i:s',strtotime($ft['casu_pushdt'])).'</span> ' ;
										}
										if($ft['casu_push']=='REFUSED'){
											echo '<span class="label label-success" style="background-color:red" >REFUSED FROM CASUALTY</span>' ;
										}
										
										elseif($ft['admit_hide']==0 ){  
											echo '<span class="label label-success" >Discharged from Ward</span>' ;
										}elseif($ft['casu_status']==0 ){  
											//echo '<span class="label label-success" >SHIFTED To OT</span>' ;
										}
								
									  }
									  
									  elseif($ft['casu_status']==1 ){
										  
										  echo "<span class='label label-info' style='background-color:blue' >Casualty</span>";
									  }
									?>
									  </td>
									  <?php 
									 
									 
									 
									  // if($ft['admit_status']!='DISCHARGED'){
									  // if($ft['casu_status']==0 && $ft['casu_push']=='IPD'){  ?>
									<!--	<td><a href="<?php //cho base_url().'admin/FREG0006/shiftPatient/'.$ft['id'].'/'.$ft['casu_id'].'/'.$ft['admit_ward'].'/'.$ft['admit_floor'].'/'.$ft['admit_bed']?>">Shift <i class="icon-share"></i></a></td>
									  <?php //}
									  
									  // elseif($ft['casu_status']==1){ 
										// if($ft['casu_push']==''){
									  ?>
										<td><a href="<?php //echo base_url().'admin/FREG0006/shiftPatient/'.$ft['id'].'/'.$ft['casu_id']?>">Shift <i class="icon-share"></i></a></td>
										<?php //}else{ ?>
											<td></td>	
										<?php //}
											//} }
										//else{
											?>
										<td></td>-->	
										<?php //}
									 
									 
									 
									 
									 
									 
									 
									 
									 
									 
									 
									 
									 
										//if($this->ion_auth->in_group('chairman')){ ?>
										<!-- <td>
										 <?php //if($ft['casu_status']==0){ ?>
										 
										 <a class="btn blue mini"  style="width:70px;margin-bottom:5px" href="<?php //echo base_url()."admin/DOC0016/regslip/".$ft['id']."/".$ft['casu_id']."/1";?>">View History </a>
										 
										<!--<a class="btn green mini" style="width:70px;margin-bottom:5px" href="<?php echo base_url().'admin/CASU00010/PatientView/'.$ft['id'].'/'.$ft['casu_id'];?>">Casualty <i class="icon-share"></i></a>
										
										<a class="btn green mini"  style="width:70px;margin-bottom:5px" href="<?php echo base_url().'admin/NURS0004/callforms/'.$ft['casu_id'].'/'.$ft['id'].'/continuation_sheet'?>">Nursing <i class="icon-share"></i></a>
										 
										<a class="btn green mini"  style="width:70px;margin-bottom:5px" href="<?php echo base_url().'admin/NURS0004/PtVisitWise/'.$ft['casu_id'];?>">Disc. Card <i class="icon-share"></i></a>
										
										<a class="" href="<?php echo base_url()."admin/DOC0016/regslip/".$ft['id']."/".$ft['casu_id'];?>"><button type="button" class="btn mini" id="update_ss" onclick="" >View</button></a>-->
                                        
										 <?php //}
										//elseif($ft['casu_status']==1){ ?>
										<!--<a class="btn green mini" style="width:70px;margin-bottom:5px" href="<?php //echo base_url().'admin/CASU00010/PatientView/'.$ft['id'].'/'.$ft['casu_id'];?>">Casualty <i class="icon-share"></i>
										</a>
										<?php //} ?>
										</td>-->
										<?php //} ?>
									<td><a href="<?php echo base_url().'admin/FREG0006/generate_gatepass/'.$ft['id'].'/'.$ft['casu_id'];?>" class='btn mini blue'>Gatepass </a> 
									</td>
									</tr>
									<?php

                                    $count++ ;
									} ?>
			<?php
				
		}


























		
	function searchenq()
		{
			
			$first_name=$_POST['srch_name'];
			$last_name=$_POST['srch_last_name'];
			$village=$_POST['srch_vilage'];
			$address=$_POST['srch_address'];
			$uhid=$_POST['srch_uhid'];
			$scheme=$_POST['scheme'];
			$district=$_POST['district'];
			$consultant=$_POST['consultant'];
			$limit=100;
		
			@$startdate=date('Y-m-d',strtotime($_POST['srch_date_from']));
		@$enddate=date('Y-m-d',strtotime($_POST['srch_date_to']));
		$datebetw='0000-00-00';

			$srch_regno=$_POST['srch_regno'];
			$fa_hus_name=$_POST['fa_hus_name'];
			
			                             
            if($first_name !='')
            {
            $first_name =$first_name.'@first_name';
            }
            
            if($last_name !='')
            {
            $last_name =$last_name.'@last_name';
            }
            if($uhid !='')
            {
            $uhid =$uhid.'@uhid';
            }
            
            if($village !='')
               {
               $village =$village.'@village';
               }		 	
               if($address !='')
               {
               $address =$address.'@address';
               }
			   if($scheme !='')
               {
               $scheme =$scheme.'@scheme';
			   }
			   if($district !='')
               {
               $district =$district.'@district';
               } if($consultant !='')
               {
               $consultant =$consultant.'@casu_consultent';
			   $limit=1000;
               }if($srch_regno !='')
               {
               $srch_regno =$srch_regno.'@admit_id';
               }if($fa_hus_name !='')
               {
               $fa_hus_name =$fa_hus_name.'@fa_hus_name';
               }
			  if($startdate !="" and $startdate !="1970-01-01" and $enddate !="" and $enddate !="1970-01-01")
				{
				$datebetw =$startdate.'^'.$enddate.'@'.'casu_entrydt';
				}
		
		$serchitem = array($first_name,$last_name,$uhid,$village,$address,$scheme,$district,$consultant,$srch_regno,$datebetw);

		$querry='';
		 foreach ($serchitem as &$value) {

		if($value=='select')
		{
		}
		else if($value=='')
		{
		}
		else
		{

		$value_aryy = explode ( "@", $value );
		$data  =  $value_aryy [0];
		@$filed = $value_aryy [1];
		@$data2 = $value_aryy [2];
		
		if($filed=='first_name')
		{
			$querry .= " and p.".$filed." like "."'%".$data."%'";
		} if($filed=='last_name')
		{
			$querry .= " and p.".$filed." like "."'%".$data."%'";
		}
			else if($filed=='uhid')
		{
			$querry .= " and p.id='$data'";
		}
			else if($filed=='village')
		{
			$querry .= " and p.".$filed." like "."'%".$data."%'";
		}	else if($filed=='village')
		{
			$querry .= " and p.".$filed." like "."'%".$data."%'";
		}
			else if($filed=='address')
		{
		  $querry .= " and p.".$filed." like "."'%".$data."%'";
		}
			else if($filed=='scheme')
		{
		  $querry .= " and p.".$filed."=".$data;
		}
		else if($filed=='district')
		{
		  $querry .= " and p.".$filed."=".$data;
		}
			else if($filed=='casu_consultent')
		{
			$querry .= " and c.".$filed."='".$data."'";
		}   
			else if($filed=='admit_id')
		{
			//$querry .= " and a.".$filed."='".$data."'";
			$querry .= " and c.casu_id = '$data'";
		}  
			else if($filed=='fa_hus_name')
		{
			//$querry .= " and a.".$filed."='".$data."'";
			$querry .= " and p.".$filed." like "."'%".$data."'";
		}
		else if($filed=='casu_entrydt')
				{
					$datas = explode ( "^", $datebetw );
					$sdata = $datas[0];
					$esdata = $datas [1];
					$querry .= " and DATE_FORMAT(casu_entrydt,'%Y-%m-%d') between '$sdata' and '$esdata'";
					
				}
	}
	
	}
						
// print_r($querry);
// die;
			// $ipdpatient = $this->Common_model->get_data_by_query("select p.id,p.first_name,p.middle_name,p.last_name,p.patient_balance,p.scheme,p.consultant,a.admit_id,a.admit_uhid,a.admit_exitdt,a.admit_floor,a.admit_status,a.admit_ward,a.admit_hide,a.admit_bed,c.casu_id,c.casu_pushdt,c.casu_push,c.casu_entrydt,c.casu_status from casualty c  
			// left join patient p on c.casu_uhid = p.id 
			// left join ipd_admit  a on c.casu_id = a.admit_id 
		    // where  p.id>0 $querry  order by c.casu_entrydt desc limit 100");
			
			
			$ipdpatient = $this->Common_model->get_data_by_query("select p.id,p.first_name,p.address,p.middle_name,p.last_name,p.patient_balance,p.scheme,p.consultant,a.admit_id,a.admit_uhid,a.admit_exitdt,a.admit_floor,a.admit_status,a.admit_ward,a.admit_hide,a.admit_bed,c.casu_id,c.casu_pushdt,c.casu_push,c.casu_entrydt,c.casu_status,d.doc_name from casualty c  
			left join patient p on c.casu_uhid = p.id 
			left join doctor d on d.id = c.casu_consultent 
			left join ipd_admit  a on c.casu_id = a.admit_id 
			
		    where  p.id>0 $querry order by c.casu_entrydt desc limit $limit");
			
			// echo $this->db->last_query();
			// die();
									$count=1;
									foreach($ipdpatient as $ft)
									{ 

									?>
									<tr class="odd">
									 
									<td class=" sorting_1"><?php echo $count ;  ?></td>
									<td class=" sorting_1"><a href="<?php echo base_url()."admin/NURS0004/PtVisitWise/".$ft['casu_id'];?>" class=""><?php echo $ft['id'];?></a></td>
									<td><?php echo $ft['casu_id'];?></td>
									<td class=" ">
									<?php if($this->ion_auth->in_group('chairman')){ ?>
									
									<a class="" style="" href="<?php echo base_url()."admin/DOC0016/regslip/".$ft['id']."/".$ft['casu_id']."/1";?>">
									<?php echo $ft['first_name']."&nbsp";echo $ft['middle_name']."&nbsp"; echo $ft['last_name']; ?>
									</a>
									<?php } else{ ?>
									<a class="" style="" href="<?php echo base_url()."admin/DOC0016/regslip/".$ft['id']."/".$ft['casu_id']."/1";?>">
									<?php echo $ft['first_name']."&nbsp";echo $ft['middle_name']."&nbsp"; echo $ft['last_name']; ?>
									</a>
									<?php } ?>
									
									</td>
									  <!--<td class=" "><?php //echo $ft['patient_age'];?></td>
									  <td class=" "><?php //echo $ft['patient_gender'];?></td>-->
									<?php $id=$ft['id'];
								        $opdipd_id= $ft['casu_id'];
									?>
									  <td class=" "><?php echo date('d-m-Y h:i:s a',strtotime($ft['casu_entrydt'])); ?></td>
									  <td class=" "><?php echo $this->Crud_model->Patient_current_bal($id,$opdipd_id);?></td>
									  <td class=" ">
										
										
									  <?php 
									  @$this->Common_model->getSchemeName($ft['casu_id'],$ft['id'],"IPD");
						
									  
									  ?></td>
									  
										<td class=" "><?php echo $ft['doc_name'];?></td>
									  <td class=" ">
									   <?php 
									   if($ft['casu_status']==0 ){
										   
										if($ft['admit_status']=='CP' || $ft['admit_status']=='NA'){
										   
										if(@$ft['admit_floor']!=''){
											
											$data1['floor'] = $this->Common_model->get_data_by_query("
											select r_name from resource where r_id =".$ft['admit_floor']);
											
											//echo $this->db->last_query();
											
											if(@$data1['floor']!=null)
											{
												foreach($data1['floor'] as $key => $floor){ echo "<span class='label label-success' style='background-color:green'>".$floor['r_name']."</span> - "; }
											}
										
										}
										
									
									    if(@$ft['admit_ward']!=''){
										
											@$data1['ward'] = $this->Common_model->get_data_by_query("select r_name from resource where r_id =".$ft['admit_ward']  );
											
											if($data1['ward']!=null)
											{
												foreach($data1['ward'] as $key => $ward){ echo "<span class='label label-success' style='background-color:green'>".$ward['r_name']."</span> "; }
											}
										}
										
									
									    if(@$ft['admit_bed']!=''){
										
											@$data1['bed'] = $this->Common_model->get_data_by_query("select r_name from resource where r_id =".$ft['admit_bed'] );
											
											if(@$data1['bed']!=null)
											{
												foreach($data1['bed'] as $key => $bed){ echo " - <span class='label label-success' style='background-color:green' >".$bed['r_name']."</span> "; }
											}
										}
										
										}
										elseif($ft['admit_status']=='OT'){
											echo '<span class="label label-success" >SHIFTED to OT</span>' ;
										}
										elseif($ft['admit_status']=='Cardic OT'){
											echo '<span class="label label-success" >SHIFTED to Cardic OT</span>' ;
										}
										
										elseif($ft['admit_status']=='DISCHARGED'){
										$opdipd_id ;
										$id;
										$datass['shifthistory'] = $this->Common_model->get_data_by_query("select i.shift_uhid,i.shift_ipd_id,r.r_name from ipd_shift i left join resource r on r.r_id = i.shift_ward where shift_uhid=$id and shift_ipd_id=$opdipd_id limit 1");
										foreach($datass['shifthistory'] as $his){ echo "Discharged from ",$his['r_name']."</br>"; }
										
											echo '<span class="label label-important" style="background-color:red">DISCHARGED ON '.date('d-m-Y H:i:s',strtotime($ft['admit_exitdt'])).'</span> ' ;
										}
										
										
										if($ft['casu_push']=='DISCHARGED'){
											echo 'Discharged From Casualty</br><span class="label label-important" style="background-color:red">DISCHARGED ON '.date('d-m-Y H:i:s',strtotime($ft['casu_pushdt'])).'</span> ' ;
										}
										if($ft['casu_push']=='REFUSED'){
											echo '<span class="label label-success" style="background-color:red" >REFUSED FROM CASUALTY</span>' ;
										}
										
										elseif($ft['admit_hide']==0 ){  
											echo '<span class="label label-success" >Discharged from Ward</span>' ;
										}elseif($ft['casu_status']==0 ){  
											//echo '<span class="label label-success" >SHIFTED To OT</span>' ;
										}
								
									  }
									  
									  elseif($ft['casu_status']==1 ){
										  
										  echo "<span class='label label-info' style='background-color:blue' >Casualty</span>";
									  }
									?>
									  </td>
									  <?php 
									 
									  if($ft['admit_status']!='DISCHARGED'){
									  if($ft['casu_status']==0 && $ft['casu_push']=='IPD'){  ?>
										<td><a href="<?php echo base_url().'admin/FREG0006/shiftPatient/'.$ft['id'].'/'.$ft['casu_id'].'/'.$ft['admit_ward'].'/'.$ft['admit_floor'].'/'.$ft['admit_bed']?>">Shift <i class="icon-share"></i></a></td>
									  <?php }
									  
									  elseif($ft['casu_status']==1){ 
										if($ft['casu_push']==''){
									  ?>
										<td><a href="<?php echo base_url().'admin/FREG0006/shiftPatient/'.$ft['id'].'/'.$ft['casu_id']?>">Shift <i class="icon-share"></i></a></td>
										<?php }else{ ?>
											<td></td>	
										<?php }
									  } }
										else{
											?>
										<td></td>	
										<?php }
										if($this->ion_auth->in_group('chairman')){ ?>
										 <td>
										 <?php if($ft['casu_status']==0){ ?>
										 
										 <a class="btn blue mini"  style="width:70px;margin-bottom:5px" href="<?php echo base_url()."admin/DOC0016/regslip/".$ft['id']."/".$ft['casu_id']."/1";?>">View History </a>
										 
										<!--<a class="btn green mini" style="width:70px;margin-bottom:5px" href="<?php echo base_url().'admin/CASU00010/PatientView/'.$ft['id'].'/'.$ft['casu_id'];?>">Casualty <i class="icon-share"></i></a>
										
										<a class="btn green mini"  style="width:70px;margin-bottom:5px" href="<?php echo base_url().'admin/NURS0004/callforms/'.$ft['casu_id'].'/'.$ft['id'].'/continuation_sheet'?>">Nursing <i class="icon-share"></i></a>
										 
										<a class="btn green mini"  style="width:70px;margin-bottom:5px" href="<?php echo base_url().'admin/NURS0004/PtVisitWise/'.$ft['casu_id'];?>">Disc. Card <i class="icon-share"></i></a>
										
										<a class="" href="<?php echo base_url()."admin/DOC0016/regslip/".$ft['id']."/".$ft['casu_id'];?>"><button type="button" class="btn mini" id="update_ss" onclick="" >View</button></a>-->
                                        
										 <?php }
										elseif($ft['casu_status']==1){ ?>
										<a class="btn green mini" style="width:70px;margin-bottom:5px" href="<?php echo base_url().'admin/CASU00010/PatientView/'.$ft['id'].'/'.$ft['casu_id'];?>">Casualty <i class="icon-share"></i>
										</a>
										<?php } ?>
										</td>
										<?php } ?>
									
									</tr>
									<?php

                                    $count++ ;
									} ?>
			<?php
				
		}
		
	public function shiftPatient()
	{
		if($this->ion_auth->logged_in()){
				
			$this->template->set_template('user');
			$this->template->write_view('header', 'default/header', $this->session->userdata);
			$this->template->write_view('sidebar', 'default/sidebar');
			$uhid = $this->uri->segment(4);
			$data['ipd_id'] = $this->uri->segment(5);
			$data['ipd_bed'] = $this->uri->segment(8);
			$data['ipd_ward'] = $this->uri->segment(6);
			$data['ipd_floor'] = $this->uri->segment(7);
			

			$data['bed'] = $this->Common_model->get_data_by_query("select * from resource where r_under_id='1'");	//Getting all floors
			$data['result'] = $this->Common_model->get_data_by_query("select id,first_name,middle_name,last_name,patient_age,patient_gender from patient where id='$uhid' ");
			
			//$this->db->last_query();
			
			$this->template->write_view('content', 'admin/FREG0006/shiftPatient',$data);
			$this->template->write_view('footer', 'default/footer');
			$this->template->render();
			}
			else{
			redirect('auth/login');	
			}
	}
	
	public function submitallot()
	{
	if($this->ion_auth->logged_in()){
	//if($this->input->post('bed_allot')){
		
		$redirect = $this->uri->segment(4);
		date_default_timezone_set('Asia/Kolkata');
		
		$datausse['dd']=$this->session->userdata;
		foreach ($datausse as $key=>$value){} 		
		$userid=$value['user_id'];
		
		
		$uhid = $this->input->post('uhid');
		$ipd_id = $this->input->post('ipd_id');		// ipd_id for ipd_admit table 
		
		$p_ipd_bed = $this->input->post('p_ipd_bed');
		$p_ipd_ward = $this->input->post('p_ipd_ward');
		$p_ipd_floor = $this->input->post('p_ipd_floor');
		
		$new_bed = $this->input->post('bed');
			
		$new_ward = $this->input->post('ward');

		//elseif($p_ipd_ward!=41){				// if previously it was ipd
		
		//$data2['admit_ward'] 	 	= $this->input->post('ward');
		//$data2['admit_floor'] 	 	= $this->input->post('floor');
		//$data2['admit_bed']		= $this->input->post('bed');
		//$data2['admit_entrydt']		= date("Y-m-d h:i:sa");
		
		//if($data2['admit_ward']==41){			//if allotment new bed to cathlab
		
		$admit_type='';
		if($new_ward!=41){
			$admit_type = 'IPD';
		}
		else{
			$admit_type = 'CATHLAB';
		}		
		
		
		$dataf['casu_status']		= 0;
		$dataf['casu_push']			= $admit_type;
		$dataf['casu_push_ward']	= $this->input->post('ward');
		
		$this->Crud_model->edit_record_by_anyid('casualty',$ipd_id,$dataf,'casu_id');
		
		//------****updating tbl ipd_admit****----//

		$data7['admit_ward'] 		= $this->input->post('ward');
		$data7['admit_floor'] 		= $this->input->post('floor');
		$data7['admit_bed'] 		= $this->input->post('bed');
		
		if($new_bed != ''){
			$data7['admit_status']		= 'CP';
		}
		else{
			$data7['admit_status']		= 'NA';
		}
		
		$data7['admit_ot_status']	= 0;
		$data7['admit_hide']		= 1;
		$data7['admit_type']		= $admit_type;
		//$data7['admit_exitdt'] 	 	= date("Y-m-d H:i:sa");
		
		$dataaa['maxshiftid'] = $this->Common_model->get_data_by_query('select admit_id from ipd_admit where admit_id ='.$ipd_id);
		$if_admit = $dataaa['maxshiftid'][0]['admit_id'];
		if($if_admit!='' ){
			
		$this->Crud_model->edit_record_by_anyid('ipd_admit',$ipd_id,$data7,'admit_id');
		}
		else{
			$datae['user_id'] 			= $userid;
			$datae['admit_uhid'] 		= $uhid;
			$datae['admit_id'] 			= $ipd_id;
			$datae['admit_ward'] 		= $this->input->post('ward');
			$datae['admit_floor'] 		= $this->input->post('floor');
			$datae['admit_bed'] 		= $this->input->post('bed');
			$datae['admit_entrydt'] 	= date("Y-m-d H:i:sa");
			$datae['admit_status']		= 'CP';
			$datae['admit_ot_status']	= 0;
			$datae['admit_type']		= $admit_type;
			$this->Crud_model->insert_record('ipd_admit',$datae);
			
			// echo $this->db->last_query();
			// die;
		}
		// } 
		// else{}
		
		//------****2nd updat tbl ipd_shift for ipd****----//
		$data['shift_exitdt'] = date("Y-m-d H:i:s");
		$data8['maxshiftid'] = $this->Common_model->get_data_by_query('select max(shift_id) as shift_id from ipd_shift where shift_uhid ='.$uhid.' and shift_ipd_id='.$ipd_id);
		
		if($data8['maxshiftid']!=null){
			
		foreach($data8['maxshiftid'] as $key => $maxshiftid ){}
		$this->Crud_model->edit_record_by_anyid('ipd_shift',$maxshiftid['shift_id'],$data,'shift_id');
	
		
		}
		
		//else{
			
		$data10['shift_entrydt'] 	= date("Y-m-d H:i:s");
		$data10['shift_uhid'] 		= $uhid;
		$data10['shift_ipd_id'] 	= $ipd_id;
		$data10['shift_ward'] 		= $this->input->post('ward');
		
		$this->Crud_model->insert_record('ipd_shift',$data10);
		
		$data9['status_resource'] =  0;
		$this->Crud_model->edit_record_resource('resource',$p_ipd_bed,$data9);
		
		$data11['status_resource'] =  1;
		$this->Crud_model->edit_record_resource('resource',$new_bed,$data11);
		
		
		//}
		

		//------****get duration****----//
		//$data3['duration'] = $this->Common_model->get_data_by_query('select shift_entrydt,shift_exitdt , TIMEDIFF( shift_exitdt , shift_entrydt) as dif from ipd_shift where shift_uhid ='.$uhid.' and shift_ipd_id='.$ipd_id.' and shift_id ='.$maxshiftid['shift_id'] );
		//foreach($data3['duration'] as $key => $duration){} 
		//$timediff = $duration['dif'];
		
		//------****Convert total hours into days****----//
		//$timediff1 = explode(":", $timediff);
		
		//$time =  ceil(($timediff1[0] + ($timediff1[1]/60))/24);	
		
		//-----*** fetching the ward name for the patient***---//
		// $data4['depart'] = $this->Common_model->get_data_by_query("select r_rate_appli from resource where r_id =".$p_ipd_bed );	
		// foreach($data4['depart'] as $key => $depart){ }
		// $depart = $depart['r_rate_appli'];
		
		////-----****Get the Rate for the Room***-----//	
		// $data5['amount'] = $this->Common_model->get_data_by_query("select ".$depart." from rate_master where rate_name='room-bed'" );
		// foreach($data5['amount'] as $key => $amount){ }
		// $amount = $amount[$depart]; //per day charge
		// $totalRate = $time * $amount;

		// $data6['tran_uhid']			= $uhid;	
		// $data6['tran_form_id']		= $ipd_id; //ipd_id of patient      
		// $data6['tran_duration']		= $time;
		// $data6['tran_amount']		= $totalRate;
		// $data6['tran_servic']		= lang($depart);
		// $data6['tran_department']	= 'Nursing';
		// $data6['tran_entrydt']		= date("Y-m-d H:i:sa");
		
		// $this->Crud_model->insert_record('transaction',$data6);
		
		if($redirect == 'reg') 
		{
			redirect('admin/FREG0006/frontview');
		}
		else 
		{
			redirect('admin/FREG0006/enquiry/');	
		}
	}
	
	else{
	redirect('auth/login');	
	}
	
	}
	
	public function allDataRate()
	{
		
		 $data11['count'] = $this->Common_model->get_data_by_query("select p.id,p.first_name,p.middle_name,p.last_name,p.patient_balance,p.scheme,p.consultant,a.admit_id,a.admit_uhid,a.admit_exitdt,a.admit_floor,a.admit_status,a.admit_ward,a.admit_bed,c.casu_id,c.casu_entrydt,c.casu_status from patient p 
			left join ipd_admit a on p.id = a.admit_uhid 
			left join casualty c on p.id = c.casu_uhid 
			where p.patient_reg_from not in ('OPD') and a.admit_status in ('CP','NA','DISCHARGED','LAMA') or c.casu_status = 1 order by c.casu_entrydt ");
		
			$currentpat=0;
			$dischage=0;
			$curentgenPat=0;
			foreach ($data11['count'] as $key=>$ft3)
                               {
								    if($ft3['admit_status']=='DISCHARGED'){
									   $dischage=$dischage+1;
								   }
								   else{
									   
									   $currentpat=$currentpat+1;
									   
									   if($ft3['scheme']==1)
									   {
										   $curentgenPat=$curentgenPat+1;
										   
									   }
									   
								   }
								   
								   
								   
							   }   
			
			$data['current_pat']=$currentpat;
			$data['discharge_pat']=$dischage;
			$data['cur_gen_pat']=$curentgenPat;
		
		// echo ' hello' ;
		
		?>
		Current Patient : <?php echo $data['current_pat'] ;?> discharge Patient:<?php echo $data['discharge_pat'] ;?> CGHS: CSMA: ECHS: BSNL: ESIC: BPL/DDY: MPBOC: Genaral: 
		<?php
		
	}
	
	public function readmit()
	{

		
		if($this->ion_auth->logged_in()){
				
			$this->template->set_template('user');
			$this->template->write_view('header', 'default/header', $this->session->userdata);
			$this->template->write_view('sidebar', 'default/sidebar');
	       $this->template->write_view('content', 'admin/FREG0006/readmit');
			$this->template->write_view('footer', 'default/footer');
			$this->template->render();
			}
			else{
			redirect('auth/login');	
			}
		
	}
	
	public function searchuhidreadmit()
	{
		if($this->ion_auth->logged_in()){
			
			
		
			
	  $first_name=$_GET['first_name'];
	  $last_name=$_GET['last_name'];
	  $uhid=$_GET['uhid'];
	  $fa_hus_name=$_GET['fa_hus_name'];
	  $contact_no=$_GET['contact_no'];
	  $rfid=$_GET['rfid'];
	
	  
	  
if($first_name !='')
{
$first_name =$first_name.'@first_name';
}  
if($last_name !='')
{
$last_name =$last_name.'@last_name';
}
if($uhid !='')
{
$uhid =$uhid.'@id';
}
if($fa_hus_name !='')
{
$fa_hus_name =$fa_hus_name.'@fa_hus_name';
}
if($contact_no !='')
{
$contact_no =$contact_no.'@contact_no';
}
if($rfid !='')
{
$rfid =$rfid.'@rfid';
}
$serchitem = array($first_name,$last_name,$uhid,$fa_hus_name,$contact_no,$rfid);
$querry='';
 foreach ($serchitem as &$value) {
if($value=='select')
{}
else if($value=='')
{}
else
{
    $value_aryy = explode ( "@", $value );
    $data = $value_aryy [0];
    $filed = $value_aryy [1];
	if($filed=='first_name')
	{
	  $querry .= " and first_name like '$data%' ";
	}
	else if($filed=='last_name')
	{
	  $querry .= " and last_name like '$data%' ";
	}
 else if($filed=='id')
	{
	  $querry .= " and id='$data'";
	}
else if($filed=='fa_hus_name')
	{
	  $querry .= " and fa_hus_name='$data'";
	}
	else if($filed=='contact_no')
	{
	  $querry .= " and contact_no='$data'";
	}
	else if($filed=='rfid')
	{
	  $querry .= " and rfid='$data'";
	}
	// else if($filed=='rfid')
	// {
	  // $querry .= " and rfid='$data'";
	// }
	
}
}
		 	$querry ;
		
		?>
		
		
							<tr role="row">
								<td >Sl</th>
								<td >UHID</th>
								<td >Patient Name</td>
								<td >Father/husband Name</td>
								<td >Age</td>
								<td >Contact</td>
								<td >Action</td>
							</tr>
<?php

 $sl=0;
	   $aa =$this->Common_model->get_data_by_query("select * from patient where id>0  $querry order by first_name limit 200");
	   
      //print_r($data['result']);
	  	   foreach ($aa as $key=>$ft)
                               {$sl++;
           ?>
       				
							   <tr class="odd">
                                <td class=" sorting_1D"><?php echo $sl;?></td>
                                <td class=" sorting_1D"><?php echo $ft['id'];?></td>
                                <td class=" "><?php echo $ft['first_name']." ".$ft['middle_name']." ".$ft['last_name']; ?></td>
                                <td class=" "><?php echo $ft['fa_hus_name'];?></td>
                                <td class=" "><?php echo $ft['patient_age'];?> <?php echo $ft['age_unit'];?></td>
                            
                                <td class=" "><?php echo $ft['contact_no'];?></td>
                        
                                <td class="">
								<a  href="<?php echo base_url().'admin/FREG0006/readmitForm/'.$ft['id'] ; ?>"  >
								  <button type="button" class="btn mini" style='background-color:#44DED8' value='1' >
									Readmit
								  </button> 
								</a>
								</td>
                               
                              </tr>
                             <?php   }  
	
			
			
			
		}
		else{
			redirect('auth/login');	
			}
		
	}
	
	function readmitForm()
	
	{
		
		if($this->ion_auth->logged_in()){
		
		$data['message'] = $this->session->flashdata('message');
	
	       $uhid = $this->uri->segment(4);
	       $data['state'] =$this->Address->state();
		   $data['district'] =$this->Address->district('24');
		   $data['scheme'] =$this->Address->scheme();
		   
		   //$data['doc_name'] =$this->doctor->getOPDDoctor();   
			$data['bpldisease'] = $this->Common_model->get_data_by_query('select DISTINCT  Disease_catigory from bpldisease ');
			  
			$data['result'] = $this->Common_model->get_data_by_query(" SELECT sc.scheme_name ,s.state_name,v.vill_name,t.tahsil,d.district,b.* FROM `patient` b  
			left join state s on s.state_id= b.state
			left join districmp d on d.id= b.district
			left join tahsil t on t.id= b.tehsil
			left join villmp v on v.id= b.village
			left join scheme sc on sc.id= b.scheme
			where b.id=$uhid ");
			
            $data['mediclam_company'] =$this->Common_model->get_data_by_query('select * from mediclam_company where medi_c_status=1');
			
            $data['doc_name'] =$this->Common_model->get_data_by_query("select * from doctor where id not in ('5','81') order by doc_name");

            $data1['re'] = $this->Common_model->get_data_by_query("select district,tehsil from patient where id = '$uhid'");

            $sch= $data['result'][0]['scheme'];
		   
		   if($sch==1)
		   {
	   $data['schmedata'] = $this->Common_model->get_data_by_query("select * from gen_patient where uhid=$uhid  order by id desc limit 1  "); 
		   }
		   elseif($sch==2 || $sch==3 || $sch==10)
		   {
	   $data['schmedata'] = $this->Common_model->get_data_by_query("select * from bpl_patient where uhid=$uhid order by id desc limit 1 ");  
		   }
		
		   elseif($sch==4 || $sch==5 || $sch==6 || $sch==7 || $sch==8 || $sch==9)
		   {
	   $data['schmedata'] = $this->Common_model->get_data_by_query("select * from cghs_patient where uhid=$uhid order by id desc limit 1");  
		   }
		   
		  
		   
		   foreach ($data1['re'] as $key=>$ft)
                               {
								   
							     $did= $ft['district'];
							     $tid= $ft['tehsil'];
								 $data['tehsilee']=$this->Common_model->get_data_by_query("select * from tahsil where district_id = '$did'");
								 $data['villll']=$this->Common_model->get_data_by_query("select * from villmp where tehsil_id = '$tid'");
							   
							   }        
			$data['casudata'] = $this->Common_model->get_data_by_query("select casu_remark from casualty where casu_uhid=$uhid order by casu_id desc limit 1");	

             // print_r($data['schmedata']);
		      // die();			
							   
	        $this->template->set_template('user');
			$this->template->write_view('header', 'default/header',$this->session->userdata);
			$this->template->write_view('sidebar', 'default/sidebar');
            $this->template->write_view('content', 'admin/FREG0006/readmitForm',$data);
			$this->template->write_view('footer', 'default/footer');
			$this->template->render();
		}
		
		else{
			redirect('auth/login');	
			}
		
	}
	
	function readmitSubmit()
	{
		
		   if($this->ion_auth->logged_in()){
			   
			   
			    $uhid = $this->input->post('uid');
			 
	         $data['first_name'] = $this->input->post('first_name');
			 $data['middle_name'] = $this->input->post('middle_name');
			 $data['last_name'] = $this->input->post('last_name');
			 $data['fa_hus_name'] = $this->input->post('fa_hus_name');
			 $data['patient_gender'] = $this->input->post('patient_gender');
			 $data['patient_age'] = $this->input->post('patient_age');
			 $data['age_unit'] = $this->input->post('age_unit');
			 $data['state'] = $this->input->post('state');
			 $data['district'] = $this->input->post('district');
			 $data['tehsil'] = $this->input->post('tahsil');
			 $data['village'] = $this->input->post('village');
			 $data['address'] = $this->input->post('address');
			 $data['email_id'] = $this->input->post('email_id');
			 $data['contact_no'] = $this->input->post('contact_no');
			 $data['reg_admited_by'] = $this->input->post('reg_admited_by');
			 $data['reg_relation_with_patient'] = $this->input->post('reg_relation_with_patient');
			 $data['reg_attender_contact'] = $this->input->post('reg_attender_contact');
			 $data['mlc_case'] = $this->input->post('mlc_case');
			 $data['consultant'] = $this->input->post('consultant');
			 $data['son_or_wife'] = $this->input->post('son_or_wife');
			 
			 
			
			 
			 $datapat['all']=$this->Common_model->get_data_by_query("select * from patient where id = '$uhid'");
			 
			 $oldsch=$datapat['all'][0]['scheme'] ;
			 
			 $data['scheme'] = $this->input->post('scheme');
			 $newschme = $this->input->post('scheme');
			 $this->Crud_model->edit_record('patient',$uhid,$data);
			 
			 	 if($this->input->post('mlc_case')=='No')
			 {
				 
				 $mlc_gen='General';
			 }
			 elseif($this->input->post('mlc_case')=='Yes')
			 { 
			     $mlc_gen='MLC';
				 
			 }
			 
			 
			   $datacasu['casu_remark'] = $this->input->post('casu_remark');
			
			    $casu="Casualty";
				$data1['casu_uhid']  		 = $uhid;
				$data1['casu_fname']  		 = $this->input->post('first_name');
				$data1['casu_mname']  		 = $this->input->post('middle_name');
				$data1['casu_lname']  		 = $this->input->post('last_name');
				$data1['casu_age']  		 = $this->input->post('patient_age');
				$data1['casu_gender'] 	 	 = $this->input->post('patient_gender');
				$data1['casu_bed'] 	 	 	 = 'bed-1';
				$data1['casu_addr']		 	 = $this->input->post('address');
				$data1['casu_pcase']		 = $mlc_gen;
				$data1['casu_mob']		 	 = $this->input->post('contact_no');;
 				$data1['casu_patient_type']  = $casu;
				$data1['casu_pushdt'] 		 = date('Y-m-d H:i:sa') ;
				
 				$data1['casu_entrydt']	     = date('Y-m-d H:i:sa') ;
				$data1['casu_consultent']  = $this->input->post('consultant');
				$data1['casu_consultent_reg']  = $this->input->post('consultant');
				$data1['casu_remark']  = $this->input->post('casu_remark');
				
				$data1['admited_by']  = $this->input->post('reg_admited_by');
				$data1['relation_with_patient']  = $this->input->post('reg_relation_with_patient');
				$data1['attender_contact']  = $this->input->post('reg_attender_contact');
				$data1['casu_scheme']  = $newschme;
				
			 
		    $this->Crud_model->insert_record('casualty',$data1);
			
			
			$casu_id = $this->GenrateID->getidMax('casualty','casu_id');
			
			$data4['assessm_uhid']  	= $uhid;
			$data4['assessm_casuid'] 	= $casu_id;
			
			$data7['shift_uhid']  	= $uhid;
			$data7['shift_ipdid'] 	= $casu_id;
			
			$data6['initial_uhid']  	= $uhid;
			$data6['initial_casu_id'] 	= $casu_id;
			$data5['pris_casu_id'] 		= $casu_id;
			$data5['pris_uhid']  		= $uhid;
			
			$this->Crud_model->insert_record('casualty_assessment',$data4);
			$this->Crud_model->insert_record('casualty_shift',$data7);
			$this->Crud_model->insert_record('initial_assessment',$data6);
			$this->Crud_model->insert_record('casualty_pris',$data5);
		
			if($data['scheme']=='1')
			{
			 $datagen['id'] = $this->GenrateID->getid('gen_patient');
			 $datagen['uhid'] =$uhid;
			 $datagen['admited_by'] = $this->input->post('reg_admited_by');
			 $datagen['relation_with_patient'] = $this->input->post('reg_relation_with_patient');
			 $datagen['attender_contact'] = $this->input->post('reg_attender_contact');
			 $datagen['gen_pa_ipdid'] = $casu_id;
			 
			 $this->Crud_model->insert_record('gen_patient',$datagen);
			
			}
			else if($data['scheme']=='2')
			{
			 $databpl['id'] = $this->GenrateID->getid('bpl_patient');
			 $databpl['uhid'] =$uhid;
			 $databpl['admited_by'] = $this->input->post('reg_admited_by');
			 $databpl['relation_with_patient'] = $this->input->post('reg_relation_with_patient');
			 $databpl['attender_contact'] = $this->input->post('reg_attender_contact');
			 
			 $databpl['patient_cat'] = $this->input->post('bplpatient_cat');
			 $databpl['employment'] = $this->input->post('bplemployment');
			 $databpl['income'] = $this->input->post('bplincome');
			 $databpl['card_no'] = $this->input->post('bplcard_no');
			 $databpl['cardholdername'] = $this->input->post('bplcardholdername');
			 $databpl['pincode'] = $this->input->post('bplpincode');
			 $databpl['disease_cat'] = $this->input->post('bpldisease_cat');
			 $databpl['dis_name'] = $this->input->post('bpldis_name');
			 $databpl['scheme_type'] = '2';
			 $databpl['bpl_admit_date'] = date('Y-m-d');
			 $databpl['bpl_reg_date'] =date('Y-m-d h-i-s') ;
			 $databpl['bpl_ipd_id'] =$casu_id;
			 $this->Crud_model->insert_record('bpl_patient',$databpl);
			
			}
			else if($data['scheme']=='3')
			{
			     $datampboc['id'] = $this->GenrateID->getid('bpl_patient');
			     $datampboc['uhid'] =$uhid;
			     $datampboc['admited_by'] = $this->input->post('reg_admited_by');
			     $datampboc['relation_with_patient'] = $this->input->post('reg_relation_with_patient');
			     $datampboc['attender_contact'] = $this->input->post('reg_attender_contact');
			     $datampboc['card_no'] = $this->input->post('mpboccard_no');
			     $datampboc['cardholdername'] = $this->input->post('mpboccardholdername');
			     $datampboc['disease_cat'] = $this->input->post('mpbocdisease_cat');
			     $datampboc['dis_name'] = $this->input->post('mpbocdis_name');
			     $datampboc['bpl_admit_date'] = date('Y-m-d');
			     $datampboc['scheme_type'] = '3';
				 $datampboc['bpl_reg_date'] =date('Y-m-d h-i-s') ;
				 $datampboc['bpl_ipd_id'] =$casu_id;
			       
				   $this->Crud_model->insert_record('bpl_patient',$datampboc);
			
			}
			else if($data['scheme']=='4' )
			{
			 $datacghs['id'] = $this->GenrateID->getid('cghs_patient');
			 $datacghs['uhid'] =$uhid;
			 $datacghs['admited_by'] = $this->input->post('reg_admited_by');
			 $datacghs['relation_with_patient'] = $this->input->post('reg_relation_with_patient');
			 $datacghs['attender_contact'] = $this->input->post('reg_attender_contact');
			 $datacghs['card_holder_name'] = $this->input->post('cghscard_holder_name');
			 $datacghs['card_no'] = $this->input->post('cghscard_no');
			 $datacghs['card_holder_relation'] = $this->input->post('cghscard_holder_relation');
			 $datacghs['case'] = $this->input->post('case');
			 $datacghs['entitilment'] = $this->input->post('entitilment');
			 $datacghs['validity'] = $this->input->post('validity');
			 $datacghs['cghs_opdipd'] = 'IPD';
			 $datacghs['scheme_type'] = $data['scheme'];
			 $datacghs['cghs_opdipd_id'] = $casu_id;
		     $this->Crud_model->insert_record('cghs_patient',$datacghs);
			}
			else if($data['scheme']=='5')
			{
			 $datacsma['id'] = $this->GenrateID->getid('cghs_patient');
			 $datacsma['uhid'] =$uhid;
			 $datacsma['admited_by'] = $this->input->post('reg_admited_by');
			 $datacsma['relation_with_patient'] = $this->input->post('reg_relation_with_patient');
			 $datacsma['attender_contact'] = $this->input->post('reg_attender_contact');
			 $datacsma['card_holder_name'] = $this->input->post('csmacard_holder_name');
			 $datacsma['card_no'] = $this->input->post('csmacard_no');
			 $datacsma['card_holder_relation'] = $this->input->post('csmacard_holder_relation');
			 $datacsma['case'] = $this->input->post('csmacase');
			 $datacsma['entitilment'] = $this->input->post('csmaentitilment');
			 $datacsma['cghs_opdipd'] = 'IPD';
			 $datacsma['scheme_type'] = $data['scheme'];
			 $datacsma['cghs_opdipd_id'] = $casu_id;
		
			
			 $this->Crud_model->insert_record('cghs_patient',$datacsma);
			}
			else if($data['scheme']=='6')
			{
			 $dataechs['id'] = $this->GenrateID->getid('cghs_patient');
			 $dataechs['uhid'] =$uhid;
			 $dataechs['admited_by'] = $this->input->post('reg_admited_by');
			 $dataechs['relation_with_patient'] = $this->input->post('reg_relation_with_patient');
			 $dataechs['attender_contact'] = $this->input->post('reg_attender_contact');
			 $dataechs['card_holder_name'] = $this->input->post('echscard_holder_name');
			 $dataechs['card_no'] = $this->input->post('echscard_no');
			 $dataechs['card_holder_relation'] = $this->input->post('echscard_holder_relation');
			 $dataechs['case'] = $this->input->post('echscase');
			 $dataechs['entitilment'] = $this->input->post('echsentitilment');
			 $dataechs['validity'] = $this->input->post('echsvalidity');
			 $dataechs['cghs_opdipd'] = 'IPD';
			 $dataechs['scheme_type'] = $data['scheme'];
			 $dataechs['cghs_opdipd_id'] = $casu_id;
			 $this->Crud_model->insert_record('cghs_patient',$dataechs);
			  
			}
			else if($data['scheme']=='7')
			{
			 $dataesi['id'] = $this->GenrateID->getid('cghs_patient');
			 $dataesi['uhid'] =$uhid;
			 $dataesi['admited_by'] = $this->input->post('reg_admited_by');
			 $dataesi['relation_with_patient'] = $this->input->post('reg_relation_with_patient');
			 $dataesi['attender_contact'] = $this->input->post('reg_attender_contact');
			 $dataesi['card_holder_name'] = $this->input->post('esicard_holder_name');
			 $dataesi['card_no'] = $this->input->post('esicard_no');
			 $dataesi['case'] = $this->input->post('esicase');
			 $dataesi['cghs_opdipd'] = 'IPD';
			 $dataesi['card_holder_relation'] = $this->input->post('esicard_holder_relation');
			 
			 $dataesi['scheme_type'] = $data['scheme'];
			 $dataesi['cghs_opdipd_id'] = $casu_id;
			
			$this->Crud_model->insert_record('cghs_patient',$dataesi);
			}
			else if($data['scheme']=='8')
			{
			 $databsnl['id'] = $this->GenrateID->getid('cghs_patient');
			 $databsnl['uhid'] =$uhid;
			 $databsnl['admited_by'] = $this->input->post('reg_admited_by');
			 $databsnl['relation_with_patient'] = $this->input->post('reg_relation_with_patient');
			 $databsnl['attender_contact'] = $this->input->post('reg_attender_contact');
			 $databsnl['card_holder_name'] = $this->input->post('bsnlcard_holder_name');
			 $databsnl['card_no'] = $this->input->post('bsnlcard_no');
			 $databsnl['card_holder_relation'] = $this->input->post('bsnlcard_holder_relation');
			 $databsnl['scheme_type'] = $data['scheme'];
			 $databsnl['cghs_opdipd'] = 'IPD';
			 $databsnl['cghs_opdipd_id'] = $casu_id;
			
			$this->Crud_model->insert_record('cghs_patient',$databsnl);
			}
			else if($data['scheme']=='9')
			{
			 $datamedi['id'] = $this->GenrateID->getid('cghs_patient');
			 $datamedi['uhid'] =$uhid;
			 $datamedi['admited_by'] = $this->input->post('reg_admited_by');
			 $datamedi['relation_with_patient'] = $this->input->post('reg_relation_with_patient');
			 $datamedi['attender_contact'] = $this->input->post('reg_attender_contact');
			 
			 $datamedi['scheme_type'] = $data['scheme'];
			 $datamedi['cghs_opdipd'] = 'IPD';
			 $datamedi['cghs_opdipd_id'] = $casu_id;
			 $datamedi['mediclaim_comp'] = $this->input->post('mediclaim_comp');
			
			 $this->Crud_model->insert_record('cghs_patient',$datamedi);
			 
			         
			 
			}
				else if($data['scheme']=='10')
			{
			 $databpl['id'] = $this->GenrateID->getid('bpl_patient');
			 $databpl['uhid'] =$uhid;
			 $databpl['admited_by'] = $this->input->post('reg_admited_by');
			 $databpl['relation_with_patient'] = $this->input->post('reg_relation_with_patient');
			 $databpl['attender_contact'] = $this->input->post('reg_attender_contact');
			 $databpl['patient_cat'] = $this->input->post('bplpatient_cat');
			 $databpl['employment'] = $this->input->post('bplemployment');
			 $databpl['income'] = $this->input->post('bplincome');
			 $databpl['card_no'] = $this->input->post('bplcard_no');
			 $databpl['cardholdername'] = $this->input->post('bplcardholdername');
			 $databpl['pincode'] = $this->input->post('bplpincode');
			 $databpl['disease_cat'] = $this->input->post('bpldisease_cat');
			 $databpl['dis_name'] = $this->input->post('bpldis_name');
			 $databpl['scheme_type'] = '10';
			 $databpl['bpl_admit_date'] = date('Y-m-d');
			 $databpl['bpl_reg_date'] =date('Y-m-d h-i-s') ;
			 $databpl['bpl_ipd_id'] =$casu_id;
			 $this->Crud_model->insert_record('bpl_patient',$databpl);
			
			}
			
			
			
		  $this->session->set_flashdata('message', 'Patient Registration is done Successfully UHID of Patienet is :'.$uhid.':reg No :'.$casu_id);
		     redirect('admin/FREG0006');


		  }
		else{
			redirect('auth/login');	
			}
		
	}

	
	public function searchrfid()
	{
	  $rfid=$_GET['rfid'];
	 
	  // $rfid=$_GET['rfid'];
	
	// if($rfid=="")
	// {
		// $rfid="";
		
	// }
	
	
 	// if($rfid !='')
// {
// $rfid =$rfid.'@rfid';
// }

	if($rfid !='')
{
$rfid =$rfid.'@rfid';
}

	 

$serchitem = array($rfid);

$querry='';
 foreach ($serchitem as &$value) 
{

if($value=='select')
{
}
else if($value=='')
{
}
else
{
	
    $value_aryy = explode ( "@", $value );
    $data = $value_aryy [0];
    $filed = $value_aryy [1];
	
	
  if($filed=='rfid')
	{
	  // $querry .= " and rfid='$data'";
	   $querry .= " and ".$filed." like "."'%".$data."%'";
	}

	// else if($filed=='rfid')
	// {
	  // $querry .= " and rfid='$data'";
	
	// }
	
}

  
}


?>

     <tr role="row">
                                <td>UHID</th>
                                <td>Patient Name</td>
								<td>Father/husband Name</td>
                                <!--<td >Age</td>-->
                          
                                <!--<th class="sorting" role="columnheader" tabindex="0" aria-controls="sample_editable_1" rowspan="1" colspan="1" aria-label="Delete: activate to sort column ascending" style="width: 127px;">Gender</th>-->
                                <td>Contact</td>
                                <td>Card Status</td>
                                <td>Action</td>
                                <td></td>
                              </tr>
				<?php
				$aa =$this->Common_model->get_data_by_query("select * from patient where id>0  $querry order by id desc limit 100 ");

				foreach ($aa as $key=>$ft)
                {
				?>
       				
							   <tr class="odd">
                                <td class=" sorting_1"><?php echo $ft['id'];?></td>
                                <td class=" "><?php echo $ft['first_name']." ".$ft['middle_name']." ".$ft['last_name']; ?></td>
                                <td class=" "><?php echo $ft['fa_hus_name'];?></td>
                                <!--<td class=" "><?php echo $ft['patient_age'];?>  <?php echo $ft['age_unit'];?></td>-->
                                <td class=" "><?php echo $ft['contact_no'];?></td>
                                <td class=" "><?php if($ft['rfid']=='') { ?><span class='text-success' ><label>Not Generated</label></span>
								<?php } else{ ?><span><label>Generated</label></span><?php }?>
								<!---style='color:purple;font-style: italic'---->
								</td>
                        
                                <td class="">
								<a  href="javascript:void(0); #portlet-config" data-toggle="modal" class="config" onclick="genrateBarcode('<?php echo $ft['id'] ;?>')" >
								  <button type="button" class="btn mini" style='background-color:#44DED8' value='1' >
									Scan  Card
								 </button> 
								</a>
								</td>
                                <td class="">
								<a class="" href="javascript:printDiv('<?php echo $ft['id'];?>')" title="Delete Record"> 
								
								   <button type="button" class="btn mini" style='background-color:#44DED8;' value='1' >
									Print  Card
									</button> 
								</a>
								</td>
                              </tr>
                             <?php   }  
	
	
	}

	public function entry_frontview()
	{
	if($this->ion_auth->logged_in())
	{
		$user=$this->session->userdata('user_id');
		$this->template->set_template('user');
		$this->template->write_view('header', 'default/header',$this->session->userdata);
		$this->template->write_view('sidebar', 'default/sidebar');
		
			$currdate= date ('Y/m/d' ,time() + 86400);
			$currentmonth = date('m');
			$currentyear = date('Y');
			
			$begin = new DateTime("$currentyear/$currentmonth/01");
			$end = new DateTime("$currdate");
			
			$daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
			//-----------------------------------------------Percentage of Re-Dues Laboratory------------------------------------------------------------
			$data['new'] = array(); 
			
			$y=date('Y');
			$m=date('m');
			$d1=$y."-".$m."-"."01";
			$d2=$y."-".$m."-"."01";
			// $d1="2015-12-01";
			$d2=date("Y-m-d");
			$start=strtotime($d1);
			$end=strtotime($d2);
			$diff=(($end-$start)/3600)/24;
			$data['new1'] = array(); 
			$d1=$y."-".$m."-"."00";
			for($i=0;$i<=$diff;$i++)
			{
			$fetchdata=9;
			$fetchd3=0;
			
		    $d1=date("Y-m-d", strtotime("+1day", strtotime($d1)));
		    $ssbpl1=$this->Common_model->getEntryOnDate("opd_patient","date",$d1);
			array_push($data['new'],$ssbpl1);
	          }
			
			
			  
			  //--------------------Casualty--------------------
			 $data['new2'] = array(); 
			
			$dcasu=$y."-".$m."-"."00";
			
		for($i=0;$i<=$diff;$i++)
			{
			$fetchdata=9;
			$fetchd3=0;
			
		    $dcasu=date("Y-m-d", strtotime("+1day", strtotime($dcasu)));
		    $ssbpl1=$this->Common_model->getEntryOnDate("casualty","casu_entrydt",$dcasu);
			$sscasu2=$this->Common_model->getEntryOnDate("casualty_assessment","assessm_entrydt",$dcasu);
    		$sscasu3=$this->Common_model->getEntryOnDate("initial_assessment","initial_entrydt",$dcasu);
			array_push($data['new2'],$ssbpl1+$sscasu2+$sscasu3);
	          }
			
			    //--------------------X-Ray--------------------
			 
				
			$data['new3'] = array(); 
			
			$d3=$y."-".$m."-"."00";
			
		for($i=0;$i<=$diff;$i++)
			{
			$fetchdata=9;
			$fetchd3=0;
			
		    $d3=date("Y-m-d", strtotime("+1day", strtotime($d3)));
		    $ssbpl1=$this->Common_model->getEntryOnDate("xray_upload","xupload_entrydt",$d3);
			array_push($data['new3'],$ssbpl1);
	          }
		
		
		
		
		
		
			  
			  
			   //--------------------CGHS--------------------
				$data['new4'] = array(); 
			
			$d4=$y."-".$m."-"."00";
			
		for($i=0;$i<=$diff;$i++)
			{
			$fetchdata=9;
			$fetchd3=0;
			
		    $d4=date("Y-m-d", strtotime("+1day", strtotime($d4)));
		    $ssbpl1=$this->Common_model->getEntryOnDate("cghs_patient","cghs_entry_date",$d4);
			$sscghs2=$this->Common_model->getEntryOnDate("cghs_emergency","cghs_em_creat_dt",$d4);
    		$sscghs3=$this->Common_model->getEntryOnDate("cghs_gatepass","gp_entrydt",$d4);
    		$sscghs4=$this->Common_model->getEntryOnDate("cghs_transaction","cghs_tran_entrydt",$d4);
    		$sscghs5=$this->Common_model->getEntryOnDate("estimate_bill","entrydt",$d4);
			
			
			array_push($data['new4'],$ssbpl1+$sscghs2+$sscghs3+$sscghs4+$sscghs5);
	          }
		   //--------------------BPL--------------------
			 
			$data['new5'] = array(); 
			
			$d5=$y."-".$m."-"."00";
			
		for($i=0;$i<=$diff;$i++)
			{
			$fetchdata=9;
			$fetchd3=0;
			
		    $d5=date("Y-m-d", strtotime("+1day", strtotime($d5)));
		    $ssbpl1=$this->Common_model->getEntryOnDate("bpl_bill","bpl_bill_date",$d5);
			$ssbpl2=$this->Common_model->getEntryOnDate("bpl_estimate","bpl_est_date",$d5);
    		$ssbpl3=$this->Common_model->getEntryOnDate("bpl_patient","bpl_reg_date",$d5);
    		
			
			
			array_push($data['new5'],$ssbpl1+$ssbpl2+$ssbpl3);
	          }
			
			
			$data['new7'] = array(); 
			
			$d7=$y."-".$m."-"."00";
			
		for($i=0;$i<=$diff;$i++)
			{
			$fetchdata=9;
			$fetchd3=0;
			
		    $d7=date("Y-m-d", strtotime("+1day", strtotime($d7)));
		    $ssbpl1=$this->Common_model->getEntryOnDate("hr_adv","adv_entrydt",$d7);
			$ssbpl2=$this->Common_model->getEntryOnDate("hr_adv_emi_details","emi_entrydt",$d7);
    		
    		$ssbpl4=$this->Common_model->getEntryOnDate("hr_challan","chal_entrydt",$d7);
    		$ssbpl5=$this->Common_model->getEntryOnDate("hr_circular","circu_entrydt",$d7);
    		$ssbpl6=$this->Common_model->getEntryOnDate("hr_dependent","depn_entrydt",$d7);
    		$ssbpl7=$this->Common_model->getEntryOnDate("hr_emppackage","emppac_entrydt",$d7);
    		$ssbpl8=$this->Common_model->getEntryOnDate("hr_esi","esi_entrydt",$d7);
    		$ssbpl9=$this->Common_model->getEntryOnDate("hr_exit_interview","exit_entrydt",$d7);
    		$ssbpl0=$this->Common_model->getEntryOnDate("hr_resignation","resig_entrydt",$d7);
    		$ssbpl11=$this->Common_model->getEntryOnDate("hr_security","sec_entrydt",$d7);
    		$ssbpl12=$this->Common_model->getEntryOnDate("hr_work_order","order_entrydt",$d7);
    		$ssbpl13=$this->Common_model->getEntryOnDate("employee","emp_entrydt",$d7);
    		$ssbpl14=$this->Common_model->getEntryOnDate("employee_doc","edoc_entrydt",$d7);
    		
			
			
			array_push($data['new7'],$ssbpl1+$ssbpl2+$ssbpl4+$ssbpl5+$ssbpl6+$ssbpl7+$ssbpl8+$ssbpl9+$ssbpl0+$ssbpl11+$ssbpl12+$ssbpl13+$ssbpl14);
	          }
			
			
			
			
			
			
		
			
		$data['new6'] = array(); 
		
			$d4=$y."-".$m."-"."00";
		
		
			
			for($i=0;$i<=$diff;$i++)
			{
			$fetchdata=9;
			$fetchd3=0;
			
		    $d4=date("Y-m-d", strtotime("+1 day", strtotime($d4)));
		    $ssbpl1=$this->Common_model->getEntryOnDate("patho_allot_test","date",$d4);
    
			
		
					array_push($data['new6'],$ssbpl1);
	          }
			  
			 $data['new8'] = array(); 
		
			$d8=$y."-".$m."-"."00"; 
			  
			 
			  for($i=1;$i<=$diff;$i++)
			{
			$fetchdata=9;
			$fetchd3=0;
			
		    $d8=date("Y-m-d", strtotime("+1day", strtotime($d8)));
		    $ssbpl1=$this->Common_model->getEntryOnDate("patient_discharge","pdis_entrydt",$d8);
			array_push($data['new8'],$ssbpl1);
	          }
			   $data['new9'] = array(); 
		
			$d9=$y."-".$m."-"."00"; 
			   for($i=0;$i<=$diff;$i++)
			{
			$fetchdata=9;
			$fetchd3=0;
			
		    $d9=date("Y-m-d", strtotime("+1day", strtotime($d9)));
		    $ssbpl1=$this->Common_model->getBillingOnDate("smcard_topup","topup_entrodt",$d9);
			array_push($data['new9'],$ssbpl1);
	          }
			  
			   $data['new10'] = array(); 
		
			$d10=$y."-".$m."-"."00";
			  for($i=0;$i<=$diff;$i++)
			{
			$fetchdata=9;
			$fetchd3=0;
			
		    $d10=date("Y-m-d", strtotime("+1day", strtotime($d10)));
		    $ssbpl1=$this->Common_model->getEntryOnDate("market_pat_agents_pro","assigned_enty_date",$d10);
			array_push($data['new10'],$ssbpl1);
	          }
			  
			   $data['new44'] = array(); 
		
			$d44=$y."-".$m."-"."00"; 
			  
			 
			  for($i=1;$i<=$diff;$i++)
			{
			$fetchdata=9;
			$fetchd3=0;
			
		    $d44=date("Y-m-d", strtotime("+1day", strtotime($d44)));
		    $ssbpl1=$this->Common_model->getEntryOnDate("continuation_sheet","cont_entrydt",$d44);
		    $ssbpl2=$this->Common_model->getEntryOnDate("nursef_cann_cathe","Cann_intentrydt",$d44);
		    $ssbpl3=$this->Common_model->getEntryOnDate("nursef_consultation","genr_entrydt",$d44);
		    $ssbpl4=$this->Common_model->getEntryOnDate("nursef_dose","dose_entrydt",$d44);
			
		    $ssbpl5=$this->Common_model->getEntryOnDate("nursef_glycaemic","glyca_entrydt",$d44);
			
		    $ssbpl6=$this->Common_model->getEntryOnDate("nursef_intakeop","intake_entrydt",$d44);
		    $ssbpl7=$this->Common_model->getEntryOnDate("nursef_intubation","int_intentrydt",$d44);
		    $ssbpl8=$this->Common_model->getEntryOnDate("nursf_dressing","dressing_entrydt",$d44);
		    $ssbpl9=$this->Common_model->getEntryOnDate("nursf_neuro_obs","neuro_entyrdt",$d44);
			
		   
			array_push($data['new44'],$ssbpl1+$ssbpl2+$ssbpl3+$ssbpl4+$ssbpl5+ $ssbpl6+$ssbpl7+$ssbpl8+$ssbpl9);
	          }
			  
			  
			 
			  
			 
			
			// print_r($data['new44']);
			// die();
			
		$this->template->write_view('content', 'admin/FREG0006/entry_frontview',$data);
		$this->template->write_view('footer', 'default/footer');
		$this->template->render();
	}
		else
		{
			 redirect('auth/login');	
		}		
	}
	

	public function hr_approval()
	{
		$data['chal_pending'] = $this->Common_model->get_data_by_query("select count(*) as pending from hr_challan where chal_approve = 1 ");
		$data['adv_pending'] = $this->Common_model->get_data_by_query('SELECT count(*) as pending FROM `hr_adv` where adv_approved_status =0');
		$data['incr_pending'] = $this->Common_model->get_data_by_query('select count(*) as pending from hr_increment where incr_forward_status =3 ');
		$data['noti_pending'] = $this->Common_model->get_data_by_query("select count(*) as pending from hr_notice where noti_approve = 1 ");
		$data['warn_pending'] = $this->Common_model->get_data_by_query("select count(*) as pending from hr_warning where hrwarn_approve =1");
		$data['circu_pending'] = $this->Common_model->get_data_by_query("select count(*) as pending from hr_circular where circu_approve = 1");
		$data['ord_pending'] = $this->Common_model->get_data_by_query("select count(*) as pending from hr_order where ord_approve = 1");
		$data['work_pending'] = $this->Common_model->get_data_by_query("select count(*) as pending from hr_work_order where order_approve = 1");
		$data['req_pending'] = $this->Common_model->get_data_by_query("select count(*) as pending from hr_manpower where approve_status  = 2");
		
		$this->template->set_template('user');
		$this->template->write_view('header', 'default/header',$this->session->userdata);
		$this->template->write_view('sidebar', 'default/sidebar');
		$this->template->write_view('content', 'admin/FREG0006/hr_approval',$data);
		$this->template->write_view('footer', 'default/footer');
		$this->template->render();
	}
	public function chal_approval()
	{
		$this->template->set_template('user');
		$this->template->write_view('header', 'default/header',$this->session->userdata);
		$this->template->write_view('sidebar', 'default/sidebar');
		
		$data['chal_pendings'] = $this->Common_model->get_data_by_query("select * from hr_challan  c left join employee e on e.emp_id = c.chal_empid where 0=0  and chal_approve = 1 order by chal_date desc ");
		
		$data['chal_approved'] = $this->Common_model->get_data_by_query("select * from hr_challan  c left join employee e on e.emp_id = c.chal_empid where 0=0  and chal_approve = 0 order by chal_date desc ");
		
		$data['chal_declined'] = $this->Common_model->get_data_by_query("select * from hr_challan  c left join employee e on e.emp_id = c.chal_empid where 0=0  and chal_approve = 2 order by chal_date desc ");
		
		$this->template->write_view('content', 'admin/FREG0006/chal_approval',$data);
		$this->template->write_view('footer', 'default/footer');
		$this->template->render();
	}
	public function adv_approval()
	{
		$this->template->set_template('user');
		$this->template->write_view('header', 'default/header',$this->session->userdata);
		$this->template->write_view('sidebar', 'default/sidebar');
		
		$data['adv_pendings'] = $this->Common_model->get_data_by_query('SELECT hradv.*,e.emp_id,e.emp_name,e.emp_doj, dep.dep_id, dep.dep_name FROM `hr_adv` hradv left join employee e on e.emp_id=hradv.adv_empid left join department dep on dep.dep_id = e.emp_dep  where 0=0 and adv_approve = 1 order by adv_id desc');
		
		$data['adv_approved'] = $this->Common_model->get_data_by_query('SELECT hradv.*,e.emp_id,e.emp_name,e.emp_doj, dep.dep_id, dep.dep_name FROM `hr_adv` hradv left join employee e on e.emp_id=hradv.adv_empid left join department dep on dep.dep_id = e.emp_dep  where 0=0 and adv_approve = 0 order by adv_id desc');
		
		$data['adv_declined'] = $this->Common_model->get_data_by_query('SELECT hradv.*,e.emp_id,e.emp_name,e.emp_doj, dep.dep_id, dep.dep_name FROM `hr_adv` hradv left join employee e on e.emp_id=hradv.adv_empid left join department dep on dep.dep_id = e.emp_dep  where 0=0 and adv_approve = 2 order by adv_id desc');
		
		$this->template->write_view('content', 'admin/FREG0006/adv_approval',$data);
		$this->template->write_view('footer', 'default/footer');
		$this->template->render();
	}
	public function increment_approval()
	{
		$this->template->set_template('user');
		$this->template->write_view('header', 'default/header',$this->session->userdata);
		$this->template->write_view('sidebar', 'default/sidebar');
		
		$data['incr_pendings'] = $this->Common_model->get_data_by_query('select * from hr_mannual_increment i left join employee e  on e.emp_id=i.mincr_empid left join department d on d.dep_id=i.mincr_dep where mincr_status=1 and mincr_approve = 1 order by mincr_id desc');
		
		$data['incr_approved'] = $this->Common_model->get_data_by_query('select * from hr_mannual_increment i left join employee e  on e.emp_id=i.mincr_empid left join department d on d.dep_id=i.mincr_dep where mincr_status=1 and mincr_approve = 0 order by mincr_id desc');
		
		$data['incr_declined'] = $this->Common_model->get_data_by_query('select * from hr_mannual_increment i left join employee e  on e.emp_id=i.mincr_empid left join department d on d.dep_id=i.mincr_dep where mincr_status=1 and mincr_approve = 2 order by mincr_id desc');
		
		$this->template->write_view('content', 'admin/FREG0006/increment_approval',$data);
		$this->template->write_view('footer', 'default/footer');
		$this->template->render();
	}
	public function notice_approval()
	{
		$this->template->set_template('user');
		$this->template->write_view('header', 'default/header',$this->session->userdata);
		$this->template->write_view('sidebar', 'default/sidebar');
		
		$data['noti_pendings'] = $this->Common_model->get_data_by_query("select * from hr_notice w 
		left join employee e on e.emp_id=w.noti_to 
		where noti_status=1 and noti_approve = 1 ");
		
		$data['noti_approved'] = $this->Common_model->get_data_by_query("select * from hr_notice w left join employee e on e.emp_id=w.noti_not_no where noti_status=1 and noti_approve = 0 ");
		
		$data['noti_declined'] = $this->Common_model->get_data_by_query("select * from hr_notice w left join employee e on e.emp_id=w.noti_not_no where noti_status=1 and noti_approve = 2 ");
		
		$this->template->write_view('content', 'admin/FREG0006/notice_approval',$data);
		$this->template->write_view('footer', 'default/footer');
		$this->template->render();
	}
	public function warning_approval()
	{
		$this->template->set_template('user');
		$this->template->write_view('header', 'default/header',$this->session->userdata);
		$this->template->write_view('sidebar', 'default/sidebar');
		
		$data['warn_pendings']=$this->Common_model->get_data_by_query("select * from hr_warning where hrwarn_approve = 1");
		$data['warn_approved']=$this->Common_model->get_data_by_query("select * from hr_warning where hrwarn_approve = 0");
		$data['warn_declined']=$this->Common_model->get_data_by_query("select * from hr_warning where hrwarn_approve = 2");
		
		$this->template->write_view('content', 'admin/FREG0006/warning_approval',$data);
		$this->template->write_view('footer', 'default/footer');
		$this->template->render();
	}
	public function circular_approval()
	{
		$this->template->set_template('user');
		$this->template->write_view('header', 'default/header',$this->session->userdata);
		$this->template->write_view('sidebar', 'default/sidebar');
		
		$data['circu_pendings'] = $this->Common_model->get_data_by_query("select * from hr_circular w left join employee e on e.emp_id=w.circu_cir_no where circu_status=1 and circu_approve = 1");
		
		$data['circu_approved'] = $this->Common_model->get_data_by_query("select * from hr_circular w left join employee e on e.emp_id=w.circu_cir_no where circu_status=1 and circu_approve = 0");
		
		$data['circu_declined'] = $this->Common_model->get_data_by_query("select * from hr_circular w left join employee e on e.emp_id=w.circu_cir_no where circu_status=1 and circu_approve = 2");
		
		$this->template->write_view('content', 'admin/FREG0006/circular_approval',$data);
		$this->template->write_view('footer', 'default/footer');
		$this->template->render();
	}
	public function order_approval()
	{
		$this->template->set_template('user');
		$this->template->write_view('header', 'default/header',$this->session->userdata);
		$this->template->write_view('sidebar', 'default/sidebar');
		
		$data['ord_pendings'] = $this->Common_model->get_data_by_query("select * from hr_order w left join employee e on e.emp_id=w.ord_sl_no where ord_status=1 and ord_approve = 1");
		
		$data['ord_approved'] = $this->Common_model->get_data_by_query("select * from hr_order w left join employee e on e.emp_id=w.ord_sl_no where ord_status=1 and ord_approve = 0");
		
		$data['ord_declined'] = $this->Common_model->get_data_by_query("select * from hr_order w left join employee e on e.emp_id=w.ord_sl_no where ord_status=1 and ord_approve = 2");
		
		$this->template->write_view('content', 'admin/FREG0006/order_approval',$data);
		$this->template->write_view('footer', 'default/footer');
		$this->template->render();
	}
	public function workorder_approval()
	{
		$this->template->set_template('user');
		$this->template->write_view('header', 'default/header',$this->session->userdata);
		$this->template->write_view('sidebar', 'default/sidebar');
		
		$data['work_pendings'] = $this->Common_model->get_data_by_query("select * from hr_work_order w left join employee e on e.emp_id=w.order_name where order_status=1 and order_approve = 1");
		
		$data['work_approved'] = $this->Common_model->get_data_by_query("select * from hr_work_order w left join employee e on e.emp_id=w.order_name where order_status=1 and order_approve = 0");
		
		$data['work_declined'] = $this->Common_model->get_data_by_query("select * from hr_work_order w left join employee e on e.emp_id=w.order_name where order_status=1 and order_approve = 2");
		
		$this->template->write_view('content', 'admin/FREG0006/workorder_approval',$data);
		$this->template->write_view('footer', 'default/footer');
		$this->template->render();
	}
	public function requisition_approval()
	{
		$this->template->set_template('user');
		$this->template->write_view('header', 'default/header',$this->session->userdata);
		$this->template->write_view('sidebar', 'default/sidebar');
		
		$data['req_pendings'] = $this->Common_model->get_data_by_query("select * from hr_manpower hmp 
		left join department dep on dep.dep_id=hmp.man_dept
		left join designation desig on desig.desig_id=hmp.man_postname
		where hmp.approve_status = 2 order by man_entrydt desc");
		
		$data['req_approved'] = $this->Common_model->get_data_by_query("select * from hr_manpower hmp 
		left join department dep on dep.dep_id=hmp.man_dept
		left join designation desig on desig.desig_id=hmp.man_postname
		where hmp.approve_status = 4 order by man_entrydt desc");
		
		$data['req_declined'] = $this->Common_model->get_data_by_query("select * from hr_manpower hmp 
		left join department dep on dep.dep_id=hmp.man_dept
		left join designation desig on desig.desig_id=hmp.man_postname
		where hmp.approve_status = 5 order by man_entrydt desc");
		
		$this->template->write_view('content', 'admin/FREG0006/requisition_approval',$data);
		$this->template->write_view('footer', 'default/footer');
		$this->template->render();
	}
	
	function chairman_action_requisition()
	{
		if($this->input->post('declinereqchairman'))
		{
			$data['approve_status'] = 5;
			$data['man_declinerem'] = $this->input->post('hrwarn_decline_remark');
			$id = $this->input->post('divid');
			$redi = $this->input->post('tabid');
		}
		else
		{
			$data['approve_status'] = 4;
			echo $id =$this->uri->segment(4);
			echo $redi =$this->uri->segment(5);
		}
		$this->Crud_model->edit_record_by_any_id('hr_manpower','man_id',$id,$data);
		redirect('admin/FREG0006/requisition_approval'.$redi);
	}
	
	
	public function consultation()
	{
	if($this->ion_auth->logged_in())
	{
		
	
		$this->template->set_template('user');
		$this->template->write_view('header', 'default/header',$this->session->userdata);
		$this->template->write_view('sidebar', 'default/sidebar');
		
		
		// $data['consult'] = $this->Common_model->get_data_by_query("select *	from nursef_consultation where 0=0 order by cons_notifi DESC  limit 100");	
		$dt = date('Y-m-d');
		$data['requestcon'] = $this->Common_model->get_data_by_query("select * from nursef_consultation where 0=0 and cons_seen = 0 and date_format(genr_entrydt,'%Y-%m-%d')='$dt' order by  genr_entrydt DESC  limit 100");
		$data['remarkcon'] = $this->Common_model->get_data_by_query("select * from nursef_consultation where 0=0 and cons_seen = 1 and date_format(genr_entrydt,'%Y-%m-%d')='$dt' order by  genr_entrydt DESC  limit 100");
		$this->template->write_view('content', 'admin/FREG0006/consultation',$data);
		$this->template->write_view('footer', 'default/footer');
		$this->template->render();
	}
		else
		{
			 redirect('auth/login');	
		}		
	}
	

	
	function searchConsultation()
		{
			
		
			$uhid=$_POST['srch_uhid'];
			
			
		$serchitem = array($first_name,$last_name,$uhid,$consultant,$srch_regno);

		$querry='';
		
		foreach ($serchitem as &$value) {

		if($value=='select')
		{
		}
		else if($value=='')
		{
		}
		else
		{

		$value_aryy = explode ( "@", $value );
		$data  =  $value_aryy [0];
		$filed = $value_aryy [1];
		if($filed=='first_name')
		{
			$querry .= " and p.".$filed." like "."'%".$data."%'";
		}
		else if($filed=='uhid')
		{
			$querry .= " and p.id='$data'";
		}
		else if($filed=='last_name')
		{
			$querry .= " and p.".$filed." like "."'%".$data."%'";
		}
		else if($filed=='consultant')
		{
			$querry .= " and p.".$filed."='".$data."'";
		}   
			else if($filed=='admit_id')
		{
			$querry .= " and c.casu_id = '$data'";
		}	
	}
	}

		$consult = $this->Common_model->get_data_by_query("select 
		p.first_name,p.middle_name,p.last_name,c.cons_id,c.cons_status as aaa,
		c.cons_gen_req,c.genr_entrydt,c.visit_entrydt,c.visit_seen,
		ip.admit_ward,ip.admit_id,ip.admit_uhid
		from nursef_consultation c

		left join patient p on p.id = c.cons_uhid
		left join casualty cu on cu.casu_uhid = c.cons_uhid
		left join ipd_admit ip on ip.admit_uhid = c.cons_uhid
		where p.patient_reg_from = 'REGISTRATION' $querry order by genr_entrydt desc limit 100");	
			$count=0;
		foreach($consult as $cn)
		{
			$count++;
			// $cn['admit_uhid']
		?>						
			<tr>
				<td><?php echo $count; ?>.</td>
				<td><?php echo $this->Crud_model->Drname($cn['cons_gen_req']);?></td>
				<td><?php echo $cn['first_name']." ".$cn['middle_name']." ".$cn['last_name']; ?></td>
				<td><?php echo $cn['admit_uhid']; ?></td>
				<td><?php echo $this->Common_model->getPtWard($cn['admit_id'],$cn['admit_uhid']); ?></td>
				<td><?php echo date("d-m-Y / h:i A", strtotime($cn['genr_entrydt'])); ?></td>
				<td>
					<button class='btn purple mini' style='width:55%;height:55%;;color:white;' href='#portlet-configa' data-toggle='modal'>Click To Call</button><br>
					<button class='btn mini purple' style='width:55%;height:44%;color:white;' onclick=''>Send SMS</button>
					<?php  if($cn['aaa'] == '0') { ?>
					<button class='btn mini green' style='margin-right:-1cm;margin-top:-.5cm;height:52px;width:45%;color:white;' href="<?php echo base_url('admin/FREG0006/consultation_seen').'/'.$cn['cons_id']; ?>" ><span style='text-align:centr;width: 63px;'><br><i class='icon-ok'></i> Done</span></button>
					<?php } elseif($cn['aaa'] == '1') { ?>
						<button class='btn mini red' style='margin-right:-1cm;margin-top:-.5cm;height:52px;width:48%;color:white;' ><span ><i class='icon-ok'></i> Informed</span></button>
					<?php }  ?>
				</td>
			</tr>
		<?php } 
		}
	
	public function consultation1()
	{
	if($this->ion_auth->logged_in())
	{
		
	
		$this->template->set_template('user');
		$this->template->write_view('header', 'default/header',$this->session->userdata);
		$this->template->write_view('sidebar', 'default/sidebar');
		$data['message'] = $this->session->flashdata('message');
		$data['consult'] = $this->Common_model->get_data_by_query("select *	from nursef_consultation  
		where 0=0 order by cons_notifi DESC  limit 100");	
		$dt = date('Y-m-d');
		$data['requestcon'] = $this->Common_model->get_data_by_query("select * from nursef_consultation where 0=0 and cons_seen = 0 and date_format(genr_entrydt,'%Y-%m-%d')='$dt' order by  genr_entrydt DESC  limit 100");
		$data['remarkcon'] = $this->Common_model->get_data_by_query("select * from nursef_consultation where 0=0 and cons_seen = 1 and date_format(genr_entrydt,'%Y-%m-%d')='$dt' order by  genr_entrydt DESC  limit 100");
		$this->template->write_view('content', 'admin/FREG0006/consultation1',$data);
		$this->template->write_view('footer', 'default/footer');
		$this->template->render();
	}
		else
		{
			 redirect('auth/login');	
		}		
	}
	
	
	
	
	function shreqsrchConsu()
		{
			
		
			  // $startdate=$_POST['reqdtsrch'];
			  // $enddate=$_POST['reqdtsrch1'];
		 $startdate=date('Y-m-d',strtotime($_POST['reqdtsrch']));
	    $enddate=date('Y-m-d',strtotime($_POST['reqdtsrch1']));
			  $cons_gen_req=$_POST['srchdoctor'];
			  $dt = date('Y-m-d');
		   if($startdate=='1970-01-01' || $enddate=='1970-01-01' )
			   {
				 $startdate='';  
				 $enddate='';
				 $genr_entrydt='';
			   }
			// die;
			if($startdate !='' and $enddate !='')
				{
				$genr_entrydt =$startdate.'^'.$enddate.'@'.'genr_entrydt';
				}
			 
			if($cons_gen_req !='')
		    {
		    	  $cons_gen_req =$cons_gen_req.'@cons_gen_req';
		    	 
		    } 
		$serchitem = array($genr_entrydt,$cons_gen_req);

		$querry='';
		
		foreach ($serchitem as &$value) {

		if($value=='select')
		{
			
		}
		
		
		else if($value!='')
		{
			//echo "hello";
			
		$value_aryy = explode ( "@", $value );
		$data  =  $value_aryy [0];
		$filed = $value_aryy [1];
		if($filed=='genr_entrydt')
		{
			 $datas = explode ( "^", $data );
			$sdata = $datas[0];
			$esdata = $datas [1];
			$querry .= " and date_format(genr_entrydt,'%Y-%m-%d') between '$sdata' and '$esdata'";
		}
	
		else if($filed=='cons_gen_req')
		{
			$querry .= " and cons_gen_req='$data'";
		}
		
		}
		else if($genr_entrydt=='')
		{
			// echo "hiii";
			// die;
			$querry .= " and date_format(genr_entrydt,'%Y-%m-%d') ='$dt'";
		}
		
	
	}

		$requestcon = $this->Common_model->get_data_by_query("select * from nursef_consultation  
		          where 0=0 and cons_seen = 0 $querry order by  genr_entrydt DESC ");	
		
			
			
		       ?>					<thead>	
									  <tr bgcolor='linen'>
											<td><input type='checkbox' id='selectall' onchange='checkall()' value='1'></td>
											<td>Sl</td>
											<td>Patient</td>
											<td>Doctor</td>
											<td>UHID</td>
											<td>Reg. No.</td>
											<td>Location</td>
											<td>Request Time</td>
											<td>Status</td>
											<td>Remark</td>
										</tr>
									</thead>
									<tbody>
               <?php $count=1;
				   foreach($requestcon as $cn)
					{  $id=$cn['cons_id'];
						
						// $cn['admit_uhid']
						 if($cn['cons_notifi']==1 and $cn['cons_id']== $cn['cons_id']  ){
					?>	
  				
			  <tr style ="background-color:linen;color:red">
				<td style ="background-color:linen;color:red" >
					<input type='checkbox' class='' name='check[]' id='check_<?php echo $count?>' value='<?php echo $cn['cons_id'];?>'>
				</td>
				<td style ="background-color:linen;color:red" ><?php echo $count; ?>.</td>
				<td style ="background-color:linen;color:red"><?php $ptDetail = $this->Common_model->getPatientDetails($cn['cons_uhid']);
					foreach($ptDetail as $pt){}
					
					echo $pt['first_name'].' '.$pt['middle_name'].' '.$pt['last_name'];

				?> </td>
				<td style ="background-color:linen;color:red"><?php echo $this->Crud_model->Drname($cn['cons_gen_req']);?></td>
				<td style ="background-color:linen;color:red"><?php echo $cn['cons_uhid']; ?></td>
				<td style ="background-color:linen;color:red"><?php echo $cn['cons_ipd']; ?></td>
				<td style ="background-color:linen;color:red"><?php //echo $this->Common_model->getPtWard($cn['cons_ipd'],$cn['cons_uhid']); ?><?php echo $this->Crud_model->PLocation($cn['cons_uhid'],$cn['cons_ipd']);?></td>
				<td style ="background-color:linen;color:red" ><?php echo date("d-M-Y", strtotime($cn['genr_entrydt'])).'</br>'.date("h:i A", strtotime($cn['genr_entrydt']));; ?></td>
				<td style ="background-color:linen;color:red"><span id="st">
					<!--<button class='btn purple mini' style='width:55%;height:60%;;color:white;' href='#portlet-configa' data-toggle='modal'>Click To Call</button><br>
					<button class='btn mini purple' style='width:55%;height:60%;color:white;' onclick=''>Send SMS</button>-->
				  <center><button class='btn mini red' id="done" value="0"  onclick = "seenst(this.value,'<?php echo $cn['cons_id']; ?>','<?php echo $pt['first_name'].' '.$pt['middle_name'].' '.$pt['last_name']; ?>')"><center ><i  class='icon-ok'></i>Inform <?php if($cn['cons_notifi']==1 and $cn['cons_id']== $cn['cons_id'] ){ ?><span class="badge badge-important"><?php   // echo count($cn['cons_notifi']);?></span><?php } ?></center></button></center>
				   </span></td> 
			<td style ="background-color:linen;color:red">
							 <a class="popovers btn blue-stripe  mini" style="background:#FFE4C4; color :solid black;font-weight:bolder" id='emp_det1_<?php echo $count;?>'  data-trigger="click"  data-html='true' data-container="body" data-placement="left" 
							   data-content="<div style='background:rgba(255, 0, 106, 0.11);margin-left: 0%;margin-right: 0%;margin-top: 0%;margin-bottom: 3%;'>
									   <table width='100%'style='font-size:12px;' cellspacing='100' cellpadding='5'>
										 <tr>
											 <td><center>
											 
											 
											  <textarea id='remarkcon' name='remarkcon' placeholder='Please Enter Remark'><?php echo $cn['cons_remark'];?></textarea>
											 <button class='btn red icn-only mini popovers' style='float:right;margin-top:1cm;' type='submit'> <a  style='color:white' data-trigger='click'   onclick = '$(&quot;#emp_det1_<?php echo $count;?>&quot;).popover(&quot;hide&quot;),remark(<?php echo $cn['cons_id']; ?>);'>Submit </a></button>
											
											 </td> 
											
										  </tr>
									   </table>
									</div>
									<div style='background:rgba(48, 255, 145, 0.29);width: 109%;margin-bottom: -9px;margin-left: -13px;>
									<hr />
									<table style='font-size:12px;'cellspacing='100'cellpadding='10'>
									   <tr><td>&emsp;&emsp;</td></tr>
									</table>
								</div>" 
								data-original-title="<span style='font-size:15px;'>Remark  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         <a class='btn red icn-only mini popovers' data-trigger='click' style='float:right' onclick='$(&quot;#emp_det1_<?php echo $count;?>&quot;).popover(&quot;hide&quot;);'><i class='icon-remove icon-white'></i></a></span>"> Remark</a>
							</td> 
				
			</tr>
			<?php }  
			else {
				 ?>	 
  				 <tr>
			    <td> <input type='checkbox' class='' name='check[]' id='check_<?php echo $count?>'  value='<?php echo $cn['cons_id'];?>' ></td>
			    <td><?php echo $count; ?>.</td>
				<td><?php $ptDetail = $this->Common_model->getPatientDetails($cn['cons_uhid']);
					foreach($ptDetail as $pt){}
					echo $pt['first_name'].' '.$pt['middle_name'].' '.$pt['last_name'];
				 ?></td>
				 <td><?php echo $this->Crud_model->Drname($cn['cons_gen_req']);?></td>
				<td><?php echo $cn['cons_uhid']; ?></td>
				<td><?php echo $cn['cons_ipd']; ?></td>
				<td><?php //echo $this->Common_model->getPtWard($cn['cons_ipd'],$cn['cons_uhid']); ?><?php echo $this->Crud_model->PLocation($cn['cons_uhid'],$cn['cons_ipd']);?></td>
				<td><?php echo date("d-M-Y", strtotime($cn['genr_entrydt'])).'</br>'.date("h:i A", strtotime($cn['genr_entrydt']));; ?></td>
				<td ><span id="st">
					<!--<button class='btn purple mini' style='width:55%;height:60%;;color:white;' href='#portlet-configa' data-toggle='modal'>Click To Call</button><br>
					<button class='btn mini purple' style='width:55%;height:60%;color:white;' onclick=''>Send SMS</button>-->
					<center><button class='btn mini blue' id="done" value="0"  onclick = "seenst(this.value,'<?php echo $cn['cons_id']; ?>','<?php echo $pt['first_name'].' '.$pt['middle_name'].' '.$pt['last_name']; ?>')"><center ><i  class='icon-ok'></i> Inform <?php if($cn['cons_notifi']==1 and $cn['cons_id']== $cn['cons_id'] ){ ?><span class="badge badge-important"><?php   // echo count($cn['cons_notifi']);?></span><?php } ?></center></button></center>
	           </span></td>
				
				<td>
							 <a class="popovers btn blue-stripe  mini" style="background:#FFE4C4; color :solid black;font-weight:bolder" id='emp_det1_<?php echo $count;?>'  data-trigger="click"  data-html='true' data-container="body" data-placement="left" 
							   data-content="<div style='background:rgba(255, 0, 106, 0.11);margin-left: 0%;margin-right: 0%;margin-top: 0%;margin-bottom: 3%;'>
									   <table id ='remarktable' width='100%'style='font-size:12px;' cellspacing='100' cellpadding='5'>
										 <tr>
											 <td><center>
											 
											 
											  <textarea id='remarkcon' name='remarkcon' placeholder='Please Enter Remark'><?php echo $cn['cons_remark'];?></textarea>
											 <button class='btn red icn-only mini popovers' style='float:right;margin-top:1cm;' type='submit'> <a  style='color:white' data-trigger='click'   onclick = '$(&quot;#emp_det1_<?php echo $count;?>&quot;).popover(&quot;hide&quot;),remark(<?php echo $cn['cons_id']; ?>);'>Submit </a></button>
											
											 </td> 
											
										  </tr>
									   </table>
									</div>
									<div style='background:rgba(48, 255, 145, 0.29);width: 109%;margin-bottom: -9px;margin-left: -13px;>
									<hr />
									<table style='font-size:12px;'cellspacing='100'cellpadding='10'>
									   <tr><td>&emsp;&emsp;</td></tr>
									</table>
								</div>" 
								data-original-title="<span style='font-size:15px;'>Remark  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;        <a class='btn red icn-only mini popovers' data-trigger='click' style='float:right' onclick = '$(&quot;#emp_det1_<?php echo $count;?>&quot;).popover(&quot;hide&quot;);'> <i class='icon-remove icon-white'></i></a></span>"> Remark</a>
							</td> 
				
					</tr> <?php }  ?>
		<?php  $count++; }  ?>  		
			
					<tr>
						<td colspan='10' style=''><button type='submit' class='span4 btn blue'><center>INFORM SELECTED</center></button></td>
					</tr>
				</tbody>
				<script>
					function checkall()
					{
						var cou = '<?php echo $count;?>';
						if($("#selectall").is(':checked'))
						{
							for(var i=1;i<=cou;i++)
							{
								
								// $('#uniform-check_'+i).remove();
								// $('#check_'+i).parent().remove();
								$('#check_'+i).parent().addClass('checked');
								$('#check_'+i).prop('checked',true);
							}
						}
						else
						{
							for(var i=1;i<=cou;i++)
							{
								// $('#uniform-check_'+i).remove();
								$('#check_'+i).parent().removeClass('checked');
								$('#check_'+i).prop('checked',false);
							}
						}
					}
				</script>
		<?php  
		}
		
		function InformSelected()
		{
			$arr = $this->input->post('check');
			// print_r($arr);die;
			if($arr[0]!=null)
			{
				foreach($arr as $value)
				{   
					$id = $value;            
					$data['cons_seen'] = 1;  
					$data['cons_notifi'] = 2;
					$data['cons_status'] = 1;
					$data['inf_entrydt'] = date('Y-m-d H:i:sa');
					$this->Crud_model->edit_record_by_any_id('nursef_consultation','cons_id',$id,$data); 
				}
				redirect('admin/FREG0006/consultation');
			}
			else
			{				
				$this->session->set_flashdata('message', 'Please Select Atleast One Patient');
				redirect('admin/FREG0006/consultation');
			}
			
		}
		function shremarksrchConsu()
		{
			
				$cons_gen_req=$_POST['srchdoctor1'];
				$startdate=date('Y-m-d',strtotime($_POST['remrdtsrch']));
				$enddate=date('Y-m-d',strtotime($_POST['remrdtsrch1']));
				$dt = date('Y-m-d');
				if($startdate=='1970-01-01' || $enddate=='1970-01-01' )
				{
					$startdate='';  
					$enddate='';
					$genr_entrydt='';
				}
				if($startdate !='' and $enddate !='')
				{
					$genr_entrydt =$startdate.'^'.$enddate.'@'.'genr_entrydt';
				}
				if($cons_gen_req !='')
				{
					$cons_gen_req =$cons_gen_req.'@cons_gen_req'; 
				} 
				$serchitem = array($genr_entrydt,$cons_gen_req);
				$querry='';
				foreach ($serchitem as &$value) {
				if($value=='select')
				{}
				else if($value!='')
				{
					$value_aryy = explode ( "@", $value );
					$data  =  $value_aryy [0];
					$filed = $value_aryy [1];
					if($filed=='genr_entrydt')
					{
						$datas = explode ( "^", $data );
						$sdata = $datas[0];
						$esdata = $datas [1];
						$querry .= " and date_format(genr_entrydt,'%Y-%m-%d') between '$sdata' and '$esdata'";
					}
					else if($filed=='cons_gen_req')
					{
					$querry .= " and cons_gen_req='$data'";
					}
				}
				else if($genr_entrydt=='')
				{
					$querry .= " and date_format(genr_entrydt,'%Y-%m-%d') ='$dt'";
				}
	}
		$remarkcon = $this->Common_model->get_data_by_query("select * from nursef_consultation  
		          where 0=0 and cons_seen = 1 $querry order by  genr_entrydt DESC ");	
		
			
			
		       ?>	
				<tr>
					<td>Sl.No</td>
					<td>Doctor</td>
					<td>Patient</td>
					<td>UHID</td>
					<td>Reg. No.</td>
					<td>Department</td>
					<td class='request'>Request Time</td>
					<td class='informed'>Informed Entery Time</td>
					<td class ="informedrem1">Remark</td>
				</tr>
					<?php $count=1;
					foreach($remarkcon as $cn)
					{  $id=$cn['cons_id']; ?>	
						<tr>
							<td><?php echo $count; ?>.</td>
							<td><?php echo $this->Crud_model->Drname($cn['cons_gen_req']);?></td>
							<td><?php $ptDetail = $this->Common_model->getPatientDetails($cn['cons_uhid']);
							foreach($ptDetail as $pt){}

							echo $pt['first_name'].' '.$pt['middle_name'].' '.$pt['last_name'];

							?></td>
							<td><?php echo $cn['cons_uhid']; ?></td>
							<td><?php echo $cn['cons_ipd']; ?></td>
							<td><?php echo $this->Crud_model->PLocation($cn['cons_uhid'],$cn['cons_ipd']);?></td>
							<td class='request1'><?php echo date("d-M-Y", strtotime($cn['genr_entrydt'])).'</br>'.date("h:i A", strtotime($cn['genr_entrydt'])); ?></td>
							<?php $entrydy = date("Y-m-d h:i:s", strtotime($cn['inf_entrydt'])); ?>
							<td class='informed1'><center><?php if($entrydy > '1970-01-01 05:30:00'){ echo date("d-M-Y h:i:s", strtotime($cn['inf_entrydt'])); } else{ echo('--'); }  ?></center></td>
							<td id ="informedrem" class ="informedrem"><center><textarea id='remarkcon1' name='remarkcon1' onkeyup="remark1(<?php echo $cn['cons_id']; ?>,this.value)" placeholder='Please Enter Remark'><?php echo $cn['cons_remark'];?></textarea></center></td> 
						</tr> 
					<?php  $count++; }   ?> 			
			<?php 
		}
		
		
	public function consultation_seen()
	{
           $valu= $_POST['valu'];
		   $id= $_POST['id'];
		   $dt = date('Y-m-d');
		
	 // if($valu=='0')
		 // {
		 $data['cons_seen'] = 1;
		 $data['cons_notifi'] = 2;
		 $data['cons_status'] = 1;
		 $data['inf_entrydt'] = date('Y-m-d H:i:sa');
		  $this->Crud_model->edit_record_by_any_id('nursef_consultation','cons_id',$id,$data); 
		 $requestcon = $this->Common_model->get_data_by_query("select * from nursef_consultation where 0=0 and cons_seen = 0 and date_format(genr_entrydt,'%Y-%m-%d')='$dt' order by  genr_entrydt DESC");	
		// echo $this->db->last_query();
		  // die;
		?>
					  <tr>
											<td>#</td>
											<td>Patient</td>
											<td>Doctor</td>
											<td>UHID</td>
											<td>Reg. No.</td>
											<td>Department</td>
											<td>Request Time</td>
											<td>Status</td>
											<td>Remark</td>
											 
										</tr>
               <?php $count=1;
				   foreach($requestcon as $cn)
					{  $id=$cn['cons_id'];
						
						// $cn['admit_uhid']
						 if($cn['cons_notifi']==1 and $cn['cons_id']== $cn['cons_id']  ){
					?>	
  				
			  <tr style ="background-color:linen;color:red">
			
				<td style ="background-color:linen;color:red" ><?php echo $count; ?>.</td>
				<td style ="background-color:linen;color:red"><?php $ptDetail = $this->Common_model->getPatientDetails($cn['cons_uhid']);
					foreach($ptDetail as $pt){}
					
					echo $pt['first_name'].' '.$pt['middle_name'].' '.$pt['last_name'];

				?> </td>
				<td style ="background-color:linen;color:red"><?php echo $this->Crud_model->Drname($cn['cons_gen_req']);?></td>
				<td style ="background-color:linen;color:red"><?php echo $cn['cons_uhid']; ?></td>
				<td style ="background-color:linen;color:red"><?php echo $cn['cons_ipd']; ?></td>
				<td style ="background-color:linen;color:red"><?php //echo $this->Common_model->getPtWard($cn['cons_ipd'],$cn['cons_uhid']); ?><?php echo $this->Crud_model->PLocation($cn['cons_uhid'],$cn['cons_ipd']);?></td>
				<td style ="background-color:linen;color:red" ><?php echo date("d-M-Y", strtotime($cn['genr_entrydt'])).'</br>'.date("h:i A", strtotime($cn['genr_entrydt']));; ?></td>
				<td style ="background-color:linen;color:red"><span id="st">
					<!--<button class='btn purple mini' style='width:55%;height:60%;;color:white;' href='#portlet-configa' data-toggle='modal'>Click To Call</button><br>
					<button class='btn mini purple' style='width:55%;height:60%;color:white;' onclick=''>Send SMS</button>-->
				  <center><button class='btn red' id="done" value="0"  onclick = "seenst(this.value,'<?php echo $cn['cons_id']; ?>','<?php echo $pt['first_name'].' '.$pt['middle_name'].' '.$pt['last_name']; ?>')"><center ><i  class='icon-ok'></i> Inform <?php if($cn['cons_notifi']==1 and $cn['cons_id']== $cn['cons_id'] ){ ?><span class="badge badge-important"><?php   // echo count($cn['cons_notifi']);?></span><?php } ?></center></button></center>
				   </span></td> 
			<td style ="background-color:linen;color:red">
							 <a class="popovers btn blue-stripe  mini" style="background:#FFE4C4; color :solid black;font-weight:bolder" id='emp_det1_<?php echo $count;?>'  data-trigger="click"  data-html='true' data-container="body" data-placement="left" 
							   data-content="<div style='background:rgba(255, 0, 106, 0.11);margin-left: 0%;margin-right: 0%;margin-top: 0%;margin-bottom: 3%;'>
									   <table width='100%'style='font-size:12px;' cellspacing='100' cellpadding='5'>
										 <tr>
											 <td><center>
											 
											 
											  <textarea id='remarkcon' name='remarkcon' placeholder='Please Enter Remark'><?php echo $cn['cons_remark'];?></textarea>
											 <button class='btn red icn-only mini popovers' style='float:right;margin-top:1cm;' type='submit'> <a  style='color:white' data-trigger='click'   onclick = '$(&quot;#emp_det1_<?php echo $count;?>&quot;).popover(&quot;hide&quot;),remark(<?php echo $cn['cons_id']; ?>);'>Submit </a></button>
											
											 </td> 
											
										  </tr>
									   </table>
									</div>
									<div style='background:rgba(48, 255, 145, 0.29);width: 109%;margin-bottom: -9px;margin-left: -13px;>
									<hr />
									<table style='font-size:12px;'cellspacing='100'cellpadding='10'>
									   <tr><td>&emsp;&emsp;</td></tr>
									</table>
								</div>" 
								data-original-title="<span style='font-size:15px;'>Remark  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;         <a class='btn red icn-only mini popovers' data-trigger='click' style='float:right' onclick='$(&quot;#emp_det1_<?php echo $count;?>&quot;).popover(&quot;hide&quot;);'><i class='icon-remove icon-white'></i></a></span>"> Remark</a>
							</td> 
				
			</tr> <?php }  else {
				 ?>	 
  				 <tr>
			    <td><?php echo $count; ?>.</td>
				<td><?php $ptDetail = $this->Common_model->getPatientDetails($cn['cons_uhid']);
					foreach($ptDetail as $pt){}
					echo $pt['first_name'].' '.$pt['middle_name'].' '.$pt['last_name'];
				 ?></td>
				 <td><?php echo $this->Crud_model->Drname($cn['cons_gen_req']);?></td>
				<td><?php echo $cn['cons_uhid']; ?></td>
				<td><?php echo $cn['cons_ipd']; ?></td>
				<td><?php //echo $this->Common_model->getPtWard($cn['cons_ipd'],$cn['cons_uhid']); ?> <?php echo $this->Crud_model->PLocation($cn['cons_uhid'],$cn['cons_ipd']);?></td>
				<td><?php echo date("d-M-Y", strtotime($cn['genr_entrydt'])).'</br>'.date("h:i A", strtotime($cn['genr_entrydt']));; ?></td>
				<td ><span id="st">
					<!--<button class='btn purple mini' style='width:55%;height:60%;;color:white;' href='#portlet-configa' data-toggle='modal'>Click To Call</button><br>
					<button class='btn mini purple' style='width:55%;height:60%;color:white;' onclick=''>Send SMS</button>-->
					<center><button class='btn   blue' id="done" value="0"  onclick = "seenst(this.value,'<?php echo $cn['cons_id']; ?>','<?php echo $pt['first_name'].' '.$pt['middle_name'].' '.$pt['last_name']; ?>')"><center ><i  class='icon-ok'></i> Inform <?php if($cn['cons_notifi']==1 and $cn['cons_id']== $cn['cons_id'] ){ ?><span class="badge badge-important"><?php   // echo count($cn['cons_notifi']);?></span><?php } ?></center></button></center>
	           </span></td>
				
				<td>
							 <a class="popovers btn blue-stripe  mini" style="background:#FFE4C4; color :solid black;font-weight:bolder" id='emp_det1_<?php echo $count;?>'  data-trigger="click"  data-html='true' data-container="body" data-placement="left" 
							   data-content="<div style='background:rgba(255, 0, 106, 0.11);margin-left: 0%;margin-right: 0%;margin-top: 0%;margin-bottom: 3%;'>
									   <table id ='remarktable' width='100%'style='font-size:12px;' cellspacing='100' cellpadding='5'>
										 <tr>
											 <td><center>
											 
											 
											  <textarea id='remarkcon' name='remarkcon' placeholder='Please Enter Remark'><?php echo $cn['cons_remark'];?></textarea>
											 <button class='btn red icn-only mini popovers' style='float:right;margin-top:1cm;' type='submit'> <a  style='color:white' data-trigger='click'   onclick = '$(&quot;#emp_det1_<?php echo $count;?>&quot;).popover(&quot;hide&quot;),remark(<?php echo $cn['cons_id']; ?>);'>Submit </a></button>
											
											 </td> 
											
										  </tr>
									   </table>
									</div>
									<div style='background:rgba(48, 255, 145, 0.29);width: 109%;margin-bottom: -9px;margin-left: -13px;>
									<hr />
									<table style='font-size:12px;'cellspacing='100'cellpadding='10'>
									   <tr><td>&emsp;&emsp;</td></tr>
									</table>
								</div>" 
								data-original-title="<span style='font-size:15px;'>Remark  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;        <a class='btn red icn-only mini popovers' data-trigger='click' style='float:right' onclick = '$(&quot;#emp_det1_<?php echo $count;?>&quot;).popover(&quot;hide&quot;);'> <i class='icon-remove icon-white'></i></a></span>"> Remark</a>
							</td> 
				
					</tr> <?php }  ?>
		<?php  $count++; }  ?>   
					
		<?php 
		 // }
		// echo ($valu);
		// die;
		// $data['cons_status'] = 1;
		// $this->Crud_model->edit_record_by_any_id('nursef_consultation','cons_id',$id,$data);
		// redirect('admin/FREG0006/consultation');
	}
	public function con_changeinfrm()
	{
           // $valu= $_POST['valu'];
		   // $id= $_POST['id'];
		 // $uhid= $_POST['uhid'];
		 
		  // echo $this->db->last_query();
		  // die;
					$dt = date('Y-m-d');
					
			$remarkcon = $this->Common_model->get_data_by_query("select * from nursef_consultation where 0=0 and cons_seen = 1 and date_format(genr_entrydt,'%Y-%m-%d')='$dt' order by  genr_entrydt DESC");
		// $requestcon = $this->Common_model->get_data_by_query("select * from nursef_consultation where 0=0 and cons_seen = 0 and date_format(genr_entrydt,'%Y-%m-%d')='$dt' order by  genr_entrydt DESC");	
		// echo $this->db->last_query();
		  // die;
		?>
					 <tr>
											<td>Sl.No</td>
											<td>Doctor</td>
											<td>Patient</td>
											<td>UHID</td>
											<td>Reg. No.</td>
											<td>Department</td>
											<td>Request Time</td>
											<td>Informed Entery Time</td>
											<td>Remark</td>
										</tr>
						 <?php $count=1;
						 // $consult3 = $this->Common_model->get_data_by_query("select * from nursef_consultation  
		// where 0=0 and cons_seen = 1 order by cons_notifi,genr_entrydt DESC  ");
					foreach($remarkcon as $cn)
					{  $id=$cn['cons_id'];
						// echo $cn['cons_id'];
						// $cn['admit_uhid']
						 
					?>	
  				 <tr>
			    <td><?php echo $count; ?>.</td>
				<td><?php echo $this->Crud_model->Drname($cn['cons_gen_req']);?></td>
				<td><?php $ptDetail = $this->Common_model->getPatientDetails($cn['cons_uhid']);
					foreach($ptDetail as $pt){}
					
					echo $pt['first_name'].' '.$pt['middle_name'].' '.$pt['last_name'];

				?></td>
				<td><?php echo $cn['cons_uhid']; ?></td>
				<td><?php echo $cn['cons_ipd']; ?></td>
				<td><?php echo $this->Crud_model->PLocation($cn['cons_uhid'],$cn['cons_ipd']);?></td>
				<td><?php echo date("d-M-Y", strtotime($cn['genr_entrydt'])).'</br>'.date("h:i A", strtotime($cn['genr_entrydt'])); ?></td>
				<?php $entrydy = date("Y-m-d h:i:s", strtotime($cn['inf_entrydt'])); ?>
				<td><center><?php if($entrydy > '1970-01-01 05:30:00'){ echo date("d-M-Y h:i:s", strtotime($cn['inf_entrydt'])); } else{ echo('--'); }  ?></center></td>
				<!--<td ><span id="st">
					<button class='btn purple mini' style='width:55%;height:60%;;color:white;' href='#portlet-configa' data-toggle='modal'>Click To Call</button><br>
					<button class='btn mini purple' style='width:55%;height:60%;color:white;' onclick=''>Send SMS</button>
					 
					
					<center><button class='btn   green ' id="infra" value="1"   href="#configremark" data-toggle="modal"  ><center ><i  class='icon-check'></i> Informed </center></button></center>
				  
				 </span></td>-->
			                   <td id ="informedrem"><center><textarea id='remarkcon1' name='remarkcon1' onkeyup="remark1(<?php echo $cn['cons_id']; ?>,this.value)" placeholder='Please Enter Remark'><?php echo $cn['cons_remark'];?></textarea></center></td> 
			 </tr> 
					<?php  $count++; }   ?>    
					
		<?php 
		 
	}
	public function consultation_seen1()
	{
		 
		 // $valu= $_POST['valu'];
		 // $id= $_POST['id'];
		  $consult = $this->Common_model->get_data_by_query("select cons_notifi,cons_id from nursef_consultation ");	
			 foreach( $consult as  $const)
			 {
				 if($const['cons_notifi']==1)
			 {
		 $data['cons_notifi'] = 0;
		$this->Crud_model->edit_record_by_any_id('nursef_consultation','cons_id',$const['cons_id'],$data);
			 } 
			 }
				  // echo $this->db->last_query();
		  // die;
		
		   
		 
		 
	}
	public function nursconrefe()
	{
		 
		 // $valu= $_POST['valu'];
		 $id= $_POST['id'];
		  $consult = $this->Common_model->get_data_by_query("select * from nursef_consultation where cons_ipd = $id ");	
			 foreach( $consult as  $const)
			 {
				 if($const['cons_notifi']==2)
			 {
		 $data['cons_notifi'] = 0;
		$this->Crud_model->edit_record_by_any_id('nursef_consultation','cons_id',$const['cons_id'],$data);
			 } 
			 }
				  // echo $this->db->last_query();
		  // die;
		
	}
	public function conremark()
	{
		 
		 // $valu= $_POST['valu'];
		 $id= $_POST['id'];
		 $remark= $_POST['remark'];
		
		  $consult = $this->Common_model->get_data_by_query("select * from nursef_consultation where cons_id = $id ");	
		  $count=0;
			 foreach( $consult as  $const)
			 {
				 
				 if($const)
			 {
		 $data['cons_remark'] = $remark;
		  $data['cons_notifi'] = 2;
		$this->Crud_model->edit_record_by_any_id('nursef_consultation','cons_id',$const['cons_id'],$data);
			 } 
			 $count++;
			 }
			 ?>
			 <tr>
											 <td><center>
											 
											 
											  <textarea id='remarkcon' name='remarkcon' placeholder='Please Enter Remark'><?php echo $const['cons_remark'];?></textarea>
											 <button class='btn red icn-only mini popovers' style='float:right;margin-top:1cm;' type='submit'> <a  data-trigger='click'   onclick = '$(&quot;#emp_det1_<?php echo $count;?>&quot;).popover(&quot;hide&quot;),remark(<?php echo $const['cons_id']; ?>);'>Submit </a></button>
											
											 </td> 
											
										  </tr>
			 <?php
				  // echo $this->db->last_query();
		  // die;
		
	}
	public function conremark1()
	{
		 
		 // $valu= $_POST['valu'];
		 $id= $_POST['id'];
		 $remark= $_POST['remark'];
		
		  $consult = $this->Common_model->get_data_by_query("select * from nursef_consultation where cons_id = $id ");	
		  $count=0;
			 foreach( $consult as  $const)
			 {
				 
				 if($const)
			 {
		 $data['cons_remark'] = $remark;
		  $data['cons_notifi'] = 2;
		$this->Crud_model->edit_record_by_any_id('nursef_consultation','cons_id',$const['cons_id'],$data);
			 } 
			 $count++;
			 }
			 ?>
			
			 <?php
				  // echo $this->db->last_query();
		  // die;
		
	}
	
	public function entry_log()
	{
	if($this->ion_auth->logged_in())
	{
		$user=$this->session->userdata('user_id');
		$this->template->set_template('user');
		$this->template->write_view('header', 'default/header',$this->session->userdata);
		$this->template->write_view('sidebar', 'default/sidebar');
		
			$currdate= date ('Y/m/d' ,time() + 86400);
			$currentmonth = date('m');
			$currentyear = date('Y');
			
			$begin = new DateTime("$currentyear/$currentmonth/01");
			$end = new DateTime("$currdate");
			
			$daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
			//-----------------------------------------------Percentage of Re-Dues Laboratory------------------------------------------------------------
			
			$y=date('Y');
			$m=date('m');
			$d1=$y."-".$m."-"."01";
			$d2=$y."-".$m."-"."01";
			// $d1="2015-12-01";
			$d2=date("Y-m-d");
			$start=strtotime($d1);
			$end=strtotime($d2);
			$diff=(($end-$start)/3600)/24;
			
			$data['new6'] = array(); 
			$data['new7'] = array(); 
			$data['new8'] = array(); 
			$data['new9'] = array(); 
			$data['new10'] = array(); 
			$d4=$y."-".$m."-"."00";
			$d5=$y."-".$m."-"."00";
			$d6=$y."-".$m."-"."00";
			$d9=$y."-".$m."-"."00";
			$d10=$y."-".$m."-"."00";
		
		
			
			for($i=0;$i<=$diff;$i++)
			{
			$fetchdata=9;
			$fetchd3=0;
			
		    $d4=date("Y-m-d", strtotime("+1day", strtotime($d4)));
		    $ssbpl1=$this->Common_model->getEntryOnDate("casualty","casu_entrydt",$d4);
			array_push($data['new6'],$ssbpl1);
	          }
			  
			  
			  for($i=0;$i<=$diff;$i++)
			{
			$fetchdata=9;
			$fetchd3=0;
			
		    $d5=date("Y-m-d", strtotime("+1day", strtotime($d5)));
		    $ssbpl1=$this->Common_model->getEntryOnDate("patient_discharge","pdis_entrydt",$d5);
			array_push($data['new7'],$ssbpl1);
	          }
			  
			   for($i=0;$i<=$diff;$i++)
			{
			$fetchdata=9;
			$fetchd3=0;
			
		    $d6=date("Y-m-d", strtotime("+1day", strtotime($d6)));
		    $ssbpl1=$this->Common_model->getBillingOnDate("smcard_topup","topup_entrodt",$d6);
			array_push($data['new8'],$ssbpl1);
	          } 
			  
			  for($i=0;$i<=$diff;$i++)
			{
			$fetchdata=9;
			$fetchd3=0;
			
		    $d9=date("Y-m-d", strtotime("+1day", strtotime($d9)));
		    $ssbpl1=$this->Common_model->getEntryOnDate("market_pat_agents_pro","assigned_enty_date",$d9);
			array_push($data['new9'],$ssbpl1);
	          }
			  
			  for($i=0;$i<=$diff;$i++)
			{
			$fetchdata=9;
			$fetchd3=0;
			
		    $d10=date("Y-m-d", strtotime("+1day", strtotime($d10)));
		    $ssbpl1=$this->Common_model->getEntryOnDate("mrd_checklist","mrd_chk_entrydt",$d10);
			array_push($data['new10'],$ssbpl1);
	          }
			
			// print_r($data['new10']);
			// die();
			
		$this->template->write_view('content', 'admin/FREG0006/entry_log',$data);
		$this->template->write_view('footer', 'default/footer');
		$this->template->render();
	} 
		else
		{
			 redirect('auth/login');	
		}		
	}
	
	public function alldepview()
	{
		if($this->ion_auth->logged_in()){
		
		    $data['message'] = $this->session->flashdata('message');
		   /*$data['state'] =$this->Address->state();
		    $data['district'] =$this->Address->district('24');
			$data['bpldisease'] = $this->Common_model->get_data_by_query('select DISTINCT  Disease_catigory from bpldisease ');
		    $data['doc_name'] =$this->Common_model->get_data_by_query('select * from doctor order by doc_name ');
			*/
			
			 $currentdate=date('Y-m-d');
			
			//$data['opd_pt']=$this->Common_model->get_data_by_query("select * from opd_patient");
					//list the users
		  

           // $data['ipd_p_scheme2']=$this->Common_model->get_data_by_query("select * from ipd_admit a join patient p on a.admit_uhid = p.id join casualty c on a.admit_uhid=c.casu_uhid where a.admit_status in ('CP','NA') and c.casu_scheme='2' and c.pat_status='NR'");


	     
			
			$this->template->set_template('user');
			$this->template->write_view('header', 'default/header',$this->session->userdata);
			$this->template->write_view('sidebar', 'default/sidebar');
			$this->template->write_view('content', 'admin/FREG0006/alldepview',$data);
			 //$this->template->write_view('content', 'auth/index',);
			$this->template->write_view('footer', 'default/footer');
			$this->template->render();
		}else{
			redirect('auth/login');	
		}		
	}
	
		public function changeGroupCasu()
	{
		if($this->ion_auth->logged_in()){
			
		  print_r($this->session->all_userdata());
		  
		  $this->session->set_userdata('group', 'casualty');
			// die();
			redirect('admin/CASU00010/casualty_getdata', $this->data['users']);
		}
		
	}
	
	
	public function SearchIpdReadmits()
	{
		$uhid=$_POST['uhid'];
		$reg=$_POST['reg'];
		$first_name=$_POST['first_name'];
		$last_name=$_POST['last_name'];
		$fa_hus_name=$_POST['fa_hus_name'];
		$address=$_POST['srch_address'];
		// echo 'dfffffffffffffffffff';
		// $dt=date('d-m-Y');
		
				if($uhid !='')
				{
					$uhid =$uhid.'@uhid';
				}
				if($reg !='')
				{
					$reg =$reg.'@reg';
				}	
				if($first_name !='')
				{
					$first_name =$first_name.'@first_name';
				}	
				if($last_name !='')
				{
					$last_name =$last_name.'@last_name';
				}
				if($fa_hus_name !='')
				{
					$fa_hus_name =$fa_hus_name.'@fa_hus_name';
				}
				if($address !='')
				{
					$address =$address.'@address';
				}	
				$querry='';
			$serchitem = array($uhid,$reg,$first_name,$last_name,$fa_hus_name,$address);
			
			foreach ($serchitem as &$value) 
			{
				if($value=='select')
				{
				}
				else if($value=='')
				{
				}
				else
				{
					$value_aryy = explode ( "@", $value );
					$data = $value_aryy [0];
					$filed = $value_aryy [1];
				
				if($filed=='uhid')
				{
				  $querry .= " and ip.casu_uhid = "."'".$data."'";
				}
				else if($filed=='reg')
				{
				  $querry .= " and ip.casu_id= "."'".$data."'";
				}
				else if($filed=='first_name')
				{
				  $querry .=" and p.first_name like "."'%".$data."%'";
				}
				else if($filed=='last_name')
				{
				  $querry .=" and p.last_name like "."'%".$data."%'";
				}
				else if($filed=='last_name')
				{
				  $querry .=" and p.last_name like "."'%".$data."%'";
				}
				else if($filed=='fa_hus_name')
				{
				  $querry .=" and p.fa_hus_name like "."'%".$data."%'";
				}
				else if($filed=='address')
				{
				  $querry .=" and p.address  like "."'%".$data."%'";
				}
			}
			}
			$ipdpat = $this->Common_model->get_data_by_query("select p.id,p.first_name,p.last_name,p.middle_name,p.consultant,p.address,p.fa_hus_name,ip.casu_id,casu_uhid from patient p inner join casualty ip on ip.casu_uhid = p.id where 1=1 $querry group by p.id limit 50 ");
			// echo $this->db->last_query();die;
			$sl = 0;foreach($ipdpat as $ipd)
			{$sl++;
			?>
			<tr>	
				<td><?php echo $sl?></td>
				<td><?php echo $ipd['casu_uhid']?></td>
				<td><?php echo $ipd['casu_id']?></td>
				<td><?php echo $ipd['first_name']." ".$ipd['middle_name']." ".$ipd['last_name']?></td>
				<td><?php echo $ipd['fa_hus_name']?></td>
				<td><?php echo @$this->Common_model->getSchemeName($ipd['admit_id'],$ipd['admit_uhid'],'IPD');?></td>
				<td><?php echo $ipd['consultant']?></td>
				<td>
				<a  href="<?php echo base_url().'admin/FREG0006/readmitForm/'.$ipd['casu_uhid'] ; ?>"  >
					<button class='btn red' style='border: 3px solid black;'>Readmit</button>
				</a>
				</td>
			</tr>	
			<?php }
			}
	
		
	public function SearchOpdReadmits()
	{
		$uhid=$_POST['uhid'];
		$reg=$_POST['reg'];
		$first_name=$_POST['first_name'];
		$last_name=$_POST['last_name'];
		$fa_hus_name=$_POST['fa_hus_name'];
		$address=$_POST['srch_address'];
				if($uhid !='')
				{
					$uhid =$uhid.'@uhid';
				}
				if($reg !='')
				{
					$reg =$reg.'@reg';
				}	
				if($first_name !='')
				{
					$first_name =$first_name.'@first_name';
				}	
				if($last_name !='')
				{
					$last_name =$last_name.'@last_name';
				}
				if($fa_hus_name !='')
				{
					$fa_hus_name =$fa_hus_name.'@fa_hus_name';
				}
				if($address !='')
				{
					$address =$address.'@address';
				}	
				$querry='';
			$serchitem = array($uhid,$reg,$first_name,$last_name,$fa_hus_name,$address);
			
			foreach ($serchitem as &$value) 
			{
				if($value=='select')
				{
				}
				else if($value=='')
				{
				}
				else
				{
					$value_aryy = explode ( "@", $value );
					$data = $value_aryy [0];
					$filed = $value_aryy [1];
				
				if($filed=='uhid')
				{
				  $querry .= " and opd.uhid = "."'".$data."'";
				}
				else if($filed=='reg')
				{
				  $querry .= " and opd.id= "."'".$data."'";
				}
				else if($filed=='first_name')
				{
				  $querry .=" and p.first_name like "."'%".$data."%'";
				}
				else if($filed=='last_name')
				{
				  $querry .=" and p.last_name like "."'%".$data."%'";
				}
				else if($filed=='last_name')
				{
				  $querry .=" and p.last_name like "."'%".$data."%'";
				}
				else if($filed=='fa_hus_name')
				{
				  $querry .=" and p.fa_hus_name like "."'%".$data."%'";
				}
				else if($filed=='address')
				{
				  $querry .=" and p.address  like "."'%".$data."%'";
				}
			}
			}
			$opdpatient = $this->Common_model->get_data_by_query("select opd.uhid,opd.id as opdid,p.first_name,p.middle_name,p.last_name,p.fa_hus_name,p.consultant from opd_patient opd left join patient p on p.id = opd.uhid where 0=0 $querry group by opd.uhid limit 50");
			$sl = 0;foreach($opdpatient as $opd)
			{$sl++;
			?>
			<tr>	
				<td><?php echo $sl?></td>
				<td><?php echo $opd['uhid']?></td>
				<td><?php echo $opd['opdid']?></td>
				<td><?php echo $opd['first_name']." ".$opd['middle_name']." ".$opd['last_name']?></td>
				<td><?php echo $opd['fa_hus_name']?></td>
				<td><?php echo @$this->Common_model->getSchemeName($opd['opdid'],$opd['uhid'],'OPD');?></td>
				<td><?php echo $opd['consultant']?></td>
				<td>
					<a  href="<?php //echo base_url().'admin/FREG0006/readmitForm/'.$opd['uhid'];?>">
						<button class='btn span12 purple' style='border: double'>Readmit</button>
					</a>
				</td>
			</tr>	
			<?php }
			}

             public function patientsetlimit()
	{
	  
	 $this->template->set_template('user');
			$this->template->write_view('header', 'default/header',$this->session->userdata);
			$this->template->write_view('sidebar', 'default/sidebar');
			$data['result'] = $this->Common_model->get_data_by_query("select * from set_limit  where 0=0 ");
            $this->template->write_view('content', 'admin/FREG0006/patientsetlimit',$data);
			$this->template->write_view('footer', 'default/footer');
			$this->template->render();
	 }
	public function addlimit()
	{
		
		
		$addlimit=$_POST['addlimit'];
		$uhidl=$_POST['uhidl44'];
		// die;
		$result = $this->Common_model->get_data_by_query("select * from set_limit  where limit_uhid=$uhidl");
		?>
		           <div class="row-fluid" >
		<div class="span6 ">
			<table  id="sample_editable_1" cellpadding="4" cellspacing="0" width="100%" border="0" class="CSSTableGenerator10">
                          <tbody  id='opdresult'>

                            
  					
                              <tr>
                                <td>Date</td>
                               
                                <td>Total Limit</td>
                                <td>Medicine</td>
								<td>Investigation</td>
                                <td>Hospital</td>
                                <td>Action</td>
                              
                              </tr>
							  
							
							
							   <tr class="">
                                <td><center><?php echo date('d-m-Y'); ?></center></td>
                                <td id="dt2">
								<center>
								<?php echo $addlimit; ?>
								
								</center></td>
                             
                                <td><input type="text" value="0"  id="medi_amt"    onkeyup="cheklimit();"  name="medi_amt" placeholder="Set Medicine Limit...."
								class="m-wrap span12" >
								<input type="hidden" name="total_limit" id="total_limit" value="<?php echo $addlimit; ?>">
								<input type="hidden" name="limit_uhid" id="limit_uhid" value="<?php echo $uhidl; ?>">
								<input type="hidden" name="limit_ipd" id="limit_ipd" value="<?php //echo $ipdidl; ?>">
								</td>
                                <td><input type="text" value="0" id="inve_amt"     onkeyup="cheklimit();" placeholder="Set Investigation Limit......"  name="inve_amt"  class="m-wrap span12" ></td>
                                <td><input type="text" value="0"  id="hos_amt"    onkeyup="cheklimit();" onchange="validationcheklimit();" placeholder="Set Hospital Limit...."  name="hos_amt"  class="m-wrap span12" ></td>
                                <td><center><a  class="config" onclick="savelimit();">
								    <button type="button"  class="btn " style="background-color:#44DED8">
									Save
									</button> 
								</a></center></td>
								
                               
                           </tr>
                              <script>
		function cheklimit()
		{
		
			                    var valu1=0;
								var valu2=0;
								var valu3=0;
								var valu4=0;
								var valu5=0;
								
								
								// valu1=(document.getElementById("medi_amt").value);
								valu1=parseInt($("#medi_amt").val());
								// valu2=(document.getElementById("inve_amt").value);
								valu2=parseInt($("#inve_amt").val());
								// valu3=(document.getElementById("hos_amt").value);
								valu3=parseInt($("#hos_amt").val());
								// valu5=(document.getElementById("total_limit").value);
								valu5=parseInt($("#total_limit").val());
								// alert(valu1);
								// alert(valu2);
								// alert(valu3);
							    // if(valu1=='NaN')
								// {
									// valu1=0;
								// } 
								// if(valu2=='NaN' ||  valu2=='' || valu2==null)
								// {
									// valu2=0;
									// alert(valu2);
								// } 
								// if(valu3=='NaN')
								// {
									// valu3=0;
								// }
								
							
							
							
							
								  valu4 =  valu1 + valu2 + valu3;
								
									  total = valu5-valu4;
									 
									  $('#dt2').html(total);
									  if(valu4 > valu5){
									
									alert("Patient Limit Over ");
									
									$("#hos_amt").val(0);
									 $('#dt2').html(0);
								}
								
								// document.getElementById("td1").value=total;	
				                    //$("#td2").html();
		}
		
		</script>  
			 <script>
		function validationcheklimit()
		{
		
			                    var valu1=0;
								var valu2=0;
								var valu3=0;
								var valu4=0;
								var valu5=0;
								
								
								
								valu1=parseInt($("#medi_amt").val());
							
								valu2=parseInt($("#inve_amt").val());
								
								valu3=parseInt($("#hos_amt").val());
								
								valu5=parseInt($("#total_limit").val());
							
							
								  valu4 =  valu1 + valu2 + valu3;
								
									  total = valu5-valu4;
									 
									 
									 
								if(valu4 < valu5){
									
									alert("Patient Limit Below ");
									
									$("#hos_amt").val(0);
									 $('#dt2').html(0);
								}
								
								
		}
		
		</script>  
						
							 
							  
							  
							  
							  <?php 
							  $tlimit=0;
							  $mlimit=0;
							  $ilimit=0;
							  $hlimit=0;
							  foreach($result as $ft){
							  $tlimit=$tlimit+$ft['limit_total_amt'];
							  $mlimit=$mlimit+$ft['limit_medi_amt'];
							  $ilimit=$ilimit+$ft['limit_inv_amt'];
							  $hlimit=$hlimit+$ft['limit_hos_amt'];
							  
							  
							  ?>
                        <tr>
                                <td><center><?php echo date('d-m-Y',strtotime($ft['limit_entrydt'])); ?></center></td>
                                <td><center><?php echo $ft['limit_total_amt']; ?></center></td>
                                <td><center><?php echo $ft['limit_medi_amt']; ?></center></td>
                                <td><center><?php echo $ft['limit_inv_amt']; ?></center></td>
                                <td><center><?php echo $ft['limit_hos_amt']; ?></center></td>
                               
                             <td><center> <!--<a  class="config" onclick="deleterow('<?php echo $ft['limit_id']; ?>','<?php echo $ft['limit_uhid']; ?>')">
								    <button type="button"  class="btn red"  style="background-color:#44DED8">
									Delete
									</button> 
								</a></center>--></td>
								
								
                               
                           </tr>
							  <?php } ?>
							   <tr>
                        <td colspan="1" style="font-size:14px; color:#00C;"><strong>Total </strong></td>
                        <td style="font-size:14px; color:#900;"><strong><?php echo $tlimit; ?></strong></td>
                        <td colspan="1" style="font-size:14px; color:#00C;"><strong> <?php echo $mlimit; ?></strong></td>
                        <td colspan="1" style="font-size:14px; color:#00C;"><strong> <?php echo $ilimit; ?></strong></td>
                        <td colspan="1" style="font-size:14px; color:#00C;"><strong> <?php echo $hlimit; ?></strong></td>
                        <td colspan="1" style="font-size:14px; color:#00C;"><strong> </strong></td>
                    
                      </tr>
                            </tbody>

                          </table>
						  </div>
						  <div class="span6 ">
				<table  id="sample_editable_1" cellpadding="4" cellspacing="0" width="100%" border="0" class="CSSTableGenerator10">
                          <tbody  id='opdresult'>

                            
  					
                              <tr>
                                <td>Amount</td>
                               
                             
                                <td>Medicine</td>
								<td>Investigation</td>
                                <td>Hospital</td>
                                <td>Action</td>
                              
                              </tr>
							  <?php 
							  $medicin1=0;
							  $investi1=0;
							  $hospital1=0;
							  $count=0;
							  foreach($result as $ft){
								   $count++;
							   $uhid=$ft['limit_uhid'];
							   
							   $hospital = $this->Common_model->get_data_by_query("select sum(tran_amount) as total from transaction_bill where   tran_uhid=$uhid "); 
								
								
								$inves = $this->Common_model->get_data_by_query("select sum(tran_amount) as total from transaction where   tran_uhid=$uhid  and tran_paidstatus='NO' ");
								
                      // $medi = $this->Common_model->get_data_by_query("select sum(invoice_amt) as total from pd_invoice_cr where  invoice_uhid=$uhid  and invoice_converted=1 "); 
					  
					   $medi=$this->Common_model->get_data_by_query("select sum(`pd_tran_amt`) as total from pd_transaction where pd_tran_type in ('1','6') and pd_tran_uhid = $uhid");
								
								$hospital= $hospital[0]['total'];
								$inves= $inves[0]['total'];
								$medicin= $medi[0]['total'];
								$medicin1=$medicin1+$medicin;
								$investi1=$investi1+$inves;
								$hospital1=$hospital1+$hospital;
								
							if($count==1){
							  ?>
                        <tr>
                                 <td style="font-size:14px; color:#00C;"><center><?php //echo $ft['limit_total_amt']; ?></center></td>
                                 <td style="font-size:14px; color:#00C;"><center><?php echo $medicin; ?></center></td>
                                 <td style="font-size:14px; color:#00C;"><center><?php echo $inves; ?></center></td>
                                 <td style="font-size:14px; color:#00C;"><center><?php echo $hospital; ?></center></td>
                               
                                
                                 
                             
                               
                                <td><center></center></td>
								
                               
                           </tr>
							  <?php } }?>
							 
                            </tbody>

                          </table>
						  </div>
						  </div>
		
		
			 
	<?php }
	
	public function savelimit()
	{
		
		
		$medi_amt=$_POST['medi_amt'];
		$inve_amt=$_POST['inve_amt'];
		$hos_amt=$_POST['hos_amt'];
		$total_limit=$_POST['total_limit'];
		$limit_uhid=$_POST['limit_uhid'];
	
		
		
		
		$userid=(array_slice($this->session->userdata,9,1));
		$data['limit_user']  =$userid['user_id'];
		$data['limit_medi_amt']=$medi_amt;
		$data['limit_inv_amt']=$inve_amt;
		$data['limit_hos_amt']=$hos_amt;
		$data['limit_total_amt']=$total_limit;
		$data['limit_uhid']=$limit_uhid;
		// $data['limit_ipdid']=$limit_ipd;
		
		
		
		$data['limit_entrydt']=date('Y-m-d h:i:s');
	
		$this->Crud_model->insert_record('set_limit',$data);
		
		$result = $this->Common_model->get_data_by_query("select * from set_limit  where limit_uhid=$limit_uhid ");
		
		
		
		?>
			<div class="row-fluid" >
		<div class="span6 ">
			<table  id="sample_editable_1" cellpadding="4" cellspacing="0" width="100%" border="0" class="CSSTableGenerator10">
                          <tbody  id='opdresult'>

                            
  					
                              <tr>
                                <td>Date</td>
                               
                                <td>Total Limit</td>
                                <td>Medicine</td>
								<td>Investigation</td>
                                <td>Hospital</td>
                                <td>Action</td>
                              
                              </tr>
							  <?php 
							  $tlimit=0;
							  $mlimit=0;
							  $ilimit=0;
							  $hlimit=0;
							  foreach($result as $ft){
							  $tlimit=$tlimit+$ft['limit_total_amt'];
							  $mlimit=$mlimit+$ft['limit_medi_amt'];
							  $ilimit=$ilimit+$ft['limit_inv_amt'];
							  $hlimit=$hlimit+$ft['limit_hos_amt'];
							  
							  
							  ?>
                        <tr>
                                <td><center><?php echo date('d-m-Y',strtotime($ft['limit_entrydt'])); ?></center></td>
                                <td><center><?php echo $ft['limit_total_amt']; ?></center></td>
                                <td><center><?php echo $ft['limit_medi_amt']; ?></center></td>
                                <td><center><?php echo $ft['limit_inv_amt']; ?></center></td>
                                <td><center><?php echo $ft['limit_hos_amt']; ?></center></td>
                               
                             <td><center> <!--<a  class="config" onclick="deleterow('<?php echo $ft['limit_id']; ?>','<?php echo $ft['limit_uhid']; ?>')">
								    <button type="button"  class="btn red"  style="background-color:#44DED8">
									Delete
									</button> 
								</a></center>--></td>
								
								
                               
                           </tr>
							  <?php } ?>
							   <tr>
                        <td colspan="1" style="font-size:14px; color:#00C;"><strong>Total </strong></td>
                        <td style="font-size:14px; color:#900;"><strong><?php echo $tlimit; ?></strong></td>
                        <td colspan="1" style="font-size:14px; color:#00C;"><strong> <?php echo $mlimit; ?></strong></td>
                        <td colspan="1" style="font-size:14px; color:#00C;"><strong> <?php echo $ilimit; ?></strong></td>
                        <td colspan="1" style="font-size:14px; color:#00C;"><strong> <?php echo $hlimit; ?></strong></td>
                        <td colspan="1" style="font-size:14px; color:#00C;"><strong> </strong></td>
                    
                      </tr>
                            </tbody>

                          </table>
						  </div>
						  <div class="span6 ">
				<table  id="sample_editable_1" cellpadding="4" cellspacing="0" width="100%" border="0" class="CSSTableGenerator10">
                          <tbody  id='opdresult'>

                            
  					
                              <tr>
                                <td>Amount</td>
                               
                             
                                <td>Medicine</td>
								<td>Investigation</td>
                                <td>Hospital</td>
                                <td>Action</td>
                              
                              </tr>
							  <?php 
							  $medicin1=0;
							  $investi1=0;
							  $hospital1=0;
							  $count=0;
							  foreach($result as $ft){
								  $count++;
							   $uhid=$ft['limit_uhid'];
							   $hospital = $this->Common_model->get_data_by_query("select sum(tran_amount) as total from transaction_bill where   tran_uhid=$uhid "); 
								
								
								$inves = $this->Common_model->get_data_by_query("select sum(tran_amount) as total from transaction where   tran_uhid=$uhid  and tran_paidstatus='NO' ");
								
                      // $medi = $this->Common_model->get_data_by_query("select sum(invoice_amt) as total from pd_invoice_cr where  invoice_uhid=$uhid  and invoice_converted=1 "); 
					  
					   $medi=$this->Common_model->get_data_by_query("select sum(`pd_tran_amt`) as total from pd_transaction where pd_tran_type in ('1','6') and pd_tran_uhid = $uhid");
								
								$hospital= $hospital[0]['total'];
								$inves= $inves[0]['total'];
								$medicin= $medi[0]['total'];
								$medicin1=$medicin1+$medicin;
								$investi1=$investi1+$inves;
								$hospital1=$hospital1+$hospital;
								if($count==1){
								
							  ?>
                        <tr>
                                 <td style="font-size:14px; color:#00C;"><center><?php //echo $ft['limit_total_amt']; ?></center></td>
                                 <td style="font-size:14px; color:#00C;"><center><?php echo $medicin; ?></center></td>
                                 <td style="font-size:14px; color:#00C;"><center><?php echo $inves; ?></center></td>
                                 <td style="font-size:14px; color:#00C;"><center><?php echo $hospital; ?></center></td>
                               
                                
                                 
                             
                               
                                <td><center></center></td>
								
                               
                           </tr>
							  <?php } }?>
							  
                            </tbody>

                          </table>
						  </div>
						  </div>
		
		
			 
	<?php }
	public function deleterow()
	{
		
		
		 $id=$_POST['id'];
	 $uhid=$_POST['uhid'];
		
		$this->Crud_model->delete_record_any_id('set_limit',$id,'limit_id');
		// echo $this->db->last_query();
		// die;
		
	   $result = $this->Common_model->get_data_by_query("select * from set_limit  where limit_uhid=$uhid ");
		
		
		
		?>
			<div class="row-fluid" >
		<div class="span6 ">
			<table  id="sample_editable_1" cellpadding="4" cellspacing="0" width="100%" border="0" class="CSSTableGenerator10">
                          <tbody  id='opdresult'>

                            
  					
                              <tr>
                                <td>Date</td>
                               
                                <td>Total Limit</td>
                                <td>Medicine</td>
								<td>Investigation</td>
                                <td>Hospital</td>
                                <td>Action</td>
                              
                              </tr>
							  <?php 
							  $tlimit=0;
							  $mlimit=0;
							  $ilimit=0;
							  $hlimit=0;
							  foreach($result as $ft){
							  $tlimit=$tlimit+$ft['limit_total_amt'];
							  $mlimit=$mlimit+$ft['limit_medi_amt'];
							  $ilimit=$ilimit+$ft['limit_inv_amt'];
							  $hlimit=$hlimit+$ft['limit_hos_amt'];
							  
							  
							  ?>
                        <tr>
                                <td><center><?php echo date('d-m-Y',strtotime($ft['limit_entrydt'])); ?></center></td>
                                <td><center><?php echo $ft['limit_total_amt']; ?></center></td>
                                <td><center><?php echo $ft['limit_medi_amt']; ?></center></td>
                                <td><center><?php echo $ft['limit_inv_amt']; ?></center></td>
                                <td><center><?php echo $ft['limit_hos_amt']; ?></center></td>
                               
                                 <td><center><a  class="config" onclick="deleterow(<?php echo $ft['limit_id']; ?>)">
								    <button type="button"  class="btn red"  style="background-color:#44DED8">
									Delete
									</button> 
								</a></center></td>
								
                               
                           </tr>
							  <?php } ?>
							   <tr>
                        <td colspan="1" style="font-size:14px; color:#00C;"><strong>Total </strong></td>
                        <td style="font-size:14px; color:#900;"><strong><?php echo $tlimit; ?></strong></td>
                        <td colspan="1" style="font-size:14px; color:#00C;"><strong> <?php echo $mlimit; ?></strong></td>
                        <td colspan="1" style="font-size:14px; color:#00C;"><strong> <?php echo $ilimit; ?></strong></td>
                        <td colspan="1" style="font-size:14px; color:#00C;"><strong> <?php echo $hlimit; ?></strong></td>
                        <td colspan="1" style="font-size:14px; color:#00C;"><strong> </strong></td>
                    
                      </tr>
                            </tbody>

                          </table>
						  </div>
						  <div class="span6 ">
				<table  id="sample_editable_1" cellpadding="4" cellspacing="0" width="100%" border="0" class="CSSTableGenerator10">
                          <tbody  id='opdresult'>

                            
  					
                              <tr>
                                <td>Amount</td>
                               
                             
                                <td>Medicine</td>
								<td>Investigation</td>
                                <td>Hospital</td>
                                <td>Action</td>
                              
                              </tr>
							  <?php 
							  $medicin1=0;
							  $investi1=0;
							  $hospital1=0;
							  $count=0;
							  foreach($result as $ft){
								  $count++;
							   $uhid=$ft['limit_uhid'];
							  $hospital = $this->Common_model->get_data_by_query("select sum(tran_amount) as total from transaction_bill where   tran_uhid=$uhid "); 
								
								
								$inves = $this->Common_model->get_data_by_query("select sum(tran_amount) as total from transaction where   tran_uhid=$uhid  and tran_paidstatus='NO' ");
								
                      // $medi = $this->Common_model->get_data_by_query("select sum(invoice_amt) as total from pd_invoice_cr where  invoice_uhid=$uhid  and invoice_converted=1 "); 
					  
					   $medi=$this->Common_model->get_data_by_query("select sum(`pd_tran_amt`) as total from pd_transaction where pd_tran_type in ('1','6') and pd_tran_uhid = $uhid");
								
								$hospital= $hospital[0]['total'];
								$inves= $inves[0]['total'];
								$medicin= $medi[0]['total'];
								$medicin1=$medicin1+$medicin;
								$investi1=$investi1+$inves;
								$hospital1=$hospital1+$hospital;
								
								if($count==1){
							  ?>
                        <tr>
                                 <td style="font-size:14px; color:#00C;"><center><?php //echo $ft['limit_total_amt']; ?></center></td>
                                 <td style="font-size:14px; color:#00C;"><center><?php echo $medicin; ?></center></td>
                                 <td style="font-size:14px; color:#00C;"><center><?php echo $inves; ?></center></td>
                                 <td style="font-size:14px; color:#00C;"><center><?php echo $hospital; ?></center></td>
                               
                                
                                 
                             
                               
                                <td><center></center></td>
								
                               
                           </tr>
							  <?php } }?>
							   
                            </tbody>

                          </table>
						  </div>
						  </div>
		
		
			 
	<?php }
	
public function repmodel()
	{
		
		
		 $uhidl=$_POST['uhidl'];
		
		// die();
		
	   $data['result'] = $this->Common_model->get_data_by_query("select * from set_limit  where limit_uhid=$uhidl ");
	   $data['patient'] = $this->Common_model->get_data_by_query("select * from patient  where id=$uhidl ");
	   $data['uhid']=$uhidl; 
	 
	   
		// $this->template->write_view('content', 'admin/BPLD0008/patientsetlimit',$data);
		
		$this->load->view('admin/BPLD0008/patientsetlimit',$data);
		
		?>
			 
		<script>
			function addlimitset(){
				
		var addlimit=$("#addlimit").val();
		var ipdidl=$("#ipdidl").val();
		var uhidl=$("#uhidl").val();
		
				$.ajax({   
				type: "POST",  
				url: "<?php echo base_url('admin/FREG0006/addlimit/'); ?>",  
				data: "addlimit="+addlimit+"&ipdidl="+ipdidl+"&uhidl="+uhidl, 

				success: function(msg){  
				$("#showtable").html(msg); 
				}  
				});

				}
			 </script>
			
			 <script>
			function deleterow(id){
				
		
		//alert(id);
				$.ajax({   
				type: "POST",  
				url: "<?php echo base_url('admin/FREG0006/deleterow/'); ?>",  
				data: "id="+id, 

				success: function(msg){ 
                  alert(msg)				
				$("#reptable").html(msg); 
				}  
				});

				}
			 </script>
		
			 
	<?php }
	
	public function cheklimit1()
	{
		
		
		@$medi_amt=$_POST['medi_amt'];
		@$inve_amt=$_POST['inve_amt'];
		@$hos_amt=$_POST['hos_amt'];
		 @$lamt=$_POST['lamt'];
		
		$total=@$medi_amt-@$inve_amt;
		@$all=@$lamt-$total;
	 
		
		?>
			 
		  <td id="td1"><center><?php echo @$all; ?></center></td>
			 
	<?php }
	

     			
	}
