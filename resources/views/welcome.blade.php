<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KeyVault - Tu bóveda segura</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        @keyframes pulse-slow {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.6; }
        }
        .animate-float { animation: float 3s ease-in-out infinite; }
        .animate-pulse-slow { animation: pulse-slow 2.5s ease-in-out infinite; }
    </style>
</head>
<body class="bg-slate-900 text-white font-sans antialiased">

    <div class="min-h-screen flex flex-col">

        <header class="flex justify-between items-center px-6 py-5 max-w-7xl mx-auto w-full">
            <div>
                <h1 class="text-2xl font-extrabold tracking-wide text-blue-400">KeyVault</h1>
            </div>
            <nav class="flex items-center gap-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-5 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-sm font-semibold transition">
                        Ir al Panel
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-5 py-2 rounded-md text-sm font-semibold text-slate-300 hover:text-white transition">
                        Iniciar Sesión
                    </a>
                    <a href="{{ route('register') }}" class="px-5 py-2 rounded-md bg-blue-600 hover:bg-blue-700 text-sm font-semibold transition">
                        Registrarse
                    </a>
                @endauth
            </nav>
        </header>

        <main class="flex-1 flex items-center justify-center px-6">
            <div class="max-w-3xl text-center">

                <div class="flex justify-center mb-8">
                    <div class="p-6 bg-blue-600/20 rounded-full animate-pulse-slow shadow-lg shadow-blue-500/20">
                        <svg class="w-24 h-24 text-blue-400 animate-float" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                </div>

                <h2 class="text-4xl md:text-5xl font-extrabold mb-8 leading-tight">
                    Tu bóveda digital,<br><span class="text-blue-400">segura y a tu alcance</span>
                </h2>

                <p class="text-slate-400 text-lg mb-10 max-w-xl mx-auto">
                    KeyVault guarda tus contraseñas, tarjetas, notas e identidades cifradas en un solo lugar. Simple, seguro y siempre disponible.
                </p>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
                    <div class="bg-slate-800/60 p-4 rounded-lg border border-slate-700 hover:border-blue-500 hover:bg-slate-800 hover:-translate-y-1 transition duration-200 cursor-default">
                        <div class="text-blue-400 flex justify-center mb-2">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                        </div>
                        <p class="text-sm font-semibold">Logins</p>
                    </div>
                    <div class="bg-slate-800/60 p-4 rounded-lg border border-slate-700 hover:border-blue-500 hover:bg-slate-800 hover:-translate-y-1 transition duration-200 cursor-default">
                        <div class="text-green-400 flex justify-center mb-2">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        </div>
                        <p class="text-sm font-semibold">Tarjetas</p>
                    </div>
                    <div class="bg-slate-800/60 p-4 rounded-lg border border-slate-700 hover:border-blue-500 hover:bg-slate-800 hover:-translate-y-1 transition duration-200 cursor-default">
                        <div class="text-yellow-400 flex justify-center mb-2">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <p class="text-sm font-semibold">Notas</p>
                    </div>
                    <div class="bg-slate-800/60 p-4 rounded-lg border border-slate-700 hover:border-blue-500 hover:bg-slate-800 hover:-translate-y-1 transition duration-200 cursor-default">
                        <div class="text-purple-400 flex justify-center mb-2">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <p class="text-sm font-semibold">Identidades</p>
                    </div>
                </div>

                @guest
                    <div class="flex justify-center gap-4">
                        <a href="{{ route('register') }}" class="px-8 py-3 rounded-md bg-blue-600 hover:bg-blue-700 font-semibold transition">
                            Comenzar ahora
                        </a>
                        <a href="{{ route('login') }}" class="px-8 py-3 rounded-md border border-slate-600 hover:bg-slate-800 font-semibold transition">
                            Ya tengo cuenta
                        </a>
                    </div>
                @endguest

            </div>
        </main>
        <footer class="text-center text-slate-600 text-sm py-6">
            &copy; 2026 KeyVault — Gestor de Credenciales
        </footer>

    </div>

</body>
</html>