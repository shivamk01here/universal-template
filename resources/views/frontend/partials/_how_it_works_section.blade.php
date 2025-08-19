<div class="py-12 theme-bg-primary">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold theme-text-primary">{{ $section->title }}</h2>
            <p class="mt-4 text-lg theme-text-muted">{{ $section->subtitle }}</p>
        </div>
        @if(isset($section->content['steps']) && is_array($section->content['steps']))
        <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($section->content['steps'] as $index => $step)
            <div class="text-center group">
                <div class="relative">
                    <div class="flex items-center justify-center h-16 w-16 rounded-2xl bg-primary-dynamic text-white mx-auto shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:scale-110">
                        <i class="fas {{ $step['icon'] ?? 'fa-check' }} text-xl"></i>
                    </div>
                    @if($index < count($section->content['steps']) - 1)
                        <div class="hidden lg:block absolute top-8 left-full w-full h-0.5 bg-gradient-to-r from-primary-dynamic to-transparent transform translate-x-4"></div>
                    @endif
                </div>
                <h3 class="mt-6 text-xl font-semibold theme-text-primary">{{ $step['title'] }}</h3>
                <p class="mt-3 text-base theme-text-secondary leading-relaxed">{{ $step['description'] }}</p>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>