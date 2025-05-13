<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome, fellow reader!👋') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-8">
            @if($threads->count())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Threads Created by You</h3>
                    <ul class="space-y-4">
                        @foreach($threads as $thread)
                            <li class="border-b pb-2">
                                <a href="{{ route('threads.show', $thread->id) }}" class="text-blue-600 hover:underline">
                                    {{ $thread->title }}
                                </a>
                                <p class="text-sm text-gray-500">
                                    Created at: {{ $thread->created_at->format('M d, Y') }}
                                </p>
                            </li>
                        @endforeach
                    </ul>
                    <div class="mt-4">
                        {{ $threads->links() }}
                    </div>
                </div>
            @else
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <p>You haven’t posted any threads yet.</p>
                    <a href="{{ route('threads.create') }}" class="text-blue-600 hover:underline">Create your first thread</a>
                </div>
            @endif
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-semibold mb-4">Bookmarked Threads</h3>
            @if(auth()->user()->bookmarkedThreads->count())
                <ul class="space-y-4">
                    @foreach(auth()->user()->bookmarkedThreads as $bookmarked)
                        <li class="border-b pb-2">
                            <a href="{{ route('threads.show', $bookmarked->id) }}" class="text-blue-600 hover:underline">
                                {{ $bookmarked->title }}
                            </a>
                            <p class="text-sm text-gray-500">
                                Created at: {{ $bookmarked->created_at->format('M d, Y') }}
                            </p>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>You haven’t bookmarked any threads yet.</p>
            @endif
            </div>
        </div>
    </div>
</x-app-layout>
