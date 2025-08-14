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
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700"><i class="fas fa-tachometer-alt mr-3"></i> Dashboard</a>
                <a href="{{ route('admin.settings') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700"><i class="fas fa-cogs mr-3"></i> Site Settings</a>
                <a href="{{ route('admin.pages.index') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700"><i class="fas fa-file-alt mr-3"></i> Homepage Sections</a>
                <a href="{{ route('admin.static-pages.index') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700"><i class="fas fa-book mr-3"></i> Static Pages</a>
                <a href="{{ route('admin.testimonials.index') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700"><i class="fas fa-comment-dots mr-3"></i> Testimonials</a>
                <a href="{{ route('admin.items.index') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700"><i class="fas fa-box-open mr-3"></i> Items</a>
                <a href="{{ route('admin.blogs.index') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700"><i class="fas fa-newspaper mr-3"></i> Blog Posts</a>
                <a href="{{ route('admin.faqs.index') }}" class="flex items-center px-4 py-2 rounded hover:bg-gray-700"><i class="fas fa-question-circle mr-3"></i> FAQs</a>
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
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>