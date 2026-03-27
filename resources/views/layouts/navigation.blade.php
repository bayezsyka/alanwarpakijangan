@php
    $isAdmin = Auth::user() && Auth::user()->isAdmin();
    $isSelasananManager = Auth::user() && Auth::user()->isSelasananManager();
    $isPenulis = Auth::user() && Auth::user()->isPenulis();

    $mainRole = 'User Guest';
    if($isAdmin) $mainRole = 'Administrator';
    elseif($isSelasananManager) $mainRole = 'Manajer Selasanan';
    elseif($isPenulis) $mainRole = 'Penulis Konten';
@endphp

<div class="h-full flex flex-col w-full">
    {{-- Logo & Brand --}}
    <div class="flex items-center h-20 border-b border-gray-50 px-4 bg-white shrink-0">
        <div class="w-12 h-12 shrink-0 flex items-center justify-center bg-emerald-600 rounded-xl shadow-lg shadow-emerald-200">
            <img src="{{ asset('images/logo.webp') }}" alt="Logo" class="h-6 w-6 object-contain brightness-0 invert">
        </div>
        <div :class="sidebarOpen ? 'opacity-100 max-w-xs ml-3' : 'opacity-0 max-w-0 ml-0'" class="whitespace-nowrap overflow-hidden transition-all duration-500">
            <h1 class="text-sm font-black text-gray-800 tracking-tight uppercase">Al-Anwar</h1>
            <p class="text-[10px] font-bold text-emerald-600 tracking-widest uppercase opacity-80">
                @if($isAdmin) Admin Panel
                @elseif($isSelasananManager) Selasanan
                @elseif($isPenulis) Penulis
                @else Dashboard
                @endif
            </p>
        </div>
    </div>

    {{-- Navigation Links --}}
    <div class="flex-1 overflow-y-auto py-6 space-y-1 scrollbar-hide px-4 bg-white">
        @include('layouts.navigation-links')
    </div>

    {{-- Footer/User --}}
    <div class="py-4 border-t border-gray-50 bg-gray-50/50 px-4 flex items-center shrink-0 h-20 transition-all duration-500" :class="sidebarOpen ? 'justify-start' : 'justify-center'">
        <div :class="sidebarOpen ? 'opacity-100 max-w-xs' : 'opacity-0 max-w-0'" class="flex-1 min-w-0 pointer-events-none transition-all duration-500 overflow-hidden">
            <p class="text-xs font-black text-gray-400 uppercase tracking-widest leading-none mb-1 whitespace-nowrap">Sesi Akun</p>
            <p class="text-sm font-bold text-gray-800 truncate">{{ Auth::user()->name }}</p>
            <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-tighter truncate">{{ $mainRole }}</p>
        </div>
        <div x-show="!sidebarOpen" class="text-emerald-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
        </div>
    </div>
</div>
