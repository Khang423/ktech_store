<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $admin_name = 'Vo Vi Khang';
        Member::query()->create([
            'name' => $admin_name,
            'phone' => '0799599040',
            'slug' => Str::slug($admin_name),
            'birthday' => '2003-02-04',
            'gender' => '0',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('241200ka',[
                'rounds' => 12,
            ])
        ]);
    }
}
