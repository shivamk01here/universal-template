<div class="bg-gray-50 py-16 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900">What The People Thinks About Us</h2>
            <p class="mt-4 text-lg text-gray-500">Real stories from our happy customers</p>
        </div>

        <div class="mt-12 relative overflow-hidden">
            <!-- Left fade -->
            <div class="absolute left-0 top-0 h-full w-16 bg-gradient-to-r from-gray-50 to-transparent pointer-events-none z-10"></div>
            <!-- Right fade -->
            <div class="absolute right-0 top-0 h-full w-16 bg-gradient-to-l from-gray-50 to-transparent pointer-events-none z-10"></div>

            <div id="testimonialTrack" class="flex space-x-8 pb-8">
                @foreach($testimonials as $testimonial)
                <div class="flex-shrink-0 w-80 bg-white rounded-lg shadow-lg p-6 flex flex-col">
                    <div class="flex items-center mb-4">
                        <img class="h-12 w-12 rounded-full object-cover" src="{{ $testimonial->image_url ?? 'https://placehold.co/100' }}" alt="{{ $testimonial->customer_name }}">
                        <div class="ml-4">
                            <h4 class="text-lg font-bold">{{ $testimonial->customer_name }}</h4>
                            <p class="text-sm text-gray-500">{{ $testimonial->location }}</p>
                        </div>
                    </div>

                    <!-- Star Rating -->
                    <div class="flex items-center text-yellow-500 mb-3">
                        @for($i = 0; $i < $testimonial->rating; $i++)
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                <path d="M10 15l-5.878 3.09 1.122-6.545L0 6.91l6.561-.955L10 0l3.439 5.955L20 6.91l-5.244 4.635 1.122 6.545z"/>
                            </svg>
                        @endfor
                    </div>

                    <p class="text-gray-600 flex-grow">{{ Str::limit($testimonial->quote, 120) }}</p>
                    <a href="#" class="text-yellow-500 font-semibold mt-2">read more</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
    /* Smooth auto-scroll keyframes */
    @keyframes scrollTestimonials {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    #testimonialTrack {
        display: flex;
        animation: scrollTestimonials 20s linear infinite;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const track = document.getElementById('testimonialTrack');
        // Clone testimonials for seamless loop
        track.innerHTML += track.innerHTML;
    });
</script>
