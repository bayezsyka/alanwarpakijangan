<?php

namespace Database\Seeders;

use App\Models\User; // <-- 1. PASTIKAN MODEL USER DI-IMPORT
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // <-- 2. PASTIKAN HASH DI-IMPORT

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 3. Buat satu user default secara langsung di sini
        User::factory()->create([
            'name' => 'Direktorat Pengembangan', 
            'email' => 'admin@alanwar.id', 
            'password' => Hash::make('Pakijangan@67'), 
        ]);
    }
}