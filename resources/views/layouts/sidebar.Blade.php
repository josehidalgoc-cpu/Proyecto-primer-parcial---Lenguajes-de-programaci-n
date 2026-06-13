<div class="w-64 bg-slate-900 text-white min-h-screen p-5 flex flex-col justify-between">
    <div>
        <div class="mb-8 pb-4 border-b border-slate-700">
            <h2 class="text-2xl font-extrabold tracking-wide text-blue-400">KeyVault</h2>
            <p class="text-xs text-slate-400 mt-1">Tu bóveda segura</p>
        </div>

        <nav class="space-y-4">
            <div>
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-2 py-2 text-sm font-semibold rounded text-slate-300 hover:bg-slate-800 hover:text-blue-400 transition duration-200 {{ request()->routeIs('dashboard') ? 'bg-slate-800 text-blue-400' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Panel Principal
                </a>
            </div>

            <div class="space-y-1">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-2 block">Inicios de Sesión</span>
                <a href="{{ route('logins.index') }}" class="flex items-center gap-2 px-4 py-2 rounded text-sm text-slate-400 hover:bg-slate-800 hover:text-blue-400 transition duration-200 {{ request()->routeIs('logins.*') ? 'bg-slate-800 text-blue-400' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                    Ver Mis Logins
                </a>
                <a href="{{ route('logins.create') }}" class="block px-4 py-2 rounded text-sm text-slate-400 hover:bg-slate-800 hover:text-blue-400 transition duration-200">
                    + Añadir Login
                </a>
            </div>

            <div class="space-y-1">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-2 block">Métodos de Pago</span>
                <a href="{{ route('cards.index') }}" class="flex items-center gap-2 px-4 py-2 rounded text-sm text-slate-400 hover:bg-slate-800 hover:text-blue-400 transition duration-200 {{ request()->routeIs('cards.*') ? 'bg-slate-800 text-blue-400' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    Ver Mis Tarjetas
                </a>
                <a href="{{ route('cards.create') }}" class="block px-4 py-2 rounded text-sm text-slate-400 hover:bg-slate-800 hover:text-blue-400 transition duration-200">
                    + Añadir Tarjeta
                </a>
            </div>

            <div class="space-y-1">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-2 block">Notas Seguras</span>
                <a href="{{ route('secure-notes.index') }}" class="flex items-center gap-2 px-4 py-2 rounded text-sm text-slate-400 hover:bg-slate-800 hover:text-blue-400 transition duration-200 {{ request()->routeIs('secure-notes.*') ? 'bg-slate-800 text-blue-400' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Ver Mis Notas
                </a>
                <a href="{{ route('secure-notes.create') }}" class="block px-4 py-2 rounded text-sm text-slate-400 hover:bg-slate-800 hover:text-blue-400 transition duration-200">
                    + Añadir Nota
                </a>
            </div>

            <div class="space-y-1">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-2 block">Identidades</span>
                <a href="{{ route('identities.index') }}" class="flex items-center gap-2 px-4 py-2 rounded text-sm text-slate-400 hover:bg-slate-800 hover:text-blue-400 transition duration-200 {{ request()->routeIs('identities.*') ? 'bg-slate-800 text-blue-400' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Ver Mis Identidades
                </a>
                <a href="{{ route('identities.create') }}" class="block px-4 py-2 rounded text-sm text-slate-400 hover:bg-slate-800 hover:text-blue-400 transition duration-200">
                    + Añadir Identidad
                </a>
            </div>

        </nav>
    </div>

    <div class="border-t border-slate-800 pt-4 space-y-3">
        <div class="px-2">
            <p class="text-sm font-semibold text-white">{{ Auth::user()->name }}</p>
            <p class="text-xs text-slate-400 truncate">{{ Auth::user()->email }}</p>
        </div>

        <a href="{{ route('profile.edit') }}"
            class="flex items-center gap-2 px-2 py-2 rounded text-sm text-slate-400 hover:bg-slate-800 hover:text-blue-400 transition duration-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            Mi Perfil
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-2 text-left px-2 py-2 rounded text-sm text-slate-400 hover:bg-red-900 hover:text-red-300 transition duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Cerrar Sesión
            </button>
        </form>

        <p class="text-xs text-center text-slate-600 pt-2">&copy; 2026 KeyVault</p>
    </div>
</div>