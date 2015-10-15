<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Http\Requests\CreateBookingRequest;
use App\Transformers\BookingTransformer;
use League\Fractal\Pagination\Cursor;
use Request;

class BookingController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     *
     * @Get("/bookings")
     * @middleware("jwt.auth")
     */
    public function index()
    {
        if ($currentCursorStr = Request::get('cursor', false)) {
            $booking = Booking::where('id', '>', $currentCursorStr->take(10)->get());
        } else {
            $booking = Booking::take(10)->get();
        }

        $prevCursorStr = Request::get('prevCursor', 11);
        $newCursorStr = $booking->last()->id;
        $cursor = new Cursor($currentCursorStr, $prevCursorStr, $newCursorStr, $booking->count());

        return $this->respondWithCursor($booking, new BookingTransformer(), $cursor);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     *
     * @Post("/bookings")
     */
    public function store(CreateBookingRequest $request)
    {
        $booking = Request::all();
        Booking::create($booking);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     *
     * @Get("/bookings/{id}")
     */
    public function show($id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return $this->errorNotFound('No Booking Found');
        }

        return $this->respondWithItem($booking, new BookingTransformer());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return Response
     *
     * @Put("/bookings/{id}")
     */
    public function update(CreateBookingRequest $request, $id)
    {
        $booking = Booking::find($id);
        $booking->update($request->all());
    }

    /**
     *	
     */
    public function refresh()
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     *
     * @Delete("/bookings/{id}")
     */
    public function destroy($id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return $this->errorNotFound();
        }

        $booking->delete();
    }

    /**
     *@Get("/bookings/find/{id}")
     */
    public function find($id)
    {
        $booking = Booking::find($id);

        return $booking->user;
    }
}
