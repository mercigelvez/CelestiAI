<!-- resources/views/readings/create.blade.php -->
@extends('layouts.base')

@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <!-- Mystical animations for background -->
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute left-1/4 top-1/2 w-64 h-64 rounded-full border border-purple-500 opacity-20 animate-pulse pointer-events-none"></div>
        <div class="absolute right-1/3 top-1/3 w-96 h-96 rounded-full border border-indigo-400 opacity-20 animate-pulse pointer-events-none" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-1/4 left-1/2 w-80 h-80 rounded-full border border-blue-300 opacity-20 animate-pulse pointer-events-none" style="animation-delay: 2s;"></div>
    </div>

    <div class="relative z-10 max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-['Cormorant_Garamond'] font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-300 to-indigo-400">
                Create Your Reading
            </h1>
            <p class="mt-3 text-xl text-purple-200">
                Focus your mind, set your intention, and let the cards reveal their wisdom
            </p>
        </div>

        <!-- Reading form -->
        <div class="bg-black bg-opacity-30 backdrop-filter backdrop-blur-sm rounded-xl p-8 border border-purple-800">
            <form action="{{ route('readings.store') }}" method="POST">
                @csrf

                <!-- Spread selection -->
                <div class="mb-8">
                    <h2 class="text-2xl font-['Cormorant_Garamond'] font-bold text-purple-300 mb-4">Choose Your Spread</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($spreads as $key => $spread)
                        <div class="relative">
                            <input type="radio" id="spread_{{ $key }}" name="spread_type" value="{{ $key }}"
                                class="absolute opacity-0 w-full h-full cursor-pointer z-10 peer"
                                {{ $spreadType == $key ? 'checked' : '' }}>
                            <label for="spread_{{ $key }}"
                                class="block p-4 rounded-lg border border-purple-700 bg-black bg-opacity-20 cursor-pointer transition-all
                                       hover:border-purple-500 hover:bg-opacity-30
                                       peer-checked:border-purple-400 peer-checked:bg-purple-900 peer-checked:bg-opacity-30">
                                <div class="text-xl font-semibold text-purple-300 mb-1">{{ $spread['name'] }}</div>
                                <div class="text-sm text-purple-200">{{ $spread['description'] }}</div>
                                <div class="text-xs text-purple-300 mt-2">{{ $spread['positions'] }} cards</div>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Question input -->
                <div class="mb-8">
                    <h2 class="text-2xl font-['Cormorant_Garamond'] font-bold text-purple-300 mb-4">Your Question</h2>
                    <div class="relative">
                        <textarea name="question" id="question" rows="3"
                            class="w-full bg-black bg-opacity-50 border border-purple-700 rounded-lg p-4 text-purple-100 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                            placeholder="What guidance do you seek from the universe?">{{ old('question') }}</textarea>
                        <div class="text-xs text-purple-300 mt-2">Leave blank for a general reading</div>
                    </div>
                </div>

                <!-- Ritual guidance -->
                <div class="mb-8 p-6 border border-purple-700 rounded-lg bg-gradient-to-r from-purple-900 to-indigo-900 bg-opacity-30">
                    <h3 class="text-xl font-['Cormorant_Garamond'] font-bold text-purple-300 mb-2">Prepare Your Space</h3>
                    <p class="text-purple-200 mb-4">For the most powerful reading, we recommend:</p>
                    <ul class="text-purple-200 space-y-2">
                        <li class="flex items-start">
                            <span class="text-purple-400 mr-2">✧</span>
                            <span>Finding a quiet space where you won't be disturbed</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-purple-400 mr-2">✧</span>
                            <span>Taking a few deep breaths to center yourself</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-purple-400 mr-2">✧</span>
                            <span>Setting a clear intention for your reading</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-purple-400 mr-2">✧</span>
                            <span>Approaching the cards with an open mind and heart</span>
                        </li>
                    </ul>
                </div>

                <!-- Submit button -->
                <div class="text-center">
                    <button type="submit"
                        class="py-4 px-10 rounded-lg bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-medium
                               hover:from-purple-600 hover:to-indigo-700 transition-all shadow-lg hover:shadow-xl
                               transform hover:-translate-y-1">
                        Draw Your Cards
                    </button>
                </div>
            </form>
        </div>

        <!-- Back to dashboard -->
        <div class="mt-8 text-center">
            <a href="{{ route('dashboard') }}" class="text-indigo-400 hover:text-indigo-300 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Return to Dashboard
            </a>
        </div>
    </div>
</div>
@endsection
