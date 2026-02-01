<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'location' => 'Casablanca, Maroc',
            'latitude' => 33.5731,
            'longitude' => -7.5898,
        ]);

        // Utilisateur 1
        User::create([
            'name' => 'Amine',
            'email' => 'amine@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'location' => 'Rabat, Maroc',
            'latitude' => 34.0209,
            'longitude' => -6.8416,
        ]);

        // Utilisateur 2
        User::create([
            'name' => 'Fatima',
            'email' => 'fatima@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'location' => 'Marrakech, Maroc',
            'latitude' => 31.6295,
            'longitude' => -7.9811,
        ]);

        // Utilisateur 3
        User::create([
            'name' => 'Youssef',
            'email' => 'youssef@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'location' => 'Tanger, Maroc',
            'latitude' => 35.7595,
            'longitude' => -5.8340,
        ]);
    }
}