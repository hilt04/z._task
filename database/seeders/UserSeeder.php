<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserType::updateOrCreate(
            ['id' => 1],
            ['tipo' => 'Administrador']
        );

        UserType::updateOrCreate(
            ['id' => 2],
            ['tipo' => 'Funcionário']
        );

        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin'),
                'user_type_id' => 1,
                'email_verified_at' => now()
            ]
        );
    }
}
