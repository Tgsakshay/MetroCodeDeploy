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
											<div class="caption"> SUMMARY</div>
											<div class="tools">
												<a href="javascript:;" class="collapse"></a>
											
												<a href="javascript:;" class="reload"></a>
												
											</div>
										</div>
										<div class="portlet-body form">
								
											<!-- BEGIN FORM-->
											<form method='post'  action="<?php echo base_url('admin/FREG0006/patientReg'); ?>" class="horizontal-form" id='frm'>
											
												<div class="row-fluid">
												    <div class="span12 ">
													    <div class="control-group">
															<label class="control-label">Procedure:CABG/Redo/Value/Other</label>
															<div class="controls">
																<input type="text" id="Procedure" name='Procedure' class="m-wrap span12"  title="Procedure"required">
															
															</div>
														</div>
													</div>
												</div>		
												<div class="row-fluid">
												    <div class="span6">
													    <div class="control-group">
															<label class="control-label"  >CARDIOLOGIST</label>
															<div class="controls">
																 <input type="text" id="CARDIOLOGIST" name='CARDIOLOGIST' class="m-wrap span12" >
															
															</div>
														</div>
													</div>		
													<div class="span6">
													    <div class="control-group">
															<label class="control-label"  >CARDIAC SURGEON</label>
															<div class="controls">
																 <input type="text" id=">CARDIAC_SURGEON" name='>CARDIAC_SURGEON' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
												</div>
														
														 
														 
														 
														 
														 
														 
														 
												<div class="row-fluid">
												    <div class="span3">
													    <div class="control-group">
															<label class="control-label"  >Name:</label>
															<div class="controls">
																 <input type="text" id="Name" name='Name' class="m-wrap span12" >
															
															</div>
														</div>
													</div>		
													<div class="span3">
													    <div class="control-group">
															<label class="control-label"  >Age:</label>
															<div class="controls">
																 <input type="text" id=">Age" name='>Age' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
																							<div class="span3">
													    <div class="control-group">
															<label class="control-label"  >Sex:</label>
															<div class="controls">
																 <input type="text" id=">Sex" name='>Sex' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
																 
														 
														 <div class="span3">
											 <div class="control-group">
															<label class="control-label"  >AH No.</label>
															<div class="controls">
																 <input type="text" id=">AH" name='>AH' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
												</div>				 			 
														 
														 
														 
														 
												<div class="row-fluid">
												    <div class="span6">
													    <div class="control-group">
															<label class="control-label"  >Blood Group:</label>
															<div class="controls">
																 <input type="text" id="Blood_Group" name='Blood_Group' class="m-wrap span12" >
															
															</div>
														</div>
													</div>		
													<div class="span6">
													    <div class="control-group">
															<label class="control-label"  >Height:</label>
															<div class="controls">
																 <input type="text" id=">Height" name='>Height' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
												</div>
														
														 		 
														 
										             <div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >Allergies:</label>
															<div class="controls">
																 <input type="text" id="Allergies" name='Allergies' class="m-wrap span12" >
															
															</div>
														</div>
													</div>				 
											 	</div>	
														 
														

                                                     <div class="row-fluid">
												    <div class="span2">
													    <div class="control-group">
														
															<label class="control-group"  >Smoker</label>
															<div class="radio">
																 <input type="radio" id="Smoker" name='optradio1' class="m-wrap span12" >
															
															</div>
															
														</div>
													</div>		
                                                         <div class="span2">
													    <div class="control-group">
															<label class="control-label"  >Non-smoker</label>
															<div class="radio">
																 <input type="radio" id=">Non_smoker" name='optradio1' class="m-wrap span12" >
															
															</div>
														</div>
													</div>	
                                                         <div class="span2">
													    <div class="control-group">
															<label class="control-label"  >Ex smoker</label>
															<div class="radio">
																 <input type="radio" id=">Ex_smoker" name='optradio1' class="m-wrap span12" >
															
															</div>
														</div>
													</div>	
													
                                                      	<div class="span2">
													    <div class="control-group">
															<label class="control-group"  >Alcoholic</label>
															<div class="radio">
																 <input type="radio" id="Alcoholic" name='optradio2' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
											<div class="span2">
													    <div class="control-group">
															<label class="control-label"  >Non alcoholic</label>
															<div class="radio">
																 <input type="radio" id=">Non_alcoholic" name='optradio2' class="m-wrap span12" >
															
															</div>
														</div>
													</div>														
											 	</div>	




                                                    <div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >History:</label>
															<div class="controls">
																 <input type="text" id="History" name='History' class="m-wrap span12" >
															
															</div>
														</div>
													</div>				 
											 	</div>
												<div class="row-fluid">
                                                             <div class="span2">												
												
                                                           <div class="control-group">
															<label class="control-label">IDDM/NIDDM</label>
														<input type="radio" name="q1" value="yes" >Yes
                                                         <input type="radio" name="q1" value="no" >No
														</div>
                                                              </div>
                                                             <div class="span2">
															<div class="control-group">
															<label class="control-label">Hypo/Hyper Thyroid</label>
														<input type="radio" name="q2" value="yes" >Yes
                                                         <input type="radio" name="q2" value="no" >No
														</div>
                                                              </div>
															     <div class="span2">
															<div class="control-group">
															<label class="control-label">Hypertension</label>
														<input type="radio" name="q3" value="yes" >Yes
                                                         <input type="radio" name="q3" value="no" >No
														</div>
                                                              </div>
															   <div class="span2">
															<div class="control-group">
															<label class="control-label">Stroke/Convulsion</label>
														<input type="radio" name="q4" value="yes" >Yes
                                                         <input type="radio" name="q4" value="no" >No
														</div>
                                                              </div>
															   <div class="span4">
															<div class="control-group">
															<label class="control-label">IHD-Ischaemic Heart Disease</label>
														<input type="radio" name="q5" value="yes" >Yes
                                                         <input type="radio" name="q5" value="no" >No
														</div>
                                                              </div>
                                                             </div>
															 <br>
															 
															 												<div class="row-fluid">
                                                             <div class="span2">												
												
                                                           <div class="control-group">
															<label class="control-label">Trauma/Accident</label>
														<input type="radio" name="q6" value="yes" >Yes
                                                         <input type="radio" name="q6" value="no" >No
														</div>
                                                              </div>
                                                             <div class="span2">
															<div class="control-group">
															<label class="control-label">Recent MI</label>
														<input type="radio" name="q7" value="yes" >Yes
                                                         <input type="radio" name="q7" value="no" >No
														</div>
                                                              </div>
															     <div class="span2">
															<div class="control-group">
															<label class="control-label">APD/GI bleed</label>
														<input type="radio" name="q8" value="yes" >Yes
                                                         <input type="radio" name="q8" value="no" >No
														</div>
                                                              </div>
															   <div class="span2">
															<div class="control-group">
															<label class="control-label">Unstable Angina</label>
														<input type="radio" name="q9" value="yes" >Yes
                                                         <input type="radio" name="q9" value="no" >No
														</div>
                                                              </div>
															   <div class="span4">
															<div class="control-group">
															<label class="control-label">Chronic constipation</label>
														<input type="radio" name="q10" value="yes" >Yes
                                                         <input type="radio" name="q10" value="no" >No
														</div>
                                                              </div>
                                                             </div>  
															  <br>
															 
															 												<div class="row-fluid">
                                                             <div class="span2">												
												
                                                           <div class="control-group">
															<label class="control-label">CCF/LVF</label>
														<input type="radio" name="q11" value="yes" >Yes
                                                         <input type="radio" name="q11" value="no" >No
														</div>
                                                              </div>
                                                             
															     <div class="span2">
															<div class="control-group">
															<label class="control-label">iABP inserted</label>
														<input type="radio" name="q12" value="yes" >Yes
                                                         <input type="radio" name="q12" value="no" >No
														</div>
                                                              </div>
															   <div class="span2">
															<div class="control-group">
															<label class="control-label">Recent intubation</label>
														<input type="radio" name="q13" value="yes" >Yes
                                                         <input type="radio" name="q13" value="no" >No
														</div>
                                                              </div>
															   <div class="span2">
															<div class="control-group">
															<label class="control-label">ARF/CRF</label>
														<input type="radio" name="q14" value="yes" >Yes
                                                         <input type="radio" name="q14" value="no" >No
														</div>
                                                              </div>
															  <div class="span3">
															<div class="control-group">
															<label class="control-label">Asthma/COPD/LID/PTB</label>
														<input type="radio" name="q15" value="yes" >Yes
                                                         <input type="radio" name="q15" value="no" >No
														</div>
                                                              </div>
                                                             </div> 
															 <br>
															 
															 												<div class="row-fluid">
                                                             <div class="span2">												
												
                                                           <div class="control-group">
															<label class="control-label">BHP/TURP</label>
														<input type="radio" name="q16" value="yes" >Yes
                                                         <input type="radio" name="q16" value="no" >No
														</div>
                                                              </div>
                                                             
															     <div class="span2">
															<div class="control-group">
															<label class="control-label">PVD/Varicose veins</label>
														<input type="radio" name="q17" value="yes" >Yes
                                                         <input type="radio" name="q17" value="no" >No
														</div>
                                                              </div>

															   <div class="span2">
															<div class="control-group">
															<label class="control-label">Skin infection</label>
														<input type="radio" name="q18" value="yes" >Yes
                                                         <input type="radio" name="q18" value="no" >No
														</div>
                                                              </div>
															  <div class="span4">
															<div class="control-group">
															<label class="control-label">Anticoagulation/bleeding disorder</label>
														<input type="radio" name="q19" value="yes" >Yes
                                                         <input type="radio" name="q19" value="no" >No
														</div>
                                                              </div>
                                                             </div> 
                                                       <br>
															 
															 												<div class="row-fluid">
                                                             <div class="span2">												
												
                                                           <div class="control-group">
															<label class="control-label">UTI</label>
														<input type="radio" name="q20" value="yes" >Yes
                                                         <input type="radio" name="q20" value="no" >No
														</div>
                                                              </div>
                                                              <div class="span2">
															<div class="control-group">
															<label class="control-label">Psychiatric illness</label>
														<input type="radio" name="q22" value="yes" >Yes
                                                         <input type="radio" name="q22" value="no" >No
														</div>
                                                              </div>
															     <div class="span5">
															<div class="control-group">
															<label class="control-label">Recent foley's catheterization</label>
														<input type="radio" name="q21" value="yes" >Yes
                                                         <input type="radio" name="q21" value="no" >No
														</div>
                                                              </div>
                                                                  </div>
																   <div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >Previous surgeries:</label>
															<div class="controls">
																 <input type="text" id="Previous_surgeries" name='Previous_surgeries' class="m-wrap span12" >
															
															</div>
														</div>
													</div>				 
											 	</div>
												<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >Previous illness Requiring Admission to Hospital:</label>
															<div class="controls">
																 <input type="text" id="Previous" name='Previous' class="m-wrap span12" >
															
															</div>
														</div>
													</div>				 
											 	</div>
												<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >Echo:</label>
															<div class="controls">
																 <input type="text" id="Echo" name='Echo' class="m-wrap span12" >
															
															</div>
														</div>
													</div>				 
											 	</div>
												<div class="row-fluid">
												    <div class="span6">
													    <div class="control-group">
															<label class="control-label"  >LVEF:</label>
															<div class="controls">
																 <input type="text" id="LVEF" name='LVEF' class="m-wrap span12" >
															
															</div>
														</div>
													</div>		
													<div class="span6">
													    <div class="control-group">
															<label class="control-label"  >Mr-Grade I/II/III/IV:</label>
															<div class="controls">
																 <input type="text" id=">Mr-Grade" name='>Mr-Grade' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
												</div>
												<div class="row-fluid">
												    <div class="span6">
													    <div class="control-group">
															<label class="control-label"  >CLOTLV/LA:</label>
															<div class="controls">
																 <input type="text" id="CLOTLV/LA" name='CLOTLV/LA' class="m-wrap span12" >
															
															</div>
														</div>
													</div>		
													<div class="span6">
													    <div class="control-group">
															<label class="control-label"  >MS:</label>
															<div class="controls">
																 <input type="text" id=">MS" name='>MS' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
												</div>
												<div class="row-fluid">
												    <div class="span6">
													    <div class="control-group">
															<label class="control-label"  >AS:</label>
															<div class="controls">
																 <input type="text" id="AS" name='AS' class="m-wrap span12" >
															
															</div>
														</div>
													</div>		
													<div class="span6">
													    <div class="control-group">
															<label class="control-label"  >AR-Grade I/II/III/IV:</label>
															<div class="controls">
																 <input type="text" id=">AR-Grade" name='>AR-Grade' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
												</div>
												<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >ANEURYSM/AKINESIA/HYPOKINESIA:</label>
															<div class="controls">
																 <input type="text" id="ANEURYSM" name='ANEURYSM' class="m-wrap span12" >
															
															</div>
														</div>
													</div>				 
											 	</div>
												<div class="row-fluid">
												    <div class="span4">
													    <div class="control-group">
															<label class="control-label"  >LVDD-Gdare:</label>
															<div class="controls">
																 <input type="text" id="LVDD-GDARE" name='LVDD-GDARE' class="m-wrap span12" >
															
															</div>
														</div>
													</div>		
													<div class="span4">
													    <div class="control-group">
															<label class="control-label"  >LVDD-Grade:</label>
															<div class="controls">
																 <input type="text" id=">LVDD-GRADE" name='>LVDD-GRADE' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
																							<div class="span4">
													    <div class="control-group">
															<label class="control-label"  >Pericardial effusion:</label>
															<div class="controls">
																 <input type="text" id=">Pericardial_effusion" name='>Pericardial_effusion' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
													</div>
													<div class="row-fluid">
												    <div class="span4">
													    <div class="control-group">
															<label class="control-label"  >Carotid:</label>
															<div class="controls">
																 <input type="text" id="Carotid" name='Caroti:' class="m-wrap span12" >
															
															</div>
														</div>
													</div>		
													<div class="span4">
													    <div class="control-group">
															<label class="control-label"  >Right</label>
															<div class="controls">
																 <input type="text" id=">Right" name='>Right' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
																							<div class="span4">
													    <div class="control-group">
															<label class="control-label"  >Left</label>
															<div class="controls">
																 <input type="text" id=">Left" name='>Left' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
													</div>
													<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >Common:</label>
															<div class="controls">
																 <input type="text" id="Common" name='Common' class="m-wrap span12" >
															
															</div>
														</div>
													</div>				 
											 	</div>		  
                                                     <div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >Internal:</label>
															<div class="controls">
																 <input type="text" id="Internal" name='Internal' class="m-wrap span12" >
															
															</div>
														</div>
													</div>				 
											 	</div>		          
													 <div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >External:</label>
															<div class="controls">
																 <input type="text" id="External" name='External' class="m-wrap span12" >
															
															</div>
														</div>
													</div>				 
											 	</div>		 	 
                                                    <div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >Subelavian arteries:</label>
															<div class="controls">
																 <input type="text" id="Subelavian_arteries" name='Subelavian_arteries' class="m-wrap span12" >
															
															</div>
														</div>
													</div>				 
											 	</div>	
												<div class="row-fluid">
												    <div class="span4">
													    <div class="control-group">
															<label class="control-label"  >Radial:</label>
															<div class="controls">
																 <input type="text" id="Radial" name='Radial' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
							<div class="span4">
													    <div class="control-group">
															<label class="control-label"  >Left</label>
															<div class="controls">
																 <input type="text" id=">Left" name='>Left' class="m-wrap span12" >
															
															</div>
														</div>
													</div>													
													<div class="span4">
													    <div class="control-group">
															<label class="control-label"  >Right</label>
															<div class="controls">
																 <input type="text" id=">Right" name='>Right' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
													</div>	
													<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >Accentuation</label>
															<div class="controls">
																 <input type="text" id="Accentuation" name='Accentuation' class="m-wrap span12" >
															
															</div>
														</div>
													</div>				 
											 	</div>	
												<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >Intimal thickening</label>
															<div class="controls">
																 <input type="text" id="Intimal_thickening" name='Intimal_thickening' class="m-wrap span12" >
															
															</div>
														</div>
													</div>				 
											 	</div>	
												<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >Calcification-Mild/Moderate/Severe</label>
															<div class="controls">
																 <input type="text" id="Calcification" name='Calcification' class="m-wrap span12" >
															
															</div>
														</div>
													</div>				 
											 	</div>	
													<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >Bifurcation:</label>
															<div class="controls">
																 <input type="text" id="Bifurcation" name='Bifurcation' class="m-wrap span12" >
															
															</div>
														</div>
													</div>				 
											 	</div>		 
													<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >Size:</label>
															<div class="controls">
																 <input type="text" id="Size" name='Size' class="m-wrap span12" >
															
															</div>
														</div>
													</div>				 
											 	</div>		 	 
											<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >Any other Abnormality:</label>
															<div class="controls">
																 <input type="text" id="Abnormality" name='Abnormality' class="m-wrap span12" >
															
															</div>
														</div>
													</div>				 
											 	</div>		 
												<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >Right/Left handed:</label>
															<div class="controls">
																 <input type="text" id="Right/Left" name='Right/Left' class="m-wrap span12" >
															
															</div>
														</div>
													</div>				 
											 	</div>		
												<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >ANGIO:</label>
															<div class="controls">
																 <input type="text" id="ANGIO" name='ANGIO' class="m-wrap span12" >
															
															</div>
														</div>
													</div>				 
											 	</div>
 												<div class="row-fluid">
												    <div class="span3">
													    <div class="control-group">
															<label class="control-label"  >No.</label>
															<div class="controls">
																 <input type="text" id="No" name='No' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
							<div class="span3">
													    <div class="control-group">
															<label class="control-label"  >Hospital:</label>
															<div class="controls">
																 <input type="text" id=">Hospital" name='>Hospital' class="m-wrap span12" >
															
															</div>
														</div>
													</div>													
													<div class="span3">
													    <div class="control-group">
															<label class="control-label"  >Date:</label>
															<div class="controls">
																 <input type="text" id=">Date" name='>Date' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
													<div class="span3">
													    <div class="control-group">
															<label class="control-label"  >Doctor:</label>
															<div class="controls">
																 <input type="text" id=">Doctor" name='>Doctor' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
													</div>	
												<div class="row-fluid">
												    <div class="span4">
													    <div class="control-group">
															<label class="control-label"  >LMT:</label>
															<div class="controls">
																 <input type="text" id="LMT" name='LMT' class="m-wrap span12" >
															
															</div>
														</div>
													</div>		
													<div class="span4">
													    <div class="control-group">
															<label class="control-label"  >LAD:</label>
															<div class="controls">
																 <input type="text" id=">LAD" name='>LAD' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
																							<div class="span4">
													    <div class="control-group">
															<label class="control-label"  >Dg:</label>
															<div class="controls">
																 <input type="text" id=">Dg" name='>Dg' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
													</div>
												<div class="row-fluid">
												    <div class="span3">
													    <div class="control-group">
															<label class="control-label"  >LCx:</label>
															<div class="controls">
																 <input type="text" id="LCx" name='LCx' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
							<div class="span3">
													    <div class="control-group">
															<label class="control-label"  >OM1:</label>
															<div class="controls">
																 <input type="text" id=">OM1" name='>OM1' class="m-wrap span12" >
															
															</div>
														</div>
													</div>													
													<div class="span3">
													    <div class="control-group">
															<label class="control-label"  >OM2:</label>
															<div class="controls">
																 <input type="text" id=">OM2" name='>OM2' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
													<div class="span3">
													    <div class="control-group">
															<label class="control-label"  >OM3:</label>
															<div class="controls">
																 <input type="text" id=">OM:" name='>OM3' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
													</div>	
												<div class="row-fluid">
												    <div class="span4">
													    <div class="control-group">
															<label class="control-label"  >RCA:</label>
															<div class="controls">
																 <input type="text" id="RCA" name='RCA' class="m-wrap span12" >
															
															</div>
														</div>
													</div>		
													<div class="span4">
													    <div class="control-group">
															<label class="control-label"  >PDA:</label>
															<div class="controls">
																 <input type="text" id=">PDA" name='>PDA' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
																							<div class="span4">
													    <div class="control-group">
															<label class="control-label"  >PLV:</label>
															<div class="controls">
																 <input type="text" id=">PLV" name='>PLV' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
													</div>
												<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >DOMINANT(RCA/LCX)</label>
															<div class="controls">
																 <input type="text" id="DOMINANT" name='DOMINANT' class="m-wrap span12" >
															
															</div>
														</div>
													</div>				 
											 	</div>
												<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >LVEF:</label>
															<div class="controls">
																 <input type="text" id="LVEF" name='LVEF' class="m-wrap span12" >
															
															</div>
														</div>
													</div>				 
											 	</div>
												<div class="row-fluid">
												    <div class="span4">
													    <div class="control-group">
															<label class="control-label"  >LIMA</label>
															<div class="controls">
																 <input type="text" id="LIMA" name='LIMA' class="m-wrap span12" >
															
															</div>
														</div>
													</div>		
													<div class="span4">
													    <div class="control-group">
															<label class="control-label">/RIMA</label>
															<div class="controls">
																 <input type="text" id="RIMA" name='RIMA' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
																							<div class="span4">
													    <div class="control-group">
															<label class="control-label"  >Graft Angio:</label>
															<div class="controls">
																 <input type="text" id=">Graft_Angio" name='>Graft_Angio' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
													</div>
												<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >RENALS:</label>
															<div class="controls">
																 <input type="text" id="RENALS" name='RENALS' class="m-wrap span12" >
															
															</div>
														</div>
													</div>				 
											 	</div>
												<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >Conduits used in previous CABS:</label>
															<div class="controls">
																 <input type="text" id="Conduits" name='Conduits' class="m-wrap span12" >
															
															</div>
														</div>
													</div>				 
											 	</div>
												<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >Lab Value:</label>
															<div class="controls">
																 <input type="text" id="Lab_Value" name='Lab_Value' class="m-wrap span12" >
															
															</div>
														</div>
													</div>				 
											 	</div>
												
												<div class="row-fluid">
												    <div class="span2">
													    <div class="control-group">
															<label class="control-label"  >HBG:</label>
															<div class="controls">
																 <input type="text" id="HBG" name='HBG' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
							<div class="span2">
													    <div class="control-group">
															<label class="control-label">PCV:</label>
															<div class="controls">
																 <input type="text" id="PCV" name='PCV' class="m-wrap span12" >
															
															</div>
														</div>
													</div>													
													<div class="span2">
													    <div class="control-group">
															<label class="control-label">TC:</label>
															<div class="controls">
																 <input type="text" id="TC" name='TC' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
													<div class="span3">
													    <div class="control-group">
															<label class="control-label">Platelet count:</label>
															<div class="controls">
																 <input type="text" id="Platelet" name='Platelet' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
													<div class="span3">
													    <div class="control-group">
															<label class="control-label">Creatinine:</label>
															<div class="controls">
																 <input type="text" id="Creatinine" name='Creatinine' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
													</div>	
												<div class="row-fluid">
												    <div class="span3">
													    <div class="control-group">
															<label class="control-label">PT INR:</label>
															<div class="controls">
																 <input type="text" id="PT" name='PT' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
												<div class="span3">
															<div class="control-group">
															<label class="control-label">HCV:</label>
														<input type="radio" name="q28" value="+ve" >+ve
                                                         <input type="radio" name="q28" value="-ve" >-ve
														</div>
                                                              </div>
															     <div class="span3">
															<div class="control-group">
															<label class="control-label">Hep B:</label>
														<input type="radio" name="q31" value="+ve" >+ve
                                                         <input type="radio" name="q31" value="-ve" >-ve
														</div>
                                                              </div>
															  <div class="span3">
															<div class="control-group">
															<label class="control-label">HIV:</label>
														<input type="radio" name="q32" value="+ve" >+ve
                                                         <input type="radio" name="q32" value="-ve" >-ve
														</div>
                                                              </div>
												</div>
												
												<div class="row-fluid">
												    <div class="span3">
													    <div class="control-group">
															<label class="control-label"  >Urine:</label>
															<div class="controls">
																 <input type="text" id="Urine" name='Urine' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
							<div class="span9">
													    <div class="control-group">
															<label class="control-label"  >CXR</label>
															<div class="controls">
																 <input type="text" id=">CXR" name='>CXR' class="m-wrap span12" >
															
															</div>
														</div>
													</div>												
												</div>	
												<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >HIGH RISK</label>
															<div class="controls">
																 <input type="text" id="HIGH_RISK" name='HIGH_RISK' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
												</div>
												<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label">Low EF:</label>
															<div class="controls">
																 <input type="text" id="Low_EF" name='Low_EF' class="m-wrap span11" >%
															
															</div>
														</div>
													</div>
												</div>
												<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >IABP:</label>
															<div class="controls">
																 <input type="text" id="IABP" name='IABP' class="m-wrap span11" >%
															
															</div>
														</div>
													</div>
												</div>
												<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >Arrythmias:</label>
															<div class="controls">
																 <input type="text" id="Arrythmias" name='Arrythmias' class="m-wrap span11" >%
															
															</div>
														</div>
													</div>
												</div>
																								<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >Stroke:</label>
															<div class="controls">
																 <input type="text" id="Stroke" name='Stroke' class="m-wrap span11" >%
															
															</div>
														</div>
													</div>
												</div>
																								<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >Dialysis:</label>
															<div class="controls">
																 <input type="text" id="Dialysis" name='Dialysis' class="m-wrap span11" >%
															
															</div>
														</div>
													</div>
												</div>
																							<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >Respiratory failure:</label>
															<div class="controls">
																 <input type="text" id="Respiratory failure" name='Respiratory failure' class="m-wrap span11" >%
															
															</div>
														</div>
													</div>
												</div>
												
																								<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >Bleeding:</label>
															<div class="controls">
																 <input type="text" id="Bleeding" name='Bleeding' class="m-wrap span11" >%
															
															</div>
														</div>
													</div>
												</div>
												
																								<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >Infection:</label>
															<div class="controls">
																 <input type="text" id="Infection" name='Infection' class="m-wrap span11" >%
															
															</div>
														</div>
													</div>
												</div>
												
																								<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >death:</label>
															<div class="controls">
																 <input type="text" id="death" name='death' class="m-wrap span11" >%
															
															</div>
														</div>
													</div>
												</div>
												
																								<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >PHYSICIAN'S COMMENT:</label>
															<div class="controls">
																 <textarea input type="text" id="COMMENT" name='COMMENT' class="m-wrap span12" ></textarea>
															
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
												
											</form>
											<!-- END FORM--> 
											<!--button onclick='filladdresss();'>aaa</button-->
										
								
								
							
						