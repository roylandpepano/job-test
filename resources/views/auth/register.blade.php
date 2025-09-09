
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Job Test</title>
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
            <h2 class="text-2xl md:text-3xl font-extrabold mb-2 text-gray-900 text-center">Create an Account</h2>
            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-800 rounded-lg w-full">
                    <ul class="list-disc ml-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg w-full">
                    {{ session('success') }}
                </div>
            @endif
            <form id="registerForm" method="POST" action="{{ route('register.post') }}" class="space-y-4 w-full" novalidate>
                @csrf
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Name</label>
                    <input type="text" name="name" id="regName" value="{{ old('name') }}" required
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-200 focus:outline-none">
                    <p class="text-xs text-red-600 mt-1 hidden" id="nameError"></p>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Email</label>
                    <input type="email" name="email" id="regEmail" value="{{ old('email') }}" required
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-200 focus:outline-none">
                    <p class="text-xs text-red-600 mt-1 hidden" id="emailError"></p>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Password</label>
                    <input type="password" name="password" id="regPassword" required
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-200 focus:outline-none">
                    <p class="text-xs text-red-600 mt-1 hidden" id="passwordError"></p>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="regPasswordConfirm" required
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-200 focus:outline-none">
                    <p class="text-xs text-red-600 mt-1 hidden" id="passwordConfirmError"></p>
                </div>
                <button type="submit"
                        class="w-full bg-indigo-500 text-white py-2.5 rounded-lg font-semibold hover:bg-indigo-600 transition">
                    Register
                </button>
            </form>
            <p class="mt-6 text-sm text-gray-600 text-center">
                Already have an account?
                <a href="{{ route('login') }}" class="text-indigo-500 hover:underline">Login</a>
            </p>
        </div>
    </main>
    <footer class="w-full text-center text-xs text-gray-400 mt-10 mb-2">
        made by <a href="https://roylandvp.com" class="underline hover:text-indigo-500" target="_blank" rel="noopener">RoylandVP</a>
    </footer>
    <script>
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            let valid = true;
            // Name validation
            const name = document.getElementById('regName').value.trim();
            const nameError = document.getElementById('nameError');
            if (name.length < 2) {
                nameError.textContent = 'Name must be at least 2 characters.';
                nameError.classList.remove('hidden');
                valid = false;
            } else {
                nameError.classList.add('hidden');
            }
            // Email validation
            const email = document.getElementById('regEmail').value.trim();
            const emailError = document.getElementById('emailError');
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                emailError.textContent = 'Please enter a valid email address.';
                emailError.classList.remove('hidden');
                valid = false;
            } else {
                emailError.classList.add('hidden');
            }
            // Password validation
            const password = document.getElementById('regPassword').value;
            const passwordError = document.getElementById('passwordError');
            if (password.length < 6) {
                passwordError.textContent = 'Password must be at least 6 characters.';
                passwordError.classList.remove('hidden');
                valid = false;
            } else {
                passwordError.classList.add('hidden');
            }
            // Password confirmation
            const passwordConfirm = document.getElementById('regPasswordConfirm').value;
            const passwordConfirmError = document.getElementById('passwordConfirmError');
            if (password !== passwordConfirm) {
                passwordConfirmError.textContent = 'Passwords do not match.';
                passwordConfirmError.classList.remove('hidden');
                valid = false;
            } else {
                passwordConfirmError.classList.add('hidden');
            }
            if (!valid) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>
