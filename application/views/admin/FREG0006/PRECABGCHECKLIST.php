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
			<!-- BEGIN PLFT CONTAINER-->
			<div class="container-fluid">
				<!-- BEGIN PLFT HEADER-->   
				<div class="row-fluid">
					
				</div>
				<!-- END PLFT HEADER-->
				<!-- BEGIN PLFT CONTENT-->
				<div class="row-fluid">
					<div class="span12">
						<div class="tabbable tabbable-custom boxless">
							
							<div class="tab-content">
								<div class="tab-pane active" id="tab_1">
									<div class="portlet box blue">
										<div class="portlet-title">
											<div class="caption"> PRE CABG CHECK LIST</div>
											<div class="tools">
												<a href="javascript:;" class="collapse"></a>
											
												<a href="javascript:;" class="reload"></a>
												
											</div>
										</div>
										<div class="portlet-body form">
								
											<!-- BEGIN FORM-->
											
											
											
											 
							 <form  action="<?php echo base_url('admin/FREG0006/Saveprecabgchecklist'); ?>"  method='POST' >
											
												
												<div class="row-fluid">
												    <div class="span4 ">
													    <div class="control-group">
															<label class="control-label" for="CBC,FBS">CBC,FBS</label>
															<div class="controls">
																<input type="text" id="std_cbc" name='std_cbc' class="m-wrap span12"  title="CBC,FBS"required">
															
															</div>
														</div>
													</div>
												
												
												    <div class="span4">
													    <div class="control-group">
															<label class="control-label"  >BT,CT,PT/INR/APTT </label>
															<div class="controls">
																 <input type="text" id="std_bt" name='std_bt' class="m-wrap span12" >
															
															</div>
														</div>
													</div>		
													<div class="span4">
													    <div class="control-group">
															<label class="control-label"  >S.CREATININE/BUN </label>
															<div class="controls">
																 <input type="text" id="std_creatinine" name='std_creatinine' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
												</div>
												
												
														 
														 
												<div class="row-fluid">
												    <div class="span6">
													    <div class="control-group">
															<label class="control-label"  >S. ELECTROLYTE</label>
															<div class="controls">
																 <input type="text" id="std_electrolyte" name='std_electrolyte' class="m-wrap span12" >
															
															</div>
														</div>
													</div>		
													<div class="span6">
													    <div class="control-group">
															<label class="control-label"  >LFT</label>
															<div class="controls">
																 <input type="text" id="std_lft" name='std_lft' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
													</div>
													
													<div class="row-fluid">
												    <div class="span6">
													    <div class="control-group">
															<label class="control-label"  >PFT IN CASE OF ASTHMA & COPD & CHRONIC SMOKER</label>
															<div class="controls">
																 <input type="text" id="std_pft" name='std_pft' class="m-wrap span12" >
															
															</div>
														</div>
													</div>		
													<div class="span6">
													    <div class="control-group">
															<label class="control-label"  >VIRAL MARKER</label>
															<div class="controls">
																 <input type="text" id="std_viral" name='std_viral' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
													</div>	

												<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >URINE-R/M,IF PUS CELLS>10 THAN SEND URINE-C/S, IN CASE OF VALVE 
	  CASES DO URINE -R/M WITH URINE-C/S</label>
															<div class="controls">
																 <input type="text" id="std_urine" name='std_urine' class="m-wrap span12" >
															
															</div>
														</div>
													</div>		
												</div>	
												
												
												
												
												<div class="row-fluid">
												    <div class="span4 ">
													    <div class="control-group">
															<label class="control-label" for="BLOOD GROUP & CROSS MATCH">BLOOD GROUP & CROSS MATCH</label>
															<div class="controls">
																<input type="text" id="std_blood" name='std_blood' class="m-wrap span12"  title="CBC,FBS"required">
															
															</div>
														</div>
													</div>
												
												    <div class="span4">
													    <div class="control-group">
															<label class="control-label"> ECG </label>
															<div class="controls">
																 <input type="text" id="std_ecg" name='std_ecg' class="m-wrap span12" >
															
															</div>
														</div>
													</div>		
													<div class="span4">
													    <div class="control-group">
															<label class="control-label"  > X-RAY OF CHEST  </label>
															<div class="controls">
																 <input type="text" id="std_xray" name='std_xray' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
												</div>
												
												
												
												
												
												
												<div class="row-fluid">
												    <div class="span4 ">
													    <div class="control-group">
															<label class="control-label" >2D- ECHO</label>
															<div class="controls">
																<input type="text" id="std_2decho" name='std_2decho' class="m-wrap span12"  title="2D"required">
															
															</div>
														</div>
													</div>
												
												    <div class="span4">
													    <div class="control-group">
															<label class="control-label"  >CAG REPORT </label>
															<div class="controls">
																 <input type="text" id="std_cag" name='std_cag' class="m-wrap span12" >
															
															</div>
														</div>
													</div>		
													<div class="span4">
													    <div class="control-group">
															<label class="control-label"  >USG ABDOMEN.  </label>
															<div class="controls">
																 <input type="text" id=" std_usg" name='std_usg' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
												</div>
												
												
												<div class="row-fluid">
												    <div class="span12 ">
													    <div class="control-group">
															<label class="control-label" >CAROTID DOPPLER> 60YRS., H/O CVA OR SYNCOPAL HISTORY AND> 55YRS. IN CASE OF DM/ DYSLIPIDMIA</label>
															<div class="controls">
																<input type="text" id="std_carotid" name='std_carotid' class="m-wrap span12"  title="std_carotid"required">
															
															</div>
														</div>
													</div>
												</div>
												
												<div class="row-fluid">
												    <div class="span12 ">
													    <div class="control-group">
															<label class="control-label" >ARRANGE 2 UNIT WHOLE BLOOD-IF Hb>12gm. IF Hb<12gm and NEGATIVE BLOOD GROUP ARRANGE 3 OR 4 UNIT WHOLE BLOOD.</label>
															<div class="controls">
																<input type="text" id="std_arrange" name='std_arrange' class="m-wrap span12"  title="std_arrange"required">
															
															</div>
														</div>
													</div>
												</div>
												
												<div class="row-fluid">
												    <div class="span6">
													    <div class="control-group">
															<label class="control-label"  >START INTENSIVE SPIROMETRY 5 DAYS BEFORE SURGERY.</label>
															<div class="controls">
																 <input type="text" id="std_start" name='std_start' class="m-wrap span12" >
															
															</div>
														</div>
													</div>		
													<div class="span6">
													    <div class="control-group">
															<label class="control-label"  >ALL VALVE/CONGENITAL CASES DENTAL EXAMINATION MUST.</label>
															<div class="controls">
																 <input type="text" id="std_dental" name='std_dental' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
													</div>
												
												
												<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															<label class="control-label"  >ALL VALVE/CONGENITAL CASES OF FEMALE GYNECOLOGICAC OPINION IS MUST.</label>
															<div class="controls">
																 <input type="text" id="std_female" name='std_female' class="m-wrap span12" >
															
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
										
								
				
															</div>
														</div>
													</div>		
												</div>				
												</div>				
												</div>				
												</div>				
												</div>				
												</div>					
							
						