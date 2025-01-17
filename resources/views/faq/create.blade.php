<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nieuwe FAQ Toevoegen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('faq.store') }}" method="POST">
                        @csrf

                        <!-- Categorie -->
                        <div class="mb-4">
                            <x-input-label for="faq_category_id" :value="__('Categorie')" />
                            <select id="faq_category_id" name="faq_category_id" class="block mt-1 w-full rounded-md border-gray-300">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('faq_category_id')" class="mt-2" />
                        </div>

                        <!-- Vraag -->
                        <div class="mb-4">
                            <x-input-label for="question" :value="__('Vraag')" />
                            <x-text-input id="question" name="question" type="text" class="block mt-1 w-full" :value="old('question')" required />
                            <x-input-error :messages="$errors->get('question')" class="mt-2" />
                        </div>

                        <!-- Antwoord -->
                        <div class="mb-4">
                            <x-input-label for="answer" :value="__('Antwoord')" />
                            <textarea id="answer" name="answer" rows="4" class="block mt-1 w-full rounded-md border-gray-300" required>{{ old('answer') }}</textarea>
                            <x-input-error :messages="$errors->get('answer')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('FAQ Toevoegen') }}</x-primary-button>
                            <a href="{{ route('faq.index') }}" class="text-gray-600 hover:text-gray-900">{{ __('Annuleren') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>