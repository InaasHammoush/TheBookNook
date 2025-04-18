@extends('layouts.app')

@section('content')
<div style="display: flex;">
    {{-- Sidebar: Genres --}}
    <aside style="width: 20%; padding: 1rem; border-right: 1px solid #ccc;">
        <h3>Genres</h3>
        <ul>
            @foreach ($genres as $g)
            <li>
                <a href="{{ route('genres.show', $g['id']) }}"
                   class="{{ isset($genre) && $genre['id'] == $g['id'] ? 'font-bold' : '' }}">
                    {{ $g['name'] }}
                </a>
            </li>
        @endforeach
        
        </ul>
    </aside>

    {{-- Main Content: Threads --}}
    <main style="width: 80%; padding: 1rem;">
        <h1 class="text-2xl font-bold mb-4">
            {{ isset($genre) ? $genre['name'] . ' Threads' : 'Latest Threads' }}
        </h1>
        
        <ul>
            @forelse ($threads as $thread)
                <li class="mb-2">
                    <a href="{{ route('threads.show', $thread['id']) }}" class="text-blue-600 hover:underline">
                        {{ $thread['title'] }}
                    </a>
                </li>
            @empty
                <li>No threads found for this genre.</li>
            @endforelse
        </ul>        
    </main>
</div>
@endsection
