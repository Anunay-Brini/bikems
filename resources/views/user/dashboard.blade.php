@extends('layouts.app')

@section('content')
<div class="space-y-12">
    <!-- Header -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 font-display">Welcome back, {{ Auth::user()->name }}!</h1>
            <p class="text-gray-500 mt-1">Here's what's happening with your rental activity.</p>
        </div>
        <a href="{{ route('bikes.browse') }}" class="px-5 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-medium rounded-xl transition-all shadow-lg shadow-brand-500/30 flex items-center gap-2">
            <i class="fa-solid fa-motorcycle"></i> Book a New Ride
        </a>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
        <!-- Active Bookings -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-5 hover:shadow-md transition-shadow">
            <div class="p-4 bg-blue-50 text-blue-600 rounded-xl text-2xl">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
            <div>
                <h3 class="text-3xl font-bold text-gray-900">{{ $activeBookings ?? 0 }}</h3>
                <p class="text-gray-500 font-medium">Active Bookings</p>
            </div>
        </div>

        <!-- Past Trips -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-5 hover:shadow-md transition-shadow">
            <div class="p-4 bg-purple-50 text-purple-600 rounded-xl text-2xl">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
            <div>
                <h3 class="text-3xl font-bold text-gray-900">{{ $pastBookings ?? 0 }}</h3>
                <p class="text-gray-500 font-medium">Past Trips</p>
            </div>
        </div>

        <!-- Wallet Balance -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-5 hover:shadow-md transition-shadow">
            <div class="p-4 bg-green-50 text-green-600 rounded-xl text-2xl">
                <i class="fa-solid fa-indian-rupee-sign"></i>
            </div>
            <div>
                <h3 class="text-3xl font-bold text-gray-900">₹{{ number_format($totalSpent ?? 0) }}</h3>
                <p class="text-gray-500 font-medium">Total Spent</p>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div>
        <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-bolt text-brand-500"></i> Quick Actions
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <a href="{{ route('bikes.browse') }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                <div class="h-12 w-12 bg-orange-50 text-orange-600 rounded-xl flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-search"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Browse Bikes</h3>
                <p class="text-gray-500 text-sm">Explore our premium fleet and find the perfect ride for your next adventure.</p>
                <div class="mt-4 text-brand-600 font-medium text-sm flex items-center opacity-0 group-hover:opacity-100 transition-opacity transform translate-x-[-10px] group-hover:translate-x-0">
                    Find a bike <i class="fa-solid fa-arrow-right ml-2"></i>
                </div>
            </a>

            <a href="{{ route('my.bookings') }}" class="group bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                <div class="h-12 w-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl mb-4 group-hover:scale-110 transition-transform">
                    <i class="fa-solid fa-list-check"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">My Bookings</h3>
                <p class="text-gray-500 text-sm">View details of your current rentals and access history of past trips.</p>
                <div class="mt-4 text-brand-600 font-medium text-sm flex items-center opacity-0 group-hover:opacity-100 transition-opacity transform translate-x-[-10px] group-hover:translate-x-0">
                    View bookings <i class="fa-solid fa-arrow-right ml-2"></i>
                </div>
            </a>

            <a href="#" class="group bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 cursor-not-allowed opacity-75">
                <div class="h-12 w-12 bg-gray-50 text-gray-600 rounded-xl flex items-center justify-center text-xl mb-4">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Support</h3>
                <p class="text-gray-500 text-sm">Need help? Our support team is here to assist you 24/7.</p>
                <div class="mt-4 text-gray-400 font-medium text-sm flex items-center">
                    Coming Soon
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
