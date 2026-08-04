<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@smcngemboh.id'],
            [
                'name' => 'Admin SMC Ngemboh',
                'password' => 'admin123',
            ]
        );
    }
}