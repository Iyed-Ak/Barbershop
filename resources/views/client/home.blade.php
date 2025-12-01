@extends('layouts.app')

@section('title', 'Accueil - Salon de Coiffure')

@section('content')
<div class="text-center mb-12">
    <h1 class="text-5xl font-bold text-gray-800 mb-4">Bienvenue dans Notre Salon</h1>
    <p class="text-xl text-gray-600">Coiffure professionnelle pour hommes</p>
    
    @auth
        <a href="{{ route('reservation.create') }}" class="inline-block mt-6 bg-blue-600 text-white px-8 py-3 rounded-lg text-lg hover:bg-blue-700">
            <i class="fas fa-calendar-plus mr-2"></i>Prendre Rendez-vous
        </a>
    @else
        <a href="{{ route('register') }}" class="inline-block mt-6 bg-blue-600 text-white px-8 py-3 rounded-lg text-lg hover:bg-blue-700">
            <i class="fas fa-user-plus mr-2"></i>S'inscrire pour Réserver
        </a>
    @endauth
</div>

<div class="grid md:grid-cols-3 gap-6">
    @foreach($services as $service)
        <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition">
            <div class="text-center mb-4">
                <i class="fas fa-cut text-5xl text-blue-600"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $service->name }}</h3>
            <p class="text-gray-600 mb-4">{{ $service->description }}</p>
            <div class="flex justify-between items-center">
                <span class="text-3xl font-bold text-blue-600">{{ $service->price }} DT</span>
                <span class="text-gray-500">
                    <i class="fas fa-clock mr-1"></i>{{ $service->duration }} min
                </span>
            </div>
        </div>
    @endforeach
</div>

<div class="mt-16 bg-blue-50 rounded-lg p-8">
    <h2 class="text-3xl font-bold text-center mb-8">Horaires d'Ouverture</h2>
    <div class="grid md:grid-cols-2 gap-6 max-w-3xl mx-auto">
        <div class="bg-white rounded-lg p-6 shadow">
            <h3 class="font-bold text-xl mb-3">Mardi - Dimanche</h3>
            <p class="text-gray-700">
                <i class="fas fa-clock text-blue-600 mr-2"></i>9h00 - 12h00<br>
                <i class="fas fa-clock text-blue-600 mr-2"></i>14h00 - 19h00
            </p>
        </div>
        <div class="bg-red-100 rounded-lg p-6 shadow">
            <h3 class="font-bold text-xl mb-3 text-red-700">Lundi</h3>
            <p class="text-red-600">
                <i class="fas fa-times-circle mr-2"></i>Fermé
            </p>
        </div>
    </div>
</div>
@endsection