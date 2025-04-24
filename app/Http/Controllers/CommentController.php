<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Thread;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class CommentController extends Controller
{
    use AuthorizesRequests;
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

    public function edit(Comment $comment)
    {
        $this->authorize('update', $comment);

        return view('threads.edit-comment', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $validated = $request->validate([
            'body' => 'required|string|max:5000',
        ]);

        $comment->update($validated);

        return redirect()->route('threads.show', $comment->thread_id)->with('success', 'Comment updated.');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect()->route('threads.show', $comment->thread_id)->with('success', 'Comment deleted.');
    }

}
