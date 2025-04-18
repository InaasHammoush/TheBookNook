<x-app-layout>
    <h1>{{ $thread->title }}</h1>
    <p>{{ $thread->body }}</p>
    <p><strong>Posted by:</strong> {{ $thread->user->name }}</p>

    <h2>Comments</h2>
    @foreach ($comments as $comment)
        <div>
            <strong>{{ $comment->user->name }}</strong>: {{ $comment->body }}
        </div>
    @endforeach
</x-app-layout>
