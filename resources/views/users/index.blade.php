@extends('layouts.app')

@section('content')
<div class="bg-white shadow-lg rounded-2xl p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-semibold text-gray-800">Users</h1>
        <a href="{{ route('users.create') }}" class="px-4 py-2 rounded-lg bg-indigo-500 text-white hover:bg-indigo-600 transition">
            + Add User
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-gray-50 text-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left">ID</th>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Role</th>
                    <th class="px-4 py-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($users as $u)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-2">{{ $u['id'] }}</td>
                        <td class="px-4 py-2">{{ $u['name'] }}</td>
                        <td class="px-4 py-2">{{ $u['email'] }}</td>
                        <td class="px-4 py-2">{{ ucfirst($u['role']) }}</td>
                        <td class="px-4 py-2 text-center flex justify-center gap-3">
                            <a href="{{ route('users.edit', $u['id']) }}" 
                               class="px-2 py-1 text-sm rounded-lg bg-yellow-400 text-gray-800 hover:bg-yellow-500 transition">
                               Edit
                            </a>
                            <form method="POST" action="{{ route('users.destroy', $u['id']) }}" onsubmit="return confirm('Delete this user?');">
                                @csrf
                                <button type="submit" 
                                        class="px-2 py-1 text-sm rounded-lg bg-red-500 text-white hover:bg-red-600 transition">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-4 text-center text-gray-500">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
