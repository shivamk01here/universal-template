<section id="testimonials" class="bg-gray-50 py-20">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800">{{ $content->heading ?? 'Testimonials' }}</h2>
            <p class="text-gray-600 mt-2">{{ $content->subheading ?? '' }}</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($testimonials as $testimonial)
            <div class="bg-white p-8 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <img src="{{ $testimonial->author_avatar }}" alt="{{ $testimonial->author_name }}" class="w-12 h-12 rounded-full mr-4">
                    <div>
                        <p class="font-bold text-gray-800">{{ $testimonial->author_name }}</p>
                        <p class="text-sm text-gray-500">{{ $testimonial->author_title }}</p>
                    </div>
                </div>
                <div class="text-yellow-400 mb-4">
                    @for($i = 0; $i < $testimonial->rating; $i++) <i class="fas fa-star"></i> @endfor
                    @for($i = 0; $i < 5 - $testimonial->rating; $i++) <i class="far fa-star"></i> @endfor
                </div>
                <p class="text-gray-600 italic">"{{ $testimonial->review_text }}"</p>
            </div>
            @endforeach
        </div>
    </div>
</section>