<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Thread;

class HomeController extends Controller
{
    public function index()
    {
        $genres = Genre::all();
        $threads = Thread::with('genre', 'user')->latest()->get();

        return view('home', compact('genres', 'threads'));
    }
}
