<?php

class Rooms extends Eloquent {

    protected $table = 'rooms';

    protected $fillable = ['RoomName', 'RoomType', 'BookingType', 'Active'];
}