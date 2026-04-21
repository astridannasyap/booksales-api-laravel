<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'title' => 'The Great Gatsby',
            'description' => 'A novel by F. Scott Fitzgerald about the American dream.',
            'price' => 10.99,
            'stock' => 100,
            'cover_photo' => 'great_gatsby.jpg',
            'genre_id' => 1, 
            'author_id' => 1, 
        ]);

        Book::create([
            'title' => 'Sapiens: A Brief History of Humankind',
            'description' => 'A book by Yuval Noah Harari that explores the history of humanity.',
            'price' => 15.99,
            'stock' => 50,
            'cover_photo' => 'sapiens.jpg',
            'genre_id' => 2, 
            'author_id' => 2, 
        ]);

        Book::create([
            'title' => 'Atomic Habits',
            'description' => 'A book by James Clear that provides strategies for building good habits.',
            'price' => 12.99,
            'stock' => 75,
            'cover_photo' => 'atomic_habits.jpg',
            'genre_id' => 3, 
            'author_id' => 3, 
        ]);

        Book::create([
            'title' => 'The History of the Ancient World',
            'description' => 'A book by Susan Wise Bauer that covers the history of ancient civilizations.',
            'price' => 20.99,
            'stock' => 30,
            'cover_photo' => 'ancient_world.jpg',
            'genre_id' => 4, 
            'author_id' => 4, 
        ]);

        Book::create([
            'title' => 'The Diary of a Young Girl',     
            'description' => 'A book by Anne Frank that details her experiences during the Holocaust.',
            'price' => 14.99,
            'stock' => 60,
            'cover_photo' => 'diary_girl.jpg',
            'genre_id' => 5, 
            'author_id' => 5, 
        ]);

    }
}
