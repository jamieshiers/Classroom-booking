<?php

namespace Booking\Transformers;

use Booking\Booking;
use League\Fractal\TransformerAbstract;

class BookingTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        'room',
        'user',
    ];


    public function transform(Booking $booking)
    {
        return [
            'id'        => $booking['id'],
            'roomId'    => $booking['roomId'],
            'userId'    => $booking['userId'],
            'class'     => $booking['class'],
            'lesson'    => $booking['lesson'],
            'startDate' => $booking['startDate'],
            'endDate'   => $booking['endDate'],
            'block'     => $booking['block'],
            'weekNum'   => $booking['weekNum'],
        ];
    }

    public function includeRoom(Booking $booking)
    {
        $room = $booking->room;

        return $this->collection($room, new RoomTransformer());
    }

    public function includeUser(Booking $booking)
    {
        $user = $booking->user;

        return $this->collection($user, new Usertransformer());
    }
}
