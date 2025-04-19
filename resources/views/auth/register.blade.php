<!-- resources/views/auth/register.blade.php -->
@extends('layouts.base')

@section('content')
    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <!-- Mystical animations -->
        <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
            <div
                class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 rounded-full border border-purple-500 opacity-20 animate-pulse pointer-events-none">
            </div>
            <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 rounded-full border border-indigo-400 opacity-20 animate-pulse pointer-events-none"
                style="animation-delay: 1s;"></div>
            <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 rounded-full border border-blue-300 opacity-20 animate-pulse pointer-events-none"
                style="animation-delay: 2s;"></div>
        </div>

        <div class="relative z-10 w-full max-w-md">
            <div class="bg-black bg-opacity-50 backdrop-filter backdrop-blur-xl rounded-2xl p-8 border border-purple-900">
                <div class="text-center mb-8">
                    <h2
                        class="text-3xl font-['Cormorant_Garamond'] font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-300 to-indigo-400">
                        Begin Your Journey
                    </h2>
                    <p class="text-purple-200 mt-2">Create your account to unlock celestial wisdom</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-purple-200 mb-1">Username <label
                                class="text-pink-500 text-xs mt-1">*</label> </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                            class="w-full bg-black bg-opacity-50 border border-purple-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        @error('name')
                            <p class="text-pink-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-purple-200 mb-1">Email <label
                                class="text-pink-500 text-xs mt-1">*</label></label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            class="w-full bg-black bg-opacity-50 border border-purple-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        @error('email')
                            <p class="text-pink-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-purple-200 mb-1">Password <label
                                class="text-pink-500 text-xs mt-1">*</label></label>
                        <input type="password" id="password" name="password" required
                            class="w-full bg-black bg-opacity-50 border border-purple-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        @error('password')
                            <p class="text-pink-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-purple-200 mb-1">Confirm
                            Password <label class="text-pink-500 text-xs mt-1">*</label></label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            class="w-full bg-black bg-opacity-50 border border-purple-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    </div>

                    <div class="mb-6">
                        <label for="zodiac_sign" class="block text-sm font-medium text-purple-200 mb-1">Zodiac Sign<label
                                class="text-pink-500 text-xs mt-1">*</label></label>
                        <div class="relative">
                            <select id="zodiac_sign" name="zodiac_sign" required
                                class="w-full bg-black bg-opacity-50 border border-purple-700 rounded-lg px-4 py-2 text-white appearance-none focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <option value="" disabled selected>Select your sign</option>
                                <option value="Aries">Aries (Mar 21 - Apr 19)</option>
                                <option value="Taurus">Taurus (Apr 20 - May 20)</option>
                                <option value="Gemini">Gemini (May 21 - Jun 20)</option>
                                <option value="Cancer">Cancer (Jun 21 - Jul 22)</option>
                                <option value="Leo">Leo (Jul 23 - Aug 22)</option>
                                <option value="Virgo">Virgo (Aug 23 - Sep 22)</option>
                                <option value="Libra">Libra (Sep 23 - Oct 22)</option>
                                <option value="Scorpio">Scorpio (Oct 23 - Nov 21)</option>
                                <option value="Sagittarius">Sagittarius (Nov 22 - Dec 21)</option>
                                <option value="Capricorn">Capricorn (Dec 22 - Jan 19)</option>
                                <option value="Aquarius">Aquarius (Jan 20 - Feb 18)</option>
                                <option value="Pisces">Pisces (Feb 19 - Mar 20)</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-5 h-5 text-purple-300" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="birth_date" class="block text-sm font-medium text-purple-200 mb-1">Birth Date</label>
                        <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') }}"
                            class="w-full bg-black bg-opacity-50 border border-purple-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    </div>

                    <button type="submit"
                        class="w-full py-3 rounded-lg bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-medium hover:from-purple-600 hover:to-indigo-700 transition-all shadow-lg hover:shadow-xl">
                        Register
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-purple-200">Already have an account?
                        <a href="{{ route('login') }}" class="text-purple-300 hover:text-white">Log in</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
