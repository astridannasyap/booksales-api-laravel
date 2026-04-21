<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create([
            'name' => 'J.K. Rowling',
            'photo' => 'jk_rowling.jpg',
            'bio' => 'J.K. Rowling is a British author best known for writing the Harry Potter fantasy series.'
        ]);

        Author::create([
            'name' => 'Yuval Noah Harari',
            'photo' => 'yuval_noah_harari.jpg',
            'bio' => 'Yuval Noah Harari is an Israeli historian and author of the best-selling book "Sapiens: A Brief History of Humankind."'
        ]);

        Author::create([
            'name' => 'James Clear',
            'photo' => 'james_clear.jpg',
            'bio' => 'James Clear is an author and speaker known for his expertise in habits, decision-making, and continuous improvement.'
        ]);

        Author::create([
            'name' => 'Susan Wise Bauer',
            'photo' => 'susan_wise_bauer.jpg',
            'bio' => 'Susan Wise Bauer is an American author and historian, known for her works on history and education.'
        ]);

        Author::create([
            'name' => 'Anne Frank',
            'photo' => 'anne_frank.jpg',
            'bio' => 'Anne Frank was a Jewish girl who gained fame posthumously with the publication of "The Diary of a Young Girl."'
        ]);
    }
}
