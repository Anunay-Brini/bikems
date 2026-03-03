<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #INV-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none; }
            body { -webkit-print-color-adjust: exact; }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans text-gray-900">

    <div class="max-w-3xl mx-auto my-10 bg-white shadow-lg rounded-lg overflow-hidden print:shadow-none print:my-0 print:max-w-none">
        
        <!-- Header -->
        <div class="px-8 py-10 bg-gray-900 text-white flex justify-between items-center">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="bg-white text-gray-900 p-2 rounded-lg">
                        <i class="fa-solid fa-motorcycle text-xl"></i>
                    </div>
                    <span class="text-2xl font-bold tracking-wide">BikeMS</span>
                </div>
                <p class="text-gray-400 text-sm">Premium Bike Rental Services</p>
            </div>
            <div class="text-right">
                <h1 class="text-3xl font-bold uppercase tracking-wider mb-1">Invoice</h1>
                <p class="text-gray-400 text-sm">#INV-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</p>
                <p class="text-gray-400 text-sm">Date: {{ now()->format('M d, Y') }}</p>
            </div>
        </div>

        <!-- Billing Info -->
        <div class="px-8 py-8 border-b border-gray-100 pb-8 grid grid-cols-2 gap-8">
            <div>
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Billed To</h3>
                <h4 class="text-lg font-bold text-gray-900">{{ $booking->user->name }}</h4>
                <p class="text-gray-500 text-sm mt-1">{{ $booking->user->email }}</p>
            </div>
            <div class="text-right">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Provide By</h3>
                <h4 class="text-lg font-bold text-gray-900">BikeMS Inc.</h4>
                <p class="text-gray-500 text-sm mt-1">123 Bike Street, City Center</p>
                <p class="text-gray-500 text-sm">contact@bikems.com</p>
            </div>
        </div>

        <!-- Invoice Details -->
        <div class="px-8 py-8">
            <h3 class="text-lg font-bold text-gray-900 mb-6">Booking Details</h3>
            
            <div class="overflow-hidden border border-gray-200 rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Description</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Duration</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Rate</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-gray-900">{{ $booking->bike->name ?? 'Unknown Bike' }}</div>
                                <div class="text-xs text-gray-500">Booking ID: #{{ $booking->id }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($booking->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($booking->end_date)->format('M d') }}
                                <br>
                                <span class="text-xs">({{ \Carbon\Carbon::parse($booking->start_date)->diffInDays(\Carbon\Carbon::parse($booking->end_date)) ?: 1 }} Days)</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">
                                ₹{{ number_format($booking->bike->price_per_day ?? 0) }} / day
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold text-gray-900">
                                @php
                                    $amount = 0;
                                    if ($booking->payment) {
                                        $amount = $booking->payment->amount;
                                    } else {
                                        $days = \Carbon\Carbon::parse($booking->start_date)->diffInDays(\Carbon\Carbon::parse($booking->end_date)) ?: 1;
                                        $amount = $days * ($booking->bike->price_per_day ?? 0);
                                    }
                                @endphp
                                ₹{{ number_format($amount) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-8 flex justify-end">
                <div class="w-1/2">
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <span class="text-gray-500 text-sm">Subtotal</span>
                        <span class="text-gray-900 font-medium">₹{{ number_format($amount) }}</span>
                    </div>
                    <div class="flex justify-between py-2 border-b border-gray-100">
                        <span class="text-gray-500 text-sm">Tax (0%)</span>
                        <span class="text-gray-900 font-medium">₹0</span>
                    </div>
                    <div class="flex justify-between py-4">
                        <span class="text-lg font-bold text-gray-900">Total</span>
                        <span class="text-lg font-bold text-brand-600">₹{{ number_format($amount) }}</span>
                    </div>
                </div>
            </div>
            
            @if($booking->status == 'active' || $booking->status == 'assigned' || $booking->status == 'picked_up')
                <div class="mt-8 bg-yellow-50 text-yellow-800 p-4 rounded-lg text-sm flex items-start gap-3">
                    <i class="fa-solid fa-circle-info mt-0.5"></i>
                    <p><strong>Note:</strong> This booking is currently active. The final amount may vary if the bike is returned late or damaged.</p>
                </div>
            @endif
             
            @if($booking->payment)
                <div class="mt-4 bg-green-50 text-green-800 p-4 rounded-lg text-sm flex items-start gap-3">
                    <i class="fa-solid fa-check-circle mt-0.5"></i>
                    <p><strong>Payment Status:</strong> Paid via {{ ucfirst($booking->payment->payment_method) }} on {{ $booking->payment->created_at->format('M d, Y') }}.</p>
                </div>
             @endif
        </div>

        <!-- Footer -->
        <div class="bg-gray-50 px-8 py-6 text-center text-xs text-gray-500">
            <p class="mb-2">Thank you for choosing BikeMS!</p>
            <p>&copy; {{ date('Y') }} BikeMS Inc. All rights reserved.</p>
        </div>
    </div>

    <!-- Print Button (Visible only on screen) -->
    <div class="fixed bottom-8 right-8 no-print">
        <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-full shadow-lg transition-all transform hover:scale-105 flex items-center gap-2">
            <i class="fa-solid fa-print"></i> Print Invoice
        </button>
    </div>

</body>
</html>
