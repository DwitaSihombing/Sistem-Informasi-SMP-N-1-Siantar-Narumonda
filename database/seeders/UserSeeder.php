<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Admin",
            'email' => "admin@admin.local",
            'role' => 99,
            'password' => Hash::make("Porsea77"),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // php artisan migrate:fresh --seed
    }
}
