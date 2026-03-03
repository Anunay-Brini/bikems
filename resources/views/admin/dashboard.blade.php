@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900 font-display">Admin Dashboard</h1>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-gray-500 text-sm font-medium">Total Bookings</h3>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalBookings }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-gray-500 text-sm font-medium">Total Revenue</h3>
            <p class="text-3xl font-bold text-gray-900 mt-2">₹{{ number_format($totalRevenue, 2) }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-gray-500 text-sm font-medium">Staff Members</h3>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $staffCount }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-gray-500 text-sm font-medium">Delivery Agents</h3>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $deliveryCount }}</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Quick Actions Column -->
        <div class="space-y-6">
            <h2 class="text-lg font-semibold text-gray-800">Quick Actions</h2>
            <div class="grid grid-cols-1 gap-6">
                <!-- Manage Bikes Card -->
                <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 hover:shadow-md transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="p-3 bg-brand-50 rounded-lg text-brand-600">
                                <i class="fa-solid fa-motorcycle text-xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">Manage Bikes</h3>
                        </div>
                        <p class="text-gray-500 mb-6">Add, edit, or remove bikes from the fleet. Update availability and pricing.</p>
                        <a href="{{ route('bikes.index') }}" class="inline-flex items-center text-brand-600 font-semibold hover:text-brand-700 transition-colors">
                            Go to Bikes <i class="fa-solid fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>

                <!-- View Reports Card -->
                <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 hover:shadow-md transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="p-3 bg-blue-50 rounded-lg text-blue-600">
                                <i class="fa-solid fa-chart-line text-xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">View Reports</h3>
                        </div>
                        <p class="text-gray-500 mb-6">Check booking stats, revenue reports, and user activity.</p>
                        <a href="{{ route('admin.reports') }}" class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-700 transition-colors">
                            View Reports <i class="fa-solid fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add User Form Column -->
        <div class="space-y-6">
            <h2 class="text-lg font-semibold text-gray-800">Add New Staff / Delivery Boy</h2>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6">
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm p-2.5 border">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm p-2.5 border">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                <input type="password" name="password" id="password" required class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm p-2.5 border">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                                <select name="role" id="role" required class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm p-2.5 border">
                                    <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                                    <option value="delivery" {{ old('role') == 'delivery' ? 'selected' : '' }}>Delivery Boy</option>
                                </select>
                                @error('role')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transition-colors">
                                    Create User
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Management Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
        <!-- Staff List -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800">Support Staff</h2>
                <span class="px-2 py-0.5 bg-gray-100 text-gray-600 text-xs font-bold rounded-full">{{ $staffUsers->count() }}</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full divide-y divide-gray-200">
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($staffUsers as $staff)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $staff->name }}</div>
                                <div class="text-xs text-gray-500">{{ $staff->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form action="{{ route('admin.users.destroy', $staff->id) }}" method="POST" onsubmit="return confirm('Delete this staff?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 transition-colors">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="2" class="px-6 py-4 text-xs text-gray-400 italic text-center">No staff found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Delivery Boy List -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800">Delivery Team</h2>
                <span class="px-2 py-0.5 bg-gray-100 text-gray-600 text-xs font-bold rounded-full">{{ $deliveryUsers->count() }}</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full divide-y divide-gray-200">
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($deliveryUsers as $delivery)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $delivery->name }}</div>
                                <div class="text-xs text-gray-500">{{ $delivery->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form action="{{ route('admin.users.destroy', $delivery->id) }}" method="POST" onsubmit="return confirm('Delete this delivery agent?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 transition-colors">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="2" class="px-6 py-4 text-xs text-gray-400 italic text-center">No delivery agents found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Registered Customers List (Restored to Grid) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800">Customers</h2>
                <span class="px-2 py-0.5 bg-gray-100 text-gray-600 text-xs font-bold rounded-full">{{ $customerUsers->count() }}</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full divide-y divide-gray-200">
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($customerUsers as $customer)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $customer->name }}</div>
                                <div class="text-xs text-gray-500">{{ $customer->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form action="{{ route('admin.users.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('Delete this customer?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 transition-colors">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="2" class="px-6 py-4 text-xs text-gray-400 italic text-center">No customers found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Active Bookings & Live Tracking -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-12">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-800">Active Bookings & Live Tracking</h2>
            <div class="flex items-center gap-3">
                <span class="flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-2 w-2 rounded-full bg-brand-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-brand-500"></span>
                </span>
                <span class="text-xs font-bold text-gray-500 uppercase tracking-widest">{{ $activeBookingsList->count() }} Live Rentals</span>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Booking ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bike</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Route Info</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($activeBookingsList as $booking)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">#{{ $booking->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $booking->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $booking->bike->brand }} {{ $booking->bike->model }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2 text-xs">
                                <span class="text-green-600 font-bold">●</span> {{ $booking->pickup_location ?? 'Hub' }}
                                <i class="fa-solid fa-arrow-right text-gray-400 text-[10px]"></i>
                                <span class="text-red-600 font-bold">●</span> {{ $booking->drop_location ?? 'Hub' }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button onclick="toggleInlineTracker('{{ $booking->id }}', '{{ $booking->pickup_location }}', '{{ $booking->drop_location }}', '{{ $booking->bike->brand }} {{ $booking->bike->model }}')" 
                                    class="inline-flex items-center px-4 py-2 bg-brand-600 hover:bg-brand-700 text-white rounded-lg text-xs font-bold transition-all shadow-md shadow-brand-500/20 active:scale-95">
                                <i class="fa-solid fa-map mr-2"></i> Toggle Map
                            </button>
                        </td>
                    </tr>
                    <!-- Inline Map Row -->
                    <tr id="trackerRow-{{ $booking->id }}" class="hidden bg-gray-50">
                        <td colspan="5" class="px-0 py-0">
                            <div class="relative w-full overflow-hidden border-t border-gray-100 flex flex-col md:flex-row shadow-inner">
                                <!-- Static Simulation Map Panel -->
                                <div id="map-{{ $booking->id }}" class="w-full md:w-3/4 h-[400px] z-0" style="background: #f8fafc;"></div>
                                
                                <!-- Simulation Info Panel -->
                                <div class="w-full md:w-1/4 p-6 bg-white border-l border-gray-100 flex flex-col justify-between">
                                    <div>
                                        <div class="flex items-center gap-2 mb-4">
                                            <div class="w-3 h-3 bg-brand-500 rounded-full animate-pulse"></div>
                                            <h4 class="text-sm font-bold text-gray-800 uppercase tracking-tighter">Simulation Active</h4>
                                        </div>
                                        
                                        <div class="space-y-4">
                                            <div class="grid grid-cols-2 gap-3">
                                                <div>
                                                    <p class="text-[10px] text-gray-400 font-bold uppercase mb-1">Current Position</p>
                                                    <p class="text-[11px] font-mono text-brand-700 bg-brand-50 p-2 rounded truncate" id="coord-{{ $booking->id }}">Locating...</p>
                                                </div>
                                                <div>
                                                    <p class="text-[10px] text-gray-400 font-bold uppercase mb-1">Live ETA</p>
                                                    <p class="text-[11px] font-bold text-red-600 bg-red-50 p-2 rounded" id="eta-{{ $booking->id }}">15:00</p>
                                                </div>
                                            </div>
                                            
                                            <div class="grid grid-cols-2 gap-3">
                                                <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                                    <p class="text-[9px] text-gray-500 uppercase font-bold">Speed</p>
                                                    <p class="text-xs font-bold text-gray-800">38 <span class="text-[10px] text-gray-400">km/h</span></p>
                                                </div>
                                                <div class="bg-gray-50 p-3 rounded-lg border border-gray-100">
                                                    <p class="text-[9px] text-gray-500 uppercase font-bold">Battery</p>
                                                    <p class="text-xs font-bold text-green-600">92%</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-6 pt-6 border-t border-gray-50 text-[10px] text-gray-400 italic">
                                        <i class="fa-solid fa-circle-info mr-1"></i> Showing static path movement between locations.
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-400 text-center py-10 italic">No bookings are currently in transit.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

    <!-- External Assets for Map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

    <style>
        .leaflet-div-icon {
            background: none !important;
            border: none !important;
        }
        .location-tooltip {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 4px 8px;
            font-size: 10px;
            font-weight: 700;
            color: #1e293b;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border-left: 3px solid #6366f1;
        }
    </style>

    <script>
        let trackers = {}; 

        function toggleInlineTracker(id, pickup, drop, bikeName) {
            const row = document.getElementById(`trackerRow-${id}`);
            const isHidden = row.classList.contains('hidden');
            
            document.querySelectorAll('[id^="trackerRow-"]').forEach(r => r.classList.add('hidden'));
            
            if (isHidden) {
                row.classList.remove('hidden');
                initInlineMap(id, pickup, drop, bikeName);
            } else {
                if (trackers[id]) {
                    if (trackers[id].animation) clearTimeout(trackers[id].animation);
                    if (trackers[id].timer) clearInterval(trackers[id].timer);
                    trackers[id].map.remove();
                    delete trackers[id];
                }
            }
        }

        function initInlineMap(id, pickup, drop, bikeName) {
            const kochi = { lat: 10.0525, lng: 76.3144 };
            const bengaluru = { lat: 12.9716, lng: 77.5946 };
            
            const pickupLower = pickup.toLowerCase();
            const dropLower = drop.toLowerCase();
            
            // Determine City Context
            let hub = kochi;
            if (pickupLower.includes('bengaluru') || dropLower.includes('bengaluru') || pickupLower.includes('indira nagar') || pickupLower.includes('koramangala')) {
                hub = bengaluru;
            }

            // Specific Coordinates Map
            const locations = {
                'rcss': [10.0525, 76.3144],
                'rset': [9.9917, 76.3488],
                'indira nagar': [12.9719, 77.6412],
                'koramangala': [12.9352, 77.6245]
            };

            let start = [hub.lat + (Math.random() - 0.5) * 0.05, hub.lng + (Math.random() - 0.5) * 0.05];
            let end = [hub.lat + (Math.random() - 0.5) * 0.05, hub.lng + (Math.random() - 0.5) * 0.05];

            // Snap to specific locations if detected
            for (const [name, coords] of Object.entries(locations)) {
                if (pickupLower.includes(name)) start = coords;
                if (dropLower.includes(name)) end = coords;
            }

            const map = L.map(`map-${id}`).setView(start, 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

            setTimeout(() => map.invalidateSize(), 200);

            const bikeIcon = L.divIcon({
                html: '<div class="p-2 bg-brand-600 text-white rounded-full shadow-lg border-2 border-white"><i class="fa-solid fa-motorcycle"></i></div>',
                className: 'custom-div-icon',
                iconSize: [35, 35]
            });

            const control = L.Routing.control({
                waypoints: [L.latLng(start[0], start[1]), L.latLng(end[0], end[1])],
                routeWhileDragging: false,
                addWaypoints: false,
                draggableWaypoints: false,
                fitSelectedRoutes: true,
                show: false,
                lineOptions: {
                    styles: [{ color: '#6366f1', weight: 6, opacity: 0.8, dashArray: '10, 10' }]
                },
                createMarker: function() { return null; }
            }).addTo(map);

            // Pickup Marker with Label
            L.marker(start, {icon: L.divIcon({html: '<div class="w-4 h-4 bg-green-500 rounded-full border-2 border-white shadow"></div>', className: 'custom-div-icon'})})
                .addTo(map)
                .bindTooltip(pickup, { permanent: true, direction: 'top', className: 'location-tooltip' });

            // Dropoff Marker with Label
            L.marker(end, {icon: L.divIcon({html: '<div class="w-4 h-4 bg-red-500 rounded-full border-2 border-white shadow"></div>', className: 'custom-div-icon'})})
                .addTo(map)
                .bindTooltip(drop, { permanent: true, direction: 'top', className: 'location-tooltip' });

            const bikeMarker = L.marker(start, {icon: bikeIcon}).addTo(map);
            
            trackers[id] = { map, marker: bikeMarker, animation: null, points: [], timer: null, totalSeconds: 900 }; // 15 mins

            control.on('routesfound', function(e) {
                const routes = e.routes;
                trackers[id].points = routes[0].coordinates;
                startSimulation(id);
            });

            // Robust Fallback for OSRM Timeouts/Errors
            control.on('routingerror', function() {
                console.warn(`Routing failed for booking ${id}, using fallback path.`);
                // Create a simple fallback path (linear interpolation)
                const fallbackPoints = [];
                const steps = 100;
                for (let i = 0; i <= steps; i++) {
                    const pct = i / steps;
                    fallbackPoints.push({
                        lat: start[0] + (end[0] - start[0]) * pct,
                        lng: start[1] + (end[1] - start[1]) * pct
                    });
                }
                trackers[id].points = fallbackPoints;
                
                // Draw a simple fallback line since routing line failed
                L.polyline([start, end], {color: '#94a3b8', weight: 4, dashArray: '5, 10', opacity: 0.5}).addTo(map);
                
                startSimulation(id);
            });
        }

        function startSimulation(id) {
            const t = trackers[id];
            if (!t || !t.points || t.points.length === 0) return;

            let remainingSeconds = t.totalSeconds;
            let pointIndex = 0;
            
            // Calculate how often to move to the next point
            const interval = (t.totalSeconds * 1000) / t.points.length;

            // Clear any existing timer/animation for this ID
            if (t.timer) clearInterval(t.timer);
            if (t.animation) clearTimeout(t.animation);

            // Start ETA Timer
            t.timer = setInterval(() => {
                remainingSeconds--;
                if (remainingSeconds < 0) remainingSeconds = t.totalSeconds;
                
                const mins = Math.floor(remainingSeconds / 60);
                const secs = remainingSeconds % 60;
                const etaLabel = document.getElementById(`eta-${id}`);
                if (etaLabel) etaLabel.innerText = `${mins}:${secs.toString().padStart(2, '0')}`;
            }, 1000);

            function move() {
                if (!trackers[id]) return;
                
                const point = t.points[pointIndex];
                t.marker.setLatLng([point.lat, point.lng]);
                
                const coordLabel = document.getElementById(`coord-${id}`);
                if (coordLabel) coordLabel.innerText = `${point.lat.toFixed(5)}, ${point.lng.toFixed(5)}`;
                
                pointIndex++;
                if (pointIndex >= t.points.length) {
                    pointIndex = 0;
                    remainingSeconds = t.totalSeconds;
                }
                
                t.animation = setTimeout(move, interval);
            }
            move();
        }
    </script>
@endsection
