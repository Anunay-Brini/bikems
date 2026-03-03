@extends('layouts.delivery')

@section('content')
<div class="mb-10">
    <h1 class="text-3xl font-display font-bold text-gray-900">Delivery Dashboard</h1>
    <p class="text-gray-500 mt-2 text-lg">Manage your assigned deliveries and update status.</p>
</div>

@if($bookings->isEmpty())
    <div class="bg-white rounded-3xl p-12 text-center shadow-lg border border-gray-100">
        <div class="w-20 h-20 bg-brand-50 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fa-solid fa-box-open text-3xl text-brand-400"></i>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-2">No Deliveries Assigned</h3>
        <p class="text-gray-500 max-w-sm mx-auto">You currently have no pending deliveries. Check back later!</p>
    </div>
@else
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($bookings as $booking)
        <div class="bg-white rounded-3xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 mb-3">
                        Booking #{{ $booking->id }}
                    </span>
                    <h3 class="text-xl font-bold text-gray-900">{{ $booking->user->name }}</h3>
                </div>
                <div class="w-10 h-10 rounded-full bg-brand-50 flex items-center justify-center text-brand-600 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-map-location-dot"></i>
                </div>
            </div>

            <div class="space-y-4 mb-8">
                @php
                    $isReturning = in_array($booking->delivery_status, ['returned', 'delivered']);
                    $currentLocation = $isReturning ? ($booking->drop_location ?? $booking->delivery_address) : ($booking->pickup_location ?? $booking->delivery_address);
                    $locationLabel = $isReturning ? 'Drop Location' : 'Pickup Location';
                @endphp
                
                <div class="flex items-start gap-3">
                    <i class="fa-solid fa-location-dot text-gray-400 mt-1"></i>
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold tracking-wider">{{ $locationLabel }}</p>
                        <p class="text-gray-700 font-medium text-sm leading-relaxed">{{ $currentLocation ?? 'No address provided' }}</p>
                        @if($currentLocation)
                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($currentLocation) }}" target="_blank" class="text-brand-600 hover:text-brand-700 text-xs font-semibold mt-1 inline-flex items-center group/map">
                                <i class="fa-solid fa-map-location-dot mr-1 group-hover/map:scale-110 transition-transform"></i> Open in Google Maps
                            </a>
                        @endif
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <i class="fa-solid fa-flag text-gray-400 mt-1"></i>
                    <div>
                        <p class="text-xs text-gray-400 uppercase font-bold tracking-wider">Current Status</p>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-md text-xs font-medium 
                            {{ $booking->delivery_status == 'delivered' ? 'bg-green-50 text-green-700' : '' }}
                            {{ $booking->delivery_status == 'assigned' ? 'bg-blue-50 text-blue-700' : '' }}
                            {{ $booking->delivery_status == 'picked_up' ? 'bg-yellow-50 text-yellow-700' : '' }}
                            {{ $booking->delivery_status == 'returned' ? 'bg-gray-100 text-gray-700' : '' }}">
                            <span class="w-1.5 h-1.5 rounded-full 
                                {{ $booking->delivery_status == 'delivered' ? 'bg-green-500' : '' }}
                                {{ $booking->delivery_status == 'assigned' ? 'bg-blue-500' : '' }}
                                {{ $booking->delivery_status == 'picked_up' ? 'bg-yellow-500' : '' }}
                                {{ $booking->delivery_status == 'returned' ? 'bg-gray-500' : '' }}">
                            </span>
                            {{ ucfirst(str_replace('_', ' ', $booking->delivery_status)) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-gray-100">
                <form method="POST" action="{{ route('delivery.updateStatus', $booking->id) }}">
                    @csrf
                    <label for="status-{{ $booking->id }}" class="block text-xs font-semibold text-gray-700 mb-2">Update Status</label>
                    <div class="flex gap-2">
                        <select name="status" id="status-{{ $booking->id }}" class="block w-full rounded-xl border-gray-200 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm bg-gray-50 text-gray-700 py-2.5">
                            <option value="assigned" {{ $booking->delivery_status == 'assigned' ? 'selected' : '' }}>Assigned</option>
                            <option value="picked_up" {{ $booking->delivery_status == 'picked_up' ? 'selected' : '' }}>Picked Up</option>
                            <option value="delivered" {{ $booking->delivery_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="returned" {{ $booking->delivery_status == 'returned' ? 'selected' : '' }}>Returned</option>
                        </select>
                        <button type="submit" class="p-2.5 rounded-xl bg-brand-600 text-white hover:bg-brand-700 transition-colors shadow-lg shadow-brand-500/20">
                            <i class="fa-solid fa-check"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
    </div>
@endif
@endsection
