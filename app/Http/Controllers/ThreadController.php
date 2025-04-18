<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;


class ThreadController extends Controller
    {
    public function show(Thread $thread)
    {
        $comments = $thread->comments()->latest()->get();
        return view('threads.show', compact('thread', 'comments'));
    }
}
