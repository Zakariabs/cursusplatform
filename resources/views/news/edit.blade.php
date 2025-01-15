<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Artikel Bewerken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('news.update', $news) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Titel -->
                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Titel')" />
                            <x-text-input id="title" type="text" name="title" :value="old('title', $news->title)" class="block mt-1 w-full" required />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Huidige Afbeelding -->
                        @if($news->image)
                            <div class="mb-4">
                                <p class="mb-2">Huidige afbeelding:</p>
                                <img src="{{ Storage::url($news->image) }}" alt="Huidige afbeelding" class="w-48 h-48 object-cover">
                            </div>
                        @endif

                        <!-- Nieuwe Afbeelding -->
                        <div class="mb-4">
                            <x-input-label for="image" :value="__('Nieuwe afbeelding (optioneel)')" />
                            <input type="file" id="image" name="image" class="block mt-1" accept="image/*">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        <!-- Publicatiedatum -->
                        <div class="mb-4">
                            <x-input-label for="publish_date" :value="__('Publicatiedatum')" />
                            <x-text-input id="publish_date" type="date" name="publish_date" :value="old('publish_date', $news->publish_date->format('Y-m-d'))" class="block mt-1" required />
                            <x-input-error :messages="$errors->get('publish_date')" class="mt-2" />
                        </div>

                        <!-- Content -->
                        <div class="mb-4">
                            <x-input-label for="content" :value="__('Content')" />
                            <textarea id="content" name="content" rows="10" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm" required>{{ old('content', $news->content) }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>
                                {{ __('Wijzigingen Opslaan') }}
                            </x-primary-button>
                            <a href="{{ route('news.show', $news) }}" class="text-gray-600 hover:text-gray-900">
                                {{ __('Annuleren') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>