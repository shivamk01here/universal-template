<div class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900">{{ $section->title }}</h2>
            <p class="mt-4 text-lg text-gray-500">{{ $section->subtitle }}</p>
        </div>
        @if(isset($section->content['steps']) && is_array($section->content['steps']))
        <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($section->content['steps'] as $step)
            <div class="text-center">
                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white mx-auto">
                    <i class="fas {{ $step['icon'] ?? 'fa-check' }} fa-2x"></i>
                </div>
                <h3 class="mt-5 text-lg font-medium text-gray-900">{{ $step['title'] }}</h3>
                <p class="mt-2 text-base text-gray-500">{{ $step['description'] }}</p>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>