<!-- resources/views/frontend/blogs/index.blade.php -->
<div class="bg-white py-14 sm:py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto relative">

        <!-- Heading -->
        <div class="text-center">
            <h2 class="text-2xl sm:text-3xl font-semibold tracking-tight text-gray-900">
                ✨ From the Blog
            </h2>
            <p class="mt-3 text-base sm:text-lg text-gray-500 max-w-2xl mx-auto">
                Fresh thoughts, ideas, and guides to inspire your journey.
            </p>
        </div>

        <!-- Carousel -->
        <div
            x-data="blogCarousel()"
            x-init="init()"
            class="relative mt-10 sm:mt-12"
        >
            <!-- Fade edges -->
            <div class="pointer-events-none absolute inset-y-0 left-0 z-10 w-10 sm:w-16 bg-gradient-to-r from-white to-transparent"></div>
            <div class="pointer-events-none absolute inset-y-0 right-0 z-10 w-10 sm:w-16 bg-gradient-to-l from-white to-transparent"></div>

            <!-- Track -->
            <div
                x-ref="track"
                @mouseenter="pause = true"
                @mouseleave="pause = false"
                class="flex gap-4 sm:gap-6 overflow-x-auto scroll-smooth snap-x snap-mandatory scrollbar-hide"
                style="scroll-snap-type: x mandatory;"
            >
                @foreach($blogs as $blog)
                    <!-- Widths: 100% on mobile, 50% on md, 33.333% on lg -->
                    <article class="flex-none w-[88%] xs:w-[85%] sm:w-[70%] md:w-1/2 lg:w-1/3 snap-start">
                        <div class="h-full overflow-hidden rounded-xl border border-gray-200/70 bg-white shadow-sm transition hover:shadow-md">
                            <a href="{{ route('blogs.show', $blog->slug) }}" class="block group">
                                <!-- Maintain aspect ratio for consistent thumbs -->
                                <div class="relative w-full aspect-[16/10] overflow-hidden">
                                    <img
                                        src="{{ $blog->image_url ?? 'https://placehold.co/800x400' }}"
                                        alt="{{ $blog->title }}"
                                        class="absolute inset-0 h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
                                        loading="lazy"
                                    />
                                </div>
                            </a>

                            <div class="p-4 sm:p-5 flex flex-col h-full">
                                <a href="{{ route('blogs.show', $blog->slug) }}">
                                    <h3 class="text-base sm:text-lg font-semibold text-gray-900 leading-snug hover:text-gray-700 transition">
                                        {{ $blog->title }}
                                    </h3>
                                </a>
                                <p class="mt-2 sm:mt-3 text-sm text-gray-500 line-clamp-3">
                                    {{ Str::limit(strip_tags($blog->content), 140) }}
                                </p>
                                <div class="mt-4 sm:mt-5">
                                    <a href="{{ route('blogs.show', $blog->slug) }}"
                                       class="inline-flex items-center text-sm font-semibold text-gray-800 hover:text-gray-900">
                                        Read More
                                        <span class="ml-1">→</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Controls (show on md and up) -->
            @if(($blogs->count() ?? count($blogs)) > 1)
            <div class="hidden md:flex items-center justify-center gap-3 mt-6">
                <button @click="prev()"
                        class="rounded-full border border-gray-200 bg-white px-3 py-2 text-sm text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-gray-300">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <button @click="next()"
                        class="rounded-full border border-gray-200 bg-white px-3 py-2 text-sm text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-gray-300">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Hide scrollbar -->
<style>
.scrollbar-hide::-webkit-scrollbar{ display:none; }
.scrollbar-hide{ -ms-overflow-style:none; scrollbar-width:none; }
</style>

<!-- Alpine helper -->
<script>
function blogCarousel(){
    return {
        pause: false,
        intervalId: null,
        init(){
            // Auto-advance every 3s; skip if 0/1 items
            const track = this.$refs.track;
            const children = track ? track.children.length : 0;
            if(children <= 1) return;

            // Ensure smooth initial snap
            track.scrollTo({ left: 0 });

            this.intervalId = setInterval(() => {
                if (this.pause) return;

                const cardWidth = track.clientWidth * this.getStep(); // step portion of viewport
                const atEnd = Math.ceil(track.scrollLeft + track.clientWidth + 2) >= track.scrollWidth;

                if (atEnd) {
                    track.scrollTo({ left: 0, behavior: 'smooth' });
                } else {
                    track.scrollBy({ left: cardWidth, behavior: 'smooth' });
                }
            }, 3000);
        },
        getStep(){
            // Move by 1 card depending on breakpoints
            const w = window.innerWidth;
            if (w >= 1024) return 1/3;   // lg: 3 cards view → move 1
            if (w >= 768)  return 1/2;   // md: 2 cards view → move 1
            return 0.9;                  // sm: nearly full width card → step almost full
        },
        next(){
            const t = this.$refs.track;
            const step = t.clientWidth * this.getStep();
            t.scrollBy({ left: step, behavior: 'smooth' });
        },
        prev(){
            const t = this.$refs.track;
            const step = t.clientWidth * this.getStep();
            t.scrollBy({ left: -step, behavior: 'smooth' });
        }
    }
}
</script>
