
@extends('layouts.app')

@section('content')
    <div class="max-w-lg mx-auto py-10">
        <div class="bg-white shadow-md rounded-xl p-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-6">Create New User</h2>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-800 rounded-lg">
                    <ul class="list-disc ml-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Name</label>
                    <input type="text" name="name" id="createName" value="{{ old('name') }}" required
                           class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200 focus:outline-none">
                    <p class="text-xs text-red-600 mt-1 hidden" id="createNameError"></p>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Email</label>
                    <input type="email" name="email" id="createEmail" value="{{ old('email') }}" required
                           class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200 focus:outline-none">
                    <p class="text-xs text-red-600 mt-1 hidden" id="createEmailError"></p>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Password</label>
                    <input type="password" name="password" id="createPassword" required
                           class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200 focus:outline-none">
                    <p class="text-xs text-red-600 mt-1 hidden" id="createPasswordError"></p>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="createPasswordConfirm" required
                           class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200 focus:outline-none">
                    <p class="text-xs text-red-600 mt-1 hidden" id="createPasswordConfirmError"></p>
                </div>

                <!-- Submit -->
                <div>
                    <button type="submit"
                            class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">
                        Create User
                    </button>
                </div>
            </form>
            <script>
                document.querySelector('form[action="{{ route('users.store') }}"]').addEventListener('submit', function(e) {
                    let valid = true;

                    // Name validation
                    const name = document.getElementById('createName').value.trim();
                    const nameError = document.getElementById('createNameError');
                    if (name.length < 2) {
                        nameError.textContent = 'Name must be at least 2 characters.';
                        nameError.classList.remove('hidden');
                        valid = false;
                    } else {
                        nameError.classList.add('hidden');
                    }

                    // Email validation
                    const email = document.getElementById('createEmail').value.trim();
                    const emailError = document.getElementById('createEmailError');
                    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailPattern.test(email)) {
                        emailError.textContent = 'Please enter a valid email address.';
                        emailError.classList.remove('hidden');
                        valid = false;
                    } else {
                        emailError.classList.add('hidden');
                    }

                    // Password validation
                    const password = document.getElementById('createPassword').value;
                    const passwordError = document.getElementById('createPasswordError');
                    if (password.length < 6) {
                        passwordError.textContent = 'Password must be at least 6 characters.';
                        passwordError.classList.remove('hidden');
                        valid = false;
                    } else {
                        passwordError.classList.add('hidden');
                    }

                    // Password confirmation
                    const passwordConfirm = document.getElementById('createPasswordConfirm').value;
                    const passwordConfirmError = document.getElementById('createPasswordConfirmError');
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
        </div>
    </div>
@endsection
