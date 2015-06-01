<?php namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class roomTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
      'user'
    ];


    public function transform(Room $room)
    {
        return [
            'id'        => $room['id'],
            'Room Name'  => $room['roomName'],
            'bookable'     => $room['bookable'],
        ];
    }
}


