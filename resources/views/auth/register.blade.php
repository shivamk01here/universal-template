<!DOCTYPE html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $siteSettings['site_name'] ?? config('app.name','Laravel') }} | Register</title>
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
            --glass-bg-light: rgba(255,255,255,0.80);
            --glass-bg-dark: rgba(55,65,81,0.75);
        }
        [data-theme="dark"] {
            --bg: #111827;
            --text: #F3F4F6;
            --glass-bg: var(--glass-bg-dark);
            --gradient-bg: linear-gradient(135deg, #232526 0%, #414345 100%);
        }
        [data-theme="light"] {
            --bg: #f9fafb;
            --text: #22223b;
            --glass-bg: var(--glass-bg-light);
            --gradient-bg: linear-gradient(135deg, #f3f4f6 0%, #e0e7ff 100%);
        }
        body {
            font-family: 'Figtree', ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', Arial;
            background: var(--gradient-bg);
            color: var(--text);
            min-height: 100vh;
            transition: background 0.3s;
        }
        .glass-card {
            background: var(--glass-bg);
            box-shadow: 0 8px 32px 0 rgba(31,38,135,0.11);
            border-radius: 2rem;
            border: 1.5px solid rgba(255,255,255,0.24);
            backdrop-filter: blur(12px) saturate(115%);
            -webkit-backdrop-filter: blur(12px) saturate(115%);
        }
        .theme-toggle {
            border: none;
            outline: none;
            background: none;
            font-size: 1.4rem;
            color: var(--text);
            padding: 0.4rem 0.65rem;
            border-radius: 9999px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .theme-toggle:hover {
            background: rgba(0,0,0,0.05);
        }
        .form-error {
            border-color: #ef4444 !important;
            background: #fef2f2 !important;
        }
        .error-msg { color: #dc2626; font-size: 13px; margin-top: 2px; }
        ::selection { background: #e0e7ff; }
        [data-theme="dark"] ::selection { background: #232526; }
        .card-border {
            border: 2px solid rgba(120, 120, 120, 0.09);
        }
    </style>
</head>
<body data-theme="">

    <!-- Theme Toggle -->
    <button id="themeToggleBtn"
        aria-label="Toggle theme"
        class="theme-toggle absolute top-5 right-5 z-50"
        title="Toggle light/dark mode">
        <i class="fa-solid fa-moon hidden" id="themeMoon"></i>
        <i class="fa-solid fa-sun hidden" id="themeSun"></i>
    </button>

    <div class="min-h-screen flex items-center justify-center py-12 px-4 md:px-0">
        <div class="w-full max-w-4xl grid md:grid-cols-2 gap-8">
            <!-- Left Brand Section -->
            <div class="glass-card hidden md:flex flex-col justify-center items-center py-16 px-10 card-border select-none text-center">
                <span class="mb-4">
                    <i class="fa-solid fa-user-astronaut text-4xl text-primary-dynamic"></i>
                </span>
                <h2 class="font-extrabold text-3xl mb-2 tracking-tight">
                    Hey! Join {{ $siteSettings['site_name'] ?? config('app.name','Our Company') }}
                </h2>
                <p class="text-md font-medium text-gray-500 dark:text-gray-300 max-w-xs mx-auto mb-5">
                    Create your account and be a part of our awesome community.<br>
                    Quick, secure, and always in style.<br>
                    <span class="text-xs block mt-3 opacity-70">
                        “{{ $siteSettings['site_description'] ?? 'Your journey starts with us.' }}”
                    </span>
                </p>
                <img src="https://i.imgur.com/ZWnhY9F.png" alt="Register Illustration" class="w-32 mx-auto rounded-xl ring-1 ring-gray-200 shadow-md opacity-80">
            </div>

            <!-- Registration Form Section -->
            <div class="glass-card relative z-10 p-8 sm:p-10 flex flex-col justify-center card-border">

                <div class="mb-4 text-center md:text-left">
                    <div class="inline-flex items-center justify-center mb-2 p-2 rounded-full bg-primary-dynamic/20">
                        <i class="fa-solid fa-user-plus text-lg text-primary-dynamic"></i>
                    </div>
                    <h1 class="text-xl font-bold sm:text-2xl">Create a new account</h1>
                    <p class="text-xs text-gray-500 dark:text-gray-300">Join us in seconds. It’s fast and secure.</p>
                </div>

                <!-- Flash messages from backend -->
                @if (session('success'))
                    <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50/80 p-3 text-sm text-emerald-800">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-4 rounded-lg border border-rose-200 bg-rose-50/80 p-3 text-sm text-rose-800">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('info'))
                    <div class="mb-4 rounded-lg border border-sky-200 bg-sky-50/80 p-3 text-sm text-sky-800">
                        {{ session('info') }}
                    </div>
                @endif

                <!-- Validation errors from backend -->
                @if ($errors->any())
                    <div class="mb-4 rounded-lg border border-rose-200 bg-rose-50/80 p-3 text-sm text-rose-800">
                        <ul class="list-inside list-disc space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Register Form -->
                <form id="register-form" action="{{ route('register') }}" method="POST" novalidate autocomplete="off" class="space-y-5">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                            <input
                                id="name"
                                name="name"
                                type="text"
                                required
                                value="{{ old('name') }}"
                                class="register-input block w-full rounded-lg border border-gray-300/60 bg-white/80 dark:bg-gray-800/60 px-4 py-3 text-base text-gray-900 dark:text-gray-200 placeholder:text-gray-400 shadow-sm focus:border-primary-dynamic focus:ring-2 focus:ring-primary-dynamic/15 transition"
                                placeholder="John Doe"
                                autocomplete="off"
                            />
                            <span class="error-msg hidden" id="nameError"></span>
                        </div>
                        <div>
                            <label for="email" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Email address</label>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                autocomplete="email"
                                required
                                value="{{ old('email') }}"
                                class="register-input block w-full rounded-lg border border-gray-300/60 bg-white/80 dark:bg-gray-800/60 px-4 py-3 text-base text-gray-900 dark:text-gray-200 placeholder:text-gray-400 shadow-sm focus:border-primary-dynamic focus:ring-2 focus:ring-primary-dynamic/15 transition"
                                placeholder="you@example.com"
                                autocomplete="off"
                            />
                            <span class="error-msg hidden" id="emailError"></span>
                        </div>
                        <div>
                            <label for="password" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                            <div class="relative">
                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    autocomplete="new-password"
                                    required
                                    class="register-input block w-full rounded-lg border border-gray-300/60 bg-white/80 dark:bg-gray-800/60 px-4 py-3 pr-11 text-base text-gray-900 dark:text-gray-200 placeholder:text-gray-400 shadow-sm focus:border-primary-dynamic focus:ring-2 focus:ring-primary-dynamic/15 transition"
                                    placeholder="••••••••"
                                    minlength="6"
                                />
                                <button type="button" aria-label="Toggle password visibility"
                                        class="absolute inset-y-0 right-0 grid w-10 place-items-center text-gray-500 hover:text-gray-700"
                                        onclick="const i=this.previousElementSibling;i.type=i.type==='password'?'text':'password';this.querySelector('i').classList.toggle('fa-eye');this.querySelector('i').classList.toggle('fa-eye-slash');">
                                    <i class="fa-solid fa-eye-slash text-sm"></i>
                                </button>
                            </div>
                            <span class="error-msg hidden" id="passwordError"></span>
                        </div>
                        <div>
                            <label for="password_confirmation" class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm Password</label>
                            <div class="relative">
                                <input
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    type="password"
                                    autocomplete="new-password"
                                    required
                                    class="register-input block w-full rounded-lg border border-gray-300/60 bg-white/80 dark:bg-gray-800/60 px-4 py-3 pr-11 text-base text-gray-900 dark:text-gray-200 placeholder:text-gray-400 shadow-sm focus:border-primary-dynamic focus:ring-2 focus:ring-primary-dynamic/15 transition"
                                    placeholder="••••••••"
                                    minlength="6"
                                />
                                <button type="button" aria-label="Toggle confirm password visibility"
                                        class="absolute inset-y-0 right-0 grid w-10 place-items-center text-gray-500 hover:text-gray-700"
                                        onclick="const i=this.previousElementSibling;i.type=i.type==='password'?'text':'password';this.querySelector('i').classList.toggle('fa-eye');this.querySelector('i').classList.toggle('fa-eye-slash');">
                                    <i class="fa-solid fa-eye-slash text-sm"></i>
                                </button>
                            </div>
                            <span class="error-msg hidden" id="confirmError"></span>
                        </div>
                    </div>
                    <div class="pt-2">
                        <button
                            id="registerBtn"
                            type="submit"
                            class="inline-flex w-full items-center justify-center rounded-lg bg-button-dynamic px-5 py-3 text-base font-medium text-white shadow-sm transition hover:bg-primary-dynamic hover:shadow-md"
                        >
                            <i class="fa-solid fa-user-check mr-2 text-sm"></i>
                            Register
                        </button>
                    </div>
                    <p class="pt-2 text-center text-sm text-gray-600 dark:text-gray-400">
                        Already have an account?
                        <a href="{{ route('login') }}" class="font-medium text-primary-dynamic hover:underline">Sign in</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
    <!-- Toast root (do not remove if your app.js uses it) -->
    <div id="toast-root" class="pointer-events-none fixed top-4 right-4 z-[60] flex w-auto max-w-full flex-col gap-3"></div>

    <!-- Include your OTP modal here if you use one, unchanged. -->
    @include('auth.partials.otp-modal')

    <script>
        // THEME JS
        function setTheme(theme) {
            document.body.setAttribute("data-theme", theme);
            localStorage.setItem('theme', theme);
            document.getElementById('themeMoon').classList.toggle('hidden', theme !== 'dark');
            document.getElementById('themeSun').classList.toggle('hidden', theme !== 'light');
        }
        function toggleTheme() {
            const curr = document.body.getAttribute("data-theme") || "light";
            setTheme(curr === "dark" ? "light" : "dark");
        }
        document.getElementById('themeToggleBtn').onclick = toggleTheme;
        (function(){
            let theme = localStorage.getItem('theme');
            if(!theme) theme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            setTheme(theme);
        })();

        // FRONTEND VALIDATION (stays simple; blade validation still works)
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('register-form');
            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const confirm = document.getElementById('password_confirmation');
            const btn = document.getElementById('registerBtn');

            const nameErr = document.getElementById('nameError');
            const emailErr = document.getElementById('emailError');
            const passErr = document.getElementById('passwordError');
            const confErr = document.getElementById('confirmError');

            // Mini functions for error visibility
            function showErr(input, msg, ele) {
                input.classList.add('form-error');
                ele.textContent = msg;
                ele.classList.remove('hidden');
            }
            function hideErr(input, ele) {
                input.classList.remove('form-error');
                ele.textContent = "";
                ele.classList.add('hidden');
            }

            function validate() {
                let v = true;

                // NAME
                if(name.value.trim().length < 2) {
                    showErr(name, "Please enter your full name.", nameErr);
                    v = false;
                } else {
                    hideErr(name, nameErr);
                }

                // EMAIL
                let mailPattern = /^[^@\s]+@[^@\s]+\.[a-zA-Z]{2,}$/;
                if(!mailPattern.test(email.value.trim())) {
                    showErr(email, "Enter a valid email address.", emailErr);
                    v = false;
                } else {
                    hideErr(email, emailErr);
                }

                // PASSWORD
                if(password.value.length < 6) {
                    showErr(password, "Password must be at least 6 characters.", passErr);
                    v = false;
                } else {
                    hideErr(password, passErr);
                }

                // CONFIRM
                if(confirm.value !== password.value || confirm.value.length < 6) {
                    showErr(confirm, "Passwords do not match.", confErr);
                    v = false;
                } else {
                    hideErr(confirm, confErr);
                }

                btn.disabled = !v;
                btn.style.opacity = !v ? 0.5 : 1;
                return v;
            }
            // Live validation
            [name, email, password, confirm].forEach(i=>{
                i.addEventListener('input', validate);
                i.addEventListener('blur', validate);
            });

            // Form submit: block if not valid
            form.addEventListener('submit', function(e){
                if(!validate()) {
                    e.preventDefault();
                }
            });
        });
    </script>

    {{-- If you have custom.js or app.js, do not duplicate toasts/OTP/modal logic here! --}}
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
