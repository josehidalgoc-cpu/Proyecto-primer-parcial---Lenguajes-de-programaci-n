@extends('layouts.plantilla')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-blue-600">
        <h2 class="text-2xl font-bold text-gray-800">¡Bienvenido, {{ Auth::user()->name }}!</h2>
        <p class="text-sm text-gray-600 mt-1">Panel de control del sistema EjemploSeg</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4 border border-gray-100">
            <div class="p-3 bg-blue-100 text-blue-600 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total de Personas</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalPersonas }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4 border border-gray-100">
            <div class="p-3 bg-green-100 text-green-600 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M6 20n4 4V10H4m14-4h.01M20 20v-4h-4"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total de Intereses</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalIntereses }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md flex items-center space-x-4 border border-gray-100">
            <div class="p-3 bg-purple-100 text-purple-600 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Usuarios Registrados</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalUsuarios }}</p>
            </div>
        </div>

    </div>
</div>
@endsection