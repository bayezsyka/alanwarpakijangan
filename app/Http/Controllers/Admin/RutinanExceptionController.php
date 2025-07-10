<?php
// LOKASI: app/Http/Controllers/Admin/RutinanExceptionController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rutinan;
use App\Models\RutinanException;
use Illuminate\Http\Request;

class RutinanExceptionController extends Controller
{
    public function store(Request $request, Rutinan $rutinan)
    {
        $validated = $request->validate([
            'libur_date' => 'required|date|unique:rutinan_exceptions,libur_date,NULL,id,rutinan_id,'.$rutinan->id,
        ]);

        $rutinan->exceptions()->create($validated);

        return back()->with('success', 'Tanggal libur berhasil ditambahkan.');
    }

    public function destroy(RutinanException $exception)
    {
        $exception->delete();
        return back()->with('success', 'Jadwal libur berhasil dibatalkan.');
    }
}