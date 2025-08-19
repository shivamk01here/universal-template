<!DOCTYPE html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $siteSettings['site_name'] ?? config('app.name','Laravel') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <style>
        :root {
            --primary-color: {{ $siteSettings['primary_color'] ?? '#374151' }};
            --secondary-color: {{ $siteSettings['secondary_color'] ?? '#6b7280' }};
            --button-color: {{ $siteSettings['button_color'] ?? '#1f2937' }};
            --background-color: {{ $siteSettings['background_color'] ?? '#ffffff' }};
            --bg-primary: #ffffff;
            --bg-secondary: #f9fafb;
            --bg-tertiary: #f3f4f6;
            --text-primary: #111827;
            --text-secondary: #374151;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
            --border-light: #f3f4f6;
            --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
            --backdrop: rgba(255, 255, 255, 0.8);
            --backdrop-blur: rgba(255, 255, 255, 0.95);
            --ring: 0 0 0 3px rgba(17,24,39,.15);
        }
        [data-theme="dark"] {
            --bg-primary: #1f2937;
            --bg-secondary: #111827;
            --bg-tertiary: #374151;
            --text-primary: #f9fafb;
            --text-secondary: #e5e7eb;
            --text-muted: #9ca3af;
            --border-color: #374151;
            --border-light: #4b5563;
            --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.3);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.3);
            --backdrop: rgba(31, 41, 55, 0.8);
            --backdrop-blur: rgba(31, 41, 55, 0.95);
            --ring: 0 0 0 3px rgba(156, 163, 175, .15);
        }
        body { background: var(--bg-secondary); color: var(--text-primary);}
        .bg-dynamic { background-color: var(--background-color) !important; }
        .bg-primary-dynamic { background-color: var(--primary-color) !important; }
        .bg-secondary-dynamic { background-color: var(--secondary-color) !important; }
        .bg-button-dynamic { background-color: var(--button-color) !important; }
        .text-primary-dynamic { color: var(--primary-color) !important; }
        .text-secondary-dynamic { color: var(--secondary-color) !important; }
        .border-primary-dynamic { border-color: var(--primary-color) !important; }
        .theme-bg-primary { background-color: var(--bg-primary);}
        .theme-bg-secondary { background-color: var(--bg-secondary);}
        .theme-bg-tertiary { background-color: var(--bg-tertiary);}
        .theme-text-primary { color: var(--text-primary);}
        .theme-text-secondary { color: var(--text-secondary);}
        .theme-text-muted { color: var(--text-muted);}
        .theme-border { border-color: var(--border-color);}
        .theme-border-light { border-color: var(--border-light);}
        .theme-backdrop { background-color: var(--backdrop);}
        .theme-backdrop-blur { background-color: var(--backdrop-blur);}
        .focus-ring:focus-visible { outline: none; box-shadow: var(--ring);border-radius:.5rem;}
        .nav-link { position:relative;transition:color .2s;}
        .nav-link::after { content:'';position:absolute;left:50%;bottom:-6px;height:2px;width:0;
            background:linear-gradient(90deg,var(--primary-color),var(--secondary-color));
            transform:translateX(-50%);transition:width .2s;}
        .nav-link:hover::after,.nav-link:focus-visible::after{width:100%;}
        @media (min-width:1024px){ .hover-dropdown:hover .dropdown-panel{display:block;} }
        .toast-enter{opacity:0;transform:translateY(-6px) scale(.98);}
        .toast-enter-active{opacity:1;transform:translateY(0) scale(1);transition:all .22s;}
        .toast-leave{opacity:1;transform:translateY(0) scale(1);}
        .toast-leave-active{opacity:0;transform:translateY(-6px) scale(.98);transition:all .18s;}
        .theme-toggle{transition:all 0.3s;position:relative;overflow:hidden;}
        .theme-toggle:hover{transform:scale(1.07);}
        .theme-icon{transition:all 0.35s;}
        [data-theme="dark"] .theme-icon.sun{opacity:0;transform:rotate(180deg) scale(0.8);}
        [data-theme="dark"] .theme-icon.moon{opacity:1;transform:rotate(0deg) scale(1);}
        [data-theme="light"] .theme-icon.sun,:root .theme-icon.sun{opacity:1;transform:rotate(0deg) scale(1);}
        [data-theme="light"] .theme-icon.moon,:root .theme-icon.moon{opacity:0;transform:rotate(0deg) scale(0.8);}
        .theme-toggle-flash{animation:toggleFlash .38s cubic-bezier(.6,.2,.85,1);}
        @keyframes toggleFlash{0%{filter:blur(0px) brightness(1.2) scale(1);}
          60%{filter:blur(7px) brightness(1.4) scale(1.08);}
          100%{filter:blur(0px) brightness(1) scale(1);}
        }
        .loader-bg{background:linear-gradient(120deg,var(--bg-tertiary) 0%,var(--bg-primary) 99%);}
        .loader-bar{background:linear-gradient(to right,var(--primary-color),var(--secondary-color));}
        .loader-logo-shadow{box-shadow:0 6px 38px 0 var(--primary-color,#0001);}
        .nav-center{display:flex;align-items:center;height:100%;}
        {{ $siteSettings['custom_css'] ?? '' }}
    </style>
</head>
<body class="min-h-screen theme-bg-secondary theme-text-primary antialiased">
<!-- PRELOADER -->
<div id="site-preloader" style="position:fixed;z-index:9999;inset:0;display:flex;align-items:center;justify-content:center;flex-direction:column;background:rgba(255,255,255,0.97);" class="loader-bg transition-all duration-500">
    <div class="flex flex-col items-center">
        <img src="{{ env('APP_URL') . '/' . ltrim($siteSettings['site_logo_url'] ?? '', '/') }}"
             alt="{{ $siteSettings['site_name'] ?? '' }}"
             class="h-20 w-auto mb-4 loader-logo-shadow transition-all duration-500" id="loader-logo">
        <div class="relative w-48 h-3 bg-white/60 rounded-full overflow-hidden shadow-inner">
            <div id="loader-bar" class="loader-bar h-full w-0 rounded-full transition-all duration-500"></div>
        </div>
    </div>
</div>
<div class="flex min-h-screen flex-col">
    <!-- Header -->
    <header class="sticky top-0 z-50 theme-border border-b theme-backdrop-blur backdrop-blur">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <!-- Brand -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 focus-ring">
                    <img src="{{ env('APP_URL') . '/' . ltrim($siteSettings['site_logo_url'] ?? '', '/') }}"
                        alt="{{ $siteSettings['site_name'] ?? '' }}"
                        class="h-9 w-auto">
                    <span class="hidden sm:block text-xl font-medium tracking-tight theme-text-primary">
                        {{ $siteSettings['site_name'] ?? config('app.name','Laravel') }}
                    </span>
                </a>
                <!-- Desktop nav -->
                <nav class="hidden lg:flex nav-center items-center gap-6" aria-label="Primary">
                    <a href="{{ route('home') }}" class="nav-link text-sm theme-text-muted hover:theme-text-primary focus-ring">Home</a>
                    <a href="{{ route('items.index') }}" class="nav-link text-sm theme-text-muted hover:theme-text-primary focus-ring">Services & Products</a>
                    <a href="{{ route('blogs.index') }}" class="nav-link text-sm theme-text-muted hover:theme-text-primary focus-ring">Blog</a>
                    <div class="relative hover-dropdown">
                        <button id="pages-btn"
                                class="nav-link flex items-center gap-2 text-sm theme-text-muted hover:theme-text-primary focus-ring"
                                aria-expanded="false" aria-controls="pages-menu">
                            <span>Pages</span>
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </button>
                        <div id="pages-menu"
                             class="dropdown-panel absolute left-0 mt-2 hidden w-80 rounded-xl theme-border border theme-backdrop-blur p-2 shadow-xl backdrop-blur">
                            <div class="px-3 pb-2 pt-1 text-xs font-semibold uppercase tracking-wider theme-text-muted">Quick Links</div>
                            <div class="space-y-1">
                                @forelse($staticPages ?? [] as $page)
                                    <a href="{{ route('page.show', $page->slug) }}" class="block rounded-lg px-3 py-2 text-sm theme-text-secondary hover:theme-bg-tertiary hover:theme-text-primary">
                                        <div class="font-medium">{{ $page->title }}</div>
                                        <div class="text-xs theme-text-muted">
                                            {{ $page->meta_description ?? Str::limit(strip_tags($page->content ?? ''), 60, '...') ?: 'Learn more about our ' . strtolower($page->title) }}
                                        </div>
                                    </a>
                                @empty
                                    <a href="/about-us" class="block rounded-lg px-3 py-2 text-sm theme-text-secondary hover:theme-bg-tertiary hover:theme-text-primary">About Us</a>
                                    <a href="/our-mission" class="block rounded-lg px-3 py-2 text-sm theme-text-secondary hover:theme-bg-tertiary hover:theme-text-primary">Our Mission</a>
                                    <a href="/careers" class="block rounded-lg px-3 py-2 text-sm theme-text-secondary hover:theme-bg-tertiary hover:theme-text-primary">Careers</a>
                                    <a href="/privacy-policy" class="block rounded-lg px-3 py-2 text-sm theme-text-secondary hover:theme-bg-tertiary hover:theme-text-primary">Privacy Policy</a>
                                    <a href="/terms-conditions" class="block rounded-lg px-3 py-2 text-sm theme-text-secondary hover:theme-bg-tertiary hover:theme-text-primary">Terms & Conditions</a>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('faq.index') }}" class="nav-link text-sm theme-text-muted hover:theme-text-primary focus-ring">FAQ</a>
                    <a href="{{ route('contact.index') }}" class="nav-link text-sm theme-text-muted hover:theme-text-primary focus-ring">Contact</a>
                </nav>
                <!-- Right actions -->
                <div class="flex items-center gap-2 nav-center">
                    <!-- Theme Toggle -->
                    <button id="theme-toggle" class="theme-toggle relative rounded-full theme-border border theme-bg-primary p-2.5 theme-text-secondary hover:theme-bg-tertiary focus-ring" aria-label="Toggle theme">
                        <i class="fa-solid fa-sun theme-icon sun absolute inset-0 flex items-center justify-center"></i>
                        <i class="fa-solid fa-moon theme-icon moon absolute inset-0 flex items-center justify-center"></i>
                        <i class="fa-solid fa-sun opacity-0"></i>
                    </button>
                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}" class="relative rounded-full theme-border border theme-bg-primary p-2.5 theme-text-secondary hover:theme-bg-tertiary focus-ring" aria-label="Cart">
                        <i class="fa-solid fa-cart-shopping"></i>
                        @if(isset($cartCount) && $cartCount > 0)
                            <span class="absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-600 text-[10px] font-semibold text-white">{{ $cartCount }}</span>
                        @endif
                    </a>
                    @guest
                        <a href="{{ route('login') }}" class="hidden sm:inline-block nav-center rounded-lg px-3 py-2 text-sm font-medium theme-text-secondary hover:theme-bg-tertiary focus-ring">Log in</a>
                        <a href="{{ route('register') }}" class="hidden sm:inline-block nav-center rounded-lg bg-button-dynamic px-3.5 py-2 text-sm font-medium text-white hover:opacity-90 focus-ring">Register</a>
                    @else
                        <div class="relative nav-center">
                            <button id="user-btn" class="flex items-center gap-2 rounded-xl theme-border border theme-bg-primary px-3 py-2 text-sm theme-text-secondary hover:theme-bg-tertiary focus-ring" aria-expanded="false" aria-controls="user-menu">
                                <span class="inline-flex h-7 w-7 items-center justify-center rounded-full bg-primary-dynamic text-white">
                                    <i class="fa-solid fa-user text-xs"></i>
                                </span>
                                <span class="hidden sm:block">{{ Auth::user()->name }}</span>
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </button>
                            <div id="user-menu" class="absolute right-0 mt-2 hidden w-64 rounded-xl theme-border border theme-backdrop-blur p-2 shadow-xl backdrop-blur">
                                <a href="/my-account/profile" class="block rounded-lg px-3 py-2 text-sm theme-text-secondary hover:theme-bg-tertiary hover:theme-text-primary">
                                    <i class="fa-solid fa-user-pen mr-2 theme-text-muted"></i> My Profile
                                </a>
                                <a href="/my-account/orders" class="block rounded-lg px-3 py-2 text-sm theme-text-secondary hover:theme-bg-tertiary hover:theme-text-primary">
                                    <i class="fa-solid fa-clock-rotate-left mr-2 theme-text-muted"></i> My Orders
                                </a>
                                @if(Auth::user()->role === 'admin')
                                    <div class="my-2 border-t theme-border"></div>
                                    <a href="{{ route('admin.dashboard') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-primary-dynamic hover:bg-blue-50 dark:hover:bg-blue-900/20">
                                        <i class="fa-solid fa-gauge-high mr-2 text-primary-dynamic"></i> Admin Dashboard
                                    </a>
                                @endif
                                <div class="my-2 border-t theme-border"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left rounded-lg px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20">
                                        <i class="fa-solid fa-right-from-bracket mr-2 text-red-500"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                    <button id="mobile-btn" class="lg:hidden rounded-lg theme-border border theme-bg-primary p-2.5 theme-text-secondary hover:theme-bg-tertiary focus-ring" aria-controls="mobile-menu" aria-expanded="false" aria-label="Toggle menu">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </div>
            </div>
            <div id="mobile-menu" class="lg:hidden hidden border-t theme-border theme-backdrop-blur backdrop-blur">
                <div class="px-4 py-4 space-y-1">
                    <a href="{{ route('home') }}" class="block rounded-lg px-3 py-2 text-sm font-medium theme-text-secondary hover:theme-bg-tertiary">Home</a>
                    <a href="{{ route('items.index') }}" class="block rounded-lg px-3 py-2 text-sm font-medium theme-text-secondary hover:theme-bg-tertiary">Services & Products</a>
                    <a href="{{ route('blogs.index') }}" class="block rounded-lg px-3 py-2 text-sm font-medium theme-text-secondary hover:theme-bg-tertiary">Blog</a>
                    <a href="{{ route('faq.index') }}" class="block rounded-lg px-3 py-2 text-sm font-medium theme-text-secondary hover:theme-bg-tertiary">FAQ</a>
                    <a href="{{ route('contact.index') }}" class="block rounded-lg px-3 py-2 text-sm font-medium theme-text-secondary hover:theme-bg-tertiary">Contact</a>
                    <div class="pt-2">
                        <div class="px-1 pb-1 text-xs font-semibold uppercase tracking-wider theme-text-muted">Pages</div>
                        @forelse($staticPages ?? [] as $page)
                            <a href="{{ route('page.show', $page->slug) }}" class="block rounded-lg px-3 py-2 text-sm theme-text-secondary hover:theme-bg-tertiary">{{ $page->title }}</a>
                        @empty
                            <a href="/about-us" class="block rounded-lg px-3 py-2 text-sm theme-text-secondary hover:theme-bg-tertiary">About Us</a>
                            <a href="/our-mission" class="block rounded-lg px-3 py-2 text-sm theme-text-secondary hover:theme-bg-tertiary">Our Mission</a>
                            <a href="/careers" class="block rounded-lg px-3 py-2 text-sm theme-text-secondary hover:theme-bg-tertiary">Careers</a>
                            <a href="/privacy-policy" class="block rounded-lg px-3 py-2 text-sm theme-text-secondary hover:theme-bg-tertiary">Privacy Policy</a>
                            <a href="/terms-conditions" class="block rounded-lg px-3 py-2 text-sm theme-text-secondary hover:theme-bg-tertiary">Terms & Conditions</a>
                        @endforelse
                    </div>
                    @guest
                        <div class="flex gap-2 pt-2">
                            <a href="{{ route('login') }}" class="flex-1 rounded-lg px-3 py-2 text-center text-sm font-medium theme-text-secondary hover:theme-bg-tertiary">Log in</a>
                            <a href="{{ route('register') }}" class="flex-1 rounded-lg bg-button-dynamic px-3 py-2 text-center text-sm font-medium text-white hover:opacity-90">Register</a>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </header>

    <div id="toast-root" class="pointer-events-none fixed top-4 right-4 z-[60] flex w-auto max-w-full flex-col gap-3"></div>
    @if(session('success'))
        <script>document.addEventListener('DOMContentLoaded',()=>{addToast({id:'toast-success',type:'success',message:@json(session('success')),timeout:4000});});</script>
    @endif
    @if(session('error'))
        <script>document.addEventListener('DOMContentLoaded',()=>{addToast({id:'toast-error',type:'error',message:@json(session('error')),timeout:6000});});</script>
    @endif

    <main class="flex-1">
        @yield('content')
    </main>
    @include('layouts._footer')
</div>

<!-- Loader Script (always works) -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    let preloader = document.getElementById('site-preloader');
    let bar = document.getElementById('loader-bar');
    let logo = document.getElementById('loader-logo');
    let preloaderVisible = true;
    let max = 80; // percent
    const updateBar = p => { if(bar) bar.style.width = Math.max(p,10) + '%'; };

    if (!preloader || !bar || !logo) return; // Avoid errors if not on page

    updateBar(10);
    function hidePreloader() {
        if (!preloaderVisible) return;
        preloaderVisible = false;
        preloader.style.opacity = '0';
        preloader.style.pointerEvents = 'none';
        preloader.style.transition = 'opacity 0.52s cubic-bezier(.44,.44,.02,1)';
        setTimeout(() => { if(preloader) preloader.style.display='none'; }, 520);
    }

    if (document.readyState === 'complete') {
        updateBar(100);
        setTimeout(hidePreloader, 250);
    } else {
        let p = 10, step = 7;
        const timer = setInterval(() => {
            if (p < max) {
                p += step + Math.random() * 5;
                updateBar(Math.min(p, max));
            }
        }, 75);
        window.addEventListener('DOMContentLoaded', () => updateBar(70));
        window.addEventListener('load', () => {
            clearInterval(timer);
            updateBar(100);
            logo.classList.add('scale-110','shadow-lg');
            setTimeout(()=>{logo.classList.remove('scale-110');},280);
            setTimeout(hidePreloader, 300);
        });
    }
});
</script>

<script>
const $=(s,sc=document)=>sc.querySelector(s);
const on=(el,ev,cb)=>el&&el.addEventListener(ev,cb);
// Theme Management
const themeToggle=$('#theme-toggle');
const root=document.documentElement;
const initTheme=()=>{
    const saved=localStorage.getItem('theme')||'light';
    root.setAttribute('data-theme',saved);
    updateThemeIcon(saved);
};
const updateThemeIcon=(theme)=>{
    const sun=$('.theme-icon.sun');const moon=$('.theme-icon.moon');
    if(theme==='dark'){
        sun && (sun.style.opacity='0');
        moon && (moon.style.opacity='1');
        moon && (moon.style.transform='rotate(0deg) scale(1)');
    }else{
        sun && (sun.style.opacity='1');
        moon && (moon.style.opacity='0');
        moon && (moon.style.transform='rotate(0deg) scale(0.8)');
    }
};
const flashThemeTransition=()=>{
    root.classList.add('theme-toggle-flash');
    setTimeout(()=>root.classList.remove('theme-toggle-flash'),400);
};
const toggleTheme=()=>{
    const cur=root.getAttribute('data-theme')||'light';
    const next=cur==='light'?'dark':'light';
    root.setAttribute('data-theme',next);
    localStorage.setItem('theme',next);
    updateThemeIcon(next);
    themeToggle.style.transform='scale(0.89)';
    setTimeout(()=>{themeToggle.style.transform='scale(1)';},120);
    flashThemeTransition();
};
initTheme();
on(themeToggle,'click',toggleTheme);

// Pages dropdown: click toggle (hover is CSS-based on desktop)
const pagesBtn=$('#pages-btn'), pagesMenu=$('#pages-menu');
on(pagesBtn,'click',(e)=>{
    e.preventDefault();
    const hidden=pagesMenu.classList.toggle('hidden');
    pagesBtn.setAttribute('aria-expanded',String(!hidden));
});
on(document,'click',(e)=>{
    if(pagesMenu && !pagesMenu.classList.contains('hidden')){
        if(!pagesMenu.contains(e.target) && !pagesBtn.contains(e.target)){
            pagesMenu.classList.add('hidden');
            pagesBtn.setAttribute('aria-expanded','false');
        }
    }
});
const userBtn=$('#user-btn'), userMenu=$('#user-menu');
on(userBtn,'click',()=>{
    const hidden=userMenu.classList.toggle('hidden');
    userBtn.setAttribute('aria-expanded',String(!hidden));
});
on(document,'click',(e)=>{
    if(userMenu && !userMenu.classList.contains('hidden')){
        if(!userMenu.contains(e.target) && !userBtn.contains(e.target)){
            userMenu.classList.add('hidden');
            userBtn.setAttribute('aria-expanded','false');
        }
    }
});
const mobileBtn=$('#mobile-btn'),mobileMenu=$('#mobile-menu');
on(mobileBtn,'click',()=>{
    const hidden=mobileMenu.classList.toggle('hidden');
    mobileBtn.setAttribute('aria-expanded',String(!hidden));
});
on(window,'resize',()=>{
    if(innerWidth>=1024&&mobileMenu&&!mobileMenu.classList.contains('hidden')){
        mobileMenu.classList.add('hidden');
        mobileBtn&&mobileBtn.setAttribute('aria-expanded','false');
    }
});
function addToast({ id, type='info', message='', timeout=5000 }){
    const root = document.getElementById('toast-root');
    if(!root) return;
    const map={
        success:{ring:'ring-1 ring-emerald-300/60',grad:'from-emerald-50/90 to-white/90',iconBg:'bg-emerald-600',icon:'fa-check',text:'text-emerald-900',sub:'text-emerald-700'},
        error:{ring:'ring-1 ring-rose-300/60',grad:'from-rose-50/90 to-white/90',iconBg:'bg-rose-600',icon:'fa-xmark',text:'text-rose-900',sub:'text-rose-700'},
        info:{ring:'ring-1 ring-gray-300/60',grad:'from-gray-50/90 to-white/90',iconBg:'bg-gray-800',icon:'fa-info',text:'text-gray-900',sub:'text-gray-600'}};
    const c=map[type]||map.info;
    const wrap=document.createElement('div');
    wrap.setAttribute('role','status');
    wrap.setAttribute('aria-live','polite');
    wrap.className=`pointer-events-auto rounded-xl border border-white/60 ${c.ring} bg-gradient-to-br ${c.grad} backdrop-blur-sm shadow-xl overflow-hidden`;
    wrap.innerHTML=`
        <div class="toast-enter flex max-w-sm items-start gap-3 px-4 py-3 sm:px-5 sm:py-4">
            <div class="mt-0.5 inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full ${c.iconBg} text-white shadow-sm">
                <i class="fa-solid ${c.icon} text-sm"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm font-medium ${c.text}">${escapeHtml(String(message))}</p>
                <p class="mt-0.5 text-xs ${c.sub}">Tap to dismiss</p>
            </div>
            <button type="button" aria-label="Close"
                class="ml-1 inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-md text-gray-500 hover:bg-black/5 focus:outline-none">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
        </div>`;
    root.appendChild(wrap);
    requestAnimationFrame(()=>{
        const inner=wrap.firstElementChild;
        inner.classList.add('toast-enter-active');
        inner.classList.remove('toast-enter');
    });
    const close=()=>{
        const inner=wrap.firstElementChild;
        inner.classList.remove('toast-enter-active');
        inner.classList.add('toast-leave');
        requestAnimationFrame(()=>inner.classList.add('toast-leave-active'));
        setTimeout(()=>wrap.remove(),200);
    };
    let timer = null;
    if (timeout && timeout > 0){ timer = setTimeout(close, timeout);}
    wrap.addEventListener('mouseenter',()=>timer&&clearTimeout(timer));
    wrap.addEventListener('mouseleave',()=>{if(timeout&&timeout>0)timer=setTimeout(close,2000);});
    wrap.addEventListener('click',close);
    wrap.querySelector('button')?.addEventListener('click',(e)=>{e.stopPropagation();close();});
}
function escapeHtml(str){return str.replace(/[&<>"']/g,m=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m]));}
</script>
<script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>


<!-- https://www.chatbase.co/dashboard/bhagyavidhan/chatbot/6So8DUG_9xv6wQAqYsxrY/connect/embed -->
<script>
    (function(){if(!window.chatbase||window.chatbase("getState")!=="initialized"){window.chatbase=(...arguments)=>{if(!window.chatbase.q){window.chatbase.q=[]}window.chatbase.q.push(arguments)};window.chatbase=new Proxy(window.chatbase,{get(target,prop){if(prop==="q"){return target.q}return(...args)=>target(prop,...args)}})}const onLoad=function(){const script=document.createElement("script");script.src="https://www.chatbase.co/embed.min.js";script.id="6So8DUG_9xv6wQAqYsxrY";script.domain="www.chatbase.co";document.body.appendChild(script)};if(document.readyState==="complete"){onLoad()}else{window.addEventListener("load",onLoad)}})();
    </script>