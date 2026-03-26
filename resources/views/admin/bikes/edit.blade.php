@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <a href="{{ route('bikes.index') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 mb-6 transition-colors">
        <i class="fa-solid fa-arrow-left mr-2"></i> Back to Bikes
    </a>
    
    <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100">
        <div class="p-8">
            <h1 class="text-2xl font-bold text-gray-900 font-display mb-6">Edit Bike: {{ $bike->name }}</h1>
            
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

            <form method="POST" action="{{ route('bikes.update', $bike) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Image Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bike Image</label>
                    <div id="image-upload-wrapper" onclick="document.getElementById('file-upload').click()" 
                         class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-brand-400 transition-colors cursor-pointer bg-gray-50 hover:bg-white group overflow-hidden relative">
                        
                        <div class="space-y-1 text-center {{ $bike->image ? 'hidden' : '' }}" id="upload-placeholder">
                            <i class="fa-solid fa-cloud-arrow-up text-gray-400 text-3xl mb-3 group-hover:text-brand-500 transition-colors"></i>
                            <div class="flex text-sm text-gray-600 justify-center">
                                <span class="relative cursor-pointer bg-transparent rounded-md font-medium text-brand-600 hover:text-brand-500">
                                    Upload a new file
                                </span>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                        </div>

                        <img id="image-preview" src="{{ $bike->image ? \Illuminate\Support\Facades\Storage::url($bike->image) : '#' }}" 
                             alt="Preview" class="{{ $bike->image ? '' : 'hidden' }} max-h-48 rounded-lg shadow-sm">
                        
                        <input id="file-upload" name="image" type="file" accept="image/*" class="sr-only" onchange="previewImage(this)">
                        
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity rounded-lg">
                            <span class="text-white font-medium text-sm">Change Image</span>
                        </div>
                    </div>
                </div>

                <script>
                    function previewImage(input) {
                        const preview = document.getElementById('image-preview');
                        const placeholder = document.getElementById('upload-placeholder');
                        
                        if (input.files && input.files[0]) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                preview.src = e.target.result;
                                preview.classList.remove('hidden');
                                placeholder.classList.add('hidden');
                            }
                            reader.readAsDataURL(input.files[0]);
                        }
                    }

                    const wrapper = document.getElementById('image-upload-wrapper');
                    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                        wrapper.addEventListener(eventName, preventDefaults, false);
                    });

                    function preventDefaults(e) {
                        e.preventDefault();
                        e.stopPropagation();
                    }

                    ['dragenter', 'dragover'].forEach(eventName => {
                        wrapper.addEventListener(eventName, () => wrapper.classList.add('border-brand-500', 'bg-brand-50'), false);
                    });

                    ['dragleave', 'drop'].forEach(eventName => {
                        wrapper.addEventListener(eventName, () => wrapper.classList.remove('border-brand-500', 'bg-brand-50'), false);
                    });

                    wrapper.addEventListener('drop', handleDrop, false);

                    function handleDrop(e) {
                        const dt = e.dataTransfer;
                        const files = dt.files;
                        const input = document.getElementById('file-upload');
                        input.files = files;
                        previewImage(input);
                    }
                </script>

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Bike Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $bike->name) }}" required 
                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500 transition-shadow">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Type -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                        <select name="type" id="type" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500 transition-shadow">
                            <option value="sports" {{ $bike->type == 'sports' ? 'selected' : '' }}>Sports</option>
                            <option value="cruiser" {{ $bike->type == 'cruiser' ? 'selected' : '' }}>Cruiser</option>
                            <option value="scooter" {{ $bike->type == 'scooter' ? 'selected' : '' }}>Scooter</option>
                            <option value="offroad" {{ $bike->type == 'offroad' ? 'selected' : '' }}>Off-road</option>
                        </select>
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="price_per_day" class="block text-sm font-medium text-gray-700 mb-1">Price Per Day (₹)</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">₹</span>
                            </div>
                            <input type="number" name="price_per_day" id="price_per_day" value="{{ old('price_per_day', $bike->price_per_day) }}" required 
                                   class="w-full rounded-lg border-gray-300 pl-7 shadow-sm focus:border-brand-500 focus:ring-brand-500 transition-shadow">
                        </div>
                    </div>
                </div>

                <div class="pt-4 flex gap-4">
                    <button type="submit" class="flex-1 justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transition-all shadow-lg shadow-brand-500/30 hover:shadow-brand-500/40 transform hover:-translate-y-0.5">
                        Update Bike
                    </button>
                    <a href="{{ route('bikes.index') }}" class="flex-1 text-center py-3 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transition-all">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
