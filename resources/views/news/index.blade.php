<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Nieuws') }}
            </h2>
            @if(auth()->user()?->is_admin)
                <a href="{{ route('admin.news.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
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

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($newsItems as $news)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        @if($news->image)
                            <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}" class="w-full h-48 object-cover">
                        @endif
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2">{{ $news->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($news->content, 150) }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">{{ $news->created_at->format('d-m-Y') }}</span>
                                <a href="{{ route('news.show', $news) }}" class="text-blue-500 hover:text-blue-700">
                                    Lees meer
                                </a>
                            </div>
                            @if(auth()->user()?->is_admin)
                                <div class="mt-4 flex space-x-2">
                                    <a href="{{ route('admin.news.edit', $news) }}" class="text-yellow-500 hover:text-yellow-700">
                                        Bewerken
                                    </a>
                                    <form action="{{ route('admin.news.destroy', $news) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700"
                                                onclick="return confirm('Weet je zeker dat je dit artikel wilt verwijderen?')">
                                            Verwijderen
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-3">
                        <p class="text-gray-500 text-center">Geen nieuwsartikelen gevonden.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $newsItems->links() }}
            </div>
        </div>
    </div>
</x-app-layout>