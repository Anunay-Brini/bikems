@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('bikes.browse') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 transition-colors">
            <i class="fa-solid fa-arrow-left mr-2"></i> Back to Browse
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Booking Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-50">
                    <h2 class="text-xl font-bold text-gray-900 font-display">Booking Details</h2>
                    <p class="text-gray-500 text-sm mt-1">Complete your reservation.</p>
                </div>
                
                <form action="{{ route('book.store', $bike->id) }}" method="POST" class="p-6 space-y-6">
                    @csrf
                    
                    <!-- Location Details -->
                    <div class="space-y-4">
                        <label class="block text-sm font-semibold text-gray-900 uppercase tracking-wider">Location</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Pickup Location</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                        <i class="fa-solid fa-location-dot"></i>
                                    </div>
                                    <input type="text" name="pickup_location" required class="pl-10 w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500" placeholder="Enter area or landmark">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Drop Location</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                        <i class="fa-solid fa-location-crosshairs"></i>
                                    </div>
                                    <input type="text" name="drop_location" required class="pl-10 w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500" placeholder="Enter area or landmark">
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="border-gray-100">

                    <!-- Date & Time -->
                    <div class="space-y-4">
                        <label class="block text-sm font-semibold text-gray-900 uppercase tracking-wider">Schedule</label>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Start -->
                            <div class="space-y-2">
                                <label class="block text-xs font-medium text-gray-500 uppercase">Pickup</label>
                                <div class="grid grid-cols-2 gap-2">
                                    <input type="date" name="start_date" required min="{{ date('Y-m-d') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500">
                                    <input type="text" name="start_time" id="start_time" required class="timepicker w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500" placeholder="Time">
                                </div>
                            </div>

                            <!-- End -->
                            <div class="space-y-2">
                                <label class="block text-xs font-medium text-gray-500 uppercase">Dropoff</label>
                                <div class="grid grid-cols-2 gap-2">
                                    <input type="date" name="end_date" required min="{{ date('Y-m-d') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500">
                                    <input type="text" name="end_time" id="end_time" required class="timepicker w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500" placeholder="Time">
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        $(document).ready(function() {
                            $('.timepicker').timeDropper({
                                format: 'h:mm a',
                                primaryColor: '#dc2626',
                                borderColor: '#dc2626',
                                textColor: '#dc2626',
                                backgroundColor: '#ffffff',
                                init_animation: 'bounce',
                                meridian: true
                            });
                        });
                    </script>

                    <div class="pt-4">
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-base font-bold text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transition-all shadow-lg shadow-brand-500/30 hover:transform hover:-translate-y-0.5">
                            Confirm Booking
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Bike Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden sticky top-32">
                <div class="relative h-48 bg-gray-100">
                    @if($bike->image)
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($bike->image) }}" alt="{{ $bike->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-300">
                            <i class="fa-solid fa-motorcycle text-4xl"></i>
                        </div>
                    @endif
                    <div class="absolute top-3 right-3">
                        <span class="px-2 py-1 bg-white/90 backdrop-blur-md text-xs font-bold uppercase tracking-wider rounded text-gray-800 shadow-sm">
                            {{ $bike->type }}
                        </span>
                    </div>
                </div>
                
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $bike->name }}</h3>
                    
                    <div class="flex items-baseline gap-1 mb-6">
                        <span class="text-2xl font-bold text-brand-600">₹{{ number_format($bike->price_per_day) }}</span>
                        <span class="text-gray-500 text-sm">/ day</span>
                    </div>

                    <div class="space-y-3 text-sm text-gray-600">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-check text-green-500"></i> Includes Helmet
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-check text-green-500"></i> 24/7 Roadside Assist
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-check text-green-500"></i> Comprehensive Insurance
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
