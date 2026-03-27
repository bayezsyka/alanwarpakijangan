<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all border border-transparent hover:border-emerald-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <span class="text-sm font-black tracking-widest uppercase">Sunting Pengelola</span>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="space-y-8">
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-100 p-5 rounded-2xl shadow-sm flex items-start gap-4">
                        <div class="bg-red-500 text-white p-2 rounded-xl shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-sm font-black text-red-800 uppercase tracking-widest mb-1">Terdapat Kendala</h3>
                            <ul class="text-xs font-bold text-red-600/80 space-y-0.5 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                {{-- Identitas Dasar --}}
                <x-card>
                    <x-slot name="header">
                        <div class="flex items-center gap-3">
                            <div class="w-1.5 h-6 bg-emerald-500 rounded-full"></div>
                            <h3 class="text-sm font-black text-gray-800 uppercase tracking-[0.2em]">Profil Pengguna</h3>
                        </div>
                    </x-slot>

                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required autofocus
                                       class="w-full px-4 py-3.5 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-bold text-gray-900 outline-none">
                            </div>

                            <div>
                                <label for="email" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Alamat Email <span class="text-red-500">*</span></label>
                                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                                       class="w-full px-4 py-3.5 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-bold text-gray-900 outline-none">
                            </div>
                        </div>

                        <div class="bg-gray-50/50 p-6 rounded-3xl border border-gray-100 shadow-inner">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-4 text-center">Hak Akses & Peran Sistem <span class="text-red-500">*</span></label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                @php $userRoles = $user->roles ?? []; @endphp
                                <label class="relative flex flex-col items-center p-5 rounded-3xl border border-gray-200 bg-white hover:border-emerald-300 hover:shadow-xl hover:shadow-emerald-500/5 transition-all cursor-pointer group shadow-sm text-center">
                                    <input type="checkbox" name="roles[]" value="admin"
                                           class="w-5 h-5 text-emerald-600 border-gray-200 rounded-lg focus:ring-emerald-500 transition-all absolute top-4 right-4"
                                           {{ in_array('admin', old('roles', $userRoles)) ? 'checked' : '' }}>
                                    <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-3 group-hover:bg-emerald-600 group-hover:text-white transition-all shadow-inner">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                    </div>
                                    <p class="text-xs font-black text-gray-800 tracking-widest uppercase">Administrator</p>
                                    <p class="text-[9px] font-bold text-gray-400 mt-1 uppercase tracking-tighter">Akses Penuh</p>
                                </label>
                                
                                <label class="relative flex flex-col items-center p-5 rounded-3xl border border-gray-200 bg-white hover:border-blue-300 hover:shadow-xl hover:shadow-blue-500/5 transition-all cursor-pointer group shadow-sm text-center">
                                    <input type="checkbox" name="roles[]" value="penulis"
                                           class="w-5 h-5 text-blue-600 border-gray-200 rounded-lg focus:ring-blue-500 transition-all absolute top-4 right-4"
                                           {{ in_array('penulis', old('roles', $userRoles)) ? 'checked' : '' }}>
                                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-3 group-hover:bg-blue-600 group-hover:text-white transition-all shadow-inner">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </div>
                                    <p class="text-xs font-black text-gray-800 tracking-widest uppercase">Penulis</p>
                                    <p class="text-[9px] font-bold text-gray-400 mt-1 uppercase tracking-tighter">Kelola Artikel</p>
                                </label>
                                
                                <label class="relative flex flex-col items-center p-5 rounded-3xl border border-gray-200 bg-white hover:border-purple-300 hover:shadow-xl hover:shadow-purple-500/5 transition-all cursor-pointer group shadow-sm text-center">
                                    <input type="checkbox" name="roles[]" value="selasanan_manager"
                                           class="w-5 h-5 text-purple-600 border-gray-200 rounded-lg focus:ring-purple-500 transition-all absolute top-4 right-4"
                                           {{ in_array('selasanan_manager', old('roles', $userRoles)) ? 'checked' : '' }}>
                                    <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center mb-3 group-hover:bg-purple-600 group-hover:text-white transition-all shadow-inner">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/></svg>
                                    </div>
                                    <p class="text-xs font-black text-gray-800 tracking-widest uppercase">Selasanan</p>
                                    <p class="text-[9px] font-bold text-gray-400 mt-1 uppercase tracking-tighter">Jurnal Audio</p>
                                </label>
                            </div>
                        </div>
                    </div>
                </x-card>

                {{-- Keamanan --}}
                <x-card>
                     <x-slot name="header">
                        <div class="flex items-center gap-3">
                            <div class="w-1.5 h-6 bg-amber-500 rounded-full"></div>
                            <h3 class="text-sm font-black text-gray-800 uppercase tracking-[0.2em]">Pembaruan Keamanan</h3>
                        </div>
                    </x-slot>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label for="password" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Password Baru (Opsional)</label>
                            <div class="relative group">
                                <input type="password" name="password" id="password"
                                       class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-bold text-gray-900 outline-none placeholder:text-gray-300">
                                <div class="absolute left-4 top-4 text-gray-300 group-focus-within:text-amber-500 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                </div>
                            </div>
                            <p class="text-[9px] text-gray-400 mt-3 font-bold uppercase tracking-tighter">* Kosongkan jika tidak ingin mengubah password.</p>
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Ulangi Password Baru</label>
                            <div class="relative group">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                       class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-bold text-gray-900 outline-none">
                                <div class="absolute left-4 top-4 text-gray-300 group-focus-within:text-emerald-500 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-card>

                {{-- Footer/Aksi --}}
                <div class="flex items-center justify-between p-6 bg-white rounded-3xl border border-gray-100 shadow-sm">
                    <a href="{{ route('admin.users.index') }}" 
                       class="px-6 py-3 text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-gray-600 transition-colors">
                        BATALKAN PERUBAHAN
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center px-10 py-4 bg-emerald-600 rounded-2xl font-black text-xs text-white uppercase tracking-[0.2em] shadow-xl shadow-emerald-200 hover:bg-emerald-700 hover:scale-[1.02] transition-all active:scale-95">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        SIMPAN PEMBARUAN PROFIL
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
