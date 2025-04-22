<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Thread;

class CommentController extends Controller
{
    public function store(Request $request, $threadId)
    {
        $request->validate([
            'body' => 'required|string|max:2000',
        ]);

        $thread = Thread::findOrFail($threadId);

        $comment = new Comment([
            'body' => $request->body,
            'user_id' => auth()->id(),
        ]);

        $thread->comments()->save($comment);

        return redirect()->route('threads.show', $threadId)->with('success', 'Comment posted!');
    }
}
