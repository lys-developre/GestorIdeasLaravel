<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session()->has('message'))
            <div class="text-center bg-green-100 rounded-md p-2 font-semibold mb-4">
                <span class="text-green-600 text-xl">{{session('message')}}</span>
            </div>
            @endif
            <div class="overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 flex flex-wrap gap-4">
                    <a href="{{ route('idea.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Agregar Idea</a>
                    <a href="{{ route('idea.index', ['filtro' => 'mis-ideas']) }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Mis Ideas</a>
                    <a href="{{ route('idea.index', ['filtro' => 'las-mejores']) }}" class="px-4 py-2 bg-yellow-400 text-white rounded hover:bg-yellow-500">Las Mejores</a>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                @forelse($ideas as $idea)
                <div class="p-6 flex flex-col md:flex-row md:items-center border-b border-gray-200 dark:border-gray-700">
                    <div class="flex-1">
                        <h2 class="text-xl font-bold text-indigo-700 dark:text-indigo-300">{{ $idea->titulo }}</h2>
                        <p class="text-gray-700 dark:text-gray-200 mt-2">{{ $idea->description }}</p>
                        <div class="text-sm text-gray-500 mt-2">Por: {{ $idea->user->name ?? 'Anónimo' }} | {{ $idea->created_at->diffForHumans() }}</div>
                    </div>
                    <div class="flex flex-col items-end mt-4 md:mt-0 md:ml-6">
                        <span class="text-lg font-semibold text-pink-600">❤ {{ $idea->likes }}</span>
                        <a href="{{ route('idea.show', $idea) }}" class="mt-2 px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Ver Detalle</a>
                    </div>
                </div>
                @empty
                <div class="p-6 text-center text-gray-500">No hay ideas registradas aún.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>