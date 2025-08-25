@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-medium text-gray-900">Homepage Sections</h1>
            <a href="{{ route('admin.homepage-sections.create') }}" 
               class="px-4 py-2 bg-gray-900 text-white rounded-md hover:bg-gray-800 transition-colors text-sm">
                Add Section
            </a>
        </div>

        <!-- Main Content -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <p class="text-gray-600 text-sm mb-6">
                Drag to reorder sections. Toggle visibility with the switch.
            </p>
            
            <ul id="sections-list" class="space-y-2">
                @forelse($sections ?? [] as $section)
                    <li data-id="{{ $section->id }}" 
                        class="flex items-center justify-between p-4 border border-gray-100 rounded-md hover:border-gray-200 transition-colors">
                        
                        <!-- Left Side -->
                        <div class="flex items-center space-x-3">
                            <!-- Drag Handle -->
                            <svg class="w-4 h-4 text-gray-400 cursor-grab hover:text-gray-600" 
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M4 8h16M4 16h16"/>
                            </svg>
                            
                            <!-- Order Number -->
                            <span class="text-sm font-medium text-gray-400 w-6">
                                {{ $loop->iteration }}.
                            </span>
                            
                            <!-- Section Info -->
                            <div>
                                <span class="font-medium text-gray-900">
                                    {{ Str::title(str_replace('-', ' ', $section->section_slug)) }}
                                </span>
                                @if($section->template_id)
                                    <span class="ml-2 text-xs text-gray-500">
                                        ({{ $section->template_id }})
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Right Side -->
                        <div class="flex items-center space-x-3">
                            <!-- Visibility Toggle -->
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" 
                                       class="sr-only toggle-checkbox" 
                                       data-id="{{ $section->id }}"
                                       {{ ($section->is_visible ?? false) ? 'checked' : '' }}>
                                <div class="w-9 h-5 bg-gray-200 rounded-full toggle-bg transition-colors">
                                    <div class="w-4 h-4 bg-white rounded-full shadow transform transition-transform toggle-dot"></div>
                                </div>
                            </label>
                            
                            <!-- Actions -->
                            <a href="{{ route('admin.homepage-sections.edit', $section->id) }}" 
                               class="px-3 py-1 text-sm text-gray-700 border border-gray-300 rounded hover:bg-gray-50 transition-colors">
                                Edit
                            </a>
                            
                            <form action="{{ route('admin.homepage-sections.destroy', $section->id) }}" 
                                  method="POST" 
                                  class="inline"
                                  onsubmit="return confirm('Delete this section?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="px-3 py-1 text-sm text-red-600 border border-red-300 rounded hover:bg-red-50 transition-colors">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </li>
                @empty
                    <li class="text-center py-8 text-gray-500">
                        No sections found. <a href="{{ route('admin.homepage-sections.create') }}" class="text-gray-900 underline">Create one</a>
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</div>

<style>
.toggle-checkbox:checked + .toggle-bg {
    background-color: #374151;
}
.toggle-checkbox:checked + .toggle-bg .toggle-dot {
    transform: translateX(1rem);
}
.sortable-ghost {
    opacity: 0.5;
    background: #f9fafb;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    if (!csrfToken) {
        console.error('CSRF token not found');
        return;
    }

    // Initialize sortable
    const sectionsList = document.getElementById('sections-list');
    if (sectionsList) {
        new Sortable(sectionsList, {
            animation: 150,
            ghostClass: 'sortable-ghost',
            onEnd: function(evt) {
                const order = Array.from(evt.from.children)
                    .map(el => el.dataset.id)
                    .filter(id => id); // Remove undefined values

                if (order.length === 0) return;

                fetch('{{ route("admin.homepage-sections.reorder") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ order: order })
                })
                .then(response => {
                    if (!response.ok) throw new Error('Reorder failed');
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Update order numbers
                        document.querySelectorAll('#sections-list li span').forEach((span, index) => {
                            if (span.textContent.includes('.')) {
                                span.textContent = `${index + 1}.`;
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    location.reload(); // Fallback: reload page
                });
            }
        });
    }

    // Handle visibility toggles
    document.querySelectorAll('.toggle-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const sectionId = this.dataset.id;
            if (!sectionId) return;

            const url = '{{ route("admin.homepage-sections.visibility", ":id") }}'.replace(':id', sectionId);
            
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .catch(error => {
                console.error('Error updating visibility:', error);
                // Revert checkbox state on error
                this.checked = !this.checked;
            });
        });
    });
});
</script>
@endsection
