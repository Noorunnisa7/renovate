<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['name' => 'Karachi'],
            ['name' => 'Lahore'],
            ['name' => 'Islamabad'],
            ['name' => 'Hyderabad'],
        ];

        DB::table('city')->insert($cities);
    }
}
