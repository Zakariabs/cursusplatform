<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contact Berichten') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @forelse($messages as $message)
                        <div class="mb-6 pb-6 border-b last:border-0">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-semibold">{{ $message->subject }}</h3>
                                    <p class="text-sm text-gray-600">
                                        Van: {{ $message->name }} ({{ $message->email }})
                                    </p>
                                    <p class="text-sm text-gray-600">
                                        Ontvangen: {{ $message->created_at->format('d-m-Y H:i') }}
                                    </p>
                                </div>
                                <span class="px-3 py-1 rounded-full text-sm {{ $message->status === 'new' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $message->status === 'new' ? 'Nieuw' : 'Gelezen' }}
                                </span>
                            </div>
                            <div class="mt-4">
                                <p class="text-gray-700 whitespace-pre-line">{{ $message->message }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600">
                            Er zijn nog geen contactberichten ontvangen.
                        </p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>