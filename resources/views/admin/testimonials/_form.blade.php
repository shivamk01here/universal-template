<div class="space-y-6">
    <div>
        <label for="customer_name" class="block text-sm font-medium text-gray-700">Customer Name</label>
        <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name', $testimonial->customer_name ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
    </div>
    <div>
        <label for="location" class="block text-sm font-medium text-gray-700">Location (e.g., City, Country)</label>
        <input type="text" name="location" id="location" value="{{ old('location', $testimonial->location ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
    </div>
    <div>
        <label for="image_url" class="block text-sm font-medium text-gray-700">Customer Image URL</label>
        <input type="text" name="image_url" id="image_url" value="{{ old('image_url', $testimonial->image_url ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
    </div>
    <div>
        <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
        <select name="rating" id="rating" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @for($i = 5; $i >= 1; $i--)
                <option value="{{ $i }}" @if(isset($testimonial) && $testimonial->rating == $i) selected @endif>{{ $i }} Stars</option>
            @endfor
        </select>
    </div>
    <div>
        <label for="quote" class="block text-sm font-medium text-gray-700">Quote / Testimonial Text</label>
        <textarea name="quote" id="quote" rows="5" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('quote', $testimonial->quote ?? '') }}</textarea>
    </div>
    <div>
        <label class="flex items-center">
            <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300" @if(old('is_active', $testimonial->is_active ?? 1) == 1) checked @endif>
            <span class="ml-2 text-sm text-gray-600">Active</span>
        </label>
    </div>
</div>
<div class="mt-8 pt-5 border-t">
    <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">Save Testimonial</button>
</div>