@extends('layouts.plantilla')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-blue-600">
        <h2 class="text-2xl font-bold text-gray-800">¡Bienvenido, {{ Auth::user()->name }}!</h2>
        <p class="text-sm text-gray-600 mt-1">Panel de control de tu Gestor de Credenciales</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4 border border-gray-100">
            <div class="p-3 bg-blue-100 text-blue-600 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Logins Guardados</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalLogins }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4 border border-gray-100">
            <div class="p-3 bg-green-100 text-green-600 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Tarjetas Seguras</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalCards }}</p>
            </div>
        </div>

    </div>
</div>
@endsection