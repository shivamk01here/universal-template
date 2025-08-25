@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-medium text-gray-900">Add New Section</h1>
                <p class="text-sm text-gray-600 mt-1">Create a new homepage section</p>
            </div>
            <a href="{{ route('admin.homepage-sections.index') }}" 
               class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 transition-colors text-sm">
                ← Back to Sections
            </a>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            @if ($errors->any())
                <div class="mb-6 p-4 border border-red-200 bg-red-50 rounded-md">
                    <h3 class="text-sm font-medium text-red-800 mb-2">Please fix the following errors:</h3>
                    <ul class="text-sm text-red-700 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.homepage-sections.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Section Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="section_slug" class="block text-sm font-medium text-gray-900 mb-2">
                            Section Slug *
                        </label>
                        <input type="text" 
                               id="section_slug" 
                               name="section_slug" 
                               value="{{ old('section_slug') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400"
                               placeholder="promo-banner"
                               required>
                        <p class="text-xs text-gray-500 mt-1">
                            Unique identifier (lowercase, hyphens only). Determines the view folder.
                        </p>
                    </div>

                    <div>
                        <label for="template_id" class="block text-sm font-medium text-gray-900 mb-2">
                            Template ID *
                        </label>
                        <input type="text" 
                               id="template_id" 
                               name="template_id" 
                               value="{{ old('template_id', 'template-1') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400"
                               placeholder="template-1"
                               required>
                        <p class="text-xs text-gray-500 mt-1">
                            Blade template file name to use for rendering.
                        </p>
                    </div>
                </div>

                <!-- Display Settings -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="display_order" class="block text-sm font-medium text-gray-900 mb-2">
                            Display Order
                        </label>
                        <input type="number" 
                               id="display_order" 
                               name="display_order" 
                               value="{{ old('display_order', 0) }}"
                               min="0"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400">
                        <p class="text-xs text-gray-500 mt-1">
                            Position on homepage (0 = first). Will auto-adjust if left empty.
                        </p>
                    </div>

                    <div class="flex items-center space-x-3 pt-6">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="hidden" name="is_visible" value="0">
                            <input type="checkbox" 
                                   name="is_visible" 
                                   value="1"
                                   class="sr-only toggle-checkbox" 
                                   {{ old('is_visible', '1') ? 'checked' : '' }}>
                            <div class="w-9 h-5 bg-gray-200 rounded-full toggle-bg transition-colors">
                                <div class="w-4 h-4 bg-white rounded-full shadow transform transition-transform toggle-dot"></div>
                            </div>
                            <span class="ml-3 text-sm font-medium text-gray-900">Visible on homepage</span>
                        </label>
                    </div>
                </div>

                <!-- Content JSON -->
                <div>
                    <label for="content_json" class="block text-sm font-medium text-gray-900 mb-2">
                        Section Content (JSON) *
                    </label>
                    <textarea id="content_json" 
                              name="content_json" 
                              rows="12" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400 font-mono text-sm"
                              required>{{ old('content_json', '{
    "heading": "New Section Title",
    "subheading": "A short description for the new section.",
    "bg_color": "#ffffff",
    "bg_image_url": "",
    "text_color": "#000000",
    "button_text": "Learn More",
    "button_url": "#"
}') }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">
                        Valid JSON data that will be passed to your template. Use proper JSON syntax.
                    </p>
                    <div id="json-error" class="text-xs text-red-600 mt-1 hidden"></div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <button type="button" 
                            id="validate-json"
                            class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 transition-colors text-sm">
                        Validate JSON
                    </button>
                    
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('admin.homepage-sections.index') }}" 
                           class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 transition-colors text-sm">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 bg-gray-900 text-white rounded-md hover:bg-gray-800 transition-colors text-sm font-medium">
                            Create Section
                        </button>
                    </div>
                </div>
            </form>
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
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const jsonTextarea = document.getElementById('content_json');
    const jsonError = document.getElementById('json-error');
    const validateButton = document.getElementById('validate-json');
    const form = jsonTextarea.closest('form');

    // JSON validation function
    function validateJSON() {
        const content = jsonTextarea.value.trim();
        
        if (!content) {
            showError('JSON content is required');
            return false;
        }

        try {
            JSON.parse(content);
            hideError();
            return true;
        } catch (error) {
            showError('Invalid JSON: ' + error.message);
            return false;
        }
    }

    function showError(message) {
        jsonError.textContent = message;
        jsonError.classList.remove('hidden');
        jsonTextarea.classList.add('border-red-300');
    }

    function hideError() {
        jsonError.classList.add('hidden');
        jsonTextarea.classList.remove('border-red-300');
    }

    // Validate JSON button
    validateButton.addEventListener('click', function() {
        if (validateJSON()) {
            // Show success feedback
            const originalText = this.textContent;
            this.textContent = 'Valid JSON ✓';
            this.classList.add('text-green-600', 'border-green-300');
            
            setTimeout(() => {
                this.textContent = originalText;
                this.classList.remove('text-green-600', 'border-green-300');
            }, 2000);
        }
    });

    // Validate on form submit
    form.addEventListener('submit', function(e) {
        if (!validateJSON()) {
            e.preventDefault();
            jsonTextarea.focus();
        }
    });

    // Auto-generate slug from section slug input
    const slugInput = document.getElementById('section_slug');
    slugInput.addEventListener('input', function() {
        // Clean up the slug as user types
        this.value = this.value
            .toLowerCase()
            .replace(/[^a-z0-9-]/g, '-')
            .replace(/-+/g, '-')
            .replace(/^-|-$/g, '');
    });

    // Format JSON on blur
    jsonTextarea.addEventListener('blur', function() {
        try {
            const parsed = JSON.parse(this.value);
            this.value = JSON.stringify(parsed, null, 4);
            hideError();
        } catch (error) {
            // Don't format if invalid JSON
        }
    });
});
</script>
@endsection
