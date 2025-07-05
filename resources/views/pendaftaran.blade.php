<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Santri Baru - Pondok Pesantren Lirboyo</title>
    
    {{-- Tailwind CSS with custom configuration --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            600: '#1a56db',
                            700: '#1e4bb6',
                        },
                        secondary: {
                            600: '#059669',
                            700: '#047857',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    {{-- Font Awesome for icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-4xl bg-white rounded-xl shadow-lg overflow-hidden">
        {{-- Header with logo and title --}}
        <div class="bg-gradient-to-r from-primary-600 to-primary-700 p-6 text-white">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="flex justify-between items-center space-x-4 mb-4 md:mb-0">
                    <img src="{{ url('images/logo.png') }}" alt="Logo Lirboyo" class="h-12">
                    <div>
                        <h1 class="text-2xl font-bold">Pendaftaran Santri Baru</h1>
                        <p class="text-sm opacity-90">Pondok Pesantren Al-Anwar Pakijangan</p>
                    </div>
                    <div class="ml-auto item-right">
                        <a href="{{ url('/') }}" class="text-sm text-white hover:underline">
                            <i class="fas fa-home mr-1"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Progress indicator --}}
        <div class="px-6 pt-4">
            <div class="flex justify-between relative">
                <div class="flex flex-col items-center z-10">
                    <div class="h-8 w-8 rounded-full bg-primary-600 flex items-center justify-center text-white font-bold">1</div>
                    <span class="text-xs mt-1 text-center">Verifikasi</span>
                </div>
                <div class="flex flex-col items-center z-10">
                    <div class="h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 font-bold">2</div>
                    <span class="text-xs mt-1 text-center">Data Diri</span>
                </div>
                <div class="flex flex-col items-center z-10">
                    <div class="h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 font-bold">3</div>
                    <span class="text-xs mt-1 text-center">Selesai</span>
                </div>
                <div class="absolute h-0.5 bg-gray-200 w-full top-4"></div>
            </div>
        </div>

        <form id="registrationForm" action="/daftar" method="POST" enctype="multipart/form-data" class="p-6 md:p-8 space-y-8">
            @csrf
            
            {{-- ================================================================= --}}
            {{--                         VERIFICATION SECTION                        --}}
            {{-- ================================================================= --}}
            <div id="verificationSection">
                <div class="text-center">
                    <h2 class="text-2xl font-bold text-gray-800">Verifikasi Nomor WhatsApp</h2>
                    <p class="mt-2 text-gray-600">Masukkan nomor WhatsApp aktif untuk memulai pendaftaran.</p>
                </div>

                <div class="mt-8 max-w-md mx-auto space-y-6">
                    <div>
                        <label for="nomor_wa" class="block text-sm font-medium text-gray-700 mb-1">Nomor WhatsApp</label>
                        <div class="flex rounded-md shadow-sm">
                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">+62</span>
                            <input type="tel" id="nomor_wa" name="nomor_wa" required
                                   class="flex-1 min-w-0 block w-full px-3 py-3 rounded-none rounded-r-md border border-gray-300 focus:ring-primary-600 focus:border-primary-600"
                                   placeholder="81234567890" pattern="[0-9]{9,13}" title="Masukkan nomor WhatsApp tanpa +62">
                        </div>
                        <p class="mt-1 text-sm text-gray-500">Contoh: 81234567890 (tanpa +62)</p>
                    </div>

                    <button type="button" id="sendOtpButton" 
                            class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                        <span id="buttonText">Kirim Kode Verifikasi</span>
                        <svg id="loadingSpinner" class="hidden animate-spin ml-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </div>

                {{-- OTP Input Section (hidden initially) --}}
                <div id="otpSection" class="hidden mt-8 max-w-md mx-auto">
                    <div class="space-y-4">
                        <label for="otp" class="block text-sm font-medium text-gray-700 text-center">Masukkan 6 Digit Kode Verifikasi</label>
                        <div class="flex justify-center space-x-2">
                            <input type="text" maxlength="1" class="otp-digit w-12 h-12 text-2xl text-center border border-gray-300 rounded-md focus:ring-primary-600 focus:border-primary-600" 
                                   oninput="moveToNext(this)" onkeydown="handleOtpBackspace(event, this)">
                            <input type="text" maxlength="1" class="otp-digit w-12 h-12 text-2xl text-center border border-gray-300 rounded-md focus:ring-primary-600 focus:border-primary-600" 
                                   oninput="moveToNext(this)" onkeydown="handleOtpBackspace(event, this)">
                            <input type="text" maxlength="1" class="otp-digit w-12 h-12 text-2xl text-center border border-gray-300 rounded-md focus:ring-primary-600 focus:border-primary-600" 
                                   oninput="moveToNext(this)" onkeydown="handleOtpBackspace(event, this)">
                            <input type="text" maxlength="1" class="otp-digit w-12 h-12 text-2xl text-center border border-gray-300 rounded-md focus:ring-primary-600 focus:border-primary-600" 
                                   oninput="moveToNext(this)" onkeydown="handleOtpBackspace(event, this)">
                            <input type="text" maxlength="1" class="otp-digit w-12 h-12 text-2xl text-center border border-gray-300 rounded-md focus:ring-primary-600 focus:border-primary-600" 
                                   oninput="moveToNext(this)" onkeydown="handleOtpBackspace(event, this)">
                            <input type="text" maxlength="1" class="otp-digit w-12 h-12 text-2xl text-center border border-gray-300 rounded-md focus:ring-primary-600 focus:border-primary-600" 
                                   oninput="moveToNext(this)" onkeydown="handleOtpBackspace(event, this)">
                        </div>
                        <input type="hidden" id="otp" name="otp">
                        <p id="otpFeedback" class="text-sm text-center mt-2">
                            <span id="otpTimer" class="font-medium text-primary-600">Kode berlaku untuk 5:00</span>
                            <button type="button" id="resendOtpButton" class="hidden ml-2 text-primary-600 hover:text-primary-700 font-medium">Kirim Ulang</button>
                        </p>
                        <p id="otpError" class="text-sm text-center text-red-600 hidden"></p>
                    </div>
                </div>
            </div>

            {{-- ================================================================= --}}
            {{--                         MAIN FORM SECTION                          --}}
            {{-- ================================================================= --}}
            <div id="mainFormSection" class="hidden space-y-8">
                <div class="text-center">
                    <h2 class="text-2xl font-bold text-gray-800">Formulir Pendaftaran Santri</h2>
                    <div class="mt-2 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        <i class="fas fa-check-circle mr-2"></i>
                        Nomor +62<span id="verifiedNumber"></span> telah terverifikasi
                    </div>
                </div>
                
                {{-- Student Personal Data --}}
                <div class="space-y-6">
                    <div class="border-b border-gray-200 pb-2">
                        <h3 class="text-lg font-semibold text-gray-800">Data Diri Santri</h3>
                        <p class="text-sm text-gray-500">Isi dengan data lengkap dan valid sesuai dokumen resmi</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        {{-- Nama Lengkap --}}
                        <div class="col-span-2">
                            <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" required
                                   class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-600 focus:border-primary-600"
                                   placeholder="Sesuai Akta Kelahiran/KK">
                        </div>
                        
                        {{-- NIK --}}
                        <div>
                            <label for="nik" class="block text-sm font-medium text-gray-700 mb-1">Nomor Induk Kependudukan (NIK) <span class="text-red-500">*</span></label>
                            <input type="text" id="nik" name="nik" required pattern="\d{16}" title="NIK harus 16 digit angka"
                                   class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-600 focus:border-primary-600"
                                   placeholder="16 Digit Angka">
                        </div>
                        
                        {{-- NISN --}}
                        <div>
                            <label for="nisn" class="block text-sm font-medium text-gray-700 mb-1">NISN (Nomor Induk Siswa Nasional)</label>
                            <input type="text" id="nisn" name="nisn" pattern="\d{10}" title="NISN harus 10 digit angka"
                                   class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-600 focus:border-primary-600"
                                   placeholder="10 Digit Angka (Jika Ada)">
                        </div>
                        
                        {{-- Jenis Kelamin --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <div class="grid grid-cols-2 gap-2">
                                <label class="inline-flex items-center border rounded-md px-3 py-2 hover:bg-gray-50">
                                    <input type="radio" name="jenis_kelamin" value="Laki-laki" required class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300">
                                    <span class="ml-2 text-sm text-gray-700">Laki-laki</span>
                                </label>
                                <label class="inline-flex items-center border rounded-md px-3 py-2 hover:bg-gray-50">
                                    <input type="radio" name="jenis_kelamin" value="Perempuan" class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300">
                                    <span class="ml-2 text-sm text-gray-700">Perempuan</span>
                                </label>
                            </div>
                        </div>
                        
                        {{-- Tempat Lahir --}}
                        <div>
                            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat Lahir <span class="text-red-500">*</span></label>
                            <input type="text" id="tempat_lahir" name="tempat_lahir" required
                                   class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-600 focus:border-primary-600">
                        </div>
                        
                        {{-- Tanggal Lahir --}}
                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="date" id="tanggal_lahir" name="tanggal_lahir" required
                                       class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-600 focus:border-primary-600">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class="far fa-calendar-alt text-gray-400"></i>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Nomor HP --}}
                        <div>
                            <label for="nomor_hp_aktif" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon/HP <span class="text-red-500">*</span></label>
                            <input type="text" id="nomor_hp_aktif" name="nomor_hp_aktif" readonly
                                   class="block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-md shadow-sm cursor-not-allowed">
                        </div>                       
                        
                        {{-- Alamat --}}
                        <div class="col-span-2">
                            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap <span class="text-red-500">*</span></label>
                            <textarea id="alamat" name="alamat" rows="3" required
                                      class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-600 focus:border-primary-600"
                                      placeholder="Termasuk Desa/Kelurahan, Kecamatan, Kabupaten/Kota, Provinsi, dan Kode Pos"></textarea>
                        </div>
                    </div>
                </div>

                {{-- Parent Data --}}
                <div class="space-y-6">
                    <div class="border-b border-gray-200 pb-2">
                        <h3 class="text-lg font-semibold text-gray-800">Data Orang Tua / Wali</h3>
                        <p class="text-sm text-gray-500">Isi data orang tua kandung atau wali jika diperlukan</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Father Data --}}
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <h4 class="font-medium text-gray-800 mb-3 flex items-center">
                                <i class="fas fa-male text-primary-600 mr-2"></i> Data Ayah Kandung
                            </h4>
                            <div class="space-y-4">
                                <div>
                                    <label for="nama_ayah" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                                    <input type="text" id="nama_ayah" name="nama_ayah" required
                                           class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-600 focus:border-primary-600">
                                </div>
                                <div>
                                    <label for="pekerjaan_ayah" class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan <span class="text-red-500">*</span></label>
                                    <input type="text" id="pekerjaan_ayah" name="pekerjaan_ayah" required
                                           class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-600 focus:border-primary-600">
                                </div>
                                <div>
                                    <label for="telepon_ayah" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon <span class="text-red-500">*</span></label>
                                    <input type="tel" id="telepon_ayah" name="telepon_ayah" required
                                           class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-600 focus:border-primary-600">
                                </div>
                            </div>
                        </div>
                        
                        {{-- Mother Data --}}
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <h4 class="font-medium text-gray-800 mb-3 flex items-center">
                                <i class="fas fa-female text-primary-600 mr-2"></i> Data Ibu Kandung
                            </h4>
                            <div class="space-y-4">
                                <div>
                                    <label for="nama_ibu" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                                    <input type="text" id="nama_ibu" name="nama_ibu" required
                                           class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-600 focus:border-primary-600">
                                </div>
                                <div>
                                    <label for="pekerjaan_ibu" class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan <span class="text-red-500">*</span></label>
                                    <input type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" required
                                           class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-600 focus:border-primary-600">
                                </div>
                                <div>
                                    <label for="telepon_ibu" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon <span class="text-red-500">*</span></label>
                                    <input type="tel" id="telepon_ibu" name="telepon_ibu" required
                                           class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-600 focus:border-primary-600">
                                </div>
                            </div>
                        </div>
                        
                        {{-- Guardian Data --}}
                        <div class="md:col-span-2 bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <h4 class="font-medium text-gray-800 mb-3 flex items-center">
                                <i class="fas fa-user-shield text-primary-600 mr-2"></i> Data Wali (Opsional)
                            </h4>
                            <p class="text-xs text-gray-500 mb-3">Diisi jika santri tidak tinggal bersama orang tua.</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                <div>
                                    <label for="nama_wali" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                    <input type="text" id="nama_wali" name="nama_wali"
                                           class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-600 focus:border-primary-600">
                                </div>
                                <div>
                                    <label for="telepon_wali" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                                    <input type="tel" id="telepon_wali" name="telepon_wali"
                                           class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-600 focus:border-primary-600">
                                </div>
                                <div>
                                    <label for="hubungan_wali" class="block text-sm font-medium text-gray-700 mb-1">Hubungan dengan Santri</label>
                                    <input type="text" id="hubungan_wali" name="hubungan_wali"
                                           class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-600 focus:border-primary-600"
                                           placeholder="Contoh: Paman, Kakek">
                                </div>
                                <div>
                                    <label for="pekerjaan_wali" class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan Wali</label>
                                    <input type="text" id="pekerjaan_wali" name="pekerjaan_wali"
                                           class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-600 focus:border-primary-600">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Education History and Documents --}}
                <div class="space-y-6">
                    <div class="border-b border-gray-200 pb-2">
                        <h3 class="text-lg font-semibold text-gray-800">Riwayat Pendidikan & Berkas</h3>
                        <p class="text-sm text-gray-500">Upload dokumen dengan format JPG/PNG/PDF (maks. 2MB)</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        {{-- Previous School --}}
                        <div>
                            <label for="asal_sekolah" class="block text-sm font-medium text-gray-700 mb-1">Asal Sekolah Terakhir <span class="text-red-500">*</span></label>
                            <input type="text" id="asal_sekolah" name="asal_sekolah" required
                                   class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-600 focus:border-primary-600">
                        </div>
                        
                        {{-- Graduation Year --}}
                        <div>
                            <label for="tahun_lulus" class="block text-sm font-medium text-gray-700 mb-1">Tahun Lulus <span class="text-red-500">*</span></label>
                            <input type="number" id="tahun_lulus" name="tahun_lulus" min="1900" max="2099" required
                                   class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-600 focus:border-primary-600"
                                   placeholder="Contoh: 2024">
                        </div>
                        
                        {{-- Student Photo --}}
                        <div class="file-upload">
                            <label for="foto_santri" class="block text-sm font-medium text-gray-700 mb-1">Foto Santri <span class="text-red-500">*</span></label>
                            <div class="mt-1 flex items-center">
                                <label for="foto_santri" class="cursor-pointer">
                                    <div class="flex flex-col items-center justify-center px-6 py-4 border-2 border-dashed border-gray-300 rounded-md hover:border-primary-500 hover:bg-primary-50 transition-colors w-full">
                                        <i class="fas fa-camera text-2xl text-gray-400 mb-2"></i>
                                        <p class="text-sm text-gray-600 text-center">
                                            <span class="font-medium text-primary-600">Upload Foto</span><br>
                                            Format JPG/PNG (maks. 2MB)
                                        </p>
                                    </div>
                                    <input id="foto_santri" name="foto_santri" type="file" accept="image/*" required class="sr-only">
                                </label>
                            </div>
                            <div id="fotoPreview" class="mt-2 hidden">
                                <img id="fotoPreviewImage" src="#" alt="Preview Foto" class="h-24 rounded-md border">
                                <button type="button" onclick="removeImage('foto_santri', 'fotoPreview')" class="mt-1 text-xs text-red-600 hover:text-red-800">
                                    <i class="fas fa-times mr-1"></i>Hapus Foto
                                </button>
                            </div>
                        </div>
                        
                        {{-- Family Card --}}
                        <div class="file-upload">
                            <label for="scan_kk" class="block text-sm font-medium text-gray-700 mb-1">Scan Kartu Keluarga (KK) <span class="text-red-500">*</span></label>
                            <div class="mt-1 flex items-center">
                                <label for="scan_kk" class="cursor-pointer">
                                    <div class="flex flex-col items-center justify-center px-6 py-4 border-2 border-dashed border-gray-300 rounded-md hover:border-primary-500 hover:bg-primary-50 transition-colors w-full">
                                        <i class="fas fa-file-alt text-2xl text-gray-400 mb-2"></i>
                                        <p class="text-sm text-gray-600 text-center">
                                            <span class="font-medium text-primary-600">Upload KK</span><br>
                                            Format JPG/PNG/PDF (maks. 2MB)
                                        </p>
                                    </div>
                                    <input id="scan_kk" name="scan_kk" type="file" accept="image/*,.pdf" required class="sr-only">
                                </label>
                            </div>
                            <div id="kkPreview" class="mt-2 hidden">
                                <div class="flex items-center">
                                    <i class="fas fa-file-pdf text-2xl text-red-500 mr-2"></i>
                                    <span id="kkFileName" class="text-sm"></span>
                                </div>
                                <button type="button" onclick="removeImage('scan_kk', 'kkPreview')" class="mt-1 text-xs text-red-600 hover:text-red-800">
                                    <i class="fas fa-times mr-1"></i>Hapus File
                                </button>
                            </div>
                        </div>
                        
                        {{-- Diploma --}}
                        <div class="md:col-span-2 file-upload">
                            <label for="scan_ijazah" class="block text-sm font-medium text-gray-700 mb-1">Scan Ijazah/Surat Keterangan Lulus <span class="text-red-500">*</span></label>
                            <div class="mt-1 flex items-center">
                                <label for="scan_ijazah" class="cursor-pointer">
                                    <div class="flex flex-col items-center justify-center px-6 py-4 border-2 border-dashed border-gray-300 rounded-md hover:border-primary-500 hover:bg-primary-50 transition-colors w-full">
                                        <i class="fas fa-graduation-cap text-2xl text-gray-400 mb-2"></i>
                                        <p class="text-sm text-gray-600 text-center">
                                            <span class="font-medium text-primary-600">Upload Ijazah/SKL</span><br>
                                            Format JPG/PNG/PDF (maks. 2MB)
                                        </p>
                                    </div>
                                    <input id="scan_ijazah" name="scan_ijazah" type="file" accept="image/*,.pdf" required class="sr-only">
                                </label>
                            </div>
                            <div id="ijazahPreview" class="mt-2 hidden">
                                <div class="flex items-center">
                                    <i class="fas fa-file-pdf text-2xl text-red-500 mr-2"></i>
                                    <span id="ijazahFileName" class="text-sm"></span>
                                </div>
                                <button type="button" onclick="removeImage('scan_ijazah', 'ijazahPreview')" class="mt-1 text-xs text-red-600 hover:text-red-800">
                                    <i class="fas fa-times mr-1"></i>Hapus File
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Terms and Conditions --}}
                <div class="border-t border-gray-200 pt-4">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="terms" name="terms" type="checkbox" required
                                   class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300 rounded">
                        </div>
                        <div class="ml-3">
                            <label for="terms" class="text-sm text-gray-700">
                                Saya menyatakan bahwa data yang saya isi adalah benar dan dapat dipertanggungjawabkan. 
                                Saya juga menyetujui <a href="#" class="text-primary-600 hover:text-primary-800">syarat dan ketentuan</a> yang berlaku.
                            </label>
                        </div>
                    </div>
                </div>
                
                {{-- Submit Button --}}
                <div class="pt-4">
                    <button type="submit" id="submitButton"
                            class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors">
                        <span id="submitText">Selesaikan Pendaftaran</span>
                        <svg id="submitSpinner" class="hidden animate-spin ml-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Elements
            const verificationSection = document.getElementById('verificationSection');
            const mainFormSection = document.getElementById('mainFormSection');
            const sendOtpButton = document.getElementById('sendOtpButton');
            const buttonText = document.getElementById('buttonText');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const otpSection = document.getElementById('otpSection');
            const otpInput = document.getElementById('otp');
            const otpDigits = document.querySelectorAll('.otp-digit');
            const otpFeedback = document.getElementById('otpFeedback');
            const otpTimer = document.getElementById('otpTimer');
            const resendOtpButton = document.getElementById('resendOtpButton');
            const otpError = document.getElementById('otpError');
            const nomorWaInput = document.getElementById('nomor_wa');
            const verifiedNumber = document.getElementById('verifiedNumber');
            const nomorHpAktifInput = document.getElementById('nomor_hp_aktif');
            const submitButton = document.getElementById('submitButton');
            const submitText = document.getElementById('submitText');
            const submitSpinner = document.getElementById('submitSpinner');
            
            // File upload previews
            document.getElementById('foto_santri').addEventListener('change', function(e) {
                previewFile(e.target, 'fotoPreview', 'fotoPreviewImage');
            });
            
            document.getElementById('scan_kk').addEventListener('change', function(e) {
                previewFile(e.target, 'kkPreview', 'kkFileName');
            });
            
            document.getElementById('scan_ijazah').addEventListener('change', function(e) {
                previewFile(e.target, 'ijazahPreview', 'ijazahFileName');
            });
            
            // Send OTP button click handler
            sendOtpButton.addEventListener('click', function() {
                const phoneNumber = nomorWaInput.value.trim();
                
                if (!phoneNumber || phoneNumber.length < 9 || !/^\d+$/.test(phoneNumber)) {
                    showOtpError('Masukkan nomor WhatsApp yang valid (minimal 9 digit angka)');
                    return;
                }
                
                // Show loading state
                buttonText.textContent = 'Mengirim Kode...';
                loadingSpinner.classList.remove('hidden');
                sendOtpButton.disabled = true;
                
                // Simulate API call (replace with actual API call)
                setTimeout(() => {
                    // Hide loading state
                    buttonText.textContent = 'Kode Terkirim';
                    loadingSpinner.classList.add('hidden');
                    
                    // Show OTP section
                    otpSection.classList.remove('hidden');
                    startOtpTimer(300); // 5 minutes
                    
                    // Focus first OTP digit
                    if (otpDigits.length > 0) {
                        otpDigits[0].focus();
                    }
                    
                    // For demo purposes, auto-fill OTP
                    if (window.location.href.includes('demo=true')) {
                        otpDigits.forEach((digit, index) => {
                            digit.value = '1';
                        });
                        updateOtpValue();
                    }
                }, 1500);
            });
            
            // Resend OTP button click handler
            resendOtpButton.addEventListener('click', function() {
                const phoneNumber = nomorWaInput.value.trim();
                
                // Show loading state
                resendOtpButton.innerHTML = '<i class="fas fa-circle-notch fa-spin mr-1"></i> Mengirim...';
                resendOtpButton.disabled = true;
                
                // Simulate API call (replace with actual API call)
                setTimeout(() => {
                    // Reset button
                    resendOtpButton.innerHTML = 'Kode Terkirim Ulang';
                    
                    // Hide resend button and show timer
                    resendOtpButton.classList.add('hidden');
                    otpTimer.classList.remove('hidden');
                    startOtpTimer(300); // 5 minutes
                    
                    // Show success message
                    showOtpSuccess('Kode verifikasi baru telah dikirim');
                }, 1500);
            });
            
            // Form submission handler
            document.getElementById('registrationForm').addEventListener('submit', function(e) {
                // Only handle submission from main form
                if (mainFormSection.classList.contains('hidden')) {
                    return;
                }
                
                e.preventDefault();
                
                // Show loading state
                submitText.textContent = 'Memproses...';
                submitSpinner.classList.remove('hidden');
                submitButton.disabled = true;
                
                // Simulate form submission (replace with actual form submission)
                setTimeout(() => {
                    // Here you would typically submit the form data to your backend
                    console.log('Form submitted:', new FormData(this));
                    
                    // For demo purposes, show success message
                    alert('Pendaftaran berhasil! Data Anda telah terkirim.');
                    
                    // Reset form and show thank you page in a real scenario
                    // window.location.href = '/thank-you';
                }, 2000);
            });
            
            // Helper function to start OTP timer
            function startOtpTimer(duration) {
                let timer = duration;
                let minutes, seconds;
                
                const interval = setInterval(() => {
                    minutes = parseInt(timer / 60, 10);
                    seconds = parseInt(timer % 60, 10);
                    
                    minutes = minutes < 10 ? "0" + minutes : minutes;
                    seconds = seconds < 10 ? "0" + seconds : seconds;
                    
                    otpTimer.textContent = "Kode berlaku untuk " + minutes + ":" + seconds;
                    
                    if (--timer < 0) {
                        clearInterval(interval);
                        otpTimer.classList.add('hidden');
                        resendOtpButton.classList.remove('hidden');
                    }
                }, 1000);
            }
            
            // Helper function to show OTP error
            function showOtpError(message) {
                otpError.textContent = message;
                otpError.classList.remove('hidden');
                
                // Hide error after 5 seconds
                setTimeout(() => {
                    otpError.classList.add('hidden');
                }, 5000);
            }
            
            // Helper function to show OTP success
            function showOtpSuccess(message) {
                otpFeedback.textContent = message;
                otpFeedback.className = 'text-sm text-center mt-2 text-green-600';
                
                // Reset to timer after 3 seconds
                setTimeout(() => {
                    otpFeedback.className = 'text-sm text-center mt-2';
                    otpTimer.classList.remove('hidden');
                }, 3000);
            }
            
            // Helper function to preview uploaded files
            function previewFile(input, previewId, previewElementId) {
                const preview = document.getElementById(previewId);
                const file = input.files[0];
                
                if (file) {
                    // Check file size (max 2MB)
                    if (file.size > 2 * 1024 * 1024) {
                        alert('Ukuran file terlalu besar. Maksimal 2MB.');
                        input.value = '';
                        return;
                    }
                    
                    // Show preview
                    preview.classList.remove('hidden');
                    
                    if (previewElementId === 'fotoPreviewImage') {
                        // For image preview
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById(previewElementId).src = e.target.result;
                        }
                        reader.readAsDataURL(file);
                    } else {
                        // For file name display
                        document.getElementById(previewElementId).textContent = file.name;
                    }
                }
            }
            
            // Helper function to remove uploaded file
            function removeImage(inputId, previewId) {
                document.getElementById(inputId).value = '';
                document.getElementById(previewId).classList.add('hidden');
            }
        });
        
        // Helper functions for OTP input
        function moveToNext(input) {
            if (input.value.length === 1) {
                const next = input.nextElementSibling;
                if (next && next.classList.contains('otp-digit')) {
                    next.focus();
                } else {
                    // Last digit filled, verify OTP
                    updateOtpValue();
                    verifyOtp();
                }
            }
        }
        
        function handleOtpBackspace(e, input) {
            if (e.key === 'Backspace' && input.value.length === 0) {
                const prev = input.previousElementSibling;
                if (prev && prev.classList.contains('otp-digit')) {
                    prev.focus();
                }
            }
        }
        
        function updateOtpValue() {
            const otpDigits = document.querySelectorAll('.otp-digit');
            const otpInput = document.getElementById('otp');
            let otpValue = '';
            
            otpDigits.forEach(digit => {
                otpValue += digit.value;
            });
            
            otpInput.value = otpValue;
        }
        
        function verifyOtp() {
            const otpInput = document.getElementById('otp');
            
            // For demo purposes, accept any 6-digit code
            if (otpInput.value.length === 6) {
                // Show verification success
                document.getElementById('verificationSection').classList.add('hidden');
                document.getElementById('mainFormSection').classList.remove('hidden');
                
                // Update verified number display
                const phoneNumber = document.getElementById('nomor_wa').value;
                document.getElementById('verifiedNumber').textContent = phoneNumber;
                document.getElementById('nomor_hp_aktif').value = '+62' + phoneNumber;
                
                // Update progress indicator
                const progressSteps = document.querySelectorAll('.flex.justify-between.relative > div');
                if (progressSteps.length >= 2) {
                    progressSteps[1].querySelector('div').classList.remove('bg-gray-300', 'text-gray-600');
                    progressSteps[1].querySelector('div').classList.add('bg-primary-600', 'text-white');
                }
            }
        }
        
        // Auto-focus next OTP digit when one is entered
        document.querySelectorAll('.otp-digit').forEach((digit, index) => {
            digit.addEventListener('input', function() {
                updateOtpValue();
                if (this.value.length === 1) {
                    moveToNext(this);
                }
            });
            
            // Allow pasting OTP
            digit.addEventListener('paste', function(e) {
                e.preventDefault();
                const pasteData = e.clipboardData.getData('text');
                if (/^\d{6}$/.test(pasteData)) {
                    const digits = document.querySelectorAll('.otp-digit');
                    for (let i = 0; i < 6; i++) {
                        if (digits[i]) {
                            digits[i].value = pasteData[i] || '';
                        }
                    }
                    updateOtpValue();
                    verifyOtp();
                }
            });
        });
    </script>
</body>
</html>