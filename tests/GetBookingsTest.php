<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GetBookingsTest extends TestCase
{
    /**
     * Get all bookings from the system
     *
     * @return Void
     */

    public function Get_Bookings_Test()
    {
        $this->get('/bookings')->seeJson(['Test' => 'Test Data',]);
    }
}