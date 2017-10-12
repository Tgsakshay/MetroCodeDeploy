<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div id="portlet-config" class="modal hide">
				<div class="modal-header">
					<button data-dismiss="modal" class="close" type="button"></button>
					<h3>portlet Settings</h3>
				</div>
				<div class="modal-body">
					<p>Here will be a configuration form</p>
				</div>
			</div>
			<style>
			.focus {
					border: 2px solid #AA88FF;
					background-color: #FFEEAA;
				}
			</style>
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE CONTAINER-->
			<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->   
				<div class="row-fluid">
					
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="row-fluid">
					<div class="span12">
						<div class="tabbable tabbable-custom boxless">
							
							<div class="tab-content">
								<div class="tab-pane active" id="tab_1">
									<div class="portlet box blue">
										<div class="portlet-title">
											<div class="caption"> Page Two</div>
											<div class="tools">
												<a href="javascript:;" class="collapse"></a>
											
												<a href="javascript:;" class="reload"></a>
												
											</div>
										</div>
										<div class="portlet-body form">
								
											<!-- BEGIN FORM-->
											<form method='post'  action="<?php echo base_url('admin/FREG0006/patientReg'); ?>" class="horizontal-form" id='frm'>
											
												<div class="row-fluid">
												    <div class="span3 ">
													    <div class="control-group">
															<label class="control-label" for="firstName">Patient First Name</label>
															<div class="controls">
																<input type="text" id="first_name" name='first_name' class="m-wrap span12" placeholder="Enter Patient First Name"  title="First Name"required">
															
															</div>
														</div>
														
														<div class="control-group">
															<label class="control-label" for="firstName">Patient Middle Name</label>
															<div class="controls">
																<input type="text" id="middle_name" name='middle_name' class="m-wrap span12" placeholder="Enter Patient Middle Name" >
														
															</div>
														</div>
														<div class="control-group">
															<label class="control-label" for="firstName">Patient Last Name</label>
															<div class="controls">
																<input type="text" id="last_name" name='last_name' class="m-wrap span12"  placeholder="Enter Patient Last Name" >
														
															</div>
														</div>
													    <div class="control-group">
															<label class="control-label" for="firstName"> Father/Husband name </label>
															<div class="controls">
															  <select id="son_or_wife" name="son_or_wife" class="m-wrap span3" required>
                                                                  <option value="S/O">S/O</option>
                                                                  <option value="W/O">W/O</option>
                                                                  <option value="D/O">D/O</option>
                                                                  <option value="C/O">C/O</option>
                              
                                                               </select>
																<input type="text" id="fa_hus_name" name='fa_hus_name'  class="m-wrap span9" placeholder="Enter Patient Father/Husband name " required>
													
															</div>
														</div>
														 <div class="control-group">
															<label class="control-label" for="firstName">Patient Gender </label>
															<div class="controls">
																<select  id="patient_gender" name='patient_gender'  class="m-wrap span12">
																	<option value="Male">Male</option>
																	<option value="Female">Female</option>
																</select>
															</div>
														  </div>
														  
														  <div class="control-group">
															<label class="control-label" for="firstName">Age of Patient </label>
															<div class="controls">
																<input type="number" id="patient_age" name='patient_age'  class="m-wrap span8" placeholder="Enter Age of Patient ">
																<select id="age_unit" name="age_unit" class="m-wrap span4" required>
                                                                  <option value="year">Year</option>
                                                                  <option value="month">Month</option>
                                                                  <option value="days">Days</option>
                                                                  <option value="hours">Hours</option>
                              
                                                               </select>
													
															</div>
															
														  </div>
														   
												    </div>
													<div class="span3 ">
													   
													    <div class="control-group">
															<label class="control-label" for="firstName">State</label>
															<div class="controls">
																
																<select id="state" name='state' onchange='selectState(this.value),filladdresss("state");' class="m-wrap span12">
																	  <?php
								                                                 
					                                                          foreach ($state as $key=>$value)
					                                                           {
					                                                         	   if($value['state_id']=='24') 
					                                                         		   {
					                                                         			   $abc="selected";
					                                                         			}
					                                                         	   else
					                                                         			{
					                                                         			   $abc='';
					                                                         			}
					                                                         	  echo "<option value='".$value['state_id']. "' selected='$abc' >".$value['state_name']."</option>";
					                                                           }  
                                                                      
							                                          ?>
																</select>
															 
															</div>
														
														</div>
													
												<div id='other'>		
														<div class="control-group">
															<label class="control-label" for="firstName">District</label>
															<div class="controls">
																<select  id='district' name='district' onchange="selectdistrict(this.value),filladdresss('district');" class="m-wrap span12">
																	<option value="">Select District</option>
																	<?php foreach ($district as $key=>$value){
																	echo "<option value='".$value['id']. "'  >".$value['district']."</option>";
																	} ?>
																</select>
															</div>
														
														</div>
														<div class="control-group">
															<label class="control-label" for="firstName">Tehsil </label>
															<div class="controls">
																<select  onchange='selecttahsil(this.value),filladdresss("tahsil");' id="tahsil" name='tahsil'  class="m-wrap span12">
																	<option value="">Select Tehsil</option>
																</select>
														
															</div>
																
														</div>
													    <div class="control-group">
															<label class="control-label" for="firstName">Village Name</label>
															<div class="controls">
																<select id="village" name='village'  class="m-wrap span12" onchange="showvillage(this.value),filladdresss('village')">
																	<option value="">Select Village</option>
																</select>
															</div>
														</div>
												</div>
														
														<div class="control-group">
															<label class="control-label" for="firstName">Address </label>
															<div class="controls">
																
																<textarea id="address" style="font-size:12px" name='address' class="m-wrap span12" placeholder="Enter Address">
																</textarea>
													
															</div>
														</div>
														<div class="control-group">
															<!--<label class="control-label" for="firstName">Email </label>-->
															<div class="controls">
																<input type="email" id="email_id" name='email_id'  class="m-wrap span12" placeholder="Enter Email">
													
															</div>
														</div>
													
												    </div>
													<div class="span3 ">
													    <div class="control-group">
															<label class="control-label" for="firstName">Admitted By</label>
															<div class="controls">
																<input type="text" id="admited_by" name='admited_by'  class="m-wrap span12" placeholder="Enter Admited By">
															
															</div>
														</div>
														<div class="control-group">
															<label class="control-label" for="firstName">Relation with Patient</label>
															<div class="controls">
																<select name='relation_with_patient' id="middle_name" name='middle_name'  class="m-wrap span12">
                                                                      <option value="">Select</option>
											                          <option selected="selected" value="Daughter">Daughter</option>
											                          <option value="Son">Son</option>
											                          <option value="Spouse">Spouse</option>
											                          <option value="Father">Father</option>
											                          <option value="Mother">Mother</option>
											                          <option value="Brother">Brother</option>
											                          <option value="Freind">Freind</option>
											                          <option value="Others">Others</option>
											                          <option value="relative ">Relative </option>
											                          <option value="neighbour">Neighbour</option>
											                          <option value="Wife">Wife</option>
											                          <option value="Husband">Husband</option>
											                          <option value="Sister">Sister</option>
											                          <option value="Self">Self </option>
                                                                </select>
																
															</div>
														</div>
														<div class="control-group">
															<label class="control-label" for="firstName">Patient Contact No</label>
															<div class="controls">
																<input type="text" id="contact_no" name='contact_no'  class="m-wrap span12" placeholder="Enter Patient Contact">
														
															</div>
														</div>
													    <div class="control-group">
															<label class="control-label" for="firstName">Attender Contact No</label>
															<div class="controls">
																<input type="text" id="attender_contact" name='attender_contact'  class="m-wrap span12" placeholder="Enter Attender Contact No" >
													
															</div>
														</div>
														<div class="control-group">
															<label class="control-label" for="firstName">MLC CASE</label>
															<div class="controls">
																<select name='mlc_case' id="mlc_case"  class="m-wrap span12">
                                                                      <option value="No">No</option>
                                                                      <option value="Yes">Yes</option>
											                         
                                                                </select>
															</div>
														</div>
														<div class="control-group">
															<label class="control-label" for="firstName">Consultant</label>
															<div class="controls">
																<select name='consultant' id="consultant"  class="m-wrap span12">
																								    <?php
								                                      
					                                                        foreach ($doc_name as $key=>$value)
					                                                                              {
					                                                                                 ?>
                                                                      <option value="<?php echo $value['doc_name']?>@@@<?php echo $value['id']?>"> 
																	   <?php echo $string=substr($value['doc_name'],3); ; ?>
																      </option>
																								  <?php } ?>
											                         
                                                                </select>
															</div>
														</div>
															
														
														   
												    </div>
													 
													 
													 <div class="span3 ">
													 
													 <div class="control-group">
															 <label class="control-label" for="firstName">Adhaar Card </label> 
															<div class="controls">
																<input type="text" id="adhaar_card" name='adhaar_card'  class="m-wrap span12" placeholder="Enter Adhaar Card No">
													
															</div>
														</div>
														
													 </div>
												</div>
												
												<div class="row-fluid">
												    <div class="span3 ">
													<div class="control-group">
															<label class="control-label" for="firstName">Casualty Bed</label>
															<div class="controls">
																<select name='casul_bed' id="casul_bed"  class="m-wrap span12">
												
						
                                                  <option value="bed-1"> Bed 1 </option>
                                                  <option value="bed-2"> Bed 2 </option>
                                                  <option value="bed-3"> Bed 3 </option>
                                                  <option value="bed-4"> Bed 4 </option>
                                                  <option value="bed-5"> Bed 5 </option>
                                                  <option value="bed-6"> Bed 6 </option>
                                                  <option value="bed-7"> Bed 7 </option>
                                                  <option value="bed-8"> Bed 8 </option>
                                                  <option value="bed-9"> Bed 9 </option>
                                                  <option value="bed-10"> Bed 10 </option>
                                                  <option value="bed-11"> Bed 11 </option>
                                                                </select>
															</div>
														</div>
													
													</div>
													<div class="span3 ">
													<div class="control-group">
															<label class="control-label" for="firstName">Remark</label>
															<div class="controls">
																<input type="text" id="casu_remark" name='casu_remark'  class="m-wrap span12" placeholder="Enter Remark">
															</div>
														</div>
													
													</div>
													
													<div class="span3 ">
												<div class="control-group">
															<label class="control-label" for="firstName">Cancer Patient</label>
															<div class="controls">
																<select name='cancer' id="cancer"  class="m-wrap span12" required>
                                                                  	<option value="">Select Type</option>
                                                                      <option value="No">No</option>
                                                                      <option value="Yes">Yes</option>
											                         
                                                                </select>
															</div>
														</div>
													
													</div>
												</div>
													<h3 class="form-section">Select Scheme</h3>
												<div class="control-group">
													<label class="control-label"></label>
													<div class="controls">
														<label class="radio">
													
                                                    <button type="button" class="btn mini" style='background-color:#44DED8;' value='1' onclick='Getscheme(this.value)'>
										
														General
														</button> 
													
														</label>
														<label class="radio">
														
														<button type="button" class="btn mini" style='background-color:#44DED8;' value='2' onclick='Getscheme(this.value)'>
										
														BPL/DDY
														</button> 
														</label>  
														<label class="radio">
														
														<button type="button" class="btn mini" style='background-color:#44DED8;' value='11' onclick='Getscheme(this.value)'>
										
														General-BPL
														</button> 
														</label>  
														<label class="radio">
													    <button type="button" class="btn mini" style='background-color:#44DED8;' value='3' onclick='Getscheme(this.value)'>
										                MPBOC
														</button> 
														</label>  
														<label class="radio">
													    <button type="button" class="btn mini" style='background-color:#44DED8;' value='4' onclick='Getscheme(this.value)'>
										                CGHS
														</button> 
														</label> 
                                                        <label class="radio">
														<button type="button" class="btn mini" style='background-color:#44DED8;' value='5' onclick='Getscheme(this.value)'>
										                CSMA
														</button> 
														</label>  	
														<label class="radio">
														
														<button type="button" class="btn mini" style='background-color:#44DED8;' value='6' onclick='Getscheme(this.value)'>
										                ECHS
														</button> 
														</label> 		
                                                        <label class="radio">
													    <button type="button" class="btn mini" style='background-color:#44DED8;' value='7' onclick='Getscheme(this.value)'>
										                ESI
														</button> 
														</label> 	
                                                        <label class="radio">
														<button type="button" class="btn mini" style='background-color:#44DED8;' value='8' onclick='Getscheme(this.value)'>
										                BSNL
														</button> 
														</label> 	
                                                        <label class="radio">
														<button type="button" class="btn mini" style='background-color:#44DED8;' value='9' onclick='Getscheme(this.value)'>
										                Medi Claim
														</button> 
														</label>  
														<label class="radio">
														<button type="button" class="btn mini" style='background-color:#44DED8;' value='10' onclick='Getscheme(this.value)'>
										                RBSK
														</button> 
														</label> 
                                              <input type='hidden' id='scheme' name='scheme'>														
													</div>
												</div>
											
											
											 <div  id='bpl' class='hide' >
											
												<div class="row-fluid">
												
												     <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">Patient Category</label>
															<div class="controls">
																<select name='bplpatient_cat' id='bplpatient_cat' class="m-wrap span12">
                                                                     <option selected="selected" value="">Select Patient Category</option>
											                         <option  value="General">General</option>
											                         <option value="OBC">OBC</option>
											                         <option value="SC">SC</option>
											                         <option value="ST">ST</option>
											  
                                                               </select>
															</div>
														</div>
													  </div>
												      <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">Employment</label>
															<div class="controls">
																<input type="text" id="bplemployment" name='bplemployment' class="m-wrap span12" placeholder="Enter Patient Employment">
													
															</div>
														</div>
													  </div>
													  <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">Total Income of Family</label>
															<div class="controls">
																<input type="text" id="bplincome" name='bplincome' class="m-wrap span12" placeholder="Enter Total Income of Family">
													
															</div>
														</div>
													  </div>
												      <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">Card No</label>
															<div class="controls">
																<input type="text" id="bplcard_no" name='bplcard_no' class="m-wrap span12" placeholder="Enter Card No">
													
															</div>
														</div>
													  </div>
												</div>
												<div class="row-fluid">
												     <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">Card Holder Name</label>
															<div class="controls">
																<div class="controls">
																<input type="text" id="bplcardholdername" name='bplcardholdername' class="m-wrap span12" placeholder="Enter Card Holder Name">
															</div>
															</div>
														</div>
													  </div>
												     <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">PIN Code</label>
															<div class="controls">
																<div class="controls">
																<input type="text" id="bplpincode" name='bplpincode' class="m-wrap span12" placeholder="Enter PIN CODE NO">
															</div>
															</div>
														</div>
													  </div>
												      <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">Disease Category</label>
															<div class="controls">
																<select id="bpldisease_cat" name='bpldisease_cat' onchange='getDesease(this.value);' class="m-wrap span12">
                                                                      <option selected="selected" value="">Select Disease category</option>
                                                                       <?php
								                                                 
					                                                          foreach ($bpldisease as $key=>$value)
					                                                           {
					                                                         	  
					                                                         	  echo "<option value='".$value['Disease_catigory']. "' selected='$abc' >".$value['Disease_catigory']."</option>";
					                                                           }  
                                                                      
							                                        ?>
                                                                </select>
															</div>
														</div>
													  </div>
													   <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">Disease name </label>
															<div class="controls" >
																<select id="bpldis_name" name='bpldis_name' class="m-wrap span12">
                                                                      <option selected="selected" value="">Select Disease</option>

                                                                </select>
															</div>
														</div>
													  </div>
												     
												</div>
												</div>
												<div  id='mpboc' class='hide' >
											
												<div class="row-fluid">
												
												    
												      <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">MPBOC Card No</label>
															<div class="controls">
																<input type="text" id="mpboccard_no" name='mpboccard_no' class="m-wrap span12" placeholder="Enter Card No">
													
															</div>
														</div>
													  </div>
													  <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">Card Holder Name</label>
															<div class="controls">
																<div class="controls">
																<input type="text" id="mpboccardholdername" name='mpboccardholdername' class="m-wrap span12" placeholder="Enter Card Holder Name">
															</div>
															</div>
														</div>
													  </div>
													   <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">Disease Category</label>
															<div class="controls">
																<select id="mpbocdisease_cat" name='mpbocdisease_cat' onchange='mpbocgetDesease(this.value);' class="m-wrap span12">
                                                                      <option selected="selected" value="">Select Disease category</option>
                                                                       <?php
								                                                 
					                                                          foreach ($bpldisease as $key=>$value)
					                                                           {
					                                                         	  
					                                                         	  echo "<option value='".$value['Disease_catigory']. "' selected='$abc' >".$value['Disease_catigory']."</option>";
					                                                           }  
                                                                      
							                                        ?>
                                                                </select>
															</div>
														</div>
													  </div>
													  <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">Disease name </label>
															<div class="controls" >
																<select id="mpbocdis_name" name='mpbocdis_name' class="m-wrap span12">
                                                                      <option selected="selected" value="">Select Disease</option>

                                                                </select>
															</div>
														</div>
													  </div>
												</div>
												
												</div>
												<div  id='cghs' class='hide' >
											
												<div class="row-fluid">
												
												     <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">CGHS Card Holder Name</label>
															<div class="controls">
																<input type="text" id="cghscard_holder_name" name='cghscard_holder_name' class="m-wrap span12" placeholder="Enter CGHS Card Holder Name">
															</div>
														</div>
													  </div>
												      <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">CGHS Card Registration No</label>
															<div class="controls">
																<input type="text"  id="cghscard_no" name='cghscard_no'  class="m-wrap span12" placeholder="CGHS Card Registration No">
													
															</div>
														</div>
													  </div>
													  <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">Relation with patient </label>
															<div class="controls">
														
																<select id="cghscard_holder_relation" name='cghscard_holder_relation'  class="m-wrap span12">
                                                                      <option selected="selected" value="select">Select Card holder Relation with patient</option>
                                                                      <option value="Father" >Father</option>
                                                                      <option value="Mother" >Mother</option>
                                                                      <option value="Son" >Son</option>
                                                                      <option value="Daughter" >Daughter</option>
                                                                      <option value="Wife" >Wife</option>
                                                                      <option value="Self" >Self</option>
                                                                      <option value="Other" >Other</option>
													             </select>
															</div>
														</div>
													  </div>
												       <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">Case </label>
															<div class="controls">
																<select  onchange=''  id="case" name='case'  class="m-wrap span12">
																	<option value="select">Select Case</option>
																	<option value="Referral">Referral</option>
																	<option value="Emergency">Emergency</option>
																	
																</select>
															</div>
														</div>
													  </div>
												</div>
												<div class="row-fluid">
												
												     <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">Entitlement</label>
															<div class="controls">
																<select  onchange=''  id="entitilment" name='entitilment'  class="m-wrap span12">
																	<option value="select">Select Entitilment</option>
																	<option value="General">General</option>
																	<option value="Private">Private</option>
																	<option value="Semi Private">Semi Private</option>
																	
																</select>
															</div>
														</div>
													  </div>
												    
													     <div class="span3">
													    <div class="control-group" >
															<label class="control-label" for="firstName">Card Validity Data</label>
															<div class="controls">
														       <div class="input-append span10"  >
							                         <input type="text" name='validity' value='Life time' id='validity' class="span12 m-wrap" readonly="" size="16" value="">
													 <span class="add-on"><i class="icon-calendar"></i></span>
						                                        </div>
															</div>
														</div>
													     </div>
												</div>
												</div>
												<div  id='csma' class='hide' >
											
												<div class="row-fluid">
												
												     <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">CSMA Card Holder Name</label>
															<div class="controls">
																<input type="text" id="csmacard_holder_name" name='csmacard_holder_name' class="m-wrap span12" placeholder="Enter CSMA Card Holder Name">
															</div>
														</div>
													  </div>
												      <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">CSMA Card Registration No</label>
															<div class="controls">
																<input type="text"  id="csmacard_no" name='csmacard_no'  class="m-wrap span12" placeholder="CSMA Card Registration No">
													
															</div>
														</div>
													  </div>
													  <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName"> Relation with patient </label>
															<div class="controls">
															     <select id="csmacard_holder_relation" name='csmacard_holder_relation'  class="m-wrap span12">
                                                                      <option selected="selected" value="select">Select Card holder Relation with patient</option>
                                                                      <option value="Father" >Father</option>
                                                                      <option value="Mother" >Mother</option>
                                                                      <option value="Son" >Son</option>
                                                                      <option value="Daughter" >Daughter</option>
                                                                      <option value="Wife" >Wife</option>
                                                                      <option value="Self" >Self</option>
                                                                      <option value="Other" >Other</option>
													             </select>
																
													
															</div>
														</div>
													  </div>
												       <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">Case </label>
															<div class="controls">
																<select  onchange=''  id="csmacase" name='csmacase'  class="m-wrap span12">
																	<option value="select">Select Case</option>
																	<option value="Referral">Referral</option>
																	<option value="Emergency">Emergency</option>
																	
																</select>
															</div>
														</div>
													  </div>
												</div>
												<div class="row-fluid">
												
												     <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">Entitlement</label>
															<div class="controls">
																<select  onchange=''  id="csmaentitilment" name='csmaentitilment'  class="m-wrap span12">
																	<option value="select">Select Entitilment</option>
																	<option value="General">General</option>
																	<option value="Private">Private</option>
																	<option value="Semi Private">Semi Private</option>
																	
																</select>
															</div>
														</div>
													  </div>
												     
												</div>
												</div>
												<div  id='echs' class='hide' >
											<div class="row-fluid">
												
												     <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">ECHS Card Holder Name</label>
															<div class="controls">
																<input type="text" id="echscard_holder_name" name='echscard_holder_name' class="m-wrap span12" placeholder="Enter ECHS Card Holder Name">
															</div>
														</div>
													  </div>
												      <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">ECHS Card Registration No</label>
															<div class="controls">
																<input type="text"  id="echscard_no" name='echscard_no'  class="m-wrap span12" placeholder="ECHS Card Registration No">
													
															</div>
														</div>
													  </div>
													  <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">Relation with patient </label>
															<div class="controls">
															<select id="echscard_holder_relation" name="echscard_holder_relation" class="m-wrap span12" >
														
																	<option selected="selected" value="select">Select Card holder Relation with patient</option>
                                                                      <option value="Father">Father</option>
                                                                      <option value="Mother">Mother</option>
                                                                      <option value="Son">Son</option>
                                                                      <option value="Daughter">Daughter</option>
                                                                      <option value="Wife">Wife</option>
                                                                      <option value="Self">Self</option>
                                                                      <option value="Other">Other</option>
																
															</select>
														
													
															</div>
														</div>
													  </div>
												       <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">Case </label>
															<div class="controls">
																<select  onchange=''  id="echscase" name='echscase'  class="m-wrap span12">
																	<option value="select">Select Case</option>
																	<option value="Referral">Referral</option>
																	<option value="Emergency">Emergency</option>
																	
																</select>
															</div>
														</div>
													  </div>
												</div>
												<div class="row-fluid">
												
												     <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">Entitlement</label>
															<div class="controls">
																<select  onchange=''  id="echsentitilment" name='echsentitilment'  class="m-wrap span12">
																	<option value="select">Select Entitilment</option>
																	<option value="General">General</option>
																	<option value="Private">Private</option>
																	<option value="Semi Private">Semi Private</option>
																	
																</select>
															</div>
														</div>
													  </div>
												      <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">Card Validity</label>
															<div class="controls">
															
																<div class="input-append ">
							<input type="text" name='echsvalidity'  id='echsvalidityvalidity' class="span12 m-wrap date-picker" readonly="" size="16" value=""><span class="add-on"><i class="icon-calendar"></i></span>
						                                               </div>
															</div>
														</div>
													  </div>
												</div>
												</div>
												<div  id='esi' class='hide' >
											       <div class="row-fluid">
												
												     <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">ESI Card Holder Name</label>
															<div class="controls">
																<input type="text" id="esicard_holder_name" name='esicard_holder_name' class="m-wrap span12" placeholder="Enter ESI Card Holder Name">
															</div>
														</div>
													  </div>
												      <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">ESI Card Registration No</label>
															<div class="controls">
																<input type="text"  id="esicard_no" name='esicard_no'  class="m-wrap span12" placeholder="Enter ESI Card No">
													
															</div>
														</div>
													  </div>
													  <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName"> Relation with patient </label>
															<div class="controls">
															     <select id="esicard_holder_relation" name="esicard_holder_relation" class="m-wrap span12" >
														         
															     		<option selected="selected" value="select">Select Card holder Relation with patient</option>
                                                                           <option value="Father">Father</option>
                                                                           <option value="Mother">Mother</option>
                                                                           <option value="Son">Son</option>
                                                                           <option value="Daughter">Daughter</option>
                                                                           <option value="Wife">Wife</option>
                                                                           <option value="Self">Self</option>
                                                                           <option value="Other">Other</option>
															     	
															     </select>
														
													
															</div>
														</div>
													  </div>
												       <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">Case </label>
															<div class="controls">
																<select  onchange=''  id="esicase" name='esicase'  class="m-wrap span12">
																	<option value="select">Select Case</option>
																	<option value="Referral">Referral</option>
																	<option value="Emergency">Emergency</option>
																	
																</select>
															</div>
														</div>
													  </div>
												</div>
												<div class="row-fluid">
												
												     <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">Entitlement</label>
															<div class="controls">
																<select  onchange=''  id="esientitilment" name='esientitilment'  class="m-wrap span12">
																	<option value="select">Select Entitilment</option>
																	<option value="General">General</option>
																	<option value="Private">Private</option>
																	<option value="Semi Private">Semi Private</option>
																	<option value="Deluxe Private">Deluxe Private</option>
																	
																</select>
															</div>
														</div>
													  </div>
												      <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">Card Validity</label>
															<div class="controls">
																
																<div class="input-append " >
							<input type="text" name='esivalidity' id='esivalidity' class="span12 m-wrap date-picker" readonly="" size="16" value=""><span class="add-on"><i class="icon-calendar"></i></span>
						                                               </div>
															</div>
														</div>
													  </div>
												</div>
											    </div>
												<div  id='bsnl' class='hide'>
											
												<div class="row-fluid">
												
												     <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">BSNL Card Holder Name</label>
															<div class="controls">
																<input type="text" id="bsnlcard_holder_name" name='bsnlcard_holder_name' class="m-wrap span12" placeholder="Enter BSNL Card Holder Name">
															</div>
														</div>
													  </div>
												      <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">BSNL Card Registration No</label>
															<div class="controls">
																<input type="text" id="bsnlcard_no" name='bsnlcard_no' class="m-wrap span12" placeholder="Enter BSNL Card Registration No">
													
															</div>
														</div>
													  </div>
													  <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">Relation with patient </label>
															<div class="controls">
															<select id="bsnlcard_holder_relation" name="bsnlcard_holder_relation" class="m-wrap span12" >
														
																	<option selected="selected" value="select">Select Card holder Relation with patient</option>
                                                                      <option value="Father">Father</option>
                                                                      <option value="Mother">Mother</option>
                                                                      <option value="Son">Son</option>
                                                                      <option value="Daughter">Daughter</option>
                                                                      <option value="Wife">Wife</option>
                                                                      <option value="Self">Self</option>
                                                                      <option value="Other">Other</option>
																
																</select>
															
													
															</div>
														</div>
													  </div>
												     
												</div>
												</div>
												
												<div  id='medi' class='hide'>
											
												<div class="row-fluid">
												  <div class="span3">
													    <div class="control-group">
															<label class="control-label" for="firstName">Company Name </label>
															<div class="controls">
															<select id="mediclaim_comp" name="mediclaim_comp" class="m-wrap span12" >
														
																	<option selected="selected" value="select">Select Company Name</option>
                                                                       <?php
								                                           foreach ($mediclam_company as $key=>$valuemedi)
					                                                        {
					                                                      	  
					                                                      	  echo "<option value='".$valuemedi['medi_c_name']. "' >".$valuemedi['medi_c_name']."</option>";
					                                                        }  
                                                                       ?>
                                                                     
																
														   </select>
															
													
															</div>
														</div>
													  </div>
												     
												</div>
												</div>
												
											
												<div class="row-fluid">
												<div class="span12">
												<div class="form-actions">
													<button type="submit" name='preg' value='preg' class="btn blue" accesskey="s" ><i class="icon-ok"></i> Save</button>
													<button type="reset" class="btn">Cancel</button>
												</div>
												</div>
												</div>
												<div>
											</form>
											<!-- END FORM--> 
											<!--button onclick='filladdresss();'>aaa</button-->
										</div>
									</div>
								</div>
								
								
								
							
							
							</div>
						</div>
					</div>
				</div>
				<!-- END PAGE CONTENT-->         
			</div>
	