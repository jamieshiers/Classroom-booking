<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
* @package 		Service Desk Project 
* @author 		Service Desk Dev Team / Jamie Shiers
* @copyright    Copyright Jamie Shiers 2010
* @since 		Version "BETA"
* 
*/
 $name = $this->session->userdata['logged_in']; 
 	
 	echo $this->session->flashdata('msg');
 	
 	
 
 ?>

<h1>Welcome, <span><?php echo $name;?>!</span></h1>
<p>What would you like to do today?</p>

<h2> Make a booking </h2>
<hr />
<?php
	
	echo "<ul class='dash'>";
	foreach($rooms as $room)
	{?>
		<li>
			<a href="<?php echo site_url();?>/booking/booking/view/<?php echo $room['roomid'];?>">
				<img src="<?php echo base_url();?>images/icons/room.png" alt="<?php echo $room['name'];?>" title="<?php echo $room['name'];?>" />
				<span><?php echo $room['name'];?></span>
			</a>
		</li>
	<?php } ?>
	</ul>
	


<?php if($this->session->userdata['accesslevel'] == "admin")
{ ?>
	
	<h2>Admin Tasks</h2>
	<hr />
	
	<ul class="dash">
		
		
		<li>
			<a href="<?php echo site_url();?>/rooms">
				<img src="<?php echo base_url();?>images/icons/manage_room.png" alt="Manage Rooms" title="Manage Rooms"/>
				<span>Manage Rooms</span>
			</a>
		</li>
		
		<li>
			<a href="<?php echo site_url();?>/holiday">
				<img src="<?php echo base_url();?>images/icons/manage_holiday.png" alt="Manage Holidays" title="Manage Holidays"/>
				<span>Manage Holidays</span>
			</a>
		</li>
		<li>
			<a href="<?php echo site_url();?>/weeks/add_year">
				<img src="<?php echo base_url();?>images/icons/manage_holiday.png" alt="Manage Year" title="Manage Years" />
				<span>Manage Year</span>
			</a>
		</li>
		<li>
			<a href="<?php echo site_url();?>/subjects">
				<img src="<?php echo base_url();?>images/icons/add_period.png" alt="Add Period" title="Add a Period"/>
				<span>Manage Subjects</span>
			</a>
		</li>
		<li>
			<a href="<?php echo site_url();?>/period">
				<img src="<?php echo base_url();?>images/icons/manage_period.png" alt="Manage Periods" title="Manage Periods" />
				<span>Manage Periods</span>
			</a>
		</li>
		<li>
			<a href="<?php echo site_url();?>/booking/booking/uploadcsv">
				<img src="<?php echo base_url();?>images/icons/upload_csv.png" alt="Upload CSV" title="Upload a CSV" />
				<span>Upload CSV</span>
			</a>
		</li>
		<li>
			<a href="<?php echo site_url();?>/settings/settings/dashboard">
				<img src="<?php echo base_url();?>images/icons/upload_csv.png" alt="Upload CSV" title="Upload a CSV" />
				<span>Settings</span>
			</a>
		</li>
		
		
	</ul>

<?php }?>


