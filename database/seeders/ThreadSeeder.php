<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Thread;
use App\Models\Genre;

class ThreadSeeder extends Seeder
{
    public function run(): void
    {
        $genres = Genre::all();

        foreach ($genres as $genre) {
            Thread::create([
                'title' => "A discussion about {$genre->name}",
                'body' => "This thread is for everyone who loves {$genre->name} books!",
                'genre_id' => $genre->id,
                'user_id' => 1 
            ]);
        }
    }
}
