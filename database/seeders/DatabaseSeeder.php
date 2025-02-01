<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            "first_name" => "Test",
            "last_name" => "User",
            "email" => "test@email.com",
            "password" => Hash::make('Testpass1')
        ]);
    }
}
