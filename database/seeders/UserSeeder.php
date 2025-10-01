<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserType::uptadeOrCreate(
            ['id' => 1],
            ['tipo' => 'Administrador']
        );

        UserType::uptadeOrCreate(
            ['id' => 2],
            ['tipo' => 'Funcionário']
        );

        User::uptadeOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'),
                'user_type_id' => 1,
                'email_verified_at' => now()
            ]
        );
    }
}
