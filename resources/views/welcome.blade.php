<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-8">
            <h1 class="text-4xl font-extrabold text-indigo-700 mb-4 text-center">¡Bienvenido a Gestor de Ideas!</h1>
            <p class="text-lg text-gray-700 mb-6 text-center">
                Comparte, descubre y apoya ideas innovadoras. Regístrate o inicia sesión para comenzar a crear y votar por tus ideas favoritas.
            </p>
            <div class="flex justify-center gap-4 mb-8">
                <a href="{{ route('login') }}" class="px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 font-semibold">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="px-6 py-2 bg-gray-200 text-indigo-700 rounded hover:bg-gray-300 font-semibold">Registrarse</a>
            </div>
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Ideas recientes</h2>
                <ul>
                    @foreach(\App\Models\Idea::latest()->take(3)->get() as $idea)
                        <li class="mb-4 p-4 border rounded bg-gray-100">
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="font-semibold text-indigo-600">{{ $idea->titulo }}</span>
                                    <span class="text-gray-500 text-sm ml-2">por {{ $idea->user->name ?? 'Anónimo' }}</span>
                                </div>
                                <span class="text-pink-600 font-bold">❤ {{ $idea->likes }}</span>
                            </div>
                            <p class="text-gray-700 mt-2">{{ Str::limit($idea->description, 100) }}</p>
                            <a href="{{ route('idea.show', $idea) }}" class="text-blue-500 hover:underline text-sm mt-2 inline-block">Ver detalle</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="text-center">
                <a href="{{ route('idea.index') }}" class="px-4 py-2 bg-indigo-100 text-indigo-700 rounded hover:bg-indigo-200 font-semibold">Ver todas las ideas</a>
            </div>
        </div>
    </div>
</x-app-layout>
