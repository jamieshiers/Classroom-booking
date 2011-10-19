<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js"></script>
		
			<script type="text/javascript">
				$(function() {
					$(".datepicker").datepicker({dateFormat: 'yy-mm-dd'});
				});
			</script>

			
		
		<link rel="stylesheet/less" href="<?php echo base_url();?>/css/style.less" type="text/css" >
		<script src="<?php echo base_url();?>/js/less.js" type="text/javascript"></script>
		
		
		
		
		<title><?php echo $template['title'];?> | Classroom Booking </title>
	</head>
	<body>
		
		<div id="container">
			<div class="login_logo">
				<img src="<?php echo base_url();?>images/logo.png" />
			</div>
			
		<div id="login_box">
			<div id="flashdata">
				<?php 
					if ($this->session->flashdata('error'))
					{
						echo "<div class='message error'><p>". $this->session->flashdata('error')."</p></div>";
					}
		
					?>
		</div>
				<?php echo $template['body'];?>
			
			
		</div>
	
		
		<div id="login_footer">
			<p class="login_footer">&copy; <?php echo date('Y');?> <a href="http://www.digitalschool.co.uk">Digital School Limited</p>
		</div>
		</div>
	</body>
</html>