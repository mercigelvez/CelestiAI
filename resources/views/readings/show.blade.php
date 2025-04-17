<!-- resources/views/readings/show.blade.php -->
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
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-['Cormorant_Garamond'] font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-300 to-indigo-400">
                Your Mystical Reading
            </h1>
            <p class="mt-3 text-xl text-purple-200">
                {{ $reading->formatted_spread_type }} • {{ $reading->created_at->format('F j, Y') }}
            </p>
            @if($reading->question)
            <p class="mt-2 text-lg text-purple-300 italic">
                "{{ $reading->question }}"
            </p>
            @endif
        </div>

        <!-- Cards display -->
        <div class="mb-12">
            <h2 class="text-2xl font-['Cormorant_Garamond'] text-center font-bold text-purple-300 mb-6">The Cards Have Spoken</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                @foreach($cards as $index => $card)
                <div class="bg-black bg-opacity-50 backdrop-filter backdrop-blur-sm rounded-lg border border-purple-800 overflow-hidden hover:border-purple-600 transition-all transform hover:-translate-y-1 hover:shadow-lg">
                    <div class="p-2">
                        <!-- Card position -->
                        <div class="text-center text-sm font-medium text-purple-300 mb-1">
                            @php
                                $positions = [
                                    'single' => [0 => 'Current Situation'],
                                    'three-card' => [0 => 'Past', 1 => 'Present', 2 => 'Future'],
                                    'celtic-cross' => [
                                        0 => 'Present', 1 => 'Challenge', 2 => 'Past', 3 => 'Future',
                                        4 => 'Above', 5 => 'Below', 6 => 'Advice', 7 => 'External',
                                        8 => 'Hopes/Fears', 9 => 'Outcome'
                                    ],
                                    'relationship' => [
                                        0 => 'You', 1 => 'Partner', 2 => 'Foundation',
                                        3 => 'Past', 4 => 'Present', 5 => 'Future'
                                    ],
                                    'career' => [
                                        0 => 'Current', 1 => 'Challenges', 2 => 'Strengths',
                                        3 => 'Action', 4 => 'Outcome'
                                    ]
                                ];
                                $position = isset($positions[$reading->spread_type][$index])
                                    ? $positions[$reading->spread_type][$index]
                                    : "Position " . ($index + 1);
                            @endphp
                            {{ $position }}
                        </div>

                        <!-- Card image -->
                        <div class="relative">
                            <img src="{{ asset('images/tarot/' . $card['image']) }}"
                                 alt="{{ $card['name'] }}"
                                 class="mx-auto rounded-md w-full {{ $card['orientation'] === 'reversed' ? 'transform rotate-180' : '' }}">
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-black opacity-50 rounded-md"></div>
                        </div>

                        <!-- Card name and orientation -->
                        <div class="pt-2 pb-1 text-center">
                            <h3 class="font-medium text-purple-200">{{ $card['name'] }}</h3>
                            <p class="text-xs text-purple-300">{{ ucfirst($card['orientation']) }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Interpretation -->
        <div class="bg-black bg-opacity-30 backdrop-filter backdrop-blur-sm rounded-xl p-8 border border-purple-800">
            <h2 class="text-2xl font-['Cormorant_Garamond'] font-bold text-purple-300 mb-4">The Cosmic Interpretation</h2>

            <div class="prose prose-invert prose-purple max-w-none">
                {!! Str::markdown($reading->interpretation) !!}
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-10 flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6">
            <!-- Save as PDF (you would need to implement this functionality) -->
            <a href="#" class="py-3 px-6 rounded-lg bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-medium hover:from-purple-600 hover:to-indigo-700 transition-all shadow-lg flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Save as PDF
            </a>

            <!-- Share reading (you would need to implement this functionality) -->
            <a href="#" class="py-3 px-6 rounded-lg bg-black bg-opacity-50 border border-purple-600 text-white font-medium hover:bg-opacity-70 transition-all shadow-lg flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                </svg>
                Share Reading
            </a>
        </div>

        <!-- Back link -->
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
