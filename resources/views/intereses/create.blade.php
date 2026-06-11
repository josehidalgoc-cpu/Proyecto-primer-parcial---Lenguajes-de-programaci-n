@extends('layouts.app')

@section('title', 'Crear Interés')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Registrar Nuevo Interés</h2>

    <form action="{{ route('intereses.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="nombre" class="block text-sm font-semibold text-gray-700 mb-1">Nombre del Interés</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" 
                   class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none @error('nombre') border-red-500 @enderror" 
                   placeholder="Ej. Programación, Deportes, Música">
            @error('nombre') 
                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> 
            @enderror
        </div>

        <div>
            <label for="descripcion" class="block text-sm font-semibold text-gray-700 mb-1">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="4" 
                      class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none @error('descripcion') border-red-500 @enderror" 
                      placeholder="Breve descripción de qué trata este interés (Opcional)...">{{ old('descripcion') }}</textarea>
            @error('descripcion') 
                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> 
            @enderror
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200 shadow">
                Guardar Interés
            </button>
        </div>
    </form>
</div>
@endsection