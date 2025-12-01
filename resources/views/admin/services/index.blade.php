@extends('layouts.app')

@section('title', 'Gestion des Services')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-3xl font-bold text-gray-800">
        <i class="fas fa-cut text-blue-600 mr-2"></i>Gestion des Services
    </h1>
    <div class="space-x-2">
        <a href="{{ route('admin.services.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            <i class="fas fa-plus mr-2"></i>Nouveau Service
        </a>
        <a href="{{ route('admin.dashboard') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
            <i class="fas fa-arrow-left mr-2"></i>Retour
        </a>
    </div>
</div>

<div class="grid md:grid-cols-2 gap-6">
    @foreach($services as $service)
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $service->name }}</h3>
                    <p class="text-gray-600 mt-2">{{ $service->description }}</p>
                </div>
                <span class="px-3 py-1 rounded-full text-sm {{ $service->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $service->is_active ? 'Actif' : 'Inactif' }}
                </span>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="bg-blue-50 p-3 rounded">
                    <p class="text-sm text-gray-600">Prix</p>
                    <p class="text-2xl font-bold text-blue-600">{{ $service->price }} DT</p>
                </div>
                <div class="bg-purple-50 p-3 rounded">
                    <p class="text-sm text-gray-600">Durée</p>
                    <p class="text-2xl font-bold text-purple-600">{{ $service->duration }} min</p>
                </div>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('admin.services.edit', $service->id) }}" class="flex-1 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-center">
                    <i class="fas fa-edit mr-2"></i>Modifier
                </a>
                <form method="POST" action="{{ route('admin.services.destroy', $service->id) }}" 
                      onsubmit="return confirm('Supprimer ce service ?')" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        <i class="fas fa-trash mr-2"></i>Supprimer
                    </button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection