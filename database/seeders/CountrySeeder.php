<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::truncate();
        $countries = [
            ['country' => 'Afghanistan'],
            ['country' => 'Åland Islands'],
            ['country' => 'Albania'],
            ['country' => 'Algeria'],
            ['country' => 'American Samoa'],
        ];
        Country::insert($countries);
    }
}