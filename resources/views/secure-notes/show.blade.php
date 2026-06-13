@extends('layouts.plantilla')

@section('title', 'Ver Nota Segura')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-800">{{ $secureNote->title }}</h2>
        <a href="{{ route('secure-notes.index') }}" class="text-sm text-gray-500 hover:text-blue-600">← Volver</a>
    </div>

    <div class="mb-6">
        <label class="block text-sm font-semibold text-gray-700 mb-2">Contenido</label>
        <div id="note-content"
            class="bg-gray-50 border border-gray-200 rounded-md p-4 text-gray-800 whitespace-pre-wrap blur-sm select-none transition duration-200">{{ $secureNote->content_encrypted }}</div>
        <button onclick="toggleContent(this)"
            class="mt-3 bg-slate-800 hover:bg-slate-900 text-white text-sm py-1.5 px-4 rounded transition">
            Mostrar contenido
        </button>
    </div>

    <div class="flex gap-3">
        <a href="{{ route('secure-notes.edit', $secureNote) }}"
            style="background-color: #facc15; color: #000;"
            class="py-2 px-4 rounded font-semibold text-sm">
            Editar
        </a>
        <form method="POST" action="{{ route('secure-notes.destroy', $secureNote) }}"
            onsubmit="return confirm('¿Eliminar esta nota?')">
            @csrf
            @method('DELETE')
            <button style="background-color: #ef4444; color: #fff;"
                class="py-2 px-4 rounded font-semibold text-sm">
                Eliminar
            </button>
        </form>
    </div>
</div>

<script>
function toggleContent(btn) {
    const content = document.getElementById('note-content');
    const hidden = content.classList.contains('blur-sm');
    content.classList.toggle('blur-sm', !hidden);
    content.classList.toggle('select-none', !hidden);
    btn.textContent = hidden ? 'Ocultar contenido' : 'Mostrar contenido';
}
</script>
@endsection