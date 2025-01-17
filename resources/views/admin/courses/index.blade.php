
<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cursussen Beheren') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <a href="{{ route('admin.courses.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Nieuwe Cursus
                    </a>
                    <div class="mt-6">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-2">Titel</th>
                                    <th class="py-2">Moeilijkheidsgraad</th>
                                    <th class="py-2">Duur (weken)</th>
                                    <th class="py-2">Acties</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($courses as $course)
                                    <tr>
                                        <td class="py-2">{{ $course->title }}</td>
                                        <td class="py-2">{{ ucfirst($course->difficulty_level) }}</td>
                                        <td class="py-2">{{ $course->duration_weeks }}</td>
                                        <td class="py-2">
                                            <a href="{{ route('admin.courses.edit', $course) }}" class="text-yellow-500 hover:underline">Bewerken</a>
                                            <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Weet je zeker dat je deze cursus wilt verwijderen?')">
                                                    Verwijderen
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-6">
                            {{ $courses->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>