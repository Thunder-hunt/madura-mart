<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ─── Admin default ──────────────────────────────────────────────────
        User::firstOrCreate(
            ['email' => 'admin@123.com'],
            [
                'name'     => 'Super Admin',
                'password' => Hash::make('Admin123!'),
                'role'     => 'admin',
            ]
        );

        // ─── 3 User dummy ────────────────────────────────────────────────────
        User::factory(3)->create(['role' => 'user']);
    }
}
