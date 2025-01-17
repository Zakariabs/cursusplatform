
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h1 class="text-4xl font-bold mb-4">Welkom bij het AI Cursusplatform</h1>
                    <p class="text-xl text-gray-600">Ontdek onze cursussen en resources over Artificële Intelligentie</p>
                </div>
            </div>

            <!-- Quick Links Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
                <!-- Courses Section -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold mb-4">AI Cursussen</h2>
                        <p class="text-gray-600 mb-4">Bekijk ons aanbod van AI cursussen</p>
                        <a href="{{ route('courses.index') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Bekijk Cursussen
                        </a>
                    </div>
                </div>
            
            <!-- News Section -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold mb-4">Laatste Nieuws</h2>
                        <p class="text-gray-600 mb-4">Blijf op de hoogte van het laatste AI nieuws</p>
                        <a href="{{ route('news.index') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Bekijk Nieuws
                        </a>
                    </div>
                </div>

                <!-- FAQ Section -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold mb-4">FAQ</h2>
                        <p class="text-gray-600 mb-4">Vind antwoorden op veelgestelde vragen</p>
                        <a href="{{ route('faq.index') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Bekijk FAQ
                        </a>
                    </div>
                </div>

                <!-- Contact Section -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold mb-4">Contact</h2>
                        <p class="text-gray-600 mb-4">Neem contact met ons op voor vragen</p>
                        <a href="{{ route('contact.create') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Contact Opnemen
                        </a>
                    </div>
                </div>
            </div>

            <!-- Login/Register Call to Action -->
            @guest
                <div class="mt-6 bg-blue-50 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold mb-4">Word lid van ons platform</h2>
                        <p class="text-gray-600 mb-4">Registreer om toegang te krijgen tot alle cursussen en meer!</p>
                        <div class="space-x-4">
                            <a href="{{ route('login') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Inloggen
                            </a>
                            <a href="{{ route('register') }}" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Registreren
                            </a>
                        </div>
                    </div>
                </div>
            @endguest
        </div>
    </div>
</x-app-layout>