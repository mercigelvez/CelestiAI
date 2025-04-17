<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CelestiAI - AI-Powered Tarot Readings</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600;700&family=Nunito:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="celestial-bg min-h-screen text-white font-['Nunito']">
    <!-- Stars background -->
    <div id="stars-container" class="fixed inset-0 z-0 overflow-hidden"></div>

    <!-- Main content -->
    <div class="relative z-10">
        @include('components.navigation')

        <main>
            @yield('content')
        </main>

        <footer class="py-4 text-center text-sm text-purple-200">
            <p>&copy; {{ date('Y') }} CelestiAI - Uncover the Universe Within</p>
        </footer>
    </div>

    @vite(['resources/js/stars.js'])
</body>
</html>
