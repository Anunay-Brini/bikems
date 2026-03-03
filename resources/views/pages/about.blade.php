@extends('layouts.public')

@section('title', 'About Us - BikeMS')

@section('content')
<div class="bg-white py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-2">
            <div class="lg:pr-8 lg:pt-4">
                <div class="lg:max-w-lg">
                    <h2 class="text-base font-semibold leading-7 text-brand-600">About Us</h2>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Driven by passion for mobility</p>
                    <p class="mt-6 text-lg leading-8 text-gray-600">
                        BikeMS started with a simple idea: make bike rentals easy, secure, and accessible for everyone. We believe that sustainable transport is the future, and we are building the infrastructure to support it.
                    </p>
                    <dl class="mt-10 max-w-xl space-y-8 text-base leading-7 text-gray-600 lg:max-w-none">
                        <div class="relative pl-9">
                            <dt class="inline font-semibold text-gray-900">
                                <i class="fa-solid fa-check absolute left-1 top-1 h-5 w-5 text-brand-600"></i>
                                Innovation first.
                            </dt>
                            <dd class="inline">We constantly update our platform with the latest tech to ensure smooth operations.</dd>
                        </div>
                        <div class="relative pl-9">
                            <dt class="inline font-semibold text-gray-900">
                                <i class="fa-solid fa-check absolute left-1 top-1 h-5 w-5 text-brand-600"></i>
                                Customer obsessed.
                            </dt>
                            <dd class="inline">Our support team is always ready to help you succeed.</dd>
                        </div>
                        <div class="relative pl-9">
                            <dt class="inline font-semibold text-gray-900">
                                <i class="fa-solid fa-check absolute left-1 top-1 h-5 w-5 text-brand-600"></i>
                                Sustainability.
                            </dt>
                            <dd class="inline">We promote eco-friendly transport options worldwide.</dd>
                        </div>
                    </dl>
                </div>
            </div>
            <div class="flex items-start justify-end lg:order-last">
                <div class="w-full rounded-xl bg-gray-900/5 p-2 ring-1 ring-inset ring-gray-900/10 lg:-m-4 lg:rounded-2xl lg:p-4">
                    <img src="https://images.unsplash.com/photo-1558981403-c5f9899a28bc?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" alt="Team working on bikes" class="w-full rounded-xl shadow-xl ring-1 ring-gray-400/10">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
