<section id="hero" style="background-color: {{ $content->bg_color ?? '#FFF' }};">
    <div class="container mx-auto px-6 py-20">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 leading-tight mb-4">{{ $content->heading ?? 'Default Heading' }}</h1>
                <p class="text-gray-600 text-lg mb-8">{{ $content->subheading ?? '' }}</p>
                <div class="flex space-x-4">
                    <a href="{{ $content->primary_cta_link ?? '#' }}" style="background-color: {{ $content->primary_cta_bg_color ?? '#4f46e5' }}" class="text-white font-semibold px-6 py-3 rounded-lg hover:opacity-90 transition">{{ $content->primary_cta_text ?? 'Primary Action' }}</a>
                    <a href="{{ $content->secondary_cta_link ?? '#' }}" style="background-color: {{ $content->secondary_cta_bg_color ?? '#4b5563' }}" class="text-white font-semibold px-6 py-3 rounded-lg hover:opacity-90 transition">{{ $content->secondary_cta_text ?? 'Secondary Action' }}</a>
                </div>
            </div>
            <div class="md:w-1/2">
                <img src="{{ $content->main_image_url ?? 'https://placehold.co/600x400' }}" alt="Feature Image" class="rounded-lg shadow-xl">
            </div>
        </div>
    </div>
</section>