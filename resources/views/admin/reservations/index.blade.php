@extends('layouts.app')

@section('title', 'Gestion des Réservations')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-gray-800">
        <i class="fas fa-calendar-alt text-blue-600 mr-2"></i>Gestion des Réservations
    </h1>
    <a href="{{ route('admin.dashboard') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
        <i class="fas fa-arrow-left mr-2"></i>Retour
    </a>
</div>

<div class="bg-white rounded-lg shadow-lg p-6 mb-6">
    <form method="GET" class="grid md:grid-cols-3 gap-4">
        <div>
            <label class="block text-sm font-semibold mb-2">Statut</label>
            <select name="status" class="w-full px-4 py-2 border rounded-lg">
                <option value="">Tous les statuts</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>En attente</option>
                <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmée</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Annulée</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Terminée</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Date</label>
            <input type="date" name="date" value="{{ request('date') }}" class="w-full px-4 py-2 border rounded-lg">
        </div>

        <div class="flex items-end">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 w-full">
                <i class="fas fa-search mr-2"></i>Filtrer
            </button>
        </div>
    </form>
</div>

<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-3 text-left">ID</th>
                <th class="px-4 py-3 text-left">Client</th>
                <th class="px-4 py-3 text-left">Téléphone</th>
                <th class="px-4 py-3 text-left">Service</th>
                <th class="px-4 py-3 text-left">Date</th>
                <th class="px-4 py-3 text-left">Heure</th>
                <th class="px-4 py-3 text-left">Prix</th>
                <th class="px-4 py-3 text-left">Statut</th>
                <th class="px-4 py-3 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservations as $reservation)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3">#{{ $reservation->id }}</td>
                    <td class="px-4 py-3">{{ $reservation->user->name }}</td>
                    <td class="px-4 py-3">{{ $reservation->user->phone ?? 'N/A' }}</td>
                    <td class="px-4 py-3">{{ $reservation->service->name }}</td>
                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}</td>
                    <td class="px-4 py-3 font-semibold">{{ $reservation->time }}</td>
                    <td class="px-4 py-3 font-semibold text-green-600">{{ $reservation->service->price }} DT</td>
                    <td class="px-4 py-3">
                        <form method="POST" action="{{ route('admin.reservations.status', $reservation->id) }}" class="inline">
                            @csrf
                            <select name="status" onchange="this.form.submit()" class="px-2 py-1 rounded text-sm border-0
                                {{ $reservation->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $reservation->status === 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $reservation->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}
                                {{ $reservation->status === 'completed' ? 'bg-blue-100 text-blue-800' : '' }}">
                                <option value="pending" {{ $reservation->status === 'pending' ? 'selected' : '' }}>En attente</option>
                                <option value="confirmed" {{ $reservation->status === 'confirmed' ? 'selected' : '' }}>Confirmée</option>
                                <option value="completed" {{ $reservation->status === 'completed' ? 'selected' : '' }}>Terminée</option>
                                <option value="cancelled" {{ $reservation->status === 'cancelled' ? 'selected' : '' }}>Annulée</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-4 py-3">
                        <form method="POST" action="{{ route('admin.reservations.destroy', $reservation->id) }}" 
                              onsubmit="return confirm('Supprimer cette réservation ?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="px-4 py-8 text-center text-gray-500">
                        Aucune réservation trouvée
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $reservations->links() }}
</div>
@endsection