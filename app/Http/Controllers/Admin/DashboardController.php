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
        
        // Visitor Stats logic
        $visitorStats = [];
        $maxVisitors = 0;
        
        for ($i = 5; $i >= 0; $i--) {
            $month = \Carbon\Carbon::now()->subMonthsNoOverflow($i);
            
            $views = \App\Models\Visitor::whereYear('visited_date', $month->year)
                ->whereMonth('visited_date', $month->month)
                ->sum('views');
                
            if ($views > $maxVisitors) {
                $maxVisitors = $views;
            }
                
            $visitorStats[] = [
                'month_name' => $month->format('M'),
                'views' => $views,
                'display' => $views >= 1000000 ? round($views / 1000000, 1) . 'M' : ($views >= 1000 ? round($views / 1000, 1) . 'k' : $views),
            ];
        }
        
        // Add 20% headroom to max visitors for chart scale
        $maxChartVal = $maxVisitors > 0 ? ceil($maxVisitors * 1.2) : 100;
        
        // Ensure maxChartVal is a clean number like 100, 500, 1000
        $magnitude = pow(10, floor(log10($maxChartVal)));
        $maxChartVal = ceil($maxChartVal / $magnitude) * $magnitude;
        if ($maxChartVal == 0) $maxChartVal = 100;
        
        foreach ($visitorStats as &$stat) {
            // Guarantee min height of 5% for visibility if views > 0
            $stat['height_percent'] = $stat['views'] > 0 ? max(5, min(100, round(($stat['views'] / $maxChartVal) * 100))) : 0;
            
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
        
        return view('admin.pages.dashboard', compact('stats', 'recentMessages', 'visitorStats', 'yAxisLabels', 'systemStatus'));
    }
}
