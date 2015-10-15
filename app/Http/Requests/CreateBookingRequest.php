<?php

namespace Booking\Http\Requests;

use Illuminate\Http\Response;
use Request;

class CreateBookingRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function response(array $errors)
    {
        return Response::create($errors, 403);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'roomId'        => 'required|integer',
            'periodId'      => 'required|integer',
            'class'         => 'required|string',
            'lesson'        => 'required|string',
            'startDate'     => 'required',
            'endDate'       => 'required',
            'block'         => 'required',
            'weekNum'       => 'required',
            'userId'        => 'required|integer',
        ];
    }
}
