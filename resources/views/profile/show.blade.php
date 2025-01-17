<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profiel van ') . $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center space-x-6">
                        @if($user->profile_photo)
                            <img src="{{ Storage::url($user->profile_photo) }}" alt="Profile" class="w-32 h-32 rounded-full object-cover">
                        @else
                            <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center">
                                <span class="text-2xl text-gray-500">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                        @endif
                        
                        <div>
                            <h3 class="text-2xl font-bold">{{ $user->name }}</h3>
                            @if($user->birthday)
                                <p class="text-gray-600">Verjaardag: {{ $user->birthday->format('d-m-Y') }}</p>
                            @endif
                        </div>
                    </div>

                    @if($user->bio)
                        <div class="mt-6">
                            <h4 class="text-lg font-semibold mb-2">Over mij</h4>
                            <p class="text-gray-700">{{ $user->bio }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>