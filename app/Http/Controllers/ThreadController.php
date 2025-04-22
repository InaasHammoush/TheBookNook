<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\Genre;


class ThreadController extends Controller
    {
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
            'book_authors' => $book['authors'] ?? null,
            'book_api_id' => $book['id'] ?? null,
        ]);

        return redirect()->route('threads.show', $thread);
    }

    public function create()
{
    $genres = Genre::all(); // To populate genre dropdown
    return view('threads.create', compact('genres'));
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
