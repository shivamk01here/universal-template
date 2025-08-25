@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-medium text-gray-900">
                    Edit Section: 
                    <span class="text-gray-600">{{ Str::title(str_replace('-', ' ', $section->section_slug ?? '')) }}</span>
                </h1>
                <p class="text-sm text-gray-600 mt-1">Modify section content and settings</p>
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

            <form action="{{ route('admin.homepage-sections.update', $section->id) }}" 
                  method="POST" 
                  id="sectionForm" 
                  class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Basic Settings -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="template_id" class="block text-sm font-medium text-gray-900 mb-2">
                            Template
                        </label>
                        <select id="template_id" 
                                name="template_id" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400">
                            <option value="template-1" {{ ($section->template_id ?? '') == 'template-1' ? 'selected' : '' }}>Template 1</option>
                            <option value="template-2" {{ ($section->template_id ?? '') == 'template-2' ? 'selected' : '' }}>Template 2</option>
                            <option value="template-3" {{ ($section->template_id ?? '') == 'template-3' ? 'selected' : '' }}>Template 3</option>
                            <option value="template-4" {{ ($section->template_id ?? '') == 'template-4' ? 'selected' : '' }}>Template 4</option>
                        </select>
                    </div>

                    <div class="flex flex-col justify-end">
                        <label class="block text-sm font-medium text-gray-900 mb-2">Visibility</label>
                        <div class="flex items-center space-x-3">
                            <span class="text-sm text-gray-600">Hidden</span>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="hidden" name="is_visible" value="0">
                                <input type="checkbox" 
                                       name="is_visible" 
                                       value="1"
                                       id="is_visible_toggle"
                                       class="sr-only toggle-checkbox" 
                                       {{ ($section->is_visible ?? false) ? 'checked' : '' }}>
                                <div class="w-9 h-5 bg-gray-200 rounded-full toggle-bg transition-colors">
                                    <div class="w-4 h-4 bg-white rounded-full shadow transform transition-transform toggle-dot"></div>
                                </div>
                            </label>
                            <span class="text-sm text-gray-600">Visible</span>
                        </div>
                    </div>
                </div>

                <!-- Dynamic Content Fields -->
                <div class="border-t pt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Content Settings</h3>
                    <div id="dynamicFields" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Fields will be generated here -->
                    </div>
                </div>

                <!-- Hidden field for JSON data -->
                <input type="hidden" name="content_json" id="content_json">

                <!-- Advanced JSON Editor -->
                <div class="border-t pt-6">
                    <button type="button" 
                            id="toggleAdvanced" 
                            class="text-sm text-gray-700 hover:text-gray-900 mb-4 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Advanced: Edit Raw JSON
                    </button>
                    
                    <div id="advancedEditor" class="hidden space-y-3">
                        <label for="raw_json" class="block text-sm font-medium text-gray-900">
                            Raw Content (JSON)
                        </label>
                        <p class="text-xs text-gray-600">
                            Edit JSON directly to add/remove fields. Ensure valid JSON syntax.
                        </p>
                        <textarea id="raw_json" 
                                  rows="12" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md font-mono text-sm bg-gray-50 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400"></textarea>
                        <div class="flex space-x-3">
                            <button type="button" 
                                    id="applyRawJson" 
                                    class="px-4 py-2 bg-gray-700 text-white rounded-md hover:bg-gray-800 transition-colors text-sm">
                                Apply Changes
                            </button>
                            <button type="button" 
                                    id="validateJson" 
                                    class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 transition-colors text-sm">
                                Validate JSON
                            </button>
                        </div>
                        <div id="jsonError" class="text-xs text-red-600 hidden"></div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <button type="button" 
                            id="previewChanges"
                            class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 transition-colors text-sm">
                        Preview Changes
                    </button>
                    
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('admin.homepage-sections.index') }}" 
                           class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 transition-colors text-sm">
                            Cancel
                        </a>
                        <button type="submit" 
                                class="px-6 py-2 bg-gray-900 text-white rounded-md hover:bg-gray-800 transition-colors text-sm font-medium">
                            Save Changes
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

<!-- JSON Data Script -->
<script type="application/json" id="section-data">
{!! json_encode($section->content_array ?? [], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get data from the JSON script tag - this prevents syntax errors
    let contentData;
    try {
        const jsonScript = document.getElementById('section-data');
        contentData = jsonScript ? JSON.parse(jsonScript.textContent) : {};
    } catch (e) {
        console.warn('Failed to parse content data:', e);
        contentData = {};
    }
    
    // Ensure contentData is an object
    if (!contentData || typeof contentData !== 'object') {
        contentData = {};
    }
    
    // Set initial raw JSON
    document.getElementById('raw_json').value = JSON.stringify(contentData, null, 4);
    
    // Field type detection
    const fieldConfig = {
        isColor: (key, value) => {
            return (key.toLowerCase().includes('color') || key.toLowerCase().includes('bg_color')) &&
                   typeof value === 'string' &&
                   (value.startsWith('#') || value.startsWith('rgb'));
        },
        isUrl: (key, value) => {
            return (key.toLowerCase().includes('url') || key.toLowerCase().includes('link')) &&
                   typeof value === 'string';
        },
        isTextarea: (key, value) => {
            return (key.toLowerCase().includes('description') || 
                   key.toLowerCase().includes('content') ||
                   key.toLowerCase().includes('text')) &&
                   typeof value === 'string' && value.length > 50;
        },
        isNumber: (key, value) => {
            return typeof value === 'number' || 
                   (key.toLowerCase().includes('order') || 
                    key.toLowerCase().includes('count') || 
                    key.toLowerCase().includes('size'));
        }
    };

    function generateLabel(key) {
        return key
            .replace(/_/g, ' ')
            .replace(/([A-Z])/g, ' $1')
            .split(' ')
            .map(word => word.charAt(0).toUpperCase() + word.slice(1))
            .join(' ')
            .trim();
    }

    function createField(key, value) {
        const label = generateLabel(key);
        const fieldId = `field_${key}`;
        let inputHtml = '';

        if (fieldConfig.isColor(key, value)) {
            inputHtml = `
                <div class="flex space-x-2">
                    <input type="color" 
                           id="${fieldId}" 
                           data-key="${key}" 
                           value="${value || '#000000'}"
                           class="w-12 h-9 border border-gray-300 rounded cursor-pointer">
                    <input type="text" 
                           id="${fieldId}_text" 
                           value="${value || ''}"
                           placeholder="#000000"
                           class="flex-1 px-3 py-2 border border-gray-300 rounded-md font-mono text-sm">
                </div>`;
        } else if (fieldConfig.isTextarea(key, value)) {
            inputHtml = `
                <textarea id="${fieldId}" 
                          data-key="${key}" 
                          rows="3"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400">${value || ''}</textarea>`;
        } else if (fieldConfig.isNumber(key, value)) {
            inputHtml = `
                <input type="number" 
                       id="${fieldId}" 
                       data-key="${key}" 
                       value="${value || ''}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400">`;
        } else {
            inputHtml = `
                <input type="text" 
                       id="${fieldId}" 
                       data-key="${key}" 
                       value="${value || ''}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-gray-400">`;
        }

        return `
            <div class="space-y-2">
                <label for="${fieldId}" class="block text-sm font-medium text-gray-900">
                    ${label}
                </label>
                ${inputHtml}
            </div>`;
    }

    function generateFields() {
        const container = document.getElementById('dynamicFields');
        let fieldsHtml = '';

        Object.entries(contentData).forEach(([key, value]) => {
            fieldsHtml += createField(key, value);
        });

        container.innerHTML = fieldsHtml;

        // Add color picker sync
        container.querySelectorAll('input[type="color"]').forEach(colorInput => {
            const textInput = document.getElementById(colorInput.id + '_text');
            
            colorInput.addEventListener('change', function() {
                if (textInput) textInput.value = this.value;
            });
            
            if (textInput) {
                textInput.addEventListener('input', function() {
                    if (this.value.match(/^#[0-9A-Fa-f]{6}$/)) {
                        colorInput.value = this.value;
                    }
                });
            }
        });
    }

    function collectFormData() {
        const formData = {};
        const fields = document.querySelectorAll('#dynamicFields input, #dynamicFields textarea');

        fields.forEach(field => {
            if (field.dataset.key) {
                let value = field.value;
                
                // Handle color inputs - use text input value
                if (field.type === 'color') {
                    const textInput = document.getElementById(field.id + '_text');
                    value = textInput ? textInput.value : value;
                }
                
                if (field.type === 'number' && value !== '') {
                    value = parseFloat(value);
                }
                
                formData[field.dataset.key] = value;
            }
        });

        return formData;
    }

    function updateHiddenJson() {
        const formData = collectFormData();
        document.getElementById('content_json').value = JSON.stringify(formData);
    }

    function showError(message) {
        const errorDiv = document.getElementById('jsonError');
        errorDiv.textContent = message;
        errorDiv.classList.remove('hidden');
    }

    function hideError() {
        document.getElementById('jsonError').classList.add('hidden');
    }

    // Initialize
    generateFields();

    // Form submission
    document.getElementById('sectionForm').addEventListener('submit', function(e) {
        updateHiddenJson();
    });

    // Advanced editor toggle
    document.getElementById('toggleAdvanced').addEventListener('click', function() {
        const editor = document.getElementById('advancedEditor');
        const isHidden = editor.classList.contains('hidden');
        
        editor.classList.toggle('hidden');
        this.innerHTML = isHidden 
            ? '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>Hide Advanced Editor'
            : '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>Advanced: Edit Raw JSON';
    });

    // Validate JSON
    document.getElementById('validateJson').addEventListener('click', function() {
        try {
            const rawJson = document.getElementById('raw_json').value;
            JSON.parse(rawJson);
            hideError();
            
            // Show success feedback
            const originalText = this.textContent;
            this.textContent = 'Valid JSON ✓';
            this.classList.add('text-green-700', 'border-green-300', 'bg-green-50');
            
            setTimeout(() => {
                this.textContent = originalText;
                this.classList.remove('text-green-700', 'border-green-300', 'bg-green-50');
            }, 2000);
        } catch (error) {
            showError('Invalid JSON: ' + error.message);
        }
    });

    // Apply raw JSON changes
    document.getElementById('applyRawJson').addEventListener('click', function() {
        try {
            const rawJson = document.getElementById('raw_json').value;
            const parsed = JSON.parse(rawJson);

            // Update contentData
            Object.keys(contentData).forEach(k => delete contentData[k]);
            Object.assign(contentData, parsed);

            generateFields();
            hideError();
            
            // Show success feedback
            const originalText = this.textContent;
            this.textContent = 'Applied ✓';
            this.classList.add('bg-green-700');
            
            setTimeout(() => {
                this.textContent = originalText;
                this.classList.remove('bg-green-700');
            }, 2000);
        } catch (error) {
            showError('Invalid JSON: ' + error.message);
        }
    });

    // Real-time JSON preview update
    document.getElementById('dynamicFields').addEventListener('input', function() {
        const formData = collectFormData();
        document.getElementById('raw_json').value = JSON.stringify(formData, null, 4);
    });

    // Preview changes (placeholder functionality)
    document.getElementById('previewChanges').addEventListener('click', function() {
        updateHiddenJson();
        alert('Preview functionality would show how the section looks with current changes.');
    });
});
</script>
@endsection
