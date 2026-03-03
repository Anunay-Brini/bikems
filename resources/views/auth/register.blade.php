@extends('layouts.auth')

@section('bg_image', asset('images/bg2.png'))

@section('content')
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-display font-bold text-gray-900">Create Account</h2>
        <p class="text-gray-500 mt-2">Join BikeMS today</p>
    </div>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="mb-6 p-4 rounded-lg bg-red-50 text-red-700 text-sm font-medium border border-red-100">
            <div class="font-bold mb-1">Whoops! Something went wrong.</div>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div class="space-y-1">
            <label for="name" class="block text-sm font-semibold text-gray-700">Full Name</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <i class="fa-regular fa-user"></i>
                </div>
                <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                       class="block w-full pl-10 pr-3 py-3 rounded-xl border-gray-200 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm bg-gray-50 focus:bg-white transition-all duration-200"
                       placeholder="John Doe">
            </div>
        </div>

        <div class="space-y-1">
            <label for="email" class="block text-sm font-semibold text-gray-700">Email Address</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <i class="fa-regular fa-envelope"></i>
                </div>
                <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                       class="block w-full pl-10 pr-3 py-3 rounded-xl border-gray-200 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm bg-gray-50 focus:bg-white transition-all duration-200"
                       placeholder="you@example.com">
            </div>
        </div>

        <div class="space-y-1">
            <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <i class="fa-solid fa-lock"></i>
                </div>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                       class="block w-full pl-10 pr-3 py-3 rounded-xl border-gray-200 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm bg-gray-50 focus:bg-white transition-all duration-200"
                       placeholder="••••••••">
            </div>
        </div>

        <div class="space-y-1">
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Confirm Password</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <i class="fa-solid fa-lock"></i>
                </div>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                       class="block w-full pl-10 pr-3 py-3 rounded-xl border-gray-200 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm bg-gray-50 focus:bg-white transition-all duration-200"
                       placeholder="••••••••">
            </div>
        </div>

        <button class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-brand-500/30 text-sm font-bold text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transition-all duration-200 hover:-translate-y-0.5 mt-4">
            Create Account
        </button>

        <p class="mt-6 text-center text-sm text-gray-500">
            Already have an account? 
            <a href="{{ route('login') }}" class="font-bold text-brand-600 hover:text-brand-500 hover:underline transition-all">
                Sign In
            </a>
        </p>
    </form>
@endsection
