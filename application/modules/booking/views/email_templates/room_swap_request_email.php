<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
	<p>Dear, <?php echo $user;?></p>
	
	<p><?php echo $request_user;?> has requested to use a room which you have previously booked, <?php echo $request_user;?> would like to use <?php echo $room->name;?>, <?php echo $periods->period_name;?> on <?php echo $date;?></p>
	
	<p>If you would like to let <?php echo $request_user;?> use this room, please log into the booking system or by clicking <a href="<?php echo site_url();?>">Here</a></p>
	
	<p>The Friendly ClassroomBooking Email Bot</p>
	
	

</body>
</html>