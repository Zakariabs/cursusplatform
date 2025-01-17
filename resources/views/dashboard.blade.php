<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welkom Sectie -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Welkom bij AI Academy</h3>
                    <p class="text-gray-600">Uw platform voor AI-gerelateerde cursussen en ontwikkeling.</p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Laatste Nieuws -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Laatste Nieuws</h3>
                        @if($latestNews->count() > 0)
                            @foreach($latestNews as $news)
                                <div class="mb-4 pb-4 border-b last:border-0">
                                    <h4 class="font-medium">{{ $news->title }}</h4>
                                    <p class="text-sm text-gray-600">{{ $news->publish_date->format('d-m-Y') }}</p>
                                </div>
                            @endforeach
                            <a href="{{ route('news.index') }}" class="text-blue-500 hover:underline">Bekijk al het nieuws</a>
                        @else
                            <p class="text-gray-600">Geen nieuws beschikbaar.</p>
                        @endif
                    </div>
                </div>

                <!-- FAQ Sectie -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Populaire Vragen</h3>
                        @if($faqs->count() > 0)
                            @foreach($faqs as $faq)
                                <div class="mb-4 pb-4 border-b last:border-0">
                                    <h4 class="font-medium">{{ $faq->question }}</h4>
                                    <p class="text-sm text-gray-600">{{ Str::limit($faq->answer, 100) }}</p>
                                </div>
                            @endforeach
                            <a href="{{ route('faq.index') }}" class="text-blue-500 hover:underline">Bekijk alle FAQs</a>
                        @else
                            <p class="text-gray-600">Geen FAQs beschikbaar.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
