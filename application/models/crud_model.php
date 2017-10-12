<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Crud_model extends CI_Model 
	{
        
		function __construct()
        {
            parent::__construct();
        }
		
        public function insert_record($tbl,$data)
		{
            if($this->db->insert($tbl,$data))
			{
				return TRUE;
			} else {
				return FALSE;
			}	
        }
		
		
		
		
		public function FillDynamicCombo($query,$datafield,$textfield,$selectvalue)  {
	  
		$i=1;
		$query = $this->db->query($query);
		
		$selectvalue1="";

		
		foreach($query as $row){
		  if($i==1)
		  $selectvalue1=$row['$datafield'];
		  
		  if($selectvalue==$row['$datafield']){
			  
			  echo'<option value="'.$row['$datafield'].'" selected>'.$row['$textfield'].'</option>';
			  $selectvalue1=$selectvalue;
			
			}
		  else {
			
			echo'<option value="'.$row['$datafield'].'">'.$row['$textfield'].'</option>';
		   
		   }
		   $i++;
		   }
		//}
		   return $selectvalue1;
	}
		
        public function edit_record($tbl,$id,$data)
		{
            $this->db->where('id',$id);
            if($this->db->update($tbl,$data))
			{ 
				return true;
            } else {
				return false;	
            }
        }
		
		function countrow($qry)
		{
			$query = $this->db->query($qry);
			$rowcount = $query->num_rows();
			return $rowcount;
		}
		
		
		public function edit_record_resource($tbl,$id,$data)
		{
            $this->db->where('r_id',$id);
            if($this->db->update($tbl,$data))
			{ 
				return true;
            } else {
				return false;	
            }
        }
		
		public function edit_record_by_uhid($tbl,$id,$data)
		{
            $this->db->where('uhid',$id);
            if($this->db->update($tbl,$data))
			{ 
				return true;
            } else {
				return false;	
            }
        }
		
		
		public function edit_record_by_any_three_field($tablename,$firstid,$secondid,$thirdid,$dataarray,$attribute1,$attribute2,$attribute3)
		{
            $this->db->where($firstid,$attribute1);
            $this->db->where($secondid,$attribute2);
			 $this->db->where($thirdid,$attribute3);
            if($this->db->update($tablename,$dataarray))
			{ 
				return true;
            } else {
				return false;	
            }
        }
		
		public function edit_record_by_any_two_field($tablename,$firstid,$secondid,$dataarray,$attribute1,$attribute2)
		{
            $this->db->where($firstid,$attribute1);
            $this->db->where($secondid,$attribute2);
            if($this->db->update($tablename,$dataarray))
			{ 
				return true;
            } else {
				return false;	
            }
        }
		

		
				
		public function edit_record_by_anyid($tbl,$id,$data,$where)
		{
            $this->db->where($where,$id);
            if($this->db->update($tbl,$data))
			{ 
				return true;
            } else {
				return false;	
            }
        }
				
		public function append_record_by_anyid($tbl,$id,$data,$field,$where)
		{
			$qry = "update $tbl set $field = CONCAT( $field,', $data') where $where = $id";
			
			$this->db->query($qry);
			return $this->db->last_query();
            // if($this->db->update($tbl,$data))
			// { 
				// return true;
            // } else {
				// return false;	
            // }
        }
		
		public function append_record_by_anytwoid($tbl,$id1,$id2,$data,$field,$where1,$where2)
		{
			$qry = "update $tbl set $field = CONCAT( $field,', $data') where $where1 = $id1 and  $where2 = $id2";
			
			$this->db->query($qry);
			return $this->db->last_query();
           
        }
		
		public function Basepackage($empid)
		{
			$query = $this->db->query("select emppac_packid from hr_emppackage 
			WHERE emppac_emp_id='$empid' order by emppac_id desc limit 1  ");
			// echo $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['emppac_packid'];
			} else {
			}
		}
		
		
		public function Basepackagesecondlast($empid)
		{
			$query = $this->db->query("SELECT emppac_packid FROM `hr_emppackage` WHERE emppac_emp_id='$empid' ORDER BY `emppac_id` DESC LIMIT 1,1 ");
			// echo $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['emppac_packid'];
			} else {
			}
		}
		
		
		
		
		public function BasepackageEfftiveDT($empid)
		{
			$query = $this->db->query("select emppac_entrydt from hr_emppackage 
			WHERE emppac_emp_id='$empid' order by emppac_id desc limit 1  ");
			// echo $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['emppac_entrydt'];
			} else {
			}
		}
		
		
		
		
		public function TotalAdvanceAmount($empid)
		{
			$query = $this->db->query("SELECT sum(adv_approved) as toadv  FROM hr_adv WHERE 

adv_status=1 and adv_empid=".$empid."");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['toadv'];
			} 
		}
		
		
		public function EmpWoff($empid)
		{
			$query = $this->db->query("SELECT emp_leave  FROM employee WHERE emp_status=1 and emp_id=".$empid."");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['emp_leave'];
			} 
		}

	public function TotalApproveAdvance($month,$year)
		{
			$query = $this->db->query("select sum(adv_req_amt) as totapp from hr_adv where 	date_format(adv_date,'%Y')='".$year."' and 
			date_format(adv_date,'%m')='".$month."'	and adv_approved_status=1 ");
			// echo $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['totapp'];
			} else {
			}
		}
		
		public function TotalPendingAdvance($month,$year)
		{
			$query = $this->db->query("select sum(adv_req_amt) as totpen from hr_adv where 	date_format(adv_date,'%Y')='".$year."' and 
			date_format(adv_date,'%m')='".$month."'	and adv_approved_status=0 ");
			// echo $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['totpen'];
			} else {
			}
		}
		
		public function TotalApproveIncrement($month,$year)
		{
			$query = $this->db->query("select count(incr_chair_amt) as totincr from hr_increment where date_format(incr_chair_entrydt,'%Y')='".$year."' and 
			date_format(incr_chair_entrydt,'%m')='".$month."' and incr_chair_per>0 ");
			// echo $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['totincr'];
			} else {
			}
		}
		
		public function TotalPendingIncrement($month,$year)
		{
			$query = $this->db->query("select count(incr_chair_amt) as totincr from hr_increment where date_format(incr_month,'%Y')='".$year."' and 
			date_format(incr_month,'%m')='".$month."' and incr_chair_entrydt='0000-00-00 00:00:00' ");
			// echo $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['totincr'];
			} else {
			}
		}
		
		
		public function TotalRecruitmentCurrMonth($month,$year)
		{
			$query = $this->db->query("select count(*) as totemp from employee where 	date_format(emp_doj,'%Y')='".$year."' and 
			date_format(emp_doj,'%m')='".$month."'	and emp_status=1 ");
			// echo $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['totemp'];
			} else {
			}
		}
		
		public function TotalresignedCurrMonth($month,$year)
		{
			$query = $this->db->query("select count(*) as totres from hr_resignation where 	date_format(resig_date,'%Y')='".$year."' and 
			date_format(resig_date,'%m')='".$month."'	and resig_status=1 ");
			// echo $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['totres'];
			} else {
			}
		}
		

		public function TotalPaidAmount($empid)
		{
			$query = $this->db->query("SELECT sum(emi_dedu_amt) as paidamt  FROM 

hr_adv_emi_details WHERE emi_status=1 and emi_paidstatus=2 and emi_empid=".$empid."");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['paidamt'];
			} 
		}
		
		public function TotalAdvBalance($empid)
		{
			$query = $this->db->query("SELECT sum(emi_dedu_amt) as paidamt  FROM 

hr_adv_emi_details WHERE emi_status=1 and emi_paidstatus=1 and emi_empid=".$empid."");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['paidamt'];
			} 
		}
		
		
		public function Incramt($empid,$month,$year)
		{
			$query = $this->db->query("SELECT sum(`incr_chair_amt`) as finalamt FROM `hr_increment` WHERE `incr_empid` = '$empid' and date_format(`incr_month`,'%m') <= $month and date_format(incr_month , '%Y') <= $year");
			$row = $query->row_array();
			if ($query->num_rows() > 0) 
			{
				return $row['finalamt'];
			}
			else
			{
			}
		}
		
		public function edit_record_by_admit_uhid($tbl,$id,$data)
		{
            $this->db->where('admit_id',$id);
            if($this->db->update($tbl,$data))
			{ 
				return true;
            } else {
				return false;	
            }
        }
		
		public function edit_record_respi($tbl,$id,$data)
		{
            $this->db->where('respi_id',$id);
            if($this->db->update($tbl,$data))
			{ 
				return true;
            } else {
				return false;	
            }
        }
		
		 public function edit_record_by_multiplecondition($tbl,$id_name,$id,$condi,$no,$data)
		{
            $this->db->where($id_name,$id);
			 $this->db->where($condi,$no);
            if($this->db->update($tbl,$data))
			{ 
				return true;
            } else {
				return false;	
            }
        }
		
		 public function edit_record_by_multiplecondition3($tbl,$id_name,$id,$condi,$no,$thirtid,$third,$data)
		{
            $this->db->where($id_name,$id);
			 $this->db->where($condi,$no);
			  $this->db->where($thirtid,$third);
            if($this->db->update($tbl,$data))
			{ 
				return true;
            } else {
				return false;	
            }
        }
		
		
        public function delete_record($tbl,$id)
		{
            $this->db->where('id', $id);
			if($this->db->update($tbl,array('status'=>0)))
			{ 
				return true;
			} else {
				return false;	
			}
        }
		
		  public function delete_record_any_id($tbl,$id,$idname)
		{
		
		$this->db->delete($tbl,array($idname=>$id));
          
        }	
		
		
		
		public function get_active_record($tbl)
		{
			$this->db->from($tbl);
			$this->db->where('status',1);
			$query = $this->db->get();
			return $query->result_array();
		}
		
		public function remove_record($tbl,$condition)
		{
			$this->db->where($condition);
			$this->db->delete($tbl);
			return;	
		}
			 public function edit_record_xray($tbl,$id,$data)
		{
            $this->db->where('xray_id',$id);
            if($this->db->update($tbl,$data))
			{ 
				return true;
            } else {
				return false;	
            }
        }
		
		
		 public function dml($id)
		{
			$this->db->delete('patho_report_master',array('pathrepom_id'=>$id));
		}
		  
		   public function select()
		  {
			  $this->db->select('*');
			  $this->db->from('patho_report_master');
			  $this->db->where('id',$data);
			  $query = $this->db->get();
			  return $query->result();
		  }
		  
		public function update_data($id,$data)
		{
			$this->db->where('pathrepom_id',$id);
			$this->db->update('patho_report_master',$data);
		}
	
		
		public function edit_record_by_casu($tbl,$id,$data)
		{
            $this->db->where('casu_id',$id);
            if($this->db->update($tbl,$data))
			{ 
				return true;
            } else {
				return false;	
            }
        }
		public function edit_record1($tbl,$id,$data)
		{
            $this->db->where('xray_id',$id);
            if($this->db->update($tbl,$data))
			{ 
				return true;
            } else {
				return false;	
            }
        }
		public function edit_hrdocument($tbl,$id,$data)
		{
            $this->db->where('edoc_id',$id);
            if($this->db->update($tbl,$data))
			{ 
				return true;
            } else {
				return false;	
            }
        }
		public function edit_outsidereport($tbl,$id,$data)
		{
            $this->db->where('outside_id',$id);
            if($this->db->update($tbl,$data))
			{ 
				return true;
            } else {
				return false;	
            }
        }
		public function edit_hrdependent($tbl,$id,$data)
		{
            $this->db->where('depn_id',$id);
            if($this->db->update($tbl,$data))
			{ 
				return true;
            } else {
				return false;	
            }
        }
		
		public function edit_record_by_uhid_ipd($tbl,$id,$data)
		{
            $this->db->where('admit_id',$id);
            if($this->db->update($tbl,$data))
			{ 
				return true;
            } else {
				return false;	
            }
        }
		      public function delete_dep($id)
		{
			$this->db->delete('depertment',array('depart_id'=>$id));
		}
		 public function delete_Bed($id)
		{
			$this->db->delete('inf_bed',array('bed_id'=>$id));
		}
		
		 public function edit_record_by_any_id($tbl,$id_name,$id,$data)
		{
            $this->db->where($id_name,$id);
            if($this->db->update($tbl,$data))
			{ 
				return true;
            } else {
				return false;	
            }
        }
		
		 public function select_hr_edit()
		  {
			  $this->db->select('*');
			  $this->db->from('employee');
			  $this->db->where('id',$data);
			  $query = $this->db->get();
			  return $query->result();
		  }
		 public function update_Emp($id,$data)
		{
			$this->db->where('emp_id',$id);
			$this->db->update('employee',$data);
		}
		
			 public function edit_record_cash($tbl,$id,$data)
		{
            $this->db->where('topup_id',$id);
            if($this->db->update($tbl,$data))
			{ 
				return true;
            } else {
				return false;	
            }
        }
		
		public function edit_record2($tbl,$id,$data)
		{
            $this->db->where('usgct_id',$id);
            if($this->db->update($tbl,$data))
			{ 
				return true;
            } else {
				return false;	
            }
        }
		public function edit_record_ct($tbl,$id,$data)
		{
            $this->db->where('ctscan_id',$id);
            if($this->db->update($tbl,$data))
			{ 
				return true;
            } else {
				return false;	
            }
        }
		
		public function update_dep($id,$data)
		{
			$this->db->where('depn_id',$id);
			$this->db->update('hr_dependent',$data);
		}
		public function hr_dep_del($id)
		{
			$this->db->delete('hr_dependent',array('depn_id'=>$id));	
		}
		
		 public function dml1($id)
		{
			$this->db->delete('test_master',array('id'=>$id));
		}
		 public function update_newreport($id,$data)
		{
			$this->db->where('id',$id);
			$this->db->update('test_master',$data);
		}
		
		 public function edit_record_dr_visit($tbl,$id,$data)
		{
            $this->db->where('cons_id',$id);
            if($this->db->update($tbl,$data))
			{ 
				return true;
            } else {
				return false;	
            }
        }
		
		public function edit_status_by_id($tbl,$whereField,$id,$data,$statusField)
		{
            $this->db->where($whereField ,$id);
            if($this->db->update($tbl,$data))
			{ 
				return true;
            } else {
				return false;	
            }
        }
		
		public function edit_record_by_shift_uhid($tbl,$id,$data)
		{
            $this->db->where('shift_id',$id);
            if($this->db->update($tbl,$data))
			{ 
				return true;
            } else {
				return false;	
            }
        }
		
		public function Patient_current_bal($uhid,$ipdopd_id)
		{
			$query = $this->db->query("select sum(topup_amount) as amount from smcard_topup where topup_uhid=$uhid and topup_ipd_opd_id=$ipdopd_id");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				$topup_amt= $row['amount'];
			}
			$query = $this->db->query("select sum(refund_amount) as ref_amount from refund_amount where refund_uhid=$uhid and refund_ipdopd_id=$ipdopd_id");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				$refund_amt= $row['ref_amount'];
			}
			$patient_bal=$topup_amt-$refund_amt;
		return $patient_bal;
		}
		
		public function delete_ipd_admit($id)
		{
			$this->db->delete('ipd_admit',array('admit_id'=>$id));
		}
		
		
		public function del_test($id)
		{
			$this->db->delete('patho_test',array('ptestsub_id'=>$id));
		}
		
		public function edit_record_refund($tbl,$id,$data)
		{
            $this->db->where('refund_uhid',$id);
            if($this->db->update($tbl,$data))
			{ 
				return true;
            } else {
				return false;	
            }
        }
		
		public function get_all_fields($tbl)
		{
			$query = $this->db->list_fields($tbl);
            if($query)
			{ 
				return $query;
            } else {
				return false;	
            }
        }
		public function edit_record_by_any_one_id($tbl,$id1,$data,$where1)
		{
            $this->db->where($where1,$id1);
            
            if($this->db->update($tbl,$data))
			{ 
				return true;
            } else {
				return false;	
            }
        }
		
		public function edit_record_by_any_two_id($tbl,$id1,$id2,$data,$where1,$where2)
		{
            $this->db->where($where1,$id1);
            $this->db->where($where2,$id2);
            if($this->db->update($tbl,$data))
			{ 
				return true;
            } else {
				return false;	
            }
        }
		
			public function edit_record_by_multi_id($tbl,$id1,$id2,$id3,$data,$where1,$where2,$where3)
		{
            $this->db->where($where1,$id1);
            $this->db->where($where2,$id2);
			$this->db->where($where3,$id3);
            if($this->db->update($tbl,$data))
			{ 
				return true;
            } else {
				return false;	
            }
        }
		public function Currentpackage($empid)
		{
			$query = $this->db->query("select emppac_packid from hr_emppackage	WHERE emppac_emp_id='$empid' order by emppac_id desc limit 1  ");
			// echo $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['emppac_packid'];
			} else {
			}
		}
		
		public function Starting_package($empid)
		{
			$query = $this->db->query("SELECT emppac_packid FROM `hr_emppackage` WHERE `emppac_emp_id` ='$empid' order by `emppac_id` limit 1 ");
			// echo $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['emppac_packid'];
			} else {
			}
		}
		
		public function pathoTAT($testid)
		{
			$query = $this->db->query("SELECT ptest_tat FROM `patho_test` WHERE `ptestsub_id` ='$testid'");
			// echo $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['ptest_tat'];
			} else {
			}
		}
		
		
		public function gateadvance($empid,$month,$year)
		{
			$query = $this->db->query("select sum(gateadv_amount) as togateadv from hr_gateadv where gateadv_empid='$empid' and 
			date_format(gateadv_date,'%m')=".$month." and date_format(gateadv_date,'%Y')=".$year." and gateadv_status=1");
			// $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['togateadv'];
			} 
		}

public function Totalgateadvance($month,$year)
		{
			$query = $this->db->query("select sum(gateadv_amount) as togatead from hr_gateadv where  
			date_format(gateadv_date,'%m')=".$month." and date_format(gateadv_date,'%Y')=".$year." ");
			// $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['togatead'];
			} 
		}

		
		public function securitytotal($empid)
		{
			$query = $this->db->query("select sec_emi_amt as totsec from hr_sec_emi_tran where sec_emi_emp='$empid' ");
			// $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['totsec'];
			} 
		} 
		
		public function bankaccountno($empid)
		{
			$query = $this->db->query("select emp_bnk_acc_no from employee where emp_id='$empid' ");
			// $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['emp_bnk_acc_no'];
			} 
		} 
		
		public function bankname($empid)
		{
			$query = $this->db->query("select emp_bnk_name from employee where emp_id='$empid' ");
			// $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['emp_bnk_name'];
			} 
		} 
		
		public function gatepassid($empid,$month,$year)
		{
			$query = $this->db->query("select gateadv_id from hr_gateadv where gateadv_empid=".$empid." and date_format(gateadv_date,'%m')=".$month."
			and date_format(gateadv_date,'%Y')=".$year." ");
			// $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['gateadv_id'];
			} 
		} 
		
		
		public function Pathoaccessionno($regid)
		{
			$query = $this->db->query("select max(patho_access_no) as accno from patho_allot_test where patho_ipdopd_id='$regid' and taken_action >0 ");
			// $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['accno'];
			} 
		} 
		
		
		public function EquipmentName($eqid)
		{
			$query = $this->db->query("select equip_name from patho_equipment where equip_id='$eqid' ");
			// $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['equip_name'];
			} 
		} 
		
		public function EquipmentUniq($eqid)
		{
			$query = $this->db->query("select equip_uniqueid from patho_equipment where equip_id='$eqid' ");
			// $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['equip_uniqueid'];
			} 
		} 
		
		public function InvestigationCode($invid)
		{
			$query = $this->db->query("select ptest_code from patho_test where ptestsub_id='$invid' ");
			// $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['ptest_code'];
			} 
		} 
		
		
		public function security_of_a_month($empid,$m,$y)
		{
			$query = $this->db->query("select sum(sec_emi_amt) as security from hr_sec_emi_tran where sec_emi_emp='$empid' and sec_emi_month='$m' and sec_emi_year ='$y' and sec_emi_tran_status = 1");
			// $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['security'];
			} 
		}
		
		public function securitytotal_persent($empid)
		{
			$query = $this->db->query("select sec_sec_perc  from hr_security where sec_empid='$empid' ");
		    
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['sec_sec_perc'];
			} 
		}
		
		public function Currentchallan($empid,$month,$year)
		{
			$query = $this->db->query("SELECT sum(chal_dig_amount) as chaamt FROM hr_challan WHERE chal_approve !=2 and chal_empid='$empid' and date_format(chal_date,'%m')=$month and date_format(chal_date,'%Y')=$year");
			
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['chaamt'];
			} 
		}
		
		public function CurrAdvDedu($empid,$month,$year)
		{
			$query = $this->db->query("SELECT sum(emi_dedu_amt) as deduamt FROM hr_adv_emi_details WHERE emi_status=1 and emi_empid='$empid' and emi_month=$month and emi_year=$year");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['deduamt'];
			} 
		}
		
		public function CurrAdvDeduMonthly($empid,$month,$year)
		{
			
			$query = $this->db->query("SELECT sum(emi_dedu_amt) as emi_dedu_amt  FROM hr_adv_emi_details e
			inner join hr_adv a on a.adv_id=e.emi_advance_id
			 WHERE emi_status=1 and adv_apr_payrol_status=2 and emi_empid='$empid' and emi_month=$month and emi_year=$year");
			
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['emi_dedu_amt'];
			} 
		}
		
		public function LastAllotedDate($uhid)
		{
			$query = $this->db->query("SELECT date FROM patho_allot_test WHERE uhid='$uhid' order by id desc limit 1");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['date'];
			} 
		}
		
		public function Pathocollectdate($tranid)
		{
			$query = $this->db->query("SELECT colle_dt_time FROM patho_allot_test WHERE patho_tran_id='$tranid' limit 1");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['colle_dt_time'];
			} 
		}
		
		public function PathogenrateReport($tranid)
		{
			$query = $this->db->query("SELECT status FROM patho_allot_test WHERE patho_tran_id='$tranid' ");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['status'];
			} 
		}
		
		public function NewPackWithIncre($empid)
		{
			$query = $this->db->query("SELECT  sum(incr_chair_per) as finalamt  FROM hr_increment	WHERE incr_empid='$empid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['finalamt'];
			} else {
			}
		}
		
		public function Location($uhid)
		{
			$query = $this->db->query("SELECT r_name  FROM ipd_admit i left join resource r on r.r_id=i.admit_floor WHERE admit_uhid='$uhid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['r_name'];
			} else {
			}
		}
		
		
		public function Ename($empid)
		{
			$query = $this->db->query("SELECT emp_name  FROM employee  WHERE emp_id='$empid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['emp_name'];
			} else {
			}
		}
		
		public function EnameByCode($empcode)
		{
			$query = $this->db->query("SELECT emp_name  FROM employee  WHERE emp_code='$empcode'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['emp_name'];
			} else {
			}
		}
		
		public function EnameById($id)
		{
			$query = $this->db->query("SELECT emp_name  FROM employee  WHERE emp_id='$id'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['emp_name'];
			} else {
			}
		}
		
		
		public function Vacci_id($empid)
		{
			$query = $this->db->query("SELECT vacci_id FROM hr_vaccination WHERE vacci_empid='$empid' order by vacci_id desc");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['vacci_id'];
			} else {
			}
		}
		
		
		public function Pname1($uhid)
		{
			$string="";
			$query = $this->db->query("SELECT id,first_name,middle_name,last_name  FROM patient  WHERE id='$uhid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $string=$row['first_name']." ".$row['middle_name']." ".$row['last_name'];
				 
			} else {
			}
		}
		
		
		
		
		
		public function UserName($userid)
		{
			$query = $this->db->query("SELECT username FROM users WHERE id ='$userid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['username'];
			} else {
			}
		}
		
		public function Drname($drid)
		{
			$query = $this->db->query("SELECT doc_name  FROM doctor  WHERE id='$drid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['doc_name'];
			} else {
			}
		}
		
		public function Pname($pid)
		{
			$query = $this->db->query("SELECT first_name,middle_name,last_name  FROM patient  WHERE id='$pid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return ucwords(strtolower($row['first_name']))."&nbsp;".ucwords(strtolower($row['middle_name']))."&nbsp;".ucwords(strtolower($row['last_name']));
			} else {
			}
		}
		
		
		public function getuser($userid)
		{
			$query = $this->db->query("SELECT username  FROM users  WHERE id='$userid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['username'];
			} else {
			}
		}
		
		public function GetEmpidByUserid($userid)
		{
			$query = $this->db->query("SELECT emp_id  FROM users WHERE id='$userid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['emp_id'];
			} else {
			}
		}
		
		public function GetUseridByEmpid($empid)
		{
			$query = $this->db->query("SELECT email FROM users WHERE emp_id='$empid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['email'];
			} else {
			}
		}
		
		public function GetUserByEmpid($empid)
		{
			$query = $this->db->query("SELECT id FROM users WHERE emp_id='$empid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['id'];
			} else {
			}
		}
		
		public function GetUserpassword($userid)
		{
			$query = $this->db->query("SELECT password FROM users WHERE id='$userid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['password'];
			} else {
			}
		}
		
		public function Ecode($empid)
		{
			$query = $this->db->query("SELECT emp_code  FROM employee  WHERE emp_id='$empid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['emp_code'];
			} else {
			}
		}
		
		public function PAge($uhid)
		{
			$query = $this->db->query("SELECT patient_age   FROM patient  WHERE id='$uhid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['patient_age'];
			} else {
			}
		}
		
		public function Pgender($uhid)
		{
			$query = $this->db->query("SELECT patient_gender   FROM patient  WHERE id='$uhid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['patient_gender'];
			} else {
			}
		}
		
		public function InvestigationamtNotPaid($id,$uhid)
		{
			$query = $this->db->query("select sum(tran_amount) as tran_amount from transaction where tran_paidstatus!='No' and tran_uhid=$uhid and tran_ipd_opd_id=$id");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['tran_amount'];
			} else {
			}
		}
		public function HospitalbillBalance($id,$uhid)
		{
			$query = $this->db->query("select sum(tran_amount) as tran_amount from transaction_bill where tran_paidstatus!='go' and tran_uhid=$uhid and tran_ipd_opd_id=$id");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
			$hospitalamt= $row['tran_amount'];	
			}
			$query = $this->db->query("select topup_amount from smcard_topup where topup_type=2 and topup_uhid=$uhid and topup_ipd_opd_id=$id");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
			$billpaid= $row['topup_amount'];	
				
			}
			$balance=$hospitalamt-$billpaid	;
				if ($balance > 0) {
				return $balance;
			} else {
			}
		}
		
		public function shiftIn($shiftid)
		{
			$query = $this->db->query("SELECT shift_in  FROM hr_shift  WHERE shift_id='$shiftid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['shift_in'];
			} else {
			}
		}
		
		public function MaxEmpCode()
		{
			$query = $this->db->query("SELECT max(emp_code) as mcode  FROM employee  WHERE 1");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['mcode']+1;
			} else {
			}
		}
		
		public function shiftOut($shiftid)
		{
			$query = $this->db->query("SELECT shift_out  FROM hr_shift  WHERE shift_id='$shiftid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['shift_out'];
			} else {
			}
		}
		
		public function shiftAllotedId($empid)
		{
			$query = $this->db->query("SELECT alott_shift_id  FROM hr_shift_allot  WHERE shift_emp_id='$empid' order by shift_allot_id desc limit 1");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['alott_shift_id'];
			} else {
			}
		}
		
		
		public function shiftAllotedName($shiftid)
		{
			$query = $this->db->query("SELECT shift_name  FROM hr_shift  WHERE shift_id='$shiftid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['shift_name'];
			} else {
			}
		}
		
			public function EmployeePFNo($empid)
		{
			$query = $this->db->query("SELECT pf_no  FROM hr_pf  WHERE pf_empid='$empid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['pf_no'];
			} else {
			}
		}
		
		public function EmployeePFApplicable($empid)
		{
			$query = $this->db->query("SELECT pf_yesno  FROM hr_pf  WHERE pf_empid='$empid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['pf_yesno'];
			} else {
			}
		}
		
		
		public function EmployeePFDate($empid)
		{
			$query = $this->db->query("SELECT pf_effective  FROM hr_pf  WHERE pf_empid='$empid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['pf_effective'];
			} else {
			}
		}
		
		public function EmployeeESINo($empid)
		{
			$query = $this->db->query("SELECT esi_no  FROM hr_esi  WHERE esi_empid='$empid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['esi_no'];
			} else {
			}
		}
		public function EmployeeESIApplicable($empid)
		{
			$query = $this->db->query("SELECT esi_yesno  FROM hr_esi  WHERE esi_empid='$empid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['esi_yesno'];
			} else {
			}
		}
		
		public function EmployeeESIDate($empid)
		{
			$query = $this->db->query("SELECT pfesi_entrydt  FROM hr_pfesi  WHERE pfesi_empid='$empid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['pfesi_entrydt'];
			} else {
			}
		}
		
		
		
		public function ChallanSms($empid)
		{
			$query = $this->db->query(" select * from hr_challan c inner join employee e on e.emp_id=c.chal_empid where chal_empid=".$empid." 
			order by chal_no desc limit 1");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				$challanno= $row['chal_no'];
				$creason= $row['chal_reascut'];
				$cchaamtinword= $row['chal_amount'];
				$chaamount= $row['chal_dig_amount'];
				$orderby= $row['chal_order_empid'];
				$empname= $row['emp_name'];
				$mobileno=$row['emp_phone1'];
				$empcode=$row['emp_code'];
			}
			$challansms=" Mr/Mrs/Miss.  ".$empname." Challan No. ".$challanno." Apke Name Rs ".$chaamount." Rupees (".$cchaamtinword.") ka chalan ".$creason." ki vajah se kata gaya hai Order By  ".$orderby." " ;
		                  
		                 $Curl_Session = curl_init('http://116.72.247.236/API/WebSMS/Http/v1.0a/index.php?');
                         curl_setopt ($Curl_Session, CURLOPT_POST, 1);
                         curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, "username=globaldnd&password=password&sender=METROH&to=$mobileno&message=$challansms&reqid=1&format={json|text}&route_id=113&msgtype=unicode");
                         curl_setopt ($Curl_Session, CURLOPT_FOLLOWLOCATION, 1);
                         curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER,1);
                         $result=curl_exec ($Curl_Session);
		
		return $AllDetailsInAdv;
		}
		
		
		public function IncrementSms($empid)
		{
			$title="";
			$query = $this->db->query(" select e.emp_gender,e.emp_name,e.emp_phone1,e.emp_code,e.emp_id,i.incr_id,i.incr_chair_per,i.incr_month from hr_increment i inner join employee e on e.emp_id=i.incr_empid where i.incr_empid=".$empid." order by i.incr_id desc limit 1");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				$incrid= $row['incr_id'];
				$incrperc= $row['incr_chair_per'];
				$incrmonth= $row['incr_month'];
				$empname= $row['emp_name'];
				$mobileno=$row['emp_phone1'];
				$empcode=$row['emp_code'];
				$empgender=$row['emp_gender'];
			}
			if($empgender==1)
			{
			$title="Mr.";
			}
			else
			{
			$title="Miss/Mrs.";
			}
			$incrementsms="  ".$title."  ".$empname."  Apko  ".$incrperc." Percent  ka Increment Organization ki taraf se diya gaya hai" ;
		                  
		                 $Curl_Session = curl_init('http://116.72.247.236/API/WebSMS/Http/v1.0a/index.php?');
                         curl_setopt ($Curl_Session, CURLOPT_POST, 1);
                         curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, "username=globaldnd&password=password&sender=METROH&to=$mobileno&message=$incrementsms&reqid=1&format={json|text}&route_id=113&msgtype=unicode");
                         curl_setopt ($Curl_Session, CURLOPT_FOLLOWLOCATION, 1);
                         curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER,1);
                         $result=curl_exec ($Curl_Session);
		
		return $AllDetailsInAdv;
		}
		
		public function referedby($uhid)
		{
			if($uhid){
				$query = $this->db->query("SELECT d.doc_name  FROM casualty c inner join doctor d on d.id = c.casu_consultent where  c.casu_id = '$uhid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['doc_name'];
			} else {
			}	
			}else {
			
			$query = $this->db->query("SELECT op.doctor,d.doc_name,op.id,op.uhid,d.id  FROM opd_patient op inner join doctor d on d.id = op.doctor where  op.id = '$uhid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['doc_name'];
			} else {
			}
			}
		}
		
		
		public function PLocation($uhid,$ipdid)
		{
		    $floor="";
			$ward="";
			$bed="";
			$query = $this->db->query("select admit_hide,admit_floor,admit_exitdt,admit_status, r.r_name as floorn, rr.r_name as wardn, rrr.r_short_name as bedn, admit_ward,admit_bed from ipd_admit a 
			left join resource r on r.r_id=a.admit_floor 
			left join resource rr on rr.r_id=a.admit_ward
			left join resource rrr on rrr.r_id=a.admit_bed
			where admit_id= ".$ipdid." and admit_uhid =".$uhid."");
			$row = $query->row_array();
			if ($query->num_rows() > 0) 
			{

				if($row['admit_status']=='DISCHARGED')
					{
						return 'DISCHARGED ON '.date('d-m-Y H:i:s',strtotime($row['admit_exitdt'])) ;
					}
					elseif($row['admit_hide']==0 )
					{  
						return 'Discharged from Ward' ;
					}
					else
					{
					$floor= $row['floorn'];
					$ward= $row['wardn'];
					$bed= $row['bedn'];
					return ucwords(strtolower($floor))."->".ucwords(strtolower($ward))."->".ucwords(strtolower($bed));
					}
			}
			
		}
		public function PLocation2($uhid,$ipdid)
		{
		    $floor="";
			$ward="";
			$bed="";
			$query = $this->db->query("select admit_hide,admit_floor,admit_exitdt,admit_status, r.r_name as floorn, rr.r_name as wardn, rrr.r_short_name as bedn, admit_ward,admit_bed from ipd_admit a 
			left join resource r on r.r_id=a.admit_floor 
			left join resource rr on rr.r_id=a.admit_ward
			left join resource rrr on rrr.r_id=a.admit_bed
			where admit_id= ".$ipdid." and admit_uhid =".$uhid."");
			$row = $query->row_array();
			if ($query->num_rows() > 0) 
			{
                    $floor= $row['floorn'];
					$ward= $row['wardn'];
					$bed= $row['bedn'];
					return ucwords(strtolower($floor))."->".ucwords(strtolower($ward))."->".ucwords(strtolower($bed));
					 
			}
			
		}

		
		public function TotalBillRajivSir($uhid ,$ipdid)
       {
		   
		   
	      $patdata['pdata']= $this->Common_model->get_data_by_query("select casu_scheme from casualty where casu_id=$ipdid");
	
		  $scheme=$patdata['pdata'][0]['casu_scheme'];
		  
		  
		  
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
			
			
			
				public function TotalBillRajivSir_opd($uhid,$ipdid)
       {
		   $patdata['pdata']= $this->Common_model->get_data_by_query("select * from patient where id=$uhid");
		    $scheme=$patdata['pdata'][0]['scheme'];
	     if($scheme==4)
				
				{    
				
				
				$data['patientDetail'] = $this->Common_model->get_data_by_query("SELECT * from cghs_patient where uhid=$uhid and cghs_opdipd_id=$ipdid ");
				
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
			
			
			
		
		
		
	
		
		
		public function patient_advamt($uhid,$ipdopd_id)
		{
			$query = $this->db->query("select sum(topup_amount) as amount from smcard_topup where topup_uhid=$uhid and topup_ipd_opd_id=$ipdopd_id ");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				$topup_amt= $row['amount'];
			}
			
			
			
		$final_amt=$topup_amt;
		
		return $final_amt;
		}
		
		public function patient_recamtbysch($uhid,$ipdopd_id)
		{
			$query = $this->db->query("select sum(clam_amount) as amount from clam_receipt_amt where clam_uhid=$uhid and clam_reg_no=$ipdopd_id ");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				$rec_amt= $row['amount'];
			}
			
		$final_amt=$rec_amt;
		
		return $final_amt;
		}
		
		
		public function patient_bill_amt($uhid,$ipdopd_id)
		{
			$query = $this->db->query("select sum(tran_amount) as amount from transaction where tran_uhid=$uhid and tran_ipd_opd_id=$ipdopd_id and tran_paidstatus='NO' ");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				$investi_amt= $row['amount'];
			}
			
			$query = $this->db->query("select sum(tran_amount) as tran_amount from transaction_bill where  tran_uhid=$uhid and tran_ipd_opd_id=$ipdopd_id and tran_paidstatus!='go'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				$tran_amt= $row['tran_amount'];
			}
			$query = $this->db->query(" select  tran_serve_charge from transaction_bill 
	         where  tran_uhid=$uhid ");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				$serv= $row['tran_serve_charge'];
			}
			
			$final_amt=$tran_amt+$investi_amt+100;
		
		$final_amt_nur=round(($final_amt*15)/100);
		$final_nur=$final_amt_nur+$final_amt;
		
		$servcharge=round(($final_nur*13)/100);
		$final_serv=$servcharge+$final_nur;
		
		if(@$serv==1){ 
		
		return  $final_serv;
		}else{
		return $final_nur;	
			
		}
		}
		public function patient_bill_amt_uhid($uhid)
		{
			$query = $this->db->query("select sum(tran_amount) as amount from transaction where tran_uhid=$uhid  and tran_paidstatus='NO' ");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				$investi_amt= $row['amount'];
			}
			
			$query = $this->db->query("select sum(tran_amount) as tran_amount from transaction_bill where  tran_uhid=$uhid  and tran_paidstatus!='go'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				$tran_amt= $row['tran_amount'];
			}
			$query = $this->db->query(" select  tran_serve_charge from transaction_bill 
	         where  tran_uhid=$uhid ");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				$serv= $row['tran_serve_charge'];
			}
			
			$final_amt=$tran_amt+$investi_amt+100;
		
		$final_amt_nur=round(($final_amt*15)/100);
		$final_nur=$final_amt_nur+$final_amt;
		
		$servcharge=round(($final_nur*13)/100);
		$final_serv=$servcharge+$final_nur;
		
		if(@$serv==1){ 
		
		return  $final_serv;
		}else{
		return $final_nur;	
			
		}
		}
	
			public function Patient_dis_amt($uhid,$ipdopd_id)
		{
			$query = $this->db->query("select sum(tran_final_discount) as amount from transaction_bill where tran_uhid=$uhid and tran_ipd_opd_id=$ipdopd_id");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				$topup_amt= $row['amount'];
			}
			
		return $topup_amt;
		}
		
		public function Rpassword($length=9, $strength=0) {
	$vowels = 'aeuy';
	$consonants = 'bdghjmnpqrstvz';
	if ($strength & 1) {
		$consonants .= 'BDGHJLMNPQRSTVWXZ';
	}
	if ($strength & 2) {
		$vowels .= "AEUY";
	}
	if ($strength & 4) {
		$consonants .= '23456789';
	}
	if ($strength & 8) {
		$consonants .= '@#$%';
	}
 
	$password = '';
	$alt = time() % 2;
	for ($i = 0; $i < $length; $i++) {
		if ($alt == 1) {
			$password .= $consonants[(rand() % strlen($consonants))];
			$alt = 0;
		} else {
			$password .= $vowels[(rand() % strlen($vowels))];
			$alt = 1;
		}
	}
	return $password;
}
		
		public function GetTestNameaPatho($pathid)
		{
			$query = $this->db->query("select ptest_name from patho_test where ptestsub_id=$pathid  ");
			// echo $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['ptest_name'];
			} else {
			}
		}
		
		public function GetTestCodePatho($pathid)
		{
			$query = $this->db->query("select ptest_code from patho_test where ptestsub_id=$pathid  ");
			// echo $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['ptest_code'];
			} else {
			}
		}
		
		public function GetTestTATPatho($pathid)
		{
			$query = $this->db->query("select ptest_tat from patho_test where ptestsub_id=$pathid  ");
			// echo $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['ptest_tat'];
			} else {
			}
		}
		
		public function LastReportedTime($accesno)
		{
			$query = $this->db->query("select generate_report from patho_allot_test where patho_access_no=$accesno and isgenerate = 2 order by generate_report desc limit 1 ");
			 //echo $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['generate_report'];
			} else {
			}
		}
		
		
		public function RejectionReasion($rid)
		{
			$query = $this->db->query("select reasion_name from patho_rejection_reasion where reasion_id=$rid  ");
			// echo $this->db->last_query();
			// die;
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['reasion_name'];
			} else {
			}
		}
		
		public function Collectby($cid)
		{
			$query = $this->db->query("select reasion_name from patho_allot_test where id=$cid  ");
			// echo $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['reasion_name'];
			} else {
			}
		}
		
		public function LastAccessionNo()
		{
			$query = $this->db->query("select max(patho_access_no)+1 as access from patho_allot_test where 0=0");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				$maxaccess= $row['access'];
			}
		return $maxaccess;
		}
		
		public function IPDOROPD($regno)
		{
			$query = $this->db->query("select admit_id from ipd_admit where admit_id=$regno");
			// echo $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return "IPD";
			} else {
				return "OPD";
			}
		}
		
		public function GetptAdd($uhid,$ipdid){
			$query = $this->db->query("select casu_addr from casualty where casu_uhid=$uhid and casu_id=$ipdid");
			// echo $this->db->last_query();
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['casu_addr'];
			} else {
				return "0";
			}
		}
		
		
		public function AdvAmtSms($uhid,$ipdopd_id)
		{
			$query = $this->db->query("SELECT c.casu_fname,c.casu_mname,c.casu_lname,p.contact_no,s.`topup_uhid`,s.topup_ipd_opd_id,
			s.topup_amount as lastamt,(select sum(`topup_amount`) as totmt from smcard_topup where `topup_ipd_opd_id`=$ipdopd_id) totmt  FROM
`smcard_topup` s 
 left join casualty c on c.casu_id=s.topup_ipd_opd_id 
 left join patient p on p.id=s.topup_uhid
WHERE `topup_ipd_opd_id`=$ipdopd_id order by `topup_id` desc limit 1 ");
			
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				$topup_uhid= $row['topup_uhid'];
				$topup_ipdid= $row['topup_ipd_opd_id'];
				$topup_adv= $row['lastamt'];
				$topup_totaladv= $row['totmt'];
				$mob_no= $row['contact_no'];
				$Patient_name=$row['casu_fname']." ".$row['casu_mname']." ".$row['casu_lname'];
				
			}
			$AllDetailsInAdv=" प्रिय परिजन आप के द्वारा मरीज  ".$Patient_name." Reg No. ".$topup_ipdid." और UHID No.".$topup_uhid." के खाते में ".$topup_adv." रू एडवांस जमा किये गये है | और कुल जमा राशि ".$topup_totaladv." रू है | बिल की अधिक जानकारी के लिए बिलिंग काउंटर मै संपर्क करे धन्यवाद मेट्रो हॉस्पिटल " ;
			
			
			$contact=$mob_no;
		                  
		                 $Curl_Session = curl_init('http://116.72.247.236/API/WebSMS/Http/v1.0a/index.php?');
                         curl_setopt ($Curl_Session, CURLOPT_POST, 1);
                         curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, "username=globaldnd&password=password&sender=METROH&to=$contact&message=$AllDetailsInAdv&reqid=1&format={json|text}&route_id=113&msgtype=unicode");
                         curl_setopt ($Curl_Session, CURLOPT_FOLLOWLOCATION, 1);
                         curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER,1);
                         $result=curl_exec ($Curl_Session);
		
		return $AllDetailsInAdv;
		}
		
		public function AdvHandoverSms($useridd)
		{
			$query = $this->db->query("select cash.*,user.phone from cash_user_detail cash left join users user on user.id=cash.cuser_handoverid WHERE `cuser_handoverid`=$useridd order by `cuser_id` desc limit 1 ");
			
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				$fromuser= $this->getuser($row['cuser_usr']);
				$handoveruser= $this->getuser($row['cuser_handoverid']);
				$amthandover= $row['cuser_amthandover'];
				$date= date('d-m-Y H:i:s',strtotime($row['cuser_entrydt']));
				$actualamt= $row['cuser_amtshouldbe'];
				$cuser_totalexpvoucher= $row['cuser_totalexpvoucher'];
				$amtthandover=$amthandover+$cuser_totalexpvoucher;
				$amtdiff= $amtthandover-$row['cuser_amtshouldbe'];
				$fromuserphoneno=$this->GetUserphone($fromuser);
				//$mob_no1= 9893942028,9575300888,9575300888,9575300110;
				$mob_no= '9575300888,9893942028';
			}
			
			$AllDetailsInAdv=" MHCRC: Date: ".$date." , ".ucfirst(strtoupper($fromuser))." ने ".ucfirst(strtoupper($handoveruser))." को ".$amthandover."रु. कैश "." Handover किये | Voucher ".$cuser_totalexpvoucher." दिया | Actual Amount: ".$actualamt.""." होना चाहिए | Amount Difference : ".$amtdiff."रु. |"  ;
			
			
			
			$contact=$mob_no;
		                  
		                 $Curl_Session = curl_init('http://116.72.247.236/API/WebSMS/Http/v1.0a/index.php?');
                         curl_setopt ($Curl_Session, CURLOPT_POST, 1);
                         curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, "username=globaldnd&password=password&sender=METROH&to=$contact&message=$AllDetailsInAdv&reqid=1&format={json|text}&route_id=113&msgtype=unicode");
                         curl_setopt ($Curl_Session, CURLOPT_FOLLOWLOCATION, 1);
                         curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER,1);
                         $result=curl_exec ($Curl_Session);
		
		    return $AllDetailsInAdv;
			
		}
		
		
		public function AdvHandoverAlertSms($amtdiff)
		{
			
			$mob_no= '9893942028,9329986654';
			
			$AllDetails=" MHCRC: Handover Amount और Actual Amount same नहीं है |Amount Difference: ".$amtdiff.""." " ;
			
			$contact=$mob_no;
		                  
		                 $Curl_Session = curl_init('http://116.72.247.236/API/WebSMS/Http/v1.0a/index.php?');
                         curl_setopt ($Curl_Session, CURLOPT_POST, 1);
                         curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, "username=globaldnd&password=password&sender=METROH&to=$contact&message=$AllDetails&reqid=1&format={json|text}&route_id=113&msgtype=unicode");
                         curl_setopt ($Curl_Session, CURLOPT_FOLLOWLOCATION, 1);
                         curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER,1);
                         $result=curl_exec ($Curl_Session);
		
		    return $AllDetails;
			
		}
		
	    
		public function GetUserphone($userid)
		{
			$query = $this->db->query("SELECT phone FROM users WHERE id='$userid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['phone'];
			} else {
			}
		}
		
		
		public function convertToHoursMins($time, $format = '%02d:%02d') {
									if ($time < 1) {
										return;
									}
									$hours = floor($time / 60);
									$minutes = ($time % 60);
									return sprintf($format, $hours, $minutes);
								}
		
		public function DischargePlanMsg($uhid,$ipdopd_id,$msg)
		{
			// $contact=array('8349101270');
			$contact=array('9575300139','9575300140','9575300114','9575300110','9575300713','9827444359','9575300132','9575303767','9826909248','9301964683');
			
		    foreach($contact as $sms) {
				
				$Curl_Session = curl_init('http://116.72.247.236/API/WebSMS/Http/v1.0a/index.php?');
                curl_setopt ($Curl_Session, CURLOPT_POST, 1);
                curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, "username=globaldnd&password=password&sender=METROH&to=$sms&message=$msg&reqid=1&format={json|text}&route_id=113&msgtype=unicode");
                curl_setopt ($Curl_Session, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER,1);
                $result=curl_exec ($Curl_Session);
				
			}            

		}
	
		public function DischargeMsg($msg,$contact)
		{
			
			// echo $msg;
			// print_r($contact);
			// die;
		    foreach($contact as $sms) {
				
				$Curl_Session = curl_init('http://116.72.247.236/API/WebSMS/Http/v1.0a/index.php?');
                curl_setopt ($Curl_Session, CURLOPT_POST, 1);
                curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, "username=globaldnd&password=password&sender=METROH&to=$sms&message=$msg&reqid=1&format={json|text}&route_id=113&msgtype=unicode");
                curl_setopt ($Curl_Session, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER,1);
                $result=curl_exec ($Curl_Session);
				if($result == 1){
					echo "<script>alert('SMS send Successfully');</script>";
				}elseif($result == 0 || $result !=''){
					//do nothing
				}
				
			}            

		}

   
   public function timeinh ($seconds)
{
  $days = floor ($seconds / 86400);
  if ($days > 1) // 2 days+, we need days to be in plural
  {
    return $days . ' days ' . gmdate ('H:i:s', $seconds);
  }
  else if ($days > 0) // 1 day+, day in singular
  {
    return $days . ' day ' . gmdate ('H:i:s', $seconds);
  }

  return gmdate ('H:i:s', $seconds);
}




public function get_location($uhid,$ipdid)
		{
		    $floor="";
			$ward="";
			$bed="";
			$query = $this->db->query("select admit_hide,admit_floor,admit_exitdt,admit_status, r.r_name as floorn, rr.r_name as wardn, rrr.r_short_name as bedn, admit_ward,admit_bed from ipd_admit a 
			left join resource r on r.r_id=a.admit_floor 
			left join resource rr on rr.r_id=a.admit_ward
			left join resource rrr on rrr.r_id=a.admit_bed
			where admit_id= ".$ipdid." and admit_uhid =".$uhid."");
			$row = $query->row_array();
			if ($query->num_rows() > 0) 
			{

				if($row['admit_status']=='DISCHARGED')
					{
						return '<span>DISCHARGED ON '.date('d-m-Y H:i:s',strtotime($row['admit_exitdt'])).'</span> ' ;
					}
					elseif($row['admit_hide']==0 )
					{  
						return '<span >Discharged from Ward</span>' ;
					}
					else
					{
					$floor= $row['floorn'];
					$ward= $row['wardn'];
					$bed= $row['bedn'];
					return ucwords(strtolower($ward))."/".ucwords(strtolower($bed));
					}
			}
			
		}





public function AverageTurnAroundTime($testid,$month,$year)
		{
			$query = $this->db->query("select AVG(TIME_TO_SEC(TIMEDIFF(generate_report,colle_dt_time))) TIMEDIFF from patho_allot_test where cancel_status=0 and test_name =$testid and taken_action=1 and date_format(date,'%m')=$month  and date_format(date,'%Y')=$year");
			// echo $this->db->last_query();
			//die;
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				$seconds=$row['TIMEDIFF'];
				$days = floor ($seconds / 86400);
  if ($days > 1) // 2 days+, we need days to be in plural
  {
    return $days . ' days ' . gmdate ('H:i:s', $seconds);
  }
  else if ($days > 0) // 1 day+, day in singular
  {
    return $days . ' day ' . gmdate ('H:i:s', $seconds);
  }

  return gmdate ('H:i:s', $seconds);
			
				
			} else {
			}
		}


		public function get_advance($tbl,$month,$year,$empid)
		{
			$this->db->from($tbl);
			$this->db->where($month,$year,$empid);
			$query = $this->db->get();
			return $query->result_array();
		}
		
		
			public function patient_deposited_amt($uhid,$ipdopd_id)
		{
			$query = $this->db->query("select sum(topup_amount) as amount from smcard_topup where topup_uhid=$uhid and topup_ipd_opd_id=$ipdopd_id and topup_type in (1,2) ");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				$topup_amt= $row['amount'];
			}
		    
		     return $topup_amt;
		}
		public function patient_Refund_amt($uhid,$ipdopd_id)
		{
			$query = $this->db->query("select sum(refund_amount) as amount from refund_amount where refund_uhid=$uhid and refund_ipdopd_id=$ipdopd_id  ");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				$refund_amt= $row['amount'];
			}
		     return $refund_amt;
		}
		public function investi_amt($uhid,$ipdopd_id)
		{
			$query = $this->db->query("select sum(tran_amount) as amount from transaction where tran_uhid=$uhid and tran_ipd_opd_id=$ipdopd_id and tran_paidstatus='NO'  ");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				$inves_amt= $row['amount'];
			}
			
			$query = $this->db->query("select sum(tran_amount) as amount,tran_serve_charge  from transaction_bill where tran_uhid=$uhid and tran_ipd_opd_id=$ipdopd_id and tran_paidstatus!='go'  ");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				$bill_amt= $row['amount'];
				$tran_serve_charge= $row['tran_serve_charge'];
			}
			
				
			$final_amt=$inves_amt+$bill_amt+100;
			$nurscharge=round(($final_amt*15)/100);
			$invenur=$final_amt+$nurscharge;
			
	 $pay = $this->Common_model->get_data_by_query(" select tran_serve_charge from transaction_bill where tran_uhid=$uhid and tran_ipd_opd_id=$ipdopd_id"); 
	 
	
			
			$servcharge="";
         foreach($pay as $pa)
			{
				$p= $pa['tran_serve_charge'];
				if($p==1)
				{
				$servcharge=round(($invenur*13)/100);
				}
				else 
				{
				$servcharge=0;	
				}		
			}
			
			$final_amt=$invenur+$servcharge;
			
		     return $final_amt;
			
			}
		
		
		
		
		
		public function patient_discount($uhid,$ipdopd_id)
		{
			$query = $this->db->query("select sum(tran_final_discount) as amount from transaction_bill where tran_uhid=$uhid and tran_ipd_opd_id=$ipdopd_id");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				$dis_amt= $row['amount'];
			}
		     return $dis_amt;
		}
		
		
			
		public function Xray_Type($xrayid)
		{
			$query = $this->db->query("select xray_reason_code from xray_ratelist where xray_retid=$xrayid");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				$dis_amt= $row['xray_reason_code'];
			}
		     return $dis_amt;
		}
		
		public function UHIDGET($accno)
		{
			$query = $this->db->query("select uhid from patho_allot_test where patho_access_no=$accno");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				$uhid= $row['uhid'];
			}
		     return $uhid;
		}
			

			
			public function TotalBillRajivSir2($uhid ,$ipdid)
       {
		   
		   
	      $patdata['pdata']= $this->Common_model->get_data_by_query("select casu_scheme from casualty where casu_id=$ipdid");
	
		  $scheme=$patdata['pdata'][0]['casu_scheme'];
		  
		  
		  
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
                    return  0; 					 
					
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
			
			
			
			public function get_location_ward($uhid,$ipdid)
		{
		    $floor="";
			$ward="";
			$bed="";
			$query = $this->db->query("select admit_hide,admit_floor,admit_exitdt,admit_status, r.r_name as floorn, rr.r_name as wardn, rrr.r_short_name as bedn, admit_ward,admit_bed from ipd_admit a 
			left join resource r on r.r_id=a.admit_floor 
			left join resource rr on rr.r_id=a.admit_ward
			left join resource rrr on rrr.r_id=a.admit_bed
			where admit_id= ".$ipdid." and admit_uhid =".$uhid."");
			$row = $query->row_array();
			if ($query->num_rows() > 0) 
			{

				if($row['admit_status']=='DISCHARGED')
					{
						return '<span>DISCHARGED ON '.date('d-m-Y H:i:s',strtotime($row['admit_exitdt'])).'</span> ' ;
					}
					elseif($row['admit_hide']==0 )
					{  
						return '<span >Discharged from Ward</span>' ;
					}
					else
					{
					$floor= $row['floorn'];
					$ward= $row['wardn'];
					$bed= $row['bedn'];
					return ucwords(strtolower($ward));
					}
			}
			
		}
		
		public function bplBill_allIpd($uhid)
		{
			
			$data['bill'] = $this->Common_model->get_data_by_query("SELECT sum(`bpl_total`) as total from bpl_patient where uhid='$uhid' and bpl_bill='yes'");
			
			
			return $data['bill'][0]['total'] ;
			 
		}
		
		
		public function totalemployee($dep,$desig)
		{
			$data['totalemp'] = $this->Common_model->get_data_by_query("SELECT count(*) as total from employee where emp_desig='$desig' and emp_dep='$dep'");
			
			
			return $data['totalemp'][0]['total'] ;
		}
		
		
		public function totalreqemp($dep)
		{
			$totalemp= $this->Common_model->get_data_by_query("SELECT * from hr_manpower_plan where mnpwr_deptment='$dep'");
			
			$mnpwr_reqemp=0;
			foreach($totalemp as $ft)
			{
				$mnpwr_reqemp=$mnpwr_reqemp+$ft['mnpwr_req_emp'];
			}
			
			return $mnpwr_reqemp;
		}
		
		
		public function totalreqempdesig($dep,$desig)
		{
			$totalemp= $this->Common_model->get_data_by_query("SELECT * from hr_manpower_plan where mnpwr_deptment='$dep' and mnpwr_designation='$desig'");
			
			$mnpwr_reqempdesig=0;
			foreach($totalemp as $ft)
			{
				$mnpwr_reqempdesig=$mnpwr_reqempdesig+$ft['mnpwr_req_emp'];
			}
			
			return $mnpwr_reqempdesig;
		}
		
			
			// public function TotalBillRajivSir($uhid ,$ipdid)
       // {
		   
		   
	      // $patdata['pdata']= $this->Common_model->get_data_by_query("select casu_scheme from casualty where casu_id=$ipdid");
	
		  // $scheme=$patdata['pdata'][0]['casu_scheme'];
		  
		  
		  
		    // if($scheme==2 || $scheme==3 || $scheme==10 )
			// {
		    // $bplidata['idbpl'] = $this->Common_model->get_data_by_query(" select id,bpl_bill from bpl_patient where bpl_ipd_id=$ipdid and uhid=$uhid");
		   
		    // $bplid= $bplidata['idbpl'][0]['id'] ;
		    // $billprepared= $bplidata['idbpl'][0]['bpl_bill'] ;
			
			
		     // $data['medicine'] = $this->Common_model->get_data_by_query("select sum(bpl_bill_amount) as totalmedi from bpl_bill where  bpl_bill_uhid=$uhid and bpl_bill_bpl_id=$bplid and bpl_bill_type='Medicine'");
		   
		   // $query= $this->db->query("SELECT sum(bpl_bill_amount) as total FROM bpl_bill WHERE bpl_bill_uhid=$uhid and bpl_bill_bpl_id=$bplid " );
		 
	 // if ($query->num_rows() > 0)
				// {
					// $row = $query->row(); 
			
					 // $data['Billtotal']=$balance=$row->total;
				// }
		   
		   		   
		      // $data['investitotal'] = $this->Common_model->get_data_by_query("select sum(tran_amount) as totalinvest from transaction where tran_uhid=$uhid and tran_ipd_opd_id=$ipdid and (tran_department='X-Ray' or tran_department='Pathology' or tran_department='CT-scan'  or tran_department='USG' or tran_servic like 'MRI%') and tran_cghs_del_status=1");
		   
				 // $query2= $this->db->query("SELECT sum(bpl_bill_amount) as total2 FROM bpl_bill WHERE bpl_bill_uhid=$uhid");
		 
	 // if ($query2->num_rows() > 0)
				// {
					// $row = $query2->row(); 
			
					  // $data['BilltotalExpence']=$balance=$row->total2;
			
				// }
				 // if ($data['BilltotalExpence'] =='')
				// {
				
			
					  // $data['BilltotalExpence']=0;
				// }	
				
				// $billtotal=$data['Billtotal']+$data['investitotal'][0]['totalinvest'] ;
			    
				// $investitotal=$data['investitotal'][0]['totalinvest'] ;
				// $toatalmedi=$data['medicine'][0]['totalmedi'] ;
				
				// if($billprepared=='yes')
				// {
				//echo $billtotal+((($billtotal-$investitotal-$toatalmedi)/100)*15); 	
				  // $billtotal+((($billtotal-$investitotal-$toatalmedi)/100)*15);; 	

	// if( $uhid=='3179' || $uhid=='3097' || $uhid=='2881' || $uhid=='3403' || $uhid=='3330' || $uhid=='3460'  || $uhid=='3782' || $uhid=='3294' || $uhid=='3248' || $uhid=='3188' || $uhid=='4120' || $uhid=='3338' || $uhid=='3937' || $uhid=='3479' || $uhid=='3251' || $uhid=='3377' || $uhid=='4097' || $uhid=='3661' || $uhid=='4135'|| $uhid=='4045'|| $uhid=='2939'|| $uhid=='3001'|| $uhid=='3867'|| $uhid=='4154'|| $uhid=='4383'|| $uhid=='4109'|| $uhid=='3250'|| $uhid=='3830'|| $uhid=='3462'|| $uhid=='3971'|| $uhid=='3808'|| $uhid=='3224'|| $uhid=='3037'|| $uhid=='3876'|| $uhid=='3113'|| $uhid=='3021'|| $uhid=='3060' )
				 // {
										 
										  // return $billtotal+((($billtotal)/100)*15); 
									 // }
									 // else{
									   // return $billtotal+((($billtotal-$investitotal-$toatalmedi)/100)*15); 
									 // }
				
				// }
				// else{
					
				//	echo 'Bill Not Prepared'; 
                    // return  'Bill Not Prepared'; 					 
					
				// }
				
				// }
				// elseif($scheme==4 || $scheme==5 || $scheme==6 || $scheme==7 || $scheme==8 || $scheme==9 )
				
				// {    
				
				
				// $data['patientDetail'] = $this->Common_model->get_data_by_query("SELECT cghs_pack_billing from cghs_patient where uhid=$uhid and cghs_opdipd_id=$ipdid ");
				
				// $packbill= @$data["patientDetail"][0]["cghs_pack_billing"];
				
				
				  // if($packbill=='No')
		  // {
			  // $billcghs['cghsbill'] = $this->Common_model->get_data_by_query("SELECT sum(`cghs_tran_amount`) as total2 FROM cghs_transaction WHERE `cghs_tran_uhid`=$uhid and `cghs_tran_ipd_opd_id`=$ipdid and `cghs_tran_cghs_del_status`=1 ");
		  // }

           // else
		  // {
			  // $billcghs['cghsbill'] = $this->Common_model->get_data_by_query("SELECT sum(`cghs_tran_amount`) as total2 FROM cghs_transaction WHERE `cghs_tran_uhid`=$uhid and `cghs_tran_ipd_opd_id`=$ipdid and `cghs_tran_cghs_del_status`=1 and cghs_tran_department='Package' ");
		  // }


		  
				//	echo  $billcghs['cghsbill'][0]['total2'];
					// return   $billcghs['cghsbill'][0]['total2'];
					
				// }
				
				
				
           // }
			
			
			
			
		public function getFinal_summary_amt($date)
	{
		
	
		$data['allcash']=$this->Common_model->get_data_by_query("select  												t.tran_amount,t.tran_uhid,t.tran_cash_no,p.first_name,u.username,t.tran_ipd_opd_id,t.tran_refunddt,p.middle_name,t.tran_paymentdt,t.tran_opd_ipd_cas,t.tran_paidstatus,t.tran_id,t.tran_department,
			t.tran_servic,p.last_name,p.fa_hus_name,p.scheme,
			t.tran_entrydt,t.tran_discount,t.tran_refunddtatus from transaction t 
			left join patient p on p.id=t.tran_uhid
			left join users u on u.id=t.tran_user where t.tran_paidstatus='Yes' and date_format(tran_paymentdt,'%Y-%m-%d') ='$date' order by t.tran_cash_no " );
			//echo $this->db->last_query();
			//die;
			
			$receiveamt=0;
			$discinv=0;
			foreach($data['allcash'] as $ft)
							{
							$receiveamt+=$ft['tran_amount'];
							$discinv +=$ft['tran_discount'];
							}
			
			
			$data['refundinvv'] =$this->Common_model->get_data_by_query("select  tr.tran_cash_no,p.first_name,p.middle_name,p.last_name,
			tr.tran_ipd_opd_id,t.ref_dept,tr.tran_servic,tr.tran_uhid,t.ref_amount,t.ref_entrydt,u.username from refund_investigation  t 
			left join patient p on p.id=t.ref_uhid
			left join users u on u.id=t.ref_user
			left join transaction tr on tr.tran_id =t.ref_allot_test_id
			where
			date_format(ref_entrydt,'%Y-%m-%d')= '$date'");
			
			
			            $refdinv=0;
                        foreach($data['refundinvv'] as $refinv)
                        {  
						$refdinv+=$refinv['ref_amount'] ;
			            }
			//echo $this->db->last_query();
			//die;
			$data['refundcash'] =$this->Common_model->get_data_by_query("select  r.refund_uhid,r.refund_amount,r.refund_ipdopd_id,r.refund_remark,r.refund_entrydt,u.username,p.first_name,p.middle_name,p.last_name from refund_amount  r 
			left join patient p on p.id=r.refund_uhid 
			left join users u on u.id=r.refund_user
			where
			date_format(refund_entrydt,'%Y-%m-%d')='$date'");
			
			
			            $cashrefd=0;
                        foreach($data['refundcash'] as $refcash)
                        {  
						$cashrefd+=$refcash['refund_amount'] ;
			            }
			
			$data['billadv'] =$this->Common_model->get_data_by_query("select  s.topup_uhid,s.topup_id,s.topup_ipd_opd_id,s.topup_amtinwords,
			s.topup_amount,s.topup_entrodt,u.username,p.first_name,p.middle_name,p.last_name from smcard_topup s 
			left join patient p on p.id=s.topup_uhid 
			left join users u on u.id=s.topup_user
			where 0=0
			and topup_type in(1,2) and date_format(topup_entrodt,'%Y-%m-%d')= '$date'");
			
			
			                $billadvamt=0;
							foreach($data['billadv'] as $billadv)
							{
							$billadvamt+=$billadv['topup_amount'];
	                        }
		
		
		            $totalcash=($receiveamt+$billadvamt)-($refdinv+$cashrefd+$discinv);
		
	    return $totalcash ;
		
	}
			
			
			
			
			public function get_voucher_amt($date)
	       {
		
			$data['voucher'] =$this->Common_model->get_data_by_query("select voch_amount from account_voucher where date_format(voch_date,'%Y-%m-%d')= '$date'");
			
			                $vamt=0;
							foreach($data['voucher'] as $ft)
							{
							$vamt+=$ft['voch_amount'];
	                        }
	        return $vamt;
	       } 
		   public function get_bank_amt($date)
	       {
		
			$data['voucher'] =$this->Common_model->get_data_by_query("select sum(st_amount) as totsm from bank_statement_cash where date_format(st_date,'%Y-%m-%d')= '$date'");
			
			                $vamt=0;
							foreach($data['voucher'] as $ft)
							{
							$vamt=$ft['totsm'];
	                        }
	        return $vamt;
	       } 
			
			public function getmsg_ot($ipdid)
	       {
		
			$data['ot'] =$this->Common_model->get_data_by_query("select * from ot o left join casualty c on c.casu_id=o.ot_ipdid_cathid where ot_ipdid_cathid= '$ipdid' and ot_status =1 ");
			
			              $name="";
							foreach($data['ot'] as $ft)
							{
							$name=$ft['casu_fname']." ".$ft['casu_mname']." ".$ft['casu_lname'];
	                        }
			
	        return $name;
	       }

		   public function getsurgery_type($surgerytype_id)
	       {
		
			$data['type'] =$this->Common_model->get_data_by_query("select * from manage_surgery where surgery_id=$surgerytype_id");
			
			              $surgery_name="";
							foreach($data['type'] as $ft)
							{
							$surgery_name=$ft['surgery_name'];
	                        }
			
	        return $surgery_name;
	       } 

		   public function getsurgery_name($surge_id)
	       {
			if($surge_id !=''){
			$anitbiotic = explode(',', $surge_id);
			$a = '';
			$surgen_name='';
			$sl = 0;
			foreach($anitbiotic as $anti)
			{
				$sl++;
				$data['type'] =$this->Common_model->get_data_by_query("select * from surgery_master where msur_id=$anti");
				$surgen_name .= $sl." ) ".$data['type'][0]['msur_name'].'<br><br>';
			}
		   }
		   else{
			   $surgen_name = '';
		   }
			
			
		
	        return $surgen_name;
	       } 
			
			
			public function get_bplamount($id)
	       {
		
			$data['voucher'] =$this->Common_model->get_data_by_query("select sum(bste_amount) as total_set from bank_statement_bpl where statement_id=$id");
			
			                $vamt=0;
							foreach($data['voucher'] as $ft)
							{
							$vamt=$ft['total_set'];
	                        }
	        return $vamt;
	       } 
		   
		   public function get_bplamountuns($id)
	       {
		
			$data['voucher'] =$this->Common_model->get_data_by_query("select sum(banknew_amount) as total_set from bank_statement_new where banknew_id=$id");
			
			                $vamt=0;
							foreach($data['voucher'] as $ft)
							{
							$vamt=$ft['total_set'];
	                        }
	        return $vamt;
	       } 
		   public function get_meeting_meb($arr1)
	       {
			$emp_name = '';
			$myArray  = explode(',', $arr1);
			foreach($myArray AS $ft)
			{
				$emp_name .= $this->Crud_model->Ename($ft).',';
			}
			return substr($emp_name,0,-1);
	       } 
		   
		   
		   public function GetDepName($depid)
		{
			$query = $this->db->query("SELECT dep_name FROM department WHERE dep_id='$depid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['dep_name'];
			} else {
			}
		}
		
		public function GetDesigName($desigid)
		{
			$query = $this->db->query("SELECT desig_name FROM designation WHERE desig_id='$desigid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['desig_name'];
			} else {
			}
		}
		
		
		public function getuhid($ipd)
		{
			$query = $this->db->query("SELECT admit_uhid FROM ipd_admit WHERE admit_id='$ipd' group by admit_uhid");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['admit_uhid'];
			} else {
			}
		}
		
		
		public function getcasuuhid($ipd)
		{
			$query = $this->db->query("SELECT casu_uhid FROM casualty WHERE casu_id='$ipd' group by casu_uhid");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['casu_uhid'];
			} else {
			}
		}
		
		public function getpatientbedno($uhid,$ipd)
		{
			$query = $this->db->query("SELECT admit_bed FROM ipd_admit WHERE admit_id='$ipd' and admit_uhid='$uhid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['admit_bed'];
			} else {
			}
		}
		
		
		public function getptnamefromusr($empid)
		{
			$query = $this->db->query("SELECT first_name,last_name FROM users WHERE emp_id='$empid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return ucfirst($row['first_name'])." ".ucfirst($row['last_name']);
			} else {
			}
		}
		
		
		public function getnamefromusr($userid)
		{
			$query = $this->db->query("SELECT first_name,last_name FROM users WHERE id='$userid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return ucfirst($row['first_name'])." ".ucfirst($row['last_name']);
			} else {
			}
		}
		
		
		public function getWardName($wardid)
		{
			$query = $this->db->query("SELECT r_name  FROM resource WHERE r_id='$wardid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['r_name'];
			} else {
			}
		}
		
		
		public function getPtname($uhid)
		{
			$query = $this->db->query("SELECT first_name,middle_name,last_name FROM patient WHERE id='$uhid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['first_name']." ".$row['middle_name']." ".$row['last_name'];
			} else {
			}
		}
		
		public function xrayCriReas($crit_id)
		{
			$query = $this->db->query("SELECT crit_reason FROM xray_criti_reason WHERE crit_id='$crit_id'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['crit_reason'];
			} else {
			}
		}
		
		public function getEmpPhone($empid)
		{
			$query = $this->db->query("SELECT emp_phone1 FROM employee WHERE emp_id='$empid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['emp_phone1'];
			} else {
			}
		}
		
		public function Sendsmsusgcri($ipdopd_id,$docid)
		{
			$query = $this->db->query("select * from usg_cts u left join casualty c on c.casu_id=u.usgct_ipd_opd_id left join usg_master m on m.usg_id=u.usgct_testtype where usgct_ipd_opd_id=$ipdopd_id order by usgct_id limit 1");
			
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				$uhid= $row['usgct_uhid'];
				$ipdid= $row['usgct_ipd_opd_id'];
				$testname= $row['usg_test'];
				$remark= $row['critical_remark'];
				$Patient_name=$row['casu_fname']." ".$row['casu_mname']." ".$row['casu_lname'];
				$location=@$this->Crud_model->PLocation($row['usgct_uhid'],$row['usgct_ipd_opd_id']);
			}
			
			$query1 = $this->db->query("select * from doctor where id= $docid");
			$row1 = $query1->row_array();
			if ($query->num_rows() > 0) {
				$mob_no=$row1['dr_contact'];
				$mob_no1= "9630711711";//"9575300101";
				$mob_no2="9893942028";
				$mob_no3="9575300101";
				$mob_no4="9303021331";
				
			}
			
			$sendsms=" पेशेंट  ".$Patient_name." Reg No. ".$ipdid." और UHID No.".$uhid." की  ".$testname." रिपोर्ट क्रिटिकल है रीज़न  ".$remark." लोकेशन  ".$location." " ;
			
			
			$contact=$mob_no.",".$mob_no1.",".$mob_no2.",".$mob_no3.",".$mob_no4;
		                  
		                 $Curl_Session = curl_init('http://116.72.247.236/API/WebSMS/Http/v1.0a/index.php?');
                         curl_setopt ($Curl_Session, CURLOPT_POST, 1);
                         curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, "username=globaldnd&password=password&sender=METROH&to=$contact&message=$sendsms&reqid=1&format={json|text}&route_id=113&msgtype=unicode");
                         curl_setopt ($Curl_Session, CURLOPT_FOLLOWLOCATION, 1);
                         curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER,1);
                         $result=curl_exec ($Curl_Session);
		
		return $sendsms;
		}
		
		
		public function Sendsmsxraycri($ipdopd_id,$uhidd)
		{
			$query = $this->db->query("select * from xray_upload where xupload_opdipd_id=$ipdopd_id and xupload_uhid='$uhidd' order by xupload_id limit 1");
			
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				$uhid= $row['xupload_uhid'];
				$ipdid= $row['xupload_opdipd_id'];
				$testname= $row['xupload_xray_name'];
				$remark= $this->xrayCriReas($row['xupload_critical_remark']);
				$docname= $this->Ename($row['xupload_inti_to']);
				$docphone=$this->getEmpPhone($row['xupload_inti_to']);
				$Patient_name=$this->getPtname($uhid);
				$location=@$this->PLocation($uhid,$ipdid);
			}
			
			
				$mob_no="$docphone"; //$row1['dr_contact'];
				$mob_no1= "9575300101";
				$mob_no2= "8770066050";
				$mob_no3= "9893942028";
				
				
			
			$sendsms=" पेशेंट  ".$Patient_name." Reg No. ".$ipdid." और UHID No.".$uhid." की  ".$testname." रिपोर्ट क्रिटिकल है | रीज़न  ".$remark." है |  "." लोकेशन  ".$location." "  ;
			
			
			$contact=$mob_no.",".$mob_no1.",".$mob_no2.",".$mob_no3;
		                  
		                 $Curl_Session = curl_init('http://116.72.247.236/API/WebSMS/Http/v1.0a/index.php?');
                         curl_setopt ($Curl_Session, CURLOPT_POST, 1);
                         curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, "username=globaldnd&password=password&sender=METROH&to=$contact&message=$sendsms&reqid=1&format={json|text}&route_id=113&msgtype=unicode");
                         curl_setopt ($Curl_Session, CURLOPT_FOLLOWLOCATION, 1);
                         curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER,1);
                         $result=curl_exec ($Curl_Session);
		
		return $sendsms;
		}
		
		
		public function Sendsmspathrmk($id)
		{
			$query = $this->db->query("select * from patho_allot_test pt left join patho_test pts on pts.ptestsub_id=pt.test_name where id='$id' order by id limit 1");
			
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				$uhid= $row['uhid'];
				$ipdid= $row['patho_ipdopd_id'];
				$testcode= $row['ptest_code'];
				$remark= $row['critical_remark'];
				$docname= $this->getDocName($row['inti_to']);
				$docphone=$this->getDocphone($row['inti_to']);
				$Patient_name=$this->getPtname($uhid);
				$location=@$this->PLocation($uhid,$ipdid);
			}
			
			
				//$mob_no="$docphone"; //$row1['dr_contact'];
				$mob_no1= "9893942028";
				$mob_no2= "9575300101";
				$mob_no3= "9806865588";
				$mob_no4= "$docphone";
			
			$sendsms=" CRITICAL TEST REPORT : \nPatient Name:  ".ucwords(strtolower($Patient_name))." \nReg No.: ".$ipdid." \n".$remark.". \nLocation: ".$location." \n".$docname." has been informed " ;
			
			
			$contact=$mob_no1.",".$mob_no2.",".$mob_no3.",".$mob_no4.",".$mob_no5;
		                  
		                 $Curl_Session = curl_init('http://116.72.247.236/API/WebSMS/Http/v1.0a/index.php?');
                         curl_setopt ($Curl_Session, CURLOPT_POST, 1);
                         curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, "username=globaldnd&password=password&sender=METROH&to=$contact&message=$sendsms&reqid=1&format={json|text}&route_id=113&msgtype=unicode");
                         curl_setopt ($Curl_Session, CURLOPT_FOLLOWLOCATION, 1);
                         curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER,1);
                         $result=curl_exec ($Curl_Session);
		
		return $sendsms;
		}
		
		
		public function getDocName($docid)
		{
			$query = $this->db->query("SELECT doc_name FROM doctor WHERE id='$docid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['doc_name'];
			} else {
			}
		}
		
		
		public function getDocphone($docid)
		{
			$query = $this->db->query("SELECT dr_contact FROM doctor WHERE id='$docid'");
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['dr_contact'];
			} else {
			}
		}
		
		
		
		public function Sendsmspat_balance($ipdid)
		{
			$query = $this->db->query("select * from ipd_admit where admit_id='$ipdid' order by admit_id limit 1");
			
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				$uhid= $row['admit_uhid'];
				$ipdid= $row['admit_id'];
				$gatepass= $row['admit_gatepass_remark'];
				$Patient_name=$this->getPtname($uhid);
				
			}
			
			
				//$mob_no="$docphone"; //$row1['dr_contact'];
				$mob_no1= "9893942028";
				$mob_no2= "9575300101";
				$mob_no3= "7869518767";
				$mob_no4= "9425157636";
				$mob_no5= "9303021331";
				
				
				
				
			
			$sendsms=" BALANCE: \n Patient  ".ucwords(strtolower($Patient_name))." Reg No. ".$ipdid." Gate-pass Remark ".$gatepass." ".date('d-M-Y H:i:s')." " ;
			
			
			$contact=$mob_no1.",".$mob_no2.",".$mob_no3.",".$mob_no4.",".$mob_no5;
		                  
		                 $Curl_Session = curl_init('http://login.heightsconsultancy.com/API/WebSMS/Http/v1.0a/index.php?');
                         curl_setopt ($Curl_Session, CURLOPT_POST, 1);
                         curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, "username=globaldnd&password=password&sender=METROH&to=$contact&message=$sendsms&reqid=1&format={json|text}&route_id=113&msgtype=unicode");
                         curl_setopt ($Curl_Session, CURLOPT_FOLLOWLOCATION, 1);
                         curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER,1);
                         $result=curl_exec ($Curl_Session);
		
		return $sendsms;
		}
		
		
		public function get_bplamount_Settled($uhid)
	       {
			    $vamt=0;
			$data['getSettled'] =$this->Common_model->get_data_by_query("select sum(bste_amount) as total_set from bank_statement_bpl where bste_uhid=$uhid");
			     
				foreach($data['getSettled'] as $ft)
				{
				   $vamt=$ft['total_set'];
	            }
				if($vamt=="")
				{
					$vamt=0;
				}
	       return $vamt;
	       }
		   
		   
		   public function check_fileRec_dis($uhid,$ipdid)
	       {
			   $dd=$this->Common_model->get_data_by_query("select * from discharge_status where disstatus_regno='$ipdid' and disstatus_uhid ='$uhid'");
			
			
			if($dd!=null)
			{
			$idd=$dd[0]['disstatus_id'] ;
			$data11['received_file']=1;
			$data11['received_file_entrydt']=date("Y-m-d H:i:s");
			$this->Crud_model->edit_record_by_anyid('discharge_status',$idd,$data11,'disstatus_id');
			}
			else{
			$data11['disstatus_regno']=$ipdid;
			$data11['disstatus_uhid']=$uhid;
		    $data11['received_file']=1;
			$data11['received_file_entrydt']=date("Y-m-d H:i:s");
			$data11['disstatus_entrydt']=date("Y-m-d H:i:s");
			$this->Crud_model->insert_record('discharge_status',$data11);

			}
			
	       }
        public function cash_noc_insert($uhid,$ipdid)
	       {
			   $dd=$this->Common_model->get_data_by_query("select * from discharge_status where disstatus_regno='$ipdid' and disstatus_uhid ='$uhid'");
			
			
			if($dd!=null)
			{
			$idd=$dd[0]['disstatus_id'] ;
			$data11['cash_noc']=1;
			$data11['cash_noc_entrydt']=date("Y-m-d H:i:s");
			$this->Crud_model->edit_record_by_anyid('discharge_status',$idd,$data11,'disstatus_id');
			}
			else{
			$data11['disstatus_regno']=$ipdid;
			$data11['disstatus_uhid']=$uhid;
		    $data11['cash_noc']=1;
			$data11['cash_noc_entrydt']=date("Y-m-d H:i:s");
			$data11['disstatus_entrydt']=date("Y-m-d H:i:s");
			$this->Crud_model->insert_record('discharge_status',$data11);

			}
			
	       }
		   public function phar_noc_insert($uhid,$ipdid)
	       {
			   $dd=$this->Common_model->get_data_by_query("select * from discharge_status where disstatus_regno='$ipdid' and disstatus_uhid ='$uhid'");
			
			
			if($dd!=null)
			{
			$idd=$dd[0]['disstatus_id'] ;
			$data11['phar_status']=1;
			$data11['phar_entrydt']=date("Y-m-d H:i:s");
			$this->Crud_model->edit_record_by_anyid('discharge_status',$idd,$data11,'disstatus_id');
			}
			else{
			$data11['disstatus_regno']=$ipdid;
			$data11['disstatus_uhid']=$uhid;
		    $data11['phar_status']=1;
			$data11['phar_entrydt']=date("Y-m-d H:i:s");
			$data11['disstatus_entrydt']=date("Y-m-d H:i:s");
			$this->Crud_model->insert_record('discharge_status',$data11);

			}
			
	       } 
		   
		   public function file_nanover_insert($uhid,$ipdid)
	       {
			   $dd=$this->Common_model->get_data_by_query("select * from discharge_status where disstatus_regno='$ipdid' and disstatus_uhid ='$uhid'");
			
			
			if($dd!=null)
			{
			$idd=$dd[0]['disstatus_id'] ;
			$data11['file_hanover']=1;
			$data11['fileh_entrydt']=date("Y-m-d H:i:s");
			$this->Crud_model->edit_record_by_anyid('discharge_status',$idd,$data11,'disstatus_id');
			}
			else{
			$data11['disstatus_regno']=$ipdid;
			$data11['disstatus_uhid']=$uhid;
		    $data11['file_hanover']=1;
			$data11['fileh_entrydt']=date("Y-m-d H:i:s");
			$data11['disstatus_entrydt']=date("Y-m-d H:i:s");
			$this->Crud_model->insert_record('discharge_status',$data11);

			}
			
	       }
		   public function counselling_insert($uhid,$ipdid)
	       {
			   $dd=$this->Common_model->get_data_by_query("select * from discharge_status where disstatus_regno='$ipdid' and disstatus_uhid ='$uhid'");
			
			
			if($dd!=null)
			{
			$idd=$dd[0]['disstatus_id'] ;
			$data11['cons_status']=1;
			$data11['cons_entrydt']=date("Y-m-d H:i:s");
			$this->Crud_model->edit_record_by_anyid('discharge_status',$idd,$data11,'disstatus_id');
			}
			else{
			$data11['disstatus_regno']=$ipdid;
			$data11['disstatus_uhid']=$uhid;
		    $data11['cons_status']=1;
			$data11['cons_entrydt']=date("Y-m-d H:i:s");
			$data11['disstatus_entrydt']=date("Y-m-d H:i:s");
			$this->Crud_model->insert_record('discharge_status',$data11);

			}
			
	       }

		
		public function TotalAdvAmt($uhid)
		{
			$query = $this->db->query("select sum(topup_amount) as amount from smcard_topup where topup_uhid=$uhid");
			$row = $query->row_array();
	
			
			if ($query->num_rows() > 0) {
				$AdvAmt= $row['amount'];
			}
		    
			if($AdvAmt=='')
			{
				$AdvAmt=0;	
			}
			
		     return $AdvAmt;
		}
		
		
		public function SendSmsFinancial($ipdid)
		{
			$query = $this->db->query("select * from daily_financial d left join casualty c on c.casu_id=d.dfinan_regno where dfinan_regno='$ipdid' order by dfinan_id limit 1");
			
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				
				$ipdid= $row['dfinan_regno'];
				$uhid= $row['casu_uhid'];
				$mob_no= $row['dfinan_relation_mob'];
				$dfinan_adv_slip= $row['dfinan_adv_slip'];
				$dfinan_comm= $row['dfinan_comm'];
				$dfinan_cdate= $row['dfinan_cdate'];
				$Patient_name=$this->getPtname($uhid);
				
			}
			
			$sendsms=" पेशेंट नाम  ".ucwords(strtolower($Patient_name))." रजि . नं  . ".$ipdid." बकाया राशि ".$dfinan_adv_slip." रुपे  जमा करने के लिए बोला गया है जो कि हम  ".$dfinan_comm." कमिटमेंट दिनांक ".date('d-M-y',strtotime($dfinan_cdate))." " ;
			
			
			$contact=$mob_no;
		                  
		                 $Curl_Session = curl_init('http://login.heightsconsultancy.com/API/WebSMS/Http/v1.0a/index.php?');
                         curl_setopt ($Curl_Session, CURLOPT_POST, 1);
                         curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, "username=globaldnd&password=password&sender=METROH&to=$contact&message=$sendsms&reqid=1&format={json|text}&route_id=113&msgtype=unicode");
                         curl_setopt ($Curl_Session, CURLOPT_FOLLOWLOCATION, 1);
                         curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER,1);
                         $result=curl_exec ($Curl_Session);
		
		return $sendsms;
		}


public function banknamybyacc($accno)
		{
			$query = $this->db->query("select bacc_name from acc_bankacc_master where bacc_acc=$accno");
			// echo $this->db->last_query();
			// die;
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				return $row['bacc_name'];
			} else {
			}
		}
  public function GetLimitAmount($uhid,$type)
		     {
			$query = $this->db->query("select sum(limit_medi_amt) as medi,sum(limit_inv_amt) as investi,limit_hos_amt as hospital from set_limit where limit_uhid=$uhid  order by limit_id desc limit 1");
		
			$row = $query->row_array();
			if ($query->num_rows() > 0) {
				
				if($type=='medi')
				{
				    return $row['medi'];	
				}elseif($type=='investi')
				{
					return $row['investi'];
				}elseif($type=='hospital')
				{
				    return $row['hospital'];	
				}
				elseif($type=='total')
				{
				    return $row['hospital']+$row['investi']+$row['medi'];	
				}
				
				else
				{
				    return "0";	
				}
				
			   } else {
				return "0";
			    }
		}

		   
		   
		
		
		
		
    }

?>
