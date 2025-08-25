<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel - {{ $siteSettings['site_name'] ?? config('app.name') }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
  <!-- Heroicons / Tabler Icons -->
  <link rel="stylesheet" href="https://unpkg.com/@tabler/icons/iconfont/tabler-icons.min.css">
</head>
<body class="bg-gray-100 font-sans antialiased">
  <div 
    x-data="{ sidebarOpen: false,
              toast: { show: false, type: '', message: '' },
              showToast(type, message) { 
                this.toast.type = type; 
                this.toast.message = message; 
                this.toast.show = true;
                setTimeout(() => { this.toast.show = false }, 3500);
              },
              closeToast() { this.toast.show = false }
            }" 
    x-init="
      @if(session('success'))
        showToast('success', '{{ addslashes(session('success')) }}');
      @elseif(session('error'))
        showToast('error', '{{ addslashes(session('error')) }}');
      @elseif(session('warning'))
        showToast('warning', '{{ addslashes(session('warning')) }}');
      @endif
    "
    class="flex h-screen bg-gray-100 relative"
  >
    <!-- Sidebar -->
    <!-- Sidebar -->
<div 
  x-data="{ sidebarOpen: false,
            toast: { show: false, type: '', message: '' },
            showToast(type, message) { 
              this.toast.type = type; 
              this.toast.message = message; 
              this.toast.show = true;
              setTimeout(() => { this.toast.show = false }, 3500);
            },
            closeToast() { this.toast.show = false }
          }" 
  x-init="
    @if(session('success'))
      showToast('success', '{{ addslashes(session('success')) }}');
    @elseif(session('error'))
      showToast('error', '{{ addslashes(session('error')) }}');
    @elseif(session('warning'))
      showToast('warning', '{{ addslashes(session('warning')) }}');
    @endif
  "
  class="fixed md:static z-30 inset-y-0 left-0 w-64 bg-gray-900 text-white transform md:translate-x-0 transition-transform duration-200 ease-in-out flex flex-col shadow-lg"
>
  <div class="px-6 py-5 flex items-center justify-between text-xl font-semibold tracking-wide bg-gray-950 md:bg-gray-900">
    {{ $siteSettings['site_name'] ?? 'Admin Panel' }}
    <button @click="sidebarOpen = false" class="md:hidden">
      <i class="fas fa-times text-gray-300 hover:text-white"></i>
    </button>
  </div>

  <nav class="flex-1 px-3 py-4 space-y-1 text-sm">
    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-800 transition">
      <i class="fas fa-tachometer-alt mr-3 w-5 text-gray-400"></i> Dashboard
    </a>
    <a href="{{ route('admin.settings') }}" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-800 transition">
      <i class="fas fa-cogs mr-3 w-5 text-gray-400"></i> Site Settings
    </a>
    <a href="{{ route('admin.homepage-sections.index') }}" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-800 transition">
      <i class="fas fa-file-alt mr-3 w-5 text-gray-400"></i> Homepage Sections
    </a>
    <a href="{{ route('admin.categories.index') }}" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-800 transition">
      <i class="fas fa-tags mr-3 w-5 text-gray-400"></i> Categories
    </a>
    <a href="{{ route('admin.items.index') }}" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-800 transition">
      <i class="fas fa-box-open mr-3 w-5 text-gray-400"></i> Items
    </a>
    <a href="{{ route('admin.blogs.index') }}" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-800 transition">
      <i class="fas fa-newspaper mr-3 w-5 text-gray-400"></i> Blog Posts
    </a>
    <a href="{{ route('admin.faqs.index') }}" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-800 transition">
      <i class="fas fa-question-circle mr-3 w-5 text-gray-400"></i> FAQs
    </a>
    <a href="{{ route('admin.static-pages.index') }}" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-800 transition">
      <i class="fas fa-book mr-3 w-5 text-gray-400"></i> Static Pages
    </a>
    <a href="{{ route('admin.testimonials.index') }}" class="flex items-center px-4 py-2 rounded-md hover:bg-gray-800 transition">
      <i class="fas fa-comment-dots mr-3 w-5 text-gray-400"></i> Testimonials
    </a>
  </nav>

  <div class="px-6 py-4 border-t border-gray-700 mt-auto">
    <!-- Green View Site Button -->
    <a href="{{ route('home') }}" target="_blank"
       class="w-full flex items-center justify-center px-4 py-2 rounded-md bg-green-600 hover:bg-green-700 transition text-white text-sm font-medium mb-2">
      <i class="fas fa-globe mr-2"></i> View Site
    </a>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit"
        class="w-full flex items-center justify-center px-4 py-2 rounded-md bg-red-600 hover:bg-red-700 transition text-white text-sm font-medium">
        <i class="fas fa-sign-out-alt mr-2"></i> Logout
      </button>
    </form>
  </div>
</div>


    
    <!-- Mobile dark overlay -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false"
         class="fixed inset-0 z-20 bg-black bg-opacity-40 md:hidden"></div>

    <!-- Content Wrapper -->
    <div class="flex-1 flex flex-col overflow-hidden min-w-0">
      <!-- Mobile Header -->
      <header class="bg-white shadow flex items-center justify-between px-4 py-3 md:hidden">
        <button @click="sidebarOpen = true" class="text-gray-600 hover:text-gray-900 focus:outline-none">
          <i class="fas fa-bars text-xl"></i>
        </button>
        <div class="text-lg font-bold text-gray-900">
          {{ $siteSettings['site_name'] ?? 'Admin Panel' }}
        </div>
      </header>
      
      <!-- Desktop Header -->
      <header class="hidden md:block bg-white shadow">
        <div class="max-w-7xl mx-auto py-5 px-6 lg:px-8">
          <h1 class="text-2xl md:text-3xl font-bold text-gray-900">@yield('title')</h1>
        </div>
      </header>

      <!-- Main Content -->
      <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-4 sm:p-6">
        @if ($errors->any())
          <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-md mb-6">
            <div class="font-semibold">Please fix the following errors:</div>
            <ul class="mt-2 list-disc list-inside text-sm text-red-600">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        @yield('content')
      </main>
    </div>

    <!-- Toast Notification (still global, styled better) -->
    <div
      x-show="toast.show"
      x-transition:enter="transform ease-out duration-300 transition"
      x-transition:enter-start="translate-y-8 opacity-0"
      x-transition:enter-end="translate-y-0 opacity-100"
      x-transition:leave="transform ease-in duration-300 transition"
      x-transition:leave-start="translate-y-0 opacity-100"
      x-transition:leave-end="translate-y-8 opacity-0"
      @keydown.escape.window="closeToast"
      class="fixed flex flex-col items-end space-y-2 z-50 bottom-6 right-6 max-w-sm w-full pointer-events-none px-2 md:px-0"
    >
      <!-- Success -->
      <template x-if="toast.type === 'success'">
        <div class="pointer-events-auto flex items-center shadow-xl rounded-lg bg-green-50 border border-green-200 px-5 py-4 gap-3 animate-bounce-in animate-premium">
          <span class="rounded-full bg-green-100 p-2">
            <svg class="h-6 w-6 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
          </span>
          <div class="flex-1 text-green-800 font-medium" x-text="toast.message"></div>
          <button @click="closeToast" class="ml-2 text-green-600 hover:text-green-900">
            <i class="fa fa-times"></i>
          </button>
        </div>
      </template>
      <!-- Error -->
      <template x-if="toast.type === 'error'">
        <div class="pointer-events-auto flex items-center shadow-xl rounded-lg bg-red-50 border border-red-200 px-5 py-4 gap-3 animate-bounce-in animate-premium">
          <span class="rounded-full bg-red-100 p-2">
            <svg class="h-6 w-6 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </span>
          <div class="flex-1 text-red-800 font-medium" x-text="toast.message"></div>
          <button @click="closeToast" class="ml-2 text-red-600 hover:text-red-900">
            <i class="fa fa-times"></i>
          </button>
        </div>
      </template>
      <!-- Warning -->
      <template x-if="toast.type === 'warning'">
        <div class="pointer-events-auto flex items-center shadow-xl rounded-lg bg-yellow-50 border border-yellow-200 px-5 py-4 gap-3 animate-bounce-in animate-premium">
          <span class="rounded-full bg-yellow-100 p-2">
            <svg class="h-6 w-6 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
          </span>
          <div class="flex-1 text-yellow-800 font-medium" x-text="toast.message"></div>
          <button @click="closeToast" class="ml-2 text-yellow-600 hover:text-yellow-900">
            <i class="fa fa-times"></i>
          </button>
        </div>
      </template>
    </div>
  </div>

  <!-- AlpineJS -->
  <script src="https://unpkg.com/alpinejs@3.13.0/dist/cdn.min.js" defer></script>

  <!-- Toast Animation -->
  <style>
    @keyframes bounce-in {
      0% { transform: scale(.9) translateY(40px); opacity: 0;}
      60% { transform: scale(1.05) translateY(-4px); opacity: 1;}
      100% { transform: scale(1) translateY(0); }
    }
    .animate-bounce-in {
      animation: bounce-in 0.5s cubic-bezier(0.68, -0.6, 0.32, 1.6);
    }
    .animate-premium {
      box-shadow: 0 8px 30px rgba(0,0,0,0.12);
      border-radius: 0.9rem;
    }
  </style>
</body>
</html>
