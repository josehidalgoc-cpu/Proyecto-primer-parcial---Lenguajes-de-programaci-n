@extends('layouts.plantilla')

@section('title', 'Mis Carpetas')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-800">Mis Carpetas</h2>
        <a href="{{ route('folders.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200">
            + Nueva Carpeta
        </a>
    </div>

    @if($folders->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($folders as $folder)
                @php $total = $folder->identities_count + $folder->secure_notes_count + $folder->cards_count + $folder->logins_count; @endphp
                <a href="{{ route('folders.show', $folder) }}" class="border border-gray-200 rounded-lg p-5 hover:shadow-lg hover:border-blue-300 transition duration-200 bg-gray-50 block">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                        <h3 class="font-bold text-gray-800 text-lg truncate">{{ $folder->name }}</h3>
                    </div>
                    <p class="text-sm text-gray-500">
                        {{ $total }} {{ $total === 1 ? 'elemento' : 'elementos' }}
                    </p>
                </a>
            @endforeach
        </div>
    @else
        <div class="text-center text-gray-400 py-12">
            No tienes carpetas aún. Crea una para agrupar tus credenciales por servicio (ej. "Netflix", "Banco").
        </div>
    @endif
</div>
@endsection