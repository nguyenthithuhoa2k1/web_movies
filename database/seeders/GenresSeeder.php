<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genres;

class GenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Genres::truncate();
        $arr = [
            ['genres'=>'Phim chiếu rạp'],
            ['genres'=>'Phim lẻ'],
            ['genres'=>'Phim bộ'],
        ];
        Genres::insert($arr);
    }
}
