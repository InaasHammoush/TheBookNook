<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;
use App\Models\Genre;


class GenreController extends Controller
    {
        public function index()
        {
            $supabaseUrl = env('SUPABASE_URL');
            $supabaseKey = env('SUPABASE_API_KEY');
        
            $headers = [
                'apikey' => $supabaseKey,
                'Authorization' => 'Bearer ' . $supabaseKey,
            ];
        
            // 1. Fetch all genres
            $genresResponse = Http::withHeaders($headers)->get("$supabaseUrl/rest/v1/genres?select=*");
            $genres = $genresResponse->json();
        
            // 2. Fetch recent threads (e.g., latest 10)
            $threadsResponse = Http::withHeaders($headers)->get("$supabaseUrl/rest/v1/threads?select=*&order=created_at.desc&limit=10");
            $threads = $threadsResponse->json();
                    
            return view('home', compact('genres', 'threads'));
        }

        public function show($id)
        {
            $supabaseUrl = env('SUPABASE_URL');
            $supabaseKey = env('SUPABASE_API_KEY');
        
            $headers = [
                'apikey' => $supabaseKey,
                'Authorization' => 'Bearer ' . $supabaseKey,
            ];
            // 1. Fetch genre by ID
            $genreResponse = Http::withHeaders($headers)->get("$supabaseUrl/rest/v1/genres?select=*&id=eq.$id");
        
            $genre = $genreResponse->json()[0] ?? null;
        
            // 2. Fetch threads for the genre
            $threadsResponse = Http::withHeaders($headers)->get("$supabaseUrl/rest/v1/threads?select=*&genre_id=eq.$id&order=created_at.desc");
            
            $threads = $threadsResponse->json();
        
            // Also fetch genres list for sidebar
            $genresResponse = Http::withHeaders($headers)->get("$supabaseUrl/rest/v1/genres?select=*");
        
            $genres = $genresResponse->json();
        
            return view('home', compact('genre', 'threads', 'genres'));
        }
        
}
