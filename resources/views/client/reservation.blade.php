@extends('layouts.app')

@section('title', 'Réserver un Rendez-vous')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-lg p-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">
        <i class="fas fa-calendar-plus text-blue-600 mr-2"></i>Nouvelle Réservation
    </h1>

    <form method="POST" action="{{ route('reservation.store') }}" id="reservationForm">
        @csrf

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Service</label>
            <select name="service_id" id="service_id" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Choisir un service</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}" data-price="{{ $service->price }}" data-duration="{{ $service->duration }}">
                        {{ $service->name }} - {{ $service->price }} DT ({{ $service->duration }} min)
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Date</label>
            <input type="date" name="date" id="date" required min="{{ date('Y-m-d') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <p class="text-sm text-red-600 mt-1">
                <i class="fas fa-info-circle"></i> Fermé le lundi
            </p>
        </div>

        <div class="mb-6" id="timeSlotsContainer" style="display: none;">
            <label class="block text-gray-700 font-bold mb-2">Heure disponible</label>
            <select name="time" id="time" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Sélectionner une heure</option>
            </select>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Notes (optionnel)</label>
            <textarea name="notes" rows="3" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Demandes spéciales..."></textarea>
        </div>

        <div id="priceDisplay" class="bg-blue-50 p-4 rounded-lg mb-6" style="display: none;">
            <div class="flex justify-between items-center">
                <span class="font-bold text-lg">Prix total:</span>
                <span class="text-3xl font-bold text-blue-600" id="totalPrice">0 DT</span>
            </div>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold hover:bg-blue-700 transition">
            <i class="fas fa-check mr-2"></i>Confirmer la Réservation
        </button>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const serviceSelect = document.getElementById('service_id');
    const dateInput = document.getElementById('date');
    const timeSelect = document.getElementById('time');
    const timeSlotsContainer = document.getElementById('timeSlotsContainer');
    const priceDisplay = document.getElementById('priceDisplay');
    const totalPriceSpan = document.getElementById('totalPrice');

    // Bloquer les lundis
    dateInput.addEventListener('input', function() {
        const selectedDate = new Date(this.value);
        if (selectedDate.getDay() === 1) {
            alert('Le salon est fermé le lundi. Veuillez choisir un autre jour.');
            this.value = '';
        }
    });

    // Afficher le prix
    serviceSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const price = selectedOption.dataset.price;
        
        if (price) {
            totalPriceSpan.textContent = price + ' DT';
            priceDisplay.style.display = 'block';
        } else {
            priceDisplay.style.display = 'none';
        }
        
        loadTimeSlots();
    });

    dateInput.addEventListener('change', loadTimeSlots);

    function loadTimeSlots() {
        const serviceId = serviceSelect.value;
        const date = dateInput.value;

        if (!serviceId || !date) return;

        fetch(`{{ route('reservation.slots') }}?service_id=${serviceId}&date=${date}`)
            .then(response => response.json())
            .then(slots => {
                timeSelect.innerHTML = '<option value="">Sélectionner une heure</option>';
                
                if (slots.length === 0) {
                    timeSelect.innerHTML = '<option value="">Aucun créneau disponible</option>';
                    timeSlotsContainer.style.display = 'block';
                    return;
                }

                slots.forEach(slot => {
                    const option = document.createElement('option');
                    option.value = slot;
                    option.textContent = slot;
                    timeSelect.appendChild(option);
                });

                timeSlotsContainer.style.display = 'block';
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Erreur lors du chargement des créneaux');
            });
    }
});
</script>
@endpush
@endsection