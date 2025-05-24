<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
class InsertAddressSeeder extends Seeder
{
    public function run()
    {
        DB::unprepared(File::get(database_path('address/address.sql')));
    }
}
