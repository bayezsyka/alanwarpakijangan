<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Pastikan ini di-import
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class OtpController extends Controller
{
    /**
     * Membuat dan mengirimkan OTP via WAHA.
     */
    public function send(Request $request)
    {
        try {
            $validated = $request->validate([
                'nomor_wa' => ['required', 'string', 'min:10', 'max:15'],
            ]);

            $nomorWa = $validated['nomor_wa'];
            $otpCode = random_int(100000, 999999);

            // Simpan OTP ke session untuk verifikasi nanti
            session([
                'otp_code' => $otpCode,
                'otp_nomor_wa' => $nomorWa,
                'otp_expires_at' => now()->addMinutes(5),
            ]);

            // ### BAGIAN PENGIRIMAN PESAN WAHA ###

            // 1. Ambil konfigurasi dari file .env
            $apiUrl = env('WAHA_API_URL', 'http://localhost:3000');
            $sessionName = env('WAHA_SESSION_NAME', 'default');
            
            // 2. Siapkan pesan yang akan dikirim
            $pesan = "Kode verifikasi pendaftaran Anda adalah: *{$otpCode}*. Jangan berikan kode ini kepada siapapun.";
            
            // 3. Kirim request ke WAHA menggunakan HTTP Client Laravel
            $response = Http::withHeaders(['Content-Type' => 'application/json'])
                ->post("{$apiUrl}/api/sendText", [
                    'session' => $sessionName,
                    'chatId' => $nomorWa . '@c.us', // Format nomor untuk personal chat
                    'text' => $pesan,
                ]);

            // 4. Periksa jika pengiriman ke WAHA gagal
            if ($response->failed()) {
                // Catat error dari WAHA untuk debugging
                Log::error('WAHA API Error: ' . $response->body());
                // Lemparkan error agar bisa ditangkap oleh blok catch
                throw new \Exception('Gagal mengirim pesan WhatsApp via WAHA.');
            }

            // Catat jika berhasil
            Log::info("OTP untuk {$nomorWa} berhasil dikirim via WAHA. Response: " . $response->body());
            
            return response()->json(['message' => 'Kode OTP telah dikirim.']);

        } catch (ValidationException $e) {
            return response()->json(['message' => $e->validator->errors()->first()], 422);
        } catch (\Exception $e) {
            // Tangani semua error lain (misal: WAHA tidak aktif, koneksi gagal)
            Log::error('OTP Send Error: ' . $e->getMessage());
            return response()->json(['message' => 'Tidak dapat terhubung ke server WhatsApp. Pastikan WAHA aktif.'], 500);
        }
    }

    public function verify(Request $request)
    {
        try {
            // 1. Validasi input yang masuk
            $request->validate([
                'otp' => ['required', 'string', 'digits:6'],
                'nomor_wa' => ['required', 'string'],
            ]);

            // 2. Ambil data OTP dari session yang sudah kita simpan sebelumnya
            $otpInSession = session('otp_code');
            $nomorWaInSession = session('otp_nomor_wa');
            $expiresAt = session('otp_expires_at');

            // 3. Lakukan pengecekan
            if (!$otpInSession || now()->isAfter($expiresAt)) {
                // Jika tidak ada OTP di session atau sudah kedaluwarsa
                return response()->json(['message' => 'Kode OTP sudah kedaluwarsa, silakan kirim ulang.'], 422);
            }

            if ($otpInSession == $request->input('otp') && $nomorWaInSession == $request->input('nomor_wa')) {
                // Jika OTP dan nomor WA cocok
                session()->forget(['otp_code', 'otp_nomor_wa', 'otp_expires_at']); // Hapus session OTP
                return response()->json(['message' => 'Verifikasi berhasil!']);
            } else {
                // Jika OTP salah
                return response()->json(['message' => 'Kode OTP yang Anda masukkan salah.'], 422);
            }
        } catch (\Exception $e) {
            Log::error('OTP Verify Error: ' . $e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan di server.'], 500);
        }
    }
}