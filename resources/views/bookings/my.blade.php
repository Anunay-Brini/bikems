@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <h1>My Bookings</h1>

    @if($bookings->count())
        <table class="table">
            <tr>
                <th>Bike</th>
                <th>Date</th>
                <th>Status</th>
            </tr>

            @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->bike->name ?? 'N/A' }}</td>
                    <td>{{ $booking->created_at->format('d M Y') }}</td>
                    <td>{{ $booking->status }}</td>
                </tr>
            @endforeach
        </table>
    @else
        <p>No bookings found.</p>
    @endif
</div>
@endsection
