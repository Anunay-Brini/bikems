<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password - {{ config('app.name', 'BikeMS') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Unbounded:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-50 flex flex-col min-h-screen">

    <div class="flex-grow flex items-center justify-center p-6">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden transform transition-all hover:scale-[1.005]">
            <div class="p-8">
                {{-- Logo --}}
                <div class="flex justify-center mb-8">
                    <a href="/" class="flex items-center gap-2 group">
                        <div class="bg-brand-600 text-white p-2 rounded-lg group-hover:bg-brand-700 transition-colors shadow-lg shadow-brand-500/30">
                            <i class="fa-solid fa-motorcycle text-2xl"></i>
                        </div>
                        <span class="font-display font-bold text-2xl tracking-tight text-gray-900">Bike<span class="text-brand-600">MS</span></span>
                    </a>
                </div>

                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold font-display text-gray-900">Forgot Password?</h2>
                    <p class="text-sm text-gray-500 mt-2">No worries! Enter your email and we'll send you a reset link.</p>
                </div>

                {{-- Status Message --}}
                @if (session('status'))
                    <div class="mb-6 p-4 rounded-xl bg-green-50 text-green-700 font-medium text-sm flex items-center gap-2 border border-green-100">
                        <i class="fa-solid fa-check-circle"></i>
                        {{ session('status') }}
                    </div>
                @endif
                
                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-xl bg-red-50 text-red-700 font-medium text-sm border border-red-100">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa-regular fa-envelope text-gray-400"></i>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus 
                                class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm py-2.5 transition-all">
                        </div>
                    </div>

                    <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 shadow-brand-500/30 transition-all transform hover:-translate-y-0.5">
                        Send Password Reset Link
                    </button>
                    
                    <div class="text-center mt-6">
                        <a href="{{ route('login') }}" class="text-sm font-medium text-gray-600 hover:text-brand-600 transition-colors">
                            <i class="fa-solid fa-arrow-left mr-1"></i> Back to Login
                        </a>
                    </div>
                </form>
            </div>
            <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-center">
                 <p class="text-xs text-gray-500">&copy; {{ date('Y') }} BikeMS. All rights reserved.</p>
            </div>
        </div>
    </div>

</body>
</html>
