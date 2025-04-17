<!-- resources/views/layouts/navigation.blade.php -->
<nav class="py-4 px-6 md:px-12 bg-black bg-opacity-20 backdrop-filter backdrop-blur-lg">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ route('welcome') }}" class="flex items-center">
            <span class="text-3xl font-['Cormorant_Garamond'] font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-300 to-indigo-400">CelestiAI</span>
        </a>

        <div class="flex items-center space-x-6">
            @auth
                <a href="{{ route('dashboard') }}" class="text-purple-200 hover:text-white transition-colors">Dashboard</a>
                <a href="{{ route('readings.history') }}" class="text-purple-200 hover:text-white transition-colors">My Readings</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center text-purple-200 hover:text-white transition-colors">
                        <span>Logout</span>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-purple-200 hover:text-white transition-colors">Login</a>
                <a href="{{ route('register') }}" class="px-4 py-2 rounded-full bg-gradient-to-r from-purple-500 to-indigo-600 text-white font-medium hover:from-purple-600 hover:to-indigo-700 transition-all">Register</a>
            @endauth
        </div>
    </div>
</nav>
