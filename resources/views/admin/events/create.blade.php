<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.events.index') }}" class="inline-flex items-center justify-center p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all border border-transparent hover:border-emerald-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <span class="text-sm font-black tracking-widest uppercase">Input Galeri Baru</span>
        </div>
    </x-slot>

    <div class="py-6" x-data="uploadForm()">
        {{-- Overlay Transmisi Data --}}
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
                <h3 class="text-xl font-black text-gray-900 uppercase tracking-widest">Sinkronisasi...</h3>
                <p class="text-[10px] font-bold text-gray-400 mt-3 uppercase tracking-[0.2em]" x-text="progressText"></p>
                <div class="w-full bg-gray-50 rounded-full h-2 mt-8 overflow-hidden shadow-inner">
                    <div class="bg-emerald-500 h-full rounded-full transition-all duration-500 ease-out shadow-lg shadow-emerald-500/20" :style="'width: ' + progress + '%'"></div>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <form x-ref="form" @submit.prevent="submitForm" action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                
                {{-- Detail Acara --}}
                <x-card>
                    <x-slot name="header">
                        <div class="flex items-center gap-3">
                            <div class="w-1.5 h-6 bg-emerald-500 rounded-full"></div>
                            <h3 class="text-sm font-black text-gray-800 uppercase tracking-[0.2em]">Identitas Metadata Acara</h3>
                        </div>
                    </x-slot>
                    
                    <div class="space-y-6 text-gray-900">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="md:col-span-2">
                                <label for="nama_acara" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Nama Acara / Judul Galeri <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_acara" id="nama_acara" value="{{ old('nama_acara') }}" required 
                                       placeholder="Contoh: Tabligh Akbar & Sholawat Bersama..."
                                       class="w-full px-4 py-3.5 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-bold text-gray-900 outline-none">
                                @error('nama_acara') <p class="text-red-500 text-[10px] mt-2 font-bold uppercase tracking-tight">{{ $message }}</p> @enderror
                            </div>
                            
                            <div>
                                <label for="tanggal" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Tanggal Pelaksanaan</label>
                                <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') }}" 
                                       class="w-full px-4 py-3.5 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-bold text-gray-900 outline-none">
                            </div>

                            <div class="md:col-span-3">
                                <label for="deskripsi" class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2">Narasi Singkat (Opsional)</label>
                                <textarea name="deskripsi" id="deskripsi" rows="3" 
                                          placeholder="Tuliskan keterangan tambahan atau poin-poin penting mengenai acara ini..."
                                          class="w-full px-4 py-3.5 bg-gray-50 border border-transparent rounded-2xl focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-bold text-gray-900 outline-none min-h-[100px]">{{ old('deskripsi') }}</textarea>
                            </div>
                        </div>
                    </div>
                </x-card>
                
                {{-- File Upload --}}
                <x-card no-padding overflow-hidden>
                    <x-slot name="header">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-1.5 h-6 bg-blue-500 rounded-full"></div>
                                <h3 class="text-sm font-black text-gray-800 uppercase tracking-[0.2em]">Pustaka Visual <span class="text-red-500">*</span></h3>
                            </div>
                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest bg-gray-50 px-3 py-1 rounded-lg border border-gray-100">Multi-Selection Aktif</span>
                        </div>
                    </x-slot>

                    <div class="p-8 space-y-8">
                        <div class="bg-emerald-50/20 rounded-[3rem] p-12 border-4 border-dashed border-emerald-100 text-center hover:border-emerald-400 hover:bg-white hover:shadow-2xl hover:shadow-emerald-500/5 transition-all group relative overflow-hidden">
                            <input type="file" name="photos[]" id="photos" @change="handleFiles" required multiple 
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            
                            <div class="relative z-0 group-hover:scale-105 transition-transform duration-500">
                                <div class="w-20 h-20 bg-white rounded-3xl shadow-xl border border-emerald-50 flex items-center justify-center mx-auto mb-6 group-hover:rotate-6 transition-all text-emerald-500">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <p class="text-xs font-black text-gray-800 uppercase tracking-[0.1em]">Tarik Koleksi Foto ke Sini</p>
                                <p class="text-[10px] font-bold text-gray-400 mt-3 uppercase tracking-tighter">Maks 2MB per item • JPG / PNG / WEBP</p>
                            </div>
                        </div>

                        {{-- Previews --}}
                        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-5 gap-5 pb-4" x-show="previews.length > 0">
                            <template x-for="(preview, index) in previews" :key="index">
                                <div class="relative group aspect-square rounded-[2rem] overflow-hidden border-2 border-white shadow-xl hover:rotate-2 hover:scale-110 transition-all duration-500">
                                    <img :src="preview.url" class="absolute inset-0 w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-emerald-950/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center p-3 text-center">
                                         <p class="text-[8px] font-black text-white uppercase tracking-tighter break-all line-clamp-2" x-text="preview.name"></p>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </x-card>

                {{-- Status Umpan Balik --}}
                <div x-show="errorMessage" x-cloak 
                     class="p-5 bg-red-50 border border-red-100 rounded-2xl flex items-start gap-4 animate-shake shadow-sm shadow-red-100">
                    <div class="bg-red-500 text-white p-2 rounded-xl shadow-lg ring-4 ring-red-50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-[10px] font-black text-red-800 uppercase tracking-[0.2em] mb-1">Kegagalan Transmisi</h3>
                        <p class="text-xs font-bold text-red-600/80 leading-relaxed" x-text="errorMessage"></p>
                    </div>
                </div>

                {{-- Footer Aksi --}}
                <div class="flex items-center justify-between p-6 bg-white rounded-3xl border border-gray-100 shadow-sm">
                    <a href="{{ route('admin.events.index') }}" 
                       class="px-6 py-3 text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-gray-600 transition-colors">
                        BATALKAN PROSES
                    </a>
                    <button type="submit" x-bind:disabled="uploading" class="inline-flex items-center justify-center px-10 py-4 bg-emerald-600 rounded-2xl font-black text-xs text-white uppercase tracking-[0.2em] shadow-xl shadow-emerald-200 hover:bg-emerald-700 hover:scale-[1.02] transition-all active:scale-95 disabled:opacity-50 disabled:grayscale">
                        <template x-if="!uploading">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                                UNGGAH KE SERVER
                            </span>
                        </template>
                        <template x-if="uploading">
                            <span class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-3 h-4 w-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                PROSES KIRIM...
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
                uploading: false, progress: 0, progressText: '', errorMessage: '', previews: [],
                handleFiles(event) {
                    this.previews = []; let files = event.target.files;
                    for (let i = 0; i < files.length; i++) { 
                        this.previews.push({ 
                            name: files[i].name, 
                            url: URL.createObjectURL(files[i]) 
                        }); 
                    }
                },
                submitForm() {
                    const form = this.$refs.form;
                    if(!form.checkValidity()) { form.reportValidity(); return; }
                    
                    this.uploading = true; this.progress = 0; this.errorMessage = '';
                    this.progressText = 'Mengenkapsulasi paket data visual...';
                    const formData = new FormData(form);
                    const xhr = new XMLHttpRequest();
                    xhr.upload.addEventListener('progress', (e) => {
                        if (e.lengthComputable) {
                            this.progress = Math.round((e.loaded / e.total) * 100);
                            this.progressText = `Transmisi: ${(e.loaded / 1024 / 1024).toFixed(1)} / ${(e.total / 1024 / 1024).toFixed(1)} MB`;
                        }
                    });
                    xhr.onload = () => {
                        this.uploading = false;
                        if (xhr.status >= 200 && xhr.status < 300) { 
                            window.location.href = "{{ route('admin.events.index') }}"; 
                        } else {
                            try { 
                                let errorData = JSON.parse(xhr.responseText); 
                                this.errorMessage = errorData.errors ? Object.values(errorData.errors).flat().join(' ') : (errorData.message || 'Terjadi anomali pada pemrosesan server.'); 
                            } catch (e) { 
                                this.errorMessage = 'Gagal mendekode respon server. Cek log aplikasi.'; 
                            }
                        }
                    };
                    xhr.onerror = () => { 
                        this.uploading = false; 
                        this.errorMessage = 'Koneksi terinterupsi. Gagal menjangkau server.'; 
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