@extends('layout')
@section('content')
<h1>Room Booking</h1>
<table>

    @foreach($bookings as $booking)
        <tr>
            <td>{{$booking->username }}</td>
        </tr>
    @endforeach
</table>
@stop