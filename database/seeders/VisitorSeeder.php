<?php

namespace Database\Seeders;

use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class VisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Visitor::truncate();
        
        $months = 6;
        $now = Carbon::now();
        
        for ($i = $months - 1; $i >= 0; $i--) {
            $monthDate = $now->copy()->subMonthsNoOverflow($i);
            $daysInMonth = $monthDate->daysInMonth;
            
            // Random base visitors for this month between 500 and 1500
            $baseVisitors = rand(500, 1500);
            
            for ($day = 1; $day <= $daysInMonth; $day++) {
                $date = $monthDate->copy()->day($day);
                // Random visitors for the day
                $dailyVisitors = rand(10, 80);
                
                // We create a summary entry per day to avoid thousands of rows
                Visitor::create([
                    'ip_address' => '127.0.0.' . rand(1, 255), // Dummy IP
                    'user_agent' => 'Mozilla/5.0 Seeder',
                    'visited_date' => $date->format('Y-m-d'),
                    'views' => $dailyVisitors,
                ]);
            }
        }
    }
}
