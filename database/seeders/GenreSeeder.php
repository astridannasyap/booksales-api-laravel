<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Genre::create([
            'name' => 'Fiction',
            'description' => 'Literary works based on imagination and invented narratives.'
        ]);

        Genre::create([
            'name' => 'Non-Fiction',
            'description' => 'Written works based on real events, facts, and accurate information.'
        ]); 

        Genre::create([
            'name' => 'Self-Improvement',
            'description' => 'Books focused on personal development and enhancing quality of life.'
        ]);

        Genre::create([
            'name' => 'History',
            'description' => 'Works that explore and analyze past events and historical figures.'
        ]);

        Genre::create([
            'name' => 'Biography',
            'description' => 'A detailed account of someone\'s life written by another person.'
        ]);
    }
    
}
