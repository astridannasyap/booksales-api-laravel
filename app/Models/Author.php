<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    private $authors = [
    [
        'name' => 'Tere Liye',
        'photo' => 'tere_liye.jpg',
        'bio' => 'Indonesian author known for his inspirational and fictional novels loved by many readers across the country.'
    ],
    [
        'name' => 'Mark Manson',
        'photo' => 'mark_manson.jpg',
        'bio' => 'American blogger and author known for his unconventional self-help books and brutally honest life advice.'
    ],
    [
        'name' => 'Andrea Hirata',
        'photo' => 'andrea_hirata.jpg',
        'bio' => 'Indonesian author from Belitung, best known for his iconic novel Laskar Pelangi which inspired millions.'
    ],
    [
        'name' => 'James Clear',
        'photo' => 'james_clear.jpg',
        'bio' => 'American author and speaker specializing in habits, decision making, and continuous self-improvement.'
    ],
    [
        'name' => 'Pramoedya Ananta Toer',
        'photo' => 'pramoedya.jpg',
        'bio' => 'One of Indonesia\'s greatest literary figures, renowned for his historical novels and powerful storytelling.'
    ],
];

public function getAuthors()
{
    return $this->authors;
}
}
