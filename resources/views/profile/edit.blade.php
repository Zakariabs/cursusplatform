<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profiel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Profielfoto Section -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Profielfoto') }}
                            </h2>
                        </header>

                        <form method="post" action="{{ route('profile.photo') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            
                            @if($user->profile_photo)
                                <div class="mt-2">
                                    <img src="{{ Storage::url($user->profile_photo) }}" alt="Profile" class="w-32 h-32 rounded-full object-cover">
                                </div>
                            @endif

                            <div>
                                <x-input-label for="profile_photo" value="Nieuwe foto" />
                                <x-text-input id="profile_photo" name="profile_photo" type="file" class="mt-1 block w-full" />
                                <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Opslaan') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            <!-- Profile Information -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>