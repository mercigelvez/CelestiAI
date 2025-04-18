<!-- resources/views/auth/login.blade.php -->
@extends('layouts.base')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-12">
    <!-- Mystical circle animation -->
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 rounded-full border border-purple-500 opacity-20 animate-pulse pointer-events-none"></div>
        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-80 h-80 rounded-full border border-indigo-400 opacity-20 animate-pulse pointer-events-none" style="animation-delay: 1s;"></div>
        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 rounded-full border border-blue-300 opacity-20 animate-pulse pointer-events-none" style="animation-delay: 2s;"></div>
    </div>

    <div class="relative z-10 w-full max-w-md">
        <div class="bg-black bg-opacity-50 backdrop-filter backdrop-blur-xl rounded-2xl p-8 border border-purple-900">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-['Cormorant_Garamond'] font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-300 to-indigo-400">
                    Return to the Stars
                </h2>
                <p class="text-purple-200 mt-2">Enter your credentials to continue your journey</p>
            </div>

            @if (session('status'))
                <div class="bg-green-900 bg-opacity-50 text-green-200 p-4 rounded-lg mb-6 text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-purple-200 mb-1">Email <label class="text-pink-500 text-xs mt-1">*</label></label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
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

                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-purple-700 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-purple-200">Remember me</label>
                    </div>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-purple-300 hover:text-purple-200">
                            Forgot your password?
                        </a>
                    @endif
                </div>

                <button type="submit" class="w-full py-3 rounded-lg bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-medium hover:from-purple-600 hover:to-indigo-700 transition-all shadow-lg hover:shadow-xl">
                    Log in
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-purple-200">Don't have an account?
                    <a href="{{ route('register') }}" class="text-purple-300 hover:text-white">Register</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
