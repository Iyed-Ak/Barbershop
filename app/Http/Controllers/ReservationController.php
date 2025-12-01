<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservationController extends Controller
{
    // 👇 SUPPRIMER LE __construct
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function create()
    {
        $services = Service::where('is_active', true)->get();
        return view('client.reservation', compact('services'));
    }

    public function getAvailableSlots(Request $request)
    {
        $slots = Reservation::getAvailableSlots(
            $request->date,
            $request->service_id
        );

        return response()->json($slots);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'notes' => 'nullable|string|max:500'
        ]);

        // Vérifier que ce n'est pas lundi
        if (Carbon::parse($validated['date'])->dayOfWeek === 1) {
            return back()->withErrors(['date' => 'Fermé le lundi']);
        }

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        Reservation::create($validated);

        return redirect()->route('reservations.my')
            ->with('success', 'Réservation créée avec succès!');
    }

    public function myReservations()
    {
        $reservations = Reservation::with('service')
            ->where('user_id', Auth::id())
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->get();

        return view('client.my-reservations', compact('reservations'));
    }

    public function cancel($id)
    {
        $reservation = Reservation::where('user_id', Auth::id())
            ->findOrFail($id);

        if ($reservation->status === 'pending' || $reservation->status === 'confirmed') {
            $reservation->update(['status' => 'cancelled']);
            return back()->with('success', 'Réservation annulée');
        }

        return back()->withErrors(['error' => 'Impossible d\'annuler cette réservation']);
    }
}