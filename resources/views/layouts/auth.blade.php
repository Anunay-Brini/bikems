<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BikeMS Auth</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col justify-center items-center p-4 sm:p-6 relative overflow-hidden">
        
        <!-- Background Image & Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="@yield('bg_image', asset('images/hero-bike.png'))" class="w-full h-full object-cover" alt="Background">
            <!-- Darker overlay for better contrast -->
            <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-[2px] sm:backdrop-blur-sm"></div>
        </div>

        <!-- Logo -->
        <div class="relative z-10 mb-8 text-center">
            <a href="/" class="group inline-flex items-center gap-3">
                <div class="bg-brand-600 text-white p-2.5 sm:p-3 rounded-xl shadow-lg shadow-brand-500/30 group-hover:scale-110 transition-transform duration-300">
                    <i class="fa-solid fa-motorcycle text-xl sm:text-2xl"></i>
                </div>
                <span class="text-3xl sm:text-4xl font-display font-bold text-white tracking-tight drop-shadow-lg">Bike<span class="text-brand-500">MS</span></span>
            </a>
        </div>

        <!-- Auth Card -->
        <div class="relative z-10 w-full max-w-md px-6 py-8 sm:px-8 sm:py-10 bg-white/95 backdrop-blur-xl shadow-2xl overflow-hidden rounded-2xl sm:rounded-3xl border border-white/20 transition-all transform hover:shadow-brand-500/10">
            @yield('content')
        </div>

        <!-- Footer Text -->
        <div class="relative z-10 mt-8 text-gray-400 text-sm">
            &copy; {{ date('Y') }} BikeMS. All rights reserved.
        </div>
    </div>
</body>
</html>
