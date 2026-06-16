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

                <div class="flex justify-between items-start mb-4">
                    <span class="text-sm font-semibold tracking-widest uppercase text-slate-300">{{ $card->brand ?? 'Tarjeta' }}</span>
                    @if($card->folder)
                        <span class="text-xs bg-slate-700 text-blue-300 px-2 py-1 rounded-full">📁 {{ $card->folder->name }}</span>
                    @endif
                </div>

                <div class="mb-1 text-xs text-slate-400 uppercase tracking-wider">Número</div>
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-lg font-mono tracking-widest">{{ $card->card_number_encrypted }}</span>
                    <button onclick="copyText('{{ $card->card_number_encrypted }}', this)"
                        class="text-slate-400 hover:text-white transition text-xs border border-slate-500 rounded px-1.5 py-0.5">
                        Copiar
                    </button>
                </div>

                <div class="mb-1 text-xs text-slate-400 uppercase tracking-wider">Titular</div>
                <div class="flex items-center gap-2 mb-4">
                    <span class="font-semibold">{{ $card->cardholder_name }}</span>
                    <button onclick="copyText('{{ $card->cardholder_name }}', this)"
                        class="text-slate-400 hover:text-white transition text-xs border border-slate-500 rounded px-1.5 py-0.5">
                        Copiar
                    </button>
                </div>

                {{-- Vencimiento y CVV --}}
                <div class="flex justify-between items-end mb-4">
                    <div>
                        <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">Vence</div>
                        <div class="flex items-center gap-2">
                            <span class="font-semibold">{{ $card->expiry_month }}/{{ $card->expiry_year }}</span>
                            <button onclick="copyText('{{ $card->expiry_month }}/{{ $card->expiry_year }}', this)"
                                class="text-slate-400 hover:text-white transition text-xs border border-slate-500 rounded px-1.5 py-0.5">
                                Copiar
                            </button>
                        </div>
                    </div>
                    @if($card->cvv_encrypted)
                    <div>
                        <div class="text-xs text-slate-400 uppercase tracking-wider mb-1">CVV</div>
                        <div class="flex items-center gap-2">
                            <span class="font-semibold">{{ $card->cvv_encrypted }}</span>
                            <button onclick="copyText('{{ $card->cvv_encrypted }}', this)"
                                class="text-slate-400 hover:text-white transition text-xs border border-slate-500 rounded px-1.5 py-0.5">
                                Copiar
                            </button>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="flex gap-2 mt-2 border-t border-slate-600 pt-4">
                    <a href="{{ route('cards.edit', $card) }}"
                        style="background-color: #facc15; color: #000;"
                        class="py-1 px-3 rounded text-xs font-semibold">
                        Editar
                    </a>
                    <form method="POST" action="{{ route('cards.destroy', $card) }}"
                        onsubmit="return confirm('¿Eliminar esta tarjeta?')">
                        @csrf
                        @method('DELETE')
                        <button style="background-color: #ef4444; color: #fff;"
                            class="py-1 px-3 rounded text-xs font-semibold">
                            Eliminar
                        </button>
                    </form>
                </div>

            </div>
        @empty
            <div class="col-span-3 text-center text-gray-400 py-8">No tienes tarjetas guardadas aún.</div>
        @endforelse
    </div>
</div>

<script>
function copyText(text, btn) {
    navigator.clipboard.writeText(text).then(() => {
        const original = btn.innerHTML;
        btn.innerHTML = '¡Copiado!';
        btn.style.color = '#4ade80';
        setTimeout(() => {
            btn.innerHTML = original;
            btn.style.color = '';
        }, 1500);
    });
}
</script>
@endsection