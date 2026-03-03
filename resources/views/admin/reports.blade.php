@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 font-display">System Reports</h1>
            <p class="text-gray-500 mt-1">Overview of your business performance.</p>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Revenue Card -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-green-50 rounded-lg text-green-600">
                    <i class="fa-solid fa-indian-rupee-sign text-xl"></i>
                </div>
                <span class="text-xs font-medium px-2.5 py-0.5 rounded-full bg-green-100 text-green-800">Total</span>
            </div>
            <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wider">Total Revenue</h3>
            <p class="text-3xl font-bold text-gray-900 mt-2">₹{{ number_format($totalRevenue, 2) }}</p>
            <p class="text-sm text-gray-400 mt-1">From all payments</p>
        </div>

        <!-- Realized Revenue -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
             <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-brand-50 rounded-lg text-brand-600">
                    <i class="fa-solid fa-file-invoice-dollar text-xl"></i>
                </div>
                <span class="text-xs font-medium px-2.5 py-0.5 rounded-full bg-brand-100 text-brand-800">Realized</span>
            </div>
            <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wider">Finished Orders Revenue</h3>
            <p class="text-3xl font-bold text-gray-900 mt-2">₹{{ number_format($realizedRevenue, 2) }}</p>
             <p class="text-sm text-gray-400 mt-1">From completed bookings</p>
        </div>

        <!-- Total Bookings -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-blue-50 rounded-lg text-blue-600">
                    <i class="fa-solid fa-calendar-check text-xl"></i>
                </div>
            </div>
            <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wider">Total Bookings</h3>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalBookings }}</p>
            <div class="flex gap-2 mt-2 text-xs">
                <span class="text-green-600 bg-green-50 px-2 py-1 rounded">{{ $completedBookings }} Completed</span>
                <span class="text-brand-600 bg-brand-50 px-2 py-1 rounded">{{ $activeBookings }} Active</span>
            </div>
        </div>

        <!-- Maintenance -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
             <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-orange-50 rounded-lg text-orange-600">
                    <i class="fa-solid fa-wrench text-xl"></i>
                </div>
            </div>
            <h3 class="text-gray-500 text-sm font-medium uppercase tracking-wider">Maintenance Records</h3>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $maintenanceCount }}</p>
             <p class="text-sm text-gray-400 mt-1">Bikes currently in service</p>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8 mt-8">
        <!-- Revenue Chart -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Revenue Overview (Last 6 Months)</h3>
            <div class="relative h-64">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
        <!-- Bookings Chart -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Bookings Overview (Last 6 Months)</h3>
            <div class="relative h-64">
                <canvas id="bookingsChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Customer Sentiments -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-8">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Customer Sentiments</h2>
                <p class="text-sm text-gray-500">Based on {{ $sentimentStats['total'] }} reviews</p>
            </div>
            <a href="{{ route('admin.reports.sentiments_export') }}" class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-semibold text-white bg-green-600 hover:bg-green-700 rounded-lg shadow-sm transition-colors">
                <i class="fa-solid fa-file-excel"></i> Export Sentiment Report
            </a>
        </div>
        <div class="p-6 grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-gray-50 rounded-xl p-4 text-center border border-gray-100">
                <div class="text-3xl mb-2">🤩</div>
                <div class="text-2xl font-bold text-gray-900">{{ $sentimentStats['very_satisfied'] }}</div>
                <div class="text-xs text-brand-600 font-semibold uppercase tracking-wider mt-1">Very Satisfied</div>
            </div>
            <div class="bg-gray-50 rounded-xl p-4 text-center border border-gray-100">
                <div class="text-3xl mb-2">😊</div>
                <div class="text-2xl font-bold text-gray-900">{{ $sentimentStats['satisfied'] }}</div>
                <div class="text-xs text-green-600 font-semibold uppercase tracking-wider mt-1">Satisfied</div>
            </div>
            <div class="bg-gray-50 rounded-xl p-4 text-center border border-gray-100">
                <div class="text-3xl mb-2">😐</div>
                <div class="text-2xl font-bold text-gray-900">{{ $sentimentStats['neutral'] }}</div>
                <div class="text-xs text-yellow-600 font-semibold uppercase tracking-wider mt-1">Neutral</div>
            </div>
            <div class="bg-gray-50 rounded-xl p-4 text-center border border-gray-100">
                <div class="text-3xl mb-2">😡</div>
                <div class="text-2xl font-bold text-gray-900">{{ $sentimentStats['not_satisfied'] }}</div>
                <div class="text-xs text-red-600 font-semibold uppercase tracking-wider mt-1">Not Satisfied</div>
            </div>
        </div>
    </div>

    <!-- Recent Completed Orders -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-800">Recently Completed Orders</h2>
            <a href="{{ route('admin.reports.export') }}" class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-semibold text-white bg-green-600 hover:bg-green-700 rounded-lg shadow-sm transition-colors">
                <i class="fa-solid fa-file-excel"></i> Export to Excel
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-50 text-gray-900 font-semibold uppercase tracking-wider text-xs">
                    <tr>
                        <th class="px-6 py-3">Booking ID</th>
                        <th class="px-6 py-3">Customer</th>
                        <th class="px-6 py-3">Bike</th>
                        <th class="px-6 py-3">Amount</th>
                        <th class="px-6 py-3">Completion Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($recentActivity as $booking)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-900">#{{ $booking->id }}</td>
                        <td class="px-6 py-4">{{ $booking->user->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $booking->bike->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4 font-medium text-green-600">
                            ₹{{ number_format($booking->payment?->amount ?? 0, 2) }}
                        </td>
                        <td class="px-6 py-4 text-gray-500">
                            {{ $booking->updated_at->format('M d, Y H:i') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">No completed orders found yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const labels = {!! $chartLabels->toJson() !!};
        const revenueData = {!! $chartRevenue->toJson() !!};
        const bookingsData = {!! $chartBookings->toJson() !!};

        // Revenue Chart
        new Chart(document.getElementById('revenueChart'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Revenue (₹)',
                    data: revenueData,
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#10b981',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { borderDash: [2, 2] }, ticks: { callback: function(value) { return '₹' + value; } } },
                    x: { grid: { display: false } }
                }
            }
        });

        // Bookings Chart
        new Chart(document.getElementById('bookingsChart'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Completed Bookings',
                    data: bookingsData,
                    backgroundColor: '#6366f1',
                    borderRadius: 6,
                    barPercentage: 0.6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { borderDash: [2, 2] }, ticks: { stepSize: 1 } },
                    x: { grid: { display: false } }
                }
            }
        });
    });
</script>
@endsection
