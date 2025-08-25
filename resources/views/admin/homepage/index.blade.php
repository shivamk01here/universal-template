<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manage Homepage Sections</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <style>
        .toggle-checkbox:checked { background-color: #4ade80; }
        .toggle-checkbox:checked + .toggle-label { left: 1.75rem; }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        @include('admin.partials.sidebar')
        <div class="flex-1 p-10 overflow-y-auto">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold">Homepage Sections</h2>
                <a href="{{ route('admin.homepage-sections.create') }}" class="bg-green-500 text-white px-5 py-2 rounded-lg hover:bg-green-600 transition font-semibold">+ Add New Section</a>
            </div>
            @include('admin.partials.session-messages')
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p class="text-gray-600 mb-4">Drag and drop to reorder. Use the toggle to show/hide a section on the live site.</p>
                <ul id="sections-list" class="space-y-3">
                    @foreach($sections as $section)
                        <li data-id="{{ $section->id }}" class="flex justify-between items-center p-4 bg-gray-50 border rounded-lg">
                            <div class="flex items-center">
                                <span class="text-lg font-bold text-gray-400 mr-4">{{ $section->display_order + 1 }}.</span>
                                <svg class="w-5 h-5 text-gray-400 mr-3 cursor-grab" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                                <span class="font-semibold text-gray-700">{{ Str::title(str_replace('-', ' ', $section->section_slug)) }}</span>
                                <span class="ml-2 text-sm text-gray-500"> ({{ $section->template_id }})</span>
                            </div>
                            <div class="flex items-center space-x-4">
                                <!-- Toggle Switch -->
                                <div class="relative inline-block w-14 mr-2 align-middle select-none transition duration-200 ease-in">
                                    <input type="checkbox" name="toggle" id="toggle-{{$section->id}}" data-id="{{$section->id}}" class="toggle-checkbox absolute block w-7 h-7 rounded-full bg-white border-4 appearance-none cursor-pointer" {{ $section->is_visible ? 'checked' : '' }}/>
                                    <label for="toggle-{{$section->id}}" class="toggle-label block overflow-hidden h-7 rounded-full bg-gray-300 cursor-pointer"></label>
                                </div>
                                <a href="{{ route('admin.homepage-sections.edit', $section->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">Edit</a>
                                <form action="{{ route('admin.homepage-sections.destroy', $section->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition">Delete</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Drag and Drop Sorting
        new Sortable(document.getElementById('sections-list'), {
            animation: 150,
            onEnd: function (evt) {
                const order = Array.from(evt.from.children).map(el => el.dataset.id);
                // ** THIS IS THE FIX: Using the new, unambiguous route name **
                fetch('{{ route("admin.homepage-sections.reorder") }}', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken},
                    body: JSON.stringify({ order: order })
                }).then(() => location.reload());
            }
        });

        // Visibility Toggle
        document.querySelectorAll('.toggle-checkbox').forEach(toggle => {
            toggle.addEventListener('change', function() {
                const sectionId = this.dataset.id;
                // ** THIS IS THE FIX: Using the new, unambiguous route name **
                const url = '{{ route("admin.homepage-sections.visibility", ["id" => ":id"]) }}'.replace(':id', sectionId);
                fetch(url, {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken}
                });
            });
        });
    </script>
</body>
</html>
