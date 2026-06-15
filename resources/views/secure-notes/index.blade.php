@extends('layouts.plantilla')

@section('title', 'Mis Notas Seguras')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-800">Mis Notas Seguras</h2>
        <a href="{{ route('secure-notes.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200">
            + Nueva Nota
        </a>
    </div>

    <form method="GET" action="{{ route('secure-notes.index') }}" class="mb-6">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Buscar por título..."
            class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
    </form>

    @if($secureNotes->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($secureNotes as $note)
                <div class="border border-gray-200 rounded-lg p-5 hover:shadow-lg transition duration-200 bg-gray-50 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-2xl">🗒️</span>
                            <h3 class="font-bold text-gray-800 text-lg truncate">{{ $note->title }}</h3>
                        </div>
                        <p class="text-sm text-gray-400 italic mb-4">Contenido protegido — pulsa "Ver" para mostrar.</p>
                        @if($note->folder)
                            <span class="inline-block mt-2 text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full">
                                📁 {{ $note->folder->name }}
                            </span>
                        @endif
                    </div>
                    <div class="flex gap-2 mt-2">
                        <a href="{{ route('secure-notes.show', $note) }}"
                            class="flex-1 text-center bg-blue-600 hover:bg-blue-700 text-white py-1.5 px-3 rounded text-sm font-semibold transition">
                            Ver
                        </a>
                        <a href="{{ route('secure-notes.edit', $note) }}"
                            style="background-color: #facc15; color: #000;"
                            class="flex-1 text-center py-1.5 px-3 rounded text-sm font-semibold">
                            Editar
                        </a>
                        <form method="POST" action="{{ route('secure-notes.destroy', $note) }}"
                            onsubmit="return confirm('¿Eliminar esta nota?')" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button style="background-color: #ef4444; color: #fff;"
                                class="w-full py-1.5 px-3 rounded text-sm font-semibold">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center text-gray-400 py-12">
            No tienes notas seguras aún.
        </div>
    @endif
</div>
@endsection