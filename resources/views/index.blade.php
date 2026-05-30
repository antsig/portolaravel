<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth scroll-pt-16">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $settings['site_title'] ?? 'Portfolio & Company Profile' }}</title>

    <!-- Fonts: Outfit Premium Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Dark Mode Script to prevent FOUC & Sync with data-theme -->
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            document.documentElement.setAttribute('data-theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            document.documentElement.setAttribute('data-theme', 'light');
        }

        function toggleTheme() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                document.documentElement.setAttribute('data-theme', 'light');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                document.documentElement.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
            }
        }
    </script>
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100 transition-colors duration-300 antialiased selection:bg-primary selection:text-white">

    <!-- Header / Glassmorphism Navbar (Melayang) -->
    <header class="fixed w-full top-0 z-50 bg-slate-50/80 dark:bg-slate-950/80 backdrop-blur-md border-b border-slate-200/50 dark:border-slate-900 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="#" class="text-2xl font-bold bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent flex items-center gap-2.5">
                        @if(isset($settings['site_logo_image']) && $settings['site_logo_image'])
                            <img src="{{ asset('storage/' . ltrim($settings['site_logo_image'], '/')) }}" alt="Logo" class="h-8 w-auto object-contain">
                        @endif
                        <span class="text-2xl font-bold bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">
                            {{ $settings['site_logo_text'] ?? 'Brand.' }}
                        </span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <nav class="hidden md:flex space-x-8">
                    @foreach($menus as $menu)
                        <a href="{{ $menu->url }}" class="text-slate-600 hover:text-primary dark:text-slate-400 dark:hover:text-primary font-medium transition-colors">
                            {{ $menu->label }}
                        </a>
                    @endforeach
                </nav>

                <!-- Actions: Theme Switcher & Mobile Menu Trigger -->
                <div class="flex items-center space-x-4">
                    <button onclick="toggleTheme()" class="p-2 rounded-full bg-slate-200 dark:bg-slate-900 text-slate-600 dark:text-slate-400 hover:bg-slate-300 dark:hover:bg-slate-800 transition-transform hover:scale-105 active:scale-95 duration-200" aria-label="Toggle Dark Mode">
                        <!-- Sun Icon (shown in dark mode) -->
                        <svg class="w-5 h-5 hidden dark:block" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"/>
                        </svg>
                        <!-- Moon Icon (shown in light mode) -->
                        <svg class="w-5 h-5 block dark:hidden" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                        </svg>
                    </button>

                    <!-- Mobile Menu Button (Checkbox Toggle style) -->
                    <label for="mobile-drawer-checkbox" class="md:hidden p-2 text-slate-600 dark:text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-900 rounded-md cursor-pointer select-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </label>
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile Menu Drawer Toggle Checkbox -->
    <input type="checkbox" id="mobile-drawer-checkbox" class="drawer-toggle hidden" />

    <!-- Mobile Drawer Sidebar -->
    <div class="custom-drawer-side z-50">
        <label for="mobile-drawer-checkbox" aria-label="close sidebar" class="custom-drawer-overlay"></label>
        <nav class="flex flex-col p-6 w-80 min-h-full bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-200 border-r border-slate-200 dark:border-slate-900 shadow-2xl relative pointer-events-auto">
            <div class="mb-8 flex items-center justify-between">
                <a href="#" class="flex items-center gap-2.5">
                    @if(isset($settings['site_logo_image']) && $settings['site_logo_image'])
                        <img src="{{ asset('storage/' . ltrim($settings['site_logo_image'], '/')) }}" alt="Logo" class="h-8 w-auto object-contain">
                    @endif
                    <span class="text-xl font-bold bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">
                        {{ $settings['site_logo_text'] ?? 'Brand.' }}
                    </span>
                </a>
                <label for="mobile-drawer-checkbox" class="p-1 rounded-md text-slate-400 hover:bg-slate-200 dark:hover:bg-slate-900 cursor-pointer">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </label>
            </div>
            <ul class="space-y-4 font-medium">
                @forelse($menus as $menu)
                    <li>
                        <a href="{{ $menu->url }}" onclick="document.getElementById('mobile-drawer-checkbox').checked = false" class="block py-2 text-slate-600 hover:text-primary dark:text-slate-400 dark:hover:text-primary transition-colors">
                            {{ $menu->label }}
                        </a>
                    </li>
                @empty
                    <li class="text-slate-500 text-sm">Belum ada menu (Tambahkan di Admin)</li>
                @endforelse
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <main class="relative pt-16 overflow-hidden min-h-screen">
        
        <!-- Premium Background Glowing Blobs -->
        <div class="absolute inset-0 -z-10 overflow-hidden pointer-events-none">
            <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-primary/10 dark:bg-primary/20 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-1/4 right-1/4 w-[500px] h-[500px] bg-accent/10 dark:bg-accent/20 rounded-full blur-[120px]"></div>
        </div>

        <!-- 🚀 Home Section (Hero with Typing Animation) -->
        <section id="home" class="min-h-[90vh] lg:min-h-[92vh] pt-6 sm:pt-10 lg:pt-12 pb-12 relative flex flex-col justify-start">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full z-10">
                <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
                    <!-- Text Side -->
                    <div class="flex-1 text-left max-w-3xl">
                        <!-- Pulsing Subtitle -->
                        @if(isset($settings['hero_subtitle']))
                        <div class="inline-flex items-center space-x-2 px-3 py-1.5 bg-primary/10 dark:bg-primary/20 text-primary rounded-full text-xs font-bold tracking-wider uppercase animate-pulse mb-4">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary"></span>
                            <span>{{ $settings['hero_subtitle'] }}</span>
                        </div>
                        @endif

                        <!-- Main Title (Static) -->
                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-slate-900 dark:text-white leading-none mb-2">
                            Architecting
                        </h1>
                        <!-- Typing Wrapper (Fixed Height to prevent Layout Shifting) -->
                        <div class="h-10 sm:h-12 lg:h-14 flex items-center mb-6 overflow-hidden">
                            <span id="hero-typing" class="text-2xl sm:text-3xl lg:text-4xl font-extrabold bg-gradient-to-r from-primary via-secondary to-accent bg-clip-text text-transparent leading-none"></span>
                            <span class="text-primary animate-pulse text-2xl sm:text-3xl lg:text-4xl leading-none">|</span>
                        </div>

                        <!-- Typist Effect Engine -->
                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                const text = @json($settings['hero_title'] ?? 'Next-Gen Digital Solutions');
                                const element = document.getElementById('hero-typing');
                                let i = 0;
                                
                                function typeWriter() {
                                    if (i < text.length) {
                                        element.innerHTML += text.charAt(i);
                                        i++;
                                        setTimeout(typeWriter, 40 + Math.random() * 40);
                                    } else {
                                        // Wait 8 seconds then reset and restart
                                        setTimeout(() => {
                                            i = 0;
                                            element.innerHTML = '';
                                            typeWriter();
                                        }, 8000);
                                    }
                                }
                                setTimeout(typeWriter, 600);
                            });
                        </script>

                        <!-- Description -->
                        <p class="text-base sm:text-lg text-slate-600 dark:text-slate-400 max-w-xl leading-relaxed mb-6">
                            {{ $settings['hero_description'] ?? 'Kami mendesain, membangun, dan menskalakan produk digital kelas dunia yang memberdayakan bisnis Anda untuk memimpin di era digital.' }}
                        </p>

                        <!-- CTA Actions -->
                        <div class="flex flex-wrap gap-4">
                            <a href="#about" class="px-7 py-3.5 bg-primary hover:bg-primary/95 text-white rounded-full font-semibold transition-all transform hover:-translate-y-0.5 shadow-lg shadow-primary/30 hover:shadow-primary/50">
                                Tentang Kami
                            </a>

                            @if(isset($settings['developer_cv']) && $settings['developer_cv'])
                            <a href="{{ route('download-cv') }}" class="px-7 py-3.5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-full font-semibold transition-all transform hover:-translate-y-0.5 shadow-lg shadow-emerald-600/30 hover:shadow-emerald-600/50 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                <span>Unduh CV</span>
                            </a>
                            @endif

                            <a href="#contact" class="px-7 py-3.5 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-900 dark:text-white rounded-full font-semibold hover:border-primary dark:hover:border-primary transition-colors hover:shadow-sm">
                                Hubungi Kami
                            </a>
                        </div>
                    </div>

                    <!-- Visual Side: Rotating Avatar Ring -->
                    <div class="flex-1 w-full max-w-md relative flex justify-center group">
                        <div class="absolute inset-0 bg-gradient-to-tr from-primary to-accent rounded-full blur-2xl opacity-20 group-hover:opacity-30 transition-opacity duration-700"></div>
                        <div class="relative w-72 h-72 sm:w-80 sm:h-80 rounded-full p-2.5 ring-4 ring-primary/80 ring-offset-4 ring-offset-slate-50 dark:ring-offset-slate-950 shadow-2xl overflow-hidden bg-slate-950 flex items-center justify-center">
                            <div class="absolute inset-0 bg-gradient-to-tr from-primary to-accent opacity-20 blur-lg animate-pulse"></div>
                            @if(isset($settings['hero_image']) && $settings['hero_image'])
                                <img src="{{ asset('storage/' . ltrim($settings['hero_image'], '/')) }}" alt="Brand Image" class="w-full h-full object-cover rounded-full filter brightness-95 group-hover:scale-105 transition-transform duration-700">
                            @else
                                <svg class="w-28 h-28 text-primary relative z-10 group-hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 🏢 About Section (Company Profile with Focus Areas) -->
        <section id="about" class="pt-8 sm:pt-10 pb-16 sm:pb-20 bg-white dark:bg-slate-950/40 border-y border-slate-200/30 dark:border-slate-900/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Heading aligned with Porto styling -->
                <div class="text-center mb-8">
                    <h2 class="text-primary font-bold tracking-wider uppercase text-xs">Tentang Kami</h2>
                    <h3 class="text-4xl font-extrabold mt-2 text-slate-800 dark:text-white">Company Profile</h3>
                </div>

                <!-- Two Column Details Card -->
                <div class="flex flex-col lg:flex-row bg-slate-50 dark:bg-slate-950 rounded-3xl overflow-hidden shadow-xl border border-slate-200/50 dark:border-slate-900/80 p-6 sm:p-8 lg:p-8 gap-6 sm:gap-8 items-center">
                    <!-- Left: Large Logo Placeholder or Avatar -->
                    <div class="w-40 h-40 sm:w-48 sm:h-48 rounded-3xl overflow-hidden shrink-0 relative bg-white dark:bg-slate-900 flex items-center justify-center shadow-lg border border-slate-200/50 dark:border-slate-800 group">
                        <div class="absolute inset-0 bg-gradient-to-tr from-primary to-accent opacity-15 blur-lg group-hover:opacity-25 transition-opacity"></div>
                        @if(isset($settings['company_logo']) && $settings['company_logo'])
                            <img src="{{ asset('storage/' . ltrim($settings['company_logo'], '/')) }}" alt="Company Logo" class="w-full h-full object-contain p-6 relative z-10 filter brightness-95 group-hover:scale-105 transition-transform duration-500">
                        @else
                            <svg class="w-16 h-16 text-primary relative z-10 group-hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        @endif
                    </div>

                    <!-- Right: Info Panel -->
                    <div class="flex-grow space-y-5">
                        <div class="inline-block px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-semibold uppercase tracking-wide">
                            {{ $settings['company_name'] ?? 'PT Global Teknologi Nusantara' }}
                        </div>
                        <h4 class="text-3xl font-extrabold text-slate-900 dark:text-white leading-tight">
                            {{ $settings['company_tagline'] ?? 'Inovasi Tanpa Batas untuk Masa Depan Digital' }}
                        </h4>
                        <p class="text-slate-600 dark:text-slate-400 text-lg leading-relaxed text-justify">
                            {{ $settings['company_description'] ?? 'PT Global Teknologi Nusantara adalah perusahaan teknologi terkemuka yang berdedikasi untuk menciptakan solusi digital berdampak tinggi. Kami membantu korporasi dan startup merancang, membangun, dan meluncurkan produk perangkat lunak kelas dunia.' }}
                        </p>
                        
                        <hr class="border-slate-200 dark:border-slate-850" />
                        
                        <p class="text-slate-500 dark:text-slate-400 text-sm flex items-center space-x-2.5">
                            <svg class="w-5 h-5 text-primary shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>{{ $settings['company_address'] ?? 'Jl. Jenderal Sudirman No. 12, Jakarta Selatan, Indonesia' }}</span>
                        </p>
                    </div>
                </div>

                <!-- Focus Areas (Layanan Focus) -->
                @if(count($focusAreas) > 0)
                <div class="mt-16">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($focusAreas as $focus)
                        <div class="p-6 rounded-2xl bg-slate-50 dark:bg-slate-900/40 border border-slate-200/50 dark:border-slate-850 hover:border-primary/50 dark:hover:border-primary/50 hover:shadow-md transition-all duration-300 group">
                            <div class="flex items-start gap-4">
                                <div class="p-3 bg-primary/10 rounded-xl text-primary group-hover:bg-primary group-hover:text-white transition-colors shrink-0">
                                    @if(($focus->icon ?? 'code') === 'lightbulb')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                        </svg>
                                    @elseif(($focus->icon ?? 'code') === 'rocket')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                    @elseif(($focus->icon ?? 'code') === 'cpu')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 5h10a2 2 0 012 2v10a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2z" />
                                        </svg>
                                    @elseif(($focus->icon ?? 'code') === 'globe')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                        </svg>
                                    @elseif(($focus->icon ?? 'code') === 'users')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    @else
                                        <!-- Default code icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                        </svg>
                                    @endif
                                </div>
                                <div class="space-y-1 text-left">
                                    <h5 class="font-bold text-base text-slate-800 dark:text-slate-200">{{ $focus->title ?? 'Fokus Area' }}</h5>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed text-justify">
                                        {{ $focus->description ?? '' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Stats Panel (Gaya Porto) -->
                @if(count($aboutStats) > 0)
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 mt-16">
                    @foreach($aboutStats as $stat)
                    <div class="flex flex-col items-center justify-center p-6 rounded-2xl bg-slate-50 dark:bg-slate-900/20 border border-slate-200/50 dark:border-slate-900/60 hover:bg-slate-100 dark:hover:bg-slate-900/40 transition-colors">
                        <span class="text-4xl font-extrabold text-primary mb-1">{{ $stat->number ?? '0' }}</span>
                        <span class="text-[10px] sm:text-xs uppercase tracking-widest text-slate-500 dark:text-slate-400 font-bold text-center">{{ $stat->label ?? '' }}</span>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </section>

        <!-- 💻 Skills Section (Core Technologies) -->
        @if($skills->count() > 0)
        <section id="skills" class="pt-10 sm:pt-14 pb-16 sm:pb-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-primary font-bold tracking-wider uppercase text-xs">Core Technologies</h2>
                    <h3 class="text-4xl font-extrabold mt-2 text-slate-800 dark:text-white">Technical Proficiency</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($skills as $skill)
                    <div class="p-5 rounded-2xl bg-white dark:bg-slate-950 border border-slate-200/60 dark:border-slate-900 hover:border-primary/40 dark:hover:border-primary/40 hover:shadow-md transition-all duration-300 group">
                        <div class="flex items-center gap-4 mb-3">
                            <div class="w-10 h-10 flex items-center justify-center shrink-0 p-2 bg-slate-50 dark:bg-slate-900 rounded-xl border border-slate-200/50 dark:border-slate-850">
                                @if($skill->icon)
                                    @if(Str::endsWith($skill->icon, ['.svg', '.png', '.jpg', '.jpeg']))
                                        <img src="{{ asset('storage/'.$skill->icon) }}" class="w-full h-full object-contain transition-transform group-hover:scale-110 duration-300" alt="{{ $skill->name }}">
                                    @else
                                        <div class="text-xl">{!! $skill->icon !!}</div>
                                    @endif
                                @else
                                    <div class="w-full h-full rounded-lg flex items-center justify-center text-white text-xs font-bold transition-transform group-hover:scale-110 duration-300" style="background-color: {{ $skill->color ?? '#6366f1' }}">
                                        {{ substr($skill->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <div class="space-y-0.5">
                                <h4 class="font-bold text-sm text-slate-800 dark:text-slate-200">{{ $skill->name }}</h4>
                                <span class="text-[10px] text-slate-400 dark:text-slate-500 uppercase tracking-wider font-semibold">Proficiency</span>
                            </div>
                            <span class="text-xs font-mono font-bold text-primary ml-auto">{{ $skill->proficiency }}%</span>
                        </div>
                        
                        <!-- Premium Progress Bar -->
                        <div class="w-full bg-slate-100 dark:bg-slate-900 rounded-full h-1.5">
                            <div class="h-1.5 rounded-full transition-all duration-1000" style="width: {{ $skill->proficiency }}%; background-color: {{ $skill->color ?? '#6366f1' }}"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        <!-- 🎨 Projects Section (Portfolio Grid) -->
        @if($projects->count() > 0)
        <section id="projects" class="pt-10 sm:pt-14 pb-16 sm:pb-20 bg-white dark:bg-slate-950/40 border-y border-slate-200/30 dark:border-slate-900/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-primary font-bold tracking-wider uppercase text-xs">Portofolio</h2>
                    <h3 class="text-4xl font-extrabold mt-2 text-slate-800 dark:text-white">Selected Works</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($projects as $project)
                    <div class="group rounded-3xl bg-white dark:bg-slate-950 overflow-hidden shadow-lg border border-slate-200/60 dark:border-slate-900 transition-all hover:-translate-y-2 hover:shadow-xl hover:border-primary/30 duration-300 flex flex-col h-full">
                        <!-- Image Container with zoom -->
                        <div class="h-48 overflow-hidden relative bg-slate-100 dark:bg-slate-900 border-b border-slate-200/50 dark:border-slate-900 shrink-0">
                            @if($project->link)
                                <a href="{{ $project->link }}" target="_blank" class="block w-full h-full">
                                    <img src="{{ $project->image ? (str_starts_with($project->image, 'http') ? $project->image : asset('storage/'.$project->image)) : 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=600&q=80' }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                                </a>
                            @else
                                <img src="{{ $project->image ? (str_starts_with($project->image, 'http') ? $project->image : asset('storage/'.$project->image)) : 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=600&q=80' }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                            @endif
                            <div class="absolute top-3 right-3 pointer-events-none">
                                <span class="px-2.5 py-0.5 text-[10px] uppercase font-bold tracking-widest rounded-full bg-primary text-white shadow-md">
                                    Project
                                </span>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 flex flex-col flex-grow justify-between gap-4">
                            <div class="space-y-2">
                                <h4 class="text-lg font-bold text-slate-800 dark:text-slate-200 group-hover:text-primary transition-colors duration-200">
                                    @if($project->link)
                                        <a href="{{ $project->link }}" target="_blank" class="inline-flex items-center gap-1.5 hover:underline">
                                            <span>{{ $project->title }}</span>
                                            <svg class="w-4 h-4 shrink-0 opacity-60 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                            </svg>
                                        </a>
                                    @else
                                        {{ $project->title }}
                                    @endif
                                </h4>
                                <p class="text-slate-500 dark:text-slate-400 text-xs leading-relaxed line-clamp-4 text-justify">
                                    {{ $project->description }}
                                </p>
                            </div>
                            
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif


        <!-- 📧 Contact Section (Get in Touch with Social Connect Card) -->
        <section id="contact" class="pt-10 sm:pt-14 pb-16 sm:pb-20 bg-white dark:bg-slate-950/40 border-t border-slate-200/30 dark:border-slate-900/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-2 gap-12 max-w-6xl mx-auto w-full items-center">
                    
                    <!-- Left Column: Developer Profile Card (Redesigned) -->
                    <div class="bg-slate-50 dark:bg-slate-900/40 border border-slate-200/50 dark:border-slate-900 rounded-3xl p-6 sm:p-8 space-y-6 shadow-xl shadow-slate-100/50 dark:shadow-none hover:border-primary/20 transition-all duration-300">
                        <div class="space-y-1">
                            <h2 class="text-primary font-bold tracking-wider uppercase text-xs mb-1">Hubungi Kami</h2>
                            <h3 class="text-2xl font-extrabold text-slate-800 dark:text-white leading-tight">Developer Profile</h3>
                        </div>
                        
                        <div class="flex items-center gap-4 pt-2">
                            @if(isset($settings['developer_image']) && $settings['developer_image'])
                                <div class="w-14 h-14 rounded-full ring-2 ring-primary/80 ring-offset-2 ring-offset-slate-50 dark:ring-offset-slate-900 overflow-hidden shrink-0 shadow-lg group">
                                    <img src="{{ asset('storage/' . ltrim($settings['developer_image'], '/')) }}" alt="{{ $settings['developer_name'] ?? 'Developer' }}" class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                                </div>
                            @else
                                <!-- Glowing Initial Avatar -->
                                <div class="w-14 h-14 rounded-full bg-gradient-to-tr from-primary to-accent text-white flex items-center justify-center text-xl font-bold shadow-lg shadow-primary/20 shrink-0">
                                    {{ substr($settings['developer_name'] ?? 'B', 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <h4 class="text-lg font-bold text-slate-800 dark:text-white leading-tight">{{ $settings['developer_name'] ?? 'Budi Santoso' }}</h4>
                                <p class="text-xs text-primary font-semibold uppercase tracking-wider mt-0.5">Lead Full-Stack Developer</p>
                            </div>
                        </div>
                        
                        <hr class="border-slate-200/60 dark:border-slate-850" />
                        
                        <div class="space-y-2">
                            <h5 class="text-[10px] uppercase tracking-widest text-slate-400 dark:text-slate-500 font-bold">Tentang Pengembang</h5>
                            <p class="text-slate-600 dark:text-slate-400 leading-relaxed text-sm text-justify">
                                {{ $settings['developer_bio'] ?? 'Budi Santoso adalah Lead Full-Stack Developer berpengalaman yang merancang dan membangun ekosistem digital untuk startup dan korporasi.' }}
                            </p>
                        </div>
                    </div>

                    <!-- Right: Connect Card (Gaya Porto) -->
                    <div class="w-full">
                        <div class="bg-white dark:bg-slate-950 border border-slate-200/60 dark:border-slate-900 rounded-3xl shadow-xl p-6 sm:p-8 space-y-6">
                            <!-- Direct Contacts -->
                            <div class="space-y-4 pt-1">
                                <div class="flex items-center gap-3">
                                    <div class="p-2 bg-primary/10 text-primary rounded-xl shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <a href="mailto:{{ $settings['contact_email'] ?? 'info@globaltech.com' }}" class="text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-primary transition-colors">
                                        {{ $settings['contact_email'] ?? 'info@globaltech.com' }}
                                    </a>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="p-2 bg-primary/10 text-primary rounded-xl shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </div>
                                    <span class="text-sm font-semibold text-slate-600 dark:text-slate-300 leading-normal">
                                        {{ $settings['company_address'] ?? 'Jakarta, Indonesia' }}
                                    </span>
                                </div>
                            </div>

                            <hr class="border-slate-150 dark:border-slate-900" />

                            <div>
                                <div class="grid grid-cols-1 gap-3">
                                @if(isset($settings['github_url']))
                                <a href="{{ $settings['github_url'] }}" target="_blank" class="w-full flex items-center justify-between px-5 py-4 border border-slate-200 dark:border-slate-900 rounded-2xl hover:border-primary/50 hover:pl-7 transition-all duration-300 group">
                                    <span class="flex items-center gap-3.5 text-sm font-semibold text-slate-700 dark:text-slate-300">
                                        <svg class="h-5 w-5 text-slate-600 dark:text-slate-400 group-hover:text-primary transition-colors" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" /></svg>
                                        GitHub
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 group-hover:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                </a>
                                @endif

                                @if(isset($settings['linkedin_url']))
                                <a href="{{ $settings['linkedin_url'] }}" target="_blank" class="w-full flex items-center justify-between px-5 py-4 border border-slate-200 dark:border-slate-900 rounded-2xl hover:border-primary/50 hover:pl-7 transition-all duration-300 group">
                                    <span class="flex items-center gap-3.5 text-sm font-semibold text-slate-700 dark:text-slate-300">
                                        <svg class="h-5 w-5 text-slate-600 dark:text-slate-400 group-hover:text-primary transition-colors" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd" /></svg>
                                        LinkedIn
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 group-hover:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                </a>
                                @endif

                                @if(isset($settings['twitter_url']))
                                <a href="{{ $settings['twitter_url'] }}" target="_blank" class="w-full flex items-center justify-between px-5 py-4 border border-slate-200 dark:border-slate-900 rounded-2xl hover:border-primary/50 hover:pl-7 transition-all duration-300 group">
                                    <span class="flex items-center gap-3.5 text-sm font-semibold text-slate-700 dark:text-slate-300">
                                        <svg class="h-5 w-5 text-slate-600 dark:text-slate-400 group-hover:text-primary transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                        Twitter
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 group-hover:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                </a>
                                @endif

                                @if(isset($settings['instagram_url']))
                                <a href="{{ $settings['instagram_url'] }}" target="_blank" class="w-full flex items-center justify-between px-5 py-4 border border-slate-200 dark:border-slate-900 rounded-2xl hover:border-primary/50 hover:pl-7 transition-all duration-300 group">
                                    <span class="flex items-center gap-3.5 text-sm font-semibold text-slate-700 dark:text-slate-300">
                                        <svg class="h-5 w-5 text-slate-600 dark:text-slate-400 group-hover:text-primary transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.27 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                        Instagram
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 group-hover:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>

    </main>

    <!-- 🌐 Footer -->
    <footer class="bg-slate-50 dark:bg-slate-950 border-t border-slate-200/50 dark:border-slate-900 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-slate-500 dark:text-slate-400 text-sm">
                &copy; {{ date('Y') }} {{ $settings['footer_text'] ?? 'All rights reserved.' }}
            </p>
            <div class="flex space-x-6 text-slate-400">
                @if(isset($settings['github_url']))
                <a href="{{ $settings['github_url'] }}" target="_blank" class="hover:text-primary transition-colors">
                    <span class="sr-only">GitHub</span>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" /></svg>
                </a>
                @endif
                @if(isset($settings['twitter_url']))
                <a href="{{ $settings['twitter_url'] }}" target="_blank" class="hover:text-primary transition-colors">
                    <span class="sr-only">Twitter</span>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
                @endif
                @if(isset($settings['linkedin_url']))
                <a href="{{ $settings['linkedin_url'] }}" target="_blank" class="hover:text-primary transition-colors">
                    <span class="sr-only">LinkedIn</span>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd" /></svg>
                </a>
                @endif
            </div>
        </div>
    </footer>

</body>
</html>
