@extends('layouts.plantilla')

@section('title', 'Editar Login')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Editar Login</h2>

    <form action="{{ route('logins.update', $login) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Título</label>
            <input type="text" name="title" value="{{ old('title', $login->title) }}"
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none @error('title') border-red-500 @enderror"
                placeholder="Ej. Gmail, Netflix, Banco">
            @error('title') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Correo electrónico</label>
            <input type="email" name="email" value="{{ old('email', $login->email) }}"
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
                placeholder="Ej. juan@gmail.com">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Usuario</label>
            <input type="text" name="username" value="{{ old('username', $login->username) }}"
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
                placeholder="Ej. juan123">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Contraseña</label>
            <input type="password" name="password_encrypted" value="{{ old('password_encrypted', $login->password_encrypted) }}"
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none @error('password_encrypted') border-red-500 @enderror"
                placeholder="Contraseña">
            @error('password_encrypted') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">URL</label>
            <input type="text" name="url" value="{{ old('url', $login->url) }}"
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
                placeholder="https://paginaweb.com">m
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Notas</label>
            <textarea name="notes" rows="3"
                class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
                placeholder="Opcional...">{{ old('notes', $login->notes) }}</textarea>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-200">
                Actualizar
            </button>
            <a href="{{ route('logins.index') }}" class="w-full text-center bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded transition duration-200">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection