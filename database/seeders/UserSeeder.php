<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1qwertyu'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Agent',
            'email' => 'member@gmail.com',
            'password' => Hash::make('1qwertyu'),
            'role' => 'member'
        ]);

        User::create([
            'name' => 'RAI Tech',
            'email' => 'rai.technical@gmail.com',
            'password' => Hash::make('1qwertyu'),
            'role' => 'member'
        ]);

        User::create([
            'name' => 'RAI Official',
            'email' => 'rightapps.official@gmail.com',
            'password' => Hash::make('1qwertyu'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'User 2',
            'email' => 'user@gmail.com',
            'password' => Hash::make('1qwertyu'),
            'role' => 'user'
        ]);

        User::create([
            'name' => 'Johnny Brader',
            'email' => 'johnnybrader08@gmail.com',
            'password' => Hash::make('1qwertyu'),
            'role' => 'user'
        ]);

        User::create([
            'name' => 'User 3',
            'email' => 'u@gmail.com',
            'password' => Hash::make('1qwertyu'),
            'role' => 'user'
        ]);

        User::create([
            'name' => 'Member 2',
            'email' => 'm@gmail.com',
            'password' => Hash::make('1qwertyu'),
            'role' => 'member'
        ]);
    }
}