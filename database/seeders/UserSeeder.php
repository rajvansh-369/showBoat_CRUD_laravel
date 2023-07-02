<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!User::whereEmail('admin@hotel.com')->exists()){
            User::create([
                'name' => 'Test User',
                'email' => 'admin@showboat.com',
                'password' => Hash::make('123456'),
                'is_admin' => 1,
            ]);

        }
    }
}
