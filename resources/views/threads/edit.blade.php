<x-app-layout>
    <div class="max-w-3xl mx-auto py-12">
        <h2 class="text-2xl font-bold mb-6">Edit Thread</h2>

        <form method="POST" action="{{ route('threads.update', $thread) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Title</label>
                <input type="text" name="title" value="{{ old('title', $thread->title) }}"
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200" />
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Content</label>
                <textarea name="body" rows="6"
                          class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200">{{ old('body', $thread->body) }}</textarea>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update Thread
            </button>
        </form>
    </div>
</x-app-layout>
