@extends('layouts.plantilla')

@section('title', 'Actualiza tu Plan')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch">
        
        {{-- COLUMNA IZQUIERDA: Tarjeta de Plan (Estilo Flowbite Calcado) --}}
        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm flex flex-col justify-between">
            <div>
                <h5 class="text-xl font-normal text-gray-900 tracking-tight mb-3">Plan Premium</h5>
                
                <div class="flex items-baseline text-gray-900 mb-6">
                    <span class="text-5xl font-extrabold tracking-tight">$4.99</span>
                    <span class="ms-1 text-gray-500 text-lg">/lifetime</span>
                </div>
                
                <ul role="list" class="space-y-4 list-none p-0 m-0">
                    
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 shrink-0 text-blue-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <span class="text-base font-normal text-gray-600">Logins e historial ilimitados</span>
                    </li>
                    
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 shrink-0 text-blue-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                        <span class="text-base font-normal text-gray-600">Tarjetas de crédito ilimitadas</span>
                    </li>
                    
                    <li class="flex items-center gap-3">
                        <span class="text-base font-normal text-gray-600">Mantén tus contraseñas y tarjetas seguras, sin restricciones. Un solo pago, acceso de por vida.+</span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- COLUMNA DERECHA: Formulario de Facturación --}}
        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm flex flex-col justify-between">
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-5 pb-2 border-b border-gray-100">Datos de pago</h3>

                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-2.5 rounded-xl mb-4 text-xs">
                        <ul class="list-disc list-inside space-y-0.5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('upgrade.activate') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Titular de la tarjeta</label>
                        <input type="text" name="cardholder_name" value="{{ old('cardholder_name') }}" required
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:outline-none transition-colors text-gray-900"
                            placeholder="Juan Pérez">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Número de tarjeta</label>
                        <input type="text" name="card_number" value="{{ old('card_number') }}" required inputmode="numeric" pattern="[0-9]*"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:outline-none transition-colors text-gray-900 tracking-wide"
                            placeholder="1234 5678 9012 3456" maxlength="16">
                    </div>

                    <div class="grid grid-cols-3 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Mes</label>
                            <input type="text" name="expiry_month" value="{{ old('expiry_month') }}" required inputmode="numeric" pattern="[0-9]*"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm text-center focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:outline-none transition-colors text-gray-900"
                                placeholder="MM" maxlength="2">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">Año</label>
                            <input type="text" name="expiry_year" value="{{ old('expiry_year') }}" required inputmode="numeric" pattern="[0-9]*"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm text-center focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:outline-none transition-colors text-gray-900"
                                placeholder="YYYY" maxlength="4">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">CVV</label>
                            <input type="password" name="cvv" value="{{ old('cvv') }}" required inputmode="numeric" pattern="[0-9]*"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm text-center focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:outline-none transition-colors text-gray-900 tracking-widest"
                                placeholder="***" maxlength="4">
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-4 rounded-xl text-sm transition-colors duration-200 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500/40">
                            Pagar $4.99 una sola vez!
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
