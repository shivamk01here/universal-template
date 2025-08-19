<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="md:col-span-2 space-y-6">
        <!-- Main Details -->
        <div class="bg-gray-50 p-4 rounded-lg border">
            <h3 class="font-bold text-lg mb-2">Main Details</h3>
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $item->name ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="mt-4">
                <label for="description" class="block text-sm font-medium text-gray-700">Full Description</label>
                <textarea name="description" id="description" rows="5" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('description', $item->description ?? '') }}</textarea>
            </div>
            <div class="mt-4">
                <label for="short_description" class="block text-sm font-medium text-gray-700">Short Description</label>
                <textarea name="short_description" id="short_description" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('short_description', $item->short_description ?? '') }}</textarea>
            </div>
        </div>
        <!-- Attributes -->
        <div class="bg-gray-50 p-4 rounded-lg border">
            <h3 class="font-bold text-lg mb-2">Custom Attributes</h3>
            <div class="space-y-4">
                @foreach($attributes as $attribute)
                <div>
                    <label for="attribute-{{$attribute->id}}" class="block text-sm font-medium text-gray-700">{{ $attribute->name }}</label>
                    <input type="text" name="attributes[{{$attribute->id}}]" id="attribute-{{$attribute->id}}" value="{{ old('attributes.'.$attribute->id, $item->attributes[$attribute->id] ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="space-y-6">
        <!-- Organization -->
        <div class="bg-gray-50 p-4 rounded-lg border">
            <h3 class="font-bold text-lg mb-2">Organization</h3>
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category_id" id="category_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if(isset($item) && $item->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-4">
                <label for="item_type" class="block text-sm font-medium text-gray-700">Item Type</label>
                <select name="item_type" id="item_type" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="SERVICE" @if(isset($item) && $item->item_type == 'SERVICE') selected @endif>Service</option>
                    <option value="PRODUCT" @if(isset($item) && $item->item_type == 'PRODUCT') selected @endif>Product</option>
                </select>
            </div>
        </div>
        <!-- Pricing & Status -->
        <div class="bg-gray-50 p-4 rounded-lg border">
            <h3 class="font-bold text-lg mb-2">Pricing & Status</h3>
            <div>
                <label for="base_price" class="block text-sm font-medium text-gray-700">Base Price (₹)</label>
                <input type="number" step="0.01" name="base_price" id="base_price" value="{{ old('base_price', $item->base_price ?? '0.00') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="bg-gray-50 p-4 rounded-lg border mt-4">
                <h3 class="font-bold text-lg mb-2">Images</h3>
                <p class="text-sm text-gray-500 mb-4">Upload one or more images. The first image will be the primary one.</p>
                <input type="file" name="images[]" multiple class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"/>
            </div>
            <!-- Existing Images Preview -->
            @if(isset($item) && count($item->images) > 0)
            <div class="bg-gray-50 p-4 rounded-lg border mt-4">
                <h3 class="font-bold text-lg mb-2">Current Images</h3>
                <div id="image-preview-container" class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-4">
                    @foreach($item->images as $image)
                    <div id="image-{{ $image->id }}" class="relative">
                        <img src="{{ asset($image->image_url) }}" class="w-full h-24 object-cover rounded-md">
                        <button type="button" onclick="deleteImage({{ $image->id }})" class="absolute top-1 right-1 bg-red-500 text-white rounded-full h-6 w-6 flex items-center justify-center text-xs">&times;</button>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            <div class="mt-4 space-y-2">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm" @if(old('is_active', $item->is_active ?? 1) == 1) checked @endif>
                    <span class="ml-2 text-sm text-gray-600">Active (Visible on site)</span>
                </label>
                <label class="flex items-center">
                    <input type="checkbox" name="is_featured" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm" @if(old('is_featured', $item->is_featured ?? 0) == 1) checked @endif>
                    <span class="ml-2 text-sm text-gray-600">Featured (Show on homepage)</span>
                </label>
            </div>
        </div>
    </div>
</div>

<script>
    async function deleteImage(imageId) {
        if (!confirm('Are you sure you want to delete this image?')) return;
        const response = await fetch(`/admin/items/image/${imageId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        });
        const result = await response.json();
        if (response.ok) {
            document.getElementById(`image-${imageId}`).remove();
            alert(result.success);
        } else {
            alert(result.error);
        }
    }
</script>
