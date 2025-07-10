<section>
    <div class="container mx-auto py-2 sm:py-4 max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center pt-8">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 mb-3">Jadwal Rutinan</h2>
            <div class="w-16 sm:w-20 h-1 bg-emerald-500 mx-auto rounded-full"></div>
        </div>
    </div>
<style>
.timeline-wrapper { position: relative; padding: 4rem 0; margin-left: 0.5rem; margin-right: 0.5rem; }
    .timeline-line { position: absolute; left: 0; right: 0; top: 50%; height: 4px; background: linear-gradient(90deg, rgba(16,185,129,0.2) 0%, rgba(16,185,129,0.8) 50%, rgba(16,185,129,0.2) 100%); transform: translateY(-50%); z-index: 1; border-radius: 2px; }
    .timeline-nodes { position: relative; display: flex; justify-content: space-between; z-index: 2; }
    .timeline-node-container { position: relative; display: flex; justify-content: center; width: calc(100% / 7); }
    .timeline-date-node { width: 50px; height: 50px; background-color: white; border: 3px solid #d1d5db; border-radius: 9999px; z-index: 10; transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05); }
    .timeline-date-node.is-active { border-color: #10B981; transform: scale(1.2); box-shadow: 0 0 20px rgba(16, 185, 129, 0.4); background-color: #f0fdf4; }
    .timeline-date-node.has-events { border-color: #a7f3d0; }
    .timeline-content-box { position: absolute; left: 0; right: 0; display: flex; justify-content: center; z-index: 20; }
    .timeline-content-box.is-top { bottom: 50%; padding-bottom: 40px; }
    .timeline-content-box.is-bottom { top: 50%; padding-top: 40px; }
    .bubble { position: relative; background-color: #008362; color: white; padding: 0.75rem; border-radius: 0.75rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); width: 180px; }
    .bubble-pointer { position: absolute; left: 50%; width: 0; height: 0; border-left: 10px solid transparent; border-right: 10px solid transparent; transform: translateX(-50%); }
    .is-top .bubble-pointer { bottom: -10px; border-top: 10px solid #008362; }
    .is-bottom .bubble-pointer { top: -10px; border-bottom: 10px solid #008362; }
    .day-date { display: flex; flex-direction: column; align-items: center; justify-content: center; }
    .day-number { font-weight: 700; font-size: 1rem; color: #1f2937; }
    .month-name { font-size: 0.6rem; font-weight: 600; text-transform: uppercase; color: #6b7280; margin-top: -0.2rem; }
    .event-item { position: relative; padding: 0.4rem; border-radius: 0.375rem; transition: background-color 0.2s ease; }
    .event-item:hover { background-color: rgba(255, 255, 255, 0.1); }
    .event-detail-popup {
        display: none;
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        margin-bottom: 12px;
        width: 200px;
        max-width: 90vw; /* Ensure popup fits within viewport */
        background-color: white;
        color: #1f2937;
        border-radius: 0.5rem;
        padding: 0.8rem;
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        z-index: 30;
        box-sizing: border-box;
    }
    .event-item:hover .event-detail-popup { display: block; }

    /* Responsive adjustments */
    @media (max-width: 1024px) {
        .timeline-date-node { width: 45px; height: 45px; }
        .bubble { width: 160px; padding: 0.6rem; }
        .day-number { font-size: 0.9rem; }
        .month-name { font-size: 0.55rem; }
        .event-detail-popup { width: 180px; }
    }

    @media (max-width: 768px) {
        .timeline-wrapper { padding: 3.5rem 0; }
        .timeline-date-node { width: 40px; height: 40px; }
        .bubble { width: 140px; padding: 0.5rem; }
        .day-number { font-size: 0.85rem; }
        .month-name { font-size: 0.5rem; }
        .timeline-content-box.is-top { padding-bottom: 35px; }
        .timeline-content-box.is-bottom { padding-top: 35px; }
        .event-detail-popup {
            width: 160px;
            max-width: 85vw;
            font-size: 0.9rem;
        }
    }

    @media (max-width: 640px) {
        .timeline-wrapper { padding: 3rem 0; margin-left: 0.25rem; margin-right: 0.25rem; }
        .timeline-date-node { width: 36px; height: 36px; border-width: 2px; }
        .timeline-date-node.is-active { transform: scale(1.15); }
        .bubble { width: 120px; padding: 0.4rem; }
        .day-number { font-size: 0.8rem; }
        .month-name { font-size: 0.45rem; }
        .timeline-content-box.is-top { padding-bottom: 30px; }
        .timeline-content-box.is-bottom { padding-top: 30px; }
        .event-detail-popup {
            width: 140px;
            max-width: 80vw;
            padding: 0.6rem;
            font-size: 0.8rem;
        }
    }

    @media (max-width: 480px) {
        .timeline-wrapper { padding: 2.5rem 0; }
        .timeline-date-node { width: 32px; height: 32px; }
        .bubble { width: 100px; padding: 0.3rem; font-size: 0.8rem; }
        .day-number { font-size: 0.75rem; }
        .month-name { font-size: 0.4rem; }
        .event-detail-popup {
            width: 120px;
            max-width: 75vw;
            padding: 0.5rem;
            font-size: 0.7rem;
        }
    }

    @media (max-width: 400px) {
        .timeline-date-node { width: 28px; height: 28px; }
        .bubble { width: 90px; padding: 0.25rem; font-size: 0.7rem; }
        .day-number { font-size: 0.7rem; }
        .event-detail-popup {
            width: 100px;
            max-width: 70vw;
            padding: 0.4rem;
            font-size: 0.65rem;
        }
    }

    /* Adjust popup position for leftmost and rightmost nodes to prevent cutoff */
    .timeline-node-container:first-child .event-detail-popup {
        left: 10px;
        transform: none;
    }
    .timeline-node-container:last-child .event-detail-popup {
        right: 10px;
        left: auto;
        transform: none;
    }
</style>

<div class="container mx-auto py-32 sm:py-42 max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="timeline-wrapper">
        <div class="timeline-line"></div>
        <div class="timeline-nodes">
            @foreach($rollingDays as $day)
                <div class="timeline-node-container">
                    @php
                        $hasEvents = $groupedRutinans->get($day['day_of_week'], collect())->isNotEmpty();
                    @endphp
                    <div @class(['timeline-date-node', 'is-active' => $day['is_today'], 'has-events' => $hasEvents])>
                        <div class="day-date">
                            <span class="day-number">{{ $day['date'] }}</span>
                            <span class="month-name">{{ $day['month'] }}</span>
                        </div>
                    </div>
                    
                    @if($hasEvents)
                        <div @class(['timeline-content-box', 'is-top' => $loop->odd, 'is-bottom' => $loop->even])>
                            <div class="bubble">
                                <h4 class="font-bold text-center mb-1 sm:mb-2 text-xs sm:text-sm md:text-base">{{ $day['day_name'] }}</h4>
                                <div class="text-xs sm:text-sm space-y-1">
                                    @foreach($groupedRutinans->get($day['day_of_week'], collect()) as $rutinan)
                                        @php
                                            $isLibur = $rutinan->exceptions->contains('libur_date', $day['full_date']);
                                        @endphp
                                        <div class="event-item">
                                            <div class="{{ $isLibur ? 'opacity-60' : '' }}">
                                                <p class="font-semibold">{{ $rutinan->nama_acara }}</p>
                                                @if($isLibur)
                                                    <p class="text-amber-300 font-bold text-2xs sm:text-xs">LIBUR</p>
                                                @else
                                                    <p class="opacity-90 text-2xs sm:text-xs">{{ \Carbon\Carbon::parse($rutinan->waktu)->format('H:i') }} WIB</p>
                                                @endif
                                            </div>
                                            
                                            <div class="event-detail-popup">
                                                <p class="font-bold text-sm sm:text-base mb-1 sm:mb-2 border-b pb-1 sm:pb-2">{{ $rutinan->nama_acara }}</p>
                                                <dl class="text-2xs sm:text-xs space-y-1">
                                                    <dt class="font-semibold">Tempat:</dt><dd>{{ $rutinan->tempat }}</dd>
                                                    @if($rutinan->pengisi)<dt class="font-semibold mt-1 sm:mt-2">Pengisi:</dt><dd>{{ $rutinan->pengisi }}</dd>@endif
                                                    @if($rutinan->kitab)<dt class="font-semibold mt-1 sm:mt-2">Kitab:</dt><dd>{{ $rutinan->kitab }}</dd>@endif
                                                    @if($rutinan->isi)<dt class="font-semibold mt-1 sm:mt-2">Keterangan:</dt><dd>{{ $rutinan->isi }}</dd>@endif
                                                </dl>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="bubble-pointer"></div>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    <div class="flex justify-center mt-4 sm:mt-6">
         <div class="flex items-center text-xs sm:text-sm text-gray-600"><span class="w-3 h-3 sm:w-4 sm:h-4 rounded-full bg-emerald-500 border-2 border-white shadow mr-1 sm:mr-2"></span>Hari Ini</div>
    </div>
</div>
</section>