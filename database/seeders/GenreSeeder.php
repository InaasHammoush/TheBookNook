<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = ['Fantasy', 'Science Fiction', 'Mystery', 'Romance', 'Historical', 'Non-Fiction'];

        foreach ($genres as $name) {
            Genre::create(['name' => $name]);
        }
    }
}

