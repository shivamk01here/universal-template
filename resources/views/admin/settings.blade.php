@extends('layouts.admin')
@section('title', 'Site Settings')
@section('content')
<div class="bg-white p-8 rounded-lg shadow-md">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-5">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="space-y-6">
            <div>
                <label for="site_name" class="block text-sm font-medium text-gray-700">Site Name</label>
                <input type="text" name="site_name" id="site_name" value="{{ $settings['site_name'] ?? '' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>

            <div>
                <label for="site_logo_url" class="block text-sm font-medium text-gray-700">Site Logo</label>
                <input type="file" name="site_logo_url" id="site_logo_url" accept="image/*"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                       onchange="showLogoPreview(event)">
                <div class="mt-2 flex items-center gap-3">
                    <img id="logo-preview"
                        src="@if(!empty($settings['site_logo_url']))/{{ $settings['site_logo_url'] }}@endif"
                        style="@if(empty($settings['site_logo_url']))display:none;@endif max-width:90px; max-height:60px; border-radius:8px; border: 1px solid #e5e7eb;">
                    @if(!empty($settings['site_logo_url']))
                        <span class="text-xs text-gray-500 break-all">Current: /{{ $settings['site_logo_url'] }}</span>
                    @endif
                </div>
            </div>

            <div>
                <label for="contact_email" class="block text-sm font-medium text-gray-700">Contact Email</label>
                <input type="email" name="contact_email" id="contact_email" value="{{ $settings['contact_email'] ?? '' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label for="contact_phone" class="block text-sm font-medium text-gray-700">Contact Phone</label>
                <input type="text" name="contact_phone" id="contact_phone" value="{{ $settings['contact_phone'] ?? '' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label for="footer_about_us" class="block text-sm font-medium text-gray-700">Footer About Us Text</label>
                <textarea name="footer_about_us" id="footer_about_us" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ $settings['footer_about_us'] ?? '' }}</textarea>
            </div>
            <div>
                <label for="footer_copyright" class="block text-sm font-medium text-gray-700">Footer Copyright Text</label>
                <input type="text" name="footer_copyright" id="footer_copyright" value="{{ $settings['footer_copyright'] ?? '' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="primary_color" class="block text-sm font-medium text-gray-700">Primary Color</label>
                    <input type="color" name="primary_color" id="primary_color" value="{{ $settings['primary_color'] ?? '#3485fd' }}" class="mt-1 w-16 h-10 border border-gray-300 rounded overflow-hidden">
                    <input type="text" name="primary_color_code" value="{{ $settings['primary_color'] ?? '#3485fd' }}" class="ml-2 w-28 rounded border-gray-300 shadow-sm" placeholder="#3485fd">
                </div>
                <div>
                    <label for="secondary_color" class="block text-sm font-medium text-gray-700">Secondary Color</label>
                    <input type="color" name="secondary_color" id="secondary_color" value="{{ $settings['secondary_color'] ?? '#13c7a7' }}" class="mt-1 w-16 h-10 border border-gray-300 rounded overflow-hidden">
                    <input type="text" name="secondary_color_code" value="{{ $settings['secondary_color'] ?? '#13c7a7' }}" class="ml-2 w-28 rounded border-gray-300 shadow-sm" placeholder="#13c7a7">
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="button_color" class="block text-sm font-medium text-gray-700">Button Color</label>
                    <input type="color" name="button_color" id="button_color" value="{{ $settings['button_color'] ?? '#5971f6' }}" class="mt-1 w-16 h-10 border border-gray-300 rounded overflow-hidden">
                    <input type="text" name="button_color_code" value="{{ $settings['button_color'] ?? '#5971f6' }}" class="ml-2 w-28 rounded border-gray-300 shadow-sm" placeholder="#5971f6">
                </div>
                <div>
                    <label for="background_color" class="block text-sm font-medium text-gray-700">Background Color</label>
                    <input type="color" name="background_color" id="background_color" value="{{ $settings['background_color'] ?? '#ffffff' }}" class="mt-1 w-16 h-10 border border-gray-300 rounded overflow-hidden">
                    <input type="text" name="background_color_code" value="{{ $settings['background_color'] ?? '#ffffff' }}" class="ml-2 w-28 rounded border-gray-300 shadow-sm" placeholder="#ffffff">
                </div>
            </div>
            <div>
                <label for="custom_css" class="block text-sm font-medium text-gray-700">Advanced CSS / Custom Style</label>
                <textarea name="custom_css" id="custom_css" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ $settings['custom_css'] ?? '' }}</textarea>
            </div>
        </div>
        <div class="mt-8">
            <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">Save Settings</button>
        </div>
    </form>
</div>
<script>
function showLogoPreview(event) {
    const input = event.target;
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('logo-preview');
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
document.addEventListener('DOMContentLoaded', function(){
    ['primary', 'secondary', 'button', 'background'].forEach(function(type){
        let colorInput = document.getElementById(type + '_color');
        let codeInput  = document.querySelector('input[name="'+type+'_color_code"]');
        if(colorInput && codeInput){
            colorInput.oninput = function(){ codeInput.value = colorInput.value; }
            codeInput.oninput  = function(){ colorInput.value = codeInput.value; }
        }
    });
});
</script>
@endsection