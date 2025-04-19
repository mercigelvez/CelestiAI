<!-- resources/views/horoscopes/compatibility_result.blade.php -->
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
                    {{ $sign1 }} + {{ $sign2 }} Compatibility
                </h1>
                <p class="mt-3 text-xl text-purple-200">
                    Celestial Connection: {{ $compatibility['score'] }}/10
                </p>
            </div>

            <!-- Main compatibility result -->
            <div
                class="bg-black bg-opacity-30 backdrop-filter backdrop-blur-sm rounded-xl p-8 border border-purple-800 mb-12">
                <!-- Compatibility visualization -->
                <div class="flex justify-center mb-10">
                    <div class="relative w-64 h-64">
                        <!-- Circular progress indicator -->
                        <svg class="w-full h-full" viewBox="0 0 100 100">
                            <circle cx="50" cy="50" r="45" fill="none" stroke="#2D1B69" stroke-width="8" />
                            <circle cx="50" cy="50" r="45" fill="none" stroke-linecap="round"
                                stroke="#9C6FEB" stroke-width="8" stroke-dasharray="283"
                                stroke-dashoffset="{{ 283 - 283 * ($compatibility['score'] / 10) }}"
                                transform="rotate(-90 50 50)" />
                            <text x="50" y="50" text-anchor="middle" dominant-baseline="middle" fill="#fff"
                                font-size="24" font-weight="bold" font-family="Cormorant Garamond">
                                {{ $compatibility['score'] }}/10
                            </text>
                        </svg>

                        <!-- Sign symbols -->
                        <div
                            class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-indigo-900 rounded-full p-3 border-2 border-purple-500">
                            <span class="text-2xl text-white">♈</span> <!-- Replace with actual zodiac symbol -->
                        </div>
                        <div
                            class="absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1/2 bg-indigo-900 rounded-full p-3 border-2 border-purple-500">
                            <span class="text-2xl text-white">♉</span> <!-- Replace with actual zodiac symbol -->
                        </div>
                    </div>
                </div>

                <!-- Compatibility Description -->
                <div class="mb-12">
                    <h2 class="text-2xl font-['Cormorant_Garamond'] font-bold text-purple-300 mb-4">Overview</h2>
                    <p class="text-lg text-purple-200">
                        {{ $compatibility['description'] }}
                    </p>
                </div>

                <!-- Compatibility Areas -->
                <div>
                    <h2 class="text-2xl font-['Cormorant_Garamond'] font-bold text-purple-300 mb-6">Compatibility by Area
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Romance -->
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <h3 class="text-xl text-indigo-300">Romance</h3>
                                <span
                                    class="text-lg font-bold text-white">{{ $compatibility['areas']['romance'] }}/10</span>
                            </div>
                            <div class="w-full bg-purple-900 bg-opacity-40 rounded-full h-3">
                                <div class="bg-gradient-to-r from-pink-400 to-purple-500 h-3 rounded-full"
                                    style="width: {{ $compatibility['areas']['romance'] * 10 }}%"></div>
                            </div>
                            <p class="mt-3 text-purple-200">
                                @if ($compatibility['areas']['romance'] >= 8)
                                    Your romantic connection is magnetic and passionate. There's a natural attraction
                                    between you that creates excitement and intensity.
                                @elseif($compatibility['areas']['romance'] >= 6)
                                    Your romantic connection has good potential with effort from both sides. You may need to
                                    work on understanding each other's love languages.
                                @else
                                    Your romantic styles differ significantly. This can create challenges, but also
                                    opportunities for growth if you're willing to adapt.
                                @endif
                            </p>
                        </div>

                        <!-- Friendship -->
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <h3 class="text-xl text-indigo-300">Friendship</h3>
                                <span
                                    class="text-lg font-bold text-white">{{ $compatibility['areas']['friendship'] }}/10</span>
                            </div>
                            <div class="w-full bg-purple-900 bg-opacity-40 rounded-full h-3">
                                <div class="bg-gradient-to-r from-blue-400 to-indigo-500 h-3 rounded-full"
                                    style="width: {{ $compatibility['areas']['friendship'] * 10 }}%"></div>
                            </div>
                            <p class="mt-3 text-purple-200">
                                @if ($compatibility['areas']['friendship'] >= 8)
                                    You enjoy a natural rapport that makes spending time together easy and rewarding.
                                    There's mutual respect and understanding.
                                @elseif($compatibility['areas']['friendship'] >= 6)
                                    Your friendship has solid foundations but may require effort to maintain harmony during
                                    challenging times.
                                @else
                                    Your different approaches to social interaction can create misunderstandings. Finding
                                    common ground will strengthen your bond.
                                @endif
                            </p>
                        </div>

                        <!-- Communication -->
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <h3 class="text-xl text-indigo-300">Communication</h3>
                                <span
                                    class="text-lg font-bold text-white">{{ $compatibility['areas']['communication'] }}/10</span>
                            </div>
                            <div class="w-full bg-purple-900 bg-opacity-40 rounded-full h-3">
                                <div class="bg-gradient-to-r from-yellow-400 to-orange-500 h-3 rounded-full"
                                    style="width: {{ $compatibility['areas']['communication'] * 10 }}%"></div>
                            </div>
                            <p class="mt-3 text-purple-200">
                                @if ($compatibility['areas']['communication'] >= 8)
                                    Words flow easily between you, with natural understanding and connection. You're able to
                                    express thoughts and feelings clearly.
                                @elseif($compatibility['areas']['communication'] >= 6)
                                    You generally communicate well but may occasionally misinterpret each other's
                                    intentions. Patience helps overcome these moments.
                                @else
                                    Your communication styles differ significantly. Active listening and clarification will
                                    be essential for avoiding misunderstandings.
                                @endif
                            </p>
                        </div>

                        <!-- Trust -->
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <h3 class="text-xl text-indigo-300">Trust</h3>
                                <span class="text-lg font-bold text-white">{{ $compatibility['areas']['trust'] }}/10</span>
                            </div>
                            <div class="w-full bg-purple-900 bg-opacity-40 rounded-full h-3">
                                <div class="bg-gradient-to-r from-green-400 to-teal-500 h-3 rounded-full"
                                    style="width: {{ $compatibility['areas']['trust'] * 10 }}%"></div>
                            </div>
                            <p class="mt-3 text-purple-200">
                                @if ($compatibility['areas']['trust'] >= 8)
                                    Trust comes naturally in this relationship. You both feel secure and can depend on each
                                    other through challenges.
                                @elseif($compatibility['areas']['trust'] >= 6)
                                    Trust can be built over time with consistency and honesty. Pay attention to keeping your
                                    word and being reliable.
                                @else
                                    Building trust may require extra effort. Different values or approaches can create
                                    uncertainty that needs addressing.
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tips Section -->
            <div class="bg-black bg-opacity-30 backdrop-filter backdrop-blur-sm rounded-xl p-8 border border-purple-800">
                <h2 class="text-2xl font-['Cormorant_Garamond'] font-bold text-purple-300 mb-6">How to Enhance Your
                    Compatibility</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-indigo-900 bg-opacity-40 p-6 rounded-lg border border-indigo-800">
                        <h3 class="text-xl font-['Cormorant_Garamond'] text-indigo-300 mb-4">Focus on Strengths</h3>
                        <p class="text-purple-200">
                            Your {{ $sign1 }}-{{ $sign2 }} connection thrives when you emphasize these
                            natural strengths:
                        </p>
                        <ul class="list-disc pl-5 space-y-2 mt-3 text-purple-200">
                            @if (in_array($sign1, ['Aries', 'Leo', 'Sagittarius']) && in_array($sign2, ['Aries', 'Leo', 'Sagittarius']))
                                <li>Shared enthusiasm and passion for new adventures</li>
                                <li>Mutual respect for independence and personal growth</li>
                                <li>Dynamic energy that keeps the relationship exciting</li>
                            @elseif(in_array($sign1, ['Taurus', 'Virgo', 'Capricorn']) && in_array($sign2, ['Taurus', 'Virgo', 'Capricorn']))
                                <li>Mutual appreciation for stability and security</li>
                                <li>Shared practical approach to life and relationships</li>
                                <li>Building something lasting and meaningful together</li>
                            @elseif(in_array($sign1, ['Gemini', 'Libra', 'Aquarius']) && in_array($sign2, ['Gemini', 'Libra', 'Aquarius']))
                                <li>Intellectual stimulation and engaging conversations</li>
                                <li>Appreciation for social connections and friendship</li>
                                <li>Innovative approaches to solving problems together</li>
                            @elseif(in_array($sign1, ['Cancer', 'Scorpio', 'Pisces']) && in_array($sign2, ['Cancer', 'Scorpio', 'Pisces']))
                                <li>Deep emotional connection and intuitive understanding</li>
                                <li>Nurturing and supportive relationship dynamic</li>
                                <li>Creative expression and shared sensitivity</li>
                            @else
                                <li>Complementary perspectives that expand your worldview</li>
                                <li>Learning from each other's different approaches</li>
                                <li>Creating balance through your diverse strengths</li>
                            @endif
                        </ul>
                    </div>

                    <div class="bg-indigo-900 bg-opacity-40 p-6 rounded-lg border border-indigo-800">
                        <h3 class="text-xl font-['Cormorant_Garamond'] text-indigo-300 mb-4">Navigate Challenges</h3>
                        <p class="text-purple-200">
                            Be mindful of these potential friction points in your {{ $sign1 }}-{{ $sign2 }}
                            relationship:
                        </p>
                        <ul class="list-disc pl-5 space-y-2 mt-3 text-purple-200">
                            @if (in_array($sign1, ['Aries', 'Leo', 'Sagittarius']) && in_array($sign2, ['Cancer', 'Scorpio', 'Pisces']))
                                <li>Balancing emotional needs with desire for independence</li>
                                <li>Finding common ground between action and feeling</li>
                                <li>Managing differences in energy levels and expression</li>
                            @elseif(in_array($sign1, ['Taurus', 'Virgo', 'Capricorn']) && in_array($sign2, ['Gemini', 'Libra', 'Aquarius']))
                                <li>Reconciling practical concerns with idealistic visions</li>
                                <li>Respecting different paces and approaches to change</li>
                                <li>Finding flexibility within structure</li>
                            @elseif($compatibility['score'] < 6)
                                <li>Practice active listening without interrupting</li>
                                <li>Acknowledge and respect fundamental differences</li>
                                <li>Create space for individual expression and needs</li>
                            @else
                                <li>Maintain open communication during conflicts</li>
                                <li>Appreciate your different perspectives as opportunities</li>
                                <li>Balance compromise with honoring your authentic selves</li>
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <a href="{{ route('horoscopes.compatibility') }}"
                        class="inline-block px-8 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg shadow-lg hover:from-purple-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50 transform transition-all duration-300 hover:scale-105">
                        Calculate Another Compatibility
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
