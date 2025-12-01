<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_reservations' => Reservation::count(),
            'pending' => Reservation::where('status', 'pending')->count(),
            'today' => Reservation::whereDate('date', today())->count(),
            'revenue_month' => Reservation::whereMonth('created_at', now()->month)
                ->where('status', 'completed')
                ->with('service')
                ->get()
                ->sum('service.price')
        ];

        $recentReservations = Reservation::with(['user', 'service'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentReservations'));
    }
}