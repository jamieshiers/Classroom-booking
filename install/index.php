<?php

error_reporting(E_NONE);

$db_config_path = '../application/config/database.php';

// Only load the classes in case the user submitted the form
if($_POST) {

	// Load the classes and create the new objects
	require_once('includes/core_class.php');
	require_once('includes/database_class.php');

	$core = new Core();
	$database = new Database();


	// Validate the post data
	if($core->validate_post($_POST) == true)
	{

		// First create the database, then create tables, then write config file
		if($database->create_database($_POST) == false) {
			$message = $core->show_message('error',"The database could not be created, please verify your settings.");
		} else if ($database->create_tables($_POST) == false) {
			$message = $core->show_message('error',"The database tables could not be created, please verify your settings.");
		} else if ($core->write_config($_POST) == false) {
			$message = $core->show_message('error',"The database configuration file could not be written, please chmod /application/config/database.php file to 777");
		}

		// If no errors, redirect to registration page
		if(!isset($message)) {
		  $redir = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
      $redir .= "://".$_SERVER['HTTP_HOST'];
      $redir .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
      $redir = str_replace('install/','',$redir);
			header( 'Location: ' . $redir . 'dashboard' ) ;
		}

	}
	else {
		$message = $core->show_message('error','Not all fields have been filled in correctly. The host, username, password, and database name are required.');
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="../css/style.css" type="text/css">
		
	
		
		<title>Install | Classroom Booking</title>
		
	</head>
	<body>
		<div id="container">
			<div class="header-bar">
				<div class="header content">
					<div class="logo"> 
						<img src="../images/logo.png" alt="Dashboard" /></a> 
					</div>
					<div class="nav-setup">
							<h2>Need Help?</h2>
							<h4>Call 0330 321 1718 <br />Mon - Fri 9am - 5pm</h4>
							
					</div><!-- Nav  -->
				</div><!-- header content -->
			</div><!-- header-bar -->
			<div class="content sidebar">
				<div id="main">
				    <h1>One Time Install</h1>
					<h3>It only takes a minute</h3>
				    <?php if(is_writable($db_config_path)):?>

						  <?php if(isset($message)) {echo '<p class="error">' . $message . '</p>';}?>

						  <form id="install_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
							<fieldset>
					          <legend>Site Settings</legend>
					          <label for="url">URL to access classroom booking</label><input type="text" id="url" class="input_text" name="url" placeholder="http://localhost/booking">
					        </fieldset>
						
				        <fieldset>
				          <legend>Database settings</legend>
				          <label for="hostname">Hostname</label><input type="text" id="hostname" value="localhost" class="input_text" name="hostname" />
				          <label for="username">Username</label><input type="text" id="username" class="input_text" name="username" />
				          <label for="password">Password</label><input type="password" id="password" class="input_text" name="password" />
				          <label for="database">Database Name</label><input type="text" id="database" class="input_text" name="database" />
				        </fieldset>
						<input type="submit" value="Install" id="submit" class="button green" />
						  </form>
						
				
				</div>
				<div id="sidebar">
					<h2>Help</h2>
					<H3>URL</h3>
						<p>This should be the URL of where you plan to access classroom booking from. E.G. http://booking.domain.com or http://localhost/booking.</p>
				</div>
		
		</div>
			<div id="footer">

				<p class="footer_text">Powered by <a href="http://www.digitalschool.co.uk">Digital School</a></p>
				<p class="footer_text">&copy; <a href="http://www.digitalschool.co.uk">Digital School Limited</a> <?php echo date('Y');?> All Rights Reserved</p>
			</div>
		<!-- End of Footer -->

	  <?php else: ?>
      <p class="error">Please make the /application/config/database.php file writable. <strong>Example</strong>:<br /><br /><code>chmod 777 application/config/database.php</code></p>
	  <?php endif; ?>
	</div>
	</body>
</html>

