<div class="space-y-6">
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded relative">
            {{ session('success') }}
        </div>
    @endif

    <div>
        <label for="customer_name" class="block text-sm font-medium text-gray-700">Customer Name</label>
        <input type="text" name="customer_name" id="customer_name"
               value="{{ old('customer_name', $testimonial->customer_name ?? '') }}" required
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
    </div>

    <div>
        <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
        <input type="text" name="location" id="location"
               value="{{ old('location', $testimonial->location ?? '') }}"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
    </div>

    <div>
        <label for="image" class="block text-sm font-medium text-gray-700">Customer Image</label>
        <input type="file" name="image" id="image"
               accept="image/*"
               class="mt-1 block w-full text-gray-700 rounded-md border-gray-300 shadow-sm"
               onchange="showPreview(event)">
        <div class="mt-2 flex flex-col space-y-2">
            <img id="image-preview"
                 src="@if(old('image_url')){{ asset('storage/testimonials/' . old('image_url')) }}@elseif(isset($testimonial) && $testimonial->image_url){{ asset('storage/testimonials/' . $testimonial->image_url) }}@else{{ '' }}@endif"
                 style="@if(empty(old('image_url')) && (!isset($testimonial) || empty($testimonial->image_url)))display:none;@endif max-width: 150px; max-height: 150px; border-radius: 12px; border: 1px solid #e5e7eb;"/>
            @if(isset($testimonial) && $testimonial->image_url)
                <span class="text-xs text-gray-600">Current: {{ $testimonial->image_url }}</span>
            @endif
        </div>
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
        <textarea name="quote" id="quote" rows="5" required
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('quote', $testimonial->quote ?? '') }}</textarea>
    </div>

    <div>
        <label class="flex items-center">
            <input type="checkbox" name="is_active" value="1"
                   class="rounded border-gray-300"
                   @if(old('is_active', $testimonial->is_active ?? 1) == 1) checked @endif>
            <span class="ml-2 text-sm text-gray-600">Active</span>
        </label>
    </div>
</div>

<div class="mt-8 pt-5 border-t">
    <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">Save Testimonial</button>
</div>

<script>
    function showPreview(event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('image-preview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]); // ✅ Corrected line
        }
    }
</script>
