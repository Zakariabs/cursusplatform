<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $news->title }}
            </h2>
            @if(auth()->user()?->is_admin)
                <div class="flex space-x-4">
                    <a href="{{ route('admin.news.edit', $news) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                        Bewerken
                    </a>
                    <form action="{{ route('admin.news.destroy', $news) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Weet je zeker dat je dit artikel wilt verwijderen?')">
                            Verwijderen
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if($news->image)
                    <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}" class="w-full h-96 object-cover">
                @endif
                
                <div class="p-6">
                    <div class="mb-4">
                        <p class="text-gray-600">
                            Gepubliceerd op: {{ $news->publish_date->format('d-m-Y') }}
                        </p>
                        <p class="text-gray-600">
                            Door: {{ $news->user->name }}
                        </p>
                    </div>

                    <div class="prose max-w-none">
                        {!! nl2br(e($news->content)) !!}
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('news.index') }}" class="text-blue-500 hover:underline">
                            &larr; Terug naar overzicht
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>