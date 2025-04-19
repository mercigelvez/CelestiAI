<!-- resources/views/welcome.blade.php -->
@extends('layouts.base')

@section('content')
    <div class="min-h-screen flex flex-col justify-center items-center px-4 py-16">
        <!-- Mystical circles animation -->
        <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
            <div class="absolute inset-0 opacity-20 pointer-events-none">
                <div
                    class="absolute top-1/4 left-1/4 w-64 h-64 rounded-full border border-purple-300 animate-pulse pointer-events-none">
                </div>
                <div class="absolute top-1/3 left-1/3 w-96 h-96 rounded-full border border-indigo-400 animate-pulse pointer-events-none"
                    style="animation-delay: 1s;"></div>
                <div class="absolute bottom-1/4 right-1/4 w-80 h-80 rounded-full border border-blue-300 animate-pulse pointer-events-none"
                    style="animation-delay: 2s;"></div>
            </div>
        </div>

        <div class="relative z-10 max-w-4xl text-center">
            <h1 class="text-5xl md:text-7xl font-['Cormorant_Garamond'] font-bold mb-6">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-300 via-pink-300 to-indigo-400">
                    Discover Your Path
                </span>
            </h1>

            <p class="text-xl md:text-2xl text-purple-100 mb-12 max-w-2xl mx-auto">
                CelestiAI combines ancient tarot wisdom with artificial intelligence to guide your journey through the
                cosmos of possibility.
            </p>

            <div class="flex flex-col md:flex-row justify-center items-center space-y-4 md:space-y-0 md:space-x-6">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="px-8 py-3 rounded-full bg-gradient-to-r from-purple-500 to-indigo-600 text-white text-lg font-medium hover:from-purple-600 hover:to-indigo-700 transition-all shadow-lg hover:shadow-xl">
                        Get Your Reading
                    </a>
                @else
                    <a href="{{ route('register') }}"
                        class="px-8 py-3 rounded-full bg-gradient-to-r from-purple-500 to-indigo-600 text-white text-lg font-medium hover:from-purple-600 hover:to-indigo-700 transition-all shadow-lg hover:shadow-xl">
                        Begin Your Journey
                    </a>
                    <a href="{{ route('login') }}"
                        class="px-8 py-3 rounded-full bg-transparent border border-purple-400 text-purple-200 text-lg font-medium hover:bg-purple-900 hover:bg-opacity-20 transition-all">
                        Return to the Stars
                    </a>
                @endauth
            </div>
        </div>

        <!-- Features section -->
        <div class="relative z-10 mt-24 grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <!-- AI-Powered Insights -->
            <div
                class="bg-black rounded-xl p-8 border border-purple-700 hover:border-purple-500 transition-all shadow-lg hover:shadow-blue-500/20">
                <div class="text-cyan-400 text-4xl mb-4">✨</div>
                <h3 class="text-xl font-bold mb-2 text-white">AI-Powered Insights</h3>
                <p class="text-blue-100 opacity-90">Our advanced AI interprets the cards with deep understanding of tarot
                    symbolism and your unique situation.</p>
                <div class="mt-4 text-xs text-purple-300">Powered by cutting-edge technology</div>
            </div>

            <!-- Multiple Spreads -->
            <div
                class="bg-black rounded-xl p-8 border border-purple-700 hover:border-purple-500 transition-all shadow-lg hover:shadow-purple-500/20">
                <div class="text-pink-400 text-4xl mb-4">🔮</div>
                <h3 class="text-xl font-bold mb-2 text-white">Multiple Spreads</h3>
                <p class="text-violet-100 opacity-90">From quick single card pulls to complex Celtic Cross spreads, discover
                    the perfect reading for your needs.</p>
                <div class="mt-4 text-xs text-purple-300">10+ specialized spreads available</div>
            </div>

            <!-- Daily Horoscope -->
            <div
                class="bg-black rounded-xl p-8 border border-purple-700 hover:border-purple-500 transition-all shadow-lg hover:shadow-purple-500/20">
                <div class="text-pink-400 text-4xl mb-4">🌙</div>
                <h3 class="text-xl font-bold mb-2 text-white">Daily Horoscope</h3>
                <p class="text-purple-100 opacity-90">Discover what the stars have in store for you today with personalized
                    astrological insights.</p>
                <div class="mt-4 text-xs text-purple-300">Available for all 12 zodiac signs</div>
            </div>

            <!-- Reading History -->
            {{-- <div
                class="bg-gradient-to-br from-purple-900 to-black to-black rounded-xl p-8 border border-purple-700 hover:border-purple-500 transition-all shadow-lg hover:shadow-amber-500/20">
                <div class="text-yellow-400 text-4xl mb-4">📜</div>
                <h3 class="text-xl font-bold mb-2 text-white">Reading History</h3>
                <p class="text-amber-100 opacity-90">Save your readings to track patterns and insights over time as your
                    cosmic journey unfolds.</p>
                <div class="mt-4 text-xs text-purple-300">Never lose your spiritual progress</div>
            </div> --}}
        </div>
    </div>
@endsection
