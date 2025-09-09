
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Job Test</title>
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
            @if(session('error'))
                <div class="w-full mb-4 p-3 rounded-lg bg-red-100 text-red-700 text-sm text-center border border-red-200">
                    {{ session('error') }}
                </div>
            @endif
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-14 w-14 mb-4 rounded-xl shadow-sm bg-white/80">
            <h1 class="text-2xl md:text-3xl font-extrabold mb-2 text-gray-900 tracking-tight text-center">Login</h1>
            <form id="loginForm" action="{{ route('login.post') }}" method="POST" class="space-y-5 w-full" novalidate>
                @csrf
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Email</label>
                    <input type="email" name="email" id="loginEmail" required
                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <p class="text-xs text-red-600 mt-1 hidden" id="loginEmailError"></p>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Password</label>
                    <input type="password" name="password" id="loginPassword" required
                           class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <p class="text-xs text-red-600 mt-1 hidden" id="loginPasswordError"></p>
                </div>
                <button class="w-full bg-indigo-500 text-white py-2.5 rounded-lg font-semibold hover:bg-indigo-600 transition">
                    Sign in
                </button>
                <div class="flex flex-col items-center space-y-1">
                    <p class="text-sm text-center text-gray-500">
                        Don’t have an account?
                        <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Register</a>
                    </p>
                    <a href="{{ route('password.request') }}" class="text-xs text-indigo-500 hover:underline mt-1">Forgot Password?</a>
                </div>
            </form>
        </div>
    </main>
    <footer class="w-full text-center text-xs text-gray-400 mt-10 mb-2">
        made by <a href="https://roylandvp.com" class="underline hover:text-indigo-500" target="_blank" rel="noopener">RoylandVP</a>
    </footer>
    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            let valid = true;
            // Email validation
            const email = document.getElementById('loginEmail').value.trim();
            const emailError = document.getElementById('loginEmailError');
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                emailError.textContent = 'Please enter a valid email address.';
                emailError.classList.remove('hidden');
                valid = false;
            } else {
                emailError.classList.add('hidden');
            }
            // Password validation
            const password = document.getElementById('loginPassword').value;
            const passwordError = document.getElementById('loginPasswordError');
            if (password.length < 6) {
                passwordError.textContent = 'Password must be at least 6 characters.';
                passwordError.classList.remove('hidden');
                valid = false;
            } else {
                passwordError.classList.add('hidden');
            }
            if (!valid) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>
