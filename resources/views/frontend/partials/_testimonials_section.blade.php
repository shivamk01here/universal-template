<div class="theme-bg-tertiary py-16 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold theme-text-primary">What People Think About Us</h2>
            <p class="mt-4 text-lg theme-text-muted">Real stories from our happy customers</p>
        </div>

        <div class="mt-12 relative overflow-hidden">
            <!-- Fade corners, always white, don't reverse for dark mode -->
          
            <div id="testimonialTrack" class="flex space-x-4 sm:space-x-6 pb-8">
                @foreach($testimonials as $testimonial)
                <div class="flex-shrink-0 w-72 sm:w-80 theme-bg-primary rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 p-6 flex flex-col group hover:-translate-y-1">
                    <div class="flex items-center mb-4">
                        <img class="h-12 w-12 rounded-full object-cover ring-2 ring-primary-dynamic/20"
                            src="{{ $testimonial->image_url ? asset('storage/testimonials/' . $testimonial->image_url) : 'https://placehold.co/100' }}"
                            alt="{{ $testimonial->customer_name }}">
                        <div class="ml-4">
                            <h4 class="text-lg font-bold theme-text-primary">{{ $testimonial->customer_name }}</h4>
                            <p class="text-sm theme-text-muted">{{ $testimonial->location }}</p>
                        </div>
                    </div>
                    <!-- Star Rating -->
                    <div class="flex items-center text-amber-400 mb-4">
                        @for($i = 0; $i < 5; $i++)
                            @if($i < $testimonial->rating)
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                    <path d="M10 15l-5.878 3.09 1.122-6.545L0 6.91l6.561-.955L10 0l3.439 5.955L20 6.91l-5.244 4.635 1.122 6.545z"/>
                                </svg>
                            @else
                                <svg class="w-4 h-4 theme-text-muted" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 15l-5.878 3.09 1.122-6.545L0 6.91l6.561-.955L10 0l3.439 5.955L20 6.91l-5.244 4.635 1.122 6.545z"/>
                                </svg>
                            @endif
                        @endfor
                        <span class="ml-2 text-sm font-medium theme-text-secondary">({{ $testimonial->rating }}/5)</span>
                    </div>
                    <p class="theme-text-secondary flex-grow leading-relaxed">{{ Str::limit($testimonial->quote, 120) }}</p>
                    <button class="text-primary-dynamic font-semibold mt-4 text-sm hover:underline self-start" 
                            onclick="showFullTestimonial('{{ $testimonial->id }}')">
                        Read more →
                    </button>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes scrollTestimonials {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    #testimonialTrack { display: flex; animation: scrollTestimonials 25s linear infinite; }
    #testimonialTrack:hover { animation-play-state: paused; }
    @media (max-width: 640px) { #testimonialTrack { animation-duration: 20s; } }
</style>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const track = document.getElementById('testimonialTrack');
        if (track && track.children.length > 0) {
            // Clone testimonials for seamless loop
            track.innerHTML += track.innerHTML;
        }
    });
    function showFullTestimonial(id) { /* modal/expansion logic if needed */ }
</script>
