@extends('layouts.app')

@section('content')
<div class="page-container">
    <h1 class="page-title">Staff Dashboard</h1>
    
    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wider">Total Bikes</h3>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalBikes }}</p>
        </div>
        
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wider">In Maintenance</h3>
            <p class="text-3xl font-bold text-red-600 mt-2">{{ $bikesMaintenance }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wider">Active Bookings</h3>
            <p class="text-3xl font-bold text-brand-600 mt-2">{{ $activeBookings }}</p>
        </div>
    </div>

    {{-- Recent Bookings --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
            <h2 class="text-lg font-bold text-gray-900">Recent Bookings</h2>
            <a href="#" class="text-sm text-brand-600 hover:text-brand-700 font-medium">View All</a>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-50 text-gray-900 font-semibold uppercase tracking-wider text-xs">
                    <tr>
                        <th class="px-6 py-3">Booking ID</th>
                        <th class="px-6 py-3">Customer</th>
                        <th class="px-6 py-3">Bike</th>
                        <th class="px-6 py-3">Dates</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Delivery</th>
                        <th class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($recentBookings as $booking)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-900">#{{ $booking->id }}</td>
                        <td class="px-6 py-4">{{ $booking->user->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $booking->bike->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($booking->start_date)->format('M d') }} - 
                            {{ \Carbon\Carbon::parse($booking->end_date)->format('M d') }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                {{ $booking->status === 'active' ? 'bg-green-100 text-green-700' : 
                                   ($booking->status === 'cancelled' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700') }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('staff.assignDesc') }}" method="POST" class="flex flex-col space-y-2">
                                @csrf
                                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                
                                <div class="flex items-center space-x-2">
                                    <select name="delivery_boy_id" class="text-xs border-gray-200 rounded-lg focus:ring-brand-500 focus:border-brand-500 py-1 {{ $errors->has('delivery_boy_id') ? 'border-red-500' : '' }}"
                                        {{ $booking->delivery_status !== 'pending' ? 'disabled' : '' }}>
                                        <option value="">Select Delivery Boy</option>
                                        @foreach($deliveryBoys as $boy)
                                            <option value="{{ $boy->id }}" {{ $booking->delivery_boy_id == $boy->id ? 'selected' : '' }}>
                                                {{ $boy->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    
                                    @if($booking->delivery_status === 'pending')
                                        <button type="submit" class="text-xs bg-brand-600 text-white px-3 py-1 rounded-lg hover:bg-brand-700 transition">
                                            Assign
                                        </button>
                                    @else
                                        <span class="text-xs text-gray-500 italic">{{ ucfirst($booking->delivery_status) }}</span>
                                    @endif
                                </div>
                                @error('delivery_boy_id')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </form>
                        </td>
                        <td class="px-6 py-4">
                            <div x-data="{ open: false }">
                                <button @click="open = !open" class="text-brand-600 hover:text-brand-800 text-xs font-semibold">
                                    Manage
                                </button>
                                
                                <div x-show="open" @click.outside="open = false" class="absolute right-10 mt-2 w-64 bg-white rounded-lg shadow-xl border border-gray-100 z-10 p-4">
                                    <form action="{{ route('staff.updatePrice', $booking->id) }}" method="POST">
                                        @csrf
                                        <h4 class="text-xs font-bold text-gray-700 mb-2">Update Booking</h4>
                                        
                                        <div class="mb-2">
                                            <label class="block text-xs text-gray-500">Status</label>
                                            <select name="status" class="w-full text-xs border-gray-200 rounded">
                                                <option value="active" {{ $booking->status == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="returned" {{ $booking->status == 'returned' ? 'selected' : '' }}>Returned</option>
                                                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                        </div>

                                        <div class="mb-2">
                                            <label class="block text-xs text-gray-500">Damage Charges (₹)</label>
                                            <input type="number" name="damage_charges" value="{{ $booking->damage_charges }}" class="w-full text-xs border-gray-200 rounded" placeholder="0.00">
                                        </div>

                                        <button type="submit" class="w-full bg-brand-600 text-white text-xs py-1.5 rounded hover:bg-brand-700">
                                            Update
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">No recent bookings found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
