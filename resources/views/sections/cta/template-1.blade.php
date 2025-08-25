<section id="cta" style="background-color: {{ $content->bg_color ?? '#f3f4f6' }};">
    <div class="container mx-auto px-6 py-20 text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-3">{{ $content->heading ?? 'Call to Action' }}</h2>
        <p class="text-gray-600 max-w-2xl mx-auto mb-8">{{ $content->subheading ?? '' }}</p>
        <a href="{{ $content->primary_cta_link ?? '#' }}" style="background-color: {{ $content->primary_cta_bg_color ?? '#4f46e5' }}" class="text-white font-semibold px-8 py-3 rounded-lg hover:opacity-90 transition inline-block">{{ $content->primary_cta_text ?? 'Get Started' }}</a>
    </div>
</section>