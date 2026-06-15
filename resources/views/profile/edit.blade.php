@extends('layouts.plantilla')

@section('title', 'Mi Perfil')

@section('content')
<div class="space-y-6">

    <div class="bg-white p-6 rounded-lg shadow-md border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-800">Mi Perfil</h2>
        <p class="text-sm text-gray-500 mt-1">Administra tu información de cuenta y configuración de seguridad.</p>
    </div>

    <div class="p-4 sm:p-8 bg-white shadow-md rounded-lg">
        <div class="max-w-xl">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <div class="p-4 sm:p-8 bg-white shadow-md rounded-lg">
        <div class="max-w-xl">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <div class="p-4 sm:p-8 bg-white shadow-md rounded-lg">
        <div class="max-w-xl">
            @include('profile.partials.delete-user-form')
        </div>
    </div>

</div>
@endsection