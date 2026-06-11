@extends('layouts.plantilla')

@section('title', 'Mis Logins')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-800">Mis Logins</h2>
        <a href="{{ route('logins.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200">
            + Nuevo Login
        </a>
    </div>

    <form method="GET" action="{{ route('logins.index') }}" class="mb-4">
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Buscar por título..."
            class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
    </form>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Título</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Usuario</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">URL</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 text-sm text-gray-700">
                @forelse($logins as $login)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4 font-semibold">{{ $login->title }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ $login->username ?? '—' }}</td>
                        <td class="px-6 py-4 text-gray-500">
                            @if($login->url)
                                <a href="{{ $login->url }}" target="_blank" class="text-blue-500 hover:underline">{{ $login->url }}</a>
                            @else
                                —
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <a href="{{ route('logins.edit', $login) }}" 
                                style="background-color: #facc15; color: #000;" 
                                class="py-1 px-3 rounded text-xs font-semibold">
                                    Editar
                                </a>
                                <form method="POST" action="{{ route('logins.destroy', $login) }}" 
                                    onsubmit="return confirm('¿Eliminar este login?')">
                                    @csrf
                                    @method('DELETE')
                                    <button style="background-color: #ef4444; color: #fff;" 
                                            class="py-1 px-3 rounded text-xs font-semibold">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-400">No tienes logins guardados aún.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection