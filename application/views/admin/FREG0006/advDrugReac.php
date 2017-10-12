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
											<div class="caption"> ADVERSE DRUG REACTION FORM</div>
											<div class="tools">
												<a href="javascript:;" class="collapse"></a>
											
												<a href="javascript:;" class="reload"></a>
												
											</div>
										</div>
										<div class="portlet-body form">
								
											<!-- BEGIN FORM-->
											
											
											
											 
							 <form  action="<?php echo base_url('admin/FREG0006/saveadverseDrugreactionform'); ?>"  method='POST' >
											
												<center><h2>ADVERSE DRUG REACTION FORM</h2></center>
												<br>
											
												<div class="row-fluid">
												
												    <div class="span4 ">
													    <div class="control-group">
															
															<div class="controls">
					Patient's Initials	<input type="text" id="std_patient" name='std_patient' class="m-wrap span8"  >
															
															
														</div>
													</div>
												</div>
												
 					    <div class="span2">
													    <div class="control-group">
															
															<div class="controls">
																Sex <input type="text" id="std_sex" name='std_sex' class="m-wrap span10" >
															
															</div>
														</div>
													</div>		
													<div class="span2">
													    <div class="control-group">
															
															<div class="controls">
																Weight <input type="text" id="std_weight" name='std_weight' class="m-wrap span8" >
															
															</div>
														</div>
													</div>
													<div class="span2">
													    <div class="control-group">
															
															<div class="controls">
																Age <input type="text" id="std_age" name='std_age' class="m-wrap span10" >
															
															</div>
														</div>
													</div>
													<div class="span2">
													    <div class="control-group">
														
															<div class="controls">
																Reg.No <input type="text" id="std_reg" name='std_reg' class="m-wrap span8" >
															
															</div>
														</div>
													</div>
												</div>
												
												<div class="row-fluid">
												    <div class="span5 ">
													    <div class="control-group">
															
															<div class="controls">
														  	Ward <input type="text" id="std_ward" name='std_ward' class="m-wrap span10"  >
															
															
														</div>
													</div>
												</div>
												 <div class="span5 ">
													    <div class="control-group">
															
															<div class="controls">
															Bed No.	<input type="text" id="std_bed" name='std_bed' class="m-wrap span10"  >
															
															
														</div>
													</div>
												</div>
													</div>	 
													<br>
														<h4>SUSPECTED ADVERSE REACTION</h4> 
														<br>
												<div class="row-fluid">
												    <div class="span12 ">
													    <div class="control-group">
														
															<div class="controls">
														Date of reaction started <input type="text" id="std_recdt" name='std_recdt' class="m-wrap span7"  >
															
															
														</div>
													</div>
												</div>
												</div>
												
												<div class="row-fluid">
                                                             <div class="span12">												
												
                                                           <div class="control-group">
															<label class="control-label">I. &nbsp; &nbsp; Medicine Errors</label>
												 <input type="checkbox" name="cbox[]" id="std_Omission" value="std_Omission" >Omission &nbsp;
                                                         <input type="checkbox" name="cbox[]" id="std_Dosages" value="std_Dosages" >Dosages &nbsp;
														 <input type="checkbox" name="cbox[]" id="std_dosagepreparation" value="std_dosagepreparation" >Dosage preparation &nbsp;
                                                         <input type="checkbox" name="cbox[]" id="std_wrongtime" value="std_wrongtime" >Wrong Time &nbsp;
														  <input type="checkbox" name="cbox[]" id="std_wrongrate" value="std_wrongrate" >Wrong Rate of Administration &nbsp;
														    <input type="checkbox" name="cbox[]" id="std_wrongpatient" value="std_wrongpatient" >Wrong Patient
															
														</div>
                                                              </div>
												 </div>
												
										<div class="row-fluid">
												    <div class="span12 ">
													    <div class="control-group">
														
															<div class="controls">
											Date of reaction started <input type="text" id="std_recdt2" name='std_recdt2' class="m-wrap span7"  >
															
															
														</div>
													</div>
												</div>
												</div>
												<div class="row-fluid">
												    <div class="span12 ">
													    <div class="control-group">
														
															<div class="controls">
																Date of recovery <input type="text" id="std_dtrecover" name='std_dtrecover' class="m-wrap span8"  >
															
															
														</div>
													</div>
												</div>
												</div>
												<div class="row-fluid">
                                                             <div class="span12">												
												
                                                           <div class="control-group">
															<label class="control-label">II. &nbsp; &nbsp; Problem due to Drug reaction</label>
														<input type="checkbox" name="cbox[]" id="std_noxious" value="std_noxious" />Noxious effect &nbsp; &nbsp; &nbsp;
                                                         <input type="checkbox" name="cbox[]" id="std_unintend" value="std_unintend" />Unintended response  
														 
														</div>
                                                              </div>
												 </div>
												<div class="row-fluid">
                                                             <div class="span12">												
												
                                                           <div class="control-group">
															<label class="control-label">III. &nbsp; &nbsp; Problem due to Illegible Writhing Over Given Period of time</label>
															<div class="span4">
														<div class="controls">
																Illigible Writing <input type="text" id="std_writing" name='std_writing' class="m-wrap span8"  >
															
															
														</div>
														 
														</div>
															<div class="span5">
															
														<div class="controls">
																Problem due to Time <input type="text" id="std_problem" name='std_problem' class="m-wrap span6"  >
															
															
														</div>
														 
														</div>
                                                              </div>
												 </div>
												 <div class="row-fluid">
												    <div class="span12 ">
													    <div class="control-group">
															
															<div class="controls">
							<b>IV. &nbsp; &nbsp; Problem due to contrast related reaction</b> <input type="text" id="std_contrast" name='std_contrast' class="m-wrap span6"  >
															
															
														</div>
													</div>
												</div>
												</div>
												<h4>SUSPECTED MEDICATION (S):-</h4>
												
												
												
												
												
												
												
<html>
<head>
 
</head>
<body>

	<div class="portlet-body flip-scroll">
								<table class="table-bordered table-striped table-condensed flip-content">
								<thead class="flip-content">
  <tr>
    <th rowspan="2">S.No.</th>
    <th rowspan="2">1.Name(Brand and/or generic name)</th> 
    <th rowspan="2">Batch No./Lot No.(if known)</th>
	<th rowspan="2">Exp. Date (if known)</th>
    <th rowspan="2">Dose used</th> 
    <th rowspan="2">route used</th>
	<th rowspan="2">Frequency</th>
    <th colspan="2">Therapy dates (if unknown,give duration)</th> 
	<th rowspan="2">Reason for Use of prescribed for</th>
	</tr>
	<tr>
	
    <th>Date Started</th>
    <th>Date Stopped</th>
  </tr>
  </thead>
							<tbody>

  <tr>
    <td class="numeric"><INPUT TYPE="TEXT" NAME="email" style="width:70%;border:0px;" ></td>
    <td class="numeric"><INPUT TYPE="TEXT" NAME="email" style="width:70%;border:0px;"></td>
    <td class="numeric"><INPUT TYPE="TEXT" NAME="email" style="width:70%;border:0px;"></td>
	<td class="numeric"><INPUT TYPE="TEXT" NAME="email" style="width:70%;border:0px;"></td>
    <td class="numeric"><INPUT TYPE="TEXT" NAME="email" style="width:70%;border:0px;"></td>
    <td class="numeric"><INPUT TYPE="TEXT" NAME="email" style="width:70%;border:0px;"></td>
	<td class="numeric"><INPUT TYPE="TEXT" NAME="email" style="width:70%;border:0px;"></td>
    <td class="numeric"><INPUT TYPE="TEXT" NAME="email" style="width:70%;border:0px;"></td>
    <td class="numeric"><INPUT TYPE="TEXT" NAME="email" style="width:70%;border:0px;"></td>
	<td class="numeric"><INPUT TYPE="TEXT" NAME="email" style="width:70%;border:0px;"></td>
  </tr>                                                               
 <tr>
      <td class="numeric"><INPUT TYPE="TEXT" NAME="email" style="width:70%;border:0px;" ></td>
    <td class="numeric"><INPUT TYPE="TEXT" NAME="email" style="width:70%;border:0px;"></td>
    <td class="numeric"><INPUT TYPE="TEXT" NAME="email" style="width:70%;border:0px;"></td>
	<td class="numeric"><INPUT TYPE="TEXT" NAME="email" style="width:70%;border:0px;"></td>
    <td class="numeric"><INPUT TYPE="TEXT" NAME="email" style="width:70%;border:0px;"></td>
    <td class="numeric"><INPUT TYPE="TEXT" NAME="email" style="width:70%;border:0px;"></td>
	<td class="numeric"><INPUT TYPE="TEXT" NAME="email" style="width:70%;border:0px;"></td>
    <td class="numeric"><INPUT TYPE="TEXT" NAME="email" style="width:70%;border:0px;"></td>
    <td class="numeric"><INPUT TYPE="TEXT" NAME="email" style="width:70%;border:0px;"></td>
	<td class="numeric"><INPUT TYPE="TEXT" NAME="email" style="width:70%;border:0px;"></td>
  </tr>
   <tr>
     <td class="numeric"><INPUT TYPE="TEXT" NAME="email" style="width:70%;border:0px;" ></td>
    <td class="numeric"><INPUT TYPE="TEXT" NAME="email" style="width:70%;border:0px;"></td>
    <td class="numeric"><INPUT TYPE="TEXT" NAME="email" style="width:70%;border:0px;"></td>
	<td class="numeric"><INPUT TYPE="TEXT" NAME="email" style="width:70%;border:0px;"></td>
    <td class="numeric"><INPUT TYPE="TEXT" NAME="email" style="width:70%;border:0px;"></td>
    <td class="numeric"><INPUT TYPE="TEXT" NAME="email" style="width:70%;border:0px;"></td>
	<td class="numeric"><INPUT TYPE="TEXT" NAME="email" style="width:70%;border:0px;"></td>
    <td class="numeric"><INPUT TYPE="TEXT" NAME="email" style="width:70%;border:0px;"></td>
    <td class="numeric"><INPUT TYPE="TEXT" NAME="email" style="width:70%;border:0px;"></td>
	<td class="numeric"><INPUT TYPE="TEXT" NAME="email" style="width:70%;border:0px;"></td>
  </tr>
  </tbody>
</table>
</div>


</body>
</html>
<h4>TREATMENT GIVEN FOR ADR</h4>
<br>
<div class="row-fluid">
                                                             <div class="span6">												
												
                                                           <div class="control-group">
															<label class="control-label">1. Did reaction disappear after stopping the suspected drug ? </label>
														<input type="radio" name="adverse_reaction1" id="std_q1" value="std_q1" >Yes
                                                         <input type="radio" name="adverse_reaction1" id="std_q2" value="std_q2" >No
														</div>
                                                              </div>
                                                             <div class="span4">
															<div class="control-group">
															<label class="control-label">2. Did you restart the suspected drug ?</label>
														<input type="radio" name="adverse_reaction2" id="std_q3" value="std_q3" >Yes
                                                         <input type="radio" name="adverse_reaction2" id="std_q4" value="std_q4" >No
														</div>
                                                              </div>
															     
                                                             </div>
															 <br>
												<div class="row-fluid">
                                                             <div class="span12">												
												
                                                           <div class="control-group">
															<label class="control-label">3. Did reaction appear after starting the suspected drug ? </label>
														 
														 <input type="radio" name="adverse_reaction3" id="std_q5" value="std_q5" >Yes
                                                         
														 <input type="radio" name="adverse_reaction3" id="std_q6" value="std_q6" >No
														</div>
                                                              </div>
													</div> 
													<br>
													<h4>SUSPECTED REACTION (S)</h4>
													<br>
													<p>Outcome: Recovered Recovering, Continuing</p>
													<div class="row-fluid">
												    <div class="span12 ">
													    <div class="control-group">
															
															<div class="controls">
																 Date reaction (s) started <input type="text"   id="std_dtstart" name='std_dtstart' class="m-wrap span3" >  Date reaction (s) stopped <input type="text"  id="std_dtstop" name='std_dtstop' class="m-wrap span3">
															
															</div>
														</div>
													</div>
													</div>
													<br>
													<div class="row-fluid">
												
												    <div class="span5 ">
													    <div class="control-group">
															
															<div class="controls">
																Signature of the reporting person: <input type="text"  id="std_sign" name='std_sign' class="m-wrap span6"  >
														</div>
													</div>
												</div>
												
 					    <div class="span3">
													    <div class="control-group">
															
															<div class="controls">
																Date: <input type="text"  id="std_date" name='std_date' class="m-wrap span10" >
															
															</div>
														</div>
													</div>		
													<div class="span4">
													    <div class="control-group">
															
															<div class="controls">
									Designation <input type="text"  id="std_desig" name='std_desig' class="m-wrap span8" >
															
															</div>
														</div>
													</div>
													</div>
																										<div class="row-fluid">
												
												    <div class="span5 ">
													    <div class="control-group">
															
															<div class="controls">
							Doctor's Name <input type="text"  id="std_doc" name='std_doc' class="m-wrap span6"  >
															
															
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
											

											<img src="http://localhost/prj3/index.php/../assets/img/logo1.png" alt="logo" width="100px">
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
							
						
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
												
											