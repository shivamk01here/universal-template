<section id="features" class="py-20">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">{{ $content->heading ?? 'Features' }}</h2>
        <div class="space-y-16">
            @if(isset($content->features) && is_array($content->features))
                @foreach($content->features as $index => $feature)
                    <div class="flex flex-col {{ $index % 2 == 0 ? 'md:flex-row' : 'md:flex-row-reverse' }} items-center gap-12">
                        <div class="md:w-1/2">
                            <img src="{{ $feature->image_url ?? 'https://placehold.co/500x300' }}" alt="{{ $feature->title ?? '' }}" class="rounded-lg shadow-lg">
                        </div>
                        <div class="md:w-1/2">
                            <h3 class="text-2xl font-bold text-gray-800 mb-3">{{ $feature->title ?? '' }}</h3>
                            <p class="text-gray-600">{{ $feature->description ?? '' }}</p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>