<?php


class GetBookingsTest extends TestCase
{
    /**
     * Get all bookings from the system.
     *
     * @return void
     */
    public function Get_Bookings_Test()
    {
        $this->get('/bookings')->seeJson(['Test' => 'Test Data']);
    }
}
