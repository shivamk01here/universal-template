<div class="space-y-6">
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Page Title</label>
        <input type="text" name="title" id="title" value="{{ old('title', $page->title ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
    </div>
    <div>
        <label for="content" class="block text-sm font-medium text-gray-700">Content (HTML is allowed)</label>
        <textarea name="content" id="content" rows="15" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('content', $page->content ?? '') }}</textarea>
        <p class="mt-2 text-sm text-gray-500">You can use HTML tags like `&lt;h2&gt;`, `&lt;p&gt;`, `&lt;ul&gt;`, `&lt;li&gt;` for formatting.</p>
    </div>
    <div>
        <label class="flex items-center">
            <input type="checkbox" name="is_published" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" @if(old('is_published', $page->is_published ?? 1) == 1) checked @endif>
            <span class="ml-2 text-sm text-gray-600">Published (Visible on site)</span>
        </label>
    </div>
</div>
<div class="mt-8 border-t border-gray-200 pt-5">
    <div class="flex justify-end">
        <a href="{{ route('admin.static-pages.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
        <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">Save Page</button>
    </div>
</div>