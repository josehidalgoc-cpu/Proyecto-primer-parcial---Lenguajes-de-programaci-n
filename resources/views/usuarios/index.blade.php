@extends('layouts.app')

@section('title', 'Gestión de Usuarios')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-800">Usuarios Registrados</h2>
        <p class="text-sm text-gray-500">Lista de accesos al sistema (Breeze)</p>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de Registro</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 text-sm text-gray-700">
                @foreach($usuarios as $usuario)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap font-semibold text-gray-900">{{ $usuario->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $usuario->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ $usuario->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500">
                            {{ $usuario->created_at ? $usuario->created_at->format('d/m/Y H:i') : 'N/A' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection