<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('FAQ') }}
            </h2>
            @if(auth()->user()?->is_admin)
                <a href="{{ route('admin.faq.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Nieuwe vraag toevoegen
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @forelse($faqs as $faq)
                        <div class="mb-4">
                            <h3 class="font-bold text-lg">{{ $faq->question }}</h3>
                            <p class="mt-2">{{ $faq->answer }}</p>
                            @if(auth()->user()?->is_admin)
                                <div class="mt-2 flex space-x-2">
                                    <a href="{{ route('admin.faq.edit', $faq) }}" class="text-blue-500 hover:text-blue-700">
                                        Bewerken
                                    </a>
                                    <form action="{{ route('admin.faq.destroy', $faq) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700" 
                                                onclick="return confirm('Weet je zeker dat je deze vraag wilt verwijderen?')">
                                            Verwijderen
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @empty
                        <p>Geen FAQ items gevonden.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>