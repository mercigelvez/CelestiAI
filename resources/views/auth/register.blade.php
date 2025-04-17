<!-- resources/views/auth/register.blade.php -->
@extends('layouts.base')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-12">
    <!-- Mystical animations -->
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 rounded-full border border-purple-500 opacity-20 animate-pulse pointer-events-none"></div>
        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 rounded-full border border-indigo-400 opacity-20 animate-pulse pointer-events-none" style="animation-delay: 1s;"></div>
        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 rounded-full border border-blue-300 opacity-20 animate-pulse pointer-events-none" style="animation-delay: 2s;"></div>
    </div>

    <div class="relative z-10 w-full max-w-md">
        <div class="bg-black bg-opacity-50 backdrop-filter backdrop-blur-xl rounded-2xl p-8 border border-purple-900">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-['Cormorant_Garamond'] font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-300 to-indigo-400">
                    Begin Your Journey
                </h2>
                <p class="text-purple-200 mt-2">Create your account to unlock celestial wisdom</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-purple-200 mb-1">Username <label class="text-pink-500 text-xs mt-1">*</label> </label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                        class="w-full bg-black bg-opacity-50 border border-purple-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    @error('name')
                        <p class="text-pink-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-purple-200 mb-1">Email <label class="text-pink-500 text-xs mt-1">*</label></label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="w-full bg-black bg-opacity-50 border border-purple-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    @error('email')
                        <p class="text-pink-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-purple-200 mb-1">Password <label class="text-pink-500 text-xs mt-1">*</label></label>
                    <input type="password" id="password" name="password" required
                        class="w-full bg-black bg-opacity-50 border border-purple-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    @error('password')
                        <p class="text-pink-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-purple-200 mb-1">Confirm Password <label class="text-pink-500 text-xs mt-1">*</label></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="w-full bg-black bg-opacity-50 border border-purple-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>

                <div class="mb-6">
                    <label for="birth_date" class="block text-sm font-medium text-purple-200 mb-1">Birth Date</label>
                    <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') }}"
                        class="w-full bg-black bg-opacity-50 border border-purple-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>

                <button type="submit" class="w-full py-3 rounded-lg bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-medium hover:from-purple-600 hover:to-indigo-700 transition-all shadow-lg hover:shadow-xl">
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
