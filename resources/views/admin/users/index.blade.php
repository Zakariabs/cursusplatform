<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gebruikersbeheer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md">
                            Nieuwe gebruiker
                        </a>
                    </div>

                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left">Naam</th>
                                <th class="px-6 py-3 text-left">Email</th>
                                <th class="px-6 py-3 text-left">Admin</th>
                                <th class="px-6 py-3 text-left">Acties</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="px-6 py-4">{{ $user->name }}</td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                    <td class="px-6 py-4">{{ $user->is_admin ? 'Ja' : 'Nee' }}</td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('admin.users.toggle', $user) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-blue-600 hover:underline">
                                                {{ $user->is_admin ? 'Verwijder admin' : 'Maak admin' }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>