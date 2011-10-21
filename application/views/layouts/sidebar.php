<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>/js/jquery.colorbox-min.js"></script>
		<link rel="stylesheet" href="<?php echo base_url();?>/css/colorbox.css" type="text/css" >
		<link rel="stylesheet" href="/css/datepicker.css" type="text/css" >
		
		
		
		<link rel="stylesheet/less" href="<?php echo base_url();?>/css/style.less" type="text/css" >
		<script src="<?php echo base_url();?>/js/less.js" type="text/javascript"></script>
		<!-- Date Picker Set up -->
			<script type="text/javascript">
				var address = "<?php echo site_url();?>";
				var path = '/booking/booking/view/';
				var id = "<?php echo $id;?>";
				
				$(function() {
					$(".datepicker").datepicker({dateFormat: 'yy-mm-dd', maxDate: '+1m',
					beforeShowDay: $.datepicker.noWeekends,
					onSelect: function(date)
					
					{
						window.location.replace(address+path+id+"/"+(date));
					}
					
					});
					
					
				});
				</script>
				
				<script type="text/javascript">
					$(document).ready(function(){
						$('a.colorbox').colorbox();
					});
				</script> 
				
				
		<title><?php echo $template['title'];?> | Classroom Booking </title>
	</head>
	<body>
		<!-- Container -->
		<div id="container">
			<div class="header-bar">
				<div class="header content">
					<div class="logo"> 
						<a href="<?php echo site_url();?>/dashboard" title="Dashboard" ><img src="<?php echo base_url();?>/images/logo.png" alt="Dashboard" /></a> 
					</div>
					<div class="nav">
						<ul>
							<li><a href="<?php echo site_url();?>/dashboard" class="button blue">Dashboard</a></li>
							<li><a href="<?php echo site_url();?>/users/admin/logout" title="Logout" class="button red">Logout</a></li>
						</ul>	
					</div>
				</div>
			</div>
			<div class="content sidebar">
				<div id="main">
				<?php echo $template['body'];?>
				</div>
				<div id="sidebar">
					<?php echo $template['partials']['right_sidebar']; ?>	
				</div>
		
		</div></div>
		<!-- End of Container -->
		<div id="footer">

			<p class="footer_text">Powered by <a href="http://www.digitalschool.co.uk">Digital School</a></p>
			<p class="footer_text">&copy; <a href="http://www.digitalschool.co.uk">Digital School Limited</a> <?php echo date('Y');?> All Rights Reserved</p>
		</div>
	<!-- End of Footer -->

		<script type="text/javascript">
		  var uvOptions = {};
		  (function() {
		    var uv = document.createElement('script'); uv.type = 'text/javascript'; uv.async = true;
		    uv.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'widget.uservoice.com/rjZpHYz9bkqN6DnAZGog.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(uv, s);
		  })();
		</script>
	</body>
</html>