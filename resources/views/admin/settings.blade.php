@extends('layouts.admin')
@section('title', 'Site Settings')
@section('content')
<div class="bg-white p-8 rounded-lg shadow-md">
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <div class="space-y-6">
            <div>
                <label for="site_name" class="block text-sm font-medium text-gray-700">Site Name</label>
                <input type="text" name="site_name" id="site_name" value="{{ $settings['site_name'] ?? '' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div>
                <label for="site_logo_url" class="block text-sm font-medium text-gray-700">Site Logo URL</label>
                <input type="text" name="site_logo_url" id="site_logo_url" value="{{ $settings['site_logo_url'] ?? '' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
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
        </div>
        <div class="mt-8">
            <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">Save Settings</button>
        </div>
    </form>
</div>
@endsection