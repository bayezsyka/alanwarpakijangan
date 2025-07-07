<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // <-- TAMBAHKAN INI

class PendaftaranController extends Controller
{
    public function index()
    {
        $pendaftarans = Pendaftaran::latest()->paginate(15);
        return view('admin.pendaftaran.index', compact('pendaftarans'));
    }

    public function show(Pendaftaran $pendaftaran)
    {
        return view('admin.pendaftaran.show', compact('pendaftaran'));
    }

    // ... (method updateStatus tetap ada) ...
    public function updateStatus(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate([
            'status' => 'required|in:pending,diterima,ditolak',
        ]);
        $pendaftaran->status = $request->input('status');
        $pendaftaran->save();
        return back()->with('success', 'Status pendaftaran berhasil diperbarui!');
    }


    /**
     * ### METHOD BARU UNTUK MENGHAPUS DATA ###
     */
    public function destroy(Pendaftaran $pendaftaran)
    {
        // 1. Hapus file-file yang terhubung untuk menghemat storage
        if ($pendaftaran->foto_santri) {
            Storage::disk('public')->delete($pendaftaran->foto_santri);
        }
        if ($pendaftaran->scan_kk) {
            Storage::disk('public')->delete($pendaftaran->scan_kk);
        }
        if ($pendaftaran->scan_ijazah) {
            Storage::disk('public')->delete($pendaftaran->scan_ijazah);
        }

        // 2. Hapus data dari database
        $pendaftaran->delete();

        // 3. Kembali ke halaman daftar dengan pesan sukses
        return redirect()->route('admin.pendaftaran.index')->with('success', 'Data pendaftar berhasil dihapus.');
    }
}