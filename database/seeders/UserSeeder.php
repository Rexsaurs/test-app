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
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@email.com',
            'phone' => '08121345678',
            'password' => Hash::make('12345'),
            'role_id' => 1
        ]);

        User::create([
            'name' => 'Admin1',
            'username' => 'admin1',
            'email' => 'admin1@email.com',
            'phone' => '081213456789',
            'password' => Hash::make('12345'),
            'role_id' => 1
        ]);

        User::create([
            'name' => 'Admin2',
            'username' => 'admin2',
            'email' => 'admin2@email.com',
            'phone' => '0812134567891',
            'password' => Hash::make('12345'),
            'role_id' => 1
        ]);

        User::create([
            'name' => 'Alumni',
            'username' => 'alumni',
            'email' => 'alumni@email.com',
            'phone' => '0812134567891',
            'password' => Hash::make('12345'),
            'role_id' => 2
        ]);
    }
}
