<x-app-layout>
    <h1>{{ $genre->name }} Threads</h1>
    <ul>
        @foreach ($threads as $thread)
            <li><a href="{{ route('threads.show', $thread) }}">{{ $thread->title }}</a></li>
        @endforeach
    </ul>
    <a href="#">+ Create new thread</a>
</x-app-layout>
