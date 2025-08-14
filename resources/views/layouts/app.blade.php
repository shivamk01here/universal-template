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
        :root{ --ring: 0 0 0 3px rgba(17,24,39,.15); }
        .focus-ring:focus-visible{ outline: none; box-shadow: var(--ring); border-radius: .5rem; }

        /* Underline effect for desktop nav links */
        .nav-link { position: relative; transition: color .2s ease; }
        .nav-link::after{
            content:''; position:absolute; left:50%; bottom:-6px; height:2px; width:0;
            background: linear-gradient(90deg,#374151,#6b7280);
            transform: translateX(-50%); transition: width .2s ease;
        }
        .nav-link:hover::after, .nav-link:focus-visible::after{ width:100%; }

        /* Hover-to-open dropdown (desktop only) */
        @media (min-width: 1024px){ .hover-dropdown:hover .dropdown-panel{ display:block; } }

        /* Toast animations */
        .toast-enter { opacity: 0; transform: translateY(-6px) scale(.98); }
        .toast-enter-active { opacity: 1; transform: translateY(0) scale(1); transition: all .22s ease; }
        .toast-leave { opacity: 1; transform: translateY(0) scale(1); }
        .toast-leave-active { opacity: 0; transform: translateY(-6px) scale(.98); transition: all .18s ease; }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-50 text-gray-900 antialiased">
<div class="flex min-h-screen flex-col">
    <!-- Header -->
    <header class="sticky top-0 z-50 border-b border-gray-200/60 bg-white/80 backdrop-blur">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <!-- Brand -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 focus-ring">
                    <img src="{{ $siteSettings['site_logo_url'] ?? '' }}" alt="{{ $siteSettings['site_name'] ?? '' }}" class="h-9 w-auto">
                    <span class="hidden sm:block text-xl font-medium tracking-tight text-gray-900">
                        {{ $siteSettings['site_name'] ?? config('app.name','Laravel') }}
                    </span>
                </a>

                <!-- Desktop nav -->
                <nav class="hidden lg:flex items-center gap-6" aria-label="Primary">
                    <a href="{{ route('home') }}" class="nav-link text-sm text-gray-600 hover:text-gray-900 focus-ring">Home</a>
                    <a href="{{ route('items.index') }}" class="nav-link text-sm text-gray-600 hover:text-gray-900 focus-ring">Services & Products</a>
                    <a href="{{ route('blogs.index') }}" class="nav-link text-sm text-gray-600 hover:text-gray-900 focus-ring">Blog</a>

                    <!-- Pages (hover + click dropdown) -->
                    <div class="relative hover-dropdown">
                        <button id="pages-btn"
                                class="nav-link flex items-center gap-2 text-sm text-gray-600 hover:text-gray-900 focus-ring"
                                aria-expanded="false" aria-controls="pages-menu">
                            <span>Pages</span>
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </button>
                        <div id="pages-menu"
                             class="dropdown-panel absolute left-0 mt-2 hidden w-80 rounded-xl border border-gray-200/70 bg-white/95 p-2 shadow-xl backdrop-blur">
                            <div class="px-3 pb-2 pt-1 text-xs font-semibold uppercase tracking-wider text-gray-500">Quick Links</div>
                            <div class="space-y-1">
                                @forelse($staticPages ?? [] as $page)
                                    <a href="{{ route('page.show', $page->slug) }}" class="block rounded-lg px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900">
                                        <div class="font-medium">{{ $page->title }}</div>
                                        <div class="text-xs text-gray-500">
                                            {{ $page->meta_description ?? Str::limit(strip_tags($page->content ?? ''), 60, '...') ?: 'Learn more about our ' . strtolower($page->title) }}
                                        </div>
                                    </a>
                                @empty
                                    <a href="/about-us" class="block rounded-lg px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900">About Us</a>
                                    <a href="/our-mission" class="block rounded-lg px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900">Our Mission</a>
                                    <a href="/careers" class="block rounded-lg px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900">Careers</a>
                                    <a href="/privacy-policy" class="block rounded-lg px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900">Privacy Policy</a>
                                    <a href="/terms-conditions" class="block rounded-lg px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900">Terms & Conditions</a>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('faq.index') }}" class="nav-link text-sm text-gray-600 hover:text-gray-900 focus-ring">FAQ</a>
                    <a href="{{ route('contact.index') }}" class="nav-link text-sm text-gray-600 hover:text-gray-900 focus-ring">Contact</a>
                </nav>

                <!-- Right actions -->
                <div class="flex items-center gap-2">
                    <a href="{{ route('cart.index') }}" class="relative rounded-full border border-gray-200/70 bg-white/70 p-2.5 text-gray-700 hover:bg-white focus-ring" aria-label="Cart">
                        <i class="fa-solid fa-cart-shopping"></i>
                        @if(isset($cartCount) && $cartCount > 0)
                            <span class="absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-600 text-[10px] font-semibold text-white">{{ $cartCount }}</span>
                        @endif
                    </a>

                    @guest
                        <a href="{{ route('login') }}" class="hidden sm:inline-block rounded-lg px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus-ring">Log in</a>
                        <a href="{{ route('register') }}" class="hidden sm:inline-block rounded-lg bg-gray-900 px-3.5 py-2 text-sm font-medium text-white hover:bg-gray-800 focus-ring">Register</a>
                    @else
                        <div class="relative">
                            <button id="user-btn" class="flex items-center gap-2 rounded-xl border border-gray-200/70 bg-white/70 px-3 py-2 text-sm text-gray-700 hover:bg-white focus-ring" aria-expanded="false" aria-controls="user-menu">
                                <span class="inline-flex h-7 w-7 items-center justify-center rounded-full bg-gray-700 text-white">
                                    <i class="fa-solid fa-user text-xs"></i>
                                </span>
                                <span class="hidden sm:block">{{ Auth::user()->name }}</span>
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </button>
                            <div id="user-menu" class="absolute right-0 mt-2 hidden w-64 rounded-xl border border-gray-200/70 bg-white/95 p-2 shadow-xl backdrop-blur">
                                <a href="/my-account/profile" class="block rounded-lg px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900">
                                    <i class="fa-solid fa-user-pen mr-2 text-gray-400"></i> My Profile
                                </a>
                                <a href="/my-account/orders" class="block rounded-lg px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900">
                                    <i class="fa-solid fa-clock-rotate-left mr-2 text-gray-400"></i> My Orders
                                </a>
                                @if(Auth::user()->role === 'admin')
                                    <div class="my-2 border-t border-gray-200/70"></div>
                                    <a href="{{ route('admin.dashboard') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-blue-700 hover:bg-blue-50">
                                        <i class="fa-solid fa-gauge-high mr-2 text-blue-500"></i> Admin Dashboard
                                    </a>
                                @endif
                                <div class="my-2 border-t border-gray-200/70"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left rounded-lg px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-50">
                                        <i class="fa-solid fa-right-from-bracket mr-2 text-red-500"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest

                    <!-- Mobile menu toggle -->
                    <button id="mobile-btn" class="lg:hidden rounded-lg border border-gray-200/70 bg-white/70 p-2.5 text-gray-700 hover:bg-white focus-ring" aria-controls="mobile-menu" aria-expanded="false" aria-label="Toggle menu">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile menu -->
            <div id="mobile-menu" class="lg:hidden hidden border-t border-gray-200/60 bg-white/90 backdrop-blur">
                <div class="px-4 py-4 space-y-1">
                    <a href="{{ route('home') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Home</a>
                    <a href="{{ route('items.index') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Services & Products</a>
                    <a href="{{ route('blogs.index') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Blog</a>
                    <a href="{{ route('faq.index') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">FAQ</a>
                    <a href="{{ route('contact.index') }}" class="block rounded-lg px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Contact</a>

                    <div class="pt-2">
                        <div class="px-1 pb-1 text-xs font-semibold uppercase tracking-wider text-gray-500">Pages</div>
                        @forelse($staticPages ?? [] as $page)
                            <a href="{{ route('page.show', $page->slug) }}" class="block rounded-lg px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">{{ $page->title }}</a>
                        @empty
                            <a href="/about-us" class="block rounded-lg px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">About Us</a>
                            <a href="/our-mission" class="block rounded-lg px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">Our Mission</a>
                            <a href="/careers" class="block rounded-lg px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">Careers</a>
                            <a href="/privacy-policy" class="block rounded-lg px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">Privacy Policy</a>
                            <a href="/terms-conditions" class="block rounded-lg px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">Terms & Conditions</a>
                        @endforelse
                    </div>

                    @guest
                        <div class="flex gap-2 pt-2">
                            <a href="{{ route('login') }}" class="flex-1 rounded-lg px-3 py-2 text-center text-sm font-medium text-gray-700 hover:bg-gray-50">Log in</a>
                            <a href="{{ route('register') }}" class="flex-1 rounded-lg bg-gray-900 px-3 py-2 text-center text-sm font-medium text-white hover:bg-gray-800">Register</a>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </header>

    <!-- Toast Container -->
    <div id="toast-root" class="pointer-events-none fixed top-4 right-4 z-[60] flex w-auto max-w-full flex-col gap-3"></div>

    <!-- Premium Toasts from session -->
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                addToast({
                    id: 'toast-success',
                    type: 'success',
                    message: @json(session('success')),
                    timeout: 4000
                });
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                addToast({
                    id: 'toast-error',
                    type: 'error',
                    message: @json(session('error')),
                    timeout: 6000
                });
            });
        </script>
    @endif

    <!-- Main -->
    <main class="flex-1">
        @yield('content')
    </main>

    @include('layouts._footer')
</div>

<script>
    const $ = (s,sc=document)=>sc.querySelector(s);
    const on = (el,ev,cb)=>el&&el.addEventListener(ev,cb);

    // Pages dropdown: click toggle (hover is CSS-based on desktop)
    const pagesBtn = $('#pages-btn'), pagesMenu = $('#pages-menu');
    on(pagesBtn,'click',(e)=>{
        e.preventDefault();
        const hidden = pagesMenu.classList.toggle('hidden');
        pagesBtn.setAttribute('aria-expanded', String(!hidden));
    });
    on(document,'click',(e)=>{
        if(pagesMenu && !pagesMenu.classList.contains('hidden')){
            if(!pagesMenu.contains(e.target) && !pagesBtn.contains(e.target)){
                pagesMenu.classList.add('hidden');
                pagesBtn.setAttribute('aria-expanded','false');
            }
        }
    });

    // User dropdown
    const userBtn = $('#user-btn'), userMenu = $('#user-menu');
    on(userBtn,'click',()=>{
        const hidden = userMenu.classList.toggle('hidden');
        userBtn.setAttribute('aria-expanded', String(!hidden));
    });
    on(document,'click',(e)=>{
        if(userMenu && !userMenu.classList.contains('hidden')){
            if(!userMenu.contains(e.target) && !userBtn.contains(e.target)){
                userMenu.classList.add('hidden');
                userBtn.setAttribute('aria-expanded','false');
            }
        }
    });

    // Mobile menu
    const mobileBtn = $('#mobile-btn'), mobileMenu = $('#mobile-menu');
    on(mobileBtn,'click',()=>{
        const hidden = mobileMenu.classList.toggle('hidden');
        mobileBtn.setAttribute('aria-expanded', String(!hidden));
    });
    on(window,'resize',()=>{
        if(innerWidth >= 1024 && mobileMenu && !mobileMenu.classList.contains('hidden')){
            mobileMenu.classList.add('hidden');
            mobileBtn && mobileBtn.setAttribute('aria-expanded','false');
        }
    });

    // Premium Toast system
    function addToast({ id, type='info', message='', timeout=5000 }){
        const root = document.getElementById('toast-root');
        if(!root) return;

        // Colors and icons
        const map = {
            success: {
                ring: 'ring-1 ring-emerald-300/60',
                grad: 'from-emerald-50/90 to-white/90',
                iconBg: 'bg-emerald-600',
                icon: 'fa-check',
                text: 'text-emerald-900',
                sub: 'text-emerald-700'
            },
            error: {
                ring: 'ring-1 ring-rose-300/60',
                grad: 'from-rose-50/90 to-white/90',
                iconBg: 'bg-rose-600',
                icon: 'fa-xmark',
                text: 'text-rose-900',
                sub: 'text-rose-700'
            },
            info: {
                ring: 'ring-1 ring-gray-300/60',
                grad: 'from-gray-50/90 to-white/90',
                iconBg: 'bg-gray-800',
                icon: 'fa-info',
                text: 'text-gray-900',
                sub: 'text-gray-600'
            }
        };
        const c = map[type] || map.info;

        const wrap = document.createElement('div');
        wrap.setAttribute('role','status');
        wrap.setAttribute('aria-live','polite');
        wrap.className = `pointer-events-auto rounded-xl border border-white/60 ${c.ring} bg-gradient-to-br ${c.grad} backdrop-blur-sm shadow-xl overflow-hidden`;

        // Inner
        wrap.innerHTML = `
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
            </div>
        `;

        // Mount
        root.appendChild(wrap);

        // Enter animation
        requestAnimationFrame(()=>{
            const inner = wrap.firstElementChild;
            inner.classList.add('toast-enter-active');
            inner.classList.remove('toast-enter');
        });

        // Close logic
        const close = ()=>{
            const inner = wrap.firstElementChild;
            inner.classList.remove('toast-enter-active');
            inner.classList.add('toast-leave');
            requestAnimationFrame(()=> inner.classList.add('toast-leave-active'));
            setTimeout(()=> wrap.remove(), 200);
        };

        // Auto-dismiss
        let timer = null;
        if (timeout && timeout > 0){
            timer = setTimeout(close, timeout);
        }

        // Interactions
        wrap.addEventListener('mouseenter', ()=> timer && clearTimeout(timer));
        wrap.addEventListener('mouseleave', ()=>{
            if(timeout && timeout > 0) timer = setTimeout(close, 2000);
        });
        wrap.addEventListener('click', close);
        wrap.querySelector('button')?.addEventListener('click', (e)=>{ e.stopPropagation(); close(); });
    }

    // Escape helper to avoid HTML injection in toasts
    function escapeHtml(str){
        return str.replace(/[&<>"']/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m]));
    }
</script>

<script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
