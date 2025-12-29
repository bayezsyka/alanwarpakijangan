<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if 'roles' column already exists (in case of partial migration)
        if (Schema::hasColumn('users', 'roles')) {
            // Already migrated, skip
            if (Schema::hasColumn('users', 'role')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->dropColumn('role');
                });
            }
            return;
        }

        // Step 1: Add new 'roles' column as text
        Schema::table('users', function (Blueprint $table) {
            $table->text('roles')->nullable()->after('password');
        });

        // Step 2: Migrate existing role data to roles array
        if (Schema::hasColumn('users', 'role')) {
            $users = DB::table('users')->get();
            foreach ($users as $user) {
                $roles = $user->role ? [$user->role] : ['admin'];
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['roles' => json_encode($roles)]);
            }

            // Step 3: Drop old 'role' column
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('role');
            });
        } else {
            // If role column doesn't exist, set default
            $users = DB::table('users')->get();
            foreach ($users as $user) {
                if (empty($user->roles)) {
                    DB::table('users')
                        ->where('id', $user->id)
                        ->update(['roles' => json_encode(['admin'])]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Step 1: Add back 'role' column
        if (!Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('role')->default('admin')->after('password');
            });
        }

        // Step 2: Migrate data back (take first role from array)
        if (Schema::hasColumn('users', 'roles')) {
            $users = DB::table('users')->get();
            foreach ($users as $user) {
                $roles = json_decode($user->roles, true);
                $firstRole = is_array($roles) && count($roles) > 0 ? $roles[0] : 'admin';
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['role' => $firstRole]);
            }

            // Step 3: Drop 'roles' column
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('roles');
            });
        }
    }
};
