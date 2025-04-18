<!-- resources/views/readings/history.blade.php -->
@extends('layouts.base')

@section('content')
<div class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <!-- Mystical animations for background -->
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute left-1/4 top-1/2 w-64 h-64 rounded-full border border-purple-500 opacity-20 animate-pulse pointer-events-none"></div>
        <div class="absolute right-1/3 top-1/3 w-96 h-96 rounded-full border border-indigo-400 opacity-20 animate-pulse pointer-events-none" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-1/4 left-1/2 w-80 h-80 rounded-full border border-blue-300 opacity-20 animate-pulse pointer-events-none" style="animation-delay: 2s;"></div>
    </div>

    <div class="relative z-10 max-w-6xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-['Cormorant_Garamond'] font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-300 to-indigo-400">
                Your Reading History
            </h1>
            <p class="mt-3 text-xl text-purple-200">
                Journey through the cosmic insights that have guided your path
            </p>
        </div>

        <!-- Readings table -->
        <div class="bg-black bg-opacity-30 backdrop-filter backdrop-blur-sm rounded-xl overflow-hidden border border-purple-800">
            @if($readings->count() > 0)
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-purple-800">
                            <th class="px-6 py-3 text-left text-xs font-medium text-purple-300 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-purple-300 uppercase tracking-wider">Spread</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-purple-300 uppercase tracking-wider">Question</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-purple-300 uppercase tracking-wider">Cards</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-purple-300 uppercase tracking-wider"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-purple-800">
                        @foreach($readings as $reading)
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
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-purple-200">
                                @php
                                    $cardCount = count(json_decode($reading->cards, true));
                                @endphp
                                {{ $cardCount }} {{ Str::plural('card', $cardCount) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('readings.show', $reading) }}" class="text-indigo-400 hover:text-indigo-300">
                                    View Reading
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-purple-800">
                    {{ $readings->links() }}
                </div>
            @else
                <div class="py-12 text-center">
                    <div class="text-purple-300 text-4xl mb-4">✨</div>
                    <h3 class="text-xl font-semibold text-purple-200 mb-2">No Readings Yet</h3>
                    <p class="text-purple-300 mb-6">Your cosmic journey is just beginning</p>
                    <a href="{{ route('readings.create') }}" class="py-2 px-6 rounded-lg bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-medium hover:from-purple-600 hover:to-indigo-700 transition-all shadow-lg">
                        Get Your First Reading
                    </a>
                </div>
            @endif
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
