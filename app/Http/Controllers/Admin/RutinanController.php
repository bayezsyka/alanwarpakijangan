<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rutinan;
use Illuminate\Http\Request;
use App\Traits\LogsActivity;

class RutinanController extends Controller
{
    use LogsActivity;

    public function index()
    {
        $days = [6 => 'Sabtu', 0 => 'Minggu', 1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat'];
        $rutinans = Rutinan::with('exceptions')->get()->sortBy('waktu');
        $groupedRutinans = $rutinans->groupBy('day_of_week');

        return view('admin.rutinan.index', compact('groupedRutinans', 'days'));
    }

    public function create()
    {
        return view('admin.rutinan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_acara' => 'required|string|max:255',
            'pengisi' => 'nullable|string|max:255',
            'kitab' => 'nullable|string|max:255',
            'isi' => 'nullable|string',
            'tempat' => 'required|string|max:255',
            'waktu' => 'required|date_format:H:i',
            'day_of_week' => 'required|integer|between:0,6',
        ]);

        $rutinan = Rutinan::create($validated);

        $this->logActivity('buat rutinan', 'Acara: ' . $rutinan->nama_acara);

        return redirect()->route('admin.rutinan.index')->with('success', 'Jadwal rutinan berhasil ditambahkan.');
    }

    public function edit(Rutinan $rutinan)
    {
        $rutinan->load('exceptions');
        return view('admin.rutinan.edit', compact('rutinan'));
    }

    public function update(Request $request, Rutinan $rutinan)
    {
        $validated = $request->validate([
            'nama_acara' => 'required|string|max:255',
            'day_of_week' => 'required|integer|between:0,6',
            'waktu' => 'required|date_format:H:i',
            'tempat' => 'required|string|max:255',
            'pengisi' => 'nullable|string|max:255',
            'kitab' => 'nullable|string|max:255',
            'isi' => 'nullable|string',
        ]);

        $rutinan->update($validated);

        $this->logActivity('edit rutinan', 'Acara: ' . $rutinan->nama_acara);

        return redirect()->route('admin.rutinan.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(Rutinan $rutinan)
    {
        $this->logActivity('hapus rutinan', 'Acara: ' . $rutinan->nama_acara);

        $rutinan->delete();
        return redirect()->route('admin.rutinan.index')->with('success', 'Jadwal rutinan berhasil dihapus.');
    }
}
