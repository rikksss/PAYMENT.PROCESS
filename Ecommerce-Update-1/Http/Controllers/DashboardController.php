<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Visit;
use App\Models\User;

class DashboardController extends Controller
{
    public function content()
    {
        // Track visitor if they haven't been recorded today
        $this->trackVisitor();

        // Get real-time data
        $registeredUsers = User::count();
        $dailyVisitors = $this->getDailyVisitors();
        $newMessages = 8;
        $reviews = 25;

        // Get the daily visitors for the last 7 days
        $dailyVisitorsData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i)->toDateString();
            $dailyVisitorsData[] = Visit::whereDate('created_at', $date)->count();
        }

        // Sample data for purchase behavior and sales performance (Replace with actual logic)
        $purchaseBehaviorData = [78923];
        $salesPerformanceData = [98883];

        // For Purchase Behavior (replace with real logic for purchases)
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i)->toDateString();
            // Sample data (replace with actual data from database)
            $purchaseBehaviorData[] = rand(1, 10);  // Random data for example
            $salesPerformanceData[] = rand(100, 1000);  // Random data for example
        }

        return view('dashboard.content', compact('registeredUsers', 'dailyVisitors', 'newMessages', 'reviews', 'dailyVisitorsData', 'purchaseBehaviorData', 'salesPerformanceData'));
    }

    // Track daily visitor
    private function trackVisitor()
    {
        $today = now()->toDateString();  // Get today's date
        $visitorIP = request()->ip();   // Get the visitor's IP address

        // Check if the visitor has been recorded today
        if (!Visit::whereDate('created_at', $today)->where('ip', $visitorIP)->exists()) {
            // Store the visitor's IP address
            Visit::create([
                'ip' => $visitorIP,
            ]);
        }
    }

    // Get the number of visitors today
    private function getDailyVisitors()
    {
        return Visit::whereDate('created_at', today())->count();
    }
}