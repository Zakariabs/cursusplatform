<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('FAQ') }}
            </h2>
            @if(auth()->user()?->is_admin)
                <a href="{{ route('faq.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
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

            @forelse($categories as $category)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-bold mb-4">{{ $category->name }}</h3>
                        
                        @if($category->description)
                            <p class="text-gray-600 mb-4">{{ $category->description }}</p>
                        @endif

                        <div class="space-y-4">
                            @forelse($category->faqs as $faq)
                                <div class="border-b pb-4">
                                    <h4 class="font-semibold mb-2">{{ $faq->question }}</h4>
                                    <p class="text-gray-700">{{ $faq->answer }}</p>
                                    
                                    @if(auth()->user()?->is_admin)
                                        <div class="mt-2 space-x-4">
                                            <a href="{{ route('faq.edit', $faq) }}" class="text-yellow-500 hover:underline">
                                                Bewerken
                                            </a>
                                            <form action="{{ route('faq.destroy', $faq) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Weet je zeker dat je deze FAQ wilt verwijderen?')">
                                                    Verwijderen
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            @empty
                                <p class="text-gray-600">Geen vragen in deze categorie.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p>Er zijn nog geen FAQ categorieën.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>