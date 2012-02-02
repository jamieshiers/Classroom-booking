<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery.colorbox-min.js"></script>
		<link rel="stylesheet" href="<?php echo base_url();?>css/colorbox.css" type="text/css">
		<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css">
		
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
					<div id="flashdata">
						<?php 
							if ($this->session->flashdata('error'))
							{
								echo "<div class='message error'><p>". $this->session->flashdata('error')."</p></div>";
							}

							if ($this->session->flashdata('msg'))
							{
								echo "<div class='message msg'><p>". $this->session->flashdata('msg')."</p></div>";
							}

							?>
					</div>
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

	<script type="text/javascript" charset="utf-8">
	  var is_ssl = ("https:" == document.location.protocol);
	  var asset_host = is_ssl ? "https://s3.amazonaws.com/getsatisfaction.com/" : "http://s3.amazonaws.com/getsatisfaction.com/";
	  document.write(unescape("%3Cscript src='" + asset_host + "javascripts/feedback-v2.js' type='text/javascript'%3E%3C/script%3E"));
	</script>

	<script type="text/javascript" charset="utf-8">
	  var feedback_widget_options = {};

	  feedback_widget_options.display = "overlay";  
	  feedback_widget_options.company = "digitalschool";
	  feedback_widget_options.placement = "right";
	  feedback_widget_options.color = "#222";
	  feedback_widget_options.style = "idea";








	  var feedback_widget = new GSFN.feedback_widget(feedback_widget_options);
	</script>
	</body>
</html>