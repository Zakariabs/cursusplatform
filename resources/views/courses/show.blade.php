<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if($course->image)
                    <div class="h-64 w-full overflow-hidden">
                        <img src="{{ Storage::url($course->image) }}" 
                             alt="{{ $course->title }}" 
                             class="w-full h-full object-cover">
                    </div>
                @endif

                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <h1 class="text-3xl font-bold text-gray-900">{{ $course->title }}</h1>
                        @auth
                            @if(auth()->user()->is_admin)
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.courses.edit', $course) }}" 
                                       class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                        Bewerken
                                    </a>
                                    <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                                onclick="return confirm('Weet je zeker dat je deze cursus wilt verwijderen?')">
                                            Verwijderen
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>

                    <div class="mt-4 flex space-x-4">
                        <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded">
                            {{ ucfirst($course->difficulty_level) }}
                        </span>
                        <span class="text-gray-600">
                            Duur: {{ $course->duration_weeks }} weken
                        </span>
                    </div>

                    <div class="mt-6">
                        <h2 class="text-2xl font-bold text-gray-900">Beschrijving</h2>
                        <div class="mt-4 prose max-w-none text-gray-600">
                            {{ $course->description }}
                        </div>
                    </div>

                    <div class="mt-8">
                        <h2 class="text-2xl font-bold text-gray-900">Cursusinhoud</h2>
                        <div class="mt-4 prose max-w-none text-gray-600">
                            {!! $course->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>