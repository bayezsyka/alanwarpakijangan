<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Drop legacy tables that are no longer part of the application.
     */
    public function up(): void
    {
        $legacyTables = [
            'pendaftarans',
            'pendaftaran',
            'santris',
            'santri',
            'otps',
            'otp',
        ];

        foreach ($legacyTables as $table) {
            Schema::dropIfExists($table);
        }
    }

    /**
     * Legacy tables are intentionally not recreated.
     */
    public function down(): void
    {
        // Tables intentionally left absent; legacy feature removed.
    }
};
