<div class="w-64 bg-slate-900 text-white min-h-screen p-5 flex flex-col justify-between">
    <div>
        <div class="mb-8 p-2 border-b border-slate-700">
            <h2 class="text-xl font-bold tracking-wider text-blue-400">KeyVault</h2>
            <p class="text-xs text-slate-400">Gestor de Credenciales</p>
        </div>

        <nav class="space-y-4">
            <div>
                <a href="{{ route('dashboard') }}" class="flex items-center px-2 py-2 text-sm font-semibold rounded text-slate-300 hover:bg-slate-800 hover:text-blue-400 transition duration-200 {{ request()->routeIs('dashboard') ? 'bg-slate-800 text-blue-400' : '' }}">
                    Panel Principal
                </a>
            </div>

            <div class="space-y-1">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-2 block">Inicios de Sesión</span>
                <a href="{{ route('logins.index') }}" class="block px-4 py-2 rounded text-sm text-slate-400 hover:bg-slate-800 hover:text-blue-400 transition duration-200 {{ request()->routeIs('logins.*') ? 'bg-slate-800 text-blue-400' : '' }}">
                    🔑 Ver Mis Logins
                </a>
                <a href="{{ route('logins.create') }}" class="block px-4 py-2 rounded text-sm text-slate-400 hover:bg-slate-800 hover:text-blue-400 transition duration-200">
                    + Añadir Login
                </a>
            </div>

            <div class="space-y-1">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-2 block">Métodos de Pago</span>
                <a href="{{ route('cards.index') }}" class="block px-4 py-2 rounded text-sm text-slate-400 hover:bg-slate-800 hover:text-blue-400 transition duration-200 {{ request()->routeIs('cards.*') ? 'bg-slate-800 text-blue-400' : '' }}">
                    💳 Ver Mis Tarjetas
                </a>
                <a href="{{ route('cards.create') }}" class="block px-4 py-2 rounded text-sm text-slate-400 hover:bg-slate-800 hover:text-blue-400 transition duration-200">
                    + Añadir Tarjeta
                </a>
            </div>
        </nav>
    </div>

    <div class="text-xs text-center text-slate-500 border-t border-slate-800 pt-3">
        &copy; 2026 GestorCredenciales
    </div>
</div>