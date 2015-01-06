@extends('layout')
@section('content')
<table>
	<tr>
		<th>Room Name</th>
		<th>Room Type</th>
		<th>Booking Type</th>
		<th>Active</th>
	</tr>
	@foreach($rooms as $room)
		<tr>
			<td>{{ $room->RoomName }}</td>
			<td>{{ $room->RoomType }}</td>
			<td>{{ $room->BookingType }}</td>
			<td>{{ $room->Active }}</td>
		</tr>
	@endforeach

</table>
	
@stop

