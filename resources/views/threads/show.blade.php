<x-app-layout>
    <div class="max-w-3xl mx-auto py-12">
        <div class="mb-6 border border-gray-200 rounded-lg p-6 bg-white shadow-sm">
            <h2 class="text-2xl font-bold mb-6">{{ $thread->title }}</h2>
            <p class="text-gray-700 text-lg mb-2">{{ $thread->body }}</p>

            <div class="text-sm text-gray-500">
                <span class="font-semibold">{{ $thread->user->name }}</span>
                • {{ $thread->created_at->format('d.m.Y H:i') }}
            </div>
        </div>

        <div class="border border-gray-200 rounded-lg p-6 bg-white shadow-sm mb-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Comments</h3>

            @forelse ($comments as $comment)
                <div class="mb-4 border border-gray-100 rounded-md p-3 bg-gray-50">
                    <p class="text-gray-800">{{ $comment->body }}</p>
                    <div class="text-sm text-gray-500 mt-2">
                        — {{ $comment->user->name }}, {{ $comment->created_at->format('d.m.Y H:i') }}
                    </div>
                </div>
            @empty
                <p class="text-gray-500">No comments yet</p>
            @endforelse
        </div>

        <a href="{{ route('home') }}" class="text-blue-600 hover:underline">
            ← Back to Home
        </a>

    </div>

    @auth
        <form action="{{ route('comments.store', $thread->id) }}" method="POST" class="mt-6 space-y-4">
            @csrf
            <textarea name="body" rows="4" class="w-full border rounded p-2" placeholder="Write your comment..." required></textarea>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Post Comment
            </button>
        </form>
    @else
        <p class="mt-4 text-gray-600">Please <a href="{{ route('login') }}" class="text-blue-600 hover:underline">log in</a> to comment.</p>
    @endauth

</x-app-layout>
