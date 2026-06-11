@extends('layouts.app')

@section('title', 'Crear Persona')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Registrar Nueva Persona</h2>

    <form action="{{ route('personas.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="nombre" class="block text-sm font-semibold text-gray-700 mb-1">Nombre Completo</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" 
                   class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none @error('nombre') border-red-500 @enderror" 
                   placeholder="Ej. Juan Pérez">
            @error('nombre') 
                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> 
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Correo Electrónico</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" 
                   class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none @error('email') border-red-500 @enderror" 
                   placeholder="juan.perez@uees.edu.ec">
            @error('email') 
                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> 
            @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Intereses / Hobbies</label>
            <div class="grid grid-cols-2 gap-3 bg-gray-50 p-4 rounded-md border">
                @foreach($intereses as $interes)
                    <label class="flex items-center space-x-3 cursor-pointer p-1 hover:bg-gray-100 rounded">
                        <input type="checkbox" name="intereses[]" value="{{ $interes->id }}" 
                               {{ in_array($interes->id, old('intereses', [])) ? 'checked' : '' }}
                               class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <span class="text-sm text-gray-600 font-medium">{{ $interes->nombre }}</span>
                    </label>
                @endforeach
            </div>
            @error('intereses') 
                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> 
            @enderror
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200 shadow">
                Guardar Persona
            </button>
        </div>
    </form>
</div>
@endsection