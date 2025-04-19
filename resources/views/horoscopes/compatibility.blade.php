    <!-- resources/views/horoscopes/compatibility.blade.php -->
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

            <div class="relative z-10 max-w-5xl mx-auto">
                <!-- Header section -->
                <div class="text-center mb-12">
                    <h1
                        class="text-4xl font-['Cormorant_Garamond'] font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-300 to-indigo-400">
                        Astrological Compatibility
                    </h1>
                    <p class="mt-3 text-xl text-purple-200">
                        Discover how the stars align between zodiac signs
                    </p>
                </div>

                <!-- Compatibility calculator -->
                <div
                    class="bg-black bg-opacity-30 backdrop-filter backdrop-blur-sm rounded-xl p-8 border border-purple-800 mb-12">
                    <h2 class="text-2xl font-['Cormorant_Garamond'] font-bold text-purple-300 mb-6">Compatibility Calculator
                    </h2>

                    <form action="{{ route('horoscopes.compatibility.calculate') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- First Sign -->
                            <div>
                                <label class="block text-purple-200 mb-3">First Sign</label>
                                <div class="relative">
                                    <select name="sign1"
                                        class="w-full px-4 py-3 bg-black bg-opacity-50 text-purple-200 rounded-lg border border-purple-600 focus:border-indigo-400 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                                        @if ($userSign)
                                            <option value="{{ $userSign }}">{{ $userSign }} (Your Sign)</option>
                                        @endif
                                        @foreach ($zodiacSigns as $sign)
                                            @if ($sign != $userSign)
                                                <option value="{{ $sign }}">{{ $sign }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="absolute top-0 right-0 px-4 py-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-purple-300" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Second Sign -->
                            <div>
                                <label class="block text-purple-200 mb-3">Second Sign</label>
                                <div class="relative">
                                    <select name="sign2"
                                        class="w-full px-4 py-3 bg-black bg-opacity-50 text-purple-200 rounded-lg border border-purple-600 focus:border-indigo-400 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                                        @foreach ($zodiacSigns as $sign)
                                            <option value="{{ $sign }}">{{ $sign }}</option>
                                        @endforeach
                                    </select>
                                    <div class="absolute top-0 right-0 px-4 py-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-purple-300" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit"
                                class="px-8 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg shadow-lg hover:from-purple-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 transform transition-all duration-300 hover:scale-105">
                                Calculate Compatibility
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Compatibility Chart -->
                @if (isset($compatibilityData) && count($compatibilityData) > 0)
                    <div
                        class="bg-black bg-opacity-30 backdrop-filter backdrop-blur-sm rounded-xl p-8 border border-purple-800">
                        <h2 class="text-2xl font-['Cormorant_Garamond'] font-bold text-purple-300 mb-6">Your Compatibility
                            Chart</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($compatibilityData as $sign => $data)
                                <div
                                    class="p-5 bg-gradient-to-br from-purple-900 to-indigo-900 bg-opacity-50 rounded-lg border border-purple-700 hover:border-indigo-400 transition-all duration-300">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center">
                                            <span
                                                class="text-xl font-['Cormorant_Garamond'] font-bold text-purple-200">{{ $userSign }}
                                                + {{ $sign }}</span>
                                        </div>
                                        <div class="text-2xl font-bold text-indigo-300">{{ $data['score'] }}/10</div>
                                    </div>

                                    <div class="space-y-3">
                                        <div class="flex items-center">
                                            <span class="w-24 text-purple-300">Romance:</span>
                                            <div class="flex-1 bg-purple-900 bg-opacity-40 rounded-full h-2 ml-2">
                                                <div class="bg-gradient-to-r from-pink-400 to-purple-500 h-2 rounded-full"
                                                    style="width: {{ $data['areas']['romance'] * 10 }}%"></div>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            <span class="w-24 text-purple-300">Friendship:</span>
                                            <div class="flex-1 bg-purple-900 bg-opacity-40 rounded-full h-2 ml-2">
                                                <div class="bg-gradient-to-r from-blue-400 to-indigo-500 h-2 rounded-full"
                                                    style="width: {{ $data['areas']['friendship'] * 10 }}%"></div>
                                            </div>
                                        </div>
                                        <div class="flex items-center">
                                            <span class="w-24 text-purple-300">Trust:</span>
                                            <div class="flex-1 bg-purple-900 bg-opacity-40 rounded-full h-2 ml-2">
                                                <div class="bg-gradient-to-r from-green-400 to-teal-500 h-2 rounded-full"
                                                    style="width: {{ $data['areas']['trust'] * 10 }}%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Information Section -->
                <div
                    class="bg-black bg-opacity-30 backdrop-filter backdrop-blur-sm rounded-xl p-8 border border-purple-800 mt-12">
                    <h2 class="text-2xl font-['Cormorant_Garamond'] font-bold text-purple-300 mb-6">Understanding
                        Astrological Compatibility</h2>

                    <div class="prose prose-lg max-w-none text-purple-200">
                        <p>Astrological compatibility, also known as synastry, examines how individuals interact with one
                            another based on the positions of planets in their birth charts. While sun sign compatibility
                            provides a quick overview, true astrological compatibility considers many factors:</p>

                        <ul class="list-disc pl-5 space-y-2 mt-4">
                            <li><span class="text-indigo-300 font-semibold">Sun Signs</span> - Represent core personality
                                and ego</li>
                            <li><span class="text-indigo-300 font-semibold">Moon Signs</span> - Reveal emotional needs and
                                instinctive reactions</li>
                            <li><span class="text-indigo-300 font-semibold">Venus Signs</span> - Show how you express love
                                and what you value</li>
                            <li><span class="text-indigo-300 font-semibold">Mars Signs</span> - Indicate sexual
                                compatibility and how you take action</li>
                            <li><span class="text-indigo-300 font-semibold">Mercury Signs</span> - Determine communication
                                styles</li>
                        </ul>

                        <p class="mt-6">The aspects (angles) between planets in two charts also reveal important dynamics.
                            Harmonious aspects (trines, sextiles) indicate natural flow, while challenging aspects (squares,
                            oppositions) may create friction but also growth.</p>

                        <p class="mt-4">Remember that astrological compatibility is just one tool for understanding
                            relationships. Personal growth, shared values, and communication skills are equally important
                            factors in creating harmonious connections.</p>
                    </div>
                </div>
            </div>
        </div>
    @endsection
