<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

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
     * Method untuk validasi real-time via AJAX.
     */
    public function ajaxValidate(Request $request)
    {
        try {
            $request->validate([
                'nik' => ['required', 'string', 'digits:16', 'unique:pendaftarans,nik'],
            ]);
            return response()->json(['message' => 'Data awal valid!']);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    /**
     * Menyimpan data pendaftaran baru dari form publik.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lengkap'    => ['required', 'string', 'max:255'],
            'nik'             => ['required', 'string', 'digits:16', 'unique:pendaftarans,nik'],
            'nisn'            => ['nullable', 'string', 'digits:10'],
            'nomor_wa'        => ['required', 'string', 'max:20'],
            'jenis_kelamin'   => ['required', 'string', 'in:Laki-laki,Perempuan'],
            'tempat_lahir'    => ['required', 'string', 'max:100'],
            'tanggal_lahir'   => ['required', 'date'],
            'alamat'          => ['required', 'string'],
            'nama_ayah'       => ['required', 'string', 'max:255'],
            'pekerjaan_ayah'  => ['required', 'string', 'max:100'],
            'telepon_ayah'    => ['required', 'string', 'max:20'],
            'nama_ibu'        => ['required', 'string', 'max:255'],
            'pekerjaan_ibu'   => ['required', 'string', 'max:100'],
            'telepon_ibu'     => ['required', 'string', 'max:20'],
            'nama_wali'       => ['nullable', 'string', 'max:255'],
            'pekerjaan_wali'  => ['nullable', 'string', 'max:100'],
            'telepon_wali'    => ['nullable', 'string', 'max:20'],
            'hubungan_wali'   => ['nullable', 'string', 'max:100'],
            'asal_sekolah'    => ['required', 'string', 'max:100'],
            'tahun_lulus'     => ['required', 'digits:4', 'integer', 'min:1950', 'max:' . (date('Y') + 1)],
            'foto_santri'     => ['required', 'file', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
            'scan_kk'         => ['required', 'file', 'mimes:jpg,png,jpeg,pdf', 'max:2048'],
            'scan_ijazah'     => ['required', 'file', 'mimes:jpg,png,jpeg,pdf', 'max:2048'],
        ]);

        if ($request->hasFile('foto_santri')) {
            $validatedData['foto_santri'] = $request->file('foto_santri')->store('pendaftaran/foto', 'public');
        }
        if ($request->hasFile('scan_kk')) {
            $validatedData['scan_kk'] = $request->file('scan_kk')->store('pendaftaran/kk', 'public');
        }
        if ($request->hasFile('scan_ijazah')) {
            $validatedData['scan_ijazah'] = $request->file('scan_ijazah')->store('pendaftaran/ijazah', 'public');
        }

        $pendaftar = Pendaftaran::create($validatedData);

        if ($pendaftar) {
            $this->sendWhatsAppNotification($pendaftar);
        }

        return redirect()->route('pendaftaran.create')->with('registration_success', true);
    }
    
    /**
     * Fungsi pribadi untuk mengirim notifikasi WhatsApp via WAHA
     */
    private function sendWhatsAppNotification(Pendaftaran $pendaftar)
    {
        try {
            $apiUrl = env('WAHA_API_URL', 'http://localhost:3000');
            $sessionName = env('WAHA_SESSION_NAME', 'default');
            $groupLink = env('WA_GROUP_LINK', '');

            if (empty($groupLink)) {
                Log::warning('WA_GROUP_LINK belum diatur di file .env');
                return;
            }

            $pesan = "Assalamualaikum, {$pendaftar->nama_lengkap}.\n\nTerima kasih, formulir pendaftaran Anda telah kami terima. Selanjutnya, silakan bergabung ke grup WhatsApp melalui link berikut untuk mendapatkan informasi lebih lanjut:\n\n{$groupLink}";

            Http::withHeaders(['Content-Type' => 'application/json'])
                ->post("{$apiUrl}/api/sendText", [
                    'session' => $sessionName,
                    'chatId' => $pendaftar->nomor_wa . '@c.us',
                    'text' => $pesan,
                ]);

            Log::info("Notifikasi pendaftaran berhasil dikirim ke {$pendaftar->nomor_wa}");

        } catch (\Exception $e) {
            Log::error('Gagal mengirim notifikasi WA untuk pendaftar: ' . $e->getMessage());
        }
    }
}