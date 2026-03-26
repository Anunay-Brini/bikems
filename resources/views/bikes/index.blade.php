@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <div class="text-center max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 font-display mb-3">Available Bikes</h1>
        <p class="text-gray-500 text-lg">Choose your perfect ride from our premium fleet.</p>
    </div>

    @if(session('error'))
        <div class="p-4 rounded-xl bg-red-50 text-red-700 font-medium border border-red-100 flex items-center gap-3 animate-fade-in-down">
            <i class="fa-solid fa-triangle-exclamation text-xl"></i>
            {{ session('error') }}
        </div>
    @endif

    <div class="max-w-5xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($bikes as $bike)
            <div class="group bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col h-full transform scale-95 hover:scale-100 origin-center">
                <!-- Image Container -->
                <div class="relative h-48 bg-gray-100 overflow-hidden">
                    @if($bike->image)
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($bike->image) }}" alt="{{ $bike->name }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-50 text-gray-300">
                            <i class="fa-solid fa-motorcycle text-4xl"></i>
                        </div>
                    @endif
                    <div class="absolute top-3 right-3">
                        <span class="px-2.5 py-0.5 bg-white/90 backdrop-blur-md text-brand-600 text-[10px] font-bold uppercase tracking-wider rounded-full shadow-sm">
                            {{ $bike->type }}
                        </span>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-5 flex flex-col flex-grow">
                    <div class="mb-3">
                        <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-brand-600 transition-colors">{{ $bike->name }}</h3>
                        <div class="flex items-center gap-1.5 text-gray-500 text-xs">
                            <i class="fa-solid fa-star text-yellow-400"></i>
                            <span>4.8</span>
                        </div>
                    </div>

                    <div class="mt-auto pt-3 border-t border-gray-50 flex items-center justify-between">
                        <div>
                            <span class="text-xl font-bold text-gray-900">₹{{ number_format($bike->price_per_day) }}</span>
                            <span class="text-gray-500 text-xs font-medium">/ day</span>
                        </div>
                        <a href="{{ route('book.create', $bike->id) }}" class="inline-flex items-center px-3 py-1.5 bg-brand-600 hover:bg-brand-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-lg shadow-brand-500/30">
                            Book
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                    <i class="fa-solid fa-motorcycle text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900">No bikes details found</h3>
                <p class="mt-1 text-gray-500">Check back later for new additions to our fleet.</p>
            </div>
        @endforelse
    </div>
    </div>
</div>
@endsection
