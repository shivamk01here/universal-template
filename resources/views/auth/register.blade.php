<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    body { font-family: 'Inter', system-ui, sans-serif; background: #f9fafb; }
    .blur-lg { filter: blur(8px);}
    .form-error { border-color: #ef4444 !important; background: #fef2f2 !important; animation: shake .17s;}
    @keyframes shake {
      25% {transform: translateX(-2px);}
      50% {transform: translateX(2px);}
      100%{transform: translateX(0);}
    }
    .modal-bg { background: rgba(0,0,0,0.35); }
    .quote-carousel {
      bottom: 4%; left: 50%;
      transform: translateX(-50%);
      position: absolute;
      width: 100%;
      display: flex;
      justify-content: center;
      pointer-events: none;
      z-index: 10;
    }
    .quote-text {
      color: #6b7280;
      font-size: 1.05rem;
      font-weight: 500;
      text-align: center;
      opacity: 0;
      transition: opacity 0.7s;
      position: absolute;
      width: 90%; left: 5%;
      pointer-events: none;
    }
    .quote-text.active { opacity: 1; position: relative; }
  </style>
</head>
<body class="min-h-screen w-full flex bg-gray-100">

<!-- Already registered message (hidden by default, toggle in JS if needed) -->
<div id="alreadyRegisteredMsg" class="hidden fixed inset-0 flex items-center justify-center z-40 bg-white">
  <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-200 text-center">
    <div class="text-3xl mb-2 text-green-700"><i class="fa-solid fa-circle-check"></i></div>
    <div class="text-lg font-semibold mb-2">You're already registered!</div>
    <div class="mb-4 text-sm text-gray-600">Go to home.</div>
    <a href="/" class="bg-gray-800 text-white px-6 py-2 rounded font-medium hover:bg-gray-900">Home</a>
  </div>
</div>

<!-- MAIN PAGE CONTENT -->
<div id="mainContent" class="relative flex w-full h-screen min-h-screen transition duration-300">
  <!-- Left: Registration Form -->
  <div class="w-full md:w-[40%] h-full flex items-center justify-center bg-white relative z-10">
    <form id="register-form" class="w-full max-w-sm space-y-6" novalidate autocomplete="off">
      @csrf
      <div class="flex flex-col items-center">
        <span class="rounded-full p-3 mb-3 bg-gray-100 shadow">
          <i class="fa-solid fa-user text-xl text-slate-800"></i>
        </span>
        <h2 class="text-2xl font-bold text-slate-900 text-center mb-1">Create an Account</h2>
        <p class="text-gray-500 text-center text-sm mb-2">Welcome! Please fill in your information.</p>
      </div>
      <div class="space-y-4">
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
          <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
              <i class="fa-solid fa-user"></i>
            </span>
            <input id="name" name="name" type="text" required
                   class="pl-10 pr-4 py-2 w-full rounded-lg border border-gray-300 bg-gray-50 text-gray-900 outline-none focus:border-slate-700 transition"
                   placeholder="Jane Smith" autocomplete="off" />
          </div>
          <span id="nameError" class="hidden text-xs text-red-500 mt-1"></span>
        </div>
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
          <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
              <i class="fa-solid fa-envelope"></i>
            </span>
            <input id="email" name="email" type="email" required
                   class="pl-10 pr-4 py-2 w-full rounded-lg border border-gray-300 bg-gray-50 text-gray-900 outline-none focus:border-slate-700 transition"
                   placeholder="you@email.com" autocomplete="off" />
          </div>
          <span id="emailError" class="hidden text-xs text-red-500 mt-1"></span>
        </div>
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
          <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
              <i class="fa-solid fa-lock"></i>
            </span>
            <input id="password" name="password" type="password" minlength="8" required
                   class="pl-10 pr-10 py-2 w-full rounded-lg border border-gray-300 bg-gray-50 text-gray-900 outline-none focus:border-slate-700 transition"
                   placeholder="••••••••" />
            <button type="button" aria-label="Show password"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600"
                    onclick="togglePass('password', this)">
              <i class="fa-solid fa-eye-slash"></i>
            </button>
          </div>
          <span id="passwordError" class="hidden text-xs text-red-500 mt-1"></span>
        </div>
        <div>
          <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
          <div class="relative">
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
              <i class="fa-solid fa-lock"></i>
            </span>
            <input id="password_confirmation" name="password_confirmation" type="password" minlength="8" required
                   class="pl-10 pr-10 py-2 w-full rounded-lg border border-gray-300 bg-gray-50 text-gray-900 outline-none focus:border-slate-700 transition"
                   placeholder="••••••••" />
            <button type="button" aria-label="Show confirm password"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600"
                    onclick="togglePass('password_confirmation', this)">
              <i class="fa-solid fa-eye-slash"></i>
            </button>
          </div>
          <span id="confirmError" class="hidden text-xs text-red-500 mt-1"></span>
        </div>
      </div>
      <button id="registerBtn" type="submit"
              class="w-full py-2 rounded-lg font-semibold text-white bg-slate-900 hover:bg-slate-800 transition text-base flex items-center justify-center gap-2 mt-1">
        <i class="fa-solid fa-user-check"></i> Register
      </button>
      <div class="flex flex-col gap-2 items-center mt-1">
        <div class="text-sm text-slate-600">
          Already have an account?
          <a href="{{ route('login') }}" class="font-semibold text-slate-900 hover:underline">Sign in</a>
        </div>
      </div>
      <span id="registerServerError" class="hidden text-xs text-red-500"></span>
    </form>
  </div>
  <!-- Right: Image desktop only, now moved to right side -->
  <div class="hidden md:flex md:w-[60%] h-full relative">
    <img src="/neon-race.jpg" alt="Neon Race"
         class="w-full h-full object-cover object-center absolute inset-0"/>
    <div class="absolute inset-0 bg-black opacity-40"></div>
    <div class="quote-carousel">
      <span class="quote-text active">"The journey of a thousand miles begins with a single step."</span>
      <span class="quote-text">"Success is not final, failure is not fatal: It is the courage to continue that counts."</span>
      <span class="quote-text">"Believe you can and you're halfway there."</span>
    </div>
  </div>
</div>

<!-- OTP Modal -->
<div id="otpModalBg" class="modal-bg fixed inset-0 hidden z-50 flex items-center justify-center">
  <div class="absolute inset-0">
    <img src="/neon-race.jpg"
         alt="Neon Race BG" class="w-full h-full object-cover opacity-40 blur-sm">
    <div class="absolute inset-0 bg-black opacity-40"></div>
  </div>
  <div class="relative z-10 bg-white/60 backdrop-blur-xl rounded-2xl shadow-xl p-6 w-full max-w-sm mx-4 animate-fadeIn border border-white/30">
    <button class="absolute top-3 right-3 text-gray-400 hover:text-gray-600" onclick="closeOtpModal()">
      <i class="fa-solid fa-xmark text-lg"></i>
    </button>
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Enter OTP sent to your email</h3>
    <form id="otpForm" autocomplete="off" class="space-y-4">
      <input type="text" maxlength="6" pattern="\d*" inputmode="numeric" id="otpInput" required
             class="w-full text-center text-lg tracking-widest rounded-lg border border-gray-300 px-3 py-2 bg-gray-50 focus:border-gray-700 focus:bg-white outline-none"
             placeholder="••••••" />
      <button type="submit"
              class="w-full py-2.5 rounded-lg text-white font-medium bg-gray-800 hover:bg-gray-900 transition flex justify-center items-center gap-2">
        <i class="fa-solid fa-check"></i> Verify
      </button>
    </form>
    <div id="otpError" class="hidden text-red-600 text-sm mt-3"></div>
  </div>
</div>

<script>
function togglePass(field, btn) {
  const inp = document.getElementById(field);
  const icon = btn.querySelector('i');
  if (inp.type === 'password') {
    inp.type = 'text';
    icon.classList.replace('fa-eye-slash','fa-eye');
  } else {
    inp.type = 'password';
    icon.classList.replace('fa-eye','fa-eye-slash');
  }
}

function openOtpModal(){
  document.getElementById('otpModalBg').classList.remove('hidden');
  document.getElementById('mainContent').classList.add('blur-lg');
  setTimeout(()=>{document.getElementById('otpInput').focus()},220);
}
function closeOtpModal(){
  document.getElementById('otpModalBg').classList.add('hidden');
  document.getElementById('mainContent').classList.remove('blur-lg');
}
document.addEventListener('DOMContentLoaded', function() {
  // Quotes carousel
  const quotes = document.querySelectorAll('.quote-text');
  let idx = 0;
  setInterval(()=>{
    quotes.forEach(q=>q.classList.remove('active'));
    idx = (idx+1)%quotes.length;
    quotes[idx].classList.add('active');
  }, 3400);

  // Registration validation (errors only on blur or submit)
  const form = document.getElementById('register-form');
  const name = document.getElementById('name');
  const email = document.getElementById('email');
  const password = document.getElementById('password');
  const confirm = document.getElementById('password_confirmation');
  const btn = document.getElementById('registerBtn');
  const nameErr = document.getElementById('nameError'),
        emailErr = document.getElementById('emailError'),
        passErr = document.getElementById('passwordError'),
        confErr = document.getElementById('confirmError'),
        serverErr = document.getElementById('registerServerError');
  let touched = {name: false, email: false, password: false, confirm: false};
  let submitted = false;

  function validate(){
    let v=true;
    if((touched.name||submitted) && name.value.trim().length<2){showErr(name,"Please enter your full name.",nameErr);v=false;} else hideErr(name,nameErr);
    let mail=/^[^@\s]+@[^@\s]+\.[a-zA-Z]{2,}$/;
    if((touched.email||submitted) && !mail.test(email.value.trim())){showErr(email,"Enter a valid email address.",emailErr);v=false;} else hideErr(email,emailErr);
    if((touched.password||submitted) && password.value.length<8){showErr(password,"At least 8 characters.",passErr);v=false;} else hideErr(password,passErr);
    if((touched.confirm||submitted) && (confirm.value!==password.value||confirm.value.length<8)){showErr(confirm,"Passwords do not match.",confErr);v=false;} else hideErr(confirm,confErr);
    btn.disabled=!v; btn.classList.toggle('opacity-60',!v);
    return v;
  }
  function showErr(input,msg,ele){ input.classList.add('form-error'); ele.textContent=msg; ele.classList.remove('hidden'); }
  function hideErr(input,ele){ input.classList.remove('form-error'); ele.textContent=""; ele.classList.add('hidden'); }

  name.addEventListener('blur',()=>{touched.name=true;validate();});
  email.addEventListener('blur',()=>{touched.email=true;validate();});
  password.addEventListener('blur',()=>{touched.password=true;validate();});
  confirm.addEventListener('blur',()=>{touched.confirm=true;validate();});
  [name,email,password,confirm].forEach(i=>{i.addEventListener('input',validate);});

  // AJAX Registration submit
  form.addEventListener('submit',function(e){
    e.preventDefault();
    serverErr.classList.add('hidden');
    submitted=true;
    if(!validate()) return;
    btn.disabled = true;
    btn.classList.add('opacity-60');
    // send registration POST
    fetch('{{ route('register') }}', {
      method: 'POST',
      headers: {
        'Content-Type':'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify({
        name: name.value,
        email: email.value,
        password: password.value,
        password_confirmation: confirm.value
      })
    }).then(async resp=> {
      btn.disabled = false;
      btn.classList.remove('opacity-60');
      if(resp.ok) {
        // always triggers OTP modal on success
        openOtpModal();
        hideErr(name,nameErr);hideErr(email,emailErr);hideErr(password,passErr);hideErr(confirm,confErr);
        form.reset();
      } else {
        let data = await resp.json();
        if(data?.errors){
          if(data.errors.name) { showErr(name, data.errors.name[0], nameErr); }
          if(data.errors.email) { showErr(email, data.errors.email[0], emailErr);}
          if(data.errors.password) { showErr(password, data.errors.password[0], passErr);}
          if(data.errors.password_confirmation) { showErr(confirm, data.errors.password_confirmation[0], confErr);}
        } else {
          serverErr.textContent = data.message || "Registration failed.";
          serverErr.classList.remove('hidden');
        }
      }
    })
    .catch(()=>{
      btn.disabled = false;
      btn.classList.remove('opacity-60');
      serverErr.textContent = "Registration failed.";
      serverErr.classList.remove('hidden');
    });
  });

  // OTP verify step
  document.getElementById('otpForm').addEventListener('submit',function(e) {
    e.preventDefault();
    let input=document.getElementById('otpInput').value;
    let err=document.getElementById('otpError');
    err.classList.add('hidden');
    if(!/^\d{6}$/.test(input)){
      err.textContent="Please enter a valid 6-digit OTP.";
      err.classList.remove('hidden');
      return;
    }
    // send AJAX for OTP verification
    fetch('{{ route('register.verify') }}', {
      method: 'POST',
      headers: {
        'Content-Type':'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify({ otp: input })
    }).then(async resp=>{
      let data = await resp.json();
      if(resp.ok && data?.redirect_url){
        window.location.href = data.redirect_url;
      } else if(data?.error) {
        err.textContent = data.error;
        err.classList.remove('hidden');
      } else {
        err.textContent = "Invalid OTP.";
        err.classList.remove('hidden');
      }
    }).catch(()=>{
      err.textContent = "Something went wrong.";
      err.classList.remove('hidden');
    });
  });

  window.addEventListener('keydown',e=>{if(e.key==="Escape")closeOtpModal();});
});
</script>
</body>
</html>
