@extends('layouts.public')

@section('title', 'Contact Us - BikeMS')

@section('content')
<div class="bg-white py-24 sm:py-32">
  <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <div class="mx-auto max-w-2xl space-y-16 md:grid md:max-w-none md:grid-cols-2 md:gap-x-16 md:space-y-0 text-center md:text-left">
      <div>
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Contact Us</h2>
        <p class="mt-4 text-lg leading-8 text-gray-600">Have questions? We'd love to hear from you.</p>
        
        <div class="mt-10 space-y-4 text-base leading-7 text-gray-600">
            <p><i class="fa-solid fa-envelope mr-2 text-brand-600"></i> support@bikems.com</p>
            <p><i class="fa-solid fa-phone mr-2 text-brand-600"></i> +91 87144 22410</p>
            <p><i class="fa-solid fa-location-dot mr-2 text-brand-600"></i> Rajagiri College of Social Sciences, Kalamassery</p>
        </div>
      </div>
      
      <form class="bg-gray-50 p-8 rounded-2xl shadow-sm border border-gray-100">
          <div class="space-y-4">
              <div>
                  <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                  <input type="text" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm">
              </div>
              <div>
                  <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                  <input type="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm">
              </div>
              <div>
                  <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                  <textarea id="message" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm"></textarea>
              </div>
              <button type="submit" class="w-full rounded-md bg-brand-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-brand-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-600">Send Message</button>
          </div>
      </form>
    </div>
  </div>
</div>
@endsection
