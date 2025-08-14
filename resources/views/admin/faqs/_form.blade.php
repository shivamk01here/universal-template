
<div class="space-y-6">
    <div>
        <label for="question" class="block text-sm font-medium text-gray-700">Question</label>
        <input type="text" name="question" id="question" value="{{ old('question', $faq->question ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
    </div>
    <div>
        <label for="answer" class="block text-sm font-medium text-gray-700">Answer</label>
        <textarea name="answer" id="answer" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('answer', $faq->answer ?? '') }}</textarea>
    </div>
    <div>
        <label for="sort_order" class="block text-sm font-medium text-gray-700">Sort Order</label>
        <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $faq->sort_order ?? '0') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
    </div>
    <div>
        <label class="flex items-center">
            <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300" @if(old('is_active', $faq->is_active ?? 1) == 1) checked @endif>
            <span class="ml-2 text-sm text-gray-600">Active</span>
        </label>
    </div>
</div>
<div class="mt-8 pt-5 border-t">
    <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">Save FAQ</button>
</div>