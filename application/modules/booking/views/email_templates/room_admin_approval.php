<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
	<p>Hey, <?php echo $admin_user;?></p>
	
	<p><?php echo $user;?> has requested to use a room of which you are the administrator. <?php echo $user;?> would like to use <?php echo $room->name;?>, <?php echo $period->period_name;?> on <?php echo $date;?></p>
	
	<p>If you would like to let <?php echo $user;?> use this room, please log into the booking system or by clicking <a href="<?php echo site_url();?>">Here</a></p>
	
	
	
	

</body>
</html>