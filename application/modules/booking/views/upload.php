<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @package 		Service Desk Project 
* @author 		Service Desk Dev Team / Jamie Shiers
* @copyright    Copyright Jamie Shiers 2010
* @since 		Version "BETA"
* 
*/



?>
<form enctype="multipart/form-data" action="<?php echo site_url(); ?>/booking/booking/processcsv" method="post" id="uploadcsv">
	<p align="center">
		CSV file:<br />
		<input type="file" name="csv" /><br /><br />
		<input type="submit" name="submit" value="Upload" /> 
		
	</p>
</form>