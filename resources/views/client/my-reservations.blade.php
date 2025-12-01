@extends('layouts.app')

@section('title', 'Mes Réservations')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">
        <i class="fas fa-calendar-check text-blue-600 mr-2"></i>Mes Réservations
    </h1>

    @if($reservations->isEmpty())
        <div class="bg-white rounded-lg shadow p-8 text-center">
            <i class="fas fa-calendar-times text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-600 text-lg mb-4">Vous n'avez pas encore de réservation</p>
            <a href="{{ route('reservation.create') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                <i class="fas fa-plus mr-2"></i>Créer une réservation
            </a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($reservations as $reservation)
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">
                                {{ $reservation->service->name }}
                            </h3>
                            
                            <div class="space-y-2 text-gray-600">
                                <p>
                                    <i class="fas fa-calendar text-blue-600 w-5"></i>
                                    {{ \Carbon\Carbon::parse($reservation->date)->isoFormat('dddd D MMMM YYYY') }}
                                </p>
                                <p>
                                    <i class="fas fa-clock text-blue-600 w-5"></i>
                                    {{ $reservation->time }}
                                </p>
                                <p>
                                    <i class="fas fa-money-bill text-blue-600 w-5"></i>
                                    {{ $reservation->service->price }} DT
                                </p>
                                <p>
                                    <i class="fas fa-hourglass-half text-blue-600 w-5"></i>
                                    {{ $reservation->service->duration }} minutes
                                </p>
                                
                                @if($reservation->notes)
                                    <p class="mt-3 p-3 bg-gray-50 rounded">
                                        <i class="fas fa-note-sticky text-blue-600"></i>
                                        <strong>Notes:</strong> {{ $reservation->notes }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="ml-4 text-right">
                            @if($reservation->status === 'pending')
                                <span class="inline-block bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold mb-3">
                                    <i class="fas fa-clock"></i> En attente
                                </span>
                            @elseif($reservation->status === 'confirmed')
                                <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold mb-3">
                                    <i class="fas fa-check"></i> Confirmée
                                </span>
                            @elseif($reservation->status === 'cancelled')
                                <span class="inline-block bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold mb-3">
                                    <i class="fas fa-times"></i> Annulée
                                </span>
                            @elseif($reservation->status === 'completed')
                                <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold mb-3">
                                    <i class="fas fa-check-double"></i> Terminée
                                </span>
                            @endif

                            @if(in_array($reservation->status, ['pending', 'confirmed']) && $reservation->date >= today())
                                <form method="POST" action="{{ route('reservation.cancel', $reservation->id) }}" 
                                      onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')">
                                    @csrf
                                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 text-sm">
                                        <i class="fas fa-times"></i> Annuler
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection