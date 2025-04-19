<!-- resources/views/dashboard.blade.php -->
@extends('layouts.base')

@section('content')
    <div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <!-- Mystical animations for background -->
        <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
            <div
                class="absolute left-1/4 top-1/2 w-64 h-64 rounded-full border border-purple-500 opacity-20 animate-pulse pointer-events-none">
            </div>
            <div class="absolute right-1/3 top-1/3 w-96 h-96 rounded-full border border-indigo-400 opacity-20 animate-pulse pointer-events-none"
                style="animation-delay: 1s;"></div>
            <div class="absolute bottom-1/4 left-1/2 w-80 h-80 rounded-full border border-blue-300 opacity-20 animate-pulse pointer-events-none"
                style="animation-delay: 2s;"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto">
            <!-- Welcome section -->
            <div class="text-center mb-12">
                <h1
                    class="text-4xl font-['Cormorant_Garamond'] font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-300 to-indigo-400">
                    Welcome, {{ auth()->user()->name }}
                </h1>
                <p class="mt-3 text-xl text-purple-200">
                    What cosmic insights are you seeking today?
                </p>
            </div>

            <!-- Quick actions -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <div
                    class="bg-black bg-opacity-30 backdrop-filter backdrop-blur-sm rounded-xl p-6 border border-purple-800 hover:border-purple-600 transition-all">
                    <h2 class="text-2xl font-['Cormorant_Garamond'] font-bold text-purple-300 mb-4">Quick Reading</h2>
                    <p class="text-purple-200 mb-6">Need a fast insight? Draw a single card for immediate guidance.</p>
                    <form action="{{ route('readings.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="spread_type" value="single">
                        <input type="hidden" name="question" value="What should I focus on right now?">
                        <button type="submit"
                            class="w-full py-3 rounded-lg bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-medium hover:from-purple-600 hover:to-indigo-700 transition-all shadow-lg hover:shadow-xl">
                            Draw a Card
                        </button>
                    </form>
                </div>

                <div
                    class="bg-black bg-opacity-30 backdrop-filter backdrop-blur-sm rounded-xl p-6 border border-purple-800 hover:border-purple-600 transition-all">
                    <h2 class="text-2xl font-['Cormorant_Garamond'] font-bold text-purple-300 mb-4">Past-Present-Future</h2>
                    <p class="text-purple-200 mb-6">See your journey through time with this classic three-card spread.</p>
                    <form action="{{ route('readings.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="spread_type" value="three-card">
                        <input type="hidden" name="question" value="How is my journey unfolding?">
                        <button type="submit"
                            class="w-full py-3 rounded-lg bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-medium hover:from-purple-600 hover:to-indigo-700 transition-all shadow-lg hover:shadow-xl">
                            Get Reading
                        </button>
                    </form>
                </div>
            </div>

            <!-- Reading options -->
            <h2
                class="text-2xl font-['Cormorant_Garamond'] font-bold text-center text-transparent bg-clip-text bg-gradient-to-r from-purple-300 to-indigo-400 mb-6">
                Explore Deeper Insights
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Celtic Cross -->
                <div
                    class="bg-black bg-opacity-30 backdrop-filter backdrop-blur-sm rounded-xl p-6 border border-purple-800 hover:border-purple-600 transition-all">
                    <div class="flex justify-center mb-4">
                        <div class="text-purple-300 text-4xl">🔮</div>
                    </div>
                    <h3 class="text-xl font-semibold text-center text-purple-200 mb-2">Celtic Cross</h3>
                    <p class="text-gray-300 mb-6 text-center">A comprehensive 10-card spread that explores your situation in
                        depth.</p>
                    <a href="{{ route('readings.create', ['spread' => 'celtic-cross']) }}"
                        class="block w-full py-2 text-center rounded-lg bg-purple-900 bg-opacity-50 text-white hover:bg-opacity-70 transition-all">
                        Select
                    </a>
                </div>

                <!-- Relationship Reading -->
                <div
                    class="bg-black bg-opacity-30 backdrop-filter backdrop-blur-sm rounded-xl p-6 border border-purple-800 hover:border-purple-600 transition-all">
                    <div class="flex justify-center mb-4">
                        <div class="text-purple-300 text-4xl">💫</div>
                    </div>
                    <h3 class="text-xl font-semibold text-center text-purple-200 mb-2">Relationship</h3>
                    <p class="text-gray-300 mb-6 text-center">Explore the energies, challenges and potential of a
                        relationship.</p>
                    <a href="{{ route('readings.create', ['spread' => 'relationship']) }}"
                        class="block w-full py-2 text-center rounded-lg bg-purple-900 bg-opacity-50 text-white hover:bg-opacity-70 transition-all">
                        Select
                    </a>
                </div>

                <!-- Career Path -->
                <div
                    class="bg-black bg-opacity-30 backdrop-filter backdrop-blur-sm rounded-xl p-6 border border-purple-800 hover:border-purple-600 transition-all">
                    <div class="flex justify-center mb-4">
                        <div class="text-purple-300 text-4xl">✨</div>
                    </div>
                    <h3 class="text-xl font-semibold text-center text-purple-200 mb-2">Career Path</h3>
                    <p class="text-gray-300 mb-6 text-center">Illuminate your professional journey and discover
                        opportunities ahead.</p>
                    <a href="{{ route('readings.create', ['spread' => 'career']) }}"
                        class="block w-full py-2 text-center rounded-lg bg-purple-900 bg-opacity-50 text-white hover:bg-opacity-70 transition-all">
                        Select
                    </a>
                </div>
            </div>

            <!-- Horoscope section -->
            <h2
                class="text-2xl font-['Cormorant_Garamond'] font-bold text-center text-transparent bg-clip-text bg-gradient-to-r from-purple-300 to-indigo-400 mb-6 mt-12">
                Celestial Horoscopes
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <div
                    class="bg-black bg-opacity-30 backdrop-filter backdrop-blur-sm rounded-xl p-6 border border-purple-800 hover:border-purple-600 transition-all">
                    <h2 class="text-2xl font-['Cormorant_Garamond'] font-bold text-purple-300 mb-4">Daily Horoscope</h2>
                    <p class="text-purple-200 mb-6">Receive cosmic guidance based on your zodiac sign's alignment with
                        today's celestial energies.</p>
                    <a href="{{ route('horoscopes.daily') }}"
                        class="block w-full py-3 text-center rounded-lg bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-medium hover:from-purple-600 hover:to-indigo-700 transition-all shadow-lg hover:shadow-xl">
                        View Today's Horoscope
                    </a>
                </div>

                <div
                    class="bg-black bg-opacity-30 backdrop-filter backdrop-blur-sm rounded-xl p-6 border border-purple-800 hover:border-purple-600 transition-all">
                    <h2 class="text-2xl font-['Cormorant_Garamond'] font-bold text-purple-300 mb-4">Weekly Forecast</h2>
                    <p class="text-purple-200 mb-6">Explore the planetary influences shaping your week ahead with detailed
                        insights.</p>
                    <a href="{{ route('horoscopes.weekly') }}"
                        class="block w-full py-3 text-center rounded-lg bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-medium hover:from-purple-600 hover:to-indigo-700 transition-all shadow-lg hover:shadow-xl">
                        See Weekly Forecast
                    </a>
                </div>
            </div>

            <!-- Astrological Compatibility -->
            <div class="bg-black bg-opacity-30 backdrop-filter backdrop-blur-sm rounded-xl p-8 border border-purple-800">
                <h2 class="text-2xl font-['Cormorant_Garamond'] font-bold text-purple-300 mb-4">Astrological Compatibility
                </h2>
                <p class="text-purple-200 mb-6">Discover how your stars align with others to reveal relationship dynamics
                    and potential.</p>

                <a href="{{ route('horoscopes.compatibility') }}"
                    class="inline-block px-6 py-3 rounded-lg bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-medium hover:from-purple-600 hover:to-indigo-700 transition-all shadow-lg hover:shadow-xl">
                    Explore Compatibility
                </a>
            </div>

            <!-- Custom reading section -->
            <div
                class="mt-12 bg-black bg-opacity-30 backdrop-filter backdrop-blur-sm rounded-xl p-8 border border-purple-800">
                <h2 class="text-2xl font-['Cormorant_Garamond'] font-bold text-purple-300 mb-4">Custom Reading</h2>
                <p class="text-purple-200 mb-6">Ask a specific question and choose your preferred spread for personalized
                    guidance.</p>

                <a href="{{ route('readings.create') }}"
                    class="inline-block px-6 py-3 rounded-lg bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-medium hover:from-purple-600 hover:to-indigo-700 transition-all shadow-lg hover:shadow-xl">
                    Create Custom Reading
                </a>
            </div>

            <!-- Recent readings -->
            @if (auth()->user()->readings()->count() > 0)
                <div class="mt-12">
                    <h2
                        class="text-2xl font-['Cormorant_Garamond'] font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-300 to-indigo-400 mb-6">
                        Your Recent Readings
                    </h2>

                    <div class="bg-black bg-opacity-30 backdrop-filter backdrop-blur-sm rounded-xl overflow-hidden">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-purple-800">
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-purple-300 uppercase tracking-wider">
                                        Date</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-purple-300 uppercase tracking-wider">
                                        Spread</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-purple-300 uppercase tracking-wider">
                                        Question</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-purple-300 uppercase tracking-wider">
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-purple-800">
                                @foreach (auth()->user()->readings()->latest()->take(5)->get() as $reading)
                                    <tr class="hover:bg-purple-900 hover:bg-opacity-20 transition-all">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-200">
                                            {{ $reading->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-200">
                                            {{ $reading->formatted_spread_type }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-purple-200 truncate max-w-xs">
                                            {{ $reading->question ?? 'General Reading' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('readings.show', $reading) }}"
                                                class="text-indigo-400 hover:text-indigo-300">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="px-6 py-4 border-t border-purple-800">
                            <a href="{{ route('readings.history') }}"
                                class="text-indigo-400 hover:text-indigo-300 flex items-center justify-center">
                                View All Readings
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
