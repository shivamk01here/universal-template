<section id="services" style="{{ getBackgroundStyle($content) }}" class="py-20">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800">{{ $content->heading ?? 'Our Services' }}</h2>
            <p class="text-gray-600 mt-2">{{ $content->subheading ?? '' }}</p>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($services as $service)
            <div class="bg-white text-center p-8 rounded-lg shadow-md hover:shadow-xl transition">
                <div class="text-indigo-500 text-5xl mb-4"><i class="{{ $service->icon_class }}"></i></div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $service->name }}</h3>
                <p class="text-gray-600">{{ $service->description }}</p>
            </div>
            @empty
            <p class="lg:col-span-4 text-center text-gray-500">No services found.</p>
            @endforelse
        </div>
    </div>
</section>