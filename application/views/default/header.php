<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title>MHCRC - JABALPUR</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />

	<!-- BEGIN GLOBAL MANDATORY STYLES -->  
    <link href="<?php echo base_url().'../assets/css/jquery-ui-timepicker-addon.css'; ?>" rel="stylesheet" type="text/css"/>      
	<link href="<?php echo base_url().'../assets/plugins/bootstrap/css/bootstrap.min.css'; ?>" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url().'../assets/plugins/bootstrap/css/bootstrap-responsive.min.css'; ?>" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url().'../assets/plugins/font-awesome/css/font-awesome.min.css'; ?>" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url().'../assets/css/style-metro.css'; ?>" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url().'../assets/css/style.css'; ?>" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url().'../assets/css/style-responsive.css'; ?>" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url().'../assets/css/themes/default.css'; ?>" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="<?php echo base_url().'../assets/plugins/uniform/css/uniform.default.css'; ?>" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL PLUGIN STYLES --> 
	<link href="<?php echo base_url().'../assets/plugins/gritter/css/jquery.gritter.css'; ?>" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url().'../assets/plugins/chosen-bootstrap/chosen/chosen.css'; ?>" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url().'../assets/plugins/bootstrap-daterangepicker/daterangepicker.css'; ?>" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'../assets/plugins/bootstrap-timepicker/compiled/timepicker.css'; ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'../assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css'; ?>" />
		
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'../assets/plugins/bootstrap-datepicker/css/datepicker.css'; ?>" />

	<link href="<?php echo base_url().'../assets/plugins/fullcalendar/fullcalendar/fullcalendar.css'; ?>" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url().'../assets/plugins/jqvmap/jqvmap/jqvmap.css'; ?>" rel="stylesheet" type="text/css" media="screen"/>
	<link href="<?php echo base_url().'../assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css'; ?>" rel="stylesheet" type="text/css" media="screen"/>
	<!-- END PAGE LEVEL PLUGIN STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES --> 
	<link href="<?php echo base_url().'../assets/css/pages/tasks.css'; ?>" rel="stylesheet" type="text/css" media="screen"/>
	<link href="<?php echo base_url().'../assets/css/pages/profile.css'; ?>" rel="stylesheet" type="text/css" />
	
	<!-- END PAGE LEVEL STYLES -->
	<link rel="shortcut icon" href="favicon.ico" />
	<script src="<?php echo base_url().'../assets/engine1/wowslider.js'; ?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'../assets/engine1/script.js'; ?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'../assets/plugins/jquery.min.js'; ?>" type="text/javascript"></script>
    <script src="<?php echo base_url().'../assets/plugins/common.js'; ?>" ></script>
    <script src="<?php echo base_url().'../assets/plugins/methods.js'; ?>" ></script>
    <script src="<?php echo base_url().'../assets/scripts/jquery-ui-timepicker-addon.js'; ?>" ></script>
	
	<!-- Table STYLES -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'../assets/plugins/select2/select2_metro.css'; ?>" />
	<link rel="stylesheet" href="<?php echo base_url().'../assets/plugins/data-tables/DT_bootstrap.css'; ?>" />
	<!-- END Table STYLES -->


	<!-- surya sir Table-->
	<link rel="stylesheet" href="<?php echo base_url().'../assets/css/tablesurya.css'; ?>" />
    <link rel="stylesheet" href="<?php echo base_url().'../assets/css/phpmailer.php'; ?>" />
	<link href="<?php echo base_url().'../assets/css/pages/pricing-tables.css'; ?>" rel="stylesheet" type="text/css"/>
    <!-- surya sir Table-->
	
	<script>
	function goBack() {
		window.history.back()
	}
	</script>
	<script>
	function goForward() {
		window.history.forward()
	}
	</script>
	
	<script src="<?php echo base_url().'../assets/jquery.min.js'; ?>"></script>

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->

<?php 
	$contrller = $this->uri->segment(2);
	$fnct = $this->uri->segment(3);
?>
<body class="page-header-fixed page-footer-fixed page-sidebar-closed page-sidebar-fixed " id='softheader'>   <!--add class for back option in footer page-footer-fixed FOPD0003    // page-sidebar-closed   ipdfeedback     event_reported  -->  
	<!--<body class="page-header-fixed page-sidebar-closed"> chartjUnauthorised     -->
	
	<div class="loader"></div>
	
	<!-- BEGIN Change Password Modal -->   
	<div id="portlet-config-chgp" class="modal hide">
    <div class="modal-header"> 
	  <a class="btn red icn-only" data-dismiss="modal" style="float:right" href="#">
	      <i class="icon-remove icon-white"></i>
	  </a>
      <h3>Change Password</h3>
    </div>
    <div class="modal-body">
      <form method='post' class="form-horizontal"  action="<?php echo base_url('auth/change_password'); ?>" >
        <div class="row-fluid">
          <div class="span10 ">
            <div class="control-group">
              <label class="control-label" for="oldpass">Old Password</label>
              <div class="controls">
                <input type="password" id="oldpass" name='oldpass' class="m-wrap span12" placeholder="Old Password" required>
              </div>
            </div>
          </div>
          </div>
		  <div class="row-fluid">
		  <div class="span10 ">
            <div class="control-group">
              <label class="control-label" for="newpass">New Password</label>
              <div class="controls">
                <input type="password" id="newpass" name='newpass' class="m-wrap span12" placeholder="New Password not less than 8 character" required>
				<span style="font-size:10px;">Password length can not be less than 8 character</span>
              </div>
            </div>
          </div>
          </div>
		  <div class="row-fluid">
		  <div class="span10 ">
            <div class="control-group">
              <label class="control-label" for="confpass">Confirm New</label>
              <div class="controls">
                <input type="password" id="confpass" name='confpass' class="m-wrap span12" placeholder="Confirm new Password" required>
				<input type="hidden" id="user_id" name="user_id" >
              </div>
            </div>
          </div>
        </div>
        <div class="form-actions">
          <button type="submit" name='sub' value='sub' class="btn blue"><i class="icon-ok"></i> Save</button>
          <button type="button" class="btn" data-dismiss="modal" >Cancel</button>
        </div>
      </form>
	  <span id="msgg"></span>
    </div>
	</div>
	<!-- END Change Password Modal -->
	
	
	<!-- BEGIN HEADER -->   
	<div class="header navbar navbar-inverse navbar-fixed-top">
		<!-- BEGIN TOP NAVIGATION BAR -->
		<div class="navbar-inner">
			<div class="container-fluid">
				<!-- BEGIN LOGO -->
				<a class="brand" href="#">
					<img src="<?php echo base_url().'../assets/img/logo1.png'; ?>" alt="logo" width="100px"/>
				</a>
			
				
				<a class="btn red " href="<?php echo base_url('admin/FREG0006/get_metro_phone_numbers')?>">
				    INTERCOM
				</a>
			    
			
				<a class="btn red" href="<?php echo base_url().'admin/FREG0006/get_metro_gallery'; ?>">
					<!--<img src="<?php echo base_url().'../assets/img/Gallery_icon.png'; ?>" alt="logo" width="40px"/>-->
					<i class="icon-picture"></i> Event 
				</a>
		   
				<ul class="nav pull-right">
				
				
					<li class="dropdown" id="header_notification_bar" >
						<a href="#" style="height:20px" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<i class="icon-warning-sign"></i>
						<span class="badge" id='noticount'>0</span>
						</a>
						<ul class="dropdown-menu extended notification">
							<li>
								<p>You have <span id='noticount2'> </span> New notifications</p>
							</li>
							<li>
								<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: auto;">
									<ul class="dropdown-menu-list scroller" style="height: auto; overflow: hidden; width: auto;" id='userNotify'>
									<!--Data loaded by ajax-->
									</ul>
									
									<div class="slimScrollBar ui-draggable" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 155.86px; background: rgb(161, 178, 189);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div>
								</div>
							</li>
							<li class="external">
								<a href="<?php echo base_url().'admin/NOTIFY001/index/';?>">See all notifications <i class="m-icon-swapright"></i></a>
							</li>
						</ul>
					</li>
						
					<li class="dropdown user">
					
						<a href="#" style="padding-top:12px;height:23px" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<i class="icon-user"></i>
						<span class="username" style=""> Admin<?php //echo $username; ?></span>
						<i class="icon-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
						
							<li><a href="javascript:;" id="trigger_fullscreen"><i class="icon-move"></i> Full Screen</a></li>
							<li><a href="#portlet-config-chgp" data-toggle="modal"><i class="icon-lock"></i> Change password</a></li>
							<li><a href="<?php echo base_url();?>auth/logout"><i class="icon-key"></i> Log Out</a></li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
				<!-- END TOP NAVIGATION MENU --> 
			</div>
		</div>
		<!-- END TOP NAVIGATION BAR -->
		<script>
			function changepass(){
				$.ajax({   
					type: "POST",  
					url: "<?php echo base_url('auth/change_password'); ?>",  
					data: "oldpass="+$("#oldpass").val+"&newpass="+$("#newpass").val+"&confpass="+$("#confpass").val, 
				 
					success: function(msg){ alert(msg); 
						$("#msgg").html(msg); 
					}  
				}); 
			}
		</script>	
	</div>
		<div class="page-container row-fluid" id="xyz">
		
   
