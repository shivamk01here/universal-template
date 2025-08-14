<div class="space-y-6">
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Post Title</label>
        <input type="text" name="title" id="title" value="{{ old('title', $blog->title ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
    </div>
    <div>
        <label for="image_url" class="block text-sm font-medium text-gray-700">Image URL</label>
        <input type="text" name="image_url" id="image_url" value="{{ old('image_url', $blog->image_url ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
    </div>
    <div>
        <label for="content" class="block text-sm font-medium text-gray-700">Content (HTML allowed)</label>
        <textarea name="content" id="content" rows="15" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('content', $blog->content ?? '') }}</textarea>
    </div>
    <div>
        <label class="flex items-center">
            <input type="checkbox" name="is_published" value="1" class="rounded border-gray-300" @if(old('is_published', $blog->is_published ?? 1) == 1) checked @endif>
            <span class="ml-2 text-sm text-gray-600">Published</span>
        </label>
    </div>
</div>
<div class="mt-8 pt-5 border-t">
    <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">Save Post</button>
</div>