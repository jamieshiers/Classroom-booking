<?php namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class userTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id'        => $user['id'],
            'username'  => $user['username'],
            'email'     => $user['email'],
        ];
    }
}
