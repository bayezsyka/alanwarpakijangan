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
        // 3. Buat user default superadmin secara langsung di sini
        User::firstOrCreate(
            ['email' => 'admin@alanwar.id'],
            [
                'name' => 'Direktorat Pengembangan', 
                'password' => Hash::make('Pakijangan@67'), 
                'roles' => ['superadmin'],
            ]
        );
    }
}