<input type="hidden" name="section_type" value="{{ $section->section_type ?? 'custom-html' }}">
<div class="space-y-6">
    <div>
        <label for="title">Title</label>
        <input type="text" name="title" value="{{ old('title', $section->title ?? '') }}" required>
    </div>
    @if(isset($section) && $section->section_type !== 'custom-html')
        <div>
            <label for="subtitle">Subtitle</label>
            <input type="text" name="subtitle" value="{{ old('subtitle', $section->subtitle ?? '') }}">
        </div>
    @else
        <div>
            <label for="section_slug">Section Slug (unique, e.g., 'my-custom-section')</label>
            <input type="text" name="section_slug" value="{{ old('section_slug', $section->section_slug ?? '') }}" {{ isset($section) ? 'readonly' : 'required' }}>
        </div>
        <div>
            <label for="content">HTML Content</label>
            <textarea name="content" rows="10">{{ old('content', $section->content ?? '') }}</textarea>
        </div>
    @endif
    <div>
        <label for="sort_order">Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $section->sort_order ?? '10') }}" required>
    </div>
    <div>
        <label><input type="checkbox" name="is_active" value="1" @if(old('is_active', $section->is_active ?? 1) == 1) checked @endif> Active</label>
    </div>
</div>
<button type="submit">Save Section</button>