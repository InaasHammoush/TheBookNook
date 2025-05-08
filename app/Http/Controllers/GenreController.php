<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;


class GenreController extends Controller
    {
    public function index()
    {
        $genres = Genre::all();
        return view('genres.index', compact('genres'));
    }


    public function show(Genre $genre)
    {
        $genre->load(['threads' => function ($query) {
            $query->latest()->with('user');
        }]);

        $allGenres = \App\Models\Genre::all();

        return view('threads.show-genre', [
            'genre' => $genre,
            'allGenres' => $allGenres,
        ]);
    }

}
