@extends('layouts.plantilla')

@section('title', 'Ver Identidad')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-800">{{ $identity->title }}</h2>
        <a href="{{ route('identities.index') }}" class="text-sm text-gray-500 hover:text-blue-600">← Volver</a>
    </div>

    <dl class="space-y-4">
        <div>
            <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Nombre completo</dt>
            <dd class="text-gray-800 mt-1">{{ $identity->full_name ?? '—' }}</dd>
        </div>
        <div>
            <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Usuario</dt>
            <dd class="text-gray-800 mt-1">{{ $identity->username ?? '—' }}</dd>
        </div>
        <div>
            <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Correo electrónico</dt>
            <dd class="text-gray-800 mt-1">{{ $identity->email ?? '—' }}</dd>
        </div>
        <div>
            <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Teléfono</dt>
            <dd class="text-gray-800 mt-1">{{ $identity->phone ?? '—' }}</dd>
        </div>
        <div>
            <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Dirección</dt>
            <dd class="text-gray-800 mt-1">{{ $identity->address ?? '—' }}</dd>
        </div>
        <div>
            <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Fecha de nacimiento</dt>
            <dd class="text-gray-800 mt-1">{{ $identity->birth_date ?? '—' }}</dd>
        </div>
        <div>
            <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Empresa</dt>
            <dd class="text-gray-800 mt-1">{{ $identity->company ?? '—' }}</dd>
        </div>
        <div>
            <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Notas</dt>
            <dd class="text-gray-800 mt-1 whitespace-pre-wrap">{{ $identity->notes ?? '—' }}</dd>
        </div>
    </dl>

    <div class="flex gap-3 mt-8 pt-4 border-t">
        <a href="{{ route('identities.edit', $identity) }}"
            style="background-color: #facc15; color: #000;"
            class="py-2 px-4 rounded font-semibold text-sm">
            Editar
        </a>
        <form method="POST" action="{{ route('identities.destroy', $identity) }}"
            onsubmit="return confirm('¿Eliminar esta identidad?')">
            @csrf
            @method('DELETE')
            <button style="background-color: #ef4444; color: #fff;"
                class="py-2 px-4 rounded font-semibold text-sm">
                Eliminar
            </button>
        </form>
    </div>
</div>
@endsection