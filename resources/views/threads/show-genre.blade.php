<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row space-y-6 md:space-y-0 md:space-x-6">

                <!-- Sidebar with Genres -->
                <aside class="w-full md:w-1/4 bg-white rounded-xl shadow p-4">
                    <a href="{{ route('home') }}" class="text-lg font-semibold mb-4 block hover:underline text-gray-800">
                        ← All Threads
                    </a>
                    <ul class="space-y-2">
                        @foreach($allGenres as $g)
                            <li>
                                <a href="{{ route('genres.show', $g->id) }}"
                                   class="block px-3 py-2 rounded-md transition
                                   {{ $g->id === $genre->id
                                   ? 'bg-emerald-200 text-emerald-800 font-semibold'
                                   : 'text-gray-700 hover:bg-emerald-100 hover:text-emerald-700' }}">
                                   {{ $g->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </aside>

                <!-- show threads in selected genre -->
                <section class="flex-1 bg-white rounded-xl shadow p-4">
                    <h3 class="text-lg font-semibold mb-4">
                        Threads in <span class="text-emerald-700">{{ $genre->name }} Threads</h3>

                    @if($genre->threads->count())
                        <div class="grid gap-4">
                            @foreach($genre->threads as $thread)
                                <div class="flex items-start space-x-6 border-b pb-4">

                                    <!-- Buchcover  -->
                                    @if($thread->cover_image)
                                        <div class="flex-shrink-0 bg-white rounded-md shadow-sm overflow-hidden"
                                            style="width: 64px; height: 96px;">
                                            <img src="{{ $thread->cover_image }}"
                                                 alt="Cover of {{ $thread->title }}"
                                                 class="w-full h-full object-cover block" />
                                        </div>
                                    @else
                                        <div class="flex-shrink-0 flex items-center justify-center text-sm text-gray-500 rounded-md shadow-sm bg-gray-200"
                                            style="width: 64px; height: 96px;">
                                            No Cover
                                        </div>
                                    @endif

                                    <!-- Thread-Infos -->
                                    <div class="flex-1">
                                        <a href="{{ route('threads.show', $thread->id) }}"
                                           class="text-xl font-medium text-blue-700 hover:underline block mb-1">
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
                                        <p class="text-gray-700">
                                            {{ \Illuminate\Support\Str::limit($thread->body, 100) }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">No threads found in this genre.</p>
                    @endif
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
