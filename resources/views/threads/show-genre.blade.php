<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex space-x-6">

                <!-- Sidebar with Genres -->
                <div class="w-1/4 bg-white rounded-lg shadow p-4">
                    <h3 class="text-lg font-semibold mb-4">Genres</h3>
                    <ul class="space-y-2">
                        @foreach($allGenres as $g)
                            <li>
                                <a href="{{ route('genres.show', $g->id) }}"
                                   class="block {{ $g->id === $genre->id ? 'font-bold text-blue-700' : 'text-blue-600 hover:underline' }}">
                                    {{ $g->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- show threads in selected genre -->
                <div class="flex-1 bg-white rounded-lg shadow p-4">
                    <h3 class="text-lg font-semibold mb-4">{{ $genre->name }} Threads</h3>

                    @if($genre->threads->count())
                        <ul class="space-y-6">
                            @foreach($genre->threads as $thread)
                                <li class="flex items-start space-x-6 border-b pb-4">
                                    <!-- Buchcover-Platzhalter -->
                                    @if($thread->cover_image)
                                    <div class="w-24 h-36 flex-shrink-0 rounded shadow-sm overflow-hidden">
                                        <img src="{{ $thread->cover_image }}"
                                             alt="Cover of {{ $thread->title }}"
                                             class="w-full h-full object-cover"/>
                                    </div>
                                    @else
                                        <div class="w-24 h-36 bg-gray-200 rounded shadow-sm flex-shrink-0 flex items-center justify-center text-sm text-gray-500">
                                            No Cover
                                        </div>
                                    @endif

                                    <!-- Thread-Infos -->
                                    <div class="flex-1">
                                        <a href="{{ route('threads.show', $thread->id) }}"
                                           class="text-xl font-medium text-blue-700 hover:underline block mb-1">
                                            {{ $thread->title }}
                                        </a>
                                        <p class="text-sm text-gray-500 mb-1">
                                            by {{ $thread->user->name ?? 'Anonymous' }}
                                        </p>
                                        <p class="text-gray-700">
                                            {{ \Illuminate\Support\Str::limit($thread->body, 100) }}
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No threads found in this genre.</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
