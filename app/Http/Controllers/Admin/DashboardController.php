<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'unread_messages' => \App\Models\ContactSubmission::where('is_read', false)->count(),
            'total_messages' => \App\Models\ContactSubmission::count(),
            'total_products' => \App\Models\Product::count(),
            'total_services' => \App\Models\Service::count(),
            'total_testimonials' => \App\Models\Testimonial::count(),
        ];
        
        $recentMessages = \App\Models\ContactSubmission::latest()->take(5)->get();
        
        // Interaction Stats logic (Orders + Messages)
        $interactionStats = [];
        $maxInteractions = 0;
        
        for ($i = 5; $i >= 0; $i--) {
            $month = \Carbon\Carbon::now()->subMonthsNoOverflow($i);
            
            $orders = \App\Models\Order::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
                
            $messages = \App\Models\ContactSubmission::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
                
            $total = $orders + $messages;
                
            if ($total > $maxInteractions) {
                $maxInteractions = $total;
            }
                
            $interactionStats[] = [
                'month_name' => $month->format('M'),
                'total' => $total,
                'display' => $total >= 1000000 ? round($total / 1000000, 1) . 'M' : ($total >= 1000 ? round($total / 1000, 1) . 'k' : $total),
            ];
        }
        
        // Add 20% headroom to max interactions for chart scale
        $maxChartVal = $maxInteractions > 0 ? ceil($maxInteractions * 1.2) : 5;
        
        // Ensure maxChartVal is a multiple of 5 so the 5 steps are always integers
        $maxChartVal = max(5, ceil($maxChartVal / 5) * 5);
        
        foreach ($interactionStats as &$stat) {
            // Guarantee min height of 5% for visibility if total > 0
            $stat['height_percent'] = $stat['total'] > 0 ? max(5, min(100, round(($stat['total'] / $maxChartVal) * 100))) : 0;
            
            // Color variation logic based on height
            if ($stat['height_percent'] < 30) $stat['color'] = 'bg-primary/30';
            elseif ($stat['height_percent'] < 50) $stat['color'] = 'bg-primary/50';
            elseif ($stat['height_percent'] < 75) $stat['color'] = 'bg-primary/75';
            else $stat['color'] = 'bg-primary';
        }
        
        $yAxisLabels = [];
        for ($i = 5; $i >= 0; $i--) {
            $val = ($maxChartVal / 5) * $i;
            $yAxisLabels[] = $val >= 1000000 ? round($val / 1000000, 1) . 'M' : ($val >= 1000 ? round($val / 1000, 1) . 'k' : round($val));
        }
        
        // System Status Logic
        try {
            \Illuminate\Support\Facades\DB::connection()->getPdo();
            $systemStatus = [
                'message' => 'All Systems Operational',
                'indicator' => 'bg-[#10b981]',
                'environment' => ucfirst(app()->environment()) . ' Environment'
            ];
        } catch (\Exception $e) {
            $systemStatus = [
                'message' => 'Database Connection Error',
                'indicator' => 'bg-error',
                'environment' => 'System Degraded'
            ];
        }
        
        return view('admin.pages.dashboard', compact('stats', 'recentMessages', 'interactionStats', 'yAxisLabels', 'systemStatus'));
    }
}
