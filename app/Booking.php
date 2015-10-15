<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';

    protected $fillable = ['roomId', 'periodId', 'username', 'class', 'lesson', 'startDate', 'endDate', 'weekNum'];

    public function user()
    {
        return $this->belongsTo('App\User', 'userId');
    }

    public function room()
    {
        return $this->belongsTo('App\Room', 'roomId');
    }
}
