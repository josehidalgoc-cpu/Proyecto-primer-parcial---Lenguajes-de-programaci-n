@extends('layouts.plantilla')

@section('title', 'Mis Identidades')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-800">Mis Identidades</h2>
        <a href="{{ route('identities.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200">
            + Nueva Identidad
        </a>
    </div>

    <form method="GET" action="{{ route('identities.index') }}" class="mb-6">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Buscar por título..."
            class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
    </form>

    @if($identities->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($identities as $identity)
                <div class="border border-gray-200 rounded-lg p-5 hover:shadow-lg transition duration-200 bg-gray-50 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-2xl">🪪</span>
                            <h3 class="font-bold text-gray-800 text-lg truncate">{{ $identity->title }}</h3>
                        </div>
                        <p class="text-sm text-gray-600 truncate">{{ $identity->full_name ?? 'Sin nombre' }}</p>
                        <p class="text-xs text-gray-400 truncate">{{ $identity->email ?? '' }}</p>
                    </div>
                    <div class="flex gap-2 mt-4">
                        <a href="{{ route('identities.show', $identity) }}"
                            class="flex-1 text-center bg-blue-600 hover:bg-blue-700 text-white py-1.5 px-3 rounded text-sm font-semibold transition">
                            Ver
                        </a>
                        <a href="{{ route('identities.edit', $identity) }}"
                            style="background-color: #facc15; color: #000;"
                            class="flex-1 text-center py-1.5 px-3 rounded text-sm font-semibold">
                            Editar
                        </a>
                        <form method="POST" action="{{ route('identities.destroy', $identity) }}"
                            onsubmit="return confirm('¿Eliminar esta identidad?')" class="flex-1">
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
            No tienes identidades guardadas aún.
        </div>
    @endif
</div>
@endsection