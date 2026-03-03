<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@hasSection('title') @yield('title') | @endif{{ config('app.name', 'BikeMS') }} - Delivery</title>
    <link rel="icon" href="{{ asset('images/BikeMS Logo.png') }}" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Unbounded:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-50">

    <!-- Navbar -->
    <nav class="sticky top-0 w-full z-50 transition-all duration-300 bg-white border-b border-gray-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('delivery.dashboard') }}" class="flex items-center gap-2 group">
                        <div class="bg-brand-600 text-white p-2 rounded-lg group-hover:bg-brand-700 transition-colors">
                            <i class="fa-solid fa-motorcycle text-xl"></i>
                        </div>
                        <span class="font-display font-bold text-2xl tracking-tight text-gray-900">Bike<span class="text-brand-600">MS</span></span>
                    </a>
                </div>
                
                <div class="flex items-center gap-6">
                    <span class="text-sm font-medium text-gray-600">
                        <i class="fa-regular fa-user mr-2 text-brand-500"></i>{{ Auth::user()->name }}
                    </span>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm font-semibold text-gray-500 hover:text-brand-600 transition-colors">
                            Log Out <i class="fa-solid fa-arrow-right-from-bracket ml-1"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 min-h-screen">
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-green-50 text-green-700 font-medium border border-green-100 flex items-center gap-3 animate-fade-in-down">
                <i class="fa-solid fa-check-circle text-xl"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 rounded-xl bg-red-50 text-red-700 font-medium border border-red-100 flex items-center gap-3 animate-fade-in-down">
                <i class="fa-solid fa-triangle-exclamation text-xl"></i>
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>
    
    <footer class="bg-white border-t border-gray-100 py-8 mt-auto">
        <div class="max-w-7xl mx-auto px-4 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} BikeMS. All rights reserved.
        </div>
    </footer>

</body>
</html>
