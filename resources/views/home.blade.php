<x-app-layout>

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
                                       class="block px-3 py-2 rounded-md text-gray-700 hover:bg-emerald-100 hover:text-emerald-700 transition">
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
                        <div class="grid gap-4">
                            @foreach($threads as $thread)
                                <li class="flex items-start space-x-6 border-b pb-4">

                                    <!-- Bookcover -->
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

                                <!-- Thread-Infos -->
                                <div class="flex-1">
                                    <a href="{{ route('threads.show', $thread->id) }}"
                                       class="text-xl text-blue-700 hover:underline font-medium">
                                        {{ $thread->title }}
                                    </a>
                                    <p class="text-sm text-gray-500">
                                        by {{ $thread->user->name ?? 'Anonymous' }} 
                                        @if ($thread->book_title)
                                            | "{{ $thread->book_title }}"
                                        @endif
                                        @if($thread->book_authors)
                                                by {{ $thread->book_authors }}
                                        @endif
                                        • Genre: {{ $thread->genre->name ?? 'Unknown' }}
                                    </p>
                                    <p class="mt-1 text-gray-700">
                                        {{ \Illuminate\Support\Str::limit($thread->body, 100) }}
                                    </p>
                                </div>
                            </li>
                            @endforeach
                        </div>
                    @else
                        <p>No threads found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
