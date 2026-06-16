@extends('layouts.plantilla')

@section('title', 'Editar Tarjeta')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Editar Tarjeta</h2>

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cards.update', $card) }}" method="POST" class="space-y-6" id="card-form">
        @csrf
        @method('PUT')

        {{-- Titular --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Titular</label>
            <input type="text" name="cardholder_name" value="{{ old('cardholder_name', $card->cardholder_name) }}"
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none @error('cardholder_name') border-red-500 @enderror"
                placeholder="Ej. Juan Pérez">
            @error('cardholder_name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        {{-- Número de tarjeta --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Número de tarjeta</label>
            <input type="text" name="card_number_encrypted" id="card_number"
                value="{{ old('card_number_encrypted', $card->card_number_encrypted) }}"
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none @error('card_number_encrypted') border-red-500 @enderror"
                placeholder="1234 5678 9012 3456" maxlength="19" inputmode="numeric">
            <span id="luhn-error" class="text-red-500 text-xs mt-1 block hidden">El número de tarjeta no es válido.</span>
            @error('card_number_encrypted') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        {{-- Fecha y CVV --}}
        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Mes</label>
                <input type="text" name="expiry_month" id="expiry_month"
                    value="{{ old('expiry_month', $card->expiry_month) }}"
                    class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none @error('expiry_month') border-red-500 @enderror"
                    placeholder="MM" maxlength="2" inputmode="numeric">
                @error('expiry_month') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Año</label>
                <input type="text" name="expiry_year" id="expiry_year"
                    value="{{ old('expiry_year', $card->expiry_year) }}"
                    class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none @error('expiry_year') border-red-500 @enderror"
                    placeholder="AA o AAAA" maxlength="4" inputmode="numeric">
                <span id="expiry-error" class="text-red-500 text-xs mt-1 block hidden">Tarjeta vencida o fecha inválida.</span>
                @error('expiry_year') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">CVV</label>
                <input type="text" name="cvv_encrypted" id="cvv"
                    value="{{ old('cvv_encrypted', $card->cvv_encrypted) }}"
                    class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="***" maxlength="4" inputmode="numeric">
                <span id="cvv-error" class="text-red-500 text-xs mt-1 block hidden">CVV inválido para la marca seleccionada.</span>
            </div>
        </div>

        {{-- Marca --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Marca</label>
            <select name="brand" id="brand" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="">— Seleccionar —</option>
                <option value="Visa" {{ old('brand', $card->brand) == 'Visa' ? 'selected' : '' }}>Visa</option>
                <option value="Mastercard" {{ old('brand', $card->brand) == 'Mastercard' ? 'selected' : '' }}>Mastercard</option>
                <option value="Amex" {{ old('brand', $card->brand) == 'Amex' ? 'selected' : '' }}>American Express</option>
                <option value="Discover" {{ old('brand', $card->brand) == 'Discover' ? 'selected' : '' }}>Discover</option>
            </select>
        </div>

        {{-- Notas --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Notas</label>
            <textarea name="notes" rows="3"
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
                placeholder="Opcional...">{{ old('notes', $card->notes) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Carpeta (opcional)</label>
            <select name="folder_id" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <option value="">Sin carpeta</option>
                @foreach($folders as $folder)
                    <option value="{{ $folder->id }}" {{ old('folder_id', $card->folder_id) == $folder->id ? 'selected' : '' }}>
                        {{ $folder->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                Actualizar
            </button>
            <a href="{{ route('cards.index') }}" class="w-full text-center bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded transition duration-200">
                Cancelar
            </a>
        </div>
    </form>
</div>

<script>
document.querySelectorAll('#card_number, #expiry_month, #expiry_year, #cvv').forEach(input => {
    input.addEventListener('input', function () {
        this.value = this.value.replace(/\D/g, '');
    });
});

function luhnCheck(num) {
    let sum = 0;
    let alternate = false;
    for (let i = num.length - 1; i >= 0; i--) {
        let n = parseInt(num[i]);
        if (alternate) {
            n *= 2;
            if (n > 9) n -= 9;
        }
        sum += n;
        alternate = !alternate;
    }
    return sum % 10 === 0;
}

document.getElementById('card_number').addEventListener('blur', function () {
    const val = this.value.replace(/\D/g, '');
    const error = document.getElementById('luhn-error');
    if (val.length >= 12 && !luhnCheck(val)) {
        error.classList.remove('hidden');
    } else {
        error.classList.add('hidden');
    }
});

function validateExpiry() {
    const month = parseInt(document.getElementById('expiry_month').value);
    let year = parseInt(document.getElementById('expiry_year').value);
    const error = document.getElementById('expiry-error');

    if (!month || !year) return;

    if (year < 100) year += 2000;

    const now = new Date();
    const currentMonth = now.getMonth() + 1;
    const currentYear = now.getFullYear();

    if (year < currentYear || (year === currentYear && month < currentMonth)) {
        error.classList.remove('hidden');
    } else {
        error.classList.add('hidden');
    }
}

document.getElementById('expiry_month').addEventListener('blur', validateExpiry);
document.getElementById('expiry_year').addEventListener('blur', validateExpiry);

function validateCvv() {
    const brand = document.getElementById('brand').value;
    const cvv = document.getElementById('cvv').value;
    const error = document.getElementById('cvv-error');

    if (!cvv) return;

    const isAmex = brand === 'Amex';
    const valid = isAmex ? cvv.length === 4 : cvv.length === 3;

    if (!valid) {
        error.classList.remove('hidden');
    } else {
        error.classList.add('hidden');
    }
}

document.getElementById('cvv').addEventListener('blur', validateCvv);
document.getElementById('brand').addEventListener('change', validateCvv);

document.getElementById('card-form').addEventListener('submit', function (e) {
    const errors = document.querySelectorAll('#luhn-error:not(.hidden), #expiry-error:not(.hidden), #cvv-error:not(.hidden)');
    if (errors.length > 0) {
        e.preventDefault();
        alert('Por favor corrige los errores antes de continuar.');
    }
});
</script>
@endsection