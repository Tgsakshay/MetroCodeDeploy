<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Testing_model extends CI_Model 
	{
        
		function __construct()
        {
            parent::__construct();
        }
		
  
		public function TotalBillRajivSir($uhid ,$ipdid)
       {
		   

	
		  $scheme=$this->Common_model->getSchemeNameReturnID($uhid ,$ipdid,'IPD');
		  
		  
		  
		    if($scheme==2 || $scheme==3 || $scheme==10 )
			{
		    $bplidata['idbpl'] = $this->Common_model->get_data_by_query(" select id,bpl_bill from bpl_patient where bpl_ipd_id=$ipdid and uhid=$uhid");
		   
		    $bplid= $bplidata['idbpl'][0]['id'] ;
		    $billprepared= $bplidata['idbpl'][0]['bpl_bill'] ;
			
			
		     $data['medicine'] = $this->Common_model->get_data_by_query("select sum(bpl_bill_amount) as totalmedi from bpl_bill where  bpl_bill_uhid=$uhid and bpl_bill_bpl_id=$bplid and bpl_bill_type='Medicine'");
		   
		   $query= $this->db->query("SELECT sum(bpl_bill_amount) as total FROM bpl_bill WHERE bpl_bill_uhid=$uhid and bpl_bill_bpl_id=$bplid " );
		 
	 if ($query->num_rows() > 0)
				{
					$row = $query->row(); 
			
					 $data['Billtotal']=$balance=$row->total;
				}
		   
		   		   
		      $data['investitotal'] = $this->Common_model->get_data_by_query("select sum(tran_amount) as totalinvest from transaction where tran_uhid=$uhid and tran_ipd_opd_id=$ipdid and (tran_department='X-Ray' or tran_department='Pathology' or tran_department='CT-scan'  or tran_department='USG' or tran_servic like 'MRI%') and tran_cghs_del_status=1");
		   
				 $query2= $this->db->query("SELECT sum(bpl_bill_amount) as total2 FROM bpl_bill WHERE bpl_bill_uhid=$uhid");
		 
	 if ($query2->num_rows() > 0)
				{
					$row = $query2->row(); 
			
					  $data['BilltotalExpence']=$balance=$row->total2;
			
				}
				 if ($data['BilltotalExpence'] =='')
				{
				
			
					  $data['BilltotalExpence']=0;
				}	
				
				$billtotal=$data['Billtotal']+$data['investitotal'][0]['totalinvest'] ;
			    
				$investitotal=$data['investitotal'][0]['totalinvest'] ;
				$toatalmedi=$data['medicine'][0]['totalmedi'] ;
				
				if($billprepared=='yes')
				{
				// echo $billtotal+((($billtotal-$investitotal-$toatalmedi)/100)*15); 	
				   // $billtotal+((($billtotal-$investitotal-$toatalmedi)/100)*15);; 	

	if( $uhid=='3179' || $uhid=='3097' || $uhid=='2881' || $uhid=='3403' || $uhid=='3330' || $uhid=='3460'  || $uhid=='3782' || $uhid=='3294' || $uhid=='3248' || $uhid=='3188' || $uhid=='4120' || $uhid=='3338' || $uhid=='3937' || $uhid=='3479' || $uhid=='3251' || $uhid=='3377' || $uhid=='4097' || $uhid=='3661' || $uhid=='4135'|| $uhid=='4045'|| $uhid=='2939'|| $uhid=='3001'|| $uhid=='3867'|| $uhid=='4154'|| $uhid=='4383'|| $uhid=='4109'|| $uhid=='3250'|| $uhid=='3830'|| $uhid=='3462'|| $uhid=='3971'|| $uhid=='3808'|| $uhid=='3224'|| $uhid=='3037'|| $uhid=='3876'|| $uhid=='3113'|| $uhid=='3021'|| $uhid=='3060' )
				 {
										 
										  return $billtotal+((($billtotal)/100)*15); 
									 }
									 else{
									   return $billtotal+((($billtotal-$investitotal-$toatalmedi)/100)*15); 
									 }
				
				}
				else{
					
					// echo 'Bill Not Prepared'; 
                    return  'Bill Not Prepared'; 					 
					
				}
				
				}
				elseif($scheme==4 || $scheme==5 || $scheme==6 || $scheme==7 || $scheme==8 || $scheme==9 )
				
				{    
				
				
				$data['patientDetail'] = $this->Common_model->get_data_by_query("SELECT cghs_pack_billing from cghs_patient where uhid=$uhid and cghs_opdipd_id=$ipdid ");
				
				$packbill= @$data["patientDetail"][0]["cghs_pack_billing"];
				
				
				  if($packbill=='No')
		  {
			
					
					   $billcghs['cghsbill'] = $this->Common_model->get_data_by_query("SELECT sum(`cghs_tran_amount`) as total2 FROM cghs_transaction WHERE `cghs_tran_uhid`=$uhid and `cghs_tran_ipd_opd_id`=$ipdid and `cghs_tran_cghs_del_status`=1 ");
		  }

           else
		  {
			  $billcghs['cghsbill'] = $this->Common_model->get_data_by_query("SELECT sum(`cghs_tran_amount`) as total2 FROM cghs_transaction WHERE `cghs_tran_uhid`=$uhid and `cghs_tran_ipd_opd_id`=$ipdid and `cghs_tran_cghs_del_status`=1 and cghs_tran_department='Package' ");
		  }


		  
					//echo  $billcghs['cghsbill'][0]['total2'];
					return   $billcghs['cghsbill'][0]['total2'];
					
				}
				
				
				
            }
			
		public function genNotfiDisPlane($ipdid,$uhid)
     	{
			$usertoset = array("1", "5","34","74","60","63","118","65","78","392");
			
			  $pat['detail'] = $this->Common_model->get_data_by_query("select * from patient where id='$uhid'");
			  $disc['planed'] = $this->Common_model->get_data_by_query("select admit_dis_plan_dt from ipd_admit where admit_id='$ipdid'");
			   
			   $patname=$pat['detail'][0]['first_name']." ".$pat['detail'][0]['middle_name']." ".$pat['detail'][0]['last_name'] ;
			     $dischargeplaned=$disc['planed'][0]['admit_dis_plan_dt'];
			   foreach($usertoset as $userid)
			   {
				   $data['not_sender_id']='1';
				   $data['not_type']='discharge_planed';
				   $data['not_heading']='Discharge is Planned for UHID '.$uhid ;
				   $data['not_message']='Discharge is Planned for UHID '.$uhid." Registration Number".$ipdid." Name ".$patname." on ".$dischargeplaned;
				   $data['not_href']='aaa/aaaa.php';
				   $data['not_recipient_id']=$userid;
				   $data['not_created_time']=date('Y-m-d H:i:s');
				   $data['not_uhid']=$uhid;
				   $data['not_ipdid']=$ipdid;
				   
				   
				   $this->Crud_model->insert_record('notification',$data);
				   
				   
			   }
			   
			   
		   
	    }
		
		public function Patient_balance($uhid,$ipdopd_id)
		{
			
			 $disc['topup_amt_data'] = $this->Common_model->get_data_by_query("select sum(topup_amount) as amount from smcard_topup where topup_uhid=$uhid and topup_ipd_opd_id=$ipdopd_id ");
			 
			 $topup_amt=$disc['topup_amt_data'][0]['amount'];
			
			$query = $this->db->query("select sum(refund_amount) as ref_amount from refund_amount where refund_uhid=$uhid and refund_ipdopd_id=$ipdopd_id");
			$row = $query->row_array();
			
			if ($query->num_rows() > 0) {
				$refund_amt= $row['ref_amount'];
			}
			
			$query = $this->db->query("select sum(tran_final_discount) as tran_final_discount from transaction_bill where tran_uhid=$uhid and tran_ipd_opd_id=$ipdopd_id ");
			
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				$discount= $row['tran_final_discount'];
			}
			
			$query = $this->db->query("select sum(tran_amount) as inves_amt from transaction where tran_paidstatus='NO' and tran_uhid=$uhid and tran_ipd_opd_id=$ipdopd_id  ");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				$investi= $row['inves_amt'];
			}
			
			$query = $this->db->query("select sum(tran_amount) as bill_amt,tran_serve_charge,tran_pakage_status from transaction_bill where tran_uhid=$uhid and tran_ipd_opd_id=$ipdopd_id and tran_paidstatus='NO' and tran_servic!=''");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				$bill= $row['bill_amt'];
				$serv_charge= $row['tran_serve_charge'];
				$tran_pakage_status= $row['tran_pakage_status'];
			}
			
			$bill_amount=$bill+$investi+100;
			$topup_amt_adv=$topup_amt-$refund_amt;
			
			$nurscharge=round(($bill_amount*15)/100);
			$final_billamt=$bill_amount+$nurscharge;
			
			if($serv_charge==1){
			$servcharge=round(($final_billamt*13)/100); 
			}elseif($serv_charge==0){
			$servcharge=0;
			}else{
			$servcharge=0; 
			}
			
			$final_bill_sernur=$final_billamt+$servcharge;
			$all_final=$final_bill_sernur-$topup_amt_adv;
			$all_final2=$all_final-$discount;
			
			if($tran_pakage_status==1)
			{
			return 0;	
			}else
			{
			
			if ($all_final2 > 0) {
				return $all_final2;
			} else {
			}
			
			
			}
			
			
			
		return $all_final2;
		
		}
				
	public function addRecordchart1()
	{
		
		
	$fromDate = date('Y-m-d', strtotime('2016-06-01')) ;
	$toDate = date('Y-m-d');
	
	
	$resultwards = $this->Common_model->get_data_by_query("Select r_name,r_id from resource where r_level = 3");
    $icn_m_date =date('Y-m-d');
	
	$ipd_ward = "";
	$data['inPatient'] = $this->Common_model->get_data_by_query("Select * from ipd_admit where admit_status in ('CP','NA') and admit_hide = 1 ");
	
	foreach($data['inPatient'] as $inp){
		
	
		$ipd_ward = $ipd_ward.$inp['admit_id']."-".$inp['admit_ward'].",";
		
	}
	
	$data11['inpatient_ipds_ward'] = $ipd_ward;
	$data11['inpatient_days'] = count($data['inPatient']);
	$data11['inpatient_entrydt'] = date("Y-m-d H:i:s");
	
	echo $ipd_ward;
	
	$this->Crud_model->insert_record('inpatient',$data11);
		
		
	foreach($resultwards as $ward1)
	{
	
		
		$code = array();
        $code1 = array();
        $code2 = array();
        $code3 = array();
        $code4 = array();
        $code5 = array();
		$code['response']=array();
		$code1['response']=array();
		$code2['response']=array();
		$code3['response']=array();
		$code4['response']=array();
		$code5['response']=array();
		
		$ward = $ward1['r_id'];
		$data['abcd'] = $this->Common_model->get_data_by_query("select chart1_id,chart1_date from nursing_chart1 where chart1_ward='$ward' order by chart1_id desc limit 1");
		@$icn_m_id = $data['abcd'][0]['chart1_id'];
		@$chart_date = $data['abcd'][0]['chart1_date']; 
		
		///mayank code starts
		
		$data['dischargeTrans'] = $this->Common_model->get_data_by_query("Select * from inpatient where date_format( inpatient_entrydt , '%Y-%m-%d' ) = '$chart_date' order by inpatient_id desc limit 1");
			// echo $this->db->last_query().'</br></br>';
			// die;
			@$dischargeTrans = $data['dischargeTrans'][0]['inpatient_days'];
			if($dischargeTrans == ''){
				@$dischargeTrans = 0;
			}
			
			$ipdward = @$data['dischargeTrans'][0]['inpatient_ipds_ward'];
			if($ipdward != 0 || $ipdward != ''){
				
				
				 // echo $i." - ".@$data['dischargeTrans'][0]['inpatient_ipds_ward']."</br></br>";;
			
					$inpatient_ipds_ward = explode(',',$ipdward);
					// print_r($inpatient_ipds_ward)."</br></br>";
					// echo $inpatient_ipds_ward[110]."</br>";
					$arr_count = count($inpatient_ipds_ward)."</br>";
					
					//for($j=0;$j<$arr_count;$j++){
						
						// echo $i." - ".$j." - ". $inpatient_ipds_ward[$j]."</br>";
						//$inpatient_ipds_ward[$j];
					//}
				
				
			}
			else{
				// echo $i." - 0</br>";
				$arr_count = 0;
			}
			$dt=date('Y-m-d');
		$data1['chart1_Occupied_new'] =$arr_count;	
		if($dt == $chart_date)
		{
		
		$this->Crud_model->edit_record_by_any_id('nursing_chart1','chart1_id',$icn_m_id,$data1);
	   
		}
		//total beds in ward 
		$data['beds'] = $this->Common_model->get_data_by_query("Select count(*) as beds from resource where r_under_id = '$ward' ");
		$beds = $data['beds'][0]['beds'];
		

		//total occupied beds in ward		
		$data['occupiedbeds'] = $this->Common_model->get_data_by_query("Select count(*) as occupiedbeds from resource where r_under_id = '$ward' and status_resource = 1 ");
		$occupiedbeds = $data['occupiedbeds'][0]['occupiedbeds'];
		   
		$loop=0;
		$m=date('m');
		$y=date('Y');
		$d=date('d');
		$today = $y.'-'.$m.'-'.$d;
		$loop = cal_days_in_month(CAL_GREGORIAN , $m , $y);
	    $fromDate = date('Y-m-d', strtotime('2016-06-01')) ;
	    $toDate = date('Y-m-d');
		
		
		//ET-Tube
		$data['ettube'] = $this->Common_model->get_data_by_query("Select i.admit_id,i.admit_uhid from nursef_et_tube e left join ipd_admit i on i.admit_id = e.et_reg where admit_ward = '$ward' and et_out_status = 0 and delete_status = 1 and admit_status in ('CP','NA','OT') and admit_exitdt='0000-00-00 00:00:00' and admit_entrydt between '$fromDate' and '$toDate'");
		$ettube12 = count($data['ettube']);
		
		foreach($data['ettube'] as $ft){
			$ipd_id_ettube =  $ft['admit_id'];
			array_push($code['response'],$ipd_id_ettube);
		}
		$admit_id_ettube= implode(",",$code['response']); 

		
		//Tracheostromy  
		$data['trach'] = $this->Common_model->get_data_by_query("Select i.admit_id,i.admit_uhid from nursef_trach_tube st left join ipd_admit i on i.admit_uhid = st.trach_uhid where trach_ward = '$ward' and trach_out_status = 0 and delete_status = 1 and  admit_status in ('CP','NA','OT') and admit_exitdt='0000-00-00 00:00:00'  and admit_entrydt between '$fromDate' and '$toDate'");
		$trach = count($data['trach']);
		
		foreach($data['trach'] as $ft){
			$ipd_id_trach =  $ft['admit_id'];
			array_push($code1['response'],$ipd_id_trach);
		}
		$admit_id_tra= implode(",",$code1['response']);
		
		//ventilator
		$data['venti'] = $this->Common_model->get_data_by_query("Select i.admit_id,i.admit_uhid from nursf_respi_sys r left join ipd_admit i on i.admit_id = r.respi_ipd where admit_ward = '$ward' and respi_status = 1  and admit_hide = 1 and 	delete_status = 1 and  admit_status in ('CP','NA','OT') and admit_exitdt='0000-00-00 00:00:00' and admit_entrydt between  '$fromDate' and '$toDate'");
		$venti = count($data['venti']);
		
		foreach($data['venti'] as $ft){
			$ipd_id_venti =  $ft['admit_id'];
			array_push($code2['response'],$ipd_id_venti);
		}
		$admit_id_venti= implode(",",$code2['response']);
		
		
		//re-admit in emergengy wards within 48 hrs
		if($ward == 12 || $ward == 18 || $ward == 36 || $ward == 40 || $ward == 41 || $ward == 179 ){
		$ettube = 0;
		$data['ettube'] = $this->Common_model->get_data_by_query("Select et_reg,et_out_dt,et_in_dt from nursef_et_tube e left join ipd_admit i on i.admit_id = e.et_reg where et_ward = '$ward' and et_out_status = 1 and 	delete_status = 1 and  admit_status in ('CP','NA','OT') and admit_exitdt='0000-00-00 00:00:00'  and admit_entrydt between '$fromDate' and '$toDate' ");
		$totalRein=0; 
		
		foreach($data['ettube'] as $et){
				
			$reg =  $et['et_reg'];	
			
			$out_date= $et['et_out_dt'];
			$in_date= $et['et_in_dt'];
			$date_after2days= date("Y-m-d H:i:s", strtotime($out_date . " +48 hours"));
			
			$data['reintube'] = $this->Common_model->get_data_by_query("Select count(*) as ettube from nursef_et_tube e left join ipd_admit i on i.admit_id = e.et_reg where et_reg = '$reg' and et_out_status = 0 and date_format( et_in_dt , '%Y-%m-%d %H:%i' ) > '$out_date' and date_format( et_in_dt , '%Y-%m-%d %H:%i' ) < '$date_after2days' and delete_status = 1 and  admit_status in ('CP','NA','OT') and admit_exitdt='0000-00-00 00:00:00'  and admit_entrydt between '$fromDate' and '$toDate'");
			//echo $this->db->last_query().'</br></br>';
			
			//echo @$ettube = $data['reintube'][0]['ettube'];
			$ettube1 = $ettube + $data['reintube'][0]['ettube'];
			$totalRein=$ettube+$totalRein;

			}
				$ettube1 ;
			}
			else{
				$ettube1="-";
			}
		//centralLine
		$data['cline'] = $this->Common_model->get_data_by_query("Select i.admit_id,i.admit_uhid from nursf_centralline c left join ipd_admit i on i.admit_id = c.centralline_ipd where centralline_ward = '$ward' and centralline_status = 1 and admit_hide = 1 and delete_status = 1  and  admit_status in ('CP','NA','OT') and admit_exitdt='0000-00-00 00:00:00'  and admit_entrydt between '$fromDate' and '$toDate' ");
		$cline = count($data['cline']);
		
		foreach($data['cline'] as $ft){
			$ipd_id_cline =  $ft['admit_id'];
			array_push($code3['response'],$ipd_id_cline);
		}
		$admit_id_cline= implode(",",$code3['response']);

		//Veinflown
		$data['vein'] = $this->Common_model->get_data_by_query("Select i.admit_id,i.admit_uhid from nursef_veinflon v left join ipd_admit i on i.admit_id = v.veinflon_reg where admit_ward = '$ward' and veinflon_out_status = 0 and admit_status in ('CP','NA','OT') and admit_exitdt='0000-00-00 00:00:00' and delete_status = 1 and admit_entrydt between '$fromDate' and '$toDate'");
		$vein = count($data['vein']);
		
		foreach($data['vein'] as $ft){
			$ipd_id_vein =  $ft['admit_id'];
			array_push($code4['response'],$ipd_id_vein);
		}
		$admit_id_Veinflow= implode(",",$code4['response']);

		$data['catheter'] = $this->Common_model->get_data_by_query("Select i.admit_id,i.admit_uhid from nursef_cann_cathe c  left join ipd_admit i on i.admit_id = c.Cann_ipd where admit_ward = '$ward' and Cann_extstatus = 0 and admit_hide = 1 and  delete_status = 1 and admit_status in ('CP','NA','OT') and admit_exitdt='0000-00-00 00:00:00'  and admit_entrydt between '$fromDate' and '$toDate'");
		$catheter = count($data['catheter']);
		
		foreach($data['catheter'] as $ft){
			$ipd_id_catheter =  $ft['admit_id'];
			array_push($code5['response'],$ipd_id_catheter);
		}
		$admit_id_Catheter= implode(",",$code5['response']);
		
		
		//re-intubation within 48 hrs
		$totalIccu=0;
		if($ward == 12 || $ward == 18 || $ward == 36 || $ward == 40 || $ward == 41 || $ward == 179 ){
			$ettube = 0;
			$data['ettube'] = $this->Common_model->get_data_by_query("Select admit_id,admit_entrydt,admit_exitdt from ipd_admit where admit_ward = '$ward' and admit_status = 'DISCHARGED' ");
			
			foreach($data['ettube'] as $et){
				
			$reg =  $et['admit_id'];	
			
			$out_date= $et['admit_exitdt'];
			$in_date= $et['admit_entrydt'];
			$date_after2days= date("Y-m-d H:i:s", strtotime($out_date . " +48 hours"));
			
			
			$data['return'] = $this->Common_model->get_data_by_query("Select count(*) as ettube from ipd_admit where admit_id = '$reg' and admit_status not in ('DISCHARGED') and date_format( admit_entrydt , '%Y-%m-%d %H:%i' ) > '$out_date' and date_format( admit_entrydt , '%Y-%m-%d %H:%i' ) < '$date_after2days' ");
			//echo $this->db->last_query().'</br></br>';
			
			//echo @$ettube = $data['reintube'][0]['ettube'];
			$ettube2 = $ettube + $data['return'][0]['ettube'];
			$totalIccu=$ettube+$totalIccu;

			}
			
			$ettube2 ;
			
			}
			else{
				
				$ettube2 = "-";
			}

			
	        //$ward_name=$ward1["r_id"];
			$data1['chart1_ward'] =$ward;
			$data1['chart1_no_of_bed'] =$beds;
			$data1['chart1_Occupied'] =$occupiedbeds;
			$data1['chart1_intubated'] =$ettube12;
			$data1['chart1_trachestomy'] =$trach;
			$data1['chart1_Ventilator'] =$venti;
			$data1['chart1_Reintubation'] =$ettube1;
			$data1['chart1_Central_line'] =$cline;
			$data1['chart1_Veinflow'] =$vein;
			$data1['chart1_Catheter'] =$catheter;
			$data1['chart1_ICCU/ICU'] =$ettube2;
			$data1['chart1_intubated_ipdid'] =$admit_id_ettube;
			$data1['chart1_trachestomy_ipdid'] =$admit_id_tra;
			$data1['chart1_Ventilator_ipdid'] =$admit_id_venti;
			$data1['chart1_Central_line_ipdid'] =$admit_id_cline;
			$data1['chart1_Veinflow_ipdid'] =$admit_id_Veinflow;
			$data1['chart1_Catheter_ipdid'] =$admit_id_Catheter;
			$data1['chart1_date'] = date('Y-m-d');
			$data1['chart1_entrydt'] =date('Y-m-d H:i:s');
			
			
			$totalcash=$this->Crud_model->getFinal_summary_amt($dt);
			@$voucheramt=$this->Crud_model->get_voucher_amt($dt);
			@$bankamt=$this->Crud_model->get_bank_amt($dt);
			$totalamt=$totalcash-($bankamt+@$voucheramt);
      
	
    if($dt == $chart_date)
    {
   	
    $this->Crud_model->edit_record_by_any_id('nursing_chart1','chart1_id',$icn_m_id,$data1);
   
    }
    else
	{
		
	 $this->Crud_model->insert_record('nursing_chart1',$data1);	  
	
	}
	
	
	
	
	
	}
	// $data45['cashamt_collamt'] =$totalcash; 
	// $data45['cashamt_bankamt'] =$bankamt; 
	// $data45['vaucher_amt'] =$voucheramt; 
	// $data45['final_amt'] =$totalamt; 
	// $data45['cashamt_date'] =$dt; 
	// $this->Crud_model->insert_record('cash_amount_details',$data45);
	}
	
	public function addRecordchartchart4()
		{
		
		
	$fromDate = date('Y-m-d', strtotime('2016-06-01')) ;
	$toDate = date('Y-m-d');
	
	
	$resultwards = $this->Common_model->get_data_by_query("Select r_name,r_id from resource where r_level = 3");
        
	
	 
     // 	$abc = $this->Common_model->get_data_by_query("select chart1_id from nursing_chart1 where chart1_date=$icn_m_date ");
	     //  @$chart_date = $data['abc'][0]['chart1_date'];
	

	foreach($resultwards as $ward1)
	{
	   $ldate =date('Y-m-d');
		 $ward = $ward1['r_id'];
		 $data['abcd'] = $this->Common_model->get_data_by_query("select chart2_id,chart2_date from nursing_chart2 where chart2_ward='$ward' order by chart2_id desc limit 1");
		 @$icn_m_id = $data['abcd'][0]['chart2_id'];
		 // die;
		 @$chart_date = $data['abcd'][0]['chart2_date']; 
		  // die;

		  $ward = $ward1['r_id'];
			// $c_pln =  $this->Common_model->get_data_by_query("Select  count(distinct(nursf_ipd)) as cpln,nursf_entrydt from nursf_notes nn left join ipd_admit ip on ip.admit_id = nn.nursf_ipd where nursf_ward = $ward and care_plan = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate' and admit_status not in ('DISCHARGED','DC')");
			$c_pln =  $this->Common_model->get_data_by_query("Select  count(distinct(nursf_ipd)) as cpln,nursf_entrydt from nursf_notes nn left join ipd_admit ip on ip.admit_id = nn.nursf_ipd where nursf_ward = $ward and care_plan = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate'");
					
			 $care=$c_pln[0]['cpln'];
		$data['iccubeds'] = $this->Common_model->get_data_by_query("Select count(*) as iccubeds from resource where r_under_id = '$ward' and status_resource = 1 ");
		 $iccubeds1 = $data['iccubeds'][0]['iccubeds'];
		$m_err =  $this->Common_model->get_data_by_query("Select count(distinct(nursf_ipd)) as merr from nursf_notes where nursf_ward = $ward and medi_error = 1 and date_format(nursf_entrydt,'%Y-%m-%d')  = '$ldate'");
			$medi= $m_err[0]['merr'];
				 $ch_err =  $this->Common_model->get_data_by_query("Select count(distinct(nursf_ipd)) as ch_err from nursf_notes where nursf_ward = $ward and chart_error = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate'");
		$chart_error= $ch_err[0]['ch_err'];		
		$dr_err =  $this->Common_model->get_data_by_query("Select count(distinct(nursf_ipd)) as dr_err from nursf_notes where nursf_ward = $ward and drug_error = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate'");
				$drug_error= $dr_err[0]['dr_err'];			
$h_risk =  $this->Common_model->get_data_by_query("Select count(distinct(nursf_ipd)) as h_risk from nursf_notes where nursf_ward = $ward and high_risk = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate'");
					$high_medi= $h_risk[0]['h_risk'];	
	$dr_event =  $this->Common_model->get_data_by_query("Select count(distinct(nursf_ipd)) as dr_event from nursf_notes where nursf_ward = $ward and drug_event = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate'");
						$event_medi= $dr_event[0]['dr_event'];
$trans =  $this->Common_model->get_data_by_query("Select count(distinct(nursf_ipd)) as trans from nursf_notes where nursf_ward = $ward and total_tran = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate'");
						$Trasfussion= $trans[0]['trans'];
$err_trans =  $this->Common_model->get_data_by_query("Select count(distinct(nursf_ipd)) as err_trans from nursf_notes where nursf_ward = $ward and tran_react = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate'");
						$Tras_error= $err_trans[0]['err_trans'];						
	$fall =  $this->Common_model->get_data_by_query("Select count(distinct(nursf_ipd)) as fall from nursf_notes where nursf_ward = $ward and bed_on_floor = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate'");
						$noof_falls= $fall[0]['fall'];					
$r_sen =  $this->Common_model->get_data_by_query("Select count(distinct(nursf_ipd)) as r_sen from nursf_notes where nursf_ward = $ward and sen_report = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate'");
						$event_repor= $r_sen[0]['r_sen'];

						
						
						$time_sen =  $this->Common_model->get_data_by_query("Select count(distinct(nursf_ipd)) as time_sen from nursf_notes where nursf_ward = $ward and sen_tim = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate'");
						$frem_time= $time_sen[0]['time_sen'];
						
$rep_miss =  $this->Common_model->get_data_by_query("Select count(distinct(nursf_ipd)) as rep_miss from nursf_notes where nursf_ward = $ward and near_report = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate'");
						 $miss_repor= $rep_miss[0]['rep_miss'];	

$b_exp =  $this->Common_model->get_data_by_query("Select count(distinct(nursf_ipd)) as b_exp from nursf_notes where nursf_ward = $ward and blood_flu = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate'");
							$fluid_exp= $b_exp[0]['b_exp'];	

$b_inj =  $this->Common_model->get_data_by_query("Select count(distinct(nursf_ipd)) as b_inj from nursf_notes where nursf_ward = $ward and blood_injury = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate'");
						$Stick_Injury= $b_inj[0]['b_inj'];	

$b_rep =  $this->Common_model->get_data_by_query("Select count(distinct(nursf_ipd)) as b_rep from nursf_notes where nursf_ward = $ward and blood_report = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate'");
						$chart2_reported= $b_rep[0]['b_rep'];						
			$a_tim =  $this->Common_model->get_data_by_query("Select count(distinct(nursf_ipd))  as a_tim from nursf_notes where nursf_ward = $ward and acci_timing = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate'");
						$chart2_Catheter= $a_tim[0]['a_tim'];
						
		
			
		$result12 = $this->Common_model->get_data_by_query("Select nursf_entrydt,nursf_uhid,nursf_ipd from nursf_notes where nursf_ward = $ward and care_plan = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate' GROUP BY nursf_ipd");
	       $code = array();
	       $code1 = array();
	       $code2 = array();
	       $code3 = array();
	       $code4 = array();
	       $code5 = array();
	       $code6 = array();
	       $code7 = array();
	       $code8 = array();
	       $code9 = array();
	       $code10 = array();
	       $code11 = array();
	       $code12 = array();
	       $code13 = array();
	       $code14 = array();
	       $code15 = array();
		     $code['response']=array();
		     $code1['response']=array();
		     $code2['response']=array();
		     $code3['response']=array();
		     $code4['response']=array();
		     $code5['response']=array();
		     $code6['response']=array();
		     $code7['response']=array();
		     $code8['response']=array();
		     $code9['response']=array();
		     $code10['response']=array();
		     $code11['response']=array();
		     $code12['response']=array();
		     $code13['response']=array();
		     $code14['response']=array();
		     $code15['response']=array();
		     
			 foreach($result12 as $ft)
			 {
				$ipd_id5 =  $ft['nursf_ipd'];	
			   array_push($code['response'],$ipd_id5);			
			 }
			$admit_id_care = implode(",",$code['response']);
			
			$result12 = $this->Common_model->get_data_by_query("Select nursf_entrydt,nursf_uhid,nursf_ipd from nursf_notes where nursf_ward = $ward and medi_error = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate' GROUP BY nursf_ipd");
				
			 foreach($result12 as $ft){
			$ipd_id6 =  $ft['nursf_ipd'];	
           array_push($code1['response'],$ipd_id6);			
			 }
			$admit_id_medi= implode(",",$code1['response']);

			$result12 = $this->Common_model->get_data_by_query("Select nursf_entrydt,nursf_uhid,nursf_ipd from nursf_notes where nursf_ward = $ward and chart_error = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate' GROUP BY nursf_ipd");
				
			 foreach($result12 as $ft){
			$ipd_id7 =  $ft['nursf_ipd'];	
           array_push($code2['response'],$ipd_id7);			
			 }
			$admit_id_chart= implode(",",$code2['response']);
		$result12 = $this->Common_model->get_data_by_query("Select nursf_entrydt,nursf_uhid,nursf_ipd from nursf_notes where nursf_ward = $ward and drug_error = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate' GROUP BY nursf_ipd");
				
			 foreach($result12 as $ft){
			$ipd_id8 =  $ft['nursf_ipd'];	
           array_push($code3['response'],$ipd_id8);			
			 }
			$admit_id_drug= implode(",",$code3['response']);
		$result12 = $this->Common_model->get_data_by_query("Select nursf_entrydt,nursf_uhid,nursf_ipd from nursf_notes where nursf_ward = $ward and high_risk = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate' GROUP BY nursf_ipd");
				
			 foreach($result12 as $ft){
			$ipd_id9 =  $ft['nursf_ipd'];	
           array_push($code4['response'],$ipd_id9);			
			 }
			$admit_id_risk= implode(",",$code4['response']);
			
			$result12 = $this->Common_model->get_data_by_query("Select nursf_entrydt,nursf_uhid,nursf_ipd from nursf_notes where nursf_ward = $ward and drug_event = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate' GROUP BY nursf_ipd");
				
			 foreach($result12 as $ft){
			$ipd_id10 =  $ft['nursf_ipd'];	
           array_push($code5['response'],$ipd_id10);			
			 }
			$admit_id_event= implode(",",$code5['response']);
			$result12 = $this->Common_model->get_data_by_query("Select nursf_entrydt,nursf_uhid,nursf_ipd from nursf_notes where nursf_ward = $ward and total_tran = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate' GROUP BY nursf_ipd");
				
			 foreach($result12 as $ft){
			$ipd_id11 =  $ft['nursf_ipd'];	
           array_push($code6['response'],$ipd_id11);			
			 }
			$admit_id_tran= implode(",",$code6['response']);
			$result12 = $this->Common_model->get_data_by_query("Select nursf_entrydt,nursf_uhid,nursf_ipd from nursf_notes where nursf_ward = $ward and tran_react = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate' GROUP BY nursf_ipd");
				
			 foreach($result12 as $ft){
			$ipd_id12 =  $ft['nursf_ipd'];	
           array_push($code7['response'],$ipd_id12);			
			 }
			$admit_id_react= implode(",",$code7['response']);
		$result12 = $this->Common_model->get_data_by_query("Select nursf_entrydt,nursf_uhid,nursf_ipd from nursf_notes where nursf_ward = $ward and bed_on_floor = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate' GROUP BY nursf_ipd");
				
			 foreach($result12 as $ft){
			$ipd_id13 =  $ft['nursf_ipd'];	
           array_push($code8['response'],$ipd_id13);			
			 }
			$admit_id_floor= implode(",",$code8['response']);
		
		$result12 = $this->Common_model->get_data_by_query("Select nursf_entrydt,nursf_uhid,nursf_ipd from nursf_notes where nursf_ward = $ward and sen_report = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate' GROUP BY nursf_ipd");
				
			 foreach($result12 as $ft){
			$ipd_id14 =  $ft['nursf_ipd'];	
           array_push($code9['response'],$ipd_id14);			
			 }
			$admit_id_report= implode(",",$code9['response']);
			$result12 = $this->Common_model->get_data_by_query("Select nursf_entrydt,nursf_uhid,nursf_ipd from nursf_notes where nursf_ward = $ward and sen_tim = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate' GROUP BY nursf_ipd");
				
			 foreach($result12 as $ft){
			$ipd_id15 =  $ft['nursf_ipd'];	
           array_push($code10['response'],$ipd_id15);			
			 }
			$admit_id_tim= implode(",",$code10['response']);
		$result12 = $this->Common_model->get_data_by_query("Select nursf_entrydt,nursf_uhid,nursf_ipd from nursf_notes where nursf_ward = $ward and near_report = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate' GROUP BY nursf_ipd");
				
			 foreach($result12 as $ft){
			$ipd_id16 =  $ft['nursf_ipd'];	
           array_push($code11['response'],$ipd_id16);			
			 }
			$admit_id_nreport= implode(",",$code11['response']);
				$result12 = $this->Common_model->get_data_by_query("Select nursf_entrydt,nursf_uhid,nursf_ipd from nursf_notes where nursf_ward = $ward and blood_flu = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate' GROUP BY nursf_ipd");
				
			 foreach($result12 as $ft){
			$ipd_id17 =  $ft['nursf_ipd'];	
           array_push($code12['response'],$ipd_id17);			
			 }
			$admit_id_flut= implode(",",$code12['response']);
				$result12 = $this->Common_model->get_data_by_query("Select nursf_entrydt,nursf_uhid,nursf_ipd from nursf_notes where nursf_ward = $ward and blood_injury = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate' GROUP BY nursf_ipd");
				
			 foreach($result12 as $ft){
			$ipd_id18 =  $ft['nursf_ipd'];	
           array_push($code13['response'],$ipd_id18);			
			 }
			$admit_id_injury= implode(",",$code13['response']);
		$result12 = $this->Common_model->get_data_by_query("Select nursf_entrydt,nursf_uhid,nursf_ipd from nursf_notes where nursf_ward = $ward and blood_report = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate' GROUP BY nursf_ipd");
				
			 foreach($result12 as $ft){
			$ipd_id19 =  $ft['nursf_ipd'];	
           array_push($code14['response'],$ipd_id19);			
			 }
			$admit_id_breport= implode(",",$code14['response']);
$result12 = $this->Common_model->get_data_by_query("Select nursf_entrydt,nursf_uhid,nursf_ipd from nursf_notes where nursf_ward = $ward and acci_timing = 1 and date_format(nursf_entrydt,'%Y-%m-%d') = '$ldate' GROUP BY nursf_ipd");
				
			 foreach($result12 as $ft){
			$ipd_id20 =  $ft['nursf_ipd'];	
           array_push($code15['response'],$ipd_id20);			
			 }
			$admit_id_timing= implode(",",$code15['response']);
				
				
				// print_r($admit_id_care);
				// die;
				$dat['chart2_ward'] = $ward;
				$dat['chart2_careplan'] =$care;
				$dat['chart2_noipd'] =$iccubeds1;
				$dat['chart2_medi_error'] =$medi;
				$dat['chart2_chart_error'] =$chart_error;
				$dat['chart2_drug_error'] =$drug_error;
				$dat['chart2_high_medi'] =$high_medi;
				$dat['chart2_event_medi'] =$event_medi;
				$dat['chart2_Trasfussion'] =$Trasfussion;
				$dat['chart2_Tras_error'] =$Tras_error;
				$dat['chart2_noof_falls'] =$noof_falls;
				$dat['chart2_frem_time'] =$frem_time;
				$dat['chart2_fluid_exp'] =$fluid_exp;
				$dat['chart2_Stick_Injury'] =$Stick_Injury;
				$dat['chart2_reported'] =$chart2_reported;
				$dat['chart2_Catheter'] =$chart2_Catheter;
				$dat['chart2_date'] = date('Y-m-d');
				$dat['chart2_entrydt'] =date('Y-m-d H:i:s');
				$dat['chart2_careplan_ipd'] = $admit_id_care;
				$dat['chart2_medi_error_ipd'] = $admit_id_medi;
				$dat['chart2_chart_error_ipd'] = $admit_id_chart;
				$dat['chart2_drug_error_ipd'] = $admit_id_drug;
				$dat['chart2_high_medi_ipd'] = $admit_id_risk;
				$dat['chart2_event_medi_ipd'] = $admit_id_event;
				$dat['chart2_Trasfussion_ipd'] = $admit_id_tran;
				$dat['chart2_Tras_error_ipd'] = $admit_id_react;
				$dat['chart2_noof_falls_ipd'] = $admit_id_floor;
				$dat['chart2_event_report_ipd'] = $admit_id_report;
				$dat['chart2_frem_time_ipd'] = $admit_id_tim;
				$dat['chart2_miss_report_ipd'] = $admit_id_flut;
				$dat['chart2_fluid_exp_ipd'] = $admit_id_injury;
				$dat['chart2_Stick_Injury_ipd'] = $admit_id_breport;
				$dat['chart2_reported_ipd'] = $admit_id_timing;
				
	// print_r($data1);
      
	$dt = date('Y-m-d');
 if($dt == $chart_date)
 {
	 
	$this->Crud_model->edit_record_by_any_id('nursing_chart2','chart2_id',$icn_m_id,$dat);
	
  }
    else{
		
	// echo 'fffffffffffff';
	 $this->Crud_model->insert_record('nursing_chart2',$dat);	  
		// echo $this->db->last_query();

		
	}

	
	}
	//die;
 	 
	//}
	//die;
	}	
	
	
		public function icnNMCMonthWise_new()
		{
	$uhid ="";
	// $loop=0;
	// $m= date('m');
	// $y= date('Y');
	// $loop = cal_days_in_month(CAL_GREGORIAN , $m , $y);
	// $date = date('Y-m-d');
	$emp=$this->Common_model->get_data_by_query("select * from employee where emp_dep=10");
	
	$checkentry=$this->Common_model->get_data_by_query("select nmc_id,nmc_date from nursing_nmc_mreport order by nmc_id desc limit 1");
	
	@$nmc_date= $checkentry[0]['nmc_date'];
	@$nmc_id= $checkentry[0]['nmc_id'];
	
	
				$code1['response']=array();
				$code2['response']=array();
				$code3['response']=array();
				$code4['response']=array();
				$code5['response']=array();
				$code6['response']=array();
				$code7['response']=array();
				$code8['response']=array();
				$code9['response']=array();
				$dt1['uid']=array();
				$dt2['uid']=array();
				$dt3['uid']=array();
				$dt4['uid']=array();
				$dt5['uid']=array();
				$dt6['uid']=array();
				$dt7['uid']=array();
				$dt8['uid']=array();
				$dt9['uid']=array();

				$currentdate=date('Y-m-d');
				$date=date('d-m-Y');
				
				
					//$date= sprintf('%002s',$r).'-'.date('m-Y');
					$c_pln =  $this->Common_model->get_data_by_query("Select count(*) as cpln from nursf_notes where care_plan = 1 and date_format(nursf_entrydt,'%d-%m-%Y') = '$date'");
					// print_r($c_pln);
					// die;
					$care_plan_month= $c_pln[0]['cpln'];
					
                    $m_err =  $this->Common_model->get_data_by_query("Select count(*) as merr from nursf_notes where medi_error = 1 and date_format(nursf_entrydt,'%d-%m-%Y') = '$date'");
					
					$medi_error= $m_err[0]['merr'];
					
					$dr_err =  $this->Common_model->get_data_by_query("Select count(*) as dr_err from nursf_notes where drug_error = 1 and date_format(nursf_entrydt,'%d-%m-%Y') = '$date'");
					
					$drug_error=$dr_err[0]['dr_err'];
					
					$ch_err =  $this->Common_model->get_data_by_query("Select count(*) as ch_err from nursf_notes where chart_error = 1 and date_format(nursf_entrydt,'%d-%m-%Y') = '$date'");
					
					$chart_error= $ch_err[0]['ch_err'];
					
					$h_risk =  $this->Common_model->get_data_by_query("Select count(*) as h_risk from nursf_notes where high_risk = 1 and date_format(nursf_entrydt,'%d-%m-%Y') = '$date'");
					
					$high_risk= $h_risk[0]['h_risk'];	
					
					$err_trans =  $this->Common_model->get_data_by_query("Select count(*) as err_trans from nursf_notes where tran_react = 1 and date_format(nursf_entrydt,'%d-%m-%Y') = '$date'");
					
					$tran_reac= $err_trans[0]['err_trans'];	
					
					$fall =  $this->Common_model->get_data_by_query("Select count(*) as fall from nursf_notes where bed_on_floor = 1 and date_format(nursf_entrydt,'%d-%m-%Y') = '$date'");
					
					$bed_floor= $fall[0]['fall'];
					
					$trans =  $this->Common_model->get_data_by_query("Select count(*) as trans from nursf_notes where total_tran = 1 and date_format(nursf_entrydt,'%d-%m-%Y') = '$date'");
					
					$total_tran= $trans[0]['trans'];
					
					$rep_miss =  $this->Common_model->get_data_by_query("Select count(*) as rep_miss from nursf_notes where near_report = 1 and date_format(nursf_entrydt,'%d-%m-%Y') = '$date'");
					
					$near_report= $rep_miss[0]['rep_miss'];
					
				    $c_pln_uhid =  $this->Common_model->get_data_by_query("Select nursf_ipd from nursf_notes where care_plan = 1 and date_format(nursf_entrydt,'%d-%m-%Y') = '$date'");
				
				 
				    foreach($c_pln_uhid as $cp){
			        $cpln_uhid = $cp['nursf_ipd'];		
					array_push($dt1['uid'],$cpln_uhid);	 
				    }
					
					
					$m_err_uhid =  $this->Common_model->get_data_by_query("Select nursf_ipd from nursf_notes where medi_error = 1 and date_format(nursf_entrydt,'%d-%m-%Y') = '$date'");
						
				    foreach($m_err_uhid as $mr){
					$merr_uhid= $mr['nursf_ipd'];
                    array_push($dt2['uid'],$merr_uhid);	  
				    }	
					
					
					$drug_uhid =  $this->Common_model->get_data_by_query("Select nursf_ipd from nursf_notes where drug_error = 1 and date_format(nursf_entrydt,'%d-%m-%Y') = '$date'");
					
					foreach($drug_uhid as $du){
					$derr_uhid=$du['nursf_ipd'];
					array_push($dt3['uid'],$derr_uhid);					
					}
					
					$ch_err_uhid =  $this->Common_model->get_data_by_query("Select nursf_ipd from nursf_notes where chart_error = 1 and date_format(nursf_entrydt,'%d-%m-%Y') = '$date'");
					
					foreach($ch_err_uhid as $cr){
					$c_err_uhid= $cr['nursf_ipd'];
					array_push($dt4['uid'],$c_err_uhid);
					}
					
					$h_risk_uhid =  $this->Common_model->get_data_by_query("Select nursf_ipd from nursf_notes where high_risk = 1 and date_format(nursf_entrydt,'%d-%m-%Y') = '$date'");
				
					foreach($h_risk_uhid as $hr){
					$risk_uhid= $hr['nursf_ipd'];
					array_push($dt5['uid'],$risk_uhid);	
					}
					
					$tran_err_uhid =  $this->Common_model->get_data_by_query("Select nursf_ipd from nursf_notes where tran_react = 1 and date_format(nursf_entrydt,'%d-%m-%Y') = '$date'");
					
					foreach($tran_err_uhid as $tr){
					$tran_uhid= $tr['nursf_ipd'];
					array_push($dt6['uid'],$tran_uhid);	
					}
					
					$fall_uhid =  $this->Common_model->get_data_by_query("Select nursf_ipd from nursf_notes where bed_on_floor = 1 and date_format(nursf_entrydt,'%d-%m-%Y') = '$date'");
					
					foreach($fall_uhid as $fl){
					$fl_uhid= $fl['nursf_ipd'];
					array_push($dt7['uid'],$fl_uhid);	
					}
					
					$trans_uhid =  $this->Common_model->get_data_by_query("Select nursf_ipd from nursf_notes where total_tran = 1 and date_format(nursf_entrydt,'%d-%m-%Y') = '$date'");
					
					foreach($trans_uhid as $fr){
					$tt_uhid= $fr['nursf_ipd'];
					array_push($dt8['uid'],$tt_uhid);	
					}
					
					$rep_uhid =  $this->Common_model->get_data_by_query("Select nursf_ipd from nursf_notes where near_report = 1 and date_format(nursf_entrydt,'%d-%m-%Y') = '$date'");
					
					foreach($rep_uhid as $ri){
					$near_uhid= $ri['nursf_ipd'];
					array_push($dt9['uid'],$near_uhid);	
					}
					
					
					
					
					$uid1= implode(",",$dt1['uid']);
					$uid2= implode(",",$dt2['uid']);
					$uid3= implode(",",$dt3['uid']);
					$uid4= implode(",",$dt4['uid']);
					$uid5= implode(",",$dt5['uid']);
					$uid6= implode(",",$dt6['uid']);
					$uid7= implode(",",$dt7['uid']);
					$uid8= implode(",",$dt8['uid']);
					$uid9= implode(",",$dt9['uid']);
					
					
					$data['nmc_outcomes']=$care_plan_month;
					$data['nmc_medi_error']=$medi_error;
					$data['nmc_drug_reaction']=$drug_error;
					$data['nmc_medi_chart']=$chart_error;
					$data['nmc_high_risk_medi']=$high_risk;
					$data['nmc_trans_reaction']=$tran_reac;
					$data['nmc_re_intubat']=$bed_floor;
					$data['nmc_falls']=$total_tran;
					$data['nmc_miss_report']=$near_report;
					
					$data['nmc_entrydt']=date('Y-m-d H:i:s');
					$data['nmc_date']=date('Y-m-d');
					$data['outcomes_uhid'] = $uid1;
					$data['medi_err_uhid'] = $uid2;
					$data['drug_reac_uhid'] = $uid3;
					$data['med_chart_uhid'] = $uid4;
				    $data['high_risk_uhid'] = $uid5;
					$data['trans_reac_uhid'] = $uid6;
					$data['re_intubt_uhid'] = $uid7;
					$data['fall_uhid'] = $uid8;
					$data['miss_report_uhid'] = $uid9;
					
				    $checkdata =  $this->Common_model->get_data_by_query("select nmc_id from nursing_nmc_mreport where  date_format(nmc_entrydt,'%d-%m-%Y') = '$date'");	
					
					if(count($checkdata)!="")
					{
					//echo "updated";
                    $nmcid= $checkdata[0]['nmc_id'];		
                                                     
                    $this->Crud_model->edit_record_by_any_id('nursing_nmc_mreport','nmc_id',$nmcid,$data);                					
						
					}
					else
					{
					//echo "inserted";
                     $this->Crud_model->insert_record('nursing_nmc_mreport',$data);						
						
					}
				
	     
	
	}

	public function submit_inPatient()
		{
		$ipd_ward = "";
		$data['inPatient'] = $this->Common_model->get_data_by_query("select * from ipd_admit a left join patient p on a.admit_uhid = p.id join casualty c on a.admit_id=c.casu_id where a.admit_status in ('CP','NA','OT')  and admit_hide = 1 GROUP BY a.admit_id ");
		
		foreach($data['inPatient'] as $inp){
			
		
			$ipd_ward = $ipd_ward.$inp['admit_id']."-".$inp['admit_ward'].",";
			
		}
		
		$data1['inpatient_ipds_ward'] = $ipd_ward;
		$data1['inpatient_days'] = count($data['inPatient']);
		$data1['inpatient_entrydt'] = date("Y-m-d H:i:s");
		
		echo $ipd_ward;
		
		$this->Crud_model->insert_record('inpatient',$data1);
		}
		
	
	
	public function addRecordICN()
	{
		
		
	$fromDate = date('Y-m-d', strtotime('2016-06-01')) ;
	$toDate = date('Y-m-d');
	
      //$cathc = $this->Common_model->get_data_by_query("SELECT count(Cann_catheter_outside) as  outcath FROM  `nursef_cann_cathe` ns left join ipd_admit i on i.admit_uhid = ns.Cann_uhid WHERE Cann_extstatus =0 and  delete_status = 1 and admit_status in ('CP','NA','OT') and admit_exitdt='0000-00-00 00:00:00' and admit_entrydt between '$fromDate' and '$toDate' group by Cann_catheter_outside ");
	  
	  
      $cathc = $this->Common_model->get_data_by_query("SELECT count(Cann_catheter_outside) as  outcath FROM  `nursef_cann_cathe` ns left join ipd_admit i on i.admit_uhid = ns.Cann_uhid WHERE Cann_extstatus =0 and  delete_status = 1 and admit_status in ('CP','NA','OT') and date_format(`admit_entrydt`,'%Y-%m-%d') between '$fromDate' and '$toDate' group by Cann_catheter_outside ");
	  
	  
	  $cathc2 = $this->Common_model->get_data_by_query("SELECT Cann_ipd FROM  `nursef_cann_cathe` ns left join ipd_admit i on i.admit_uhid = ns.Cann_uhid WHERE Cann_extstatus =0 and  delete_status = 1 and admit_status in ('CP','NA','OT') and admit_exitdt='0000-00-00 00:00:00' and date_format(`admit_entrydt`,'%Y-%m-%d') between '$fromDate' and '$toDate' and Cann_catheter_outside ='No'");
	  
	  
	  $cathc_out = $this->Common_model->get_data_by_query("SELECT Cann_ipd FROM  `nursef_cann_cathe` ns left join ipd_admit i on i.admit_uhid = ns.Cann_uhid WHERE Cann_extstatus =0 and  delete_status = 1 and admit_status in ('CP','NA','OT') and admit_exitdt='0000-00-00 00:00:00' and date_format(`admit_entrydt`,'%Y-%m-%d') between '$fromDate' and '$toDate' and Cann_catheter_outside ='Yes'");
	 
	  
	  $cathcount = $cathc[0]['outcath'];
	  $cathcountoutside = $cathc[1]['outcath'];
	  
	$ryls = $this->Common_model->get_data_by_query("SELECT ryles_reg,ryles_out_status FROM  `nursef_ryles_tube` rs left join ipd_admit i on rs.ryles_uhid = i.admit_uhid WHERE ryles_out_status = 0 and delete_status = 1 and admit_status in ('CP','NA','OT') and admit_exitdt='0000-00-00 00:00:00'  and admit_entrydt between '$fromDate' and '$toDate'");
	  
	  
	  $ryls1 = count($ryls);
	 
	  
	$drain = $this->Common_model->get_data_by_query("SELECT drain_reg,delete_status from nursef_drain_tube dt left join ipd_admit i on i.admit_uhid = dt.drain_uhid where drain_out_status = 0 and 	delete_status = 1  and  admit_status in ('CP','NA','OT') and admit_exitdt='0000-00-00 00:00:00'  and admit_entrydt between '$fromDate' and '$toDate' ");
	  
	  $drain1 = count($drain);	
	  
	$et = $this->Common_model->get_data_by_query("SELECT et_reg,et_out_status from nursef_et_tube et left join ipd_admit i on i.admit_uhid = et.et_uhid where et_out_status = 0 and  delete_status = 1 and  admit_status in ('CP','NA','OT') and admit_exitdt='0000-00-00 00:00:00'  and admit_entrydt between '$fromDate' and '$toDate'");
	  
	  $et1 = count($et);	
	  
	$fortech = $this->Common_model->get_data_by_query("SELECT trach_reg,delete_status from nursef_trach_tube st left join ipd_admit i on i.admit_uhid = st.trach_uhid where trach_out_status = 0 and 	delete_status = 1 and  admit_status in ('CP','NA','OT') and admit_exitdt='0000-00-00 00:00:00'  and admit_entrydt between '$fromDate' and '$toDate'");
	  
	  $fortech1 = count($fortech);	
	  
	$centerline = $this->Common_model->get_data_by_query("SELECT delete_status as total_center,admit_id from nursf_centralline cl left join ipd_admit i on i.admit_uhid =cl.centralline_uhid where centralline_status = 1 and delete_status = 1  and  admit_status in ('CP','NA','OT') and admit_exitdt='0000-00-00 00:00:00'  and admit_entrydt between '$fromDate' and '$toDate' group by centralline_uhid ");
	  
	 $centerline12 = $this->Common_model->get_data_by_query("SELECT delete_status from nursf_centralline cl left join ipd_admit i on i.admit_uhid =cl.centralline_uhid where centralline_status = 1 and delete_status = 1  and  admit_status in ('CP','NA','OT') and admit_exitdt='0000-00-00 00:00:00'  and admit_entrydt between '$fromDate' and '$toDate' group by centralline_uhid ");
	  
	  $centerline1 = count($centerline12);	
	$veinc = $this->Common_model->get_data_by_query("SELECT ns.veinflon_out_status,ns.veinflon_reg from nursef_veinflon ns left join ipd_admit i on i.admit_uhid = ns.veinflon_uhid where veinflon_out_status = 0 and 	delete_status = 1 and admit_status in ('CP','NA','OT') and admit_exitdt='0000-00-00 00:00:00'  and admit_entrydt between '$fromDate' and '$toDate'");
	  
	  $veinc1 = count($veinc);	
	//print_r($cathc2);
	$ventic = $this->Common_model->get_data_by_query("SELECT respi_ipd,delete_status from nursf_respi_sys rs left join ipd_admit i on i.admit_uhid = rs.respi_uhid where  respi_status = 1 and 	delete_status = 1 and admit_status in ('CP','NA','OT')   and admit_status in ('CP','NA','OT') and admit_exitdt='0000-00-00 00:00:00'  and admit_entrydt between  '$fromDate' and '$toDate'");
	$ventic1 = count($ventic);	
	//print_r($cathc2);
	
	$dt1['id']=array();
	$dt2['id']=array();
	$dt3['id']=array();
	$dt4['id']=array();
	$dt5['id']=array();
	$dt6['id']=array();
	$dt7['id']=array();
	$dt8['id']=array();
	$dt9['id']=array();
	
	foreach($cathc2 as $ct)
	{
		$cathipd = $ct['Cann_ipd'];		
		array_push($dt1['id'],$cathipd);
		
	}
	foreach($ryls as $rl)
	{
		$rlipd = $rl['ryles_reg'];		
		array_push($dt2['id'],$rlipd);
		
	}
	foreach($drain as $dr)
	{
		$dripd = $dr['drain_reg'];		
		array_push($dt3['id'],$dripd);
		
	}
	foreach($et as $ett)
	{
		$etipd = $ett['et_reg'];		
		array_push($dt4['id'],$etipd);
		
	}
	foreach($fortech as $ett)
	{
		$etipd = $ett['trach_reg'];		
		array_push($dt5['id'],$etipd);
		
	}
	foreach($centerline as $ett)
	{
		$etipd = $ett['admit_id'];		
		$total_center = $ett['total_center'];		
				
		array_push($dt6['id'],$etipd);
	
	  
	}
	foreach($veinc as $ett)
	{
		$etipd = $ett['veinflon_reg'];		
		array_push($dt7['id'],$etipd);
		
	}
	foreach($ventic as $ett)
	{
		$etipd = $ett['respi_ipd'];		
		array_push($dt8['id'],$etipd);
		
	}
	foreach($cathc_out as $ett)
	{
		$etipd = $ett['Cann_ipd'];		
		array_push($dt9['id'],$etipd);
		
	}

	
	
	
	                $id_cath= implode(",",$dt1['id']);
					$id_ryl= implode(",",$dt2['id']);
					$id_drn= implode(",",$dt3['id']);
					$id_et= implode(",",$dt4['id']);
					$id_trch= implode(",",$dt5['id']);
					$id_cl= implode(",",$dt6['id']);
					$id_vein= implode(",",$dt7['id']);
					$id_venti= implode(",",$dt8['id']);
					$id_cathout= implode(",",$dt9['id']);
	
	
	$resultwards = $this->Common_model->get_data_by_query("Select r_name,r_id from resource where r_level = 3");
	$str = '';
	foreach($resultwards as $ward1)
	{
		$ward = $ward1['r_id'];
		$des = $this->Common_model->get_data_by_query("Select count(*) as iccubeds from resource where r_under_id = '$ward' and status_resource = 1 ");
		$pts = $des['0']['iccubeds'];
		$str .= $ward.','.$des['0']['iccubeds'].'#';
	}
	
	
	$data['icn_m_ward_pt'] =substr_replace($str, "", -1);//$str;
	$data['icn_m_catheter'] =$cathcount;
	$data['icn_m_catheter_out'] =$cathcountoutside;
	$data['icn_m_ryles'] =$ryls1;
	$data['icn_m_veinflown'] =$veinc1;
	$data['icn_m_ventilator'] =$ventic1;
	$data['icn_m_ettube'] =$et1;
	$data['icn_m_centralline'] =$centerline1;
	$data['icn_m_drain'] =$drain1;
	$data['icn_m_trachaeostomy'] =$fortech1;
	$icn_m_date =date('Y-m-d');
	$data['icn_m_date'] =date('Y-m-d');
	$data['icn_m_date_time'] =date('Y-m-d H:i:sa');
	
    $data['icn_cath_ipd'] =$id_cath;
	$data['icn_ryls_ipd'] =$id_ryl;
	$data['icn_vein_ipd'] =$id_vein;
	$data['icn_venti_ipd'] =$id_venti;
	$data['icn_et_ipd'] =$id_et;
	$data['icn_cl_ipd'] =$id_cl;
	$data['icn_drain_ipd'] =$id_drn;
	$data['icn_trach_ipd'] =$id_trch;
	$data['icn_out_cath_ipd'] =$id_cathout;
	$datedata = $this->Common_model->get_data_by_query("select * from icn_master_chart where icn_m_date='$icn_m_date'");
	
 	 
	  if($datedata==null)
	  {
		   $this->Crud_model->insert_record('icn_master_chart',$data);
	  }
	  else
	  {
		  $icn_m_id=$datedata[0]['icn_m_id'] ;
		   
		  $this->Crud_model->edit_record_by_anyid('icn_master_chart',$icn_m_id,$data,'icn_m_id');
	  }
	 
	}
	
	
	
	
	
		}
			


	?>
