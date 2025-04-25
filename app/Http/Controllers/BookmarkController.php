<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function store(Thread $thread)
    {
        auth()->user()->bookmarkedThreads()->attach($thread->id);
        return back()->with('success', 'Thread bookmarked!');
    }

    public function destroy(Thread $thread)
    {
        auth()->user()->bookmarkedThreads()->detach($thread->id);
        return back()->with('success', 'Bookmark removed!');
    }
}
