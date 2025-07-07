<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    /**
     * Menampilkan form pendaftaran.
     */
    public function create()
    {
        return view('pendaftaran');
    }

    /**
     * Menyimpan data pendaftaran baru dari form publik.
     */
    public function store(Request $request)
    {
        // 1. Validasi semua input dari form
        $validatedData = $request->validate([
            'nama_lengkap'    => 'required|string|max:255',
            'nik'             => 'required|string|digits:16|unique:pendaftarans,nik',
            'nisn'            => 'nullable|string|digits:10',
            'nomor_wa'        => 'required|string|max:15',
            'jenis_kelamin'   => 'required|string',
            'tempat_lahir'    => 'required|string|max:100',
            'tanggal_lahir'   => 'required|date',
            'alamat'          => 'required|string',
            'nama_ayah'       => 'required|string|max:255',
            'pekerjaan_ayah'  => 'required|string|max:100',
            'telepon_ayah'    => 'required|string|max:15',
            'nama_ibu'        => 'required|string|max:255',
            'pekerjaan_ibu'   => 'required|string|max:100',
            'telepon_ibu'     => 'required|string|max:15',
            'nama_wali'       => 'nullable|string|max:255',
            'pekerjaan_wali'  => 'nullable|string|max:100',
            'telepon_wali'    => 'nullable|string|max:15',
            'hubungan_wali'   => 'nullable|string|max:100',
            'asal_sekolah'    => 'required|string|max:100',
            'tahun_lulus'     => 'required|digits:4',
            'foto_santri'     => 'required|file|image|mimes:jpg,png,jpeg|max:2048', // maks 2MB
            'scan_kk'         => 'required|file|mimes:jpg,png,jpeg,pdf|max:2048',
            'scan_ijazah'     => 'required|file|mimes:jpg,png,jpeg,pdf|max:2048',
        ]);

        // 2. Proses upload file dan simpan path-nya
        if ($request->hasFile('foto_santri')) {
            $validatedData['foto_santri'] = $request->file('foto_santri')->store('pendaftaran/foto', 'public');
        }
        if ($request->hasFile('scan_kk')) {
            $validatedData['scan_kk'] = $request->file('scan_kk')->store('pendaftaran/kk', 'public');
        }
        if ($request->hasFile('scan_ijazah')) {
            $validatedData['scan_ijazah'] = $request->file('scan_ijazah')->store('pendaftaran/ijazah', 'public');
        }

        // 3. Simpan semua data ke database
        Pendaftaran::create($validatedData);

        // 4. Redirect ke halaman utama dengan pesan sukses
        return redirect()->route('welcome')->with('success', 'Pendaftaran Anda telah berhasil dikirim! Kami akan segera menghubungi Anda.');
    }
}