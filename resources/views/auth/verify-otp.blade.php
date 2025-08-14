<!DOCTYPE html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Verify OTP</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

  <style>
    html,body{height:100%}
    body{font-family:'Figtree', ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', Arial}
    .otp-input { -moz-appearance:textfield; text-align:center; }
    .otp-input::-webkit-outer-spin-button,
    .otp-input::-webkit-inner-spin-button { -webkit-appearance:none; margin:0; }
  </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-50 text-gray-900 antialiased">
  <main class="mx-auto flex min-h-screen max-w-7xl items-center justify-center px-4 py-12 sm:px-6">
    <div class="w-full max-w-md">
      <div class="overflow-hidden rounded-2xl border border-gray-200/70 bg-white/85 p-8 shadow-sm backdrop-blur sm:p-10">
        <div class="mb-8 text-center">
          <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-gray-900 text-white">
            <i class="fa-solid fa-shield text-sm"></i>
          </div>
          <h1 class="text-2xl font-semibold tracking-tight sm:text-3xl">Verify Your Account</h1>
          <p class="mt-2 text-sm text-gray-600">
            Enter the 4-digit code we sent to your email.
            <span class="block mt-1 text-xs text-gray-500">For demo, try 5454</span>
          </p>
        </div>

        <form id="otp-form" action="{{ route('otp.verify') }}" method="POST" class="space-y-6">
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

          <!-- OTP inputs -->
          <div>
            <label class="mb-3 block text-sm font-medium text-gray-700">One-Time Password</label>
            <div class="flex items-center justify-center gap-3">
              <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="1"
                     class="otp-input h-12 w-12 rounded-lg border border-gray-300 bg-white text-lg shadow-sm focus:border-gray-800 focus:ring-2 focus:ring-gray-800/15" />
              <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="1"
                     class="otp-input h-12 w-12 rounded-lg border border-gray-300 bg-white text-lg shadow-sm focus:border-gray-800 focus:ring-2 focus:ring-gray-800/15" />
              <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="1"
                     class="otp-input h-12 w-12 rounded-lg border border-gray-300 bg-white text-lg shadow-sm focus:border-gray-800 focus:ring-2 focus:ring-gray-800/15" />
              <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="1"
                     class="otp-input h-12 w-12 rounded-lg border border-gray-300 bg-white text-lg shadow-sm focus:border-gray-800 focus:ring-2 focus:ring-gray-800/15" />
            </div>
            <!-- Hidden input that actually submits -->
            <input id="otp" name="otp" type="hidden" />
            <p class="mt-3 text-xs text-center text-gray-500">You can paste the code directly.</p>
          </div>

          <div class="flex items-center justify-between">
            <button
              type="submit"
              class="inline-flex w-full items-center justify-center rounded-lg bg-gray-900 px-5 py-3 text-base font-medium text-white shadow-sm transition hover:bg-gray-800 hover:shadow-md"
            >
              <i class="fa-solid fa-circle-check mr-2 text-sm"></i>
              Verify
            </button>
          </div>

          
        </form>
      </div>
    </div>
  </main>

  <script>
    // Premium OTP behavior: auto-advance, backspace to previous, paste handling, hidden field sync
    (function(){
      const boxes = Array.from(document.querySelectorAll('.otp-input'));
      const hidden = document.getElementById('otp');
      if (!boxes.length || !hidden) return;

      function updateHidden(){
        hidden.value = boxes.map(b => b.value.trim()).join('');
      }

      boxes.forEach((box, idx) => {
        box.addEventListener('input', (e) => {
          const v = e.target.value.replace(/\D/g,'').slice(0,1);
          e.target.value = v;
          if (v && idx < boxes.length - 1) boxes[idx+1].focus();
          updateHidden();
        });
        box.addEventListener('keydown', (e) => {
          if (e.key === 'Backspace' && !box.value && idx > 0) {
            boxes[idx-1].focus();
            boxes[idx-1].select();
            e.preventDefault();
          }
          if (e.key === 'ArrowLeft' && idx > 0) { boxes[idx-1].focus(); e.preventDefault(); }
          if (e.key === 'ArrowRight' && idx < boxes.length-1) { boxes[idx+1].focus(); e.preventDefault(); }
        });
        box.addEventListener('paste', (e) => {
          const text = (e.clipboardData || window.clipboardData).getData('text').replace(/\D/g,'').slice(0, boxes.length);
          if (!text) return;
          e.preventDefault();
          for (let i = 0; i < boxes.length; i++) {
            boxes[i].value = text[i] || '';
          }
          updateHidden();
          const nextIdx = Math.min(text.length, boxes.length - 1);
          boxes[nextIdx].focus();
          boxes[nextIdx].select();
        });
        // Select on focus for quick overwrite
        box.addEventListener('focus', ()=> box.select());
      });

      // Autofocus first box
      boxes[0].focus();

      // Prevent submit if not complete (optional)
      document.getElementById('otp-form')?.addEventListener('submit', (e) => {
        updateHidden();
        if (hidden.value.length < boxes.length) {
          // simple shake effect
          const wrap = e.target.closest('.space-y-6');
          wrap?.classList.add('animate-[wiggle_.3s_ease]');
          setTimeout(()=> wrap?.classList.remove('animate-[wiggle_.3s_ease]'), 300);
          e.preventDefault();
        }
      });
    })();
  </script>
</body>
</html>
