<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-6">Mijn Cursussen</h1>

            @if($courses->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-500">
                        Je bent nog niet ingeschreven voor cursussen.
                        <a href="{{ route('courses.index') }}" class="text-blue-500 hover:text-blue-700">
                            Bekijk beschikbare cursussen
                        </a>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($courses as $course)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            @if($course->image)
                                <img src="{{ Storage::url($course->image) }}" 
                                     alt="{{ $course->title }}" 
                                     class="w-full h-48 object-cover">
                            @endif
                            <div class="p-6">
                                <h2 class="text-xl font-semibold mb-2">{{ $course->title }}</h2>
                                <p class="text-gray-600 mb-4">{{ Str::limit($course->description, 150) }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-500">Voortgang: 0%</span>
                                    <a href="{{ route('courses.show', $course) }}" 
                                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Doorgaan
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $courses->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>