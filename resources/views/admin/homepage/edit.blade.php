<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Section</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Simple toggle switch styling for visibility */
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 48px;
            height: 28px;
        }
        .toggle-switch input { display: none; }
        .slider {
            position: absolute;
            cursor: pointer;
            background-color: #ccc;
            border-radius: 14px;
            top: 0; left: 0; right: 0; bottom: 0;
            transition: 0.4s;
        }
        .slider::before {
            position: absolute;
            content: "";
            height: 20px; width: 20px;
            left: 4px; bottom: 4px;
            background: white;
            border-radius: 50%;
            transition: 0.4s;
        }
        input:checked + .slider {
            background-color: #4f46e5;
        }
        input:checked + .slider::before {
            transform: translateX(20px);
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        @include('admin.partials.sidebar')
        <div class="flex-1 p-10">
            <h2 class="text-3xl font-bold mb-6">
                Edit Section:
                <span class="text-indigo-600">
                    {{ Str::title(str_replace('-', ' ', $section->section_slug)) }}
                </span>
            </h2>

            <div class="bg-white p-8 rounded-lg shadow-md">
                <form action="{{ route('admin.homepage-sections.update', $section->id) }}" method="POST" id="sectionForm">
                    @csrf
                    @method('PUT')

                    <!-- General Settings -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="template_id" class="block text-sm font-medium text-gray-700 mb-1">Template</label>
                            <select id="template_id" name="template_id" class="w-full p-2 border border-gray-300 rounded-md">
                                <option value="template-1" {{ $section->template_id == "template-1" ? 'selected' : '' }}>Template 1</option>
                                <option value="template-2" {{ $section->template_id == "template-2" ? 'selected' : '' }}>Template 2</option>
                                <option value="template-3" {{ $section->template_id == "template-3" ? 'selected' : '' }}>Template 3</option>
                                <option value="template-4" {{ $section->template_id == "template-4" ? 'selected' : '' }}>Template 4</option>
                            </select>
                        </div>
                        <div class="flex flex-col justify-end">
                            <label for="is_visible_toggle" class="block text-sm font-medium text-gray-700 mb-1">Visibility</label>
                            <div class="flex items-center space-x-3 mt-1">
                                <span class="text-xs text-gray-600">Hidden</span>
                                <label class="toggle-switch">
                                    <input
                                        type="checkbox"
                                        id="is_visible_toggle"
                                        {{ $section->is_visible ? 'checked' : '' }}>
                                    <span class="slider"></span>
                                </label>
                                <span class="text-xs text-gray-600">Visible</span>
                            </div>
                            <input type="hidden" id="is_visible" name="is_visible" value="{{ $section->is_visible ? 1 : 0 }}">
                        </div>
                    </div>

                    <!-- Dynamic Content Fields -->
                    <div class="mt-6 border-t pt-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Content Settings</h3>
                        <div id="dynamicFields" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Fields will be generated here -->
                        </div>
                    </div>

                    <!-- Hidden field to store the final JSON -->
                    <input type="hidden" name="content_json" id="content_json">

                    <!-- Advanced JSON Editor (collapsible) -->
                    <div class="mt-8 border-t pt-6">
                        <button type="button" id="toggleAdvanced" class="text-sm text-gray-600 hover:text-gray-800 mb-2">
                            🔧 Advanced: Edit Raw JSON
                        </button>
                        <div id="advancedEditor" class="hidden">
                            <label for="raw_json" class="block text-sm font-bold text-gray-800 mb-2">Raw Content (JSON)</label>
                            <p class="text-xs text-gray-500 mb-2">Use this to add/remove/edit any field. Be careful to use valid JSON.</p>
                            <textarea id="raw_json" rows="10" class="w-full p-3 border border-gray-300 rounded-md font-mono text-sm bg-gray-50">{{ json_encode($section->content_array, JSON_PRETTY_PRINT) }}</textarea>
                            <button type="button" id="applyRawJson" class="mt-2 bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">Apply Raw JSON</button>
                        </div>
                    </div>

                    <div class="mt-8">
                        <button type="submit" class="bg-indigo-600 text-white font-semibold px-6 py-3 rounded-lg hover:bg-indigo-700 transition">Save Changes</button>
                        <a href="{{ route('admin.homepage-sections.index') }}" class="text-gray-600 ml-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Initial content data
        const contentData = @json($section->content_array);

        // Field type detection and configuration
        const fieldConfig = {
            isColor: (key, value) => {
                return (key.includes('color') || key.includes('bg_color')) &&
                    typeof value === 'string' &&
                    (value.startsWith('#') || value.startsWith('rgb'));
            },
            isUrl: (key, value) => {
                return (key.includes('url') || key.includes('link')) &&
                    typeof value === 'string';
            },
            isTextarea: (key, value) => {
                return (key.includes('description') || key.includes('content') ||
                    (typeof value === 'string' && value.length > 100));
            },
            isText: (key, value) => {
                return typeof value === 'string';
            },
            isNumber: (key, value) => {
                return typeof value === 'number';
            }
        };

        function generateLabel(key) {
            return key
                .replace(/_/g, ' ')
                .replace(/([A-Z])/g, ' $1')
                .replace(/^./, str => str.toUpperCase())
                .trim();
        }

        function createField(key, value) {
            const label = generateLabel(key);
            const fieldId = `field_${key}`;

            let inputHtml = '';
            if (fieldConfig.isColor(key, value)) {
                inputHtml = `
                    <div class="flex gap-2">
                        <input type="color" id="${fieldId}" data-key="${key}" value="${value || '#000000'}"
                               class="w-16 h-10 border border-gray-300 rounded cursor-pointer">
                        <input type="text" id="${fieldId}_text" value="${value || ''}"
                               class="flex-1 p-2 border border-gray-300 rounded-md font-mono text-sm"
                               onchange="document.getElementById('${fieldId}').value = this.value">
                    </div>`;
            } else if (fieldConfig.isUrl(key, value)) {
                // Now plain text input, not url
                inputHtml = `
                    <input type="text" id="${fieldId}" data-key="${key}" value="${value || ''}"
                           placeholder="https://example.com"
                           class="w-full p-2 border border-gray-300 rounded-md">`;
            } else if (fieldConfig.isTextarea(key, value)) {
                inputHtml = `
                    <textarea id="${fieldId}" data-key="${key}" rows="3"
                              class="w-full p-2 border border-gray-300 rounded-md">${value || ''}</textarea>`;
            } else if (fieldConfig.isNumber(key, value)) {
                inputHtml = `
                    <input type="number" id="${fieldId}" data-key="${key}" value="${value || ''}"
                           class="w-full p-2 border border-gray-300 rounded-md">`;
            } else {
                inputHtml = `
                    <input type="text" id="${fieldId}" data-key="${key}" value="${value || ''}"
                           class="w-full p-2 border border-gray-300 rounded-md">`;
            }

            return `
                <div class="space-y-2">
                    <label for="${fieldId}" class="block text-sm font-medium text-gray-700">
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

            // Add event listeners for color pickers
            container.querySelectorAll('input[type="color"]').forEach(colorInput => {
                colorInput.addEventListener('change', function () {
                    const textInput = document.getElementById(this.id + '_text');
                    if (textInput) {
                        textInput.value = this.value;
                    }
                });
            });
        }

        function collectFormData() {
            const formData = {};
            const fields = document.querySelectorAll('#dynamicFields input, #dynamicFields textarea');

            fields.forEach(field => {
                if (field.dataset.key) {
                    let value = field.value;
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

        // Visibility toggle logic
        document.addEventListener('DOMContentLoaded', function () {
            generateFields();

            // Toggle for visibility
            const isVisibleToggle = document.getElementById('is_visible_toggle');
            const isVisibleInput = document.getElementById('is_visible');
            isVisibleToggle.addEventListener('change', function () {
                isVisibleInput.value = this.checked ? 1 : 0;
            });

            // Update hidden field before form submission
            document.getElementById('sectionForm').addEventListener('submit', function (e) {
                updateHiddenJson();
            });

            // Advanced editor toggle
            document.getElementById('toggleAdvanced').addEventListener('click', function () {
                const editor = document.getElementById('advancedEditor');
                editor.classList.toggle('hidden');
                this.textContent = editor.classList.contains('hidden')
                    ? '🔧 Advanced: Edit Raw JSON'
                    : '🔼 Hide Advanced Editor';
            });

            // Apply raw JSON changes
            document.getElementById('applyRawJson').addEventListener('click', function () {
                try {
                    const rawJson = document.getElementById('raw_json').value;
                    const parsed = JSON.parse(rawJson);

                    // Update contentData for creation of new fields, too
                    Object.keys(contentData).forEach(k => delete contentData[k]);
                    Object.assign(contentData, parsed);

                    generateFields();
                    alert('Raw JSON applied successfully!');
                } catch (error) {
                    alert('Invalid JSON: ' + error.message);
                }
            });

            // Real-time JSON preview update
            document.getElementById('dynamicFields').addEventListener('input', function () {
                const formData = collectFormData();
                document.getElementById('raw_json').value = JSON.stringify(formData, null, 2);
            });
        });
    </script>
</body>
</html>
