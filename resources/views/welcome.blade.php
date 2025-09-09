
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome | Job Test</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        body { font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; }
        .animate-fade-in { animation: fadeIn 1.2s cubic-bezier(.4,0,.2,1); }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: none; } }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-white via-blue-50 to-indigo-100 flex flex-col justify-center items-center">
    <main class="w-full flex flex-col items-center justify-center flex-1 px-4">
        <div class="animate-fade-in bg-white/80 border border-gray-200 rounded-2xl shadow-xl p-8 md:p-12 flex flex-col items-center max-w-md w-full mt-16">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-14 w-14 mb-4 rounded-xl shadow-sm bg-white/80">
            <h1 class="text-3xl md:text-4xl font-extrabold mb-2 text-gray-900 tracking-tight text-center">Welcome to <span class="text-indigo-500">Job Test</span></h1>
            <p class="text-base md:text-lg mb-8 text-gray-600 font-medium text-center">A secure Laravel login and registration system with CRUD dashboard.</p>
            <div class="flex gap-3 w-full">
                <a href="{{ route('login') }}"
                   class="flex-1 px-5 py-2.5 bg-indigo-500 text-white font-semibold rounded-lg shadow hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-300 transition text-center">
                    Login
                </a>
                <a href="{{ route('register') }}"
                   class="flex-1 px-5 py-2.5 bg-white text-indigo-500 border border-indigo-200 font-semibold rounded-lg shadow hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition text-center">
                    Register
                </a>
            </div>
        </div>
    </main>
    <footer class="w-full text-center text-xs text-gray-400 mt-10 mb-2">
        made by <a href="https://roylandvp.com" class="underline hover:text-indigo-500" target="_blank" rel="noopener">RoylandVP</a>
    </footer>
</body>
</html>
