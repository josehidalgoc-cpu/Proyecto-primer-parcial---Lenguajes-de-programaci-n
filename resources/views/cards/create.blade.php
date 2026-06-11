@extends('layouts.plantilla')

@section('title', 'Nueva Tarjeta')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Nueva Tarjeta</h2>

    <form action="{{ route('cards.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Titular</label>
            <input type="text" name="cardholder_name" value="{{ old('cardholder_name') }}"
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none @error('cardholder_name') border-red-500 @enderror"
                placeholder="Ej. Juan Pérez">
            @error('cardholder_name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Número de tarjeta</label>
            <input type="text" name="card_number_encrypted" value="{{ old('card_number_encrypted') }}"
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none @error('card_number_encrypted') border-red-500 @enderror"
                placeholder="1234 5678 9012 3456" maxlength="19">
            @error('card_number_encrypted') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Mes</label>
                <input type="text" name="expiry_month" value="{{ old('expiry_month') }}"
                    class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none @error('expiry_month') border-red-500 @enderror"
                    placeholder="01" maxlength="2">
                @error('expiry_month') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Año</label>
                <input type="text" name="expiry_year" value="{{ old('expiry_year') }}"
                    class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none @error('expiry_year') border-red-500 @enderror"
                    placeholder="2027" maxlength="4">
                @error('expiry_year') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">CVV</label>
                <input type="password" name="cvv_encrypted" value="{{ old('cvv_encrypted') }}"
                    class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="***" maxlength="4">
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Marca</label>
            <select name="brand" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="">— Seleccionar —</option>
                <option value="Visa" {{ old('brand') == 'Visa' ? 'selected' : '' }}>Visa</option>
                <option value="Mastercard" {{ old('brand') == 'Mastercard' ? 'selected' : '' }}>Mastercard</option>
                <option value="Amex" {{ old('brand') == 'Amex' ? 'selected' : '' }}>American Express</option>
                <option value="Discover" {{ old('brand') == 'Discover' ? 'selected' : '' }}>Discover</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Notas</label>
            <textarea name="notes" rows="3"
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
                placeholder="Opcional...">{{ old('notes') }}</textarea>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                Guardar
            </button>
            <a href="{{ route('cards.index') }}" class="w-full text-center bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded transition duration-200">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection