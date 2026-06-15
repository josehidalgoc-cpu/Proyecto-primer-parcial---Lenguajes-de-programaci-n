@extends('layouts.plantilla')

@section('title', 'Editar Nota Segura')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Editar Nota Segura</h2>

    <form action="{{ route('secure-notes.update', $secureNote) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Título</label>
            <input type="text" name="title" value="{{ old('title', $secureNote->title) }}"
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none @error('title') border-red-500 @enderror">
            @error('title') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Contenido</label>
            <textarea name="content_encrypted" rows="8"
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none @error('content_encrypted') border-red-500 @enderror">{{ old('content_encrypted', $secureNote->content_encrypted) }}</textarea>
            @error('content_encrypted') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Carpeta (opcional)</label>
            <select name="folder_id"
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="">Sin carpeta</option>
                @foreach($folders as $folder)
                    <option value="{{ $folder->id }}" {{ old('folder_id', $identity->folder_id) == $folder->id ? 'selected' : '' }}></option>
                @endforeach
            </select>
        </div>


        <div class="flex gap-3 pt-2">
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                Actualizar
            </button>
            <a href="{{ route('secure-notes.index') }}" class="w-full text-center bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded transition duration-200">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection