<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::truncate();
        $arr=[
            ['category'=>'phim hành động'],
            ['category'=>'phim kinh dị'],
            ['category'=>'phim tình cảm - lãng mạn'],
            ['category'=>'phim cổ trang'],
            ['category'=>'phim kiếm hiệp'],
            ['category'=>'phim hài'],
            ['category'=>'phim phiêu Lưu'],
            ['category'=>'phim võ thuật'],
        ];
        Category::insert($arr);
    }
}
