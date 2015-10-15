<?php

namespace Booking\Transformers;

use Booking\Booking;
use League\Fractal\TransformerAbstract;

class BookingTransformer extends TransformerAbstract
{
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
}
