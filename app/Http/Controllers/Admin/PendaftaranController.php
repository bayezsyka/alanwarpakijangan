<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\LogsActivity;

class PendaftaranController extends Controller
{
    use LogsActivity;

    public function index()
    {
        $pendaftarans = Pendaftaran::latest()->paginate(15);
        return view('admin.pendaftaran.index', compact('pendaftarans'));
    }

    public function show(Pendaftaran $pendaftaran)
    {
        return view('admin.pendaftaran.show', compact('pendaftaran'));
    }

    public function updateStatus(Request $request, Pendaftaran $pendaftaran)
    {
        $request->validate([
            'status' => 'required|in:pending,diterima,ditolak',
        ]);

        $pendaftaran->status = $request->input('status');
        $pendaftaran->save();

        $this->logActivity('ubah status pendaftaran', 'Nama: ' . $pendaftaran->nama_lengkap . ' | Status: ' . $pendaftaran->status);

        return back()->with('success', 'Status pendaftaran berhasil diperbarui!');
    }

    public function destroy(Pendaftaran $pendaftaran)
    {
        // Hapus file terkait
        if ($pendaftaran->foto_santri) {
            Storage::disk('public')->delete($pendaftaran->foto_santri);
        }
        if ($pendaftaran->scan_kk) {
            Storage::disk('public')->delete($pendaftaran->scan_kk);
        }
        if ($pendaftaran->scan_ijazah) {
            Storage::disk('public')->delete($pendaftaran->scan_ijazah);
        }

        $this->logActivity('hapus pendaftaran', 'Nama: ' . $pendaftaran->nama_lengkap);

        $pendaftaran->delete();

        return redirect()->route('admin.pendaftaran.index')->with('success', 'Data pendaftar berhasil dihapus.');
    }
}
