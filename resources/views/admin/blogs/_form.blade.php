<div class="space-y-6">
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700">Post Title</label>
        <input type="text" name="title" id="title"
            value="{{ old('title', $blog->title ?? '') }}" required
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
    </div>
    <div>
        <label for="image" class="block text-sm font-medium text-gray-700">Blog Image</label>
        <input
            type="file"
            name="image"
            id="image"
            accept="image/*"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
            onchange="showImagePreview(event)">
        <div class="mt-2 flex flex-col space-y-1">
            <img
                id="image-preview"
                src="@if(old('image')){{ asset('storage/blogs/' . old('image')) }}@elseif(isset($blog) && $blog->image){{ asset('storage/blogs/' . $blog->image) }}@endif"
                alt="Image Preview"
                style="@if(empty(old('image')) && (!isset($blog) || empty($blog->image)))display:none;@endif max-width:180px; max-height:120px; border-radius:8px; border: 1px solid #e5e7eb;"
            />
            @if(isset($blog) && $blog->image)
                <span class="text-xs text-gray-600 break-all">Current: {{ $blog->image }}</span>
            @endif
        </div>
    </div>
    <div>
        <label for="content" class="block text-sm font-medium text-gray-700">Content (HTML allowed)</label>
        <textarea
            name="content"
            id="content"
            rows="15"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
        >{{ old('content', $blog->content ?? '') }}</textarea>
    </div>
    <div>
        <label class="flex items-center">
            <input type="checkbox" name="is_published" value="1"
                class="rounded border-gray-300"
                @if(old('is_published', $blog->is_published ?? 1) == 1) checked @endif>
            <span class="ml-2 text-sm text-gray-600">Published</span>
        </label>
    </div>
</div>
<div class="mt-8 pt-5 border-t">
    <button type="submit"
        class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">Save Post</button>
</div>
<script>
function showImagePreview(event) {
    const input = event.target;
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('image-preview');
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files);
    }
}
</script>