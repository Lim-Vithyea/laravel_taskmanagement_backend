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
        // \App\Models\User::factory(10)->create();
         DB::table('users')->insert([
            'name' => 'Seng',
            'email' => 'seng@example.com',
            'password' => Hash::make('12345678'), // Always hash passwords!
            'role' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
