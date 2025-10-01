<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserType;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([UserSeeder::class]);
        // Create user types if they don't exist
        if (!UserType::where('tipo', 'Administrador')->exists()) {
            UserType::create(['tipo' => 'Administrador']);
        }

        if (!UserType::where('tipo', 'Funcionário')->exists()) {
            UserType::create(['tipo' => 'Funcionário']);
        }

        // User::factory(10)->create();

        $adminUserType = UserType::where('tipo', 'Administrador')->first();

        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'user_type_id' => $adminUserType->id,
            ]);
        }
    }
}
