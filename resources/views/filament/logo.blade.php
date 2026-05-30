@php
    $logo = \App\Models\Setting::where('key', 'site_logo_image')->value('value');
    $text = \App\Models\Setting::where('key', 'site_logo_text')->value('value') 
            ?? \App\Models\Setting::where('key', 'site_name')->value('value') 
            ?? 'GlobalTech';
    
    // Detect login page adaptively
    $isLogin = request()->routeIs('*login*') || request()->is('*/login') || request()->is('login');
@endphp

@if($isLogin)
    <!-- Login Page Layout: Logo above, App Name below -->
    <div class="flex flex-col items-center text-center gap-3 py-4">
        @if($logo)
            <div class="w-20 h-20 bg-white dark:bg-slate-900 rounded-3xl shadow-md border border-slate-200/50 dark:border-slate-800 p-3 flex items-center justify-center shrink-0">
                <img src="{{ asset('storage/' . ltrim($logo, '/')) }}" alt="Logo" class="max-w-full max-h-full object-contain">
            </div>
        @else
            <div class="w-20 h-20 bg-gradient-to-tr from-primary to-accent rounded-3xl shadow-md flex items-center justify-center shrink-0">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
        @endif
        <span class="text-2xl font-extrabold tracking-tight bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent mt-2">
            {{ $text }}
        </span>
    </div>
@else
    <!-- Admin Sidebar Layout: Logo and App Name side-by-side -->
    <div class="flex items-center gap-3">
        @if($logo)
            <div class="w-8 h-8 bg-white dark:bg-slate-900 rounded-lg shadow-sm border border-slate-200/50 dark:border-slate-800 p-1 flex items-center justify-center shrink-0">
                <img src="{{ asset('storage/' . ltrim($logo, '/')) }}" alt="Logo" class="max-w-full max-h-full object-contain">
            </div>
        @endif
        <span class="text-base font-extrabold tracking-tight bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">
            {{ $text }}
        </span>
    </div>
@endif
