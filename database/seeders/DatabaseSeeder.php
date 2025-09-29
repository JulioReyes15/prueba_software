<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       
        User::updateOrCreate(
            ['email' => 'servicios@gmail.com'],
            [
                'name' => 'julio',
                'password' => Hash::make('12345678'),
            ]
            );
    }
}
