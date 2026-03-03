@extends('layouts.public')

@section('title', 'Careers - BikeMS')

@section('content')
<div class="bg-white py-24 sm:py-32">
  <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <div class="mx-auto max-w-2xl text-center">
      <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Join our team</h2>
      <p class="mt-2 text-lg leading-8 text-gray-600">We’re looking for passionate individuals to help us revolutionize bike rentals.</p>
    </div>
    <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
      <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
        <div class="flex flex-col">
          <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-gray-900">
            Backend Developer
          </dt>
          <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600">
            <p class="flex-auto">Experienced PHP/Laravel developer to build robust APIs.</p>
            <p class="mt-6">
              <a href="#" class="text-sm font-semibold leading-6 text-brand-600">Apply <span aria-hidden="true">→</span></a>
            </p>
          </dd>
        </div>
        <div class="flex flex-col">
          <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-gray-900">
            Frontend Developer
          </dt>
          <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600">
            <p class="flex-auto">Vue.js/Tailwind expert to create beautiful interfaces.</p>
            <p class="mt-6">
              <a href="#" class="text-sm font-semibold leading-6 text-brand-600">Apply <span aria-hidden="true">→</span></a>
            </p>
          </dd>
        </div>
        <div class="flex flex-col">
          <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-gray-900">
            Product Designer
          </dt>
          <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600">
            <p class="flex-auto">Creative mind to design user-centric experiences.</p>
            <p class="mt-6">
              <a href="#" class="text-sm font-semibold leading-6 text-brand-600">Apply <span aria-hidden="true">→</span></a>
            </p>
          </dd>
        </div>
      </dl>
    </div>
  </div>
</div>
@endsection
