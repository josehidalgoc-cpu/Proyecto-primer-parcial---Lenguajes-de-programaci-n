@extends('layouts.plantilla')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">

    {{-- Cabecera de bienvenida (más equilibrada) --}}
    <div class="bg-gradient-to-r from-slate-900 to-slate-700 p-8 rounded-lg shadow-md text-white">
        <h2 class="text-3xl font-bold">¡Bienvenido, {{ Auth::user()->name }}!</h2>
        <p class="text-slate-300 mt-2">Este es el panel de control de tu bóveda segura KeyVault. Aquí tienes el resumen de tus elementos protegidos.</p>
    </div>

    {{-- Tarjetas de estadísticas --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <a href="{{ route('logins.index') }}" class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4 border border-gray-100 hover:shadow-lg hover:border-blue-300 transition duration-200">
            <div class="p-3 bg-blue-100 text-blue-600 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Logins</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalLogins }}</p>
            </div>
        </a>

        <a href="{{ route('cards.index') }}" class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4 border border-gray-100 hover:shadow-lg hover:border-green-300 transition duration-200">
            <div class="p-3 bg-green-100 text-green-600 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Tarjetas</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalCards }}</p>
            </div>
        </a>

        <a href="{{ route('secure-notes.index') }}" class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4 border border-gray-100 hover:shadow-lg hover:border-yellow-300 transition duration-200">
            <div class="p-3 bg-yellow-100 text-yellow-600 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Notas</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalNotes }}</p>
            </div>
        </a>

        <a href="{{ route('identities.index') }}" class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4 border border-gray-100 hover:shadow-lg hover:border-purple-300 transition duration-200">
            <div class="p-3 bg-purple-100 text-purple-600 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Identidades</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalIdentities }}</p>
            </div>
        </a>

    </div>

    {{-- Actividad reciente --}}
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-3">Actividad reciente</h3>

        @if($recentActivity->count())
            <ul class="divide-y divide-gray-100">
                @foreach($recentActivity as $item)
                    <li>
                        <a href="{{ route($item['route']) }}" class="flex items-center justify-between py-3 px-2 hover:bg-gray-50 rounded transition">
                            <div class="flex items-center gap-3">
                                <span class="inline-block px-2.5 py-0.5 text-xs font-semibold rounded-full
                                    @if($item['type'] === 'Login') bg-blue-100 text-blue-700
                                    @elseif($item['type'] === 'Tarjeta') bg-green-100 text-green-700
                                    @elseif($item['type'] === 'Nota') bg-yellow-100 text-yellow-700
                                    @else bg-purple-100 text-purple-700 @endif">
                                    {{ $item['type'] }}
                                </span>
                                <span class="text-gray-800 font-medium">{{ $item['title'] }}</span>
                            </div>
                            <span class="text-xs text-gray-400">{{ $item['date']->diffForHumans() }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="text-center text-gray-400 py-8">
                Aún no tienes actividad. Empieza agregando un login, una tarjeta, una nota o una identidad.
            </div>
        @endif
    </div>

</div>
@endsection