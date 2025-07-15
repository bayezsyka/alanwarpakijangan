<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait LogsActivity
{
    /**
     * Catat aktivitas ke database.
     *
     * @param string $action Aksi seperti 'create', 'update', 'delete'
     * @param string $description Deskripsi aktivitas
     * @return void
     */
    public function logActivity(string $action, string $description): void
    {
        ActivityLog::create([
            'user_id'     => Auth::check() ? Auth::id() : null,
            'action'      => $action,
            'description' => $description,
            'ip_address'  => Request::ip(),
        ]);
    }
}
