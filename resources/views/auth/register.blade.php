<!DOCTYPE html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Create account</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

  <style>
    html,body{height:100%}
    body{font-family:'Figtree', ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', Arial}
    /* Toast animations */
    .toast-enter { opacity:0; transform: translateY(-6px) scale(.98); }
    .toast-enter-active { opacity:1; transform: translateY(0) scale(1); transition: all .22s ease; }
    .toast-leave { opacity:1; transform: translateY(0) scale(1); }
    .toast-leave-active { opacity:0; transform: translateY(-6px) scale(.98); transition: all .18s ease; }
    [x-cloak]{ display:none !important; }
  </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-50 text-gray-900 antialiased">
  <!-- Toast container -->
  <div id="toast-root" class="pointer-events-none fixed top-4 right-4 z-[60] flex w-auto max-w-full flex-col gap-3"></div>

  <main class="mx-auto flex min-h-screen max-w-7xl items-center justify-center px-4 py-12 sm:px-6">
    <div class="w-full max-w-md">
      <!-- Top utilities -->
      <div class="mb-6 flex items-center justify-end gap-4 text-sm">
        <a href="/" class="inline-flex items-center text-gray-700 hover:text-gray-900">
          <i class="fa-solid fa-house mr-1 text-xs"></i>
          Go home
        </a>
        <a href="javascript:void(0)" onclick="history.back()" class="inline-flex items-center text-gray-700 hover:text-gray-900">
          <i class="fa-solid fa-arrow-left mr-1 text-xs"></i>
          Go back
        </a>
      </div>

      <!-- Heading -->
      <div class="mb-8 text-center">
        <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-gray-900 text-white">
          <i class="fa-solid fa-user-plus text-sm"></i>
        </div>
        <h1 class="text-2xl font-semibold tracking-tight sm:text-3xl">Create a new account</h1>
        <p class="mt-2 text-sm text-gray-600">Join us in seconds. It’s fast and secure.</p>
      </div>

      <!-- Flash messages -->
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

      <!-- Validation errors -->
      @if ($errors->any())
        <div class="mb-4 rounded-lg border border-rose-200 bg-rose-50/80 p-3 text-sm text-rose-800">
          <ul class="list-inside list-disc space-y-1">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <!-- Register form -->
      <div class="overflow-hidden rounded-2xl border border-gray-200/70 bg-white/85 p-8 shadow-sm backdrop-blur sm:p-10">
        <form id="register-form" action="{{ route('register') }}" method="POST" class="space-y-6">
          @csrf

          <div class="space-y-4">
            <div>
              <label for="name" class="mb-2 block text-sm font-medium text-gray-700">Full Name</label>
              <input
                id="name"
                name="name"
                type="text"
                required
                value="{{ old('name') }}"
                class="block w-full rounded-lg border border-gray-300/70 bg-white px-4 py-3 text-base text-gray-900 placeholder:text-gray-400 shadow-sm focus:border-gray-800 focus:ring-2 focus:ring-gray-800/15"
                placeholder="John Doe"
              />
            </div>

            <div>
              <label for="email" class="mb-2 block text-sm font-medium text-gray-700">Email address</label>
              <input
                id="email"
                name="email"
                type="email"
                autocomplete="email"
                required
                value="{{ old('email') }}"
                class="block w-full rounded-lg border border-gray-300/70 bg-white px-4 py-3 text-base text-gray-900 placeholder:text-gray-400 shadow-sm focus:border-gray-800 focus:ring-2 focus:ring-gray-800/15"
                placeholder="you@example.com"
              />
            </div>

            <div>
              <label for="password" class="mb-2 block text-sm font-medium text-gray-700">Password</label>
              <div class="relative">
                <input
                  id="password"
                  name="password"
                  type="password"
                  autocomplete="new-password"
                  required
                  class="block w-full rounded-lg border border-gray-300/70 bg-white px-4 py-3 pr-11 text-base text-gray-900 placeholder:text-gray-400 shadow-sm focus:border-gray-800 focus:ring-2 focus:ring-gray-800/15"
                  placeholder="••••••••"
                />
                <button type="button" aria-label="Toggle password visibility"
                        class="absolute inset-y-0 right-0 grid w-10 place-items-center text-gray-500 hover:text-gray-700"
                        onclick="const i=this.previousElementSibling;i.type=i.type==='password'?'text':'password';this.querySelector('i').classList.toggle('fa-eye');this.querySelector('i').classList.toggle('fa-eye-slash');">
                  <i class="fa-solid fa-eye-slash text-sm"></i>
                </button>
              </div>
            </div>

            <div>
              <label for="password_confirmation" class="mb-2 block text-sm font-medium text-gray-700">Confirm Password</label>
              <div class="relative">
                <input
                  id="password_confirmation"
                  name="password_confirmation"
                  type="password"
                  autocomplete="new-password"
                  required
                  class="block w-full rounded-lg border border-gray-300/70 bg-white px-4 py-3 pr-11 text-base text-gray-900 placeholder:text-gray-400 shadow-sm focus:border-gray-800 focus:ring-2 focus:ring-gray-800/15"
                  placeholder="••••••••"
                />
                <button type="button" aria-label="Toggle confirm password visibility"
                        class="absolute inset-y-0 right-0 grid w-10 place-items-center text-gray-500 hover:text-gray-700"
                        onclick="const i=this.previousElementSibling;i.type=i.type==='password'?'text':'password';this.querySelector('i').classList.toggle('fa-eye');this.querySelector('i').classList.toggle('fa-eye-slash');">
                  <i class="fa-solid fa-eye-slash text-sm"></i>
                </button>
              </div>
            </div>
          </div>

          <div class="pt-2">
            <button
              type="submit"
              class="inline-flex w-full items-center justify-center rounded-lg bg-gray-900 px-5 py-3 text-base font-medium text-white shadow-sm transition hover:bg-gray-800 hover:shadow-md"
            >
              <i class="fa-solid fa-user-check mr-2 text-sm"></i>
              Register
            </button>
          </div>

          <p class="pt-2 text-center text-sm text-gray-600">
            Already have an account?
            <a href="{{ route('login') }}" class="font-medium text-gray-900 hover:underline">Sign in</a>
          </p>
        </form>
      </div>
    </div>
  </main>

  <!-- OTP Modal -->
  <div id="otp-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 px-4">
    <div class="w-full max-w-md overflow-hidden rounded-2xl border border-gray-200/70 bg-white p-6 shadow-xl">
      <div class="mb-4 flex items-start gap-3">
        <div class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-gray-900 text-white">
          <i class="fa-solid fa-shield-keyhole text-xs"></i>
        </div>
        <div>
          <h2 class="text-lg font-semibold text-gray-900">Verify Your Account</h2>
          <p class="mt-1 text-sm text-gray-600">Please enter the OTP to complete registration. For demo, use 5454.</p>
        </div>
      </div>

      <form id="otp-form" class="space-y-4">
        <div>
          <label for="otp-input" class="mb-2 block text-sm font-medium text-gray-700">One-Time Password</label>
          <input id="otp-input" type="text" name="otp" required
                 class="block w-full rounded-lg border border-gray-300/70 bg-white px-4 py-3 text-center text-lg tracking-[0.4em] text-gray-900 placeholder:text-gray-400 shadow-sm focus:border-gray-800 focus:ring-2 focus:ring-gray-800/15"
                 placeholder="••••"/>
          <p id="otp-error" class="mt-2 hidden text-sm text-rose-700"></p>
        </div>

        <button id="verify-otp-btn" type="button"
                class="inline-flex w-full items-center justify-center rounded-lg bg-gray-900 px-5 py-3 text-base font-medium text-white shadow-sm transition hover:bg-gray-800 hover:shadow-md">
          <i class="fa-solid fa-circle-check mr-2 text-sm"></i>
          Verify & Create Account
        </button>

        <div class="text-center">
          <button type="button" class="text-sm text-gray-600 hover:text-gray-900" onclick="closeOtpModal()">Cancel</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    // Mini toast system
    function addToast({ type='info', message='', timeout=5000 }){
      const root = document.getElementById('toast-root');
      if(!root) return;
      const map = {
        success:{ ring:'ring-1 ring-emerald-300/60', grad:'from-emerald-50/90 to-white/90', icon:'fa-check', text:'text-emerald-900', sub:'text-emerald-700' },
        error:{ ring:'ring-1 ring-rose-300/60', grad:'from-rose-50/90 to-white/90', icon:'fa-xmark', text:'text-rose-900', sub:'text-rose-700' },
        info:{ ring:'ring-1 ring-gray-300/60', grad:'from-gray-50/90 to-white/90', icon:'fa-info', text:'text-gray-900', sub:'text-gray-600' }
      };
      const c = map[type] || map.info;
      const wrap = document.createElement('div');
      wrap.className = `pointer-events-auto rounded-xl border border-white/60 ${c.ring} bg-gradient-to-br ${c.grad} backdrop-blur-sm shadow-xl overflow-hidden`;
      wrap.innerHTML = `
        <div class="toast-enter flex max-w-sm items-start gap-3 px-4 py-3 sm:px-5 sm:py-4">
          <div class="mt-0.5 inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full ${c.text.replace('text-','bg-')} text-white shadow-sm">
            <i class="fa-solid ${c.icon} text-sm"></i>
          </div>
          <div class="min-w-0 flex-1">
            <p class="text-sm font-medium ${c.text}">${escapeHtml(String(message))}</p>
            <p class="mt-0.5 text-xs ${c.sub}">Tap to dismiss</p>
          </div>
          <button type="button" aria-label="Close"
                  class="ml-1 inline-flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-md text-gray-500 hover:bg-black/5">
            <i class="fa-solid fa-xmark text-sm"></i>
          </button>
        </div>
      `;
      root.appendChild(wrap);
      requestAnimationFrame(()=>{
        const inner = wrap.firstElementChild;
        inner.classList.add('toast-enter-active'); inner.classList.remove('toast-enter');
      });
      const close=()=>{
        const inner=wrap.firstElementChild;
        inner.classList.remove('toast-enter-active'); inner.classList.add('toast-leave');
        requestAnimationFrame(()=> inner.classList.add('toast-leave-active'));
        setTimeout(()=> wrap.remove(), 200);
      };
      let timer=null; if(timeout>0) timer=setTimeout(close, timeout);
      wrap.addEventListener('mouseenter', ()=> timer && clearTimeout(timer));
      wrap.addEventListener('mouseleave', ()=> { if(timeout>0) timer=setTimeout(close, 2000); });
      wrap.addEventListener('click', close);
      wrap.querySelector('button')?.addEventListener('click', (e)=>{ e.stopPropagation(); close(); });
    }
    function escapeHtml(str){ return str.replace(/[&<>"']/g, m=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m])); }

    // Modal helpers
    function openOtpModal(){
      const m = document.getElementById('otp-modal');
      m.classList.remove('hidden');
      m.classList.add('flex');
      setTimeout(()=> document.getElementById('otp-input')?.focus(), 50);
    }
    function closeOtpModal(){
      const m = document.getElementById('otp-modal');
      m.classList.add('hidden');
      m.classList.remove('flex');
    }

    document.addEventListener('DOMContentLoaded', function () {
      const registerForm = document.getElementById('register-form');
      const verifyBtn = document.getElementById('verify-otp-btn');
      const otpError = document.getElementById('otp-error');

      // AJAX register
      registerForm.addEventListener('submit', async function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        try {
          const response = await fetch("{{ route('register') }}", {
            method: 'POST',
            body: formData,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
          });

          if (response.ok) {
            // Show OTP modal
            openOtpModal();
          } else {
            // Try to read JSON validation errors
            let msg = 'Registration failed. Please check your details.';
            try {
              const data = await response.json();
              if (data?.message) msg = data.message;
              if (data?.errors) {
                const firstField = Object.keys(data.errors)[0];
                if (firstField && data.errors[firstField]?.length) {
                  msg = data.errors[firstField];
                }
              }
            } catch(_) {}
            addToast({ type:'error', message: msg, timeout: 6000 });
          }
        } catch (err) {
          addToast({ type:'error', message:'Network error. Please try again.', timeout: 6000 });
        }
      });

      // Verify OTP
      verifyBtn.addEventListener('click', async function () {
        const otpInput = document.getElementById('otp-input');
        otpError.classList.add('hidden');
        otpError.textContent = '';

        const formData = new FormData();
        formData.append('otp', otpInput.value);

        try {
          const response = await fetch("{{ route('register.verify') }}", {
            method: 'POST',
            body: formData,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
          });

          let result = {};
          try { result = await response.json(); } catch(_) {}

          if (response.ok) {
            addToast({ type:'success', message:'Verified! Redirecting…', timeout: 2000 });
            window.location.href = result.redirect_url || "{{ url('/') }}";
          } else {
            const msg = result.error || result.message || 'Verification failed.';
            otpError.textContent = msg;
            otpError.classList.remove('hidden');
          }
        } catch (err) {
          otpError.textContent = 'Network error. Please try again.';
          otpError.classList.remove('hidden');
        }
      });

      // Close modal on Escape
      document.addEventListener('keydown', (e)=>{
        if(e.key === 'Escape'){ closeOtpModal(); }
      });
    });
  </script>
</body>
</html>
