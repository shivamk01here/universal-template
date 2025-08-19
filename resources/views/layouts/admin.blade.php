<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - {{ $siteSettings['site_name'] ?? config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>
<body class="bg-gray-100">
    <div class="flex h-screen bg-gray-200">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white flex flex-col">
            <div class="px-8 py-6 text-2xl font-bold">{{ $siteSettings['site_name'] ?? 'Admin Panel' }}</div>
            <nav class="flex-1 px-4 py-4 space-y-2">
                <!-- Your existing nav items -->
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

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold text-gray-900">@yield('title')</h1>
                </div>
            </header>
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                
                {{-- Flash Error Messages --}}
                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 relative" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline ml-2">{{ session('error') }}</span>
                        <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove()">
                            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                            </svg>
                        </button>
                    </div>
                @endif

                {{-- Flash Success Messages --}}
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 relative" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline ml-2">{{ session('success') }}</span>
                        <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove()">
                            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/>
                            </svg>
                        </button>
                    </div>
                @endif

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

                {{-- Warning Messages --}}
                @if (session('warning'))
                    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-6" role="alert">
                        <strong class="font-bold">Warning!</strong>
                        <span class="block sm:inline ml-2">{{ session('warning') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    {{-- Add some JavaScript for better UX --}}
    <script>
        // Auto-hide success messages after 5 seconds
        setTimeout(function() {
            const successAlerts = document.querySelectorAll('.bg-green-100');
            successAlerts.forEach(function(alert) {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.remove();
                }, 500);
            });
        }, 5000);
    </script>
</body>
</html>
