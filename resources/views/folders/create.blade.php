@extends('layouts.plantilla')

@section('title', 'Nueva Carpeta')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Nueva Carpeta</h2>

    <form action="{{ route('folders.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Nombre</label>
            <input type="text" name="name" value="{{ old('name') }}"
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none @error('name') border-red-500 @enderror"
                placeholder="Ej. Netflix, Banco Pichincha...">
            @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                Crear
            </button>
            <a href="{{ route('folders.index') }}" class="w-full text-center bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded transition duration-200">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection