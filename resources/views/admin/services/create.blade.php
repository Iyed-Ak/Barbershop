@extends('layouts.app')

@section('title', 'Nouveau Service')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            <i class="fas fa-plus-circle text-green-600 mr-2"></i>Nouveau Service
        </h1>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-8">
        <form method="POST" action="{{ route('admin.services.store') }}">
            @csrf

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Nom du Service *</label>
                <input type="text" name="name" required value="{{ old('name') }}" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Description</label>
                <textarea name="description" rows="3" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
            </div>

            <div class="grid md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Prix (DT) *</label>
                    <input type="number" name="price" step="0.01" min="0" required value="{{ old('price') }}" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Durée (minutes) *</label>
                    <input type="number" name="duration" min="15" step="15" required value="{{ old('duration', 30) }}" 
                           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" checked class="mr-2">
                    <span class="text-gray-700 font-bold">Service actif</span>
                </label>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-green-600 text-white py-3 rounded-lg font-bold hover:bg-green-700">
                    <i class="fas fa-save mr-2"></i>Créer le Service
                </button>
                <a href="{{ route('admin.services.index') }}" class="flex-1 bg-gray-600 text-white py-3 rounded-lg font-bold hover:bg-gray-700 text-center">
                    <i class="fas fa-times mr-2"></i>Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection