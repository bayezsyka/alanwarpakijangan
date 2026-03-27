<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.events.index') }}" class="inline-flex items-center justify-center p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all border border-transparent hover:border-emerald-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <span class="text-sm font-black tracking-widest uppercase">Sunting Galeri</span>
        </div>
    </x-slot>

    <div class="py-6" x-data="uploadForm()">
        {{-- Overlay Sinkronisasi --}}
        <div x-show="uploading" x-cloak 
             class="fixed inset-0 bg-gray-900/80 backdrop-blur-md flex items-center justify-center z-[100] animate-fadeIn">
            <div class="flex flex-col items-center text-center bg-white p-10 rounded-[3rem] shadow-2xl max-w-sm mx-4 border border-gray-100">
                <div class="relative mb-8">
                    <div class="absolute -inset-4 bg-emerald-500/10 rounded-full animate-ping"></div>
                    <svg class="animate-spin h-20 w-20 text-emerald-600 relative z-10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-10" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-90" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-xs font-black text-emerald-800 uppercase tracking-tighter" x-text="progress + '%'"></span>
                    </div>
                </div>
                <h3 class="text-xl font-black text-gray-900 uppercase tracking-widest">Memperbarui...</h3>
                <p class="text-[10px] font-bold text-gray-400 mt-3 uppercase tracking-[0.2em]" x-text="progressText"></p>
                <div class="w-full bg-gray-50 rounded-full h-2 mt-8 overflow-hidden shadow-inner">
                    <div class="bg-emerald-500 h-full rounded-full transition-all duration-500 ease-out shadow-lg shadow-emerald-500/20" :style="'width: ' + progress + '%'"></div>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <form x-ref="form" @submit.prevent="submitForm" action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')
                
                {{-- Detail Acara --}}
                <x-card>
                    <x-slot name="header">
                        <div class="flex items-center gap-3">
                            <div class="w-1.5 h-6 bg-emerald-500 rounded-full"></div>
                            <h3 class="text-sm font-black text-gray-800 uppercase tracking-[0.2em]">Metadata Acara</h3>
                        </div>
                    </x-slot>
                    
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="md:col-span-2">
                                <label for="nama_acara" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Nama Acara / Judul Galeri <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_acara" id="nama_acara" value="{{ old('nama_acara', $event->nama_acara) }}" required 
                                       class="w-full px-4 py-3.5 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-bold text-gray-900 outline-none">
                            </div>
                            
                            <div>
                                <label for="tanggal" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Tanggal Pelaksanaan</label>
                                <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', $event->tanggal) }}" 
                                       class="w-full px-4 py-3.5 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-bold text-gray-900 outline-none">
                            </div>

                            <div class="md:col-span-3">
                                <label for="deskripsi" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Narasi Singkat (Opsional)</label>
                                <textarea name="deskripsi" id="deskripsi" rows="3" 
                                          class="w-full px-4 py-3.5 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-bold text-gray-900 outline-none min-h-[100px]">{{ old('deskripsi', $event->deskripsi) }}</textarea>
                            </div>
                        </div>
                    </div>
                </x-card>

                {{-- Koleksi Foto --}}
                <x-card no-padding overflow-hidden>
                    <x-slot name="header">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-1.5 h-6 bg-blue-500 rounded-full"></div>
                                <h3 class="text-sm font-black text-gray-800 uppercase tracking-[0.2em]">Manajemen Aset Visual</h3>
                            </div>
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest bg-gray-50 px-3 py-1 rounded-lg border border-gray-100">Total: {{ $event->photos->count() }} Foto</span>
                        </div>
                    </x-slot>

                    <div class="p-8 space-y-10">
                        {{-- Foto Saat Ini --}}
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-5">Album Saat Ini (Pilih untuk Eliminasi):</p>
                            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-5 gap-5">
                                @forelse($event->photos as $photo)
                                    <label class="relative group aspect-square rounded-[2rem] overflow-hidden border-2 border-white shadow-xl cursor-pointer hover:scale-105 transition-all duration-500">
                                        <input type="checkbox" name="delete_photos[]" value="{{ $photo->id }}" class="hidden peer">
                                        <img src="{{ asset('storage/' . $photo->file_path) }}" class="absolute inset-0 w-full h-full object-cover group-hover:grayscale-[0.5] transition-all">
                                        {{-- Overlay Delete --}}
                                        <div class="absolute inset-0 bg-red-600/60 flex items-center justify-center opacity-0 peer-checked:opacity-100 transition-opacity">
                                            <div class="bg-white p-2 rounded-full shadow-lg">
                                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </div>
                                        </div>
                                        {{-- Hover Hint --}}
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 peer-checked:hidden transition-opacity flex items-center justify-center">
                                             <span class="text-[8px] font-black text-white uppercase tracking-widest border border-white/40 px-3 py-1 rounded-full">Eliminasi?</span>
                                        </div>
                                    </label>
                                @empty
                                    <p class="col-span-full text-xs font-bold text-gray-300 uppercase tracking-widest text-center py-10">Belum ada foto dalam album.</p>
                                @endforelse
                            </div>
                        </div>

                        {{-- Tambah Foto Baru --}}
                        <div class="pt-10 border-t border-gray-100">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-5">Suplemen Visual Baru:</p>
                            <div class="bg-blue-50/20 rounded-[3rem] p-10 border-4 border-dashed border-blue-100 text-center hover:border-blue-400 hover:bg-white transition-all group relative overflow-hidden">
                                <input type="file" name="photos[]" id="photos" @change="handleFiles" multiple 
                                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                
                                <div class="relative z-0 group-hover:scale-110 transition-transform duration-500">
                                    <div class="w-16 h-16 bg-white rounded-3xl shadow-xl border border-blue-50 flex items-center justify-center mx-auto mb-4 group-hover:rotate-6 transition-all text-blue-500">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                                    </div>
                                    <p class="text-[10px] font-black text-gray-800 uppercase tracking-[0.1em]">Tambahkan Dokumentasi Baru</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-5 gap-5 mt-8" x-show="previews.length > 0">
                                <template x-for="(preview, index) in previews" :key="index">
                                    <div class="relative group aspect-square rounded-[2rem] overflow-hidden border-2 border-white shadow-xl animate-scaleIn">
                                        <img :src="preview.url" class="absolute inset-0 w-full h-full object-cover">
                                        <div class="absolute inset-0 bg-blue-600/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                            <span class="text-[8px] font-black text-white uppercase tracking-widest border border-white/40 px-3 py-1 rounded-full">BARU</span>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </x-card>

                {{-- Footer Aksi --}}
                <div class="flex items-center justify-between p-6 bg-white rounded-3xl border border-gray-100 shadow-sm">
                    <a href="{{ route('admin.events.index') }}" 
                       class="px-6 py-3 text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-gray-600 transition-colors">
                        BATALKAN REVISI
                    </a>
                    <button type="submit" x-bind:disabled="uploading" class="inline-flex items-center justify-center px-10 py-4 bg-emerald-600 rounded-2xl font-black text-xs text-white uppercase tracking-[0.2em] shadow-xl shadow-emerald-200 hover:bg-emerald-700 hover:scale-[1.02] transition-all active:scale-95 disabled:opacity-50">
                        <template x-if="!uploading">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                                PERBARUI ALBUM
                            </span>
                        </template>
                        <template x-if="uploading">
                            <span class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-3 h-4 w-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                PROSES UPDATE...
                            </span>
                        </template>
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        function uploadForm() {
            return {
                uploading: false, progress: 0, progressText: '', previews: [],
                handleFiles(event) {
                    this.previews = []; let files = event.target.files;
                    for (let i = 0; i < files.length; i++) { 
                        this.previews.push({ name: files[i].name, url: URL.createObjectURL(files[i]) }); 
                    }
                },
                submitForm() {
                    const form = this.$refs.form;
                    this.uploading = true; this.progress = 0;
                    this.progressText = 'Mengkonsolidasikan repositori visual...';
                    const formData = new FormData(form);
                    const xhr = new XMLHttpRequest();
                    xhr.upload.addEventListener('progress', (e) => {
                        if (e.lengthComputable) {
                            this.progress = Math.round((e.loaded / e.total) * 100);
                            this.progressText = `Sinkronisasi: ${(e.loaded / 1024 / 1024).toFixed(1)} / ${(e.total / 1024 / 1024).toFixed(1)} MB`;
                        }
                    });
                    xhr.onload = () => {
                        this.uploading = false;
                        if (xhr.status >= 200 && xhr.status < 300) { 
                            window.location.href = "{{ route('admin.events.index') }}"; 
                        } else {
                            Swal.fire({
                                title: 'GAGAL TRANSMISI!',
                                text: 'Terjadi anomali saat sinkronisasi data ke server.',
                                icon: 'error',
                                confirmButtonText: 'OKE',
                                confirmButtonColor: '#059669'
                            });
                        }
                    };
                    xhr.onerror = () => { 
                        this.uploading = false; 
                        Swal.fire({
                            title: 'KONEKSI PUTUS!',
                            text: 'Gagal menjangkau server. Periksa jaringan Anda.',
                            icon: 'warning',
                            confirmButtonText: 'RE-TRY',
                            confirmButtonColor: '#059669'
                        });
                    };
                    xhr.open('POST', form.action);
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                    xhr.setRequestHeader('Accept', 'application/json');
                    xhr.send(formData);
                }
            }
        }
    </script>
    @endpush
</x-app-layout>