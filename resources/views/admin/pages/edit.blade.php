@extends('layouts.admin')

@section('title', 'Edit Homepage Section')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-md">
    <form action="{{ route('admin.pages.update', $section->id) }}" method="POST">
        @csrf
        <div class="space-y-6">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Section Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $section->title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <div>
                <label for="subtitle" class="block text-sm font-medium text-gray-700">Subtitle / Main Text</label>
                <textarea name="subtitle" id="subtitle" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('subtitle', $section->subtitle) }}</textarea>
            </div>
             <div>
                <label for="image_url" class="block text-sm font-medium text-gray-700">Background Image URL (for Hero section)</label>
                <input type="text" name="image_url" id="image_url" value="{{ old('image_url', $section->image_url) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <div>
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" @if(old('is_active', $section->is_active) == 1) checked @endif>
                    <span class="ml-2 text-sm text-gray-600">Active (Show this section on homepage)</span>
                </label>
            </div>
        </div>
        <div class="mt-8">
            <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">Save Changes</button>
            <a href="{{ route('admin.pages.index') }}" class="ml-4 text-gray-600">Cancel</a>
        </div>
    </form>
</div>
@endsection