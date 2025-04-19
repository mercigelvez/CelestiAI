<!-- resources/views/horoscopes/weekly.blade.php -->
@extends('layouts.base')

@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <!-- Mystical animations for background -->
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute left-1/4 top-1/2 w-64 h-64 rounded-full border border-purple-500 opacity-20 animate-pulse pointer-events-none"></div>
        <div class="absolute right-1/3 top-1/3 w-96 h-96 rounded-full border border-indigo-400 opacity-20 animate-pulse pointer-events-none" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-1/4 left-1/2 w-80 h-80 rounded-full border border-blue-300 opacity-20 animate-pulse pointer-events-none" style="animation-delay: 2s;"></div>
    </div>

    <div class="relative z-10 max-w-5xl mx-auto">
        <!-- Header section -->
        <div class="text-center mb-12">
            <div class="text-6xl mb-4">{{ getZodiacSymbol(auth()->user()->zodiac_sign) }}</div>
            <h1 class="text-4xl font-['Cormorant_Garamond'] font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-300 to-indigo-400">
                {{ auth()->user()->zodiac_sign }} Weekly Forecast
            </h1>
            <p class="mt-3 text-xl text-purple-200">
                Week of {{ \Carbon\Carbon::parse($horoscope->date)->format('F j') }} - {{ \Carbon\Carbon::parse($horoscope->date)->addDays(6)->format('F j, Y') }}
            </p>
            <p class="mt-2 text-md text-purple-300">
                {{ getZodiacDateRange(auth()->user()->zodiac_sign) }}
            </p>
        </div>

        <!-- Horoscope content -->
        <div class="bg-black bg-opacity-30 backdrop-filter backdrop-blur-sm rounded-xl p-8 border border-purple-800 mb-8">
            <div class="prose prose-invert max-w-none">
                <p class="text-xl text-purple-200 leading-relaxed">
                    {{ $horoscope->description }}
                </p>

                <!-- Weekly focus areas -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                    <!-- Love Focus -->
                    <div class="bg-black bg-opacity-30 p-6 rounded-xl border border-pink-800">
                        <h3 class="text-xl font-medium text-pink-400 mb-3">Love & Relationships</h3>
                        <div class="flex mb-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 {{ $i <= $horoscope->love_rating ? 'text-pink-500' : 'text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @endfor
                        </div>
                        <p class="text-purple-200">
                            @if($horoscope->love_rating >= 4)
                                A powerful week for emotional connections. Open your heart to new possibilities and deepen existing bonds.
                            @elseif($horoscope->love_rating >= 2)
                                A steady week for relationships. Focus on clear communication and patience with loved ones.
                            @else
                                Take time for self-reflection this week. Relationship challenges offer opportunities for growth.
                            @endif
                        </p>
                    </div>

                    <!-- Career Focus -->
                    <div class="bg-black bg-opacity-30 p-6 rounded-xl border border-yellow-800">
                        <h3 class="text-xl font-medium text-yellow-400 mb-3">Career & Finance</h3>
                        <div class="flex mb-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 {{ $i <= $horoscope->career_rating ? 'text-yellow-500' : 'text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @endfor
                        </div>
                        <p class="text-purple-200">
                            @if($horoscope->career_rating >= 4)
                                Excellent timing for professional initiatives. Your efforts receive recognition, and financial prospects look promising.
                            @elseif($horoscope->career_rating >= 2)
                                A balanced week for work matters. Focus on organization and steady progress toward your goals.
                            @else
                                Review your priorities and adjust strategies. Temporary obstacles lead to better long-term approaches.
                            @endif
                        </p>
                    </div>

                    <!-- Wellness Focus -->
                    <div class="bg-black bg-opacity-30 p-6 rounded-xl border border-green-800">
                        <h3 class="text-xl font-medium text-green-400 mb-3">Health & Wellness</h3>
                        <div class="flex mb-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5 {{ $i <= $horoscope->wellness_rating ? 'text-green-500' : 'text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @endfor
                        </div>
                        <p class="text-purple-200">
                            @if($horoscope->wellness_rating >= 4)
                                Vibrant energy flows this week. Excellent time for new wellness routines and physical activities.
                            @elseif($horoscope->wellness_rating >= 2)
                                Maintain balance between rest and activity. Pay attention to your body's signals.
                            @else
                                Focus on restoration and self-care. Address any persistent issues with appropriate professionals.
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Lucky elements -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                    <div class="text-center p-4 bg-purple-900 bg-opacity-30 rounded-lg">
                        <h3 class="text-lg font-medium text-purple-300 mb-2">Lucky Number</h3>
                        <p class="text-3xl font-bold text-indigo-300">{{ $horoscope->lucky_number }}</p>
                    </div>
                    <div class="text-center p-4 bg-purple-900 bg-opacity-30 rounded-lg">
                        <h3 class="text-lg font-medium text-purple-300 mb-2">Lucky Color</h3>
                        <p class="text-3xl font-bold text-indigo-300">{{ $horoscope->lucky_color }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Planetary positions -->
        <div class="bg-black bg-opacity-30 backdrop-filter backdrop-blur-sm rounded-xl p-8 border border-purple-800 mb-8">
            <h2 class="text-2xl font-['Cormorant_Garamond'] font-bold text-purple-300 mb-6">Celestial Influences This Week</h2>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-purple-800">
                            <th class="px-4 py-2 text-left text-purple-300">Planet</th>
                            <th class="px-4 py-2 text-left text-purple-300">Position</th>
                            <th class="px-4 py-2 text-left text-purple-300">Influence</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-purple-800">
                        @foreach($planetaryPositions as $planet => $data)
                        <tr>
                            <td class="px-4 py-3 text-purple-200">{{ $planet }}</td>
                            <td class="px-4 py-3 text-purple-200">{{ $data['sign'] }} {{ $data['degree'] }}°</td>
                            <td class="px-4 py-3 text-purple-200">
                                @switch($planet)
                                    @case('Sun')
                                        Illuminates your core identity and purpose.
                                        @break
                                    @case('Moon')
                                        Shapes your emotional landscape and intuition.
                                        @break
                                    @case('Mercury')
                                        Influences communication and information processing.
                                        @break
                                    @case('Venus')
                                        Affects relationships, values, and aesthetics.
                                        @break
                                    @case('Mars')
                                        Drives your energy, ambition, and initiative.
                                        @break
                                    @case('Jupiter')
                                        Expands opportunities and philosophical outlook.
                                        @break
                                    @case('Saturn')
                                        Structures responsibilities and long-term lessons.
                                        @break
                                    @default
                                        Adds cosmic energy to your chart.
                                @endswitch
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex justify-between mt-8">
            <a href="{{ route('horoscopes.daily') }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-black bg-opacity-30 border border-purple-800 text-purple-300 hover:border-purple-600 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                </svg>
                Daily Horoscope
            </a>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-gradient-to-r from-purple-500 to-indigo-600 text-white hover:from-purple-600 hover:to-indigo-700 transition-all">
                Back to Dashboard
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </a>
        </div>
    </div>
</div>
@endsection
