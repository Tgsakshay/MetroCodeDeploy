	
	</div>
		
	<!-- END CONTAINER -->
	<div class="footer">
		<div class="footer-inner">
			2015 &copy; Metro Hospital
			                          
		</div>
		<div class="footer-tools">
		<!--
		<p style='float:right ;'>

		<a class="btn icn-only green" style="background-color:#44DED8" href="javascript:void(0)" onclick='goBack()'>
		<i class="m-icon-swapleft"></i>
		</a>
		<a class="btn icn-only green "style="background-color:#44DED8"  href="javascript:void(0)" onclick='goForward()'>
		<i class="m-icon-swapright "></i>
		</a>
		
		</p> -->
		</div>
	</div>
	</div>
	</div>
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
<script>
function getNotification() {
	first_name='';
	
		   try {
	
	$.ajax({   
        type: "GET",  
        url: "<?php echo base_url('admin/NOTIFY001/getNotification'); ?>",  
        data: "first_name="+first_name,
		 
        success: function(msg){  
		// alert(msg);
         
			var mainarry = msg.split("###~~~");
	      $("#userNotify").html(mainarry[0]); 
	      $("#noticount").html(mainarry[1]); 
	      $("#noticount2").html(mainarry[1]); 
        }  
    }); 
	       }
	catch (e) {
        alert(e);
    } 

}
getNotification();
</script>
	<!-- END FOOTER -->
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->   

	<script src="<?php echo base_url().'../assets/plugins/jquery-migrate-1.2.1.min.js'; ?>" type="text/javascript"></script>
	
	<script src="<?php echo base_url().'../assets/plugins/jquery-1.10.1.min.js'; ?>" type="text/javascript"></script>
	
	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="<?php echo base_url().'../assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js'; ?>" type="text/javascript"></script>      
	<script src="<?php echo base_url().'../assets/plugins/bootstrap/js/bootstrap.min.js'; ?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'../assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js'; ?>" type="text/javascript" ></script>
	<!--[if lt IE 9]>
	<script src="assets/plugins/excanvas.min.js"></script>
	<script src="assets/plugins/respond.min.js"></script>  
	<![endif]-->   
	<script src="<?php echo base_url().'../assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js'; ?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'../assets/plugins/jquery.blockui.min.js'; ?>" type="text/javascript"></script>  
	<script src="<?php echo base_url().'../assets/plugins/jquery.cookie.min.js'; ?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'../assets/plugins/uniform/jquery.uniform.min.js'; ?>" type="text/javascript" ></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS--> 

	<script src="<?php echo base_url().'../assets/plugins/flot/jquery.flot.js'; ?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'../assets/plugins/flot/jquery.flot.resize.js'; ?>" type="text/javascript"></script>
	
	<script src="<?php echo base_url().'../assets/plugins/chosen-bootstrap/chosen/chosen.jquery.min.js'; ?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'../assets/plugins/jquery.pulsate.min.js'; ?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'../assets/plugins/bootstrap-daterangepicker/date.js'; ?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'../assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js'; ?>" type="text/javascript"></script> 
	<script src="<?php echo base_url().'../assets/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js'; ?>" type="text/javascript"></script> 
	
	
	<!-- Date Picker -->
	
    
	<script type="text/javascript" src="<?php echo base_url().'../assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'; ?>"></script>

	
	<link href="<?php echo base_url().'../assets/date_time/css/jquery-ui.css'; ?>" rel="stylesheet" type="text/css" />

   <script src="<?php echo base_url().'../assets/date_time/js/jquery-ui.js'; ?>"></script>
	
	<!-- Date Picker -->
	
	<script src="<?php echo base_url().'../assets/plugins/bootstrap-daterangepicker/daterangepicker.js'; ?>" type="text/javascript"></script> 
	<script type="text/javascript" src="<?php echo base_url().'../assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js'; ?>"></script>    
	<script src="<?php echo base_url().'../assets/plugins/gritter/js/jquery.gritter.js'; ?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'../assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js'; ?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'../assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js'; ?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'../assets/plugins/jquery.sparkline.min.js'; ?>" type="text/javascript"></script>  
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="<?php echo base_url().'../assets/scripts/app.js'; ?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'../assets/scripts/index.js'; ?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'../assets/scripts/tasks.js'; ?>" type="text/javascript"></script> 
	<script src="<?php echo base_url().'../assets/scripts/ui-general.js'; ?>"></script>  	
	<!-- END PAGE LEVEL SCRIPTS -->  
	<script type="text/javascript" src="<?php echo base_url().'../assets/plugins/select2/select2.min.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'../assets/plugins/data-tables/jquery.dataTables.min.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'../assets/plugins/data-tables/DT_bootstrap.js'; ?>"></script>
	<script src="<?php echo base_url().'../assets/scripts/form-components.js'; ?>"></script>
	<script src="<?php echo base_url().'../assets/plugins/SimpleChart.js'; ?>"></script>
	<script src="<?php echo base_url().'../assets/scripts/table-advanced.js'; ?>"></script>
    <script src="<?php echo base_url().'../assets/scripts/datatables.min.js'; ?>"></script>
    <script src="<?php echo base_url().'../assets/jquery.table2excel.js'; ?>"></script>

	
<script>
(function($) {
    var defaults = {}
    $.fn.pos = function(options) {
        //define instance for use in child functions
        var $this = $(this);
	var data = {
		scan: '',
		swipe: ''
	};
        //set default options
        defaults = {
            scan: true,
	    submit_on_scan: false,
            swipe: true,
	    submit_on_swipe: false,
            events: {
                scan: {
                    barcode: 'scan.pos.barcode'
                },
                swipe: {
                    card: 'swipe.pos.card'
                }
            },
            regexp: {
                scan: {
                    barcode: '\\d+'
                },
                swipe: {
                    card: '\\%B(\\d+)\\^(\\w+)\\/(\\w+)\\^\\d+\\?;\\d+=(\\d\\d)(\\d\\d)\\d+\\?'
                }
            },
            prefix: {
                scan: {
                    barcode: ''
                },
                swipe: {
                    card: ''
                }
            }
        };
        //extend options
        $this.options = $.extend(true, {}, defaults, options);

        $this.keypress(function(event) {
            if ($this.options.scan) {
                if (event.which == 13) {
                    if( !$this.options.submit_on_scan ){
			event.preventDefault();
		    }
                    var scanexp = new RegExp('^' + $this.options.prefix.scan.barcode + $this.options.regexp.scan.barcode + '$');
                    if (data.scan.match(scanexp)) {
                        $this.trigger({
                            type: $this.options.events.scan.barcode,
                            code: data.scan,
                            time: new Date()
                        });
                    }
                    data.scan = '';
                } else {
                    var char = String.fromCharCode(event.which);
                    data.scan += char;
                }
            }

           
        });
    };
})(jQuery);
</script>
	
	<script>
		jQuery(document).ready(function() {    
			// initiate layout and plugins
			App.init();
			// FormSamples.init();
			FormComponents.init();
			UIGeneral.init();

			// Index.init();
			//Index.initJQVMAP(); // init index page's custom scripts
			Index.initCalendar(); // init index page's custom scripts
			//Index.initCharts(); // init index page's custom scripts
			// Index.initChat();
			// Index.initMiniCharts();
			// Index.initDashboardDaterange();
			// Index.initIntro();
		    Tasks.initDashboardWidget();	
		});
	</script>
	
<div class="page-container">
		
   </div>
	<!-- END JAVASCRIPTS -->
	
	<script>
	 myFunction();
	</script>
	

	</script>
	
</body>
<!-- END BODY -->
</html>