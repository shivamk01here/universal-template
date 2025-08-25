<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Section</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white p-5">
            <h1 class="text-2xl font-bold mb-10">Admin Panel</h1>
            <nav>
                <a href="{{ route('admin.dashboard') }}" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Dashboard</a>
                <a href="{{ route('admin.homepage.sections.index') }}" class="block py-2.5 px-4 rounded transition duration-200 bg-gray-700">Homepage Sections</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-10">
            <h2 class="text-3xl font-bold mb-6">Add New Homepage Section</h2>

            <div class="bg-white p-8 rounded-lg shadow-md">
                <form action="{{ route('admin.homepage.sections.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="section_slug" class="block text-sm font-medium text-gray-700 mb-1">Section Slug</label>
                            <input type="text" id="section_slug" name="section_slug" class="w-full p-2 border border-gray-300 rounded-md" placeholder="e.g. promo-banner" required>
                            <p class="text-xs text-gray-500 mt-1">A unique identifier (lowercase, no spaces, use hyphens). This determines the view folder.</p>
                        </div>
                        <div>
                            <label for="template_id" class="block text-sm font-medium text-gray-700 mb-1">Template ID</label>
                            <input type="text" id="template_id" name="template_id" class="w-full p-2 border border-gray-300 rounded-md" value="template-1" required>
                             <p class="text-xs text-gray-500 mt-1">The name of the blade file to use (e.g., template-1).</p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="content_json" class="block text-sm font-medium text-gray-700 mb-1">Content (JSON)</label>
                        <textarea id="content_json" name="content_json" rows="10" class="w-full p-2 border border-gray-300 rounded-md font-mono text-sm" required>{
    "heading": "New Section Title",
    "subheading": "A short description for the new section.",
    "bg_color": "#ffffff",
    "bg_image_url": ""
}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Define the initial data for the section here. Must be valid JSON.</p>
                    </div>

                    <div class="mt-8">
                        <button type="submit" class="bg-indigo-600 text-white font-semibold px-6 py-3 rounded-lg hover:bg-indigo-700 transition">Save New Section</button>
                        <a href="{{ route('admin.homepage.sections.index') }}" class="text-gray-600 ml-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
