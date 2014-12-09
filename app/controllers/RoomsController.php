<?php

use App\Transformers\RoomsTransformer;


class RoomsController extends ApiController {

    /**
     * Display a listing of the resource.
     * GET /rooms
     *
     * @return Response
     */
    public function index()
    {
    
        // Grab the rooms from the database and then pass straight to the view
        
        $rooms = Rooms::take(10); 

        return $this->respondWithCollection($rooms, new RoomsTransformer);

    }

    /**
     * Show the form for creating a new resource.
     * GET /rooms/create
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * POST /rooms
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     * GET /rooms/{id}
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
     * GET /rooms/{id}/edit
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
     * PUT /rooms/{id}
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
     * DELETE /rooms/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}