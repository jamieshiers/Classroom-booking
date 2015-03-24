<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model {

	protected $table = "booking";

    protected $fillable = array('roomId', 'periodId', 'username', 'class', 'lesson', 'startDate', 'endDate', 'weekNum');

}
