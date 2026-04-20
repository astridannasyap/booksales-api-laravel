<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
     private $books = [
        [
            'title' => 'Pulang',
            'description' => 'Petualangan seorang pemuda yang kembali ke desa kelahirannya.',
            'price' => 40000,
            'stock' => 15,
            'cover_photo' => 'pulang.jpg',
            'genre_id' => 1,
            'author_id' => 1
        ],
        [
            'title' => 'Sebuah Seni untuk Bersikap Bodo Amat',
            'description' => 'Buku yang membahas tentang kehidupan dan filosofi hidup seseorang.',
            'price' => 25000,
            'stock' => 5,
            'cover_photo' => 'sebuah_seni.jpg',
            'genre_id' => 2,
            'author_id' => 2
        ],
        [
            'title' => 'Laskar Pelangi',
            'description' => 'Kisah inspiratif anak-anak Belitung yang berjuang demi pendidikan.',
            'price' => 35000,
            'stock' => 20,
            'cover_photo' => 'laskar_pelangi.jpg',
            'genre_id' => 1,
            'author_id' => 3
        ],
        [
            'title' => 'Atomic Habits',
            'description' => 'Panduan membangun kebiasaan kecil yang memberikan hasil luar biasa.',
            'price' => 85000,
            'stock' => 10,
            'cover_photo' => 'atomic_habits.jpg',
            'genre_id' => 2,
            'author_id' => 4
        ],
        [
            'title' => 'Bumi Manusia',
            'description' => 'Novel sejarah tentang perjuangan dan cinta di era kolonial Indonesia.',
            'price' => 75000,
            'stock' => 8,
            'cover_photo' => 'bumi_manusia.jpg',
            'genre_id' => 1,
            'author_id' => 5
        ],
    ];

    public function getBooks()
    {
        return $this->books;
    } 
}
