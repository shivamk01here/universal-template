<div class="theme-bg-primary py-14 sm:py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto relative">

        <!-- Heading -->
        <div class="text-center">
            <h2 class="text-2xl sm:text-3xl font-semibold tracking-tight theme-text-primary">
                ✨ From the Blog
            </h2>
            <p class="mt-3 text-base sm:text-lg theme-text-muted max-w-2xl mx-auto">
                Fresh thoughts, ideas, and guides to inspire your journey.
            </p>
        </div>

        <!-- Carousel -->
        <div x-data="blogCarousel()" x-init="init()" class="relative mt-10 sm:mt-12">
        
            <!-- Track -->
            <div
                x-ref="track"
                @mouseenter="pause = true"
                @mouseleave="pause = false"
                class="flex gap-4 sm:gap-6 overflow-x-auto scroll-smooth snap-x snap-mandatory scrollbar-hide"
                style="scroll-snap-type: x mandatory;"
            >
                @foreach($blogs as $blog)
                    <article class="flex-none w-[88%] xs:w-[85%] sm:w-[70%] md:w-1/2 lg:w-1/3 snap-start">
                        <div class="h-full overflow-hidden rounded-xl theme-border border theme-bg-primary shadow-sm transition hover:shadow-md">
                            <a href="{{ route('blogs.show', $blog->slug) }}" class="block group">
                                <div class="relative w-full aspect-[16/10] overflow-hidden">
                                    <img
                                        src="{{ $blog->image ? asset('storage/blogs/' . $blog->image) : 'https://placehold.co/800x400' }}"
                                        alt="{{ $blog->title }}"
                                        class="absolute inset-0 h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
                                        loading="lazy"
                                    />
                                </div>
                            </a>
                            <div class="p-4 sm:p-5 flex flex-col h-full">
                                <a href="{{ route('blogs.show', $blog->slug) }}">
                                    <h3 class="text-base sm:text-lg font-semibold theme-text-primary leading-snug hover:theme-text-secondary transition">
                                        {{ $blog->title }}
                                    </h3>
                                </a>
                                <p class="mt-2 sm:mt-3 text-sm theme-text-muted line-clamp-3">
                                    {{ Str::limit(strip_tags($blog->content), 140) }}
                                </p>
                                <div class="mt-4 sm:mt-5">
                                    <a href="{{ route('blogs.show', $blog->slug) }}"
                                       class="inline-flex items-center text-sm font-semibold theme-text-secondary hover:theme-text-primary">
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
                        class="rounded-full theme-border border theme-bg-primary px-3 py-2 text-sm theme-text-secondary shadow-sm hover:theme-bg-tertiary focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-dynamic/30">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <button @click="next()"
                        class="rounded-full theme-border border theme-bg-primary px-3 py-2 text-sm theme-text-secondary shadow-sm hover:theme-bg-tertiary focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-dynamic/30">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>
            @endif
        </div>
    </div>
</div>
<style>
.scrollbar-hide::-webkit-scrollbar{ display:none; }
.scrollbar-hide{ -ms-overflow-style:none; scrollbar-width:none; }
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
<script>
function blogCarousel(){
    return {
        pause: false,
        intervalId: null,
        init(){
            const track = this.$refs.track;
            const children = track ? track.children.length : 0;
            if(children <= 1) return;
            track.scrollTo({ left: 0 });
            this.intervalId = setInterval(() => {
                if (this.pause) return;
                const cardWidth = track.clientWidth * this.getStep();
                const atEnd = Math.ceil(track.scrollLeft + track.clientWidth + 2) >= track.scrollWidth;
                if (atEnd) {
                    track.scrollTo({ left: 0, behavior: 'smooth' });
                } else {
                    track.scrollBy({ left: cardWidth, behavior: 'smooth' });
                }
            }, 3000);
        },
        getStep(){
            const w = window.innerWidth;
            if (w >= 1024) return 1/3;   
            if (w >= 768)  return 1/2;   
            return 0.9;                  
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
