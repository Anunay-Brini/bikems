@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold font-display text-gray-900">My Bookings</h1>
            <p class="text-gray-500 mt-1">Track your rides and payment history.</p>
        </div>
        <a href="{{ route('bikes.browse') }}" class="inline-flex items-center px-4 py-2 bg-gray-900 hover:bg-gray-800 text-white rounded-lg transition-colors text-sm font-medium">
            <i class="fa-solid fa-plus mr-2"></i> Book New Ride
        </a>
    </div>

    @if($bookings->isEmpty())
        <div class="bg-white rounded-2xl p-12 text-center shadow-sm border border-gray-100">
            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-route text-2xl text-gray-400"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-2">No bookings yet</h3>
            <p class="text-gray-500 mb-6">You haven't booked any bikes yet. Start your journey today!</p>
            <a href="{{ route('bikes.browse') }}" class="text-brand-600 font-bold hover:underline">Browse Fleet</a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($bookings as $booking)
                <div class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col h-full">
                    {{-- Image Container --}}
                    <div class="relative h-48 bg-gray-100 overflow-hidden">
                        @if($booking->bike->image)
                             <img src="{{ asset('storage/' . $booking->bike->image) }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                <i class="fa-solid fa-motorcycle text-4xl"></i>
                            </div>
                        @endif
                        
                        {{-- Status Badge (Absolute Top Right) --}}
                        <div class="absolute top-3 right-3">
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider shadow-sm
                                @if(in_array(strtolower($booking->status), ['active', 'picked_up'])) bg-green-500 text-white
                                @elseif(in_array(strtolower($booking->status), ['completed', 'returned'])) bg-gray-800 text-white
                                @elseif(in_array(strtolower($booking->status), ['assigned'])) bg-blue-500 text-white
                                @else bg-yellow-500 text-white
                                @endif">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="p-5 flex flex-col flex-grow">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 leading-tight mb-1">{{ $booking->bike->name ?? 'Unknown Bike' }}</h3>
                                <div class="flex items-center text-xs text-brand-600 font-medium bg-brand-50 px-2 py-0.5 rounded-md w-fit">
                                    Booking #{{ $booking->id }}
                                </div>
                            </div>
                        </div>
                        
                            <div class="space-y-3 mb-6">
                                <div class="flex items-center text-sm text-gray-600">
                                    <div class="w-8 flex-shrink-0 text-center text-gray-400">
                                        <i class="fa-regular fa-calendar"></i>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-400 uppercase font-semibold tracking-wide">Duration</span>
                                        <span class="font-medium">{{ \Carbon\Carbon::parse($booking->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($booking->end_date)->format('M d, Y') }}</span>
                                    </div>
                                </div>

                                <div class="flex items-center text-sm text-gray-600">
                                    <div class="w-8 flex-shrink-0 text-center text-gray-400">
                                        <i class="fa-solid fa-indian-rupee-sign"></i>
                                    </div>
                                    <div class="flex flex-col w-full">
                                        <span class="text-xs text-gray-400 uppercase font-semibold tracking-wide">Payment Details</span>
                                        
                                        @php
                                            $totalAmount = $booking->total_amount;
                                            $amountPaid = $booking->amount_paid ?? 0;
                                            $damageCharges = $booking->damage_charges ?? 0;
                                            $finalTotal = $totalAmount + $damageCharges;
                                            $balance = $finalTotal - $amountPaid;
                                        @endphp

                                        <div class="flex justify-between items-center mt-1">
                                            <span class="text-gray-900 font-bold text-base">₹{{ number_format($finalTotal) }}</span>
                                            
                                            @if($balance <= 0 && $finalTotal > 0)
                                                <span class="text-xs font-bold text-green-600 bg-green-50 px-2 py-1 rounded-full">Fully Paid</span>
                                            @elseif($amountPaid > 0)
                                                <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded-full">Partial Paid</span>
                                            @else
                                                <span class="text-xs font-bold text-yellow-600 bg-yellow-50 px-2 py-1 rounded-full">Unpaid</span>
                                            @endif
                                        </div>
                                        
                                        @if($amountPaid > 0)
                                            <div class="text-xs text-gray-500 mt-1">
                                                Paid: ₹{{ number_format($amountPaid) }}
                                                @if($damageCharges > 0)
                                                    <span class="text-red-500">(Inc. ₹{{ $damageCharges }} Damage)</span>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="mt-auto pt-4 border-t border-gray-50 grid gap-2">
                                @php
                                    $isCompleted = in_array(strtolower($booking->status), ['completed', 'returned']);
                                    $isActive = in_array(strtolower($booking->status), ['active', 'picked_up']);
                                    $isAssigned = strtolower($booking->status) === 'assigned';
                                @endphp

                                @if($balance > 0 && !in_array(strtolower($booking->status), ['cancelled']))
                                    <form action="{{ route('payment.store', $booking) }}" method="POST" class="w-full">
                                        @csrf
                                        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-brand-600 border border-transparent rounded-lg text-sm font-semibold text-white hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 shadow-lg shadow-brand-500/30 transition-all transform hover:-translate-y-0.5">
                                            <i class="fa-solid fa-credit-card mr-2"></i> 
                                            @if($amountPaid == 0)
                                                Pay Advance (₹{{ number_format($totalAmount / 2) }})
                                            @else
                                                Pay Balance (₹{{ number_format($balance) }})
                                            @endif
                                        </button>
                                    </form>
                                @endif

                            @if($isCompleted || $isActive)
                                <a href="{{ route('booking.bill', $booking->id) }}" target="_blank" class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-200 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:text-gray-900 hover:border-gray-300 transition-all">
                                    <i class="fa-solid fa-file-invoice mr-2"></i> Generate Bill
                                </a>
                            @endif

                            @if($isCompleted && !$booking->review)
                                <button type="button" onclick="openReviewModal({{ $booking->id }})" class="w-full inline-flex items-center justify-center px-4 py-2 border border-brand-200 rounded-lg text-sm font-semibold text-brand-700 bg-brand-50 hover:bg-brand-100 hover:border-brand-300 transition-all">
                                    <i class="fa-solid fa-face-smile mr-2"></i> Leave a Review
                                </button>
                            @elseif($isCompleted && $booking->review)
                                <div class="w-full px-4 py-2 bg-gray-50 text-gray-500 rounded-lg text-sm font-medium flex items-center justify-center border border-gray-100">
                                    <i class="fa-solid fa-check text-green-500 mr-2"></i> Review Submitted
                                </div>
                            @endif

                            @if($isActive)
                                <div class="w-full px-4 py-2 bg-green-50 text-green-700 rounded-lg text-sm font-bold flex items-center justify-center">
                                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></div>
                                    Currently On Trip
                                </div>
                            @elseif($isAssigned)
                                 <div class="w-full px-4 py-2 bg-blue-50 text-blue-700 rounded-lg text-sm font-bold flex items-center justify-center">
                                    <i class="fa-solid fa-motorcycle mr-2"></i> Driver Assigned
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Review Modal -->
<div id="reviewModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl w-full max-w-md overflow-hidden shadow-xl transform transition-all">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
            <h3 class="text-lg font-bold text-gray-900">How was your ride?</h3>
            <button onclick="closeReviewModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>
        <div class="p-6">
            <form id="reviewForm" method="POST" action="">
                @csrf
                <input type="hidden" name="sentiment" id="sentimentInput" value="" required>
                
                <div class="mb-6 text-center">
                    <p class="text-sm text-gray-600 mb-4 font-medium">Select an emoji that describes your experience</p>
                    <div class="flex justify-center gap-4">
                        <button type="button" onclick="selectSentiment(1, this)" class="sentiment-btn text-4xl grayscale hover:grayscale-0 hover:scale-110 transition-all focus:outline-none" title="Not Satisfied">😡</button>
                        <button type="button" onclick="selectSentiment(2, this)" class="sentiment-btn text-4xl grayscale hover:grayscale-0 hover:scale-110 transition-all focus:outline-none" title="Neutral">😐</button>
                        <button type="button" onclick="selectSentiment(3, this)" class="sentiment-btn text-4xl grayscale hover:grayscale-0 hover:scale-110 transition-all focus:outline-none" title="Satisfied">😊</button>
                        <button type="button" onclick="selectSentiment(4, this)" class="sentiment-btn text-4xl grayscale hover:grayscale-0 hover:scale-110 transition-all focus:outline-none" title="Very Satisfied">🤩</button>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Leave a comment <span class="text-gray-400 font-normal">(Optional)</span></label>
                    <textarea name="review" rows="3" class="w-full rounded-xl border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500 text-sm p-3 border" placeholder="Tell us what you liked or how we can improve..."></textarea>
                </div>

                <button type="submit" class="w-full py-2.5 px-4 bg-gray-900 text-white rounded-xl font-semibold hover:bg-gray-800 transition-colors shadow-md disabled:opacity-50" id="submitReviewBtn" disabled>
                    Submit Review
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function openReviewModal(bookingId) {
        const form = document.getElementById('reviewForm');
        form.action = `/booking/${bookingId}/review`;
        document.getElementById('reviewModal').classList.remove('hidden');
    }

    function closeReviewModal() {
        document.getElementById('reviewModal').classList.add('hidden');
    }

    function selectSentiment(value, btn) {
        document.getElementById('sentimentInput').value = value;
        document.getElementById('submitReviewBtn').disabled = false;
        
        // Remove active state from all
        document.querySelectorAll('.sentiment-btn').forEach(b => {
            b.classList.add('grayscale');
            b.classList.remove('scale-110', 'grayscale-0', 'ring-4', 'ring-brand-100', 'rounded-full');
        });
        
        // Add active state to selected
        btn.classList.remove('grayscale');
        btn.classList.add('scale-110', 'grayscale-0', 'ring-4', 'ring-brand-100', 'rounded-full');
    }
</script>

@endsection
