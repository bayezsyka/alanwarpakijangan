@if(isset($announcements) && $announcements->count())
    {{-- Backdrop gelap dengan blur --}}
    <div id="announcement-backdrop"
         class="fixed inset-0 bg-gradient-to-br from-black/70 via-black/60 to-black/70 backdrop-blur-sm z-40 hidden transition-opacity duration-300"></div>

    {{-- Modal dengan desain floating modern --}}
    <div id="announcement-modal"
         class="fixed inset-0 z-50 flex flex-col items-center justify-center px-4 py-8 sm:py-12 hidden">
        
        {{-- Container untuk gambar dan konten --}}
        <div class="w-full max-w-2xl mx-auto flex flex-col items-center gap-6 sm:gap-8">
            
            {{-- Judul pengumuman --}}
            <h2 id="announcement-title"
                class="text-xl sm:text-2xl md:text-3xl font-bold text-white text-center drop-shadow-lg px-4 animate-fade-in">
                {{-- judul akan diisi via JS --}}
            </h2>

            {{-- Gambar melayang dengan efek shadow premium --}}
            <div class="relative group w-full max-w-lg animate-float">
                <a id="announcement-link-wrapper" href="#" target="_blank"
                   class="block relative">
                    <img id="announcement-image"
                         src=""
                         alt=""
                         class="w-full h-auto rounded-2xl sm:rounded-3xl shadow-2xl transform transition-all duration-300 
                                group-hover:scale-[1.02] group-hover:shadow-emerald-500/50
                                ring-4 ring-white/20 hover:ring-white/40">
                    
                    {{-- Glow effect di belakang gambar --}}
                    <div class="absolute -inset-4 bg-gradient-to-r from-emerald-500/30 via-teal-500/30 to-cyan-500/30 
                                rounded-3xl blur-2xl -z-10 opacity-60 group-hover:opacity-80 transition-opacity"></div>
                </a>

                {{-- Keterangan "klik gambar" kalau ada link dengan styling modern --}}
                <p id="announcement-link-hint"
                   class="mt-4 text-xs sm:text-sm text-white/80 text-center hidden animate-pulse">
                    <i class="fas fa-hand-pointer mr-2"></i>
                    Klik gambar untuk info lebih lanjut
                </p>
            </div>

            {{-- Tombol aksi di tengah bawah --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4 w-full max-w-md px-4">
                <button id="announcement-skip-all"
                        class="w-full sm:w-auto px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl sm:rounded-2xl 
                               border-2 border-white/40 backdrop-blur-md bg-white/10 
                               text-sm sm:text-base font-semibold text-white
                               hover:bg-white/20 hover:border-white/60 hover:scale-105
                               active:scale-95 transition-all duration-200 shadow-lg">
                    Lewati Semua
                </button>
                <button id="announcement-close"
                        class="w-full sm:w-auto px-6 sm:px-8 py-3 sm:py-3.5 rounded-xl sm:rounded-2xl 
                               bg-gradient-to-r from-emerald-500 to-teal-600
                               text-sm sm:text-base font-bold text-white
                               hover:from-emerald-600 hover:to-teal-700 hover:scale-105
                               active:scale-95 transition-all duration-200 
                               shadow-xl shadow-emerald-500/50 hover:shadow-emerald-500/70">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    {{-- Custom CSS untuk animasi --}}
    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.5s ease-out forwards;
        }

        .animate-float {
            animation: float 0.6s ease-out 0.2s forwards;
            opacity: 0;
        }

        /* Smooth appearance for modal */
        #announcement-modal:not(.hidden) {
            animation: fade-in 0.3s ease-out;
        }

        /* Responsive image height limits */
        #announcement-image {
            max-height: 70vh;
            object-fit: contain;
        }

        @media (max-width: 640px) {
            #announcement-image {
                max-height: 60vh;
            }
        }
    </style>

    @push('scripts')
        <script>
            // Data pengumuman dari backend
            window.landingAnnouncements = @json($announcementsData);

            document.addEventListener('DOMContentLoaded', function () {
                const announcements = window.landingAnnouncements || [];
                if (!announcements.length) return;

                // ambil list ID yang sudah pernah dilihat dari localStorage
                function getSeenIds() {
                    try {
                        return JSON.parse(localStorage.getItem('seenAnnouncementIds') || '[]');
                    } catch (e) {
                        return [];
                    }
                }

                function setSeenIds(ids) {
                    try {
                        localStorage.setItem('seenAnnouncementIds', JSON.stringify(ids));
                    } catch (e) {
                        // abaikan kalau storage error
                    }
                }

                const seenIds = getSeenIds();
                const unseenAnnouncements = announcements.filter(a => !seenIds.includes(a.id));

                if (!unseenAnnouncements.length) {
                    return; // semua pengumuman sudah pernah dilihat
                }

                let currentIndex = 0;

                const backdrop = document.getElementById('announcement-backdrop');
                const modal    = document.getElementById('announcement-modal');
                const titleEl  = document.getElementById('announcement-title');
                const imgEl    = document.getElementById('announcement-image');
                const linkWrap = document.getElementById('announcement-link-wrapper');
                const linkHint = document.getElementById('announcement-link-hint');
                const btnClose = document.getElementById('announcement-close');
                const btnSkipAll = document.getElementById('announcement-skip-all');

                function openModal() {
                    backdrop.classList.remove('hidden');
                    modal.classList.remove('hidden');
                    // Disable scroll pada body
                    document.body.style.overflow = 'hidden';
                    showCurrent();
                }

                function closeModal() {
                    backdrop.classList.add('hidden');
                    modal.classList.add('hidden');
                    // Enable scroll kembali pada body
                    document.body.style.overflow = '';
                }

                function showCurrent() {
                    const item = unseenAnnouncements[currentIndex];
                    if (!item) {
                        closeModal();
                        return;
                    }

                    titleEl.textContent = item.title || '';
                    imgEl.src = item.image_url || '';
                    imgEl.alt = item.title || '';

                    if (item.link) {
                        linkWrap.href = item.link;
                        linkWrap.style.pointerEvents = 'auto';
                        linkWrap.removeAttribute('aria-disabled');
                        linkHint.classList.remove('hidden');
                    } else {
                        linkWrap.removeAttribute('href');
                        linkWrap.style.pointerEvents = 'none';
                        linkWrap.setAttribute('aria-disabled', 'true');
                        linkHint.classList.add('hidden');
                    }
                }

                function markSeen(id) {
                    const current = getSeenIds();
                    if (!current.includes(id)) {
                        current.push(id);
                        setSeenIds(current);
                    }
                }

                btnClose.addEventListener('click', function () {
                    const item = unseenAnnouncements[currentIndex];
                    if (item) markSeen(item.id);

                    currentIndex++;
                    if (currentIndex < unseenAnnouncements.length) {
                        showCurrent();
                    } else {
                        closeModal();
                    }
                });

                btnSkipAll.addEventListener('click', function () {
                    const ids = unseenAnnouncements.map(a => a.id);
                    const current = getSeenIds();
                    const merged = Array.from(new Set(current.concat(ids)));
                    setSeenIds(merged);
                    closeModal();
                });

                // kalau klik di luar box, treat seperti "Tutup" satu pengumuman
                backdrop.addEventListener('click', function () {
                    btnClose.click();
                });

                // buka modal otomatis untuk pengunjung
                openModal();
            });
        </script>
    @endpush
@endif
