<?php

namespace App\Http\Controllers;

use App\Room;
use App\Transformers\roomTransformer;
use League\Fractal\Pagination\Cursor;
use Request;

class roomController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     *
     * @Get("/rooms")
     */
    public function index()
    {
        if ($currentCursorStr = Request::get('cursor', false)) {
            $room = Room::where('id', '>', $currentCursorStr->take(10)->get());
        } else {
            $room = Room::take(10)->get();
        }

        $prevCursorStr = Request::get('prevCursor', 11);
        $newCursorStr = $room->last()->id;
        $cursor = new Cursor($currentCursorStr, $prevCursorStr, $newCursorStr, $room->count());

        return $this->respondWithCursor($room, new roomTransformer(), $cursor);
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
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
