<h2>Week Set Up</h2>
<?php

echo form_open('weeks/weeks/save_weeks');
echo form_label('Number of Weeks', 'week_number');
$weeks = array( '1' => '1', '2'=>'2');
echo form_dropdown('week_num', $weeks, "select");
echo form_label('Week 1 Name', 'week1');
echo form_input('week1', $week_1_name);
echo form_label('Week 2 Name', 'week2');
echo form_input('week2', $week_2_name);
echo form_submit('submit', 'Save');
echo form_close();

?>