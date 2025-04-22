<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        $threads = Thread::query()
            ->where('title', 'like', '%' . $query . '%')
            ->orWhere('book_title', 'like', '%' . $query . '%')
            ->orWhere('body', 'like', '%' . $query . '%')
            ->limit(20)
            ->get(['id', 'title']);

        return response()->json($threads);
    }
}
