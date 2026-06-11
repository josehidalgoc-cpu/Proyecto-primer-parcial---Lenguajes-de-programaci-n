@extends('layouts.plantilla')

@section('title', 'Mis Tarjetas')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-800">Mis Tarjetas</h2>
        <a href="{{ route('cards.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200">
            + Nueva Tarjeta
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($cards as $card)
            <div class="bg-gradient-to-br from-slate-700 to-slate-900 text-white p-6 rounded-xl shadow-lg">
                <div class="flex justify-between items-start mb-6">
                    <span class="text-sm font-semibold tracking-widest uppercase text-slate-300">{{ $card->brand ?? 'Tarjeta' }}</span>
                </div>
                <div class="text-lg font-mono tracking-widest mb-4">
                    **** **** **** {{ substr($card->card_number_encrypted, -4) }}
                </div>
                <div class="flex justify-between items-end">
                    <div>
                        <p class="text-xs text-slate-400">Titular</p>
                        <p class="font-semibold">{{ $card->cardholder_name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400">Vence</p>
                        <p class="font-semibold">{{ $card->expiry_month }}/{{ $card->expiry_year }}</p>
                    </div>
                </div>
                <div class="flex gap-2 mt-4">
                    <a href="{{ route('cards.edit', $card) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white py-1 px-3 rounded text-xs">Editar</a>
                    <form method="POST" action="{{ route('cards.destroy', $card) }}" onsubmit="return confirm('¿Eliminar esta tarjeta?')">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 hover:bg-red-600 text-white py-1 px-3 rounded text-xs">Eliminar</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center text-gray-400 py-8">No tienes tarjetas guardadas aún.</div>
        @endforelse
    </div>
</div>
@endsection