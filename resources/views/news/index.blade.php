<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Nieuws') }}
            </h2>
            @if(auth()->user()?->is_admin)
                <a href="{{ route('news.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Nieuw artikel
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid md:grid-cols-2 gap-6">
                @forelse($news as $article)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        @if($article->image)
                            <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                        @endif
                        <div class="p-6">
                            <h3 class="text-lg font-bold mb-2">{{ $article->title }}</h3>
                            <p class="text-gray-600 text-sm mb-2">
                                {{ $article->publish_date->format('d-m-Y') }}
                            </p>
                            <p class="text-gray-700 mb-4">
                                {{ Str::limit($article->content, 150) }}
                            </p>
                            <div class="flex space-x-4">
                                <a href="{{ route('news.show', $article) }}" class="text-blue-500 hover:underline">
                                    Lees meer
                                </a>
                                @if(auth()->user()?->is_admin)
                                    <a href="{{ route('news.edit', $article) }}" class="text-yellow-500 hover:underline">
                                        Bewerken
                                    </a>
                                    <form action="{{ route('news.destroy', $article) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Weet je zeker dat je dit artikel wilt verwijderen?')">
                                            Verwijderen
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <p>Er zijn nog geen nieuwsartikelen.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>