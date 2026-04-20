<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    private $genres = [
        [
            'name' => 'Fiction',
            'description' => 'Literary works based on imagination and invented narratives.'
        ],
        [
            'name' => 'Non-Fiction',
            'description' => 'Written works based on real events, facts, and accurate information.'
        ],
        [
            'name' => 'Self-Improvement',
            'description' => 'Books focused on personal development and enhancing quality of life.'
        ],
        [
            'name' => 'History',
            'description' => 'Works that explore and analyze past events and historical figures.'
        ],
        [
            'name' => 'Biography',
            'description' => 'A detailed account of someone\'s life written by another person.'
        ],
    ];

    public function getGenres()
    {
        return $this->genres;
    }
}
