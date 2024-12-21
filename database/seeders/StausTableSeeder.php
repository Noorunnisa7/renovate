<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class StausTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentTimestamp = Carbon::now();

        $statuses = [
            ['statusName' => 'Not Contacted', 'statusType' => 1, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['statusName' => 'Interested', 'statusType' => 1, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['statusName' => 'Invoice Generated', 'statusType' => 1, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['statusName' => 'Not Interested', 'statusType' => 1, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['statusName' => 'WhatsApp Done', 'statusType' => 1, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['statusName' => 'Call Done', 'statusType' => 1, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['statusName' => 'Meeting Scheduled', 'statusType' => 1, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['statusName' => 'Not Responding', 'statusType' => 1, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['statusName' => 'Contact in Future', 'statusType' => 1, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['statusName' => 'Follow-up Required', 'statusType' => 1, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
            ['statusName' => 'Junk Lead', 'statusType' => 1, 'created_at' => $currentTimestamp, 'updated_at' => $currentTimestamp],
        ];

        DB::table('all_status')->insert($statuses);
    }
}
