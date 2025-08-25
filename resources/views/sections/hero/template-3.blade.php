<section id="hero" style="{{ getBackgroundStyle($content) }}" class="py-24">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-6xl font-bold text-gray-800 mb-4">{{ $content->heading ?? 'Default Heading' }}</h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-8">{{ $content->subheading ?? '' }}</p>
        <a href="{{ $content->primary_cta_link ?? '#' }}" style="background-color: {{ $content->primary_cta_bg_color ?? '#16a34a' }}" class="text-white font-semibold px-6 py-3 rounded-lg hover:opacity-90 transition">{{ $content->primary_cta_text ?? 'Primary Action' }}</a>
    </div>
</section>