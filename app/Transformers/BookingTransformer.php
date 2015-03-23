<?php namespace App\Transformers;

use App\Booking;
use League\Fractal\TransformerAbstract;

class BookingTransformer extends TransformerAbstract
{
    public function transform(Booking $booking)
    {
        return [
            'id'        => $booking['id'],
            'roomId'    => $booking['roomId'],
            'periodId'  => $booking['periodId'],
            'username'  => $booking['username'],
            'class'     => $booking['class'],
            'lesson'    => $booking['lesson'],
            'startDate' => $booking['startDate'],
            'endDate'   => $booking['endDate'],
            'block'     => $booking['block'],
            'weekNum'   => $booking['weekNum'],
        ];
    }
}
