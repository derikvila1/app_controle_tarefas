<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            [
                'name' => "David Vila",
                'email' => "davidfma92@gmail.com",
                'password' => Hash::make('123456'),
                'email_verified_at' => date_create()
            ]
        ]);


        $this->call([
            SpaceSeeder::class,
        ]);
    }
}