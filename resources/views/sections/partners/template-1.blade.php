<section id="partners" class="bg-gray-50 py-12">
    <div class="container mx-auto px-6 text-center">
        <h3 class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-8">{{ $content->heading ?? 'Our Partners' }}</h3>
        <div class="flex flex-wrap justify-center items-center gap-8 md:gap-12">
            @if(isset($content->logos) && is_array($content->logos))
                @foreach($content->logos as $logo_url)
                    <img src="{{ $logo_url }}" alt="Partner Logo" class="h-8 opacity-60">
                @endforeach
            @endif
        </div>
    </div>
</section>