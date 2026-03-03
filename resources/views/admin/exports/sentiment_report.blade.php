<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sentiment Analysis Report</title>
    <style>
        .header { background-color: #6366f1; color: #ffffff; font-weight: bold; font-size: 14px; text-align: center; height: 40px; }
        .cell { border: 1px solid #cbd5e1; padding: 5px; }
        .title-row { height: 60px; }
        .row-even { background-color: #ffffff; }
        .row-odd { background-color: #f1f5f9; }
        
        /* The Circle Graph (Pie Chart) CSS Trick */
        .pie-chart {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            display: inline-block;
        }
        
        /* Note: Excel ignores background gradients, but we provide it for web view. 
           We also use a classic HTML table visual to ensure Excel compatibility. */
    </style>
</head>
<body>
    @php
        $total = max($sentimentStats['total'], 1); // prevent division by zero
        $vs_pct = round(($sentimentStats['very_satisfied'] / $total) * 100);
        $s_pct = round(($sentimentStats['satisfied'] / $total) * 100);
        $n_pct = round(($sentimentStats['neutral'] / $total) * 100);
        $ns_pct = round(($sentimentStats['not_satisfied'] / $total) * 100);
    @endphp

    <table>
        <!-- Title & Trademark Header -->
        <tr class="title-row">
            <td colspan="5" style="text-align: center; vertical-align: middle; background-color: #1e293b; color: white;">
                <h1 style="margin: 0;">BikeMS™ - Customer Sentiment Report</h1>
                <p style="margin: 0; font-size: 10px; color: #94a3b8;">Generated on: {{ now()->format('F j, Y, g:i a') }}</p>
            </td>
        </tr>
        <tr><td colspan="5"></td></tr>

        <!-- Summary & Visual Circle Graph Section -->
        <tr>
            <td colspan="5" style="background-color: #f8fafc; color: #475569; font-weight: bold; font-size: 14px; height: 30px; border: 1px solid #cbd5e1; padding: 5px;">
                Sentiment Breakdown ({{ $sentimentStats['total'] }} Reviews)
            </td>
        </tr>
        <tr>
            <!-- Excel-friendly "Circle Graph" alternative (using colored cells side-by-side conceptually like a pie split horizontally) -->
            <td colspan="5" style="text-align: center; padding: 20px;">
                {{-- Web-View Pie Chart --}}
                <div style="background: conic-gradient(
                    #4f46e5 0% {{ $vs_pct }}%, 
                    #10b981 {{ $vs_pct }}% {{ $vs_pct + $s_pct }}%, 
                    #f59e0b {{ $vs_pct + $s_pct }}% {{ $vs_pct + $s_pct + $n_pct }}%, 
                    #ef4444 {{ $vs_pct + $s_pct + $n_pct }}% 100%
                ); width: 120px; height: 120px; border-radius: 50%; margin: 0 auto; border: 2px solid #e2e8f0;"></div>
                
                <br><br>
                
                {{-- Excel-safe visually mapped table percentage breakdown --}}
                <table align="center" style="border-collapse: collapse;">
                    <tr>
                        <td style="background-color: #4f46e5; width: 15px; height: 15px;"></td>
                        <td>Very Satisfied (🤩) : {{ $sentimentStats['very_satisfied'] }} ({{ $vs_pct }}%)</td>
                    </tr>
                    <tr>
                        <td style="background-color: #10b981; width: 15px; height: 15px;"></td>
                        <td>Satisfied (😊) : {{ $sentimentStats['satisfied'] }} ({{ $s_pct }}%)</td>
                    </tr>
                    <tr>
                        <td style="background-color: #f59e0b; width: 15px; height: 15px;"></td>
                        <td>Neutral (😐) : {{ $sentimentStats['neutral'] }} ({{ $n_pct }}%)</td>
                    </tr>
                    <tr>
                        <td style="background-color: #ef4444; width: 15px; height: 15px;"></td>
                        <td>Not Satisfied (😡) : {{ $sentimentStats['not_satisfied'] }} ({{ $ns_pct }}%)</td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr><td colspan="5"></td></tr>

        <!-- Main Data Table Headers -->
        <tr>
            <td class="header border">Booking ID</td>
            <td class="header border">Customer</td>
            <td class="header border">Bike</td>
            <td class="header border">Sentiment</td>
            <td class="header border">Review Comment</td>
        </tr>

        <!-- Data Rows -->
        @forelse($reviews as $index => $review)
            @php
                $emoji = '';
                $text = '';
                switch($review->sentiment) {
                    case 4: $emoji = '🤩'; $text = 'Very Satisfied'; break;
                    case 3: $emoji = '😊'; $text = 'Satisfied'; break;
                    case 2: $emoji = '😐'; $text = 'Neutral'; break;
                    case 1: $emoji = '😡'; $text = 'Not Satisfied'; break;
                }
            @endphp
            <tr class="{{ $index % 2 == 0 ? 'row-even' : 'row-odd' }}">
                <td class="cell" align="center" style="vertical-align: top;">#{{ $review->id }}</td>
                <td class="cell" style="vertical-align: top;">{{ $review->user->name ?? 'N/A' }}</td>
                <td class="cell" style="vertical-align: top;">{{ $review->bike->name ?? 'N/A' }}</td>
                <td class="cell" align="center" style="vertical-align: top;">{{ $emoji }} {{ $text }}</td>
                <td class="cell" style="vertical-align: top;">{{ $review->review ?? '-- No written review --' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="cell" align="center">No reviews found.</td>
            </tr>
        @endforelse

        <tr><td colspan="5"></td></tr>
        
        <!-- Footer Trademark -->
        <tr>
            <td colspan="5" style="font-style: italic; color: #94a3b8; font-size: 10px; text-align: center;">
                © {{ date('Y') }} BikeMS Smart Rental Systems. All rights reserved. Do not distribute without authorization.
            </td>
        </tr>
    </table>
</body>
</html>
