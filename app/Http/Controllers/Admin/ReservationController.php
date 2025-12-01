<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservation::with(['user', 'service']);

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->date) {
            $query->whereDate('date', $request->date);
        }

        $reservations = $query->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->paginate(20);

        return view('admin.reservations.index', compact('reservations'));
    }

    public function updateStatus(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed'
        ]);

        $reservation->update($validated);

        return back()->with('success', 'Statut mis à jour');
    }

    public function destroy($id)
    {
        Reservation::findOrFail($id)->delete();
        return back()->with('success', 'Réservation supprimée');
    }
}