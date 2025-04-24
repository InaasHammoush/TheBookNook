<x-app-layout>
    <div class="max-w-3xl mx-auto py-12">
        <h2 class="text-2xl font-bold mb-6">Edit Comment</h2>

        <form method="POST" action="{{ route('comments.update', $comment) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Content</label>
                <textarea name="body" rows="6"
                          class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200">{{ old('body', $comment->body) }}</textarea>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update Comment
            </button>
        </form>
    </div>
</x-app-layout>
