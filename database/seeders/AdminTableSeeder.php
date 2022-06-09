<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return \App\Models\User::create([
            'name' => "Admin",
            'email' => "artsruntorosyan@gmail.com",
            'password' => Hash::make(env("ADMIN_PASS")),
            'role' => User::ROLE_ADMIN
        ]);
    }
}
