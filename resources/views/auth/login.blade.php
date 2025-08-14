<!DOCTYPE html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign in</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

  <style>
    html,body{height:100%}
    body{font-family:'Figtree', ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', Arial, 'Noto Sans', 'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol','Noto Color Emoji'}
    .fade-enter{opacity:0; transform: translateY(6px)}
    .fade-enter-active{opacity:1; transform: translateY(0); transition: all .25s ease}
  </style>
</head>
<body class="min-h-screen bg-white text-gray-900 antialiased">
  <div class="grid min-h-screen grid-cols-1 lg:grid-cols-12">
    <!-- Image (lg+ only, ~55%) -->
    <aside class="relative hidden lg:block lg:col-span-7">
      <img
        src="https://images.unsplash.com/photo-1454789548928-9efd52dc4031?q=80&w=1600&auto=format&fit=crop&ixlib=rb-4.1.0"
        alt=""
        class="absolute inset-0 h-full w-full object-cover"
        loading="lazy"
      />
      <!-- Subtle gradient for legibility -->
      <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/20 via-black/10 to-transparent"></div>

      <!-- Quotes: bottom-right, on image (no card) -->
      <div class="absolute bottom-6 right-6 select-none">
        <figure id="q0" class="quote fade-enter text-right text-white/90 max-w-xl">
          <blockquote class="text-sm sm:text-base font-medium leading-snug">
            “Simplicity is the ultimate sophistication.”
          </blockquote>
          <figcaption class="mt-1 text-xs text-white/70">Leonardo da Vinci</figcaption>
        </figure>
        <figure id="q1" class="quote hidden text-right text-white/90 max-w-xl">
          <blockquote class="text-sm sm:text-base font-medium leading-snug">
            “Design is intelligence made visible.”
          </blockquote>
          <figcaption class="mt-1 text-xs text-white/70">Alina Wheeler</figcaption>
        </figure>
        <figure id="q2" class="quote hidden text-right text-white/90 max-w-xl">
          <blockquote class="text-sm sm:text-base font-medium leading-snug">
            “Details aren’t details. They make the design.”
          </blockquote>
          <figcaption class="mt-1 text-xs text-white/70">Charles Eames</figcaption>
        </figure>
      </div>
    </aside>

    <!-- Form (45%) -->
    <main class="flex items-center justify-center px-4 py-12 sm:px-6 lg:col-span-5 lg:px-12">
      <div class="w-full max-w-md">
        <div class="mb-8 text-center">
          <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-gray-900 text-white">
            <i class="fa-solid fa-lock text-sm"></i>
          </div>
          <h1 class="text-2xl font-semibold tracking-tight sm:text-3xl">Sign in to your account</h1>
          <p class="mt-2 text-sm text-gray-500">Welcome back. Please enter your details.</p>
        </div>

        <form action="{{ route('login') }}" method="POST" class="space-y-6">
          @csrf

          @if (session('success'))
            <div class="rounded-lg border border-emerald-200 bg-emerald-50/80 p-3 text-sm text-emerald-800">
              {{ session('success') }}
            </div>
          @endif

          @if (session('error'))
            <div class="rounded-lg border border-rose-200 bg-rose-50/80 p-3 text-sm text-rose-800">
              {{ session('error') }}
            </div>
          @endif

          @if ($errors->any())
            <div class="rounded-lg border border-rose-200 bg-rose-50/80 p-3 text-sm text-rose-800">
              <ul class="list-inside list-disc space-y-1">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <div class="space-y-4">
            <div>
              <label for="email" class="mb-2 block text-sm font-medium text-gray-700">Email address</label>
              <input
                id="email"
                name="email"
                type="email"
                autocomplete="email"
                required
                value="{{ old('email') }}"
                class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-base text-gray-900 placeholder:text-gray-400 shadow-sm focus:border-gray-800 focus:ring-2 focus:ring-gray-800/15"
                placeholder="you@example.com"
              />
            </div>

            <div>
              <div class="mb-2 flex items-center justify-between">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                @if (Route::has('password.request'))
                  <a href="{{ route('password.request') }}" class="text-xs font-medium text-gray-700 hover:text-gray-900">
                    Forgot password?
                  </a>
                @endif
              </div>
              <div class="relative">
                <input
                  id="password"
                  name="password"
                  type="password"
                  autocomplete="current-password"
                  required
                  class="block w-full rounded-lg border border-gray-300 bg-white px-4 py-3 pr-11 text-base text-gray-900 placeholder:text-gray-400 shadow-sm focus:border-gray-800 focus:ring-2 focus:ring-gray-800/15"
                  placeholder="••••••••"
                />
                <button type="button" aria-label="Toggle password visibility"
                        class="absolute inset-y-0 right-0 grid w-10 place-items-center text-gray-500 hover:text-gray-700"
                        onclick="const i=this.previousElementSibling;i.type=i.type==='password'?'text':'password';this.querySelector('i').classList.toggle('fa-eye');this.querySelector('i').classList.toggle('fa-eye-slash');">
                  <i class="fa-solid fa-eye-slash text-sm"></i>
                </button>
              </div>
            </div>
          </div>

          <div class="pt-2 space-y-3">
            <button
              type="submit"
              class="inline-flex w-full items-center justify-center rounded-lg bg-gray-900 px-5 py-3 text-base font-medium text-white shadow-sm transition hover:bg-gray-800 hover:shadow-md"
            >
              <i class="fa-solid fa-right-to-bracket mr-2 text-sm"></i>
              Sign in
            </button>

            <!-- Secondary actions -->
            <div class="flex items-center justify-between text-sm">
              @if (Route::has('register'))
                <p class="text-gray-600">
                  Don’t have an account?
                  <a href="{{ route('register') }}" class="font-medium text-gray-900 hover:underline">Create one</a>
                </p>
              @endif

              <div class="flex items-center gap-3">
                <a href="/" class="inline-flex items-center text-gray-700 hover:text-gray-900">
                  <i class="fa-solid fa-house mr-1 text-xs"></i>
                  Go home
                </a>
                <a href="javascript:void(0)" onclick="history.back()" class="inline-flex items-center text-gray-700 hover:text-gray-900">
                  <i class="fa-solid fa-arrow-left mr-1 text-xs"></i>
                  Go back
                </a>
              </div>
            </div>

            <!-- Or as full-width secondary buttons (uncomment to use)
            <a href="/"
               class="inline-flex w-full items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-3 text-base font-medium text-gray-700 shadow-sm transition hover:bg-gray-50">
              <i class="fa-solid fa-house mr-2 text-sm"></i>
              Go home
            </a>
            <a href="javascript:void(0)" onclick="history.back()"
               class="inline-flex w-full items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-3 text-base font-medium text-gray-700 shadow-sm transition hover:bg-gray-50">
              <i class="fa-solid fa-arrow-left mr-2 text-sm"></i>
              Go back
            </a>
            -->
          </div>
        </form>
      </div>
    </main>
  </div>

  <script>
    // Minimal quote rotator
    (function(){
      const slides = Array.from(document.querySelectorAll('.quote'));
      if(slides.length === 0) return;
      let i = 0, t = null, interval = 4000;

      function show(n){
        slides.forEach((el, idx) => {
          if(idx === n){
            el.classList.remove('hidden');
            el.classList.add('fade-enter');
            requestAnimationFrame(()=> el.classList.add('fade-enter-active'));
            setTimeout(()=> el.classList.remove('fade-enter','fade-enter-active'), 260);
          } else {
            el.classList.add('hidden');
          }
        });
        i = n;
      }
      function next(){ show((i+1)%slides.length); }
      function start(){
        if(t) clearInterval(t);
        t = setInterval(next, interval);
      }
      show(0);
      start();
    })();
  </script>
</body>
</html>
