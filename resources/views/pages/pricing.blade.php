@extends('layouts.public')

@section('title', 'Pricing - BikeMS')

@section('content')
<div class="bg-white py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-4xl text-center">
            <h2 class="text-base font-semibold leading-7 text-brand-600">Our Fleet</h2>
            <p class="mt-2 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">Premium Rides at Honest Prices</p>
            <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-gray-600">
                Experience the best-in-class rental experience with our premium fleet. No hidden charges, just pure joy of riding.
            </p>
        </div>

        <div class="mt-20 flex flex-col gap-20">
            @foreach($bikes as $bike)
            <div class="relative isolate overflow-hidden bg-gray-900/95 px-8 py-10 shadow-2xl rounded-[3rem] sm:px-20 xl:py-12 border border-gray-800 hover:scale-[1.01] transition-all duration-500 group">
                <div class="mx-auto grid max-w-7xl grid-cols-1 gap-x-12 gap-y-10 lg:grid-cols-2 lg:items-center">
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">Featured Bike: {{ $bike->name }}</h3>
                            <p class="mt-6 text-lg leading-8 text-gray-300">
                                Experience the perfect blend of power and style with the {{ $bike->name }}. Designed for those who demand excellence on every ride.
                            </p>
                        </div>
                        
                        <div class="grid grid-cols-1 gap-y-4">
                            <div class="flex items-center gap-x-3 text-white">
                                <div class="flex-none rounded-full bg-brand-500/10 p-1">
                                    <i class="fa-solid fa-check text-brand-500 text-sm"></i>
                                </div>
                                <span class="text-gray-200">Zero Deposit for Long-term rentals</span>
                            </div>
                            <div class="flex items-center gap-x-3 text-white">
                                <div class="flex-none rounded-full bg-brand-500/10 p-1">
                                    <i class="fa-solid fa-check text-brand-500 text-sm"></i>
                                </div>
                                <span class="text-gray-200">Free Helmet & Safety Gear Included</span>
                            </div>
                            <div class="flex items-center gap-x-3 text-white">
                                <div class="flex-none rounded-full bg-brand-500/10 p-1">
                                    <i class="fa-solid fa-check text-brand-500 text-sm"></i>
                                </div>
                                <span class="text-gray-200">24/7 Premium Roadside Assistance</span>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-white/10">
                            <div class="flex flex-wrap items-center gap-x-12 gap-y-8">
                                <div class="flex flex-col">
                                    <span class="text-xs font-semibold uppercase tracking-widest text-brand-500 mb-2">Daily Rental</span>
                                    <div class="flex items-baseline gap-x-2">
                                        <span class="text-5xl font-extrabold text-white">₹{{ number_format($bike->price_per_day) }}</span>
                                        <span class="text-sm text-gray-400">/ day</span>
                                    </div>
                                </div>
                                <div class="flex flex-col bg-white/5 border border-white/10 rounded-2xl px-6 py-4">
                                    <span class="text-xs font-semibold uppercase tracking-widest text-gray-400 mb-2">Booking Security</span>
                                    <div class="flex items-baseline gap-x-2">
                                        <span class="text-3xl font-bold text-white">₹{{ number_format($bike->price_per_day / 2) }}</span>
                                        <span class="text-xs text-gray-500">Advance</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 flex flex-col gap-y-4">
                                <a href="{{ route('book.create', $bike->id) }}" class="inline-flex items-center justify-center rounded-2xl bg-brand-600 px-10 py-5 text-lg font-bold text-white shadow-2xl shadow-brand-600/40 hover:bg-brand-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-600 transition-all duration-300 transform hover:scale-[1.02] hover:-translate-y-1">
                                    <i class="fa-solid fa-calendar-check mr-3"></i>
                                    Book This Bike Now
                                </a>
                                <p class="text-center sm:text-left text-xs text-gray-500 font-medium">
                                    <i class="fa-solid fa-circle-info mr-1 text-gray-600"></i>
                                    * Advance payment is adjusted in the final bill.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="relative lg:pt-4">
                        <div class="relative">
                            <div class="absolute -inset-4 bg-brand-600/20 rounded-center blur-3xl opacity-0 group-hover:opacity-100 transition duration-500"></div>
                            
                            <div class="relative bg-gray-800/50 backdrop-blur-sm border border-white/10 p-4 rounded-[2.5rem] shadow-inner">
                                @if($bike->image)
                                    <img src="{{ asset('storage/' . $bike->image) }}" alt="{{ $bike->name }}" class="w-full h-full object-contain rounded-[2rem] shadow-2xl transition-all duration-700 group-hover:rotate-1">
                                @else
                                    <img src="{{ asset('images/hero-bike.png') }}" alt="Default Bike" class="w-full h-full object-contain rounded-[2rem] shadow-2xl transition-all duration-700 group-hover:rotate-1">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <svg viewBox="0 0 1024 1024" class="absolute left-1/2 top-1/2 -z-10 h-[64rem] w-[64rem] -translate-x-1/2 -translate-y-1/2 [mask-image:radial-gradient(closest-side,white,transparent)]" aria-hidden="true">
                    <circle cx="512" cy="512" r="512" fill="url(#brand-gradient-{{ $bike->id }})" fill-opacity="0.2" />
                    <defs>
                        <radialGradient id="brand-gradient-{{ $bike->id }}">
                            <stop stop-color="#E11D48" />
                            <stop offset="1" stop-color="#E11D48" stop-opacity="0" />
                        </radialGradient>
                    </defs>
                </svg>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
