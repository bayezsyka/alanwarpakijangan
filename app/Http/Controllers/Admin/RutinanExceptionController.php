<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rutinan;
use App\Models\RutinanException;
use Illuminate\Http\Request;
use App\Traits\LogsActivity;


class RutinanExceptionController extends Controller
{
    use LogsActivity;

    public function store(Request $request, Rutinan $rutinan)
    {
        $validated = $request->validate([
            'libur_date' => 'required|date|unique:rutinan_exceptions,libur_date,NULL,id,rutinan_id,'.$rutinan->id,
        ]);

        $rutinan->exceptions()->create($validated);

        $this->logActivity(
            'tambah tanggal libur rutinan',
            'Jadwal: ' . $rutinan->nama_acara . ', Tanggal Libur: ' . $validated['libur_date']
        );

        return back()->with('success', 'Tanggal libur berhasil ditambahkan.');
    }

    public function destroy(RutinanException $exception)
    {
        // Pastikan relasi 'rutinan' dimuat
        $exception->load('rutinan');

        $liburDate = $exception->libur_date;
        $rutinan = $exception->rutinan;

        // Catat log terlebih dahulu
        $this->logActivity(
            'hapus tanggal libur rutinan',
            'Jadwal: ' . $rutinan->nama_acara . ', Tanggal Dihapus: ' . $liburDate
        );

        // Lalu hapus datanya
        $exception->delete();

        return back()->with('success', 'Jadwal libur berhasil dibatalkan.');
    }
}
