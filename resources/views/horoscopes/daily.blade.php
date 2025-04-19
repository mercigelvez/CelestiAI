<!-- resources/views/horoscopes/daily.blade.php -->
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
                {{ auth()->user()->zodiac_sign }} Daily Horoscope
            </h1>
            <p class="mt-3 text-xl text-purple-200">
                {{ $horoscope->formatted_date }}
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

                <!-- Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                    <!-- Love Rating -->
                    <div class="text-center">
                        <h3 class="text-lg font-medium text-purple-300 mb-2">Love & Relationships</h3>
                        <div class="flex justify-center">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-6 h-6 {{ $i <= $horoscope->love_rating ? 'text-pink-500' : 'text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @endfor
                        </div>
                    </div>

                    <!-- Career Rating -->
                    <div class="text-center">
                        <h3 class="text-lg font-medium text-purple-300 mb-2">Career & Finance</h3>
                        <div class="flex justify-center">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-6 h-6 {{ $i <= $horoscope->career_rating ? 'text-yellow-500' : 'text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @endfor
                        </div>
                    </div>

                    <!-- Wellness Rating -->
                    <div class="text-center">
                        <h3 class="text-lg font-medium text-purple-300 mb-2">Health & Wellness</h3>
                        <div class="flex justify-center">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-6 h-6 {{ $i <= $horoscope->wellness_rating ? 'text-green-500' : 'text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @endfor
                        </div>
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

        <!-- Compatibility -->
        <div class="bg-black bg-opacity-30 backdrop-filter backdrop-blur-sm rounded-xl p-8 border border-purple-800 mb-8">
            <h2 class="text-2xl font-['Cormorant_Garamond'] font-bold text-purple-300 mb-4">Compatibility Today</h2>

            <div class="space-y-4">
                <div class="flex items-center space-x-4">
                    <span class="text-lg font-medium text-purple-200">Best match with:</span>
                    <span class="text-lg text-indigo-300">{{ $compatibility['Best match'] }} signs</span>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-lg font-medium text-purple-200">Good match with:</span>
                    <span class="text-lg text-indigo-300">{{ $compatibility['Good match'] }} signs</span>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-lg font-medium text-purple-200">Challenging match with:</span>
                    <span class="text-lg text-indigo-300">{{ $compatibility['Challenge'] }} signs</span>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('horoscopes.compatibility') }}" class="inline-block px-6 py-2 rounded-lg bg-purple-600 bg-opacity-50 text-white hover:bg-opacity-70 transition-all">
                    Explore Detailed Compatibility
                </a>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex justify-between mt-8">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-black bg-opacity-30 border border-purple-800 text-purple-300 hover:border-purple-600 transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                </svg>
                Back to Dashboard
            </a>
            <a href="{{ route('horoscopes.weekly') }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-gradient-to-r from-purple-500 to-indigo-600 text-white hover:from-purple-600 hover:to-indigo-700 transition-all">
                View Weekly Forecast
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </a>
        </div>
    </div>
</div>
@endsection
