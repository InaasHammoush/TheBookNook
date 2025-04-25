<x-app-layout>
    <div class="max-w-3xl mx-auto py-12">

        <!-- Thread section -->
        <div class="mb-6 border border-gray-200 rounded-lg p-6 bg-white shadow-sm ">
            <div class="flex items-start space-x-6 mb-6">

                <!-- Bookcover in Thread Overview after Creation-->
                @if($thread->cover_image)
                    <div style="width: 64px; height: 96px; overflow: hidden; border-radius: 0.375rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05);" class="flex-shrink-0 bg-white">
                        <img src="{{ $thread->cover_image }}"
                             alt="Cover of {{ $thread->title }}"
                             style="width: 100%; height: 100%; object-fit: cover; display: block;" />
                    </div>
                @else
                    <div style="width: 64px; height: 96px; background-color: #e5e7eb; border-radius: 0.375rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05);"
                         class="flex-shrink-0 flex items-center justify-center text-sm text-gray-500">
                        No Cover
                    </div>
                @endif

                <!-- Thread info -->
                <div class="flex-1">
                    <div class="flex justify-between items-start">
                        <h2 class="text-2xl font-bold mb-4 basis-2/3" style="display: inline;">{{ $thread->title }}</h2>

                @can('update', $thread)
                        <div class="flex gap-2 basis-1/3 justify-end" >

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
             <p class="text-sm text-gray-500">
                Genre: {{ $thread->genre->name ?? 'Unknown' }} •
                by {{ $thread->user->name ?? 'Anonymous' }} • {{ $thread->created_at->format('d.m.Y H:i') }}
             @if($thread->book_authors)
                | Book by {{ $thread->book_authors }}
             @endif
             </p>
             </div>
        </div>
    </div>
</div>

        <!-- Comment section -->
        <div class="border border-gray-200 rounded-lg p-6 bg-white shadow-sm mb-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Comments</h3>

            <!-- Comment body including edit and delete -->
            @forelse ($comments as $comment)
                <div class="mb-4 border border-gray-100 rounded-md p-4 bg-gray-50">
                    <div class="flex justify-between items-start">
                        <p class="text-gray-800 w-full">{!! nl2br(e($comment->body)) !!}</p>

                        @can('update', $comment)
                            <div class="flex gap-2 justify-end ml-4">
                                <form action="{{ route('comments.edit', $comment) }}" method="GET" class="inline m-0 p-0">
                                    <button type="submit"
                                            class="text-sm text-gray-600 hover:underline bg-transparent border-none p-0 m-0 leading-tight cursor-pointer align-baseline">
                                        Edit
                                    </button>
                                </form>

                                <form action="{{ route('comments.destroy', $comment) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this comment?');"
                                      class="inline m-0 p-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-sm text-gray-600 hover:underline bg-transparent border-none p-0 m-0 leading-tight cursor-pointer align-baseline">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endcan
                    </div>

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
