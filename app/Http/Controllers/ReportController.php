<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // Totals
        $totalBookings = Booking::count();
        $totalRevenue = Payment::sum('amount');
        $maintenanceCount = Maintenance::count();

        // Breakdown
        $activeBookings = Booking::where('status', 'active')->count();
        $completedBookings = Booking::where('status', 'completed')->count();
        $cancelledBookings = Booking::where('status', 'cancelled')->count();

        // Revenue from completed bookings only (optional logic, but good for "finished orders")
        $realizedRevenue = Booking::where('bookings.status', 'completed')
            ->join('payments', 'bookings.id', '=', 'payments.booking_id')
            ->sum('payments.amount');

        // Recent Activity (Completed bookings)
        $recentActivity = Booking::where('status', 'completed')
            ->with(['user', 'bike', 'payment'])
            ->latest()
            ->take(5)
            ->get();

        // Chart Data (Last 6 Months)
        $allCompleted = Booking::where('status', 'completed')->with('payment')->get();
        $chartLabels = collect();
        $chartRevenue = collect();
        $chartBookings = collect();

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthName = $date->format('M Y');
            
            $monthOrders = $allCompleted->filter(function($order) use ($date) {
                return $order->updated_at->format('Y-m') === $date->format('Y-m');
            });

            $chartLabels->push($monthName);
            $chartBookings->push($monthOrders->count());
            $chartRevenue->push($monthOrders->sum(fn($o) => $o->payment ? $o->payment->amount : 0));
        }

        // Sentiment Stats
        $sentimentStats = [
            'total' => Booking::whereNotNull('sentiment')->count(),
            'very_satisfied' => Booking::where('sentiment', 4)->count(),
            'satisfied' => Booking::where('sentiment', 3)->count(),
            'neutral' => Booking::where('sentiment', 2)->count(),
            'not_satisfied' => Booking::where('sentiment', 1)->count(),
        ];

        return view('admin.reports', compact(
            'totalBookings', 
            'totalRevenue', 
            'maintenanceCount',
            'activeBookings',
            'completedBookings',
            'cancelledBookings',
            'realizedRevenue',
            'recentActivity',
            'chartLabels',
            'chartRevenue',
            'chartBookings',
            'sentimentStats'
        )); 
    }
    public function export()
    {
        $completedBookings = Booking::where('status', 'completed')
            ->with(['user', 'bike', 'payment'])
            ->orderBy('updated_at', 'asc')
            ->get();

        // Chart Data for Excel (Last 6 Months)
        $chartData = collect();
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthName = $date->format('M Y');
            
            $monthOrders = $completedBookings->filter(function($order) use ($date) {
                return $order->updated_at->format('Y-m') === $date->format('Y-m');
            });

            $chartData->push([
                'month' => $monthName,
                'bookings' => $monthOrders->count(),
                'revenue' => $monthOrders->sum(fn($o) => $o->payment ? $o->payment->amount : 0)
            ]);
        }
        
        // Reverse for Excel view to show newest first in table but chronologically in chart
        $completedBookings = $completedBookings->reverse();

        $filename = 'BikeMS_Completed_Orders_' . now()->format('Ymd_His') . '.xls';

        return response(view('admin.exports.completed_orders', compact('completedBookings', 'chartData')))
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    public function exportSentiments()
    {
        $reviews = Booking::whereNotNull('sentiment')
            ->with(['user', 'bike'])
            ->latest()
            ->get();
            
        $sentimentStats = [
            'very_satisfied' => $reviews->where('sentiment', 4)->count(),
            'satisfied' => $reviews->where('sentiment', 3)->count(),
            'neutral' => $reviews->where('sentiment', 2)->count(),
            'not_satisfied' => $reviews->where('sentiment', 1)->count(),
            'total' => $reviews->count()
        ];
        
        $filename = 'BikeMS_Sentiment_Report_' . now()->format('Ymd_His') . '.xls';

        return response(view('admin.exports.sentiment_report', compact('reviews', 'sentimentStats')))
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}
