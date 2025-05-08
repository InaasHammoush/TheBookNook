<x-app-layout>
    <div class="max-w-4xl mx-auto py-12 background-white">
        <h1 class="text-2xl font-bold mb-4">All Users</h1>

        <!-- Search Form -->
        <form method="GET" action="{{ route('users.index') }}" class="mb-6">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Search by name or email..."
                   class="border border-gray-300 rounded px-3 py-1 w-full md:w-1/2">
        </form>

        <!-- Users Table -->
        <table class="w-full text-left bg-white shadow-sm sm:rounded-lg p-6">
            <thead>
                <tr class="border-b">
                    <th class="px-4 py-4 text-center">ID</th>
                    <th class="px-4 py-4 text-center">Name</th>
                    <th class="px-4 py-4 text-center">Email</th>
                    <th class="px-4 py-4 text-center">Role</th>
                    <th class="px-4 py-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr class="border-b">
                        <td class="px-4 py-3 back">{{ $user->id }}</td>
                        <td class="px-4 py-3">{{ $user->name }}</td>
                        <td class="px-4 py-3">{{ $user->email }}</td>
                        <td class="px-4 py-3">
                            {{ $user->isAdmin() ? 'Admin' : 'User' }}
                        </td>
                        <td class="px-4 py-3 flex gap-2">
                            <form action="{{ route('users.destroy', $user) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline py-3">Delete</button>
                            </form>

                            @if (!$user->isAdmin())
                                <form action="{{ route('users.promote', $user) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-blue-600 hover:underline py-3">Promote to Admin</button>
                                </form>
                            @else
                                <form action="{{ route('users.demote', $user) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-blue-600 hover:underline py-3">Demote to User</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-gray-500">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
