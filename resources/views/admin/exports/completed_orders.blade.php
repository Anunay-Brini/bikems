<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Completed Orders Report</title>
    <style>
        .header { background-color: #6366f1; color: #ffffff; font-weight: bold; font-size: 16px; text-align: center; height: 50px; }
        .sub-header { background-color: #f8fafc; color: #475569; font-weight: bold; font-size: 12px; }
        .row-even { background-color: #ffffff; }
        .row-odd { background-color: #f1f5f9; }
        .cell { border: 1px solid #cbd5e1; padding: 5px; }
        .trademark { font-style: italic; color: #94a3b8; font-size: 10px; text-align: center; }
        .title-row { height: 60px; }
    </style>
</head>
<body>
    <table>
        <!-- Title & Trademark Header -->
        <tr class="title-row">
            <td colspan="5" style="text-align: center; vertical-align: middle; background-color: #1e293b; color: white;">
                <h1 style="margin: 0;">BikeMS™ - Completed Orders Report</h1>
                <p style="margin: 0; font-size: 10px; color: #94a3b8;">Generated on: {{ now()->format('F j, Y, g:i a') }}</p>
            </td>
        </tr>
        <tr>
            <td colspan="5"></td> <!-- Spacing -->
        </tr>

        <!-- Chart Summary -->
        <tr>
            <td colspan="5" style="background-color: #f8fafc; color: #475569; font-weight: bold; font-size: 14px; height: 30px; border: 1px solid #cbd5e1; padding: 5px;">
                Performance Summary (Last 6 Months)
            </td>
        </tr>
        <tr>
            <td class="header border" colspan="2">Month</td>
            <td class="header border">Bookings Count</td>
            <td class="header border" colspan="2">Revenue (₹) Visualization</td>
        </tr>
        @php
            $maxRev = $chartData->max('revenue') ?: 1;
        @endphp
        @foreach($chartData as $data)
        <tr>
            <td class="cell" align="center" colspan="2"><b>{{ $data['month'] }}</b></td>
            <td class="cell" align="center">{{ $data['bookings'] }}</td>
            <td class="cell" colspan="2" style="width: 250px;">
                @php
                    $width = max(1, round(($data['revenue'] / $maxRev) * 100));
                @endphp
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="width: {{ $width }}%; background-color: #10b981; height: 15px;"></td>
                        <td style="width: {{ 100 - $width }}%; font-size: 11px;"> &nbsp; ₹{{ number_format($data['revenue'], 2) }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        @endforeach

        <tr>
            <td colspan="5" style="height: 20px;"></td> <!-- Spacing -->
        </tr>

        <!-- Main Data Table Headers -->
        <tr>
            <td colspan="5" style="background-color: #f8fafc; color: #475569; font-weight: bold; font-size: 14px; height: 30px; border: 1px solid #cbd5e1; padding: 5px;">
                Detailed Order List
            </td>
        </tr>
        <tr>
            <td class="header border">Booking ID</td>
            <td class="header border">Customer</td>
            <td class="header border">Bike</td>
            <td class="header border">Amount (₹)</td>
            <td class="header border">Completion Date</td>
        </tr>

        <!-- Data Rows -->
        @foreach($completedBookings as $index => $booking)
        <tr class="{{ $index % 2 == 0 ? 'row-even' : 'row-odd' }}">
            <td class="cell" align="center">#{{ $booking->id }}</td>
            <td class="cell">{{ $booking->user->name ?? 'N/A' }}</td>
            <td class="cell">{{ $booking->bike->name ?? 'N/A' }}</td>
            <td class="cell" align="right">₹{{ number_format($booking->payment?->amount ?? 0, 2) }}</td>
            <td class="cell" align="center">{{ $booking->updated_at->format('M d, Y H:i') }}</td>
        </tr>
        @endforeach

        <tr>
            <td colspan="5"></td> <!-- Spacing -->
        </tr>
        <!-- Footer Trademark -->
        <tr>
            <td colspan="5" class="trademark">
                © {{ date('Y') }} BikeMS Smart Rental Systems. All rights reserved. Do not distribute without authorization.
            </td>
        </tr>
    </table>
</body>
</html>
