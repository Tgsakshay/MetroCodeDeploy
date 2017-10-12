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
											<div class="caption">ऑपरेषन की सहमति </div>
											<div class="tools">
												<a href="javascript:;" class="collapse"></a>
											
												<a href="javascript:;" class="reload"></a>
												
											</div>
										</div>
										<div class="portlet-body form">
								
											<!-- BEGIN FORM-->
											
											
											
											 
							 <form  action="<?php echo base_url('admin/FREG0006/Saveprecabgchecklist'); ?>"  method='POST' >
											
											<center><h1>ऑपरेषन की सहमति</h1></center>
												<div class="row-fluid">
												    <div class="span6 ">
													    <div class="control-group">
															
															<div class="controls">
																मरीज का नाम<input type="text" id="std_pname" name='std_pname' class="m-wrap span10"  title="CBC,FBS"required">
															
															</div>
														</div>
													</div>
												
												
												    <div class="span3">
													    <div class="control-group">
															
															<div class="controls">
																उम्र <input type="text" id="std_age" name='std_age' class="m-wrap span10" >
															
															</div>
														</div>
													</div>		
													<div class="span3">
													    <div class="control-group">
															
															<div class="controls">
																लिंग <input type="text" id="std_sex" name='std_sex' class="m-wrap span10" >
															
															</div>
														</div>
													</div>
												</div>
												
												
														 
														 
												<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															
															<div class="controls">
																स्थान <input type="text" id="std_address" name='std_address' class="m-wrap span10" >
															
															</div>
														</div>
													</div>		
														</div>
												
													
													<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															
															<div class="controls">
																मैं<input type="text" id="std_family" name='std_family' class="m-wrap span4" >अपनी स्वतंत्र इच्छा से अपनी/अपने रिश्तेदार की शल्य क्रिया/आवश्यक निश्चेतना जाँचें/उपचार पद्धति के लिये सहमति प्रदान करता/करती हूं।<br>
	मुझे स्पष्ट रूप से डॉक्टर द्वारा यह जानकारी दे दी गयी है कि कोई भी औषधोपचार / शल्यक्रिया/जांच पड़ताल/निश्चेतना/उपचार पद्धति पूर्णतः सुरक्षित नहीं होती तथा उनके प्रयोग से सामान्यतः स्वस्थ एवं तंदरूस्त व्यक्ति के जीवन को भी खतरा उत्पन्न हो सकता है।<br>
	मुझे यह बता दिया गया है कि ऑपरेशन/निश्चेतना/उपचार पद्धति/दवाईयों से अवांछित परिणाम एवं नुकसान जैसे कि अधिक रक्तस्राव, एलर्जी, एनाफिलेक्सिस, पलमोनरी (फेंफड़े में रक्त की गुठली का अटकना), फुट एम्बोलिसस, हृदय गति का रूकना, वैसोवेगल शॉक, ऑक्सीजन की कमी, रक्तचाप का गिरना या बढ़ना, नपुंंसकता, घाव में मवाद, फेंफड़ों में खून का जाना, धमनियों को नुकसान, सांस का रूकना, विकलांगता का आना अथवा मरीज की मौत भी हो सकती है। इस तरह के खतरे अचानक एवं अकल्पित रूप से ऑपरेशन या निश्चेतना के दौरान या उसके बाद उत्पन्न हो सकते है।<br>
	औषधोपचार/शल्यक्रिया/जांच पड़ताल/निश्चेतना उपचार पद्धति के दौरान डॉक्टरों को मरीज की परिस्थिति के अनुरूप ऑपरेशन या निश्चेतना में परिवर्तन करना ।<br>
	हमें डॉक्टरों ने होने वाली / एवं मरीज की स्थिति प्रक्रिया के बारे में विस्तृत वर्णन कर दिया है। प्रक्रिया से संबंधित खतरे, इंफेक्षन, मस्तिष्क, श्वसन, हृदय, वृक्क, आंत इत्यादि तंत्रों की जटिलताएँ, अत्याधिक रक्त स्राव अथवा मृत्यु भी हो सकती है। यह सब खतरे समझते हुए मैं यह प्रक्रिया करवाने हेतु तत्पर हूं। मुझे यह भी बताया गया है कि आकस्मिक सर्जरी की 1 प्रतिषत संभावना है, परंतु यदि सर्जरी करनी पड़ी तो खतरा अत्यधिक है एंव उसमें लगने वाले खर्चे भी पृथक से होंगे। उन खर्चो की जानकारी भी मुझे दे दी गई है जिसे चुकाने के लिये हम तैयार हैं।<br>
															</div>
														</div>
													</div>		
													
													 
													</div>	

												<div class="row-fluid">
												    <div class="span12">
													    <div class="control-group">
															
															<div class="controls">
																हम यह भी समझते हैं कि हमारे मरीज को प्रक्रिया के उपरांत <input type="text" id="std_dander" name='std_danger' class="m-wrap span3" > कृत्रिम श्वांस की मषीन एवं अन्य खतरों की जानकारी दे दी गई है। यदि ऑपरेषन नहीं किया गया तो इस अवस्था में जान का खतरा है।
															
															</div>
														</div>
													</div>		
												</div>	
												
												
												
												
												<div class="row-fluid">
												    <div class="span12 ">
													    <div class="control-group">
															
															<div class="controls">
																डॉक्टरों द्वारा हमें <input type="text" id="std_doc" name='std_doc' class="m-wrap span3"  > बताया है कि ऑपरेषन के समय डॉॅक्टरों को अन्य सहायकों जैसे जूनियर डॉक्टर तथा अन्य <input type="text" id="std_jdoc" name='std_jdoc' class="m-wrap span3"  > बहुत गोपनीय रखें <input type="text" id="std_approve" name='std_approve' class="m-wrap span4"  >उपरोक्त सभी बिन्दुओं पर अपनी सहमति प्रदान करता हूं।
															
															</div>
														</div>
													</div>
												
												    
												</div>
												
													<div class="row-fluid">
												    <div class="span2">
													    <div class="control-group">
															
															<div class="controls">
																दिनांक <input type="text" id="std_date" name='std_date' class="m-wrap span9" >
															
															</div>
														</div>
													</div>		
													 												    <div class="span8">
													    <div class="control-group">
															
															<div class="controls">
																
															
															</div>
														</div>
													</div>		
												    <div class="span2">
													    <div class="control-group">
															
															<div class="controls">
																समय <input type="text" id="std_time" name='std_time' class="m-wrap span10" >
														</div>
													
															</div>
														</div>
													</div>		
												
														 
												
												<div class="row-fluid">
												    													    												    
													<div class="span2">
													    <div class="control-group">
														<label class="control-label" > &nbsp; </label> 
															
															<div class="controls">
															<label class="control-label" > नाम </label><br>
															<label class="control-label" >हस्ताक्षर </label><br>
															<label class="control-label" >मरीज से संबंध </label><br>
															<label class="control-label" >पता </label>
															
															</div>
														</div>
													</div>	
                                                       <div class="span4">
													    <div class="control-group">
															<label class="control-label" ><center>मरीज</center> </label> 
															
															<div class="controls">
																<input type="text" id="std_name1" name='std_name1' class="m-wrap span12" >
															<input type="text" id="std_sign1" name='std_sign1' class="m-wrap span12" >
															<input type="text" id="std_relation1" name='std_relation1' class="m-wrap span12" >
															<input type="text" id="std_address1" name='std_address1' class="m-wrap span12" >
															
															</div>
														</div>
													</div>	
													<div class="span3">
													    <div class="control-group">
															<label class="control-label" ><center>सम्बन्ध </center></label> 
															<input type="text" id="std_name2" name='std_name2' class="m-wrap span12" >
															<input type="text" id="std_sign2" name='std_sign2' class="m-wrap span12" >
															<input type="text" id="std_relation2" name='std_relation2' class="m-wrap span12" >
															<input type="text" id="std_address2" name='std_address2' class="m-wrap span12" >
															<div class="controls">
																
															
															</div>
														</div>
													</div>	
													<div class="span3">
													    <div class="control-group">
															<label class="control-label" ><center>गवाह </center></label> 
															<input type="text" id="std_name3" name='std_name3' class="m-wrap span12" >
															<input type="text" id="std_sign3" name='std_sign3' class="m-wrap span12" >
															<input type="text" id="std_relation3" name='std_relation3' class="m-wrap span12" >
															<input type="text" id="std_address4" name='std_address4' class="m-wrap span12" >
															<div class="controls">
																
															
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
							
						