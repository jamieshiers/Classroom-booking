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
 ?>

<?php 
if($this->session->userdata['logged_in'] == 'superuser' && $this->session->userdata['counter'] < 4)

{?>
	<div class="wrapper">
	<div class="getting_started">
		<h2>Getting Started</h2>
		<p>Get set up in 7 simple steps, once complete you'll be the booking master! This section will disappear after your third login. </p>
		<ul class="get_started">
			<li>
				<h4>Set up your academic year</h4>
				<a href="<?php echo site_url();?>/weeks/add_year" class="button green">Add</a>
			</li>
			<li>
				<h4>Set up your week structure</h4>
				<a href="<?php echo site_url();?>/weeks" class="button green">Add</a>
			</li>
			<li>
				<h4>Add your holidays</h4>
				<a href="<?php echo site_url();?>/holiday" class="button green">Add</a>
			</li>
			<li>
				<h4>Add Classrooms</h4>
				<a href="<?php echo site_url();?>/rooms" class="button green">Add</a>
			</li>
			<li>
				<h4>Add Teaching Periods</h4>
				<a href="<?php echo site_url();?>/period" class="button green">Add</a>
			</li>
			<li>
				<h4>Add Teaching Subjects</h4>
				<a href="<?php echo site_url();?>/subjects" class="button green">Add</a>
			</li>
			<li>
				<h4>Add Extra Users</h4>
				<a href="<?php echo site_url();?>/users/admin" class="button green">Add</a>
			</li>
		</ul>
	</div></div>


<?php }

if($swaps || $room_admin)
{
	$number1 = count($swaps);
	$number2 = count($room_admin);
	$number = $number1+$number2;
	if($number === 1)
	{
		$note = "notification";
	}
	else
	{
		$note = "notifications";
	}
	
	?>
	
	<div class="message swap">
		<h3>You have <?php echo $number; echo " new ".$note;?></h3>
		<a href="<?php echo site_url();?>/dashboard/notifications" class="button blue">Read</a>
	</div>
	
	
	
	<?php 
}






?>




<div class="clear"></div>
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
	
	<div style="clear:both;"></div>

<?php if($this->session->userdata['accesslevel'] == "admin")
{ ?>
	<div class="clear"></div>
	<h2>Admin Tasks</h2>
	<hr />
	
	<ul class="dash">
		
		
		<li>
			<a href="<?php echo site_url();?>/rooms">
				<img src="<?php echo base_url();?>images/icons/room.png" alt="Manage Rooms" title="Manage Rooms"/>
				<span>Manage Rooms</span>
			</a>
		</li>
		
		<li>
			<a href="<?php echo site_url();?>/holiday">
				<img src="<?php echo base_url();?>images/icons/holiday.png" alt="Manage Holidays" title="Manage Holidays"/>
				<span>Manage Holidays</span>
			</a>
		</li>
		<li>
			<a href="<?php echo site_url();?>/weeks/add_year">
				<img src="<?php echo base_url();?>images/icons/holiday.png" alt="Manage Year" title="Manage Years" />
				<span>Manage Year</span>
			</a>
		</li>
		<li>
			<a href="<?php echo site_url();?>/subjects">
				<img src="<?php echo base_url();?>images/icons/subject.png" alt="Add Period" title="Add a Period"/>
				<span>Manage Subjects</span>
			</a>
		</li>
		<li>
			<a href="<?php echo site_url();?>/period">
				<img src="<?php echo base_url();?>images/icons/period.png" alt="Manage Periods" title="Manage Periods" />
				<span>Manage Periods</span>
			</a>
		</li>
		<li>
			<a href="<?php echo site_url();?>/weeks">
				<img src="<?php echo base_url();?>images/icons/period.png" alt="Manage Week" title="Manage Week" />
				<span>Manage Weeks</span>
			</a>
		</li>
		<li>
			<a href="<?php echo site_url();?>/years">
				<img src="<?php echo base_url();?>images/icons/period.png" alt="Manage Year Groups" title="Manage Year Groups" />
				<span>Manage Year Groups</span>
			</a>
		</li>
		<li>
			<a href="<?php echo site_url();?>/users/admin/">
				<img src="<?php echo base_url();?>images/icons/user.png" alt="Manage Users" title="Manage Users" />
				<span>Manage Users</span>
			</a>
		</li>
		<li>
			<a href="<?php echo site_url();?>/settings/settings/dashboard">
				<img src="<?php echo base_url();?>images/icons/settings.png" alt="Settings" title="Settings" />
				<span>Settings</span>
			</a>
		</li>
		
		
	</ul>

<?php }?>


