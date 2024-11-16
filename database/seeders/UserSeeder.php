<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tabel users.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'remember_token' => \Str::random(10),
        ]);

        User::factory(5)->create();
    }
}

