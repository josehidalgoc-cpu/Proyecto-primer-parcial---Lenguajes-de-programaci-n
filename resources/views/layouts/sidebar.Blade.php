<div class="w-64 bg-slate-900 text-white min-h-screen p-5 flex flex-col justify-between mt-16">
    <div>
        <div class="mb-8 p-2 border-b border-slate-700">
            <h2 class="text-xl font-bold tracking-wider text-blue-400">EjemploSeg</h2>
            <p class="text-xs text-slate-400">Gestión de Seguridad</p>
        </div>

        <nav class="space-y-2">
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider px-2 mb-2">Navegación</p>

            <div class="space-y-1">
                <span class="text-sm font-medium text-slate-300 px-2 block">Persona</span>
                <a href="{{ route('personas.create') }}" class="block px-4 py-2 rounded text-sm text-slate-400 hover:bg-slate-800 hover:text-blue-400 transition duration-200">
                    + Crear Persona
                </a>
            </div>

            <div class="space-y-1 pt-2">
                <span class="text-sm font-medium text-slate-300 px-2 block">Interés</span>
                <a href="{{ route('intereses.create') }}" class="block px-4 py-2 rounded text-sm text-slate-400 hover:bg-slate-800 hover:text-blue-400 transition duration-200">
                    + Crear Interés
                </a>
            </div>

            <div class="space-y-1 pt-2">
                <span class="text-sm font-medium text-slate-300 px-2 block">Gestión de Usuarios</span>
                <a href="{{ route('usuarios.index') }}" class="block px-4 py-2 rounded text-sm text-slate-400 hover:bg-slate-800 hover:text-blue-400 transition duration-200">
                    Seguridad
                </a>
            </div>
        </nav>
    </div>

    <div class="text-xs text-center text-slate-500 border-t border-slate-800 pt-3">
        &copy; 2026 UEES Taller N:M
    </div>
</div>