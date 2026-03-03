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
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">
        
        <!-- Background Image & Overlay -->
        <div class="absolute inset-0 z-0">
            <img src="@yield('bg_image', asset('images/hero-bike.png'))" class="w-full h-full object-cover" alt="Background">
            <!-- Darker overlay for better contrast -->
            <div class="absolute inset-0 bg-gray-900/70 backdrop-blur-sm"></div>
        </div>

        <!-- Logo -->
        <div class="relative z-10 mb-8">
            <a href="/" class="group flex items-center gap-3">
                <div class="bg-brand-600 text-white p-3 rounded-xl shadow-lg shadow-brand-500/30 group-hover:scale-110 transition-transform duration-300">
                    <i class="fa-solid fa-motorcycle text-2xl"></i>
                </div>
                <span class="text-4xl font-display font-bold text-white tracking-tight drop-shadow-lg">Bike<span class="text-brand-500">MS</span></span>
            </a>
        </div>

        <!-- Auth Card -->
        <div class="relative z-10 w-full sm:max-w-md px-8 py-10 bg-white/95 backdrop-blur-xl shadow-2xl overflow-hidden sm:rounded-3xl border border-white/20 transition-all transform hover:shadow-brand-500/10">
            @yield('content')
        </div>

        <!-- Footer Text -->
        <div class="relative z-10 mt-8 text-gray-400 text-sm">
            &copy; {{ date('Y') }} BikeMS. All rights reserved.
        </div>
    </div>
</body>
</html>
