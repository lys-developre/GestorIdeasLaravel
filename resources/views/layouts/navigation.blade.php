<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo y nombre -->
            <div class="flex items-center gap-3">
                <a href="{{ route('idea.index') }}" class="flex items-center gap-2">
                    <svg class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m4 0h-1v-4h-1m-4 0h-1v-4h-1m4 0h-1v-4h-1" /></svg>
                    <span class="font-bold text-xl text-indigo-700">Gestor de Ideas</span>
                </a>
            </div>
            <!-- Links principales -->
            <div class="hidden sm:flex gap-6 items-center">
                <a href="{{ route('idea.index') }}" class="text-gray-700 dark:text-gray-200 hover:text-indigo-600 font-semibold transition">Ideas</a>
                <a href="{{ route('idea.create') }}" class="text-gray-700 dark:text-gray-200 hover:text-indigo-600 font-semibold transition">Agregar Idea</a>
                @auth
                    <a href="{{ route('idea.index', ['filtro' => 'mis-ideas']) }}" class="text-gray-700 dark:text-gray-200 hover:text-indigo-600 font-semibold transition">Mis Ideas</a>
                @endauth
                <a href="{{ route('idea.index', ['filtro' => 'las-mejores']) }}" class="text-gray-700 dark:text-gray-200 hover:text-indigo-600 font-semibold transition">Las Mejores</a>
            </div>
            <!-- Usuario y menú -->
            <div class="flex items-center gap-4">
                @auth
                    <span class="hidden sm:inline text-gray-700 dark:text-gray-200 font-medium">Hola, {{ Auth::user()->name }}</span>
                    <a href="{{ route('profile.edit') }}" class="text-gray-500 hover:text-indigo-600 transition">Perfil</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-500 hover:text-red-600 transition font-medium">Salir</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline">Iniciar sesión</a>
                    <a href="{{ route('register') }}" class="text-gray-700 dark:text-gray-200 font-semibold hover:underline">Registrarse</a>
                @endauth
                <!-- Botón hamburguesa -->
                <button @click="open = ! open" class="sm:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-indigo-600 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Menú responsive -->
    <div :class="{'block': open, 'hidden': ! open}" class="sm:hidden hidden bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
        <div class="px-4 pt-2 pb-3 space-y-1">
            <a href="{{ route('idea.index') }}" class="block py-2 text-gray-700 dark:text-gray-200 hover:text-indigo-600 font-semibold">Ideas</a>
            <a href="{{ route('idea.create') }}" class="block py-2 text-gray-700 dark:text-gray-200 hover:text-indigo-600 font-semibold">Agregar Idea</a>
            @auth
                <a href="{{ route('idea.index', ['filtro' => 'mis-ideas']) }}" class="block py-2 text-gray-700 dark:text-gray-200 hover:text-indigo-600 font-semibold">Mis Ideas</a>
            @endauth
            <a href="{{ route('idea.index', ['filtro' => 'las-mejores']) }}" class="block py-2 text-gray-700 dark:text-gray-200 hover:text-indigo-600 font-semibold">Las Mejores</a>
            <div class="border-t border-gray-200 dark:border-gray-700 my-2"></div>
            @auth
                <a href="{{ route('profile.edit') }}" class="block py-2 text-gray-500 hover:text-indigo-600">Perfil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left py-2 text-red-600 hover:bg-red-50">Salir</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block py-2 text-indigo-600 font-semibold">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="block py-2 text-gray-700 dark:text-gray-200 font-semibold">Registrarse</a>
            @endauth
        </div>
    </div>
</nav>
