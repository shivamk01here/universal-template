<section id="hero" style="{{ getBackgroundStyle($content) }}" class="relative text-white py-32">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="container mx-auto px-6 text-center relative z-10">
        <h1 class="text-5xl md:text-7xl font-extrabold leading-tight mb-4">{{ $content->heading ?? 'Default Heading' }}</h1>
        <p class="text-lg md:text-xl text-gray-200 max-w-3xl mx-auto mb-8">{{ $content->subheading ?? '' }}</p>
        <a href="{{ $content->primary_cta_link ?? '#' }}" style="background-color: {{ $content->primary_cta_bg_color ?? '#db2777' }}" class="text-white font-bold px-8 py-4 rounded-lg hover:opacity-90 transition text-lg">{{ $content->primary_cta_text ?? 'Primary Action' }}</a>
    </div>
</section>