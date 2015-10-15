<?php namespace Booking;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model {

	protected $table = "bookings";

    protected $fillable = array('roomId', 'periodId', 'username', 'class', 'lesson', 'startDate', 'endDate', 'weekNum', 'userId');

    public function user()
    {
        return $this->belongsTo('Booking\User', 'userId');
    }

    public function room()
    {
        return $this->belongsTo('Booking\Room', 'roomId');
    }



}
