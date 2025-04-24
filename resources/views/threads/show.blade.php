<x-app-layout>
    <div class="max-w-3xl mx-auto py-12">

        <!-- Thread section -->
        <div class="mb-6 border border-gray-200 rounded-lg p-6 bg-white shadow-sm ">
            <div class="flex justify-between items-start">
            <h2 class="text-2xl font-bold mb-4 basis-1/2" style="display: inline;">{{ $thread->title }}</h2>

                @can('update', $thread)
                        <div class="flex gap-2 basis-1/2 justify-end" >

                        <form action="{{ route('threads.edit', $thread) }}" method="GET" class="inline m-0 p-0">
                            <button type="submit"
                                    class="text-sm text-gray-600 hover:underline bg-transparent border-none p-0 m-0 leading-tight cursor-pointer align-baseline">
                                Edit
                            </button>
                        </form>


                        <form action="{{ route('threads.destroy', $thread) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this thread?');"
                              class="inline m-0 p-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-sm text-gray-600 hover:underline bg-transparent border-none p-0 leading-tight cursor-pointer align-baseline">
                                Delete
                            </button>
                        </form>
                    </div>
                @endcan
            </div>
            <p class="text-gray-700 text-lg mb-2 break-words">{!! nl2br(e($thread->body)) !!}</p>

            <div class="text-sm text-gray-500">
                <span class="font-semibold">{{ $thread->user->name }}</span>
                • {{ $thread->created_at->format('d.m.Y H:i') }}
            </div>
        </div>


        <!-- Comment section -->
        <div class="border border-gray-200 rounded-lg p-6 bg-white shadow-sm mb-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Comments</h3>

            @forelse ($comments as $comment)
                <div class="mb-4 border border-gray-100 rounded-md p-3 bg-gray-50">
                    <p class="text-gray-800">{{!! nl2br(e($comment->body)) !!}</p>
                    <div class="text-sm text-gray-500 mt-2">
                        — {{ $comment->user->name }}, {{ $comment->created_at->format('d.m.Y H:i') }}
                    </div>
                </div>
            @empty
                <p class="text-gray-500">No comments yet</p>
            @endforelse
        </div>



        @auth
        <div class="border border-gray-200 rounded-lg p-6 bg-white shadow-sm mb-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Write a Comment</h3>
            <form action="{{ route('comments.store', $thread->id) }}" method="POST" class="mt-6 space-y-4">
                @csrf
                <textarea name="body" rows="4" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200" placeholder="Write your comment..." required></textarea>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Post Comment
                </button>
            </form>
        @else
            <p class="mt-4 text-gray-600">Please <a href="{{ route('login') }}" class="text-blue-600 hover:underline">log in</a> to comment.</p>
        @endauth

    </div>


    <div class="mt-8"> <a href="{{ route('home') }}" class="text-blue-600 hover:underline">
        ← Back to Home
    </a>


</div>

</x-app-layout>
