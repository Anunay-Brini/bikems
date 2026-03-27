<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    
    <style>
        .fade-in-up {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }
        .fade-in-up.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased bg-white selection:bg-brand-100 selection:text-brand-900 flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav x-data="{ open: false }" class="fixed w-full z-50 transition-all duration-300 bg-white/80 backdrop-blur-md border-b border-gray-100" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                        <div class="bg-brand-600 text-white p-2 rounded-lg group-hover:bg-brand-700 transition-colors">
                            <i class="fa-solid fa-motorcycle text-xl"></i>
                        </div>
                        <span class="font-display font-bold text-2xl tracking-tight text-gray-900">Bike<span class="text-brand-600">MS</span></span>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ url('/#features') }}" class="text-sm font-medium text-gray-600 hover:text-brand-600 transition-colors">Features</a>
                    <a href="{{ url('/#how-it-works') }}" class="text-sm font-medium text-gray-600 hover:text-brand-600 transition-colors">How it Works</a>
                    <a href="{{ route('pages.about') }}" class="text-sm font-medium text-gray-600 hover:text-brand-600 transition-colors">About</a>
                    
                    <div class="flex items-center gap-4 pl-4 border-l border-gray-200">
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-900 hover:text-brand-600 transition-colors">Log in</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-full text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transition-all shadow-lg shadow-brand-500/30 hover:shadow-brand-500/40 hover:-translate-y-0.5">
                            Get Started
                        </a>
                    </div>
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button @click="open = ! open" class="text-gray-500 hover:text-gray-900 focus:outline-none transition-colors">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden bg-white border-b border-gray-100 animate-fade-in">
            <div class="px-4 pt-2 pb-6 space-y-1">
                <a href="{{ url('/#features') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-brand-600 hover:bg-gray-50">Features</a>
                <a href="{{ url('/#how-it-works') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-brand-600 hover:bg-gray-50">How it Works</a>
                <a href="{{ route('pages.about') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-brand-600 hover:bg-gray-50">About</a>
                <div class="pt-4 border-t border-gray-100 mt-4">
                    <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-brand-600 hover:bg-gray-50">Log in</a>
                    <a href="{{ route('register') }}" class="mt-2 block px-3 py-2 rounded-md text-base font-medium text-brand-600 bg-brand-50">Get Started</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 border-t border-gray-800 pt-16 pb-8 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-1 md:col-span-1">
                    <a href="{{ url('/') }}" class="flex items-center gap-2 group mb-6">
                        <div class="bg-brand-600 text-white p-2 rounded-lg group-hover:bg-brand-700 transition-colors">
                            <i class="fa-solid fa-motorcycle text-xl"></i>
                        </div>
                        <span class="font-display font-bold text-2xl tracking-tight text-white">Bike<span class="text-brand-500">MS</span></span>
                    </a>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        The #1 platform for bike rental management. Simple, powerful, and reliable.
                    </p>
                </div>
                
                <div>
                    <h4 class="text-white font-semibold mb-6">Product</h4>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li><a href="{{ url('/#features') }}" class="hover:text-brand-500 transition-colors">Features</a></li>
                        <li><a href="{{ route('pages.pricing') }}" class="hover:text-brand-500 transition-colors">Pricing</a></li>
                        {{-- API Link Removed --}}
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-white font-semibold mb-6">Company</h4>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li><a href="{{ route('pages.about') }}" class="hover:text-brand-500 transition-colors">About</a></li>
                        <li><a href="{{ route('pages.careers') }}" class="hover:text-brand-500 transition-colors">Careers</a></li>
                        <li><a href="{{ route('pages.contact') }}" class="hover:text-brand-500 transition-colors">Contact</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-white font-semibold mb-6">Legal</h4>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li><a href="{{ route('pages.privacy') }}" class="hover:text-brand-500 transition-colors">Privacy</a></li>
                        <li><a href="{{ route('pages.terms') }}" class="hover:text-brand-500 transition-colors">Terms</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-500 text-sm">© {{ date('Y') }} BikeMS. All rights reserved.</p>
                <div class="flex gap-6">
                     {{-- Twitter and API Removed --}}
                    <a href="#" class="text-gray-500 hover:text-white transition-colors"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="text-gray-500 hover:text-white transition-colors"><i class="fa-brands fa-linkedin"></i></a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
