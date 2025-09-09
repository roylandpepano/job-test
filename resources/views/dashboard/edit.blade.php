
@extends('layouts.app')

@section('content')
    <div class="max-w-lg mx-auto py-10">
        <div class="bg-white shadow-md rounded-xl p-8">
            <h2 class="text-2xl font-semibold text-gray-700 mb-6">Edit User</h2>

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

            @if(isset($user) && $user->id)
                <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const form = document.querySelector('form[action="{{ route('users.update', $user->id) }}"]');
                            if (!form) return;
                            form.addEventListener('submit', function(e) {
                                let valid = true;

                                // Name validation
                                const name = form.querySelector('input[name=\"name\"]');
                                const nameError = document.getElementById('editNameError');
                                if (name && name.value.trim().length < 2) {
                                    nameError.textContent = 'Name must be at least 2 characters.';
                                    nameError.classList.remove('hidden');
                                    valid = false;
                                } else if (nameError) {
                                    nameError.classList.add('hidden');
                                }

                                // Email validation
                                const email = form.querySelector('input[name=\"email\"]');
                                const emailError = document.getElementById('editEmailError');
                                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                if (email && !emailPattern.test(email.value.trim())) {
                                    emailError.textContent = 'Please enter a valid email address.';
                                    emailError.classList.remove('hidden');
                                    valid = false;
                                } else if (emailError) {
                                    emailError.classList.add('hidden');
                                }

                                // Password validation (if present)
                                const password = form.querySelector('input[name=\"password\"]');
                                const passwordError = document.getElementById('editPasswordError');
                                if (password && password.value.length > 0 && password.value.length < 6) {
                                    passwordError.textContent = 'Password must be at least 6 characters.';
                                    passwordError.classList.remove('hidden');
                                    valid = false;
                                } else if (passwordError) {
                                    passwordError.classList.add('hidden');
                                }

                                // Password confirmation (if present)
                                const passwordConfirm = form.querySelector('input[name=\"password_confirmation\"]');
                                const passwordConfirmError = document.getElementById('editPasswordConfirmError');
                                if (password && passwordConfirm && password.value !== passwordConfirm.value) {
                                    passwordConfirmError.textContent = 'Passwords do not match.';
                                    passwordConfirmError.classList.remove('hidden');
                                    valid = false;
                                } else if (passwordConfirmError) {
                                    passwordConfirmError.classList.add('hidden');
                                }
                                if (!valid) {
                                    e.preventDefault();
                                }
                            });
                        });
                    </script>
            @else
                <div class="mb-4 p-3 bg-red-100 text-red-800 rounded-lg">
                    <strong>Error:</strong> User not found or ID missing. Please return to the user list.
                </div>
            @endif

            <!-- Name -->
            @if(isset($user) && $user->id)
            <div>
                <label class="block text-gray-700 font-medium mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                       class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200 focus:outline-none">
                <p class="text-xs text-red-600 mt-1 hidden" id="editNameError"></p>
            </div>
            @endif

            <!-- Email -->
            @if(isset($user) && $user->id)
            <div>
                <label class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                       class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200 focus:outline-none">
                <p class="text-xs text-red-600 mt-1 hidden" id="editEmailError"></p>
            </div>
            @endif

            <!-- Password (optional) -->
            @if(isset($user) && $user->id)
            <div>
                <label class="block text-gray-700 font-medium mb-1">New Password <span class="text-gray-500 text-sm">(leave blank to keep current)</span></label>
                <input type="password" name="password"
                       class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200 focus:outline-none">
                <p class="text-xs text-red-600 mt-1 hidden" id="editPasswordError"></p>
            </div>
            @endif

            <!-- Confirm Password -->
            @if(isset($user) && $user->id)
            <div>
                <label class="block text-gray-700 font-medium mb-1">Confirm New Password</label>
                <input type="password" name="password_confirmation"
                       class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200 focus:outline-none">
                <p class="text-xs text-red-600 mt-1 hidden" id="editPasswordConfirmError"></p>
            </div>
            @endif

            <!-- Submit -->
            @if(isset($user) && $user->id)
            <div>
                <button type="submit"
                        class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition">
                    Update User
                </button>
            </div>
            </form>
            @endif
        </div>
    </div>
@endsection
