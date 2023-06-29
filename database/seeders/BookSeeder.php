<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::create([
            'id'=>1,
            'user_id'=> 1,
            'code_book'=>'23456',
            'title'=>'Logika Informatika',
            'pub_year'=>'19 September 2019',
            'author'=>'Papa Jeni',
            'stock'=> 5,
            'photo'=>'public/assets/user/user1.png',
        ]);

        Book::create([
            'id'=>2,
            'user_id'=> 1,
            'code_book'=>'23451',
            'title'=>'Teknik Komputer dan Jaringan',
            'pub_year'=>'19 Agustus 2015',
            'author'=>'Encing Ompong',
            'stock'=> 4,
            'photo'=>'public/assets/user/user1.png',
        ]);

        Book::create([
            'id'=>3,
            'user_id'=> 1,
            'code_book'=>'23456',
            'title'=>'Database SQL',
            'pub_year'=>'19 Januari 2019',
            'author'=>'Tim Ajag Ijig',
            'stock'=> 7,
            'photo'=>'public/assets/user/user1.png',
        ]);
    }
}
