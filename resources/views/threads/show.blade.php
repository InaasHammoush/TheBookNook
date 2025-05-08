<x-app-layout>
    <div class="max-w-3xl mx-auto py-12">

        <!-- Thread section -->
        <div class="mb-6 border border-gray-200 rounded-lg p-6 bg-white shadow-sm ">
            <div class="flex justify-between items-start">
                <h2 class="text-2xl font-bold basis-2/3" style="display: inline;">{{ $thread->title }}</h2>

                <div class="flex gap-2 basis-1/3 justify-end" >
                    @can('update', $thread)
                        <form action="{{ route('threads.edit', $thread) }}" method="GET" class="inline m-0 p-0">
                            <button type="submit"
                                    class="text-sm text-gray-600 hover:underline bg-transparent border-none p-0 m-0 leading-tight cursor-pointer align-baseline">
                                Edit
                            </button>
                        </form>
                    @endcan

                    @can('delete', $thread)
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
                    @endcan
                </div>
            </div>
            
            @auth
                @if(auth()->user()->bookmarkedThreads->contains($thread->id))
                    <form action="{{ route('threads.unbookmark', $thread) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-blue-500 mb-2">📑 Remove Bookmark</button>
                    </form>
                @else
                    <form action="{{ route('threads.bookmark', $thread) }}" method="POST">
                        @csrf
                        <button type="submit" class="text-blue-500 mb-2">📑 Bookmark Thread</button>
                    </form>
                @endif
            @endauth
        
            <p class="text-gray-700 text-lg mt-2 mb-2 break-words">{!! nl2br(e($thread->body)) !!}</p>

            <div class="text-sm text-gray-500">
                <span class="font-semibold">{{ $thread->user->name }}</span>
                • {{ $thread->created_at->format('d.m.Y H:i') }}
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
                        <div class="flex gap-2 justify-end ml-4">
                            @can('update', $comment)
                                <form action="{{ route('comments.edit', $comment) }}" method="GET" class="inline m-0 p-0">
                                    <button type="submit"
                                            class="text-sm text-gray-600 hover:underline bg-transparent border-none p-0 m-0 leading-tight cursor-pointer align-baseline">
                                        Edit
                                    </button>
                                </form>
                            @endcan

                            @can('delete', $comment)
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
                            @endcan
                        </div>
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
