<section class="section bg-dark text-white relative overflow-hidden">
    {{-- Decorative arch --}}
    <div class="hidden md:block absolute top-10 right-10 w-[300px] h-[300px] border border-white/8 rounded-full pointer-events-none" aria-hidden="true"></div>

    <div class="container-editorial relative z-10">
        <div class="grid lg:grid-cols-[0.85fr_1.15fr] gap-12 lg:gap-24">

            {{-- Left column: heading + sticky --}}
            <div class="lg:sticky lg:top-32 self-start" data-aos="fade-right">
                <p class="eyebrow eyebrow-light">Agenda Rutin Mingguan</p>
                <div class="section-heading section-heading--light">
                    <h2>Jadwal Rutinan</h2>
                    <p class="description">
                        Kegiatan rutin mingguan yang dilaksanakan di Pondok Pesantren Al-Anwar Pakijangan &mdash;
                        kajian kitab, pengajian, dan pembinaan santri.
                    </p>
                </div>

                <div class="mt-8 inline-flex items-center gap-3 bg-white/5 border border-white/15 rounded-full px-5 py-3">
                    <i class="fas fa-calendar-day text-accent"></i>
                    <span class="text-sm text-white/80">Rolling 7 hari terdekat</span>
                </div>
            </div>

            {{-- Right column: vertical timeline --}}
            <div data-aos="fade-left" data-aos-delay="100">
                <div class="relative pl-8">
                    {{-- Vertical line --}}
                    <div class="absolute left-[7px] top-2 bottom-2 w-px bg-white/15"></div>

                    @php
                        $dayNames = [0 => 'Ahad', 1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu'];
                    @endphp

                    @foreach($rollingDays as $day)
                        @php
                            $hasEvents = $groupedRutinans->get($day['day_of_week'], collect())->isNotEmpty();
                            $dayEvents = $groupedRutinans->get($day['day_of_week'], collect());
                        @endphp
                        <div class="relative pb-10 last:pb-0">
                            {{-- Dot --}}
                            <span class="absolute -left-8 top-1.5 w-4 h-4 rounded-full border-2
                                {{ $day['is_today'] ? 'bg-accent border-accent' : ($hasEvents ? 'bg-primary border-primary' : 'bg-transparent border-white/30') }}"></span>

                            {{-- Year/date label --}}
                            <div class="flex items-center gap-3 mb-1">
                                <span class="font-display text-lg font-semibold {{ $day['is_today'] ? 'text-accent' : 'text-white' }}">
                                    {{ $day['date'] }} {{ $day['month'] }}
                                </span>
                                <span class="text-xs uppercase tracking-[0.14em] text-white/50">{{ $day['day_name'] }}</span>
                                @if($day['is_today'])
                                    <span class="text-[10px] font-bold uppercase tracking-[0.14em] bg-accent text-dark px-2 py-0.5 rounded-full">Hari ini</span>
                                @endif
                            </div>

                            @if($hasEvents)
                                <div class="space-y-2 mt-2">
                                    @foreach($dayEvents as $rutinan)
                                        @php
                                            $isLibur = $rutinan->exceptions->contains('libur_date', $day['full_date']);
                                        @endphp
                                        <div class="group bg-white/5 hover:bg-white/8 border border-white/10 rounded-md p-4 transition-colors">
                                            <div class="flex items-start justify-between gap-3">
                                                <div class="min-w-0">
                                                    <p class="font-semibold text-white text-[15px]">{{ $rutinan->nama_acara }}</p>
                                                    @if($isLibur)
                                                        <p class="text-amber-400 text-xs font-bold mt-0.5 uppercase tracking-wide">Libur</p>
                                                    @else
                                                        <p class="text-white/60 text-xs mt-0.5">
                                                            <i class="far fa-clock mr-1"></i>{{ \Carbon\Carbon::parse($rutinan->waktu)->format('H:i') }} WIB
                                                            &middot; <i class="fas fa-map-marker-alt mr-1"></i>{{ $rutinan->tempat }}
                                                        </p>
                                                    @endif
                                                    @if($rutinan->pengisi)
                                                        <p class="text-white/50 text-xs mt-1">Pengisi: {{ $rutinan->pengisi }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-white/40 text-sm italic">Tidak ada agenda</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>
