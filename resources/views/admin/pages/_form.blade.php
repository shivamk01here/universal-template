@php
    $editing = isset($section) && $section;
@endphp
<input type="hidden" name="section_type" value="{{ old('section_type', $section->section_type ?? 'custom-html') }}">
<div class="space-y-6">
    <div>
        <label class="block font-semibold mb-1">Title</label>
        <input type="text" name="title" value="{{ old('title', $section->title ?? '') }}" required class="w-full rounded border-gray-300">
    </div>
    @if($editing && $section->section_type !== 'custom-html')
        <div>
            <label class="block font-semibold mb-1">Subtitle</label>
            <input type="text" name="subtitle" value="{{ old('subtitle', $section->subtitle ?? '') }}" class="w-full rounded border-gray-300">
        </div>
    @else
        <div>
            <label class="block font-semibold mb-1">Section Slug <span class="text-xs text-gray-500">(unique, e.g. 'my-custom-section')</span></label>
            <input type="text" name="section_slug" value="{{ old('section_slug', $section->section_slug ?? '') }}" {{ $editing ? 'readonly' : 'required' }} class="w-full rounded border-gray-300">
        </div>
        <div>
            <label class="block font-semibold mb-1">HTML Content</label>
            <textarea name="content" rows="10" class="w-full rounded border-gray-300">{{ old('content', $section->content ?? '') }}</textarea>
        </div>
    @endif
    <div>
        <label class="block font-semibold mb-1">Section Image</label>
        @if($editing && $section->image)
            <img src="{{ asset('storage/'.$section->image) }}" class="rounded mb-2 h-32 w-auto object-contain bg-gray-100" />
        @endif
        <input type="file" name="image" accept="image/*" class="mt-2">
    </div>
    <div>
        <label class="block font-semibold mb-1">Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $section->sort_order ?? '10') }}" required min="1" class="w-full rounded border-gray-300">
    </div>
    <div>
        <label class="inline-flex items-center">
            <input type="checkbox" name="is_active" value="1" @if(old('is_active', $section->is_active ?? 1) == 1) checked @endif class="mr-2"> Active
        </label>
    </div>
</div>
<button type="submit" class="mt-6 px-6 py-2 rounded bg-green-600 hover:bg-green-700 text-white font-bold shadow">Save Section</button>
