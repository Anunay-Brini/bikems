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
        .hero-blob {
            position: absolute;
            background: radial-gradient(circle, rgba(220, 38, 38, 0.15) 0%, rgba(255, 255, 255, 0) 70%);
            border-radius: 50%;
            z-index: -1;
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased bg-white selection:bg-brand-100 selection:text-brand-900">

    <!-- Navbar -->
    <nav x-data="{ open: false }" class="fixed w-full z-50 transition-all duration-300 bg-white/80 backdrop-blur-md border-b border-gray-100" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0 flex items-center">
                    <a href="#" class="flex items-center gap-2 group">
                        <div class="bg-brand-600 text-white p-2 rounded-lg group-hover:bg-brand-700 transition-colors">
                            <i class="fa-solid fa-motorcycle text-xl"></i>
                        </div>
                        <span class="font-display font-bold text-2xl tracking-tight text-gray-900">Bike<span class="text-brand-600">MS</span></span>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features" class="text-sm font-medium text-gray-600 hover:text-brand-600 transition-colors">Features</a>
                    <a href="#how-it-works" class="text-sm font-medium text-gray-600 hover:text-brand-600 transition-colors">How it Works</a>
                    <a href="#about" class="text-sm font-medium text-gray-600 hover:text-brand-600 transition-colors">About</a>
                    
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
                <a href="#features" @click="open = false" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-brand-600 hover:bg-gray-50">Features</a>
                <a href="#how-it-works" @click="open = false" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-brand-600 hover:bg-gray-50">How it Works</a>
                <a href="#about" @click="open = false" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-brand-600 hover:bg-gray-50">About</a>
                <div class="pt-4 border-t border-gray-100 mt-4">
                    <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-brand-600 hover:bg-gray-50">Log in</a>
                    <a href="{{ route('register') }}" class="mt-2 block px-3 py-2 rounded-md text-base font-medium text-brand-600 bg-brand-50">Get Started</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-40 lg:pb-32 overflow-hidden">
        <div class="hero-blob w-[800px] h-[800px] -top-40 -right-40"></div>
        <div class="hero-blob w-[600px] h-[600px] bottom-0 -left-20"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-8 items-center">
                <div class="max-w-2xl fade-in-up">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-50 border border-brand-100 text-brand-700 text-xs font-semibold uppercase tracking-wide mb-6">
                        <span class="w-2 h-2 rounded-full bg-brand-600 animate-pulse"></span>
                        Smart Rental Platform
                    </div>
                    <h1 class="text-5xl lg:text-6xl font-display font-bold text-gray-900 leading-tight mb-6">
                        Manage Bikes <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-600 to-brand-400">Smarter & Faster</span>
                    </h1>
                    <p class="text-base text-gray-600 mb-8 leading-relaxed max-w-lg">
                        BikeMS is the complete solution for bike rental businesses. Handle bookings, payments, maintenance, and fleet tracking all in one modern dashboard.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}" class="inline-flex justify-center items-center px-8 py-3.5 border border-transparent text-base font-medium rounded-full text-white bg-brand-600 hover:bg-brand-700 transition-all shadow-xl shadow-brand-500/20 hover:shadow-brand-500/40 hover:-translate-y-1">
                            Start Free Trial
                            <i class="fa-solid fa-arrow-right ml-2"></i>
                        </a>
                        <a href="#features" class="inline-flex justify-center items-center px-8 py-3.5 border border-gray-200 text-base font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50 hover:text-brand-600 transition-all hover:border-brand-200">
                            View Features
                        </a>
                    </div>
                    
                    <div class="mt-12 flex items-center gap-8 text-gray-400">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-check-circle text-brand-500"></i> No Credit Card
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-check-circle text-brand-500"></i> 14-Day Trial
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-check-circle text-brand-500"></i> Cancel Anytime
                        </div>
                    </div>
                </div>
                
                <div class="relative lg:h-[600px] flex items-center justify-center fade-in-up delay-200">
                    <div class="absolute inset-0 bg-gradient-to-tr from-brand-600/20 to-transparent rounded-full filter blur-3xl opacity-30 animate-pulse"></div>
                    <img src="{{ asset('images/hero-bike.png') }}" alt="Smart Bike" class="relative z-10 w-full max-w-xl transform hover:scale-105 transition-transform duration-500 drop-shadow-2xl">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 fade-in-up">
                <h2 class="text-brand-600 font-semibold tracking-wide uppercase text-sm">Features</h2>
                <p class="mt-2 text-3xl font-display font-bold text-gray-900 sm:text-4xl">Everything you need to run your fleet</p>
                <p class="mt-4 text-xl text-gray-500">Powerful tools designed to help you grow your rental business.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition-shadow duration-300 border border-gray-100 fade-in-up delay-100 group">
                    <div class="w-12 h-12 bg-brand-50 rounded-xl flex items-center justify-center text-brand-600 mb-6 group-hover:scale-110 transition-transform bg-opacity-50">
                        <i class="fa-solid fa-motorcycle text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Fleet Management</h3>
                    <p class="text-gray-500 leading-relaxed">Track every bike's status, location, and history in real-time.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition-shadow duration-300 border border-gray-100 fade-in-up delay-200 group">
                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-calendar-check text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Smart Bookings</h3>
                    <p class="text-gray-500 leading-relaxed">Seamless booking flow with automated availability checks.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition-shadow duration-300 border border-gray-100 fade-in-up delay-300 group">
                    <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center text-green-600 mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-credit-card text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Secure Payments</h3>
                    <p class="text-gray-500 leading-relaxed">Integrated payment processing with instant invoicing.</p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition-shadow duration-300 border border-gray-100 fade-in-up delay-400 group">
                    <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center text-orange-600 mb-6 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-wrench text-xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Maintenance</h3>
                    <p class="text-gray-500 leading-relaxed">Schedule servicing and track repairs to keep your fleet healthy.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="py-24 bg-white relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16 fade-in-up">
                <h2 class="text-3xl font-display font-bold text-gray-900 sm:text-4xl">How It Works</h2>
                <p class="mt-4 text-xl text-gray-500">Get started in three simple steps.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-12 relative">
                <!-- Connector Line (Desktop) -->
                <div class="hidden md:block absolute top-12 left-[16%] right-[16%] h-0.5 bg-gray-100 -z-10"></div>

                <!-- Step 1 -->
                <div class="text-center fade-in-up delay-100">
                    <div class="w-24 h-24 mx-auto bg-white rounded-full border-4 border-brand-50 flex items-center justify-center mb-6 shadow-sm relative z-10">
                        <span class="text-3xl font-bold text-brand-600">1</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Create Account</h3>
                    <p class="text-gray-500 px-4">Register your company and set up your fleet profile details.</p>
                </div>

                <!-- Step 2 -->
                <div class="text-center fade-in-up delay-200">
                    <div class="w-24 h-24 mx-auto bg-white rounded-full border-4 border-brand-50 flex items-center justify-center mb-6 shadow-sm relative z-10">
                        <span class="text-3xl font-bold text-brand-600">2</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Add Inventory</h3>
                    <p class="text-gray-500 px-4">Upload your bikes, set pricing, and define availability rules.</p>
                </div>

                <!-- Step 3 -->
                <div class="text-center fade-in-up delay-300">
                    <div class="w-24 h-24 mx-auto bg-white rounded-full border-4 border-brand-50 flex items-center justify-center mb-6 shadow-sm relative z-10">
                        <span class="text-3xl font-bold text-brand-600">3</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Start Renting</h3>
                    <p class="text-gray-500 px-4">Receive bookings, manage customers, and grow your business.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 bg-gray-900 text-white relative isolate overflow-hidden">
        <div class="absolute inset-0 -z-10 opacity-20 bg-[radial-gradient(45rem_50rem_at_top,theme(colors.brand.600),theme(colors.gray.900))]"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="fade-in-up">
                    <h2 class="text-3xl font-display font-bold mb-6">Built for Rental Businesses</h2>
                    <p class="text-gray-300 text-lg mb-6 leading-relaxed">
                        BikeMS was born out of a need for simplicity in the complex world of vehicle rentals. We understand the challenges of fleet tracking, maintenance scheduling, and payment processing.
                    </p>
                    <p class="text-gray-300 text-lg mb-8 leading-relaxed">
                        Our mission is to empower rental business owners with tools that provide clarity, control, and efficiency, allowing you to focus on what matters most—your customers.
                    </p>
                    <div class="grid grid-cols-2 gap-8 sticky">
                        <div>
                            <div class="text-4xl font-bold text-brand-500 mb-1">500+</div>
                            <div class="text-sm text-gray-400">Happy Clients</div>
                        </div>
                        <div>
                            <div class="text-4xl font-bold text-brand-500 mb-1">10k+</div>
                            <div class="text-sm text-gray-400">Bikes Managed</div>
                        </div>
                    </div>
                </div>
                <div class="relative fade-in-up delay-200">
                    <div class="absolute -inset-4 bg-brand-500/20 rounded-2xl blur-xl"></div>
                    <img src="{{ asset('images/hero-bike.png') }}" alt="About" class="relative rounded-2xl shadow-2xl bg-gray-800/50 backdrop-blur border border-white/10 p-4">
                </div>
            </div>
        </div>
    </section>

    <!-- CTA / Contact -->
    <section class="py-24 bg-brand-600 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-10"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-black/10 rounded-full blur-3xl"></div>

        <div class="max-w-4xl mx-auto px-4 text-center relative z-10 fade-in-up">
            <h2 class="text-3xl font-display font-bold text-white sm:text-4xl mb-6">Ready to streamline your business?</h2>
            <p class="text-brand-100 text-xl mb-10 max-w-2xl mx-auto">Join hundreds of rental companies using BikeMS to manage their fleets effectively.</p>
            
            <form class="max-w-md mx-auto flex flex-col sm:flex-row gap-3">
                <input type="email" placeholder="Enter your email" class="flex-1 px-5 py-3.5 rounded-full border-2 border-white/20 bg-white/10 text-white placeholder-brand-200 focus:outline-none focus:bg-white/20 focus:border-white transition-colors">
                <button type="button" class="px-8 py-3.5 rounded-full bg-white text-brand-600 font-bold hover:bg-gray-50 transition-colors shadow-lg shadow-black/10">
                    Get Started
                </button>
            </form>
            <p class="text-brand-200 text-sm mt-4">Free 14-day trial. No credit card required.</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 border-t border-gray-800 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-1 md:col-span-1">
                    <a href="#" class="flex items-center gap-2 mb-6">
                        <span class="font-display font-bold text-2xl text-white">Bike<span class="text-brand-500">MS</span></span>
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
                     {{-- Twitter and API Links Removed --}}
                    <a href="#" class="text-gray-500 hover:text-white transition-colors"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="text-gray-500 hover:text-white transition-colors"><i class="fa-brands fa-linkedin"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Simple Scroll Animation Script -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            const fadeElements = document.querySelectorAll('.fade-in-up');
            fadeElements.forEach(el => observer.observe(el));
            
            // Navbar scroll effect
            const navbar = document.getElementById('navbar');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 20) {
                    navbar.classList.add('shadow-md');
                } else {
                    navbar.classList.remove('shadow-md');
                }
            });
        });
    </script>
</body>
</html>
