<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class SourceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentTimestamp = Carbon::now();

        $sources = [
            ['name' => 'Call', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Referral', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Exhibition / Event', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Whatsapp', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Walk-in', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'FB', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Instagram', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Google', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Other', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Website', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['name' => 'Daraz', 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
        ];

        DB::table('source')->insert($sources);
    }
}
