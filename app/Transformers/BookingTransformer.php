<?php namespace App\Transformers;

use App\Booking;
use League\Fractal\TransformerAbstract;

class BookingTransformer extends TransformerAbstract
{


    /**
     *
     * All the default includes are listed here
     *
     * @var array
     */
    protected $defaultIncludes = [
        'user'
    ];

    /**
     *
     * Controls the way the data for bookings is displayed
     *
     * @param Booking $booking
     * @return array
     */
    public function transform(Booking $booking)
    {
        return [
            'id'        => $booking['id'],
            'roomId'    => $booking['roomId'],
            'periodId'  => $booking['periodId'],
            'class'     => $booking['class'],
            'lesson'    => $booking['lesson'],
            'startDate' => $booking['startDate'],
            'endDate'   => $booking['endDate'],
            'block'     => $booking['block'],
            'weekNum'   => $booking['weekNum'],
        ];
    }

    /**
     * @param Booking $booking
     * @return \League\Fractal\Resource\Item
     */
    public function includeUser(Booking $booking)
    {
        $user = $booking->user;

        return $this->item($user, new userTransformer);
    }
}
