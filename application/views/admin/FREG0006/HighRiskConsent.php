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
											<div class="caption">अति जोखिम हेतु सहमति पत्र </div>
											<div class="tools">
												<a href="javascript:;" class="collapse"></a>
											
												<a href="javascript:;" class="reload"></a>
												
											</div>
										</div>
										<div class="portlet-body form">
								
											<!-- BEGIN FORM-->
											
											
											
											 
							 <form  action="<?php echo base_url('admin/FREG0006/Saveprecabgchecklist'); ?>"  method='POST' >
											
											<center><h1>अति जोखिम हेतु सहमति पत्र</h1></center>
											<center><h2>(High Risk Consent)</h2></center>
											<center><h3>(भर्ती होने पर भरा जावे)</h3></center>
												<div class="row-fluid">
												    <div class="span6 ">
													    <div class="control-group">
															
															<div class="controls">
																<b> नाम</b>  <input type="text" id="std_pname" name='std_pname' class="m-wrap span10"  title="name"required">
															
															</div>
														</div>
													</div>
												
												
												    <div class="span6">
													    <div class="control-group">
															
															<div class="controls">
																<b>बिस्तर नंबर</b>  <input type="text" id="std_bed" name='std_bed' class="m-wrap span9" >
															
															</div>
														</div>
													</div>		
													
												</div>
												
												
														 
														 
												<div class="row-fluid">
												    <div class="span4">
													    <div class="control-group">
															
															<div class="controls">
																<b>रजि. क्र. </b> <input type="text" id="std_reg" name='std_reg' class="m-wrap span9" >
															
															</div>
														</div>
													</div>		
													 <div class="span4">
													    <div class="control-group">
															
															<div class="controls">
																<b>दिनांक</b>  <input type="text" id="std_date" name='std_date' class="m-wrap span10" >
															
															</div>
														</div>
													</div>	
 <div class="span4">
													    <div class="control-group">
															
															<div class="controls">
																<b>समय</b>  <input type="text" id="std_time" name='std_time' class="m-wrap span10" >
															
															</div>
														</div>
													</div>															
														</div>
												
													
													<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															
															<div class="controls">
																<b>मुझे इस बात से अवगत करा दिया गया है कि मेरे मरीज को निम्नलिखित बीमारियॉं हैं -</b>
															</div>
														</div>
													</div>		
													
													 
													</div>	

												<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															
															<div class="controls">
															<b>1.</b> <input type="text" id="std_info1" name='std_info1' class="m-wrap span10" ><br>
															<b>2.</b> <input type="text" id="std_info2" name='std_info2' class="m-wrap span10" ><br>
															<b>3.</b> <input type="text" id="std_info3" name='std_info3' class="m-wrap span10" ><br>
															<b>4.</b> <input type="text" id="std_info4" name='std_info4' class="m-wrap span10" >
															</div>
														</div>
													</div>		
												</div>	
												
												
												
												
												<div class="row-fluid">
												    <div class="span12 ">
													    <div class="control-group">
															
															<div class="controls">
																<b>इस कारण हृदय/फेफड़े/लीवर/किडनी भी ग्रसित हैं तथा रक्तचाप भी ज्यादा/कम नहीं है। इस अवस्था में चिकित्सकों के अथक प्रयासों के बावजूद भी बचने की उम्मीद कम/नगण्य है।<br>
	इस चिकित्सालय में उपलब्ध सीमित चिकित्सकीय सुविधाएँ एवं उपकरण इस बीमारी के इलाज के लिये अंतिक नहीं हैं, इसके बावजूद भी मैं स्वयं की जबावदारी पर अपने मरीज को यहाँ भर्ती करवा रहा हूं। चिकित्सकों के अथक प्रयासों के बावजूद मरीज की मृत्यु हो सकती है/या षारीरिक एवं मानसिक अपंगता रह सकती है, इस अवस्था में चिकित्सालय एवं चिकित्सक दल किसी भी प्रकार के जबावदार नहीं रहेगा।<br>
	मुझे इस बात से भी अवगत करा दिया गया कि मैं चाहूं तो अपने मरीज को यहॉ से भी उच्च स्तरीय सुविधाओं युक्त चिकित्सालय, मेडीकल कॉलेज स्वतः की जबावदारी पर ले जोन हेतु स्वतंत्र हूं। इन सब जानकारियों से अवगत होने के बावजूद भी मैं अपने मरीज को स्वतः की जिम्मेदारी पर, अपनी स्वेच्छा से, बिना किसी दबाव में आकर यहॉं भर्ती करवा रहा हूं।</b>
															
															</div>
														</div>
													</div>
												
												    
												</div>
												<br>
												   <br>
												<div class="row-fluid">
												    <div class="span3 ">
													    <div class="control-group">
															<label class="control-label" ><center>हस्ताक्षर</center></label>
															<div class="controls">
																<input type="text" id="std_sign" name='std_sign' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
												
												
												    <div class="span3">
													    <div class="control-group">
															<label class="control-label"><center>नाम</center> </label>
															<div class="controls">
																 <input type="text" id="std_family" name='std_family' class="m-wrap span12" >
															
															</div>
														</div>
													</div>		
													<div class="span3">
													    <div class="control-group">
															<label class="control-label"  ><center>मरीज के साथ सम्बंध</center> </label>
															<div class="controls">
																 <input type="text" id="std_relation" name='std_relation' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
													<div class="span3">
													    <div class="control-group">
															<label class="control-label"  ><center>   गवाह</center> </label>
															<div class="controls">
																 <input type="text" id="std_witness" name='std_witness' class="m-wrap span12" >
															
															</div>
														</div>
													</div>
												</div>
													<br>
												   <br>
													 <div class="row-fluid">
												    <div class="span9 ">
													    <div class="control-group">
															
															<div class="controls">
																<b>दिनांक</b>    <input type="text" id="std_date" name='std_date' class="m-wrap span3"> <br>
																<b>समय</b>     <input type="text" id="std_time" name='std_time' class="m-wrap span3" >
																
															
															</div>
														</div>
													</div>
													<div class="span3 ">
													    <div class="control-group">
															
															<div class="controls">
																<b>दिनांक</b>    <input type="text" id="std_date2" name='std_date2' class="m-wrap span8"> <br>
																<b>समय</b>     <input type="text" id="std_time2" name='std_time2' class="m-wrap span8" >
																
															
															</div>
														</div>
													</div>
								                   </div>
												   <br>
												   <br>
												  <div class="row-fluid">
												    <div class="span8 ">
													    <div class="control-group">
															
															<div class="controls">
																 <b>डॉक्टर का नाम</b>  <input type="text" id="std_doc" name='std_doc' class="m-wrap span5"  >
															
															</div>
														</div>
													</div>
												
												
												    <div class="span4">
													    <div class="control-group">
															
															<div class="controls">
																<b>हस्ताक्षर</b>  <input type="text" id="std_sign" name='std_sign' class="m-wrap span9" >
															
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
							
						