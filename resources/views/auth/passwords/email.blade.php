
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Job Test</title>
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
            <h1 class="text-2xl md:text-3xl font-extrabold mb-2 text-gray-900 tracking-tight text-center">Reset Password</h1>
            <p class="text-base mb-6 text-gray-600 font-medium text-center">Forgot your password? Enter your email and we'll send you a reset link.</p>

            @if (session('status'))
                <div class="w-full mb-4 p-3 rounded-lg bg-green-100 text-green-700 text-sm text-center border border-green-200">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-5 w-full">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium mb-1 text-gray-700">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none @error('email') border-red-400 @enderror">
                    @error('email')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="w-full bg-indigo-500 text-white py-2.5 rounded-lg font-semibold hover:bg-indigo-600 transition">
                    Send Password Reset Link
                </button>
                <div class="flex justify-between items-center mt-2">
                    <a href="{{ route('login') }}" class="text-xs text-indigo-500 hover:underline">Back to Login</a>
                    <a href="{{ route('register') }}" class="text-xs text-gray-500 hover:underline">Register</a>
                </div>
            </form>
        </div>
    </main>
    <footer class="w-full text-center text-xs text-gray-400 mt-10 mb-2">
        made by <a href="https://roylandvp.com" class="underline hover:text-indigo-500" target="_blank" rel="noopener">RoylandVP</a>
    </footer>
</body>
</html>
