<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contact AI Academy') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf

                        <!-- Naam -->
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Naam')" />
                            <x-text-input id="name" type="text" name="name" :value="old('name')" class="block mt-1 w-full" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" type="email" name="email" :value="old('email')" class="block mt-1 w-full" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Onderwerp -->
                        <div class="mb-4">
                            <x-input-label for="subject" :value="__('Onderwerp')" />
                            <select id="subject" name="subject" class="block mt-1 w-full rounded-md border-gray-300" required>
                                <option value="">Selecteer een onderwerp</option>
                                <option value="ml_course">Machine Learning Cursus</option>
                                <option value="dl_course">Deep Learning Cursus</option>
                                <option value="ai_tools">AI Tools & Frameworks</option>
                                <option value="career">AI Career Advies</option>
                                <option value="technical">Technische Ondersteuning</option>
                                <option value="certificate">AI Certificering</option>
                            </select>
                            <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                        </div>

                        <!-- Bericht -->
                        <div class="mb-4">
                            <x-input-label for="message" :value="__('Bericht')" />
                            <textarea id="message" name="message" rows="6" class="block mt-1 w-full rounded-md border-gray-300" required>{{ old('message') }}</textarea>
                            <x-input-error :messages="$errors->get('message')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button>
                                {{ __('Verstuur Bericht') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>