<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - {{ $siteSettings['site_name'] ?? config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <!-- Heroicons (for premium icons) -->
    <link rel="stylesheet" href="https://unpkg.com/@tabler/icons/iconfont/tabler-icons.min.css">
</head>
<body class="bg-gray-100">
    <div x-data="{ sidebarOpen: false, 
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
        <div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
             class="fixed md:static z-30 inset-y-0 left-0 w-64 bg-gray-800 text-white transform md:translate-x-0 transition-transform duration-200 ease-in-out flex flex-col">
            <div class="px-8 py-6 flex items-center justify-between text-2xl font-bold bg-gray-900 md:bg-gray-800">
                {{ $siteSettings['site_name'] ?? 'Admin Panel' }}
                <button @click="sidebarOpen = false" class="md:hidden">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <nav class="flex-1 px-4 py-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700"><i class="fas fa-tachometer-alt mr-3"></i> Dashboard</a>
                <a href="{{ route('admin.settings') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700"><i class="fas fa-cogs mr-3"></i> Site Settings</a>
                <a href="{{ route('admin.pages.index') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700"><i class="fas fa-file-alt mr-3"></i> Homepage Sections</a>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700"><i class="fas fa-tags mr-3"></i> Categories</a>
                <a href="{{ route('admin.items.index') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700"><i class="fas fa-box-open mr-3"></i> Items</a>
                <a href="{{ route('admin.blogs.index') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700"><i class="fas fa-newspaper mr-3"></i> Blog Posts</a>
                <a href="{{ route('admin.faqs.index') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700"><i class="fas fa-question-circle mr-3"></i> FAQs</a>
                <a href="{{ route('admin.static-pages.index') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700"><i class="fas fa-book mr-3"></i> Static Pages</a>
                <a href="{{ route('admin.testimonials.index') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700"><i class="fas fa-comment-dots mr-3"></i> Testimonials</a>
                <a href="{{ route('home') }}" target="_blank" class="flex items-center px-4 py-2 rounded hover:bg-gray-700"><i class="fas fa-globe mr-3"></i> View Site</a>
            </nav>
            <div class="px-8 py-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center px-4 py-2 rounded bg-red-500 hover:bg-red-600 transition">
                        <i class="fas fa-sign-out-alt mr-3"></i> Logout
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Overlay for mobile sidebar -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
             class="fixed inset-0 z-20 bg-black bg-opacity-30 md:hidden"></div>

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden min-w-0">
            <!-- Mobile header -->
            <header class="bg-white shadow flex items-center justify-between px-4 py-3 md:hidden">
                <button @click="sidebarOpen = true" class="text-gray-700 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <div class="text-2xl font-bold">
                    {{ $siteSettings['site_name'] ?? 'Admin Panel' }}
                </div>
            </header>
            <!-- Desktop header -->
            <header class="hidden md:block bg-white shadow">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900">@yield('title')</h1>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-4 sm:p-6">
                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        <div class="font-bold">Please fix the following errors:</div>
                        <ul class="mt-3 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')
            </main>
        </div>

        <!-- Toast Notification (global, premium style) -->
        <div
          x-show="toast.show"
          x-transition:enter="transform ease-out duration-300 transition"
          x-transition:enter-start="translate-y-8 opacity-0"
          x-transition:enter-end="translate-y-0 opacity-100"
          x-transition:leave="transform ease-in duration-300 transition"
          x-transition:leave-start="translate-y-0 opacity-100"
          x-transition:leave-end="translate-y-8 opacity-0"
          @keydown.escape.window="closeToast"
          class="fixed flex flex-col items-end md:items-end space-y-2 z-50 bottom-6 right-6 max-w-xs w-full pointer-events-none px-2 md:px-0">

          <template x-if="toast.type === 'success'">
              <div class="pointer-events-auto flex items-center shadow-lg rounded-lg bg-green-50 border border-green-200 px-5 py-4 gap-3 animate-bounce-in animate-premium">
                  <span class="rounded-full bg-green-100 p-2">
                    <svg class="h-6 w-6 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                  </span>
                  <div class="flex-1 text-green-800 font-semibold" x-text="toast.message"></div>
                  <button @click="closeToast" class="ml-2 text-green-600 hover:text-green-900">
                      <i class="fa fa-times"></i>
                  </button>
              </div>
          </template>
          <template x-if="toast.type === 'error'">
              <div class="pointer-events-auto flex items-center shadow-lg rounded-lg bg-red-50 border border-red-200 px-5 py-4 gap-3 animate-bounce-in animate-premium">
                  <span class="rounded-full bg-red-100 p-2">
                    <svg class="h-6 w-6 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                  </span>
                  <div class="flex-1 text-red-800 font-semibold" x-text="toast.message"></div>
                  <button @click="closeToast" class="ml-2 text-red-600 hover:text-red-900">
                      <i class="fa fa-times"></i>
                  </button>
              </div>
          </template>
          <template x-if="toast.type === 'warning'">
              <div class="pointer-events-auto flex items-center shadow-lg rounded-lg bg-yellow-50 border border-yellow-200 px-5 py-4 gap-3 animate-bounce-in animate-premium">
                  <span class="rounded-full bg-yellow-100 p-2">
                    <svg class="h-6 w-6 text-yellow-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                  </span>
                  <div class="flex-1 text-yellow-800 font-semibold" x-text="toast.message"></div>
                  <button @click="closeToast" class="ml-2 text-yellow-600 hover:text-yellow-900">
                      <i class="fa fa-times"></i>
                  </button>
              </div>
          </template>
        </div>
    </div>

    <!-- Alpine.js for sidebar & toast toggle -->
    <script src="https://unpkg.com/alpinejs@3.13.0/dist/cdn.min.js" defer></script>
    <!-- Optional Toast Animation (add in <head> or inline below) -->
    <style>
      @keyframes bounce-in {
        0% { transform: scale(.8) translateY(60px); opacity: 0;}
        60% { transform: scale(1.05) translateY(-6px); opacity: 1;}
        100% { transform: scale(1) translateY(0); }
      }
      .animate-bounce-in {
        animation: bounce-in 0.59s cubic-bezier(0.68, -0.6, 0.32, 1.6);
      }
      /* For a “premium” shadow and rounded feel */
      .animate-premium {
        box-shadow: 0 8px 32px rgba(32,41,101,0.2), 0 1.5px 4px rgba(30,41,59,.04);
        border-radius: 1.1rem;
      }
    </style>
</body>
</html>
