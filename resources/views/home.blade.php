<x-app-layout>
    <header class="flex items-center px-6 py-4 bg-white shadow">
        <h1 class="text-xl font-bold">Book Forum</h1>



        <div class="flex-1 mx-6 flex justify-center">
            <x-search />
        </div>


        @auth
            <a href="{{ route('threads.create') }}"
               class="ml-auto bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700" style="right: 10px;">
                + New Thread
            </a>
        @endauth
    </header>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex space-x-6">
                <!-- Sidebar: Genres -->
                <div class="w-1/4 bg-white rounded-lg shadow p-4">
                    <h3 class="text-lg font-semibold mb-4">Genres</h3>
                    @if($genres->count())
                        <ul class="space-y-2">
                            @foreach($genres as $genre)
                                <li>
                                    <a href="{{ route('genres.show', $genre->id) }}"
                                       class="text-blue-600 hover:underline block">
                                        {{ $genre->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No genres found.</p>
                    @endif
                </div>

                <!-- Main: Threads -->
                <div class="flex-1 bg-white rounded-lg shadow p-4">
                    <h3 class="text-lg font-semibold mb-4">Latest Threads</h3>
                    @if($threads->count())
                        <ul class="space-y-4">
                            @foreach($threads as $thread)
                                <li class="border-b pb-2">
                                    <a href="{{ route('threads.show', $thread->id) }}"
                                       class="text-xl text-blue-700 hover:underline font-medium">
                                        {{ $thread->title }}
                                    </a>
                                    <p class="text-sm text-gray-500">
                                        Genre: {{ $thread->genre->name ?? 'Unknown' }} |
                                        by {{ $thread->user->name ?? 'Anonymous' }}
                                    </p>
                                    <p class="mt-1 text-gray-700">
                                        {{ \Illuminate\Support\Str::limit($thread->body, 100) }}
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No threads found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
