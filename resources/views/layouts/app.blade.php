<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@hasSection('title') @yield('title') | @endif{{ config('app.name', 'BikeMS') }}</title>
    <link rel="icon" href="{{ asset('images/BikeMS Logo.png') }}" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Unbounded:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/timedropper/1.0/timedropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/timedropper/1.0/timedropper.min.js"></script>
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-50">

    <!-- Navbar -->
    <nav x-data="{ open: false }" class="fixed w-full z-50 transition-all duration-300 bg-white border-b border-gray-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="flex items-center gap-2 group">
                        <div class="bg-brand-600 text-white p-2 rounded-lg group-hover:bg-brand-700 transition-colors">
                            <i class="fa-solid fa-motorcycle text-xl"></i>
                        </div>
                        <span class="font-display font-bold text-2xl tracking-tight text-gray-900">Bike<span class="text-brand-600">MS</span></span>
                    </a>
                </div>
                
                
                <div class="hidden md:flex items-center gap-6">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="text-sm font-medium text-gray-600 hover:text-brand-600 transition-colors">Dashboard</a>
                            <a href="{{ route('admin.reports') }}" class="text-sm font-medium text-gray-600 hover:text-brand-600 transition-colors">Reports</a>
                            <a href="{{ route('bikes.index') }}" class="text-sm font-medium text-gray-600 hover:text-brand-600 transition-colors">Bikes</a>
                        @elseif(auth()->user()->role === 'staff')
                             <a href="{{ route('staff.dashboard') }}" class="text-sm font-medium text-gray-600 hover:text-brand-600 transition-colors">Dashboard</a>
                        @elseif(auth()->user()->role === 'delivery')
                             <a href="{{ route('delivery.dashboard') }}" class="text-sm font-medium text-gray-600 hover:text-brand-600 transition-colors">Dashboard</a>
                        @elseif(auth()->user()->role === 'customer')
                            <a href="{{ route('user.dashboard') }}" class="text-sm font-medium text-gray-600 hover:text-brand-600 transition-colors">Dashboard</a>
                            <a href="{{ route('my.bookings') }}" class="text-sm font-medium text-gray-600 hover:text-brand-600 transition-colors">My Bookings</a>
                        @endif

                        <div class="h-6 w-px bg-gray-200 mx-2"></div>

                        <span class="text-sm font-medium text-gray-900">
                            {{ Auth::user()->name }}
                        </span>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm font-semibold text-gray-500 hover:text-brand-600 transition-colors">
                                <i class="fa-solid fa-arrow-right-from-bracket text-lg"></i>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-900 hover:text-brand-600 transition-colors">Log in</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-full text-white bg-brand-600 hover:bg-brand-700 transition-all shadow-lg shadow-brand-500/30">
                            Get Started
                        </a>
                    @endauth
                </div>

                <!-- Hamburger -->
                <div class="flex items-center md:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden bg-white border-b border-gray-100 animate-fade-in">
            <div class="pt-2 pb-3 space-y-1 px-4">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-brand-600 hover:bg-gray-50">Dashboard</a>
                        <a href="{{ route('admin.reports') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-brand-600 hover:bg-gray-50">Reports</a>
                        <a href="{{ route('bikes.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-brand-600 hover:bg-gray-50">Bikes</a>
                    @elseif(auth()->user()->role === 'staff')
                        <a href="{{ route('staff.dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-brand-600 hover:bg-gray-50">Dashboard</a>
                    @elseif(auth()->user()->role === 'delivery')
                        <a href="{{ route('delivery.dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-brand-600 hover:bg-gray-50">Dashboard</a>
                    @elseif(auth()->user()->role === 'customer')
                        <a href="{{ route('user.dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-brand-600 hover:bg-gray-50">Dashboard</a>
                        <a href="{{ route('my.bookings') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-brand-600 hover:bg-gray-50">My Bookings</a>
                    @endif

                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="flex items-center px-3">
                            <div class="ml-3">
                                <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                                <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                        <div class="mt-3 space-y-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-brand-600 hover:bg-gray-50">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-brand-600 hover:bg-gray-50">Log in</a>
                    <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md text-base font-medium text-brand-600 hover:bg-brand-50">Get Started</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="pt-32 pb-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 min-h-screen">
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
