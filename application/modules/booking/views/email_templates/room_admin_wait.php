<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
	<p>Hey there, <?php echo $this->session->userdata('logged_in');?></p>
	
	<p>The booking you have just made requires approval from <?php echo $admin_user;?>. You will receive another email letting you know whether your booking was successful or not.</p>

</body>
</html>