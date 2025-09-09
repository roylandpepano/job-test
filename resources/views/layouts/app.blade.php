<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <title>{{ config('app.name', 'Job Test') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen font-sans text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white/80 backdrop-blur border-b border-gray-200 sticky top-0 z-50 shadow-sm">
        <div class="max-w-6xl mx-auto px-4 py-3 flex justify-between items-center">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-lg font-semibold text-gray-800 hover:text-indigo-600">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-8 object-contain" />
                Job Test
            </a>
            <div class="flex items-center gap-4">
                @if(session('user'))
                    <span class="text-sm text-gray-600">Hello, {{ session('user')['name'] }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="px-3 py-1.5 rounded-lg text-sm bg-red-500 text-white hover:bg-red-600 transition">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="px-3 py-1.5 rounded-lg text-sm bg-indigo-500 text-white hover:bg-indigo-600 transition">Login</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="max-w-6xl mx-auto px-4 py-10">
        @if(session('success'))
            <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-700 border border-green-200 shadow">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-700 border border-red-200 shadow">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
