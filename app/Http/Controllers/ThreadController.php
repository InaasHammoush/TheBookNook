<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\Genre;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;



class ThreadController extends Controller
    {
    use AuthorizesRequests;
    public function show(Thread $thread)
    {
        $comments = $thread->comments()->latest()->get();
        return view('threads.show', compact('thread', 'comments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'genre_id' => 'required|exists:genres,id',
            'book_info' => 'nullable|string',
        ]);

        $book = $request->book_info ? json_decode($request->book_info, true) : null;

        $thread = Thread::create([
            'title' => $request->title,
            'body' => $request->content,
            'user_id' => auth()->id(),
            'book_title' => $book['title'] ?? null,
            'genre_id' => $request->genre_id,
            'book_authors' => isset($book['authors']) ? implode(', ', $book['authors']) : null,
            'book_api_id' => $book['id'] ?? null,
        ]);

        return redirect()->route('threads.show', $thread);
    }

    public function create()
{
    $genres = Genre::all(); // To populate genre dropdown
    return view('threads.create', compact('genres'));
}

    public function edit(Thread $thread)
    {
        $this->authorize('update', $thread);
        return view('threads.edit-threads', compact('thread'));
    }

    public function update(Request $request, Thread $thread)
    {
        $this->authorize('update', $thread);

        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $thread->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('threads.show', $thread)->with('success', 'Thread updated.');
    }

    public function destroy(Thread $thread)
    {
        $this->authorize('delete', $thread);
        $thread->delete();

        return redirect()->route('home')->with('success', 'Thread deleted.');
    }

    // public function edit(Thread $thread)
    // {
    //     $genres = Genre::all(); // To populate genre dropdown
    //     return view('threads.edit', compact('thread', 'genres'));
    // }

    // public function update(Request $request, Thread $thread)
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'content' => 'required|string',
    //         'book_info' => 'nullable|string',
    //     ]);

    //     $book = $request->book_info ? json_decode($request->book_info, true) : null;

    //     $thread->update([
    //         'title' => $request->title,
    //         'content' => $request->content,
    //         'book_title' => $book['title'] ?? null,
    //         'book_authors' => $book['authors'] ?? null,
    //         'book_api_id' => $book['id'] ?? null,
    //     ]);

    //     return redirect()->route('threads.show', $thread);
    // }

}
