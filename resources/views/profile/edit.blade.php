<x-app-layout>
    <x-slot name="header">
        <span class="text-sm font-black tracking-widest uppercase">Konfigurasi Personal</span>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                <div class="lg:col-span-1">
                    <h3 class="text-[10px] font-black text-gray-800 uppercase tracking-[0.2em] mb-2 flex items-center gap-2">
                        <span class="w-1 h-3 bg-emerald-500 rounded-full"></span>
                        Info Pengguna
                    </h3>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest leading-relaxed">Perbarui informasi profil akun dan alamat email Anda untuk sinkronisasi sistem.</p>
                </div>
                <div class="lg:col-span-2">
                    <x-card class="p-8 sm:p-12 !rounded-[2.5rem]">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </x-card>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                <div class="lg:col-span-1">
                    <h3 class="text-[10px] font-black text-gray-800 uppercase tracking-[0.2em] mb-2 flex items-center gap-2">
                        <span class="w-1 h-3 bg-amber-500 rounded-full"></span>
                        Otentikasi
                    </h3>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest leading-relaxed">Pastikan akun Anda menggunakan password panjang dan acak untuk menjaga keamanan data.</p>
                </div>
                <div class="lg:col-span-2">
                    <x-card class="p-8 sm:p-12 !rounded-[2.5rem]">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </x-card>
                </div>
            </div>

            @if(!auth()->user()->isAdmin())
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                <div class="lg:col-span-1">
                    <h3 class="text-[10px] font-black text-red-800 uppercase tracking-[0.2em] mb-2 flex items-center gap-2">
                        <span class="w-1 h-3 bg-red-500 rounded-full"></span>
                        Zona Bahaya
                    </h3>
                    <p class="text-xs text-red-300 font-bold uppercase tracking-widest leading-relaxed text-opacity-80">Menghapus akun akan memusnahkan seluruh akses Anda ke sistem secara permanen.</p>
                </div>
                <div class="lg:col-span-2">
                    <x-card class="p-8 sm:p-12 !rounded-[2.5rem] bg-red-50/10 border-red-50">
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </x-card>
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
