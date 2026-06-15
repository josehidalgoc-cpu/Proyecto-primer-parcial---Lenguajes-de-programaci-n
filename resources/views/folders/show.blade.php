@extends('layouts.plantilla')

@section('title', $folder->name)

@section('content')
<div class="space-y-6">
    <div class="bg-white p-6 rounded-lg shadow-md flex justify-between items-center">
        <div class="flex items-center gap-3">
            <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
            <h2 class="text-2xl font-bold text-gray-800">{{ $folder->name }}</h2>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('folders.edit', $folder) }}" style="background-color: #facc15; color: #000;" class="py-2 px-4 rounded font-semibold text-sm">Editar</a>
            <form method="POST" action="{{ route('folders.destroy', $folder) }}" onsubmit="return confirm('¿Eliminar esta carpeta? Los items que contiene NO se borrarán, solo se desagruparán.')">
                @csrf
                @method('DELETE')
                <button style="background-color: #ef4444; color: #fff;" class="py-2 px-4 rounded font-semibold text-sm">Eliminar</button>
            </form>
            <a href="{{ route('folders.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 px-4 rounded font-semibold text-sm">← Volver</a>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="font-bold text-gray-700 mb-3 flex items-center gap-2">
            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
            Tarjetas
        </h3>
        @if($folder->cards->count())
            <ul class="divide-y divide-gray-100">
                @foreach($folder->cards as $card)
                    <li class="py-2">
                        <a href="{{ route('cards.edit', $card) }}" class="text-blue-600 hover:underline">
                            {{ $card->cardholder_name }} @if($card->brand)({{ $card->brand }})@endif
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-sm text-gray-400">No hay tarjetas en esta carpeta.</p>
        @endif
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="font-bold text-gray-700 mb-3 flex items-center gap-2">
            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
            Inicios de Sesión
        </h3>
        @if($folder->logins->count())
            <ul class="divide-y divide-gray-100">
                @foreach($folder->logins as $login)
                    <li class="py-2">
                        <a href="{{ route('logins.edit', $login) }}" class="text-blue-600 hover:underline">{{ $login->title }}</a>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-sm text-gray-400">No hay logins en esta carpeta.</p>
        @endif
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="font-bold text-gray-700 mb-3 flex items-center gap-2">
            <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            Identidades
        </h3>
        @if($folder->identities->count())
            <ul class="divide-y divide-gray-100">
                @foreach($folder->identities as $identity)
                    <li class="py-2">
                        <a href="{{ route('identities.show', $identity) }}" class="text-blue-600 hover:underline">{{ $identity->title }}</a>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-sm text-gray-400">No hay identidades en esta carpeta.</p>
        @endif
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="font-bold text-gray-700 mb-3 flex items-center gap-2">
            <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            Notas Seguras
        </h3>
        @if($folder->secureNotes->count())
            <ul class="divide-y divide-gray-100">
                @foreach($folder->secureNotes as $note)
                    <li class="py-2">
                        <a href="{{ route('secure-notes.show', $note) }}" class="text-blue-600 hover:underline">{{ $note->title }}</a>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-sm text-gray-400">No hay notas en esta carpeta.</p>
        @endif
    </div>

</div>
@endsection