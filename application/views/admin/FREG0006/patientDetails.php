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
											<div class="caption"> Patients Details</div>
											<div class="tools">
												<a href="javascript:;" class="collapse"></a>
											
												<a href="javascript:;" class="reload"></a>
												
											</div>
										</div>
										<div class="portlet-body form">
								
											<!-- BEGIN FORM-->
											<form method='post'  action="<?php echo base_url('admin/FREG0006/savepatientDetails'); ?>" class="horizontal-form" id='frm'>
											
												<div class="row-fluid">
												    <div class="span3 ">
													    <div class="control-group">
															<label class="control-label" for="firstName">Patient First Name</label>
															<div class="controls">
																<input type="text" id="first_name_id" name='first_name_id' class="m-wrap span12" placeholder="Enter Patient First Name"  title="First Name"required">
															
															</div>
														</div>
														</div>
														 <div class="span3 ">
													    <div class="control-group">
															<label class="control-label" for="firstName">Patient Middle Name</label>
															<div class="controls">
																<input type="text" id="middle_name_id" name='middle_name_id' class="m-wrap span12" placeholder="Enter Patient Middle Name"  title="First Name"required">
															
															</div>
														</div>
														</div>
														</div>
														
														<div class="row-fluid">
												    <div class="span3 ">
													    <div class="control-group">
															<label class="control-label" for="firstName">Patient Last Name</label>
															<div class="controls">
																<input type="text" id="last_name_id" name='last_name_id' class="m-wrap span12" placeholder="Enter Patient First Name"  title="First Name"required">
															
															</div>
														</div>
														</div>
														 <div class="span3 ">
													    <div class="control-group">
															<label class="control-label" for="firstName">Family Member name</label>
															<div class="controls">
																
																<input type="text" id="	family_name_id" name='family_name_id'  class="m-wrap span9" placeholder="Enter Patient Father/Husband name " >
															
															</div>
														</div>
														</div>
														</div>
														
														
														
															<div class="row-fluid">
												    <div class="span3 ">
													    <div class="control-group">
															<label class="control-label" for="firstName">Patient Gender </label>
															<div class="controls">
																<select  id="patient_gender_id" name='patient_gender_id'  class="m-wrap span12">
																	<option value="Male">Male</option>
																	<option value="Female">Female</option>
																</select>
															
															</div>
														</div>
														</div>
														 <div class="span3 ">
													    <div class="control-group">
															<label class="control-label" for="firstName">Age of Patient </label>
															<div class="controls">
																<input type="number" id="patient_age_id" name='patient_age_id'  class="m-wrap span8" placeholder="Enter Age of Patient ">
																
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
 <div class="portlet box" style="background-color:light blue; border:3px solid black;color:blue;">
                <div class="portlet-title">
                  <div class="caption" style='color:#000'>PATIENT DETAILS</div>
                </div>
                </div>
			<table width='100%' border='1px;' style='font-size:12px;margin-top:-25px;'  class="table table-striped table-hover table-bordered dataTable camel-case">
			 <thead style='background-color:yellow;'  >
			 
			<tr>
			<th  style='font-size:12px;'>S. no.</th>
			<th  style='font-size:12px;'><center>Patient Name</center></th>
			<th  style='font-size:12px;'><center>Family member Name</center></th>
			<th  style='font-size:12px;'><center>Gender</center></th>
			<th  style='font-size:12px;'><center>Age</center></th>
			
			
			<th style='font-size:12px;'>Date / Time</th>
			<th style='font-size:12px;'>Action</th>
			
			</tr>
			<?php 
			$sno=0;
			// print_r($mydata); die();
			foreach($mydata as $ft){
				 $sno++;
			?>
			
             <tr>
			 <th><?php echo $sno;  ?></th>
			<th> <?php echo  $ft['first_name_id'] ?> <?php echo  $ft['middle_name_id'] ?> &nbsp;<?php echo  $ft['last_name_id'] ?></th>
			
			 <th><?php echo $ft['family_name_id']; ?></th>
			  <th><?php echo $ft['patient_gender_id']; ?></th>
			   <th><?php echo $ft['patient_age_id']; ?></th>
			   <td><?php echo date("d-m-Y / H:i",strtotime($ft['entrydt_id'])); ?></td>
             <td colspan='2'><A HREF="<?php echo base_url().'admin/FREG0006/deleteRownew/'.$ft['reg_id'];?>"><span style="font-size:20px;"><p> &#x2716 </p></span></A></td>
			
			 	<?php }	?>	
			 </table>
								
								
							
			
							</div>
						</div>
					</div>
				</div>
				<!-- END PAGE CONTENT-->         
			</div>
	