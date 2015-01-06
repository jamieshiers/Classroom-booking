<?php namespace App\Transformers;

use Rooms;
use League\Fractal\TransformerAbstract;

class roomsTransformer extends TransformerAbstract {

    public function transform(Rooms $rooms)
    {
        return [
            "id"            => $rooms['id'],
            "roomName"      => $rooms['RoomName'],
            "roomType"      => $rooms['RoomType'],
            "bookingType"   => $rooms['BookingType'],
            "active"        => $rooms['Active']
        ];
    }
}

