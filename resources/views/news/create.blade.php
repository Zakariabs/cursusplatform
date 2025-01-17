<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nieuw Artikel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Titel -->
                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Titel')" />
                            <x-text-input id="title" type="text" name="title" :value="old('title')" class="block mt-1 w-full" required />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Afbeelding -->
                        <div class="mb-4">
                            <x-input-label for="image" :value="__('Afbeelding')" />
                            <input type="file" id="image" name="image" class="block mt-1" required accept="image/*">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        <!-- Publicatiedatum -->
                        <div class="mb-4">
                            <x-input-label for="publish_date" :value="__('Publicatiedatum')" />
                            <x-text-input id="publish_date" type="date" name="publish_date" :value="old('publish_date')" class="block mt-1" required />
                            <x-input-error :messages="$errors->get('publish_date')" class="mt-2" />
                        </div>

                        <!-- Content -->
                        <div class="mb-4">
                            <x-input-label for="content" :value="__('Content')" />
                            <textarea id="content" name="content" rows="10" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm" required>{{ old('content') }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>
                                {{ __('Artikel Toevoegen') }}
                            </x-primary-button>
                            <a href="{{ route('news.index') }}" class="text-gray-600 hover:text-gray-900">
                                {{ __('Annuleren') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>