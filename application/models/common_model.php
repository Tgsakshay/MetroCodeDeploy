<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Common_model extends CI_Model 
	{
        function __construct()
        {
            parent::__construct();
				$this->load->library('zend');
			//load in folder Zend
	$this->zend->load('Zend/Barcode');
        }
		public function get_all_data($tbl)
		{
			$this->db->from($tbl);
			$this->db->order_by('createdate','desc');
			$query = $this->db->get();
			return $query->result_array();
		}
        
		public function insert1($table,$data)
		{
			$this->db->insert($table,$data);
		}
		
		public function update_record($table,$updateid,$data)
		{
			$this->db->where('id',$updateid);
			$this->db->update($table,$data);
		}
		
		
		public function get_data($qry)
		{
			$query = $this->db->query($qry);	
			return $query;
		}
		
		public function generate_id($table)
		{
			$this->db->select('max(id) as id');
			$this->db->from($table);
			$query = $this->db->get();
			return $query->row();
		}
		 public function findfield($table,$fieldname1,$fieldvalue1,$returnfield)
		  {
			$this->db->select($returnfield);
			$this->db->from($table);
			$this->db->where($fieldname1,$fieldvalue1);
			$query = $this->db->get();
			foreach ($query->result() as $value)
			{}
			return $value->$returnfield;
  		  }
		
		public function get_record_by_id_caus($tbl,$id)
		{
			$this->db->from($tbl);
			$this->db->where('casu_id',$id);
			$query = $this->db->get();
			return $query->row();
		}
		public function getuserName($userid)
		{
			$query = $this->db->query("SELECT username,first_name,last_name  FROM users  WHERE id='$userid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['first_name'].' '.$row['last_name'];
			} else {
			}
		}
		
		public function generate_code($table,$prefix="",$suffix="")
		{
			$c=0;
			//$qry = "select IFNULL(max(code),0) from $table";
			$qry = "select code from $table where id = (select max(id) from $table)";
			$query = $this->db->query($qry);	
			$code = $query->result();
			if(!empty($code)){
				$c = (int)substr($code[0]->code,-4,8)+1;
			}else{
				$c = 1;	
			}
			return $prefix.str_pad($c , 8, "0", STR_PAD_LEFT).$suffix;
		}
		
		
		
		
		public function get_record_by_id($tbl,$id)
		{
			$this->db->from($tbl);
			$this->db->where('id',$id);
			$query = $this->db->get();
			return $query->row();
		}
		
		public function get_constant_by_value($const)
		{
			$this->db->from('constant_master c');	
			$this->db->join('type_master t','t.constantid = c.id');
			$this->db->where('constvalue',$const);
			$query = $this->db->get();
			return $query->result_array();
		}
		
		public function search_record($tbl,$code="",$name="",$dt_from="",$dt_to="")
		{
			$this->db->from($tbl);
			
			if($code!="" && $name=="" && $dt_from=="")
			{
				$this->db->where('code',$code);	
			}else if($code=="" && $name !="" && $dt_from=="")
			{
				$this->db->where('fname',$name);		
			}else if($code=="" && $name =="" && $dt_from !="")
			{
				$this->db->where('name',$name);	
			}
			$query = $this->db->get();
			return $query->result_array();
		}
		
		public function get_limited_record($tbl,$limit, $start,$groupby='')
		{
			$this->db->limit($limit, $start);
			if(!empty($groupby))
			{
				$this->db->group_by($groupby);	
			}
			$query = $this->db->get($tbl);
	 
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data[] = $row;
				}
				return $data;
			}
			return false;	
		}
		
		public function get_total_record($tbl,$groupby='')
		{
			$this->db->from($tbl);
			if(!empty($groupby))
			{
				$this->db->group_by($groupby);	
			}
			$query = $this->db->get();
			return $query->num_rows();	
		}
		
		public function get_multiple_record_byid($tbl,$id,$field="id")
		{
			$this->db->from($tbl);
			$this->db->where($field,$id);
			$query = $this->db->get();
			return $query->result_array();
		}
		
		public function get_data_from_two_table($tbl1,$tbl2,$fields,$on_cond,$condition='')
		{
			$this->db->select($fields);
			$this->db->from($tbl1);
			$this->db->join($tbl2,$on_cond);
			if(!empty($condition))
			{
				$this->db->where($condition);	
			}
			$query = $this->db->get();
			return $query->result_array();
		}
		
		public function get_data_from_three_table($tbl1,$tbl2,$tbl3,$fields,$on_cond1,$on_cond2,$condition="")
		{
			$this->db->select($fields);
			$this->db->from($tbl1);
			$this->db->join($tbl2,$on_cond1);
			$this->db->join($tbl3,$on_cond2);
			if(!empty($condition))
			{
				$this->db->where($condition);	
			}
			$this->db->order_by('id','asc');
			$query = $this->db->get();
			return $query->result_array();
		}
		
		public function get_specific_field_byid($tbl,$fields,$cond)
		{
			$this->db->select($fields);
			$this->db->from($tbl);
			$this->db->where($cond);
			$query = $this->db->get();
			return $query->result();
		}
		
		public function isAnesthetic($apinch,$genid)
		{
			$status = 0;
			$apinch = explode('#',$apinch);
			$array = array(341,345,338,408,609,339,347,2658,5582,5456,5606,335,97,107,6029,6447,600,240,340,343,5623,6616,5522,3882,4447,559,447,125,5692,5556,240,6644); 
 
			if(in_array($genid,$array) or @$apinch[1]==1 or @$apinch[2] ==1 or @$apinch[3] == 1 or @$apinch[4] == 1)
			{
				$status = 1;
			}
			return $status;
		}
		
		
		public function isAnesthetic2($apinch,$genid,$pd_sale_ipdid)
		{
			$status = 0;
			$apinch= explode('#',$apinch);
			$array = array(341,345,338,408,609,339,347,2658,5582,5456,5606,335,97,107,6029,6447,600,240,340,343,5623,6616,5522,3882,4447,559,447,125,5692,5556,240,6644); 
 
          $data=array();
			if(in_array($genid,$array) or @$apinch[1]==1 or @$apinch[2] ==1 or @$apinch[3] == 1 or @$apinch[4] == 1)
			{
				$status = 1;
				$data['pd_sale_ipdid22'] = $pd_sale_ipdid ;
				$data['status22'] = $status;
			}
			
			// print_r($data);
			return($data);
		}
		
		public function get_data_by_query($qry)
		{
			$query = $this->db->query($qry);	
			return $query->result_array();
		}
		
		public function get_record_by_fieldvalue($tbl,$field,$value)
		{
			$this->db->from($tbl);
			$this->db->where($field,$value);
			$query = $this->db->get();
			return $query->row();
		}
		public function get_data_by_query_bpl()
		{
			$query = $this->db->query("SELECT a.*,b.first_name,b.middle_name,b.last_name ,b.fa_hus_name,b.contact_no,b.patient_age,b.patient_gender,b.address FROM `patient` b  
left join bpl_patient a on a.uhid=b.id 
where a.scheme_type='2' and (a.status='Forwarded for Approval' or a.status='Approved' or a.status='Rejected') order by a.bpl_reg_date desc");	
			return $query->result_array();
		}
		
		
		public function get_data_by_query_mpboc()
		{
			$query = $this->db->query("SELECT a.*,b.first_name,b.middle_name,b.last_name ,b.fa_hus_name,b.contact_no,b.patient_age,b.patient_gender,b.address FROM `patient` b  
left join bpl_patient a on a.uhid=b.id 
where a.scheme_type='2' and (a.status='Forwarded for Approval' or a.status='Approved' or a.status='Rejected') order by a.bpl_reg_date desc");	
			return $query->result_array();
		}
		
				  //=== fill dynamic combo ========================
  	
		
		 // public function FillDynamicCombo($query,$datafield,$textfield,$selectvalue)  {
		 
	
		  
		
	    // $rs = $this->db->query($query);
			// $i=1;
			// $selectvalue1="";
			// if ($rs->num_rows() > 0)
			// {
			
		// foreach($rs as $row){
		  // if($i==1)
		  // $selectvalue1=$row->$datafield;
		  
		  // if($selectvalue==$row->$datafield){
			  // echo'<option value="'.$row->$datafield.'" selected>'.$row->$textfield.'</option>';
			  // $selectvalue1=$selectvalue;
			// }
		  // else {
			// echo'<option value="'.$row->$datafield.'">'.$row->$textfield.'</option>';
		   // }
		   // $i++;
		   // }
		// }
		
	// }
	

	public function FillDynamicCombo($query)  {	
	
	$data['result'] = $this->Common_model->get_data_by_query("$query");
		
				 $option="";
				    foreach ($data['result'] as $key=>$value)
	             {
					 
					 $option= $option." "."<option>".$value['dep_name']."</option>";
				 }
		
		
		return $option;
    }
	public function locatePatient($ipd_id,$uhid)
		{
			$query = $this->db->query("select admit_floor,admit_ward,admit_bed from ipd_admit where admit_id= '$ipd_id' and admit_uhid = '$uhid' ");
			return $query->result();
		}
		
	public function ShiftDuration($empid,$month,$year)
	{
	$data['result'] = $this->Common_model->get_data_by_query("select a.alott_shift_id,a.shift_fromdate,a.shift_todate ,
	s.shift_in,s.shift_out
	from 
	hr_shift_allot a inner join hr_shift s on s.shift_id=a.alott_shift_id 
	where a.shift_emp_id=$empid and date_format(a.shift_allot_dt,'%m')=$month and date_format(a.shift_allot_dt,'%Y')=$year");
		$data['string']=array();
		foreach($data['result'] as $row )
		{
			array_push($data['string'],$row);
		}
		  return $data['string'];
	}
		
	public function ShiftDurationByEmpCode($code,$month,$year)
	{
	if($code !=0)
	{
		$data['empidcode'] = $this->Common_model->get_data_by_query("select emp_id from employee where emp_code = $code");
		$empid =  @$data['empidcode'][0]['emp_id'];
	$data['result'] = $this->Common_model->get_data_by_query("select a.alott_shift_id,a.shift_fromdate,a.shift_todate ,
	s.shift_in,s.shift_out
	from 
	hr_shift_allot a inner join hr_shift s on s.shift_id=a.alott_shift_id 
	where a.shift_emp_id=$empid and date_format(a.shift_allot_dt,'%m')=$month and date_format(a.shift_allot_dt,'%Y')=$year");
	// echo $this->db->last_query();
		$data['string']=array();
		foreach($data['result'] as $row )
		{
			array_push($data['string'],$row);
		}
		  return $data['string'];
	}
	}
		
	public function GetAreaOfAgents($agentid)
	{
		if($this->ion_auth->logged_in()){
			
			$area="";
			 $data['result']= $this->Common_model->get_data_by_query("select * from market_area_allot where market_area_a_agentid=$agentid");
			 
			 foreach($data['result'] as $key=>$ft)
			 {
				 
				$areaid= $ft['market_area_a_area_id'];
				$arearest= $this->Common_model->get_data_by_query("select * from market_area where market_area_id=$areaid ");
			 
				 $area=$arearest[0]['market_area_name'].', '.$area;
			 }
			 echo $area ;
	     
		}else{
			redirect('login');	
		}		
	}
	
	public function GetAreaOfPRO($proid)
	{
		if($this->ion_auth->logged_in()){
			
			 $areaqq="";
			 $data['result']= $this->Common_model->get_data_by_query("select * from market_area_allot_pro where market_area_allot_pro_proid=$proid");
			 
			 foreach($data['result'] as $key=>$ft)
			 {
				 
				$areaid= $ft['market_area_allot_pro_area_id'];
				$arearest= $this->Common_model->get_data_by_query("select * from market_area where market_area_id=$areaid ");
			 
				 $areaqq=$arearest[0]['market_area_name'].', '.$areaqq;
			 }
			 echo  $areaqq ;
	     
		}else{
			redirect('login');	
		}		
	}
	
	public function MakeAddress($state,$district,$tehsil,$village)
	{
		
		$address = ' ';
		
		if(@$tahsil != 0 || @$tahsil != ''){

		$arearest['tahsil']= $this->Common_model->get_data_by_query("select tahsil from tahsil where id = ".$tehsil);
		
		$address = $arearest['tahsil'][0]['tahsil'];
		}	
		
		if(@$district != 0 || @$district != ''){

		$arearest['district']= $this->Common_model->get_data_by_query("select district from districmp where id  = ".$district);
		
		$address = @$address." ".@$arearest['district'][0]['district'];
		}
		
		if(@$state != 0 || @$state != ''){
			
		$arearest['state']= $this->Common_model->get_data_by_query("select state_name from state where state_id = ".$state);
			
		$address = $address.", ".$arearest['state'][0]['state_name'];
		}
		
		return $address;
		
	}
	
	public function getCghsRatebycode($code)
	{
		
		 $cghscodes = explode('+', $code);
		
								  $totalcghsrate=0;
                                 foreach($cghscodes as $cgc)
                                 {
                                 	$cgrate['cgratea'] = $this->Common_model->get_data_by_query("select * from cghs_codes_rate where cghs_r_c_id=".$cgc);
                                 					foreach($cgrate['cgratea'] as $key=>$cgkey)
                                 					{
													 $totalcghsrate=$totalcghsrate+$cgkey['cghs_r_c_rate'] ;
                                 					}
                                 }
								 
								 $cghsamt=0;
								  $cghsamt=$totalcghsrate;	
								
								return $cghsamt;
		
	}
	
	public function GetOtHours($code,$shift,$month,$year)
	{
		$Y_m = $year.'-'.$month;
		$data['othours'] = $this->Common_model->get_data_by_query("SELECT SEC_TO_TIME(SUM((TIME_TO_SEC(log_out) - TIME_TO_SEC(log_in)) - TIME_TO_SEC('$shift')))as duration from attendance_logs where `log_emp` = $code and date_format(`log_date`,'%Y-%m') = '$Y_m' having duration > 0");
		$diff = @$data['othours'][0]['duration'];
		if($diff != '')
		{
			return $diff;
		}
		else 
		{
			return '---';
		}
	}
	
		public function GetRedPen($code,$month,$year)
	{
		$Y_m = $year.'-'.$month;
		$data['empidcode'] = $this->Common_model->get_data_by_query("select emp_id from employee where emp_code = $code");
		$empid =  @$data['empidcode'][0]['emp_id'];
		$alott_shift_id = $this->Crud_model->shiftAllotedId($empid);
		$sft=$this->Crud_model->shiftIn($alott_shift_id);
		if($sft!=''){ $sft = date('H:i',strtotime($sft));}
		$data['logs'] = $this->Common_model->get_data_by_query("select * from attendance_logs where log_emp = $code and date_format(log_date,'%Y-%m') = '$Y_m'");
		// echo $this->db->last_query();
		// print_r();
		$m = 0;
		foreach($data['logs'] as $dt)
		{
			$log_in = @date('H:i',strtotime($dt['log_in']));
			$datetime1 = strtotime($sft);
			$datetime2 = strtotime(date('H:i', strtotime($log_in)));
			$interval  = $datetime2 - $datetime1;
			$minutes   = round($interval / 60);	
			// $m= $m + $minutes;
			if($minutes > 15 and  $sft !='')
			{
				$m += $minutes;
			}
		}
		 return @$m;
	}
	
	public function getCghsRatebycode_xray($code)
	{
		//echo $code ;
		 $cghscodes1 = explode('+', $code);
		
								  $totalcghsrate1=0;
                                 foreach($cghscodes1 as $cgc)
                                 {
									  // echo $cgc.'<br>' ;
                                           
                                 	$cgrate['cgratea'] = $this->Common_model->get_data_by_query("select * from cghs_codes_rate where cghs_r_c_id=".$cgc);
                                 		foreach($cgrate['cgratea'] as $key=>$cgkey)
                                 			{
											 $totalcghsrate1=$totalcghsrate1+$cgkey['cghs_r_c_rate'] ;
                                 			}
                                 }
								 $cghsamt=0;
								  $cghsamt=$totalcghsrate1;	
								
								Return $cghsamt;
	}
	
	public function getCghsRatebycode_usg($code)
	{
		//echo $code ;
		$cghscodes2 = explode('+', $code);
		
		  $totalcghsrate2=0;
         foreach($cghscodes2 as $cgc)
         {
		      
         	$cgrate['cgratea'] = $this->Common_model->get_data_by_query("select * from cghs_codes_rate where cghs_r_c_id=".$cgc);
         		foreach($cgrate['cgratea'] as $key=>$cgkey)
         			{
					 $totalcghsrate2=$totalcghsrate2+$cgkey['cghs_r_c_rate'] ;
         			}
         }
		 $cghsamt=0;
		  $cghsamt=$totalcghsrate2;	
		
		return $cghsamt;
	}
	
	public function getCghsRatebycode_ctscan($code)
	{
		//echo $code ;
		 $cghscodes3 = explode('+', $code);
		
								  $totalcghsrate3=0;
                                 foreach($cghscodes3 as $cgc)
                                 {
									  // echo $cgc.'<br>' ;
                                           
                                 	$cgrate['cgratea'] = $this->Common_model->get_data_by_query("select * from cghs_codes_rate where cghs_r_c_id=".$cgc);
                                 		foreach($cgrate['cgratea'] as $key=>$cgkey)
                                 			{
											 $totalcghsrate3=$totalcghsrate3+$cgkey['cghs_r_c_rate'] ;
                                 			}
                                 }
								 $cghsamt=0;
								  $cghsamt=$totalcghsrate3;	
								
								return $cghsamt;
	}
	
	public function Generate($digit,$type)
	{
	  /* list all possible characters, similar looking characters and vowels have been removed */
	  if($type=="both")
	  $possible = '123456789abcdefghijklmnopqrstuvwxyz';
	  else if($type="dig")
	  $possible = '123456789';
	  $code = '';
	  $i = 0;
	  while ($i < $digit) { 
	   $code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
	   $i++;
	  }
	  return strtoupper($code); 
	}
	 

	public function isAdmit($uhid,$ipd_id)
	{
		
		//$uhid = '13802';
		$status = 'YES';
		$data['isadmit'] = $this->Common_model->get_data_by_query("select admit_status from ipd_admit where admit_uhid = ".$uhid. " and admit_id=".$ipd_id);
		@$admit  = @$data['isadmit'][0]['admit_status'];
		if($admit == 'DISCHARGED'){
			
			$status = 'NO';
			return $status;
		}
		if($admit != 'DISCHARGED'){
			
			return $status;
		}
		//return admit($code); 
	}
	
	public function getDischargeDt($ipd_id)
	{
		
		
		$data['disDt'] = $this->Common_model->get_data_by_query("select admit_exitdt from ipd_admit where admit_id=".$ipd_id);
		$disDt  = $data['disDt'][0]['admit_exitdt'];
		
		return $disDt; 
	}
		
	public function getCasuDischargeDt($ipd_id)
	{
		
		
		$data['disDt'] = $this->Common_model->get_data_by_query("select casu_pushdt from ipd_admit where casu_id=".$ipd_id);
		$disDt  = $data['disDt'][0]['casu_pushdt'];
		
		return $disDt; 
	}
		
	public function getConsultant($uhid,$ipd)
	{
		if($this->ion_auth->logged_in())
		{

		   
		$data['doctorname']=$this->Common_model->get_data_by_query("select d.doc_name from doctor d left join casualty c on c.casu_consultent = d.id where c.casu_id = '$ipd' and c.casu_uhid = '$uhid'");
		
		@$doctor = $data['doctorname'][0]['doc_name'];
		
		if($doctor!='')
		{
		echo $doctor;
		}
		else{
		   echo "-";
		}
			   
			
		}else{
			redirect('auth/login');	
		}		
	}	
	
	public function getDischargeType($uhid,$ipd)
	{
		if($this->ion_auth->logged_in()){
			
				   
			    $data['dischargeType']=$this->Common_model->get_data_by_query("select discharge_type from patient_discharge where pdis_ipd_id = '$ipd' and pdis_uhid = '$uhid'");
				
				@$discharge_type = $data['dischargeType'][0]['discharge_type'];
				
				if($discharge_type!='')
			   {
				return $discharge_type;
			   }
			   else{
				   return "--";
			   }
			   
			  
			
		}else{
			redirect('auth/login');	
		}		
	}
	
	public function getSchemeID($ipdopdid,$uhid,$opdoripd)
	{
		if($this->ion_auth->logged_in()){
			
			   // $ipdopdid= $_POST['ipdopdid'] ;
			   // $uhid= $_POST['mainuhid'] ;
			   // $opdoripd= $_POST['opdoripd'] ;
			   
			   if($opdoripd=='IPD')
			   {
				   
			    $data['schmeid']=$this->Common_model->get_data_by_query("select casu_scheme from casualty where casu_id = '$ipdopdid'");
				echo @$data['schmeid'][0]['casu_scheme'] ;
			   }
			   elseif($opdoripd=='OPD')
			   {
				   
				$data['schmeid']=$this->Common_model->get_data_by_query("select opd_scheme from opd_patient where id = '$ipdopdid'");
				echo $data['schmeid'][0]['opd_scheme'];
			   } 
		}else{
			redirect('auth/login');	
		}		
	}	
	
	public function getSchemeName($ipdopdid,$uhid,$opdoripd)
	{
		
			  
			   
			   if($opdoripd=='IPD')
			   {
				   
			    $data['schmeid']=$this->Common_model->get_data_by_query("select b.scheme_name from casualty a ,scheme b where a.casu_id = '$ipdopdid' and a.casu_scheme=b.id ");
				echo @$data['schmeid'][0]['scheme_name'] ;
			   }
			   elseif($opdoripd=='OPD')
			   {
				   
				$data['schmeid']=$this->Common_model->get_data_by_query("select b.scheme_name from opd_patient a ,scheme b where a.id = '$ipdopdid' and a.opd_scheme=b.id ");
				echo @$data['schmeid'][0]['scheme_name'] ;
				   
			   }
			  
			 
			  
			
		}
		public function getSchemeName_cash($ipdopdid,$uhid,$opdoripd)
	{
		
			  
			   
			   if($opdoripd=='IPD')
			   {
				   
			    $data['schmeid']=$this->Common_model->get_data_by_query("select b.scheme_name from casualty a ,scheme b where a.casu_id = '$ipdopdid' and a.casu_scheme=b.id ");
				return @$data['schmeid'][0]['scheme_name'] ;
			   }
			   elseif($opdoripd=='OPD')
			   {
				   
				$data['schmeid']=$this->Common_model->get_data_by_query("select b.scheme_name from opd_patient a ,scheme b where a.id = '$ipdopdid' and a.opd_scheme=b.id ");
				return @$data['schmeid'][0]['scheme_name'] ;
				   
			   }
			  
			 
			  
			
		}
		public function getSchemeName1($ipdopdid,$uhid,$opdoripd)
	{
		
			  
			   
			   if($opdoripd=='ipd')
			   {
				   
			    $data['schmeid']=$this->Common_model->get_data_by_query("select b.scheme_name from casualty a ,scheme b where a.casu_id = '$ipdopdid' and a.casu_scheme=b.id ");
				echo @$data['schmeid'][0]['scheme_name'] ;
			   }
			   elseif($opdoripd=='opd')
			   {
				   
				$data['schmeid']=$this->Common_model->get_data_by_query("select b.scheme_name from opd_patient a ,scheme b where a.id = '$ipdopdid' and a.opd_scheme=b.id ");
				echo @$data['schmeid'][0]['scheme_name'] ;
				   
			   }
			  
			 
			  
			
		}		
		
	
	public function getSchemeNameWebServices($ipdopdid,$uhid,$opdoripd)
	{
		
			  
			   
			   if($opdoripd=='IPD')
			   {
				   
			    $data['schmeid']=$this->Common_model->get_data_by_query("select b.scheme_name from casualty a ,scheme b where a.casu_id = '$ipdopdid' and a.casu_scheme=b.id ");
				return @$data['schmeid'][0]['scheme_name'] ;
			   }
			   elseif($opdoripd=='OPD')
			   {
				   
				$data['schmeid']=$this->Common_model->get_data_by_query("select b.scheme_name from opd_patient a ,scheme b where a.id = '$ipdopdid' and a.opd_scheme=b.id ");
				return @$data['schmeid'][0]['scheme_name'] ;
				   
			   }
		}		
	
	
	public function getSchemeNameReturn($ipdopdid,$uhid,$opdoripd)
	{
		if($this->ion_auth->logged_in()){
			
			  
			   
			   if($opdoripd=='IPD')
			   {
				   
			    $data['schmeid']=$this->Common_model->get_data_by_query("select b.scheme_name from casualty a ,scheme b where a.casu_id = '$ipdopdid' and a.casu_scheme=b.id ");
				return @$data['schmeid'][0]['scheme_name'] ;
			   }
			   elseif($opdoripd=='OPD')
			   {
				   
				$data['schmeid']=$this->Common_model->get_data_by_query("select b.scheme_name from opd_patient a ,scheme b where a.id = '$ipdopdid' and a.opd_scheme=b.id ");
				return @$data['schmeid'][0]['scheme_name'] ;
				   
			   }
			  
			 
			  
			
		}else{
			redirect('auth/login');	
		}		
	}	
		public function getSchemeNameReturnID($ipdopdid,$uhid,$opdoripd)
	{
		if($this->ion_auth->logged_in()){
			
			  
			   
			   if($opdoripd=='IPD')
			   {
				   
			    $data['schmeid']=$this->Common_model->get_data_by_query("select b.id from casualty a ,scheme b where a.casu_id = '$ipdopdid' and a.casu_scheme=b.id ");
				return $data['schmeid'][0]['id'] ;
			   }
			   elseif($opdoripd=='OPD')
			   {
				   
				$data['schmeid']=$this->Common_model->get_data_by_query("select b.id from opd_patient a ,scheme b where a.id = '$ipdopdid' and a.opd_scheme=b.id ");
				return $data['schmeid'][0]['id'] ;
				   
			   }
		  
			
		}else{
			redirect('auth/login');	
		}		
	}	
	public function getPtBed($ipdopdid,$uhid)
	{
		
			    $data['ptbed']=$this->Common_model->get_data_by_query("select i.admit_ward,i.admit_bed,i.admit_floor,r.r_name from ipd_admit i left join resource r on i.admit_bed = r.r_id where i.admit_id = '$ipdopdid' and i.admit_uhid = $uhid ");
				return $data['ptbed'][0]['r_name'] ;

	}
	
	public function getPtBed_demo($ipdopdid)
	{
		
			    $data['ptbed']=$this->Common_model->get_data_by_query("select i.admit_ward,i.admit_bed,i.admit_floor,r.r_name from ipd_admit i left join resource r on i.admit_bed = r.r_id where i.admit_id = '$ipdopdid'");
				return $data['ptbed'][0]['r_name'] ;

			
	}	
	
	public function getPtWard($ipdopdid,$uhid)
	{
		
  
			    $data['ptward']=$this->Common_model->get_data_by_query("select r.r_name from ipd_admit i left join resource r on i.admit_ward = r.r_id where i.admit_id = '$ipdopdid' and i.admit_uhid = $uhid ");
				
				return @$data['ptward'][0]['r_name'] ;

				
	}	
	
	public function getPtWardId($ipdopdid,$uhid)
	{
		$data['ptward']=$this->Common_model->get_data_by_query("select r.r_id from ipd_admit i left join resource r on i.admit_ward = r.r_id where i.admit_id = '$ipdopdid' and i.admit_uhid = $uhid ");
		
		return @$data['ptward'][0]['r_id'];
	}	
	
	public function getResourceGr($ward)
	{
		if($this->ion_auth->logged_in()){
  
			    $data['ptward']=$this->Common_model->get_data_by_query("select r_group from resource where r_id = $ward ");
				
				return $data['ptward'][0]['r_group'] ;

		}else{
			redirect('auth/login');	
		}		
	}	

	public function getAdmitdate($casultyid,$opdipd)
	{
		if($this->ion_auth->logged_in()){
			
			if($opdipd=='IPD')
			{  
		
		      $data['admitdate']=$this->Common_model->get_data_by_query("select casu_entrydt from casualty where casu_id = '$casultyid'");
			
			return date('d-m-Y H:i',strtotime(@$data['admitdate'][0]['casu_entrydt']));
				//showing Hours and minuits are COMPULSARY otherwise it creates problem in Discharge card 
				
			}
			else{
			$data['admitdate']=$this->Common_model->get_data_by_query("select date from opd_patient where id = '$casultyid'");
			
			return  date('d-m-Y H:i',strtotime($data['admitdate'][0]['date']));
				//showing Hours and minuits are COMPULSARY otherwise it creates problem in Discharge card 
				
				
			}
			
	
		}else{
			redirect('auth/login');	
		}		
	}		
	
	public function rowinBPL($uhid,$ipdOPDid)
	{
		if($this->ion_auth->logged_in()){
			
		     $data['bpldata']=$this->Common_model->get_data_by_query("select id from bpl_patient where bpl_ipd_id = '$ipdOPDid' and uhid='$uhid'");
			  
			  if($data['bpldata']==null)
			  {
				  return 'no';
				  
			  }
			  else
			  {
				  
				  return 'yes';
			  }
			
			
		
			
		}else{
			redirect('auth/login');	
		}		
	}   
	
	public function rowinCGHS($uhid,$ipdOPDid)
	{
		if($this->ion_auth->logged_in()){
			
		     $data['cghsdata']=$this->Common_model->get_data_by_query("select id from cghs_patient where cghs_opdipd_id = '$ipdOPDid' and uhid='$uhid'");
			  
			  if($data['cghsdata']==null)
			  {
				  return 'no';
				  
			  }
			  else
			  {
				  
				  return 'yes';
			  }
			
			
		
			
		}else{
			redirect('auth/login');	
		}		
	}	
	
	public function rowinbplFormData($uhid)
	{
		if($this->ion_auth->logged_in()){
			
		     // $data['cghsdata']=$this->Common_model->get_data_by_query("select id from cghs_patient where cghs_opdipd_id = '$ipdOPDid' and uhid='$uhid'");
			  $data['formdetails']=$this->Common_model->get_data_by_query("select * from bpl_form_datails where uhid='$uhid' and  bpl_form_status='1'");

			  if($data['formdetails']==null)
			  {
				  return 'no';
				  
			  }
			  else
			  {
				  
				  return 'yes';
			  }
			
			
		
			
		}else{
			redirect('auth/login');	
		}		
	}   
	
	public function rowinbplEstimateData($uhid)
	{
		if($this->ion_auth->logged_in()){
			
		     // $data['cghsdata']=$this->Common_model->get_data_by_query("select id from cghs_patient where cghs_opdipd_id = '$ipdOPDid' and uhid='$uhid'");
			  $data['estima']=$this->Common_model->get_data_by_query("select * from bpl_estimate where uhid='$uhid' ");

			  if($data['estima']==null)
			  {
				  return 'no';
				  
			  }
			  else
			  {
				  
				  return 'yes';
			  }
			
			
		
			
		}else{
			redirect('auth/login');	
		}		
	}
	
	public function getAdmitdateIPD($casultyid)
	{
	
			
			   // $casultyid= $_POST['casultyid'] ;
			  
			  $data['admitdate']=$this->Common_model->get_data_by_query("select casu_entrydt from casualty where casu_id = '$casultyid'");
			
			  return date('d-m-Y H:i',strtotime($data['admitdate'][0]['casu_entrydt']));
			
	
	}	
	
	public function getInitialdateIPD($casultyid)
	{
	
			
			   // $casultyid= $_POST['casultyid'] ;
			  
			  $data['admitdate']=$this->Common_model->get_data_by_query("select initial_entrydt from initial_assessment where initial_casu_id = '$casultyid'");
			
			  return date('d-m-Y H:i',strtotime($data['admitdate'][0]['initial_entrydt']));
			
	
	}	

	public function getAdmitdateForall($casultyid)
	{
		if($this->ion_auth->logged_in()){
			
			   // $casultyid= $_POST['casultyid'] ;
			  
			  $data['admitdate']=$this->Common_model->get_data_by_query("select casu_entrydt from casualty where casu_id = '$casultyid'");
			
			  echo date('d-m-Y h:i a',strtotime($data['admitdate'][0]['casu_entrydt']));
	
		}else{
			redirect('auth/login');	
		}		
	}		

	
	public function getLinks()
		{
			$data['grouplist']=$this->Common_model->get_data_by_query("select * from sidebarlist");
						
				
			// $data['sublist']=$this->Common_model->get_data_by_query("select * from sidebar_links where listid='$id'");
			?>
				 <?php 
				 foreach($data['grouplist'] as $glist)
				 {
					$id=$glist['id'];
					$is_sublink=$glist['is_sublink'];
					$data['sublist']=$this->Common_model->get_data_by_query("select * from sidebar_links where listid='$id'");
					// print_r($data['sublist']);
					// die;		
					//$sublink = $data['sublist'][0]['id'];		
					?>
					<li class="start" >
					<?php 
					if($is_sublink == 0){
					foreach($data['sublist'] as $slist){ ?>
					<a href="<?php echo base_url().$slist['links'];?>">
				
					<?php } }
					else{
						echo '<a href="'.base_url().$slist['links'].'">';
					}
					?>
					<i class="<?php echo $glist['icon'];?>"></i>
					<span class="title"><?php echo $glist['list'];?></span><span class="selected"></span>
					<?php if($is_sublink != 0){ echo "<span class='arrow open'></span>";}?>
					
					</a>
					<?php if($is_sublink == 1){ ?>
						<ul class="sub-menu">
							<?php foreach($data['sublist'] as $slist){ ?>
							<li><a href="<?php echo base_url().$slist['links'];?>"><?php echo $slist['linknames'];?></a> </li>
							<?php } ?>
						</ul>
					<?php }
					else{ echo ""; } ?>
					
					</li>
					<?php }
					if($data['sublist']==''){ ?>
					<li class="start" >
					<a href="<?php echo base_url().$slist['links'];?>">
					<i class="<?php echo $glist['icon'];?>"></i>
					<span class="title"><?php echo $glist['list'];?></span><span class="selected"></span>
					</a>
					</li>	
					<?php }
					?> 

	 <?php
	}
	
	public function getStatusOfMrd($ipppid,$uhid,$idconcent,$status)
	{
		if($this->ion_auth->logged_in()){
			
			 $data2['villll']=$this->Common_model->get_data_by_query("select * from mrd_checklist where mrd_chk_consent='$idconcent' and mrd_chk_ipdid='$ipppid' ");
							  
				   // print_r( $data2['villll'] );
				   
				   if($data2['villll']==null)
				   {
					             $data['mrd_chk_ipdid']=$ipppid ;
					             $data['mrd_chk_uhid']=$uhid ;
					             $data['mrd_chk_consent']=$idconcent ;
					             $this->Crud_model->insert_record('mrd_checklist',$data);  
					     
					
				   } else {
					    
						         
					     
						  }
			
			 $data2['maindata']=$this->Common_model->get_data_by_query("select * from mrd_checklist where mrd_chk_consent='$idconcent' and mrd_chk_ipdid='$ipppid' ");
			 
			 
			 if($status=='chkst')
			 {
				 return $data2['maindata'][0]['mrd_chk_status'];
			 }
			 else if($status=='quntity')
			 {
				 return $data2['maindata'][0]['mrd_chk_qunty'];
			 } else if($status=='mrd_chk_remark')
			 {
				 return $data2['maindata'][0]['mrd_chk_remark'];
			 }
			 
	
		}else{
			redirect('auth/login');	
		}		
	}
	
	
	public function getStatusOfMrd1($ipppid,$uhid,$idconcent,$status)
	{
		if($this->ion_auth->logged_in()){
			
					$data2['villll']=$this->Common_model->get_data_by_query("select * from mrdcheck where mrd_chk_uhid='$uhid' and mrd_chk_ipdid='$ipppid'");
					if($data2['villll']==null)
					{
						 $data['mrd_chk_ipdid']=$ipppid ;
						 $data['mrd_chk_uhid']=$uhid ;
						 $data['mrd_chk_entrydt']= date('Y-m-d H:i:s');
						 // $data['mrd_chk_consent']=$idconcent ;
						 $userid=(array_slice($this->session->userdata,9,1));
						 @$data['mrd_chk_received_by']=@$userid['user_id'];
						 $this->Crud_model->insert_record('mrdcheck',$data);  
					} 
					else{}
					$data2['maindata']=$this->Common_model->get_data_by_query("select * from mrdcheck where mrd_chk_uhid='$uhid' and mrd_chk_ipdid='$ipppid' ");
			 
			 
					if($status=='chkst')
					{
						return @unserialize($data2['maindata'][0]['mrd_chk_status']);
					}
					else if($status=='quntity')
					{
						return @unserialize($data2['maindata'][0]['mrd_chk_qunty']);
					}
					else if($status=='mrd_chk_remark')
					{
						return @unserialize($data2['maindata'][0]['mrd_chk_remark']);
					}
					else if($status=='mrd_chk_consent')
					{
						return @unserialize($data2['maindata'][0]['mrd_chk_consent']);
					}

	
		}else{
			redirect('auth/login');	
		}		
	}
	
	public function getStatusOfMrd1Nursing($ipppid,$uhid,$idconcent,$status)
	{
		if($this->ion_auth->logged_in()){
			   

					$data2['villll']=$this->Common_model->get_data_by_query("select * from mrdcheck_nursing where mrd_chk_uhid='$uhid' and mrd_chk_ipdid='$ipppid'");
					
					
					if($data2['villll']==null)
					{
						 $data['mrd_chk_ipdid']=$ipppid ;
						 $data['mrd_chk_uhid']=$uhid ;
						 $data['mrd_chk_entrydt']= date('Y-m-d H:i:s');
						 // $data['mrd_chk_consent']=$idconcent ;
						 $userid=(array_slice($this->session->userdata,9,1));
						 @$data['mrd_chk_received_by']=@$userid['user_id'];
						 $this->Crud_model->insert_record('mrdcheck_nursing',$data);  
					} 
					else{}
					$data2['maindata']=$this->Common_model->get_data_by_query("select * from mrdcheck_nursing
 where mrd_chk_uhid='$uhid' and mrd_chk_ipdid='$ipppid' ");
			 
			 
					if($status=='chkst')
					{
						return @unserialize($data2['maindata'][0]['mrd_chk_status']);
					}
					else if($status=='quntity')
					{
						return @unserialize($data2['maindata'][0]['mrd_chk_qunty']);
					}
					else if($status=='mrd_chk_remark')
					{
						return @unserialize($data2['maindata'][0]['mrd_chk_remark']);
					}
					else if($status=='mrd_chk_consent')
					{
						return @unserialize($data2['maindata'][0]['mrd_chk_consent']);
					}

	
		}else{
			redirect('auth/login');	
		}		
	}
	
	
  		public function getStatusOfMrdDischarge($ipppid,$uhid,$idconcent,$status)
	{
		if($this->ion_auth->logged_in()){
			
			 $data2['villll']=$this->Common_model->get_data_by_query("select * from mrd_checklist_discharge where mrd_chk_consent='$idconcent' and mrd_chk_ipdid='$ipppid'");
							  
				   // print_r( $data2['villll'] );
				   
				   if($data2['villll']==null)
				   {
					             $data['mrd_chk_ipdid']=$ipppid ;
					             $data['mrd_chk_uhid']=$uhid ;
					             $data['mrd_chk_consent']=$idconcent ;
					             $this->Crud_model->insert_record('mrd_checklist_discharge',$data);  
					     
					
				   } else {
					    
						         
					     
						  }
			
			 $data2['maindata']=$this->Common_model->get_data_by_query("select * from mrd_checklist_discharge where mrd_chk_consent='$idconcent' and mrd_chk_ipdid='$ipppid' ");
			 
			 
			 if($status=='chkst')
			 {
				 return $data2['maindata'][0]['mrd_chk_status'];
			 }
			 else if($status=='quntity')
			 {
				 return $data2['maindata'][0]['mrd_chk_qunty'];
			 } else if($status=='mrd_chk_remark')
			 {
				 return $data2['maindata'][0]['mrd_chk_remark'];
			 }
			 
	
		}else{
			redirect('auth/login');	
		}		
	}
		
	public function doDischarge($uhid,$ipdid,$disdate)
	{
		if($this->ion_auth->logged_in()){
			
		$datausse['dd']=$this->session->userdata;
		foreach ($datausse as $key=>$value){} 
		$userid=$value['user_id'];
		
		date_default_timezone_set('Asia/Kolkata');
		$data['admit_status'] = 'DISCHARGED';
		$data['user_id'] = $userid;
		$data['admit_exitdt'] = date("$disdate H:i:s");
		$data['admit_getpassdt'] = date("$disdate H:i:s");
		//$data['admit_avg_stay'] = $time;
		$data1['shift_exitdt'] = date("$disdate H:i:s");
		$this->Crud_model->edit_record_by_any_id('ipd_admit','admit_id',$ipdid,$data);
		$this->Crud_model->edit_record_by_any_id('ipd_shift','shift_ipd_id',$ipdid,$data1);
		$this->Common_model->removeallprocedures($ipdid);
			
		}else{
			redirect('auth/login');	
		}		
	}
	
	public function getTimeDiff($fromdate,$todate)
	{
		if($this->ion_auth->logged_in()){
			
		$datetime1 = new DateTime($fromdate);
		$datetime2 = new DateTime($todate);
		$interval = $datetime1->diff($datetime2);
		
		$tot_days_time =  $interval->format('%d %H:%i:%s');
		
		
		$timediff1 = explode(" ", $tot_days_time);
		$days = $timediff1[0];//echo " days";
		//echo "</br>";
		$timediff2 = explode(":", $timediff1[1]);
		//echo $timediff2[0];echo " hours";echo "</br>";
		//echo $timediff2[1];echo " minutes";echo "</br>";
		
		
		return $time =  ceil(($timediff2[0] + ($timediff2[1]/60) -12 )/24) + $days;
		
	
		}else{
			redirect('auth/login');	
		}		
	}
	
	public function getDiagnosis($uhid,$ipdid)
	{
		
		$data['diagnosis'] = $this->Common_model->get_data_by_query("select diag_diagnosis from patient_diagnosis where diag_ipd_id='$ipdid' and diag_uhid ='$uhid' order by diag_id desc limit 1");
		
		return @$diagnosis = $data['diagnosis'][0]['diag_diagnosis'];
		
	}
	
	
	public function getGagepassRemark($uhid,$ipdid)
	{
		$data['gatepass']= $this->Common_model->get_data_by_query("select admit_gatepass_remark from ipd_admit where  admit_uhid='$uhid' and admit_id='$ipdid' ");  
		return @$gatepass = $data['gatepass'][0]['admit_gatepass_remark'];
	}
	
	public function isMlc($uhid,$ipdid)
	{
		
		$data['ismlc'] = $this->Common_model->get_data_by_query("select casu_pcase from casualty where casu_id='$ipdid' and casu_uhid = '$uhid'");
		return $casu_pcase = @$data['ismlc'][0]['casu_pcase'];
		
	}
	
	
	public function getEntryOnDate($tablename,$datefieldname,$date)
	{
		// echo $date;
		// die;
			 $nofentry=0;
		$data['tableentrys'] = $this->Common_model->get_data_by_query("select date_format( $datefieldname , '%Y-%m-%d' ) as Datet,count(*) as entries from $tablename where DATE_FORMAT( $datefieldname,'%Y-%m-%d')='".$date."' group by  DATE_FORMAT ($datefieldname,'%Y-%m-%d')");
	   
	   foreach ($data['tableentrys'] as $key=>$entrytabel)
					{
					    if($entrytabel['entries']>0)
						{
						   $nofentry=$entrytabel['entries'];
						}
						
					}
		// echo $this->db->last_query();
		
		
		return $nofentry;
		
	}
	public function getBillingOnDate($tablename,$datefieldname,$date)
	{
		// echo $date;
		// die;
			 $nofentry=1;
		$data['tableentrys'] = $this->Common_model->get_data_by_query("select date_format( $datefieldname , '%Y-%m-%d' ) as Datet,count(*) as entries from $tablename where topup_type='2' and DATE_FORMAT( $datefieldname,'%Y-%m-%d')='".$date."' group by  DATE_FORMAT ($datefieldname,'%Y-%m-%d')");
	   
	   foreach ($data['tableentrys'] as $key=>$entrytabel)
					{
					    if($entrytabel['entries']>0)
						{
						   $nofentry=$entrytabel['entries'];
						}
						
					}
		// echo $this->db->last_query();
		
		
		return $nofentry;
		
	}
	
	public function getEntryOnDatemed($tablename,$datefieldname,$date)
	{
		// echo $date;
		// die;
			 $nofentry=1;
		$data['tableentrys'] = $this->Common_model->get_data_by_query("select date_format( $datefieldname , '%Y-%m-%d' ) as Datet,count(*) as entries from $tablename where DATE_FORMAT( $datefieldname,'%Y-%m-%d H:i:Sa')='".$date."' group by  DATE_FORMAT ($datefieldname,'%Y-%m-%d')");
	   // echo $this->db->last_query();
	   // die;
	   foreach ($data['tableentrys'] as $key=>$entrytabel)
					{
					    if($entrytabel['entries']>0)
						{
						   $nofentry=$entrytabel['entries'];
						}
						
					}
		// echo $this->db->last_query();
		
		
		return $nofentry;
		
	}  
	
	
	    public function getdateofadmission($casultyid)
	{
			
			
			   // $casultyid= $_POST['casultyid'] ;
			  
			  $data['admitdate']=$this->Common_model->get_data_by_query("select casu_entrydt from casualty where casu_id = '$casultyid'");
			
			  return date('d-m-Y H:i',strtotime($data['admitdate'][0]['casu_entrydt']));
			
		
		
	}
	
	
	
	public function enterCghsTran($tid,$testid,$testtable,$uhid,$opdipdid,$case)
	{
		if($this->ion_auth->logged_in()){
			
			  
			             if($testtable=='Pathology')
						 {
							       $datacghstran['result'] = $this->Common_model->get_data_by_query("select *  from patho_test where  ptestsub_id=$testid");
				         
						    $cghs_code =$datacghstran['result'][0]['ptest_cghs_code'] ;
						    $testname =$datacghstran['result'][0]['ptest_name'] ;
						    $testrate =$datacghstran['result'][0]['ptest_rate'] ;
							$department="Pathology";
							
							 
						 }elseif($testtable=='X-Ray')
						 {
							 
							 $datacghstran['result'] = $this->Common_model->get_data_by_query("select *  from xray_ratelist where  xray_retid=$testid");
				         
						    $cghs_code =$datacghstran['result'][0]['xray_cghs_code'] ;
						    $testname =$datacghstran['result'][0]['xray_name'] ;
						    $testrate =$datacghstran['result'][0]['xray_rate'] ;
							$department="X-Ray";
							 
						 }elseif($testtable=='USG')
						 {
							 
							 $datacghstran['result'] = $this->Common_model->get_data_by_query("select *  from usg_master where  usg_id=$testid");
				         
						    $cghs_code =$datacghstran['result'][0]['usg_cghs_code'] ;
						    $testname =$datacghstran['result'][0]['usg_test'] ;
						    $testrate =$datacghstran['result'][0]['usg_charge'] ;
							$department="USG";
							 
						 }elseif($testtable=='CT-scan')
						 {
							 
						
							$datacghstran['result'] = $this->Common_model->get_data_by_query("select *  from ct_test_master where  mast_id=$testid");
				         
						    $cghs_code =$datacghstran['result'][0]['mast_cghs_code'] ;
						    $testname =$datacghstran['result'][0]['mast_test'] ;
						    $testrate =$datacghstran['result'][0]['mast_charge'] ;
							$department="CT-scan";
							 
						 }elseif($testtable=='Procedure')
						 {
							 
						
							// $datacghstran['result'] = $this->Common_model->get_data_by_query("select *  from ct_test_master where  mast_id=$testid");
				         
						     $testdata = explode('----', $testid);
						 
						    $cghs_code ="" ;
						    $testname =$testdata[1] ;
						    $testrate =$testdata[0] ;
							$department="Procedure";
							 
						 }elseif($testtable=='Cardiac')
						 {
							 
						
							// $datacghstran['result'] = $this->Common_model->get_data_by_query("select *  from ct_test_master where  mast_id=$testid");
				         
						     $testdata = explode('----', $testid);
						 
						    $cghs_code ="" ;
						    $testname =$testdata[1] ;
						    $testrate =$testdata[0] ;
							$department="Cardiac";
							 
						 }
			  
			     
			  
							if($cghs_code==null)
							{
								
							      $userid=(array_slice($this->session->userdata,9,1));
							      $dataForNocode['cghs_tran_user'] 		= $userid['user_id'];
							      $dataForNocode['cghs_tran_uhid'] 		= $uhid;
							      $dataForNocode['cghs_tran_department']= $department;
								  
							      $dataForNocode['cghs_tran_servic']	= $testname;
							      $dataForNocode['cghs_tran_amount']	= $testrate;
							      $dataForNocode['cghs_tran_ipd_opd_id']= $opdipdid;
							      $dataForNocode['cghs_tran_opd_ipd_cas']	= $case;
							      $dataForNocode['cghs_tran_pay_type'] = '1';
								  
							      // $dataForNocode['cghs_tran_recive'] = $this->input->post('tran_recive');
							      // $dataForNocode['cghs_tran_authorized'] = $this->input->post('remar');
							      // $dataForNocode['cghs_tran_remarke'] = $this->input->post('remark1');
								  
							      $dataForNocode['cghs_tran_entrydt']	= date('Y-m-d h:i:s');
								  $dataForNocode['cghs_tran_main_id']	= $tid;
							      $this->Crud_model->insert_record('cghs_transaction',$dataForNocode);
								$labschamount=$testrate;
							}
							else{
								
								    $cghscodes = explode('+', $cghs_code);
									  $totalcghsrate=0;
                                     foreach($cghscodes as $cgc)
                                     {
                                               
                                     			 $cgrate['cgratea'] = $this->Common_model->get_data_by_query("select * from cghs_codes_rate where cghs_r_c_id=".$cgc);
                                     								   
                                     							foreach($cgrate['cgratea'] as $key=>$cgkey)
                                     					{
                                     						 
								                         $userid=(array_slice($this->session->userdata,9,1));
							                             $dataForYescode['cghs_tran_user'] 		= $userid['user_id'];
							                             $dataForYescode['cghs_tran_uhid'] 		= $uhid;
							                             $dataForYescode['cghs_tran_department']= $department;
														  if($testid=='2' and $department=='Pathology')
														 {
															 $cgkey['cghs_r_c_name']='Glucose (Fasting )';
														 }
														 elseif($testid=='127' and $department=='Pathology')
														 {
															  $cgkey['cghs_r_c_name']='Glucose (PP)';
															 
														 }
														 
							                             $dataForYescode['cghs_tran_servic']	= $cgkey['cghs_r_c_name'];
							                             $dataForYescode['cghs_tran_amount']	= $cgkey['cghs_r_c_rate'];
														 $dataForYescode['cghs_tran_cghs_code']	= $cgkey['cghs_r_c_id'];
							                             $dataForYescode['cghs_tran_ipd_opd_id']= $opdipdid;
							                             $dataForYescode['cghs_tran_opd_ipd_cas']	= $case;
							                             $dataForYescode['cghs_tran_pay_type'] = '1';
														 
							                             // $dataForYescode['cghs_tran_recive'] = $this->input->post('tran_recive');
							                             // $dataForYescode['cghs_tran_authorized'] = $this->input->post('remar');
							                             // $dataForYescode['cghs_tran_remarke'] = $this->input->post('remark1');
														 
							                             $dataForYescode['cghs_tran_entrydt']	= date('Y-m-d h:i:s');
														 $dataForYescode['cghs_tran_main_id']	= $tid;
							                             $this->Crud_model->insert_record('cghs_transaction',$dataForYescode);
														 
														 $totalcghsrate=$totalcghsrate+$cgkey['cghs_r_c_rate'] ;
                                     					}
                                     					
                                     				 
                                     						 
                                     
                                     }
									 	$labschamount=$totalcghsrate;	
							}
						 
			  
			  
			  
			  
			   return  $labschamount ;
			 
			  
			
		}else{
			redirect('auth/login');	
		}		
	}
	
	public function enterCghsTran1($tid,$testid,$testtable,$uhid,$opdipdid,$case,$tran_amount)
	{
		if($this->ion_auth->logged_in()){
	
	      $userid=(array_slice($this->session->userdata,9,1));
	      $dataForNocode['cghs_tran_user'] 		= $userid['user_id'];
	      $dataForNocode['cghs_tran_uhid'] 		= $uhid;
	      $dataForNocode['cghs_tran_department']= $testtable;
	      
	      $dataForNocode['cghs_tran_servic']	= $testid;
	      $dataForNocode['cghs_tran_amount']	= $tran_amount;
	      $dataForNocode['cghs_tran_ipd_opd_id']= $opdipdid;
	      $dataForNocode['cghs_tran_opd_ipd_cas']	= $case;
	      $dataForNocode['cghs_tran_pay_type'] = '1';
	      
	      // $dataForNocode['cghs_tran_recive'] = $this->input->post('tran_recive');
	      // $dataForNocode['cghs_tran_authorized'] = $this->input->post('remar');
	      // $dataForNocode['cghs_tran_remarke'] = $this->input->post('remark1');
	      
	      $dataForNocode['cghs_tran_entrydt']	= date('Y-m-d h:i:s');
	      $dataForNocode['cghs_tran_main_id']	= $tid;
	      $this->Crud_model->insert_record('cghs_transaction',$dataForNocode);
	
    }
                                     
    }
	
	
	public function getdistrict($uhid)
	{
		if($this->ion_auth->logged_in()){
			
			$dist['district'] = $this->Common_model->get_data_by_query("select district from patient  where id='$uhid'"); 
	
			if($dist['district'][0]['district']=="")
				  {
					  return "" ;
				  }
			else
				  {
					  $disid=$dist['district'][0]['district']  ;
					  $distname['districtname'] = $this->Common_model->get_data_by_query("select district from districmp  where id='$disid'"); 
					    return $distname['districtname'][0]['district'] ;
				  }
								
			}                             
    }

	public function createDateRangeArray($strDateFrom,$strDateTo)
	{

		$aryRange=array();

		$iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2), substr($strDateFrom,8,2),substr($strDateFrom,0,4));
		$iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

		if ($iDateTo>=$iDateFrom)
		{
			array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
			while ($iDateFrom<$iDateTo)
			{
				$iDateFrom+=86400; // add 24 hours
				array_push($aryRange,date('Y-m-d',$iDateFrom));
			}
		}
		return $aryRange;
		//print_r($aryRange) ;
		
		 
			// $datearray = $this->Common_model->createDateRangeArray('2016-05-01','2016-05-10');
		
			// foreach($datearray as $dt){
				
				// echo date('d-m-Y', strtotime($dt));
				// echo "</br>";
				
			// }
		
	}
	
	
	public function getWardNamebyId($wardid)
	{

		$data['advisedWard'] = $this->Common_model->get_data_by_query("SELECT r_name from resource where r_id = '$wardid' ");
		return $ward = $data['advisedWard'][0]['r_name']; 
		
	}

	public function getDischargePlanByDate($disdt)
	{

		$data['listDisPlan'] = $this->Common_model->get_data_by_query("SELECT a.admit_id,a.admit_uhid,a.admit_dis_plan_dt,a.admit_statisfied,p.first_name,p.middle_name,p.last_name,p.contact_no from ipd_admit a 
		left join patient p on p.id = a.admit_uhid where date_format(admit_dis_plan_dt, '%Y-%m-%d')  = '$disdt' ");
		//return @$ipd = $data['listDisPlan'][0]['admit_id'];
		
		return $data['listDisPlan'];
		
	}
	
	public function getPatientDetails($uhid)
	{

		$data['patientDetails'] = $this->Common_model->get_data_by_query("SELECT p.id,c.casu_consultent,p.first_name,p.middle_name,p.last_name,p.contact_no,p.patient_age,p.patient_gender,p.address,p.son_or_wife,p.fa_hus_name,c.casu_id from patient p 
		left join casualty c on c.casu_uhid = p.id
		where p.id = '$uhid' ");
		
		return $data['patientDetails'];
		
	}
	public function getPatientDetails_demo($ipd_id)
	{

		$data['patientDetails'] = $this->Common_model->get_data_by_query("SELECT c.casu_uhid,p.id,p.first_name,p.middle_name,p.last_name,p.contact_no,p.patient_age,p.patient_gender,p.address,p.son_or_wife,p.fa_hus_name,c.casu_id from patient p 
		left join casualty c on c.casu_uhid = p.id
		where c.casu_id = '$ipd_id' ");
		
		return $data['patientDetails'];
		
	}
	
	public function getPatientContact($ipd)
	{

		$data['PatientContact'] = $this->Common_model->get_data_by_query("SELECT c.casu_mob,c.attender_contact,c.casu_balanceamt,c.casu_sms_attender,c.casu_fname,c.casu_mname,c.casu_lname from casualty c where c.casu_id = '$ipd' ");
		
		return $data['PatientContact'];
		
	}

	public function getTubings($uhid,$ipd)
	{

		$data2['new'] = array(); 
		
		//forCatheter*******
		$data['forCatheter'] = $this->Common_model->get_data_by_query("SELECT Cann_extstatus,Cann_intdate,Cann_catheter_outside from nursef_cann_cathe where Cann_ipd='$ipd' and Cann_uhid='$uhid' and Cann_extstatus = 0 and delete_status = 1 ");
		
		@$catheter =   $data['forCatheter'][0]['Cann_extstatus'];
		@$outcat =   $data['forCatheter'][0]['Cann_catheter_outside'];
		@$catheter_date =   date('d-m-Y', strtotime($data['forCatheter'][0]['Cann_intdate']));
		
		if($catheter==null) { $catheter = 'null'; }elseif($catheter=='0'){ if($outcat =='Yes') { $catheter = 'Catheter ('.$catheter_date.')<span> (OUTSIDE)</span></b>'; } else { $catheter = 'Catheter ('.$catheter_date.')'; } } 
		array_push($data2['new'],$catheter);
		
		
		//forRyles*******
		$data['forRyles'] = $this->Common_model->get_data_by_query("SELECT ryles_out_status,ryles_in_dt from nursef_ryles_tube where ryles_reg='$ipd' and ryles_uhid='$uhid' and ryles_out_status = 0 and 	delete_status = 1  ");
		
		@$ryles =  $data['forRyles'][0]['ryles_out_status'];
		@$ryles_date = date('d-m-Y', strtotime( $data['forRyles'][0]['ryles_in_dt']));
		if($ryles==null) { $ryles = 'null'; }elseif($ryles=='0'){ $ryles = 'Ryles-Tube ('.$ryles_date.')'; }
		array_push($data2['new'],$ryles);
		
		//forEtTube*******
		$data['forEtTube'] = $this->Common_model->get_data_by_query("SELECT et_out_status,et_in_dt from nursef_et_tube where et_reg='$ipd' and et_uhid='$uhid' and et_out_status = 0 and 	delete_status = 1 ");
		
		@$ettube =  $data['forEtTube'][0]['et_out_status'];
		@$ettube_day =  date('d-m-Y', strtotime( $data['forEtTube'][0]['et_in_dt']));
		if($ettube==null) { $ettube = 'null'; }elseif($ettube=='0'){ $ettube = 'ET-tube ('.$ettube_day.')'; }
		array_push($data2['new'],$ettube);
		
		
		//forTrachaeostomy*******
		$data['forTrach'] = $this->Common_model->get_data_by_query("SELECT trach_out_status,trach_in_dt from nursef_trach_tube where trach_reg='$ipd' and trach_uhid='$uhid' and trach_out_status = 0 and 	delete_status = 1 ");
		
		@$trach =  $data['forTrach'][0]['trach_out_status'];
		@$trach_day =  date('d-m-Y', strtotime( $data['forTrach'][0]['trach_in_dt']));
		if($trach==null) { $trach = 'null'; }elseif($trach=='0'){ $trach = 'Trachaeostomy ('.$trach_day.')'; }
		array_push($data2['new'],$trach);
		
		
		//forCentralLine*******
		$data['forCentralLine'] = $this->Common_model->get_data_by_query("SELECT centralline_status,centralline_in_date from nursf_centralline where centralline_ipd='$ipd' and centralline_uhid='$uhid' and centralline_status = 1 and 	delete_status = 1 ");
		
		@$centralline =  $data['forCentralLine'][0]['centralline_status'];
		@$centralline_day =  date('d-m-Y', strtotime( $data['forCentralLine'][0]['centralline_in_date']));
		if($centralline==null) { $centralline = 'null'; }elseif($centralline=='1'){ $centralline = 'Central-Line ('.$centralline_day.')'; }
		array_push($data2['new'],$centralline);
		
		
		//forVeinflown*******
		$data['forVeinflown'] = $this->Common_model->get_data_by_query("SELECT veinflon_out_status,veinflon_in_date from nursef_veinflon where veinflon_reg='$ipd' and veinflon_uhid='$uhid' and veinflon_out_status = 0 and 	delete_status = 1 ");
		
		@$veinflown =  $data['forVeinflown'][0]['veinflon_out_status'];
		@$veinflown_day =  date('d-m-Y', strtotime( $data['forVeinflown'][0]['veinflon_in_date']));
		if($veinflown==null) { $veinflown = 'null'; }elseif($veinflown=='0'){ $veinflown = 'Veinflown ('.$veinflown_day.')'; }
		array_push($data2['new'],$veinflown);
		
		//forVentilator*******
		$data['forVenti'] = $this->Common_model->get_data_by_query("SELECT respi_status,respi_in_date from nursf_respi_sys where respi_ipd='$ipd' and respi_uhid='$uhid' and respi_status = 1 and 	delete_status = 1 ");
		
		@$Venti =  $data['forVenti'][0]['respi_status'];
		@$respi_day =  date('d-m-Y', strtotime( $data['forVenti'][0]['respi_in_date']));
		if($Venti==null) { $Venti = 'null'; }elseif($Venti=='1'){ $Venti = 'Ventilator('.$respi_day.')'; }
		array_push($data2['new'],$Venti);
		
		//forDrain*******
		$data['forDrain'] = $this->Common_model->get_data_by_query("SELECT drain_out_status,drain_in_dt from nursef_drain_tube where drain_reg='$ipd' and drain_uhid='$uhid' and drain_out_status = 0 and 	delete_status = 1 ");
		
		@$drain =  $data['forDrain'][0]['drain_out_status'];
		@$drain_day =  date('d-m-Y', strtotime( $data['forDrain'][0]['drain_in_dt']));
		if($drain==null) { $drain = 'null'; }elseif($drain=='0'){ $drain = 'Drain('.$drain_day.')'; }
		array_push($data2['new'],$drain);
		
		//for Transfusion*******
		$data['fortransf'] = $this->Common_model->get_data_by_query("SELECT * from nursef_blood where blood_ipd='$ipd' and blood_uhid='$uhid' and blood_status = 1");
		
		@$blood_status =  $data['fortransf'][0]['blood_status'];
		if($blood_status==null) { $blood_status = 'null'; }
		if($blood_status == 1){
			@$blood_day =  date('d-m-Y', strtotime( $data['fortransf'][0]['blood_entrydt']));
			$blood = 'Blood Transfusion('.$blood_day.')';
		}
		array_push($data2['new'],@$blood);
		
		return $data2['new'];
	}
	
	function RemovedCath($uhid ,$ipdopd)
	{
		
		$daterem = $this->Common_model->get_data_by_query("SELECT max(Cann_extdate) as maxtime from nursef_cann_cathe where Cann_ipd='$ipdopd' and Cann_uhid='$uhid' and Cann_extstatus = 1 and delete_status = 1 ");
		
		return $daterem;
	}
	
	
	public function updateWardProcedures($admit_id,$newward)
		{
			$int_reg=$admit_id;    
			$datef ='0000-00-00 00:00:00';
			$datef1 ='0000-00-00';
			
			
			$data['Cann_ward']=$newward;
			$this->Crud_model->edit_record_by_any_two_id('nursef_cann_cathe',$int_reg,$datef,$data,'Cann_ipd','Cann_extdate');
			
			
			$data1['ryles_ward']=$newward;
			$this->Crud_model->edit_record_by_any_two_id('nursef_ryles_tube',$int_reg,$datef,$data1,'ryles_reg','ryles_out_dt');
			
			
			$data2['et_ward']=$newward;
			$this->Crud_model->edit_record_by_any_two_id('nursef_et_tube',$int_reg,$datef,$data2,'et_reg','et_out_dt');
			
			
			$data3['trach_ward']=$newward;
			$this->Crud_model->edit_record_by_any_two_id('nursef_trach_tube',$int_reg,$datef,$data3,'trach_reg','trach_out_dt');
			
			
			$data4['centralline_ward']=$newward;
			$this->Crud_model->edit_record_by_any_two_id('nursf_centralline',$int_reg,$datef,$data4,'centralline_ipd','centralline_out_date');
			
			
			$data5['veinflon_ward']=$newward;
			$this->Crud_model->edit_record_by_any_two_id('nursef_veinflon',$int_reg,$datef,$data5,'veinflon_reg','veinflon_out_date');
		   
			
			$data7['respi_ward']=$newward;
			$this->Crud_model->edit_record_by_any_two_id('nursf_respi_sys',$int_reg,$datef,$data7,'respi_ipd','respi_out_date');
		    
			
			$data8['drain_ward']=$newward;
			$this->Crud_model->edit_record_by_any_two_id('nursef_drain_tube',$int_reg,$datef1,$data8,'drain_reg','drain_out_dt');
		}

				
	function removeallprocedures($admit_id)
		{
			$int_reg=$admit_id;    
			$datef ='0000-00-00 00:00:00';
			$datef1 ='0000-00-00';
			
			// $data['Cann_exttime']=date('H:i:s');	
			$data['Cann_extdate']=date('Y-m-d H:i:s');	
			$data['Cann_extentrydt']=date('Y-m-d H:i:s');
			$data['Cann_extstatus']=1;
			$this->Crud_model->edit_record_by_any_two_id('nursef_cann_cathe',$int_reg,$datef,$data,'Cann_ipd','Cann_extdate');
			
			// die;
			$data1['ryles_out_dt']=date('Y-m-d H:i:s');
			$data1['ryles_out_entrydt']=date('Y-m-d H:i:s');
			$data1['ryles_out_status']=1;
			$this->Crud_model->edit_record_by_any_two_id('nursef_ryles_tube',$int_reg,$datef,$data1,'ryles_reg','ryles_out_dt');
			
			$data2['et_out_dt']=date( 'Y-m-d H:i:s' );
			$data2['et_out_entrydt']=date( 'Y-m-d H:i:s' );
			$data2['et_out_status']=1;
			$this->Crud_model->edit_record_by_any_two_id('nursef_et_tube',$int_reg,$datef,$data2,'et_reg','et_out_dt');
			
			$data3['trach_out_dt']=date( 'Y-m-d H:i:s' );
			$data3['trach_out_entrydt']=date( 'Y-m-d H:i:s' );
			$data3['trach_out_status']=1;
			$this->Crud_model->edit_record_by_any_two_id('nursef_trach_tube',$int_reg,$datef,$data3,'trach_reg','trach_out_dt');
			
			$data4['centralline_out_date'] = date('Y-m-d H:i:s');
			$data4['centralline_out_entrydt']=date('Y-m-d H:i:s');
			$data4['centralline_status']=0;
			$this->Crud_model->edit_record_by_any_two_id('nursf_centralline',$int_reg,$datef,$data4,'centralline_ipd','centralline_out_date');
			
			$data5['veinflon_out_date'] = date('Y-m-d H:i:s');
			$data5['veinflon_out_entrydt']=date('Y-m-d H:i:s');
			$data5['veinflon_out_status']=1;
			$this->Crud_model->edit_record_by_any_two_id('nursef_veinflon',$int_reg,$datef,$data5,'veinflon_reg','veinflon_out_date');
		   
			$data7['respi_out_date'] = date('Y-m-d H:i:s');
			$data7['respi_exitdt']=date('Y-m-d H:i:s');
			$data7['respi_status']=0;
			$this->Crud_model->edit_record_by_any_two_id('nursf_respi_sys',$int_reg,$datef,$data7,'respi_ipd','respi_out_date');
		    
			$data8['drain_out_entrydt']=date( 'Y-m-d H:i:s' );
			$data8['drain_out_dt']=date( 'Y-m-d H:i:s' );
			$data8['drain_out_status']=1;
			$this->Crud_model->edit_record_by_any_two_id('nursef_drain_tube',$int_reg,$datef1,$data8,'drain_reg','drain_out_dt');
		}
		
	public function get_advance($empid)
		{
			$reslt = '';
			$reslt= $this->Common_model->get_data_by_query("select * FROM hr_adv where 0=0  adv_empid = $empid");
			if(count($reslt) > 0)
			{
				return $reslt;
			}
		}
		
		public function get_emp_details($empid)
		{
			$reslt = '';
			$reslt= $this->Common_model->get_data_by_query("select dep.dep_name,desig.desig_name FROM employee e left join department dep on dep.dep_id = e.emp_dep left join designation desig on 
			desig.desig_id = e.emp_desig
            
			where 0=0 and e.emp_id = $empid and edoc.edoc_name='Photo' ");
			if(count($reslt) > 0)
			{
				return $reslt;
			}
		}
		public function get_emp_profile($empid)
		{
			$reslt = '';
			$reslt= $this->Common_model->get_data_by_query("select edoc_file from employee_doc where edoc_eid=$empid and edoc_name='photo' ");
			if(count($reslt) > 0)
			{
				return $reslt;
			}
		}
	
		public function getNuringNotifi($admit_id)
		{
			// $otstatus = $this->Common_model->get_data_by_query("SELECT  *  from ot t left join ipd_admit i on t.ot_ipdid_cathid=i.admit_id and i.admit_uhid= t.ot_uhid where ot_status in (1) and i.admit_ward= $ward and i.admit_status in ('CP','NA')");
			
			$otstatus = $this->Common_model->get_data_by_query("SELECT * from ot where ot_status in (1) and ot_ipdid_cathid = $admit_id ");
			$fromnursing = $this->Common_model->get_data_by_query("select  ps . * , a . * 
										from pd_pending_sales ps 
										left join ipd_admit a on a.admit_id = ps.pending_ipd
										where admit_id = $admit_id and pending_status_bypharma=1 group by pending_ref_id  order by pending_id desc ");
										$consul = $this->Common_model->get_data_by_query("SELECT cons_notifi from nursef_consultation where cons_notifi in (2) and cons_ipd = $admit_id");
			
			if(count($otstatus) > 0 || count($fromnursing)>0 || count($consul)>0)
			{
				return count($otstatus)+count($fromnursing)+count($consul);
			}
		}
		public function getconsulnoti()
		{
			// $otstatus = $this->Common_model->get_data_by_query("SELECT  *  from ot t left join ipd_admit i on t.ot_ipdid_cathid=i.admit_id and i.admit_uhid= t.ot_uhid where ot_status in (1) and i.admit_ward= $ward and i.admit_status in ('CP','NA')");
			
			$consul = $this->Common_model->get_data_by_query("SELECT cons_notifi from nursef_consultation where cons_notifi in (1)");
			
			
			if(count($consul) > 0 )
			{
				return count($consul);
			}
			 
		}
		
		public function getStorenoti()
		{
			
			 
			$stornoti = $this->Common_model->get_data_by_query("SELECT prest_notify from present_stock where prest_notify in (1) group by prest_billno");
			
			
			if(count($stornoti)>0 )
			{
				return count(@$stornoti);
			}
			 
		}		
		public function getStorePurchase($userid)
		{
			
			 
			$purchsenoti = $this->Common_model->get_data_by_query("SELECT purch_notify from purchase_requi where purch_notify in (1) and purch_by = '$userid'");
			
			
			if(count($purchsenoti)>0 )
			{
				return count(@$purchsenoti);
			}
			 
		}
		
		public function GetAddStorenoti($userid)
		{
			$stornoti = $this->Common_model->get_data_by_query("SELECT prest_notify from present_stock where prest_notify in (2) and prest_userid = $userid group by prest_billno");
			
			if( count($stornoti)>0 )
			{
				return count(@$stornoti);
			}
			 
		}	
		public function GetTabStorenoti($userid,$status)
		{
			$stornoti = $this->Common_model->get_data_by_query("SELECT prest_notify,prest_status from present_stock where prest_notify in (2) and prest_userid = $userid and prest_status = $status group by prest_billno");
			
			if( count($stornoti)>0 )
			{
				return count(@$stornoti);
			}
			 
		}
		public function getAdminRequi_Noti()
		{
			
			$adminnoti = $this->Common_model->get_data_by_query("SELECT purch_notify from purchase_requi where purch_notify in (2) group by purch_requiid");
			
			
			if(count(@$adminnoti) > 0 )
			{
				return count(@$adminnoti);
			}
			 
		}
	
		public function setBalance($casu_id,$balamt)
		{
			$data['casu_balanceamt'] = $balamt;
			$this->Crud_model->edit_record_by_anyid('casualty',$casu_id,$data,'casu_id');

		}
		
		
		public function GetCGHSId($uhid,$ipdid){
			$query = $this->db->query("select id from cghs_patient where uhid=$uhid and cghs_opdipd_id=$ipdid");
			// echo $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['id'];
			} else {
				return "0";
			}
		}
         
		 public function GetBplId($uhid,$ipdid){
			$query = $this->db->query("select id from bpl_patient where uhid=$uhid and bpl_ipd_id=$ipdid");
			// echo $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['id'];
			} else {
				return "0";
			}
		}

		public function insertCancer($uhid,$ipdid,$iscancer){
			
			
			
			
			$query = $this->db->query("select * from cancer_patient where cncr_uhid=$uhid and cncr_ipd_id=$ipdid");
			// echo $this->db->last_query();
			$row = $query->row_array();
			foreach ($query->result() as $row)
			{
				$cncr_id = $row->cncr_id;
			}
			$userid	= (array_slice($this->session->userdata,9,1));
			
			if ($query->num_rows() > 0) {
				 $datacancer['cncr_entrydt'] = date('Y-m-d H:i:s');
				 $datacancer['cncr_status'] = $iscancer;
				 $datacancer['cncr_uhid'] = $uhid;
				 $datacancer['cncr_ipd_id'] = $ipdid;
				 $datacancer['cncr_user'] = $userid['user_id'];
				if($iscancer == 0){
					$this->db->query("delete from cancer_patient where cncr_uhid = '$uhid' and cncr_ipd_id= '$ipdid' ");
				}
				elseif($iscancer == 1){
					$this->Crud_model->edit_record_by_anyid('cancer_patient',$cncr_id,$datacancer,'cncr_id');
				}
			} else {
				 $datacancer['cncr_entrydt'] = date('Y-m-d H:i:s');
				 $datacancer['cncr_status'] = $iscancer;
				 $datacancer['cncr_uhid'] = $uhid;
				 $datacancer['cncr_ipd_id'] = $ipdid;
				 $datacancer['cncr_user'] = $userid['user_id'];
				 if($iscancer == 1){
					$this->Crud_model->insert_record('cancer_patient',$datacancer);
				 }
			}
		}
	
	public function PatientReOPD($uhid)
		{
			$query = $this->db->query("SELECT uhid,count(*) as total FROM `opd_patient` WHERE uhid=".$uhid." group by uhid having total>1");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['uhid'];
			} else {
			}
		}	
	
	public function PatientCurb($uhid,$ipdid)
		{
			$query = $this->db->query("SELECT initial_vital_rr,initial_vital_cns,initial_vital_bp FROM initial_assessment WHERE initial_casu_id= '$ipdid' ");
			//$query2 = $this->db->query("SELECT patient_age FROM patient WHERE id= '$uhid' ");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row;
			} else {
			}
		}
		
	public function getptCreditBill($uhid,$ipdid)
	 {
		$regi=100;
	    $amountttt=$this->Common_model->get_data_by_query("select tran_amount from transaction where tran_paidstatus='NO' and tran_uhid='$uhid' and tran_ipd_opd_id='$ipdid' and taken_action=1");
		$amt=0;
		foreach($amountttt as $amtttt)
		{
			$amt=$amt+$amtttt['tran_amount'];
		
		}
		
		$amountt=$this->Common_model->get_data_by_query("select tran_amount from transaction_bill where tran_paidstatus!='go' and tran_uhid='$uhid' and tran_ipd_opd_id='$ipdid'");
		$tamtt=0;
		foreach($amountt as $amtt)
		{
			$tamtt=$tamtt+$amtt['tran_amount'];
		
		}
		
		$total=$amt+$tamtt+$regi;
		$totamount=(15*$total)/100;
		$totalamt=$total+$totamount;
		// $amttotal=(14*$totalamt)/100;
		// $amounttotal=$amttotal+$totalamt;
	$pay = $this->Common_model->get_data_by_query("select tran_serve_charge from transaction_bill where tran_uhid='$uhid' and tran_ipd_opd_id='$ipdid'"); 
	 
			$servcharge="";
         foreach($pay as $pa)
			{
				$p=$pa['tran_serve_charge'];
				if($p==1)
				{
				$servcharge=round(($totalamt*13)/100);
				}
				else 
				{
				$servcharge=0;	
				}		
			}
		
		$amttotal=$totalamt+$servcharge;
		return $amttotal;
		
	 }
		
		
		
		
		public function getScheme_ipd($ipdopdid,$uhid)
	{
		  
			    $data['schmeid']=$this->Common_model->get_data_by_query("select b.scheme_name from casualty a ,scheme b where a.casu_id = '$ipdopdid' and a.casu_scheme=b.id ");
				echo $data['schmeid'][0]['scheme_name'] ;
			 
	}
	



	public function getInvoiceAdjust($invoice)
	{

 
	$data['invoice']=$this->Common_model->get_data_by_query("select invoice_adjust from pd_invoice_cr where invoice_id = '$invoice'  ");
	return $data['invoice'][0]['invoice_adjust'] ;
	  
			
		}
	
	
	public function getReturnType($invoice)
	{

 
	$data['invoice']=$this->Common_model->get_data_by_query("select invoice_return_type from pd_invoice_ret where invoice_id = '$invoice'  ");
	return $data['invoice'][0]['invoice_return_type'] ;
	  
			
    }
	
	
	public function salarypaymode($empid)
	{

 
	$data['mode']=$this->Common_model->get_data_by_query("select salpaymode_mode from emp_salpaymode where salpaymode_empid = '$empid' order by salpaymode_id desc limit 1  ");
	return $data['mode'][0]['salpaymode_mode'] ;
	  
			
    }
	
		
	public function totalPhysio_ipd()
		{
			$currentdate=date('Y-m-d');
			
			$physioipd = $this->Common_model->get_data_by_query("select * from physio_allot where date_format(entry_date, '%Y-%m-%d')='$currentdate'");
			
			
			if(count($physioipd) > 0 )
			{
				return count($physioipd);
			}
			 
		}
		
	public function totalPhysio_opd()
		{
			$currentdate=date('Y-m-d');
			
			$physio_opd = $this->Common_model->get_data_by_query("select tran_id from transaction where date_format(tran_entrydt, '%Y-%m-%d')='$currentdate' and tran_opd_ipd_cas='OPD' and tran_servic='PHYSIOTHERAPY'");
			
			
			if(count($physio_opd) > 0 )
			{
				return count($physio_opd);
			}
			 
		}
		
		public function EmpCheckin($date,$code)
		{
			$data['chkout'] = $this->Common_model->get_data_by_query("SELECT min(`punch_dt`) as chkin from attendance_punches where pucnh_emp = $code and date_format(punch_dt,'%d-%m-%Y')='$date'");
			// echo $this->db->last_query();die;
			return $data['chkout'][0]['chkin'];
		}
		public function EmpCheckout($date,$code)
		{
			$data['chkout'] = $this->Common_model->get_data_by_query("SELECT max(`punch_dt`) as chkout from attendance_punches where pucnh_emp = $code and date_format(punch_dt,'%d-%m-%Y')='$date'");
			// echo $this->db->last_query();die;
			return $data['chkout'][0]['chkout'];
		}
		
		function EmpPresentDays($month,$year,$code)
		{
			$data['days'] = $this->Common_model->get_data_by_query("SELECT count(*) as days from attendance_logs where log_emp = $code and date_format(log_date,'%m') = '$month' and date_format(log_date,'%Y') = '$year'");
			
			return @$data['days'][0]['days'];
		}
		
		function EmpCheckin1($date,$code)
		{
			$data['chkin'] = $this->Common_model->get_data_by_query("SELECT log_in as chkin from attendance_logs where log_emp = $code and date_format(log_date,'%d-%m-%Y') = '$date'");
			// echo $this->db->last_query();die;
			return @$data['chkin'][0]['chkin'];
		}
		 function EmpCheckout1($date,$code)
		{
			$data['chkout'] =  $this->Common_model->get_data_by_query("SELECT log_out as chkout from attendance_logs where log_emp = $code and date_format(log_date,'%d-%m-%Y') = '$date'");
			// echo $this->db->last_query();die;
			return @$data['chkout'][0]['chkout'];
		}
		
		
		
			public function getitemscount($invoice,$invoice_type)
	{

	
	$data['invoice']=$this->Common_model->get_data_by_query("select count(*) as items from pd_sales where pd_sale_invoice = '$invoice' and pd_sale_invoice_type = '$invoice_type' ");
	return $data['invoice'][0]['items'] ;
	  
			
		}	
		
		public function getTotalCreditForAcc($invoice_type,$depart)
	{

	
		$data['totalCredit']=$this->Common_model->get_data_by_query("select sum(`invoice_amt`) as totalCredit from pd_invoice_cr where invoice_depart in ('$depart')" );
	
	
	return $data['totalCredit'][0]['totalCredit'] ;
	  
			
	}
		
		
	public function getTotalCredit($invoice_type,$ipdid,$depart)
	{

	if($depart == 'ipd' || $depart == 'Emp' ){
		$data['totalCredit']=$this->Common_model->get_data_by_query("select sum(`pd_tran_amt`) as totalCredit from pd_transaction where pd_tran_type in ('$invoice_type','6') and pd_tran_ipd = $ipdid");
	}
	elseif($depart == 'opd'){
		$data['totalCredit']=$this->Common_model->get_data_by_query("select sum(`pd_tran_amt`) as totalCredit from pd_transaction where pd_tran_type in ('$invoice_type','6') and pd_tran_opd = $ipdid");
	}
	
	return $data['totalCredit'][0]['totalCredit'] ;
	  
			
	}		
	
	
		
	public function getTotalReceipt($invoice_type,$ipdid,$depart)
	{

	
	
	
	if($depart == 'ipd' || $depart == 'Emp' ){
		$data['totalReceipt']=$this->Common_model->get_data_by_query("select sum(`pd_tran_amt`) as totalReceipt from pd_transaction where  pd_tran_type = '$invoice_type'  and pd_tran_ipd = $ipdid ");
	}
	elseif($depart == 'opd'){
		$data['totalReceipt']=$this->Common_model->get_data_by_query("select sum(`pd_tran_amt`) as totalReceipt from pd_transaction where  pd_tran_type = '$invoice_type'  and pd_tran_opd = $ipdid ");
	}
	
	return $data['totalReceipt'][0]['totalReceipt'] ;
	  
			
		}
		
	public function getTotalDiscount($ipdid,$depart)
	{

	if($depart == 'ipd' || $depart == 'Emp' ){
		$data['totalDiscount']=$this->Common_model->get_data_by_query("select sum(`receipt_roundoff`) as totalDiscount from pd_receipt where  receipt_ipd = '$ipdid' ");
	}
	elseif($depart == 'opd'){
		$data['totalDiscount']=$this->Common_model->get_data_by_query("select sum(`receipt_roundoff`) as totalDiscount from pd_receipt where  receipt_ipd = '$ipdid' ");
	}
	
	return $data['totalDiscount'][0]['totalDiscount'] ;
	  
			
		}
		
	public function getTotalReturn($invoice_type,$ipdid,$depart)
	{

	if($depart == 'ipd' || $depart == 'Emp' ){
		$data['totalReturn']=$this->Common_model->get_data_by_query("select sum(`pd_tran_amt`) as totalReturn from pd_transaction t  left join pd_invoice_ret r on r.invoice_id = t.pd_tran_invoice   where  t.pd_tran_type = '$invoice_type'  and t.pd_tran_ipd = $ipdid and r.invoice_return_type = 2 ");
		
		
	}
	elseif($depart == 'opd'){
		$data['totalReturn']=$this->Common_model->get_data_by_query("select sum(`pd_tran_amt`) as totalReturn from pd_transaction t  left join pd_invoice_ret r on r.invoice_id = t.pd_tran_invoice   where  t.pd_tran_type = '$invoice_type'  and t.pd_tran_opd = $ipdid and r.invoice_return_type = 2 ");
	}
	
	return $data['totalReturn'][0]['totalReturn'] ;
	  
			
		}
	
	public function getTotalAdvReceipt($invoice_type,$ipdid,$depart)
	{

	if($depart == 'ipd' || $depart == 'Emp' ){
		$data['totalAdvReceipt']=$this->Common_model->get_data_by_query("select sum(`pd_tran_amt`) as totalAdvReceipt from pd_transaction where  pd_tran_type = '$invoice_type'  and pd_tran_ipd = $ipdid ");
	}
	elseif($depart == 'opd'){
		$data['totalAdvReceipt']=$this->Common_model->get_data_by_query("select sum(`pd_tran_amt`) as totalAdvReceipt from pd_transaction where  pd_tran_type = '$invoice_type'  and pd_tran_opd = $ipdid ");
	}
	
	return $data['totalAdvReceipt'][0]['totalAdvReceipt'] ;
	  
			
		}
		
		public function patientStatus($ipd)
		{
			
			$data['patid'] = $this->Common_model->get_data_by_query("select admit_status from ipd_admit where admit_id='$ipd'");
			
			
			return $data['patid'][0]['admit_status'] ;
			 
		}
		
		
		
		public function ShowAmtdis($dis_id)
	{
		
			    $data['dis']=$this->Common_model->get_data_by_query("select sum(banknew_amount) as total_amt from bank_statement_new where banknew_dis=$dis_id and banknew_app_status=0 ");
				return $data['dis'][0]['total_amt'] ;

			
	}
	
		public function getUhidByipd($ipdid)
	{
		  $data['uhidata']=$this->Common_model->get_data_by_query("select casu_uhid from casualty where casu_id='$ipdid' ");
		  return @$data['uhidata'][0]['casu_uhid'];
	}
	
	public function getEmergencyWardPt($dt,$ward)
	{
		$data['uhidata']=$this->Common_model->get_data_by_query("select p.first_name,p.middle_name,p.last_name,a.admit_id,a.admit_uhid from ipd_admit a left join patient p on p.id = a.admit_uhid where a.admit_ward = $ward and date_format(a.admit_entrydt,'%Y-%m-%d') = '$dt' ");
		return $data['uhidata'] ;
			 
	}
	
	public function getlastTemprature($uhid,$ipdid)
	{
		
	
		$data['temprature']=$this->Common_model->get_data_by_query("select vital_temp, vital_entrydt from vital_signs where vital_ipd =$ipdid and vital_uhid=$uhid order by vital_entrydt desc limit 1 ");
		
		if($data['temprature']==null)
		{
			return "";
		}
		else{
			return $data['temprature'][0]['vital_temp']."###".$data['temprature'][0]['vital_entrydt'] ;
		}
		
			 
	}
	
	public function getlastInfectionForms($uhid,$ipdid)
	{
		
	
		$data['infectionformCount']=$this->Common_model->get_data_by_query("select count(rmo_id) as total from nur_emo_form where rmo_uhid =$uhid and rmo_ipd=$ipdid ");
		
		
	   return $data['infectionformCount'][0]['total']  ;
		
		
			 
	}
	
		public function getinfecCount($type,$stdata,$enddata)
	 {
		 if($type== 1)
		 {
			$getVap = $this->Common_model->get_data_by_query("select count(rmo_fnlvap) as totalvap from nur_emo_form where rmo_fnlvap = 1 and date_format(rmo_entrydt,'%d-%m-%Y') between '$stdata' and '$enddata'");
			return($getVap[0]['totalvap']);
		 }
		 else if($type== 2)
		 {
			$getUti = $this->Common_model->get_data_by_query("select count(rmo_fnluti)  as totaluti from nur_emo_form where rmo_fnluti = 1 and date_format(rmo_entrydt,'%d-%m-%Y') between '$sdata' and '$esdata'");
			return($getUti[0]['totaluti']);
		 }
		  else if($type== 3)
		 {
			$getBsi = $this->Common_model->get_data_by_query("select count(rmo_fnlbsi)  as totalbsi from nur_emo_form where rmo_fnlbsi = 1 and date_format(rmo_entrydt,'%d-%m-%Y') between '$sdata' and '$esdata' ");
			return($getBsi[0]['totalbsi']);
		 }
		  else if($type== 4)
		 {
			$getSsi = $this->Common_model->get_data_by_query("select count(rmo_fnlssi)  as totalssi from nur_emo_form where rmo_fnlssi = 1 and date_format(rmo_entrydt,'%d-%m-%Y') between '$sdata' and '$esdata'");
			return($getSsi[0]['totalssi']);
		 }
		
	 }
	 
	 
	 public function getMedName($medid)
	 {  
	     
		  $data['medname']=$this->Common_model->get_data_by_query("select pd_trade_name from pd_drug_master where pd_id='$medid'");
		
		  return $data['medname'][0]['pd_trade_name'];
	 }
	 
	public Function GetMediStock($med_id)
	{
		
		$totstock = $this->Common_model->get_data_by_query("select (sum(batch_stock_qty) - sum(batch_sold_qty)) as tot from pd_batch_stock where med_id = '$med_id'");
		$stocktot = $totstock[0]['tot'];
		return $stocktot;
	}
	 
	public function getNursNote_Capa($uhid,$reg,$shift,$nurstype,$date)
	{  

		$cupacheck = $this->Common_model->get_data_by_query("select * from nursef_capa where capa_uhid='$uhid' and capa_reg = '$reg' and capa_nurs_shift = '$shift' and capa_nurs_type='$nurstype' and date_format(capa_nurs_date,'%Y-%m-%d') = '$date'");

		$data['caction']  = @$cupacheck[0]['capa_caction'];
		$data['paction']    =  @$cupacheck[0]['capa_paction'];
		$data['routecause']    =  @$cupacheck[0]['capa_routecause'];
		$data['incidence']   =  @$cupacheck[0]['capa_incidence'];
		return($data);

	}
		
		public function getPatientName($uhid)
	     {
         
	     	$data['patientDetails'] = $this->Common_model->get_data_by_query("SELECT first_name,middle_name,last_name from patient where id ='$uhid' ");
	     	
	     	return $data['patientDetails'][0]['first_name']." ".$data['patientDetails'][0]['middle_name']." ".$data['patientDetails'][0]['last_name'];
	     	
	     }	
	
	
	public function getDetailByDoc($itemid)
	    {
       
	    	$data['docdetail'] = $this->Common_model->get_data_by_query("SELECT doc_department from doctor where m_id ='$itemid' ");
	    	
	    	return $data['docdetail'][0]['doc_department'];
	    	
	    }
	public function getBiomedicalName($itemid)
	    {
       
	    	$data['patientDetails'] = $this->Common_model->get_data_by_query("SELECT bio_name from biomedical_name where bio_id ='$itemid' ");
	    	
	    	return $data['patientDetails'][0]['bio_name'];
	    	
	    }	
		
		public function getStoreItemName($itemid)
	    {
       
	    	$data['storeitem'] = $this->Common_model->get_data_by_query("select item_name,item_instock from store_items where store_item_id = '$itemid'");
	    	
	    	return $data['storeitem'][0]['item_name']."###".$data['storeitem'][0]['item_instock'];
	    	
	    }	
		public function getVendorName($vendrid)
	    {
       
	    	$data['vendor'] = $this->Common_model->get_data_by_query("select vendor_address,vendor_phone,vendor_email,vendor_name,vendor_id from vendor where vendor_status = 1 and vendor_id = '$vendrid'");
	    	
	    	return $data['vendor'][0]['vendor_name']."####".$data['vendor'][0]['vendor_address']."####".$data['vendor'][0]['vendor_phone']."####".$data['vendor'][0]['vendor_email'];
	    	
	    }
		public function getPODetails($poid)
	    {
       
	    	$data['purchseorder'] = $this->Common_model->get_data_by_query("select  * from get_purch_order where  po_id = '$poid'");
	    	
	    	return $data['purchseorder'][0]['po_vendid']."####".$data['purchseorder'][0]['po_id']."####".$data['purchseorder'][0]['po_item']."####".$data['purchseorder'][0]['po_entrydt']."####".$data['purchseorder'][0]['po_dep']."####".$data['purchseorder'][0]['po_userid'];
	    	
	    }
		
	public function getBplApprovalAmt($uhid)
	    {
       
	    	 $approveEstimate= $this->Common_model->get_data_by_query("select p_doc_amount,p_doc_path from patient_document where p_doc_type='bpl_pay_app' and file_status='1' and p_doc_uhid=$uhid  ");
				 
	    	return $approveEstimate;
			

	    	
	    }
		
		public function getFirmName($firmid)
	    {
       
	    	 $firmname= $this->Common_model->get_data_by_query("select firm_name from manage_firm where firm_id = $firmid ");
				 
	    	return $firmname[0]['firm_name'];
		}	

		public function getanyDetail($findid,$findname,$tablename,$fieldname)
	    {
       
	    	 $firmname= $this->Common_model->get_data_by_query("select $fieldname from $tablename where $findname = '$findid' ");
				 
	    	return $firmname[0][$fieldname];
		}
		
	public function check_date_is_within_range($start_date, $end_date, $todays_date)
		{

		  $start_timestamp = strtotime($start_date);
		  $end_timestamp = strtotime($end_date);
		  $today_timestamp = strtotime($todays_date);

		  return (($today_timestamp >= $start_timestamp) && ($today_timestamp <= $end_timestamp));

		}
	
		public function estimateAmount($uhid)
	    {
       
	    	 $estimate= $this->Common_model->get_data_by_query("select * from bpl_estimate where uhid='$uhid' and bpl_est_status='1'");
				 
	    	return $estimate[0]['treat_cost'];
		}	
		
		public function get_set_barcode($code)
	    {
       
	    	 $barcodeOptions = array(
				'text' => $code, 
				'barHeight'=> 20, 
				'factor'=>3.98,
			);


			$rendererOptions = array();
			$renderer = Zend_Barcode::factory('code128', 'image', $barcodeOptions, $rendererOptions)->render();
				 
	    	return $renderer;
		}


       public function passbook_hospital_bill($date)
	   {
		   $hospitalbill=$this->Common_model->get_data_by_query("select sum(tran_amount) as total from transaction where date_format(tran_entrydt,'%Y-%m-%d')='$date'");
		   
		   return $hospitalbill[0]['total'];
	   }


       public function passbook_online_bill($date)
	   {
		   $onlinebill=$this->Common_model->get_data_by_query("select sum(topup_amount) as total from smcard_topup where date_format(topup_entrodt,'%Y-%m-%d')='$date'");
		   
		   return $onlinebill[0]['total'];
	   }


       public function passbook_payvoch_bill($date)
	   {
		   $paymentvoch= $this->Common_model->get_data_by_query("select sum(voch_tds_amtpaid) as total from account_voucher where voch_status=4 and voch_type=1 and date_format(voch_date,'%Y-%m-%d')='$date'");
		   
		   return $paymentvoch[0]['total'];
	   }	   


          

	
		
		
	}
?>
