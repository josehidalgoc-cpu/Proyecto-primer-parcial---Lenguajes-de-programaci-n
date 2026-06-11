<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KeyVault - @yield('title', 'Dashboard')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="flex min-h-screen">
        
        @include('layouts.sidebar')

        <div class="flex-1 flex flex-col">
            
            @include('layouts.navigation')

            <main class="flex-1 p-8">
                
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @yield('content')
                
            </main>
        </div>

    </div>

</body>
</html>