<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controllerx;
use App\Transformers\BookingTransformer;
use App\Booking;
use Request;
use League\Fractal\Pagination\Cursor;

class BookingController extends ApiController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
     *
     * @Get("/bookings")
	 */
	public function index()
	{
		if($currentCursorStr = Request::get('cursor', false))
        {
            $booking = Booking::where('id', '>', $currentCursorStr->take(10)->get());
        } else {
            $booking = Booking::take(10)->get();
        }

        $prevCursorStr = Request::get('prevCursor', 11);
        $newCursorStr = $booking->last()->id;
        $cursor = new Cursor($currentCursorStr, $prevCursorStr, $newCursorStr, $booking->count());
        return $this->respondWithCursor($booking, new BookingTransformer, $cursor);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
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
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
