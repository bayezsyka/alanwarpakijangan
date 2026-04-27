<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule; // <-- 1. PASTIKAN INI DI-IMPORT

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Production cron: * * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
Schedule::command('sitemap:generate')->daily();
