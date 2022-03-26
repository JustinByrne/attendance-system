<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\AttendanceStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AttendanceStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                "code" => "P",
                "description" => "Present",
                "created_at" => Carbon::now()->toDateTimeString(),
                "updated_at" => Carbon::now()->toDateTimeString(),
            ],
            [
                "code" => "N",
                "description" => "Unauthorised Absensent",
                "created_at" => Carbon::now()->toDateTimeString(),
                "updated_at" => Carbon::now()->toDateTimeString(),
            ],
            [
                "code" => "A",
                "description" => "Authorised Absense",
                "created_at" => Carbon::now()->toDateTimeString(),
                "updated_at" => Carbon::now()->toDateTimeString(),
            ],
        ];

        AttendanceStatus::insert($statuses);
    }
}
