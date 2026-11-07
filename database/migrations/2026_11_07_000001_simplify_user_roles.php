<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $users = DB::table('users')->get();

        foreach ($users as $user) {
            $roles = json_decode($user->roles ?? '[]', true);
            if (!is_array($roles)) {
                $roles = [];
            }

            // User pertama / default admin dijadikan superadmin
            if ($user->id === 1 || $user->email === 'admin@alanwar.id' || in_array('superadmin', $roles)) {
                $newRoles = ['superadmin'];
            } else {
                $newRoles = ['admin'];
            }

            DB::table('users')
                ->where('id', $user->id)
                ->update(['roles' => json_encode($newRoles)]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert ke struktur default role admin
        DB::table('users')->update(['roles' => json_encode(['admin'])]);
    }
};

