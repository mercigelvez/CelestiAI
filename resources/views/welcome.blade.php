<!-- resources/views/welcome.blade.php -->
@extends('layouts.base')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center px-4 py-16">
    <!-- Mystical circles animation -->
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute inset-0 opacity-20 pointer-events-none">
            <div class="absolute top-1/4 left-1/4 w-64 h-64 rounded-full border border-purple-300 animate-pulse pointer-events-none"></div>
            <div class="absolute top-1/3 left-1/3 w-96 h-96 rounded-full border border-indigo-400 animate-pulse pointer-events-none" style="animation-delay: 1s;"></div>
            <div class="absolute bottom-1/4 right-1/4 w-80 h-80 rounded-full border border-blue-300 animate-pulse pointer-events-none" style="animation-delay: 2s;"></div>
        </div>
    </div>

    <div class="relative z-10 max-w-4xl text-center">
        <h1 class="text-5xl md:text-7xl font-['Cormorant_Garamond'] font-bold mb-6">
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-300 via-pink-300 to-indigo-400">
                Discover Your Path
            </span>
        </h1>

        <p class="text-xl md:text-2xl text-purple-100 mb-12 max-w-2xl mx-auto">
            CelestiAI combines ancient tarot wisdom with artificial intelligence to guide your journey through the cosmos of possibility.
        </p>

        <div class="flex flex-col md:flex-row justify-center items-center space-y-4 md:space-y-0 md:space-x-6">
            @auth
                <a href="{{ route('dashboard') }}" class="px-8 py-3 rounded-full bg-gradient-to-r from-purple-500 to-indigo-600 text-white text-lg font-medium hover:from-purple-600 hover:to-indigo-700 transition-all shadow-lg hover:shadow-xl">
                    Get Your Reading
                </a>
            @else
                <a href="{{ route('register') }}" class="px-8 py-3 rounded-full bg-gradient-to-r from-purple-500 to-indigo-600 text-white text-lg font-medium hover:from-purple-600 hover:to-indigo-700 transition-all shadow-lg hover:shadow-xl">
                    Begin Your Journey
                </a>
                <a href="{{ route('login') }}" class="px-8 py-3 rounded-full bg-transparent border border-purple-400 text-purple-200 text-lg font-medium hover:bg-purple-900 hover:bg-opacity-20 transition-all">
                    Return to the Stars
                </a>
            @endauth
        </div>
    </div>

    <!-- Features section -->
    <div class="relative z-10 mt-24 grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
        <div class="bg-black bg-opacity-30 backdrop-filter backdrop-blur-sm rounded-xl p-8 border border-purple-800 hover:border-purple-600 transition-all">
            <div class="text-purple-300 text-4xl mb-4">✨</div>
            <h3 class="text-xl font-semibold mb-2 text-purple-200">AI-Powered Insights</h3>
            <p class="text-gray-300">Our advanced AI interprets the cards with deep understanding of tarot symbolism and your unique situation.</p>
        </div>

        <div class="bg-black bg-opacity-30 backdrop-filter backdrop-blur-sm rounded-xl p-8 border border-purple-800 hover:border-purple-600 transition-all">
            <div class="text-purple-300 text-4xl mb-4">🔮</div>
            <h3 class="text-xl font-semibold mb-2 text-purple-200">Multiple Spreads</h3>
            <p class="text-gray-300">From quick single card pulls to complex Celtic Cross spreads, discover the perfect reading for your needs.</p>
        </div>

        <div class="bg-black bg-opacity-30 backdrop-filter backdrop-blur-sm rounded-xl p-8 border border-purple-800 hover:border-purple-600 transition-all">
            <div class="text-purple-300 text-4xl mb-4">📜</div>
            <h3 class="text-xl font-semibold mb-2 text-purple-200">Reading History</h3>
            <p class="text-gray-300">Save your readings to track patterns and insights over time as your cosmic journey unfolds.</p>
        </div>
    </div>
</div>
@endsection
