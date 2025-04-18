<x-app-layout>
    <h1>Genres</h1>
    <ul>
        @foreach ($genres as $genre)
            <li><a href="{{ route('genres.show', $genre) }}">{{ $genre->name }}</a></li>
        @endforeach
    </ul>
</x-app-layout>
