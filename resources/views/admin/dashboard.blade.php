@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">
        <i class="fas fa-tachometer-alt text-blue-600 mr-2"></i>Tableau de Bord Admin
    </h1>
</div>

<div class="grid md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Total Réservations</p>
                <p class="text-3xl font-bold text-blue-600">{{ $stats['total_reservations'] }}</p>
            </div>
            <i class="fas fa-calendar-alt text-4xl text-blue-200"></i>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">En Attente</p>
                <p class="text-3xl font-bold text-yellow-600">{{ $stats['pending'] }}</p>
            </div>
            <i class="fas fa-clock text-4xl text-yellow-200"></i>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Aujourd'hui</p>
                <p class="text-3xl font-bold text-green-600">{{ $stats['today'] }}</p>
            </div>
            <i class="fas fa-calendar-day text-4xl text-green-200"></i>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm">Revenu du Mois</p>
                <p class="text-3xl font-bold text-purple-600">{{ number_format($stats['revenue_month'], 2) }} DT</p>
            </div>
            <i class="fas fa-money-bill-wave text-4xl text-purple-200"></i>
        </div>
    </div>
</div>

<div class="grid md:grid-cols-2 gap-6 mb-8">
    <a href="{{ route('admin.reservations.index') }}" class="bg-blue-600 text-white rounded-lg shadow-lg p-8 hover:bg-blue-700 transition text-center">
        <i class="fas fa-calendar-check text-6xl mb-4"></i>
        <h3 class="text-2xl font-bold">Gérer les Réservations</h3>
    </a>

    <a href="{{ route('admin.services.index') }}" class="bg-green-600 text-white rounded-lg shadow-lg p-8 hover:bg-green-700 transition text-center">
        <i class="fas fa-cut text-6xl mb-4"></i>
        <h3 class="text-2xl font-bold">Gérer les Services</h3>
    </a>
</div>

<div class="bg-white rounded-lg shadow-lg p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">
        <i class="fas fa-history text-blue-600 mr-2"></i>Réservations Récentes
    </h2>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left">Client</th>
                    <th class="px-4 py-3 text-left">Service</th>
                    <th class="px-4 py-3 text-left">Date</th>
                    <th class="px-4 py-3 text-left">Heure</th>
                    <th class="px-4 py-3 text-left">Statut</th>
                    <th class="px-4 py-3 text-left">Prix</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentReservations as $reservation)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $reservation->user->name }}</td>
                        <td class="px-4 py-3">{{ $reservation->service->name }}</td>
                        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}</td>
                        <td class="px-4 py-3">{{ $reservation->time }}</td>
                        <td class="px-4 py-3">
                            @if($reservation->status === 'pending')
                                <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-sm">En attente</span>
                            @elseif($reservation->status === 'confirmed')
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">Confirmée</span>
                            @elseif($reservation->status === 'cancelled')
                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-sm">Annulée</span>
                            @else
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">Terminée</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 font-semibold">{{ $reservation->service->price }} DT</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection