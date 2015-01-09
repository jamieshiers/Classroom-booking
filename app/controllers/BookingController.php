<?php

use League\Period\Period;
use Carbon\Carbon;

class BookingController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /booking
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /booking/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /booking
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /booking/{id}
	 *
	 * @param  int  $id
     * @param  date $date
	 * @return Response
	 */
	public function show($id)
	{
        // Get the current Date
        $dateNow = Carbon::now();
        $startDate = $dateNow->toDateString();
        $startOfWeek = $dateNow->startOfWeek();
        $endDate = $dateNow->endOfWeek();

        $bookings =  Booking::where('startDate', '>', $startOfWeek )->where('endDate', '<', $endDate);

        foreach($bookings as $booking)
        {
            echo $booking['id'];
        }



	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /booking/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /booking/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /booking/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}